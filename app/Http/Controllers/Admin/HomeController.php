<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Activityrelation;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\Sclass;
use DB;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){

        $excludedSchools = ['AK001'];

        $baseQuery = DB::table('schools_assessment as s')
            ->whereNotIn('s.school_code', $excludedSchools);
        
        $regSchools = $baseQuery->count('s.school_code');
        $regTrainers = DB::table('users')->where('role_id', 3)->count('id');

        $completedSchools = (clone $baseQuery)
            ->whereColumn('s.registered_students', 's.completed')
            ->where('s.registered_students', '>', 0)
            ->count();

        $ongoingSchools = (clone $baseQuery)
            ->where('s.ongoing', '>', 0)
            ->count();

        $yetToStartSchools = (clone $baseQuery)
            ->whereColumn('s.registered_students', 's.yet_to_start')
            ->where('s.registered_students', '>', 0)
            ->count();

        $totals = (clone $baseQuery)
            ->selectRaw('
                COALESCE(SUM(s.registered_students),0) as total_students,
                COALESCE(SUM(s.completed),0) as total_completed,
                COALESCE(SUM(s.ongoing),0) as total_ongoing,
                COALESCE(SUM(s.yet_to_start),0) as total_yet_to_start
            ')
            ->first();

        $topSchools = (clone $baseQuery)
            ->get();

		$healthData = DB::table('SeniorTestResults')
		->join('students','students.id', '=', 'SeniorTestResults.StudentID')
		->join('class','class.id', '=', 'students.class_id')
		->join('term_masters','term_masters.school_id', '=', 'SeniorTestResults.SchoolID')
		->select('LEVEL', DB::raw('COUNT(StudentID) AS Total_Student'))
		->whereDate('term_start_date', '<=', now())
		->whereDate('term_end_date', '>=', now())
		->whereIn('LEVEL', ['UW', 'N', 'OW', 'OB'])
		->groupBy('LEVEL')
		->orderByRaw("FIELD(LEVEL, 'UW', 'N', 'OW', 'OB')")
		->get();

		

		$data = DB::table('SeniorTestResults as str')
			->join('skill_reports as sr', 'sr.id', '=', 'str.TestTypeID')
			->join('students', 'students.id', '=', 'str.StudentID')
			// ->join('term_masters', 'term_masters.school_id', '=', 'str.SchoolID')
			->select('sr.skill_name', 'str.level', DB::raw('COUNT(StudentID) as total'))
			// ->whereDate('term_start_date', '<=', now())
			// ->whereDate('term_end_date', '>=', now())
			->whereIn('str.TestTypeID', [16, 17, 19, 20, 21, 22, 23])
			->whereNotNull('str.level')
			->whereNotIn('str.level', ['', 'N.A.'])
			->whereRaw("str.level REGEXP '^L[0-8]+$'")
			->groupBy('sr.skill_name', 'str.level')
			->orderBy('sr.skill_name')
			->orderByRaw("CAST(SUBSTRING(str.level, 2) AS UNSIGNED)")
			->get();

		// echo"<pre>";print_r($data);exit();

		$skills = [];
		$levels = [];
		$matrix = [];

		foreach ($data as $row) {
			$skills[$row->skill_name] = true;
			$levels[$row->level] = true;
			$matrix[$row->skill_name][$row->level] = (int)$row->total;
		}

		$categories = array_keys($skills);

		$levelNames = array_keys($levels);
		usort($levelNames, function ($a, $b) {
			return (int) substr($a, 1) <=> (int) substr($b, 1);
		});

		$levelColors = [
			'L0' => '#01160a',
			'L1' => '#fe4a5d',
			'L2' => '#ffaa62',
			'L3' => '#ffd26e',
			'L4' => '#74c4d6',
			'L5' => '#a3d55f',
			'L6' => '#6bc04b',
			'L7' => '#00953b',
			'L8' => '#01160a',
		];

		// Prepare full chart series for all skills
		$chartSeries = [];
		foreach ($levelNames as $level) {
			$rowData = [];
			foreach ($categories as $skill) {
				$rowData[] = $matrix[$skill][$level] ?? 0;
			}
			$chartSeries[] = [
				'name' => $level,
				'data' => $rowData,
				'color' => $levelColors[$level] ?? '#000000'
			];
		}

        return view('admin.home', [
            'regSchools' => $regSchools,
            'regTrainers' => $regTrainers,
            'completedSchools' => $completedSchools,
            'ongoingSchools' => $ongoingSchools,
            'yetToStartSchools' => $yetToStartSchools,
            'totalStudents' => $totals->total_students,
            'totalCompleted' => $totals->total_completed,
            'totalOngoing' => $totals->total_ongoing,
            'totalYetToStart' => $totals->total_yet_to_start,
            'topSchools' => $topSchools,
			'healthData' => $healthData,
			'categories' => $categories,
			'levelNames' => $levelNames,
			'levelColors' => $levelColors,
			'chartSeries' => $chartSeries,
			'matrix' => $matrix,
        ]);
    }

    public function gets_subject(Request $request){
		
		$subjects = DB::table('class_subject as A')
                ->select('A.subject_id', 'B.name')
				->leftjoin('subject as B', function($join) {
                    $join->on('B.id', '=', 'A.subject_id');
                })
                ->where('A.class_id', $request->class_id)
                ->get();
		
		$csub = '<option value="">--Select--</option>';
		
			if(!empty($subjects)){
				foreach($subjects as $csb){ 			
					//print_r($csb->subject_id); print_r($csb->name);	 echo '<br>';				
					$csub .= '<option value="'.$csb->subject_id.'">'.$csb->name.'</option>';
				}
			}
				
        return $csub;		
	}

    public function get_chapters(Request $request){		    	
			

		$subjects = DB::table('chapter as A')
                ->select('A.id', 'A.name')
				->where('A.subject_id', $request->subject_id)
				->where('A.class_id', $request->class_id)
				->get();
		
		$csub = '<option value="">--Select--</option>';
		
			if(!empty($subjects)){
				foreach($subjects as $csb){ 			
					//print_r($csb->subject_id); print_r($csb->name);	 echo '<br>';				
					$csub .= '<option value="'.$csb->id.'">'.$csb->name.'</option>';
				}
			}
				
        return $csub;		
    }   		
	
	public function get_concepts(Request $request){		

		$subjects = DB::table('concept as A')
                ->select('A.id', 'A.name')
				->where('A.chapter_id', $request->chapter_id)
				->where('A.class_id', $request->class_id)
				->where('A.subject_id', $request->subject_id)
                ->get();
		
		$csub = '<option value="">--Select--</option>';
		
			if(!empty($subjects)){
				foreach($subjects as $csb){ 			
					//print_r($csb->subject_id); print_r($csb->name);	 echo '<br>';				
					$csub .= '<option value="'.$csb->id.'">'.$csb->name.'</option>';
				}
			}
				
        return $csub;
    }   		
		
	public function getconcepts(Request $request){	
		$cp_id = $request->cp_id;	   
		$data = json_decode($cp_id,true);
		$concept = Concept::whereIn('chapter_id', $data)->orderby('name', 'asc')->get();
		
		$sub = '';
		
		if(!empty($concept)){
			foreach($concept as $sb){              
			   $sub.='<option value="'.$sb['id'].'">'.$sb['name'].'</option>';
			}
		} 
		
        return $sub;
    }
    
    public function getcheptors(Request $request){         
		 //dd($request->sub_id);die;		 
	    $sbj_id = $request->sub_id;	   
		$data = json_decode($sbj_id,true);
		$chapter = Chapter::whereIn('subject_id', $data)->orderby('name', 'asc')->get();

		$csub = '';
		if(!empty($chapter)){
			foreach($chapter as $csb){              
			   $csub .= '<option value="'.$csb['id'].'">'.$csb['name'].'</option>';
			}
		} 
		
        return $csub;
    }   
	
	

}
