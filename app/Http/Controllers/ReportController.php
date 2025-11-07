<?php


namespace App\Http\Controllers;
ini_set('memory_limit','1024M');

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Sclass;
use App\Models\Sstudent;
use App\Models\Report;


class ReportController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
	    $school = School::with([
	        'getClasses.classRelation',
	        'getStudents.classRelation',
	        'getStudents.studentReports.skillArea',
	        'getStudents.studentReports.sport',
	        'getStudents.studentReports.technique',
	        'getStudents.studentReports.activity'
	    ])->findOrFail(2823);


	    echo "<pre>"; print_r($school);exit();
	    
	  
	    $classList = $school->getClasses->map(function ($class) {
	        $class->name = $class->classRelation->name ?? 'N/A';
	        return $class;
	    })->sortBy('name');

	    
	    $students = $school->getStudents()
	        ->take(10)
	        ->map(function ($student) {
	            $student->class = $student->classRelation->name ?? 'N/A';
	            
	       
	            $student->reports = $student->studentReports->map(function ($report) {
	                return [
	                    'skill_area_id' => $report->skillArea->name ?? 'N/A',
	                    'skill_sports_id' => $report->sport->name ?? 'N/A',
	                    'technique_id' => $report->technique->name ?? 'N/A',
	                    'activity_id' => $report->activity->title ?? 'N/A',
	                ];
	            });
	            
	            return $student;
	        });

	    $title = "Skill Report";
	    return view('reports.SkillReport', compact('title', 'classList', 'students'));
	}


    public function index_bkup()
	{
	    $school = School::find(2823);
	    $classList = $school->getClasses;

	    foreach ($classList as $class) {
	        $class->name = Sclass::where('id', $class->class_id)->orderBy('name')->first()->name;
	    }

	    

	    $students = $school->getStudents;

	    foreach ($students as $data) {
	        $data->class = Sclass::where('id', $data->class_id)->orderBy('name')->first()->name;
	        $studentsReport = Sstudent::find($data->id)->StudentReport;

	        foreach ($studentsReport as $report) {
	            $reportRecords = Report::find($report->id);
	            $reportelements['skill_area_id'] = optional($reportRecords->skillArea)->name;
	            $reportelements['skill_sports_id'] = optional($reportRecords->sport)->name;
	            $reportelements['technique_id'] = optional($reportRecords->technique)->name;
	            $reportelements['activity_id'] = optional($reportRecords->activity)->title;
	            $report->records = $reportelements;
	        }

	        $data->reports = $studentsReport;
	    }

	    $title = "Skill Report";
	    return view('reports.SkillReport', compact('title', 'classList', 'students')); 
	}




    public function index_bk(){


    	$school = School::find(2823);
    	$classList = $school->getClasses;

		foreach ($classList as $class) {
		    $class->name = Sclass::where('id', $class->class_id)->orderBy('name')->first()->name;
		}
		$students = $school->getStudents;

		// $reportelements = [];
		foreach ($students as $data) {

			$data->class = Sclass::where('id', $data->class_id)->orderBy('name')->first()->name;
			$studentsReport = Sstudent::find($data->id)->StudentReport;
		    $data->reports = $studentsReport;
		    
		    foreach($studentsReport as $report){
		    	$reportRecords = Report::find($report->id);
				$reportelements['skill_area_id'] = $reportRecords->skillArea->name;
				$reportelements['skill_sports_id'] = $reportRecords->sport->name;
				$reportelements['technique_id'] = $reportRecords->technique->name;
				$reportelements['activity_id'] = $reportRecords->activity->title;
				$report->records = $reportelements;
		    }
		}

		//echo "<pre>";print_r($students);exit(); 

	

    	$title = "Skill Report";
    	return view('reports.SkillReport',compact('title','classList','students'));
    }
	

	function StudentReport(Request $request)
	{
		$title = 'Student Report';

		//$studentId = $request->sid;

		$studentId = 11;
	

		$getReport = DB::table('reports')
		->select('student_name', 'gender', 'dob', 'email_id', 'reports.*', 'class.name as classname', 'section', 'title', 'learning_outcomes', 'level_name', 'levels.orders as rating')
		->join('students','students.id','=','reports.student_id')
		->join('custom_classes','custom_classes.id','=','reports.custom_class_id')
		->join('class','class.id','=','reports.class_id')
		->join('activity','activity.id','=','reports.activity_id')
		->join('levels','levels.id','=','reports.level')
		->where('student_id', $studentId)
		->get();

		$getSports = DB::table('reports')
		->select('skill_sports_id','sports.name as sportsskillname', DB::raw('count(*) as total'))
		->join('sports','sports.id','=','reports.skill_sports_id')
		->groupBy('skill_sports_id')
		->where('student_id', $studentId)
		->get();

		$getSkills = [];

        foreach($getSports as $key => $val)
		{
			$getSkills[] = DB::table('reports')
			->select('title', 'learning_outcomes', 'level_name', 'levels.orders as rating','skill_sports_id')
			->join('activity','activity.id','=','reports.activity_id')
			->join('levels','levels.id','=','reports.level')
			->where('student_id', $studentId)
			->where('skill_sports_id', $val->skill_sports_id)
			->get();

		}

		//SELECT skill_sports_id as total FROM `reports` WHERE student_id = 11 GROUP BY skill_sports_id;
		return view('fill-darts.reports', compact('title', 'getReport', 'getSports', 'getSkills'));

	}

}
