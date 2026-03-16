<?php

namespace App\Http\Controllers\NativeApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BelongsTo;
use App\Helpers\Helper;
use App\Models\StudentDashboard;
use App\Models\ClassModel;
use App\Models\StudentInfo;
use App\Models\Sclass;
use App\Models\School;
use App\Models\Sstudent;
use App\Models\Food;
use App\Models\FoodItems;
use Carbon\Carbon;
use App\Models\WaterIntake;
use App\Models\Report;
use App\Models\Activity;
use App\Models\SleepRecord;
use App\Models\CalorieTarget;
use Illuminate\Support\Facades\DB;
use Response;
use Session;
use Illuminate\Support\Facades\Cookie;
use App\Models\TermMaster;
use App\Traits\ReportHelperTrait;
use DateTime;
 
use Illuminate\Contracts\View\Factory as ViewFactory;


class StudentProfileController extends Controller
{
    use ReportHelperTrait;


    public function show(Request $request) {
         
        $student = Auth::guard('student-api')->user();
        $student->load(['school', 'class']);

        $className = Helper::changeToRoman($student->custom_class_id);

        $normalizedData = [
            'user_id'      => $student->id,
            'name'         => $student->student_name,
            'email'        => $student->email_id,
            'phone'        => $student->phone ?? null,
            'gender'       => $student->gender,
            'reg_id'       => $student->user_id, 
            'role_id'      => 5, 
            'account_type' => 'student', 
            'avatar'       => $student->avatar  ? asset('public/' . $student->avatar) : null,

            'schools'      => $student->school ? [[
                'id'   => $student->school->id,
                'name' => $student->school->school_name,
                'logo' => $student->school->logo  ? asset('public/logo/' . $student->school->logo)  : null,
            ]] : [],

            'metadata'     => [
                'dob'           => $student->dob,
                'qualification' => $className ?? null,
                'rollno'    => $student->rollno,

            ]
        ];

        return response()->json([
            'status'       => true,
            'account_type' => 'student',
            'data'         => $normalizedData 
        ]);
    }

    public function dashboard(){

        $studentId = Auth::guard('student-api')->user()->id;
        $currentDate = Carbon::now()->format('Y/m/d');
           
        $studentData = DB::table('students')        
        ->join('schools', 'schools.id', '=' , 'students.school_id')
        ->leftJoin('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
        ->join('class', 'custom_classes.class_id', '=', 'class.id')
        ->select(
            'schools.school_name as school_name', 
            'schools.id as school_id', 
            'students.student_name', 
            'students.class_id',
            'students.custom_class_id',
            'students.gender', 
            'students.dob',
            'custom_classes.section',
            'students.rollno',
            DB::raw("
                CASE 
                    WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                    THEN custom_classes.nomenclature 
                    ELSE class.name 
                END AS className
            ")
        )
        ->where('students.status', 'active')
        ->where('students.id', $studentId)
        ->first();


        $dob          = Carbon::parse($studentData->dob);
        $studentAge   = $dob->age;
        
        $ageGender = $studentAge . strtolower(substr($studentData->gender, 0, 1));

        $SchoolId = $studentData->school_id;
        $classId = $studentData->class_id;

        $TermMasterId =  $this->getTermId($SchoolId);

        $bmiRecord = DB::table('SeniorTestResults as str')
        ->select('str.height', 'str.weight', 'str.score', 'str.level')
        ->where('str.TestTypeID', 18)
        ->where('str.StudentID', $studentId)
        ->where('str.TermId', $TermMasterId)
        ->orderBy('str.ResultId', 'desc')
        ->limit(1)
        ->first();

        $getBmiBenchmark = $getBmiBenchmark =  $this->getBmiBenchmark($ageGender);
        
        // dd($bmiRecord);

        $class = DB::table('custom_classes')
        ->join('class','class.id','=','custom_classes.class_id')
        ->select('custom_classes.id','class_id','section',
            DB::raw("CASE 
                WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                THEN custom_classes.nomenclature 
                ELSE class.name 
            END AS classname")
        )
        ->where('class.id', $classId)
        ->Where('school_id', $SchoolId)
        ->orderBy('custom_classes.orders', 'ASC')
        ->get();

        $fmsApplicable = DB::table('class_fitness_tests')->where('class_id', $classId)->pluck('test_type_id')->toArray();

        $fmsTestData = DB::table('TestTypeMaster')
        ->join('skill_reports', 'skill_reports.TestTypeMasterID', '=', 'TestTypeMaster.TestTypeID')
        ->join('skillreport_skilltype_termtype_mapping as sst', function ($join) use ($studentId, $TermMasterId) {
            $join->on('sst.skill_report_id', '=', 'skill_reports.id')
                ->where('sst.student_id', $studentId)
                ->where('sst.term_master_id', $TermMasterId);
        })
        ->select(
            'TestTypeMaster.TestTypeID',
            'skill_reports.skill_name',
            'skill_reports.icons',
            DB::raw('COUNT(sst.id) as score')
        )
        ->whereIn('TestTypeMaster.TestTypeID', $fmsApplicable)
        ->groupBy(
            'TestTypeMaster.TestTypeID',
            'skill_reports.skill_name',
            'skill_reports.icons'
        )
        ->get();

        
        foreach ($fmsTestData as $item) {
            $count = $item->score;

            if ($count == 1) {
                $item->outcome = 'Emerging';
            } elseif ($count == 2) {
                $item->outcome = 'Developing';
            } elseif ($count == 3) {
                $item->outcome = 'Acquired';
            } elseif ($count >= 4) {
                $item->outcome = 'Accomplished';
            } else {
                $item->outcome = 'N.A.';
            }
        }

        $fitnessTest = DB::table('SeniorTestResults as str')
            ->join('skill_reports', 'skill_reports.id', '=', 'str.TestTypeID')
            ->join('TestTypeMaster','TestTypeMaster.TestTypeID','=', 'skill_reports.TestTypeMasterID')
            ->select(
                'str.SchoolID',
                'str.StudentID',
                'str.TermId',
                'str.TestTypeID',
                'str.Score',
                'str.height',
                'str.weight',
                'str.level',                
                'skill_reports.skill_name',
                'skill_reports.icons',
                'TestTypeMaster.ScoreUnit',
                'TestTypeMaster.ScoreCriteria'          
            )
            ->where('str.StudentID', $studentId)
            ->where('str.TermId', $TermMasterId)
            ->whereNotIn('str.TestTypeID', [18])
            ->get();

        $levelLabels = [
            'L0' => "Inadequate",
            'L1' => "Very Low",
            'L2' => "Low",
            'L3' => "Developing",
            'L4' => "Moderate",
            'L5' => "Good",
            'L6' => "High",
            'L7' => "Excellent",
            'L8' => "Beyond L7",
        ];
        

        $categories_id2 = [];
        $categoty = "";

        if(in_array($studentData->class_id, [1, 2, 3])){
            $categories_id2 = [6,2];
        }else{
            $categories_id2 = [3,10,12,11,8,9,5,4,15];
        }
        if($studentData->gender == 'Male'){
            $categoty = "Boys";
        }else{
            $categoty = "Girls";
        }

        $getFitnessBenchmark = $this->getBenchmark($studentAge, $categoty, $categories_id2)->keyBy('skill_name');

    

        $fitnessTest->map(function ($item) use ($levelLabels, $getFitnessBenchmark) {    

            $normalizedScore = $this->formatValue($item->Score, $item->ScoreUnit);
            $item->Score = $normalizedScore ?? null;

            $currentLevelKey = $item->level;
            $num = (int) str_replace('L', '', $currentLevelKey);
            $nextLevelKey = 'L' . ($num + 1);


            $item->levelOutcome = $levelLabels[$currentLevelKey] ?? 'Unknown';
            $item->nextGoal = isset($levelLabels[$nextLevelKey])  ? [
                'next_level'    => $nextLevelKey, 
                'next_outcome'  => $levelLabels[$nextLevelKey],
                'next_score'    =>''
            ] : null;

            $skillBenchmark = $getFitnessBenchmark->get($item->skill_name);

            if ($skillBenchmark && isset($skillBenchmark->ranges)) {
                $ranges = $skillBenchmark->ranges;
                $item->nextGoal['next_score'] = $ranges[$nextLevelKey] ?? 'Already Reached Maximum';


                $item->ultimateGoal = [
                    'ultimate_level' => 'L7', 
                    'ultimate_goal' => $levelLabels['L7'], 
                    'ultimate_score' => $ranges['L7'] ?? 'N.A.'
                ];

            } else {
                $item->nextLevelScore = 'N.A';
                $item->ultimate_goal = 'N.A.';
                $item->ultimate_score = 'N.A.';
            }

            
            return $item;
        });

        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $today = Carbon::today()->toDateString();
        if ($month < 4 || ($month == 3 && $day <= 31)) {
            $academicYear = ($year - 1) . '-' . $year;
        }

        $terms = TermMaster::select('id as term_id','term_name','academic_year','term_start_date','term_end_date')->where('school_id', $SchoolId)->where('is_active', 1)->where('academic_year', $academicYear)->get();

        $currentTerm = DB::table('term_masters')
            ->select('id', 'term_name', 'academic_year', 'term_start_date', 'term_end_date')
            ->where('school_id', $SchoolId)
            ->where('is_active', '1')
            ->where('academic_year', $academicYear)
            ->whereDate('term_start_date', '<=', $today)
            ->whereDate('term_end_date', '>=', $today)
            ->first();

        $selectedTerm = session('term_id', $currentTerm->id);

        return response()->json([
            'status' => true,
            'selected_term_id' => (int)$TermMasterId,
            'data' => [
                'student_profile' => $studentData,
                'age'             => $studentAge,
                'bmi_report'      => [
                    'latest'    => $bmiRecord,
                    'bmi_benchmark' => $getBmiBenchmark
                ],
                'fms_tests'       => $fmsTestData,
                'fitness_tests'   => $fitnessTest,
                'academic_terms'  => $terms,
                'getFitnessBenchmark' => $getFitnessBenchmark
            ]
        ], 200);
    }


    public function dailyReportApi(Request $request){ 

       
        $UserData = Auth::guard('student-api')->user();
        $school_id = $UserData->school_id;
        $SessionAndTerm = TermMaster::where('school_id', $school_id)->where('is_active',1)->select('id','term_name','academic_year')->get();

        $studentClassData = DB::table('custom_classes')
        ->join('class', 'class.id', '=', 'custom_classes.class_id')
        ->where('custom_classes.id', $UserData->custom_class_id)
        ->select(DB::raw("CASE 
                            WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                            THEN custom_classes.nomenclature 
                            ELSE class.name 
                        END AS class_display_name"),
                 'custom_classes.section')
        ->first();

        $dailyReportCard['studentProfile'] = [
            'name' => $UserData->student_name, 
            'class' => $studentClassData->class_display_name ?? null,
            'section' => $studentClassData->section ?? null,
            'rollno' => $UserData->rollno, 
            'dob' => $UserData->dob,
            'gender' => $UserData->gender
        ];


        $formatReportData = function($reportData) use (&$dailyReportCard) {

            foreach($reportData as $key => $data){
                $dailyReportCard['reportCardDetails'][$data->name][] = [
                    'date'  => $data->date,
                    'period' => $data->period,
                    'activity'  => $data->activity,
                    'activity_id' => $data->activity_id,
                    'skillsport'  => $data->skillsport,
                    'techniques'  => $data->techniques,
                    'image' => $data->image,
                    'level' => $data->level, 
                    'level_name'  => $data->level_name,             
                ];
            }
        };



        if($request->ajax()){
            $termId = $request->post('session_term_id');
            $reportCardDetail = DB::select('CALL getStudentsReportTermWize(?, ?)', [$UserData->id, $termId]);           
            $formatReportData($reportCardDetail);
            $html = view('parent.partials.daily_tracker_details', compact('dailyReportCard'))->render();
            return response()->json(['html' => $html]);
        }

        $termId = TermMaster::where('school_id', $school_id)->where('is_active', 1)->whereDate('term_start_date', '<=', today())
                ->whereDate('term_end_date', '>=', today())->value('id');
        $reportCardDetail = DB::select('CALL getStudentsReportTermWize(?, ?)', [$UserData->id, $termId]);
        $formatReportData($reportCardDetail);

        
        $title = 'Daily Tracker'; 
        return view('parent.dailytracker2', compact('title','dailyReportCard','SessionAndTerm'));
    }


    public function dailyReport(Request $request) { 

        $termId = $request->query('term_id');
        $UserData = Auth::guard('student-api')->user();
        $school_id = $UserData->school_id;

        $SessionAndTerm = TermMaster::where('school_id', $school_id)
            ->where('is_active', 1)
            ->select('id', 'term_name', 'academic_year')
            ->get();

        $studentClassData = DB::table('custom_classes')
            ->join('class', 'class.id', '=', 'custom_classes.class_id')
            ->where('custom_classes.id', $UserData->custom_class_id)
            ->select('custom_classes.class_id','custom_classes.id', DB::raw("CASE 
                                WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                                THEN custom_classes.nomenclature 
                                ELSE class.name 
                            END AS class_display_name"),
                     'custom_classes.section')
            ->first();

        $termId = $termId ?? TermMaster::where('school_id', $school_id)
                    ->where('is_active', 1)
                    ->whereDate('term_start_date', '<=', today())
                    ->whereDate('term_end_date', '>=', today())
                    ->value('id');

        $reportCardDetail = DB::select('CALL getStudentsReportTermWize(?, ?)', [$UserData->id, $termId]);

       
        $sections = [];
        foreach ($reportCardDetail as $data) {
            $categoryName = $data->name;
            
            if (!isset($sections[$categoryName])) {
                $sections[$categoryName] = [
                    'title' => $categoryName,
                    'data' => []
                ];
            }
            $imageUrl = '';
            if($data->image){
                if (str_starts_with($data->image, 'https')) {
                   $imageUrl = $data->image;
                }else{
                    $imageUrl = 'https://nep.goforfit.in/public/uploads/'.$data->image;
                }
            }else{
                $imageUrl = 'https://nep.goforfit.in/public/change-activities/default_activity_img.svg';
            }
            
            $sections[$categoryName]['data'][] = [
                'id' => (string)$data->activity_id,
                'date' => $data->date ? (new DateTime($data->date))->format('d-m-Y') : null,
                'class_id' =>$studentClassData->class_id,
                'period' => $data->period,
                'title' => $data->activity,
                'skillType' => $data->skillsport,
                'technique' => $data->techniques,
                'imageUrl' => $imageUrl,
                'levelValue' => (int)$data->level,
                'levelStatus' => $data->level_name,
                'rating' => (int)$data->level 
            ];
        }


        $class = Helper::changeToRoman($studentClassData->id);

        return response()->json([
            'studentProfile' => [
                'name' => $UserData->student_name, 
                'class_info' => $class ?? null,
                'rollno' => $UserData->rollno,
            ],
            'terms' => $SessionAndTerm,
            'reportSections' => array_values($sections) // Reset keys for JSON array format
        ]);
    }




    

}