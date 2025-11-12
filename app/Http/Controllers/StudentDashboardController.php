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
        // dd($SchoolId);

        $bmiRecord = DB::table('SeniorTestResults as str')
        ->join('term_masters as tm', 'tm.id', '=', 'str.TermId')
        ->select('str.height', 'str.weight', 'str.score', 'str.level')
        ->where('str.TestTypeID', 18)
        ->where('str.StudentID', $studentId)
        ->whereDate('tm.term_start_date', '<=', today())
		->whereDate('tm.term_end_date', '>=', today())
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

        $fmsTestData = DB::table('class_fitness_tests')
        ->join('TestTypeMaster', 'TestTypeMaster.TestTypeID', '=', 'class_fitness_tests.test_type_id')
        ->join('skill_reports', 'skill_reports.TestTypeMasterID', '=', 'TestTypeMaster.TestTypeID')
        ->leftJoin('skillreport_skilltype_termtype_mapping as sst', function($join) use ($studentId) {
            $join->on('sst.skill_report_id', '=', 'skill_reports.id')
            ->where('sst.student_id', '=', $studentId);
        })
        ->join('term_masters as tm', 'tm.id', '=', 'sst.term_master_id')
        ->select(
            'class_fitness_tests.test_type_id',
            'skill_reports.skill_name',
            'skill_reports.icons',
            'class_fitness_tests.class_id',
            'skill_reports.id as skill_report_id',
            DB::raw('COUNT(sst.id) as score')
        )
        ->where('class_fitness_tests.class_id', $classId)        
        ->whereDate('tm.term_start_date', '<=', today())
		->whereDate('tm.term_end_date', '>=', today())
        ->groupBy(
            'class_fitness_tests.test_type_id',
            'skill_reports.skill_name',
            'class_fitness_tests.class_id',
            'skill_reports.id'
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

        $path = public_path("assets/css/student_dashboard_style");

		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
        // $studentId = 6968;

        $fitnessTest = DB::table('SeniorTestResults as str')
            ->join('skill_reports', 'skill_reports.id', '=', 'str.TestTypeID')
            ->join('term_masters as tm', 'tm.id', '=', 'str.TermId')
            ->where('str.StudentID', $studentId)
            ->whereDate('tm.term_start_date', '<=', today())
            ->whereDate('tm.term_end_date', '>=', today())
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

            // dd($fitnessTest);

        
        return view('parent.testDashboard', compact('title', 'getBmiBenchmark', 'studentData', 'studentAge', 'bmiRecord','class','classId','fmsTestData','fitnessTest'));
    }
}
