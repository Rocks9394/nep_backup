<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use App\Helpers\Helper;
use App\Models\TermMaster;
use App\Traits\ReportHelperTrait;
 
use Illuminate\Contracts\View\Factory as ViewFactory;

class StudentDashboardController extends Controller
{
	use ReportHelperTrait;
	
	function __construct()
	{
		$this->middleware('auth.auth_student')->except(['dashboard','ViewFitnessReport','getPerformance','getBmiBenchmark','getBenchmark','formatBenchmarks','formatRange','formatValue']);;
        
	}	

    public function dashboard(){
        $title = "Student Dashboard";
        // $studentId = Auth::guard('sstudent')->user()->id;

        $studentId = null;
        
        if (Session::has('student_id')) {
            $studentId = Session::get('student_id');
        }else{
            $studentId = Auth::guard('sstudent')->user()->id;
        }

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

			// 'class.name AS classname'
		)
		->where('class.id', $classId)
		->Where('school_id', $SchoolId)
		->orderBy('custom_classes.orders', 'ASC')
		->get();

        $fmsApplicable = DB::table('class_fitness_tests')
            ->where('class_id', $classId)
            ->pluck('test_type_id')
            ->toArray();

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


        // dd($fmsTestData);

        
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

        foreach ($fitnessTest as $item) {
            $level = $item->level;
            $item->levelOutcome = $levelLabels[$level] ?? 'Unknown';
        }

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
        

        $getFitnessBenchmark = $this->getBenchmark($studentAge, $categoty, $categories_id2);


        $year = date('Y');
		$month = date('m');
		$day = date('d');
		$today = Carbon::today()->toDateString();
		if ($month < 4 || ($month == 3 && $day <= 31)) {
			$academicYear = ($year - 1) . '-' . $year;
		}

		$terms = TermMaster::where('school_id', $SchoolId)
            ->where('is_active', 1)
            ->where('academic_year', $academicYear)
			->get();

		$currentTerm = DB::table('term_masters')
			->select('id', 'term_name', 'academic_year', 'term_start_date', 'term_end_date')
			->where('school_id', $SchoolId)
			->where('is_active', '1')
			->where('academic_year', $academicYear)
			->whereDate('term_start_date', '<=', $today)
			->whereDate('term_end_date', '>=', $today)
			->first();

			$selectedTerm = session('term_id', $currentTerm->id);

        
        return view('parent.student-dashboard', compact('title', 'getBmiBenchmark', 'studentData', 'studentAge', 'getFitnessBenchmark', 'bmiRecord','class','classId','fmsTestData','fitnessTest', 'terms', 'selectedTerm'));
    }
}
