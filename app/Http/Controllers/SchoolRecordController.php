<?php

namespace App\Http\Controllers;
ini_set('memory_limit','1024M');
use Illuminate\Http\Request;

use App\Models\Sclass;
use App\Models\Teachingthrough;
use App\Models\School;
use App\Models\Activity;
use App\Models\Report;
use DB;
use Response;
use Validator;
use Redirect;
use paginate;
use App\Models\User;
use App\Models\SchoolTrainer;
use Artisan;
use DataTables;
use Carbon\Carbon;
use Auth;
use App\Helpers\Helper;
use App\Models\Sstudent;
use App\Models\ScustomClass;
use App\Models\Region;
use App\Models\Board;
use Session;
use Illuminate\Support\Facades\Cookie;
use App\Models\SkillReportSkillTypeTermTypeMapping;
use Dompdf\Dompdf;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportStudentProfile;
use App\Exports\ExportImproperData;
use App\Models\Sport; 
use App\Models\ViewDart;
use App\Models\Teacher;
use App\Models\State;
use App\Models\District;

use App\Contracts\EmailServiceInterface;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Usermeta;
use App\Models\TermMaster;
use App\Traits\ReportHelperTrait;

use App\Exports\StudentsCredentialsExport;
use App\Exports\SchoolUserCredentials;
use App\Exports\TrainerCredentials;
use App\Models\DashboardModule;
use App\Services\DataTableListService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SchoolRecordController extends Controller
{
	use ReportHelperTrait;
	
	public function __construct()
	{
        $this->middleware('auth:web');
    }
	
	public function SchoolDashboardGraph() 
	{
		
		$title = 'Dashboard Graph';
		
		
		$userId  = Auth::user()->id;
		$role_id =  \Auth::user()->role_id;
	
		$schoolId = 0;
		
		if($role_id == 4)
		{
			
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
			
			
			// i got the active students only [not got the transfer students]
			$studentscount = DB::table('schools')
			->join('students', 'students.school_id', '=' , 'schools.id') 
			->where('schools.id', $schoolId)
			->where('students.status','=', 1)
			->count();
			
			
		
			/*
			
			//Test1- For Fitness
			
			$resultTESTING = DB::table('SeniorTestResults')
			->join('students','students.id', '=', 'SeniorTestResults.StudentID')
			->join('class','class.id', '=', 'students.class_id')
			->join('term_masters','term_masters.school_id', '=', 'SeniorTestResults.SchoolID')
			->select('LEVEL', DB::raw('COUNT(*) as total'))
			->where('SeniorTestResults.SchoolID', $schoolId)
			->whereBetween('class.id', [4, 12])
			//->where('TermId', 7)
			->whereDate('term_start_date', '<=', now())
			->whereDate('term_end_date', '>=', now())
			//->where('class.id', 3)
			->whereRaw("LEVEL REGEXP '^L[1-7]+$'")
			->whereIn('TestTypeID', [19, 20, 21, 22, 23])
			->groupBy('LEVEL')
			->orderByRaw("CAST(SUBSTRING(LEVEL, 2) AS UNSIGNED)")
			->get();
			
			
			
			*/
			
			/**/
			
					
	
			$result = DB::table('SeniorTestResults')
			->join('students','students.id', '=', 'SeniorTestResults.StudentID')
			->join('class','class.id', '=', 'students.class_id')
			->join('term_masters','term_masters.school_id', '=', 'SeniorTestResults.SchoolID')
			->select('LEVEL', DB::raw('COUNT(*) as total'))
			->where('SeniorTestResults.SchoolID', $schoolId)
			->whereDate('term_start_date', '<=', now())
			->whereDate('term_end_date', '>=', now())
			->groupBy('LEVEL');
			
			
			$resultLevel = (clone $result)
			->whereBetween('class.id', [4, 12])
			->whereRaw("LEVEL REGEXP '^L[0-8]+$'")
			->whereIn('TestTypeID', [16, 17, 19, 20, 21, 22, 23])
			->orderByRaw("CAST(SUBSTRING(LEVEL, 2) AS UNSIGNED)")
			->get();
			
			
			#echo "<pre>";
			#print_r($resultLevel);
			#die('---change the detail bhawani pilani---');
			
				
			$graph1levels = [];
			$percentages = [];

			foreach ($resultLevel as $roww) 
			{
				$graph1levels[] = $roww->LEVEL;

				// avoid divide-by-zero drama
				//$percentage = $studentscount > 0 ? (int) round(($roww->total / $studentscount) * 100): 0;
				
				$percentage = $studentscount > 0 ? (int) round($roww->total): 0;

				$percentages[] = $percentage;
			}
			
			
			$resulthealth = (clone $result)
			->whereBetween('class.id', [1, 23])
			//->where('class.id', 14)
			->whereIn('LEVEL', ['UW', 'N', 'OW', 'OB'])
			->orderByRaw("FIELD(LEVEL, 'UW', 'N', 'OW', 'OB')")
			->get();
			
			
			
			
					
			
			//Test2- For health
			
			/*$resultHealthTESTING = DB::table('SeniorTestResults')
			->join('students','students.id', '=', 'SeniorTestResults.StudentID')
			->join('class','class.id', '=', 'students.class_id')
			->join('term_masters','term_masters.school_id', '=', 'SeniorTestResults.SchoolID')
			->select('LEVEL', DB::raw('COUNT(*) as total'))
			->where('SeniorTestResults.SchoolID', $schoolId)
			//->whereBetween('class.id', [4, 12])
			->where('TermId', 7)
			//->whereDate('term_start_date', '<=', now())
			//->whereDate('term_end_date', '>=', now())
			->where('students.class_id', 1)
			->whereIn('LEVEL', ['UW', 'N', 'OW', 'OB'])
			->groupBy('LEVEL')
			->orderByRaw("FIELD(LEVEL, 'UW', 'N', 'OW', 'OB')")
			->get();*/
			
			
			/*echo "<pre>";
			print_r($resultHealthTESTING);
			die('---change the detail bhawani pilani---');*/
			
			
			
			
			$healthLevels = [];
			$healthPercentages = [];

			foreach ($resulthealth as $rowH) 
			{
				$healthLevels[] = $rowH->LEVEL;

				#$percentageHlt = $studentscount > 0 ? (int) round(($rowH->total / $studentscount) * 100): 0;
				$percentageHlt = (int) round($rowH->total);

				$healthPercentages[] = $percentageHlt;
			}

		
	
			//die('--you are not a teacher. teacher can only access--');
		}
		else
		{
			die('--you dont have access for this panel. sorry for inconvenation--');
		}
		
			
		
	
		/* 1st graph value */
		$letnenlevels 	 =  $graph1levels;
		 $letnentotals   =  $percentages;
		
		/* 2nd graph value */
		$healthLevels    =  $healthLevels;
		$healthTotals    =  $healthPercentages;
		
	

		$resultRRR = DB::table('SeniorTestResults')
		->join('students','students.id', '=', 'SeniorTestResults.StudentID')
		->join('class','class.id', '=', 'students.class_id')
		->join('term_masters','term_masters.school_id', '=', 'SeniorTestResults.SchoolID')
		->select('LEVEL', DB::raw('COUNT(StudentID) AS Total_Student'))
		->whereDate('term_start_date', '<=', now())
		->whereDate('term_end_date', '>=', now())
		->whereRaw("LEVEL REGEXP '^L[0-8]+$'")
		->groupBy('LEVEL')
		->orderByRaw("CAST(SUBSTRING(LEVEL, 2) AS UNSIGNED)")
		->get();

		// Prepare data for Highcharts
		$ranked_schoolsFitness = $resultRRR->pluck('Total_Student')->toArray();
	
		

		$resultRRRHealth = DB::table('SeniorTestResults')
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

		// Prepare data for your Highchart
		$healthRankData = $resultRRRHealth->pluck('Total_Student')->toArray();
		
		
		
		
			/* third graph */
			
			/*$data = DB::table('SeniorTestResults as str')
			->join('skill_reports as sr', 'sr.id', '=', 'str.TestTypeID')
			->select(
			'sr.skill_name',
			'str.level',
			DB::raw('COUNT(*) as total')
			)
			->where('str.SchoolID', $schoolId)
			->whereIn('str.TestTypeID', [19, 20, 21, 22, 23])
			->whereNotNull('str.level')
			->whereNotIn('str.level', ['', 'N.A.'])
			->whereRaw("LEVEL REGEXP '^L[1-7]+$'")
			->groupBy('sr.skill_name', 'str.level')
			->orderBy('sr.skill_name')
			->orderByRaw("CAST(SUBSTRING(str.level, 2) AS UNSIGNED)")
			->get();
			
			
			$levels = [];
			$series = [];

			foreach ($data as $row) 
			{
				$levels[$row->level] = true;
				$series[$row->skill_name][$row->level] = $row->total;
			}
			
		
			$categories = array_keys($levels);			
			sort($categories);
			


			$chartSeries = [];

			foreach ($series as $skill => $values) 
			{
				$rowData = [];
				foreach ($categories as $level) 
				{
					$rowData[] = $values[$level] ?? 0; // fill missing levels
			    }
			

				$chartSeries[] = 
				[
					'name' => $skill,
					'data' => $rowData
				];
			}*/
			
		
		

	
	
		
		
		// -------------------------------------
		// 1. Fetch data from DB
		// -------------------------------------
		$data = DB::table('SeniorTestResults as str')
			->join('skill_reports as sr', 'sr.id', '=', 'str.TestTypeID')
			->join('students','students.id', '=', 'str.StudentID')
			->join('class','class.id', '=', 'students.class_id')
			->join('term_masters','term_masters.school_id', '=', 'str.SchoolID')
			->select('sr.skill_name','str.level',DB::raw('COUNT(*) as total'))
			->where('str.SchoolID', $schoolId)
			->whereBetween('class.id', [4, 12])
			->whereDate('term_start_date', '<=', now())
			->whereDate('term_end_date', '>=', now())
			->whereIn('str.TestTypeID', [16, 17, 19, 20, 21, 22, 23])
			->whereNotNull('str.level')
			->whereNotIn('str.level', ['', 'N.A.'])
			->whereRaw("str.level REGEXP '^L[0-8]+$'")
			->groupBy('sr.skill_name', 'str.level')
			->orderBy('sr.skill_name')
			->orderByRaw("CAST(SUBSTRING(str.level, 2) AS UNSIGNED)")
			->get();
			
			
			#echo "<pre>";
			#print_r($data);
			#die('---change the detail---');


		// -------------------------------------
		// 2. Prepare containers
		// -------------------------------------
		$skills = [];
		$levels = [];
		$matrix = [];


		// -------------------------------------
		// 3. Normalize data
		//    matrix[skill][level] = total
		// -------------------------------------
		foreach ($data as $row) {
			$skills[$row->skill_name] = true;
			$levels[$row->level] = true;
			$matrix[$row->skill_name][$row->level] = (int) $row->total;
		}


		// -------------------------------------
		// 4. X-axis categories (skills)
		// -------------------------------------
		$categories = array_keys($skills);


		// -------------------------------------
		// 5. Sort levels L1 → L7
		// -------------------------------------
		$levelNames = array_keys($levels);
		usort($levelNames, function ($a, $b) {
			return (int) substr($a, 1) <=> (int) substr($b, 1);
		});


		// -------------------------------------
		// 6. Define colors per level
		// -------------------------------------
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


		// -------------------------------------
		// 7. Build Highcharts series
		//    SERIES = LEVEL WISE (IMPORTANT FIX)
		// -------------------------------------
		$chartSeries = [];

		foreach ($levelNames as $level) {
			$rowData = [];

			foreach ($categories as $skill) {
				$rowData[] = $matrix[$skill][$level] ?? 0;
			}

			$chartSeries[] = [
				'name'  => $level,                        // ✅ REQUIRED
				'data'  => $rowData,
				'color' => $levelColors[$level] ?? '#000000'
			];
		}


		// -------------------------------------
		// 8. Final output (send to view / debug)
		// -------------------------------------
		/*echo '<pre>';
		print_r([
			'categories'  => $categories,
			'chartSeries' => $chartSeries
		]);
		exit;*/
		

    	return view('school.graph-dashboard', compact('title', 'letnenlevels', 'letnentotals', 'ranked_schoolsFitness', 'healthLevels', 'healthTotals', 'healthRankData', 'categories', 'chartSeries')); 
			
	}

    public function SchoolDashboard() 
	{
		
		$dates = Helper::LastTwoDates();
		#echo "<pre>";
		#print_r($dates);
		$fromDate = $dates[1];
		$toDate   = $dates[0];
		#die('---change the detail----');
    	$userId  = Auth::user()->id;
		$role_id =  \Auth::user()->role_id;
	
		$schoolId = 0;
		
		if($role_id == 4 || $role_id == 2)
		{
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
			Session::put('SelectSchoolId',$schoolId);
			//die('--you are not a teacher. teacher can only access--');
		}
		else
		{
			die('--you dont have access for this panel. sorry for inconvenation--');
		}
		
		
		

		$SchoolData = [];
		$SchoolData['students'] = $students = DB::table('schools')
			->join('students', 'students.school_id', '=' , 'schools.id') 
			->select('schools.id as schools_id', 'students.id as student_id', 'students.gender', 'students.class_id' ,'students.section_id')
			->where('schools.id', $schoolId)
			->where('students.status','<>','transfer')
			->get();


		$SchoolData['activeSession'] =  $activeSession = DB::table('schools')
			->select(
				'schools.id as schools_id',
				'school_trainers.trainer_id',
				'reports.custom_class_id',
				'reports.date',
				'reports.activity_id',
				'reports.skill_area_id',
				'reports.skill_sports_id',
				'users.name as TrainerName'
			)
			->join('school_trainers','school_trainers.school_id','=','schools.id')
			->join('reports','reports.submitted_by','=','school_trainers.trainer_id')
			->join('users', 'users.id' ,'=' , 'school_trainers.trainer_id')
			->where('school_trainers.status' , 1)
			->where('schools.id', $schoolId)
			->groupBy('schools_id','school_trainers.trainer_id','reports.custom_class_id','reports.period', 'reports.date', 'reports.activity_id','reports.skill_area_id','reports.skill_sports_id','TrainerName')
			//->distinct()
			->get();

	
		$trainerActivities = [];
		foreach ($activeSession as $session) 
		{
		    $trainerId = $session->trainer_id;
		    $date = $session->date;

		    if (!isset($trainerActivities[$trainerId])) 
			{
		        $trainerActivities[$trainerId] = [
		            'trainer_id' => $trainerId,
		            'total_activities' => 0,
		            'days_active' => [],
		            'TrainerName' => $session->TrainerName,
		        ];
		    }

		    $trainerActivities[$trainerId]['total_activities']++;
		    $trainerActivities[$trainerId]['days_active'][$date] = true;
		}

		foreach ($trainerActivities as &$data) {
		    $data['days_active'] = count($data['days_active']);
		}

		
		
		$SchoolData['Classes'] = $classes = DB::table('schools')
			->select('schools.id as schools_id', 'custom_classes.id as custom_class_id' ,'custom_classes.class_id','custom_classes.section',

				DB::raw("CASE 
                    WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                    THEN custom_classes.nomenclature 
                    ELSE class.name 
                 END AS class"),

				// 'class.name as class',

				'students.id','students.gender')
			->join('custom_classes','custom_classes.school_id', '=' , 'schools.id')
			->join('class','class.id', '=' , 'custom_classes.class_id')
			->join('students','students.custom_class_id','=' ,'custom_classes.id')
			->where('students.school_id', $schoolId)
			->where('schools.id', $schoolId)
			->where('students.status','active')
			->get();
			
			

		
		$classData = [];
		foreach ($SchoolData['Classes'] as $row) {
		    $classKey = $row->class_id . '-' . $row->section;

		    if (!isset($classData[$classKey])) 
			{
		        $classData[$classKey] = [
		        	'class_id' => $row->class_id,
		            'class' => $row->class,
		            'section' => $row->section,
		            'total_students' => 0,
		            'total_boys' => 0,
		            'total_girls' => 0,
		            'custom_class_id' => $row->custom_class_id,
		        ];
		    }

		    $classData[$classKey]['total_students']++;
		    if ($row->gender == 'Male') {
		        $classData[$classKey]['total_boys']++;
		    } elseif ($row->gender == 'Female') {
		        $classData[$classKey]['total_girls']++;
		    }
		}

		$customOrder = [
		    'Pre-Nursery' => 1,
		    'Nursery'     => 2,
		    'LKG'         => 3,
		    'UKG'         => 4,
		];

		/*uasort($classData, function ($a, $b) use ($customOrder) {
		    $aWeight = $customOrder[$a['class']] ?? 100 + (int)$a['class_id'];
		    $bWeight = $customOrder[$b['class']] ?? 100 + (int)$b['class_id'];

		    // If weights are equal, sort by section
		    if ($aWeight === $bWeight) {
		        return strcmp($a['section'], $b['section']);
		    }

		    return $aWeight <=> $bWeight;
		});*/
		
		/*$SchoolData['lastReports'] = $lastReports = DB::table('schools')
		->select('schools.id as schools_id','reports.id as report_id', 'reports.custom_class_id', 'reports.date','reports.activity_id','activity.title')
		->join('school_trainers', 'school_trainers.school_id', '=', 'schools.id')
		->join('reports', 'reports.submitted_by', '=', 'school_trainers.trainer_id')
		->join('activity','activity.id', '=', 'reports.activity_id')
		->where('school_trainers.status', 1)
		->where('schools.id', $schoolId)
		->groupBy('schools_id','reports.custom_class_id', 'reports.date','reports.activity_id','activity.title','report_id')
		//->orderBy('reports.date', 'asc')
		->take(7)
		->get();*/
		
		
	/*	$latestActivity = DB::select("WITH ranked_reports AS (SELECT r.*, ROW_NUMBER() OVER (PARTITION BY r.date, r.activity_id ORDER BY STR_TO_DATE(r.date, '%d/%m/%Y') DESC, r.created_at DESC) as row_num FROM reports r)
SELECT r.id, r.date, a.title AS activity_name, r.created_at, r.updated_at
FROM ranked_reports r JOIN activity a ON r.activity_id = a.id WHERE r.row_num = 1
ORDER BY r.date DESC, r.created_at DESC LIMIT 7;
");*/


	$latestActivity = DB::table('reports')
		->select(
			'reports.date',
			'reports.custom_class_id',
			'reports.period',
			'reports.activity_id',
			'reports.submitted_by',
			'activity.title as activity_title',
			'users.name as submitted_by_name',
			'class.name as class_by_name'
		)
		->join('activity', 'activity.id', '=', 'reports.activity_id')
		->join('users', 'users.id', '=', 'reports.submitted_by')
		->join('class', 'class.id', '=', 'reports.class_id')
		->where('reports.school_id', $schoolId)
		->whereBetween('reports.date', [$fromDate,$toDate])
		->groupBy('reports.date', 'reports.custom_class_id', 'reports.period', 'reports.activity_id', 'reports.submitted_by','reports.class_id')
		->orderBy('reports.date', 'desc')
		->get();
		
		// echo "<pre>"; print_r($toDate);exit();

		/*
		$SchoolData['lastReports'] = $lastReports = DB::table('schools')
		->select('schools.id as schools_id',
			'school_trainers.trainer_id as trainer_id',
			'activity.title',
			'reports_unique.custom_class_id',
			'reports_unique.activity_id',
			 'reports_unique.date',
			'reports_unique.period',
		
			// DB::raw("DATE_FORMAT(reports_unique.date, '%d/%m/%Y') as formatted_date"),
			DB::raw("CONCAT(class.name , '-' ,  custom_classes.section) as class_name "),
			DB::raw("COUNT(reports_unique.id) as total_students_attended"),
		)

		->join('school_trainers', 'school_trainers.school_id', '=', 'schools.id')
		->join(DB::raw('(
	    	SELECT DISTINCT id,school_id,class_id,custom_class_id,period,date,skill_area_id,skill_sports_id,technique_id,activity_id,student_id,level,submitted_by ,status  FROM reports) AS reports_unique'), function($join) {
	        $join->on('reports_unique.submitted_by', '=', 'school_trainers.trainer_id');
	    })

		->join('custom_classes','custom_classes.id','=','reports_unique.custom_class_id')
		->join('class','class.id','=','custom_classes.class_id')

		->join('activity','activity.id','=','reports_unique.activity_id')

		->where('school_trainers.status', 1)
		->where('schools.id', $schoolId)

		->groupBy('schools_id',
			'trainer_id',
			// 'class.name',
			'reports_unique.custom_class_id',
			'reports_unique.activity_id',
			'activity.title',
			'reports_unique.date','reports_unique.period','reports_unique.id'
		)
		->orderBy('reports_unique.id', 'desc')
        ->take(10)
		->get();
		*/

		
		$PEActivityCount =  $activeSession = DB::table('schools')
		->select(
			'schools.id as schools_id',
			'reports.class_id',
			'reports.activity_id',
			'reports.skill_area_id',
			'reports.skill_sports_id',
			'skillareas.name as skillname'
		)
		->join('reports','reports.school_id','=','schools.id')
		->join('skillareas','skillareas.id','=','reports.skill_area_id')
		->where('schools.id', $schoolId)
		->groupBy('schools_id','reports.class_id', 'reports.activity_id','reports.skill_area_id','reports.skill_sports_id')
		->get();


		$SchoolUserId  =  \Auth::id();
		$schoolId = DB::table('school_reference') ->where('school_user_id', $SchoolUserId)->where('status', 1)->value('school_id');
		$school = School::findOrFail($schoolId);
		$schoolSportsCount = $school->sports->count();
		
		
		#echo "<pre>";
		#print_r($SchoolData);
		#die('----');
	
		
    	$title = 'Dashboard';
    	return view('school.dashboard', compact('title','SchoolData','classData','trainerActivities', 'latestActivity', 'PEActivityCount','schoolSportsCount')); 
    }


	// 23-09 school profile update function 

	public function viewProfile(){

        $title = 'Update Profile'; 
		$board_list  = Board::orderBy('boardname', 'asc')->get(); 
        $regions     = Region::orderBy('name', 'asc')->get(); 
        $states      = State::orderBy('name','asc')->get();
		$districts = DB::table('districts')->get();
    	$userId  = Auth::user()->id;

    	$schoolData = DB::table('school_reference')
    		->select(
    			'users.id as user_id',
    			'schools.id as id',
    			'schools.board',
    			'schools.school_code',
    			'schools.region',
    			'schools.state',
    			'schools.district',
    			'schools.city',
    			'schools.school_name',
    			'schools.school_email as s_email',
    			'schools.logo',
				'schools.school_url',
    			'schools.address as s_address',
				'schools.shift',

    			'schools.principal_phone as s_contact',

    			'schools.school_principal as p_name',
    			'users.email as p_email',
    			'users.phone as p_contact',
    			'users.position as p_designation',
    			'users.gender as p_gender',
    			'usermetas.signature'
    		)

    		->join('users','users.id','=', 'school_reference.school_user_id')
    		->join('schools','schools.id','=', 'school_reference.school_id')
			->join('usermetas', 'usermetas.user_id', '=', 'users.id')
    		->where('users.status', 1)
			->where('users.id', $userId)
    		->first();

			$year = date('Y');
			$month = date('m');
			$day = date('d');
			if ($month < 4 || ($month == 3 && $day <= 31)) {
				$academicYear = ($year - 1) . '-' . $year;
			} else {
				$academicYear = $year . '-' . ($year + 1);
			}


			$today = Carbon::today()->toDateString();

			$terms = DB::table('term_masters')
				->select('id', 'term_name', 'academic_year', 'term_start_date', 'term_end_date')
				->where('school_id', $schoolData->id)
				->where('is_active', '1')
				->where('academic_year', $academicYear)
				->get();
				

		return view('school.profile.index', compact('title','board_list','regions','states', 'districts', 'schoolData', 'academicYear', 'terms'));
    }


    /* updated code */
    public function updateProfile(Request $request, $id) {
		
		$request->validate([
			'region' => 'nullable',
			'state' => 'nullable',
			'district' => 'nullable',
			'city' => 'nullable|string',

			'school_code' => 'required|string|max:100',
			'school_name' => 'required|string|max:255',
			'school_shift' => 'nullable',
			'school_email' => 'nullable|email',
			'school_contact' => 'nullable|digits:10',
			'school_url' => 'nullable|string',
			'school_address' => 'required|string',
			
			'principalName' => 'required|string',
			'principalEmail' => 'required|email',
			'schoolAdminDesignation' => 'required',

			'gender' => 'required',
			'principal_contact' => 'nullable|string',

			'school_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
			'principal_signature' => 'nullable|file|image|mimes:jpg,jpeg,png|max:300',

			// 'academic_year' => ['required', 'regex:/^\d{4}-\d{4}$/']

		],[
			'principal_signature.max' => 'The principal\'s signature must not exceed 300KB.',
			'school_logo.max' => 'School logo size must be less than 1MB'
		]);
		
	
		$academicYear = $request->input('academic_year');
		$termsInput   = $request->input('terms', []);

		foreach ($termsInput as $termData) {

			if (empty($termData['end_date'])) {
				continue;
			}

			$termName  = $termData['term_name'];
			$startDate = $termData['start_date'];
			$endDate   = $termData['end_date'];

			$term = TermMaster::where('academic_year', $academicYear)
				->where('school_id', $id)
				->where('term_name', $termName)
				->where('term_start_date', $startDate)
				->first();

			if ($term) {
				$term->term_end_date = $endDate;
				$term->save();
			} else {
				TermMaster::create([
					'school_id'		  => $id,
					'term_name'       => $termName,
					'camp_type'		  => '1',
					'academic_year'   => $academicYear,
					'term_start_date' => $startDate,
					'term_end_date'   => $endDate,
					'is_active'		  => '1',

				]);
			}
		}
		


        DB::table('schools')->where('id', $id)->update([
            // 'school_name'     => $request->school_name,
            'school_email'    => $request->school_email,
            'principal_phone'    => $request->school_phone,
            'school_url'      => $request->school_url,
            'address'         => $request->school_address,

            'region'          => $request->region,
            'state'           => $request->state,
            'district'        => $request->district,
            'city'            => $request->city,

            'school_principal'=> $request->principalName,
            'shift'         => $request->school_shift,
        ]);


        $userId = Auth::user()->id;
        DB::table('users')->where('id', $userId)->update([
        	'name'     => $request->principalName,
            'email'    => $request->principalEmail,
            'phone'    => $request->principal_contact,
            'position' => $request->schoolAdminDesignation,
			'updated_at' => Now(),
        ]);

   
   		DB::table('usermetas')
        ->where('user_id', $userId)->update([
            'school_id' 	=> $id,
            'school_name' 	=> $request->school_name,
            'gender'    	=> $request->gender,
            'dob'           => $request->dob ?? '',
			'updated_at' => Now(),
        ]);


        if ($request->hasFile('school_logo')) {
            $logo_path = $this->resizeAndSaveImage($request->file('school_logo'), 100, 'logos' , $id);
            DB::table('schools')->where('id', $id)->update([
	            'logo' => $logo_path,
	        ]);
        }


        if ($request->hasFile('principal_signature')) {
            $signaturePath = $this->resizeAndSaveImage($request->file('principal_signature'), 100, 'signatures' , $id);
            DB::table('usermetas')->where('user_id', $userId)->update([
	            'signature' => $signaturePath,
	        ]);
        }

		return redirect()->route('update.profile')->with([
			'success' => 'School Records updated successfully.',
			'clearForm' => true
		]);
    }

	private function resizeAndSaveImage($file, $height, $folder, $id)
	{
		$path = public_path("assets/uploads/{$folder}/");

		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}

		$extension = strtolower($file->getClientOriginalExtension());
		$filename = $id . '_' . $folder . '.' . $extension;
		$destination = $path . $filename;

		switch ($extension) {
			case 'jpg':
			case 'jpeg':
				$src = imagecreatefromjpeg($file->getRealPath());
				break;
			case 'png':
				$src = imagecreatefrompng($file->getRealPath());
				break;
			case 'webp':
				$src = imagecreatefromwebp($file->getRealPath());
				break;
			default:
				throw new \Exception("Unsupported file type: $extension");
		}

		$origWidth = imagesx($src);
		$origHeight = imagesy($src);

		$width = intval(($height / $origHeight) * $origWidth);

		$dst = imagecreatetruecolor($width, $height);

		if (in_array($extension, ['png', 'webp'])) {
			imagealphablending($dst, false);
			imagesavealpha($dst, true);
			$transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
			imagefilledrectangle($dst, 0, 0, $width, $height, $transparent);
		}

		imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);

		switch ($extension) {
			case 'jpg':
			case 'jpeg':
				imagejpeg($dst, $destination, 80);
				break;
			case 'png':
				imagepng($dst, $destination, 6);
				break;
			case 'webp':
				imagewebp($dst, $destination, 80);
				break;
		}

		imagedestroy($src);
		imagedestroy($dst);

		return $filename;
	}

	// end school profile update 

    public function viewSchoolDart(Request $request)	
	{
		

		try {

			$title   = 'View Dart';	
			$SchoolUserId  =  \Auth::id();
			$role_id =  \Auth::user()->role_id;
			
			#echo "<pre>";
			#print_r('principal id-'.$SchoolUserId.'----change the detail----'.$role_id);
			#die('-------');
		
			if ($role_id != 2 && $role_id != 4) {
			    abort(403, 'Unauthorized access. Only school can access this section.');
			}

			$school_id = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');


			//echo "Temporarily Disable. We are working on it....";  exit();
			

			$school = School::find($school_id);
			$trainerList = $school->getTrainers;//->where('status',1);
			foreach ($trainerList as $trainer) {
			    $trainer->name = User::where('id', $trainer->trainer_id)->orderBy('name')->first()->name;
			}

			$classList = $school->getClasses;
			foreach ($classList as $class) 	{	
			   // $class->name = Sclass::where('id', $class->class_id)->orderBy('name')->first()->name;
			    $originalClass =  Sclass::where('id', $class->class_id)->orderBy('orders')->first();
			    $class->name = !empty($class->nomenclature) ? $class->nomenclature 	: ($originalClass ? $originalClass->name : null);
			}
			$classList = $classList->sortBy('orders')->values();


			/*
			$trainersData = DB::table('schools')
		    ->select(
		      'schools.id as schools_id',
		      'school_trainers.trainer_id',
		      'reports.student_id',
		      'reports.submitted_by',
		      'reports.level',
		      'users.name',
		      'reports.date',
		      'reports.period',
		      'reports.level',
		      'skillareas.name as skillareas',
		      'sports.name as sports',
		      'techniques.name as techniques',
		      'class.name as class',
		      'activity.title as title',
		      'activity.id as activity_id',
		      'custom_classes.section as section',

		       'reports.skill_area_id',
		      'reports.skill_sports_id',
		      'reports.technique_id',
		      'reports.activity_id',
		      'reports.custom_class_id',
		      'reports.other_duty_activity_id'

		    )

		    ->join('school_trainers', 'school_trainers.school_id', '=', 'schools.id')
		    ->join('users', 'users.id', '=', 'school_trainers.trainer_id')
		    ->join('reports', 'reports.submitted_by', '=', 'school_trainers.trainer_id')
		    ->join('class', 'class.id', '=', 'reports.class_id')
		    ->join('custom_classes', 'custom_classes.id', '=', 'reports.custom_class_id')
		    ->join('skillareas', 'skillareas.id', '=', 'reports.skill_area_id')
		    ->join('sports', 'sports.id', '=', 'reports.skill_sports_id')
		    ->join('techniques', 'techniques.id', '=', 'reports.technique_id')
		    ->join('activity', 'activity.id', '=', 'reports.activity_id')
		    ->where('reports.status', 1)
		    ->where('schools.id', $school_id)

		    ->orderBy('reports.period', 'ASC')
		    ->orderBy('reports.date', 'DESC')
		    ->orderBy('reports.custom_class_id', 'ASC')
		    ->orderBy('custom_classes.orders', 'ASC')
		    ->get()

		    // Group by trainer_id first
		    ->groupBy('submitted_by')
		    ->map(function ($recordsByTrainer) {
		        return $recordsByTrainer->groupBy('date')->map(function ($recordsByDate, $date) {
		            return $recordsByDate->groupBy('skillareas')->map(function ($recordsBySkillarea, $skillarea) use ($date) {
		                return $recordsBySkillarea->groupBy(function ($record) {
		                    return $record->class . '-' . $record->section;
		                })->map(function ($recordsByClassSection, $classSection) use ($date, $skillarea ){
		                    return $recordsByClassSection->groupBy('period')->map(function ($recordsByPeriod, $period) use ($classSection, $date, $skillarea) {
		                        
		                    		$presentCount = $absentCount = 0;	  
		                    		$checkstring = '';
		                    		$data = [];
		                    		$getRecords = [];
		                    		foreach ($recordsByPeriod as $entry) {
	                    				$checkstring = $entry->student_id;
			                    		if(!in_array($checkstring, $data)){
				                            if ($entry->level > 0) {
				                                $presentCount++;
				                            } else {
				                                $absentCount++;
				                            }
				                            $data[] = $checkstring;
				                            $getRecords[] = $entry;
			                    		}
				                    }
		                        
		                        return [
		                            'class_section' => $classSection,
		                            'period' => $period,
		                            'present_count' => $presentCount,
		                            'absent_count' => $absentCount,
		                            'records' => collect($getRecords)
		                        ];
		                    })->sortBy('period');
		                });
		            });
		        });
		    })
		    ->flatMap(function ($trainerGroups) {
		        return $trainerGroups->flatMap(function ($dateGroups, $date) {
		            return $dateGroups->flatMap(function ($skillareaGroups, $skillarea) {
		                return $skillareaGroups->flatMap(function ($classSectionGroups, $classSection) {	            
		                    return $classSectionGroups->map(function ($periodGroup, $period) use ($classSection) {
		                        return [
		                            'date' => $periodGroup['records']->first()->date,
		                            'trainer_id' => $periodGroup['records']->first()->trainer_id,
		                            'name' => $periodGroup['records']->first()->name,
		                            'class_section' => $classSection,
		                            'period' => $period,
		                            'present_count' => $periodGroup['present_count'],
		                            'absent_count' => $periodGroup['absent_count'],
		                            'class' => $periodGroup['records']->first()->class,
		                            'section' => $periodGroup['records']->first()->section,
		                            'skillareas' => $periodGroup['records']->first()->skillareas,
		                            'sports' => $periodGroup['records']->first()->sports,
		                            'techniques' => $periodGroup['records']->first()->techniques,
		                            'title' => $periodGroup['records']->first()->title,
		                            'activity_id' => $periodGroup['records']->first()->activity_id,


		                            'skill_area_id' => $periodGroup['records']->first()->skill_area_id,
		                            'skill_sports_id' => $periodGroup['records']->first()->skill_sports_id,
		                            'technique_id' => $periodGroup['records']->first()->technique_id,
		                            'activity_id' => $periodGroup['records']->first()->activity_id,
		                            'custom_class_id' => $periodGroup['records']->first()->custom_class_id,
		                            'other_duty_activity_id' => $periodGroup['records']->first()->other_duty_activity_id,

		                        ];
		                    });
		                });
		            });
		        });
		    })->collect()->sortByDesc('date');
				
			

			
		
		    if($request->ajax()){
				return Datatables::of($trainersData)

				->addIndexColumn()
				->addColumn('title', function($row){
						$html = '<a href="javascript:void(0)" onclick="modelContent('.$row['activity_id'].', \''.$row['skillareas'].'\', \''.$row['sports'].'\', \''.$row['techniques'].'\', \''.$row['class_section'].'\')">'.$row['title'].'</a>';
					return $html;
				})
				
				->addColumn('classandsec', function($row){
					return $row['class_section'];
				})
				->addColumn('date', function($row){
					$newDate = date("d-m-Y", strtotime($row['date']));
		  			return $newDate;
		  		})
				->rawColumns(['title','classandsec','date'])
				->toJson();
			}

			return view('school.viewschooldart', compact('title','trainerList','classList','trainersData'));
			*/

	 	    /*
	 		foreach($trainersData as $value){

				ViewDart::updateOrCreate(
				    [
				        'school_id' => $school_id,
				        'trainer_id' => $value['trainer_id'],
				        'period' => $value['period'],
				        'custm_cls_id' => $value['custom_class_id'],
				        'skill_area_id' => $value['skill_area_id'],
				        'skillsports_id' => $value['skill_sports_id'],
				        'technique_id' => $value['technique_id'],
				        'activity_id' => $value['activity_id'],
				        'other_duties_id' => $value['other_duty_activity_id'],
				        'date' => $value['date'],
				    ],
				    [
				        'total_student' => $value['present_count'] + $value['absent_count'],
				        'present' => $value['present_count'],
				        'absent' => $value['absent_count'],
				    ]
				);
			}
			*/ 

	 		// echo "<pre>"; print_r($trainersData);exit();
			
			
			$ViewDartQuery = DB::table('view_dart')
		    ->select('users.name','view_dart.*'	)
		    ->join('users', 'users.id', '=', 'view_dart.trainer_id')
		    ->where('view_dart.school_id', '=' , $school_id)->orderBy('date', 'desc');
		    
	        if ($request->has('search') && $request->search['value']) {
	            $searchValue = $request->search['value'];
	            $ViewDartQuery->where(function ($query) use ($searchValue) {
	                $query->where('users.name', 'like', '%' . $searchValue . '%');
	            });
	        }

	        if ($request->has('order')) {
	            $columnIndex = $request->input('order.0.column');
	            $columnName = $request->input('columns.' . $columnIndex . '.data');
	            $orderDirection = $request->input('order.0.dir');
	            $ViewDartQuery->orderBy($columnName, $orderDirection);
	        }

	        $start = $request->input('start', 0);
	        $length = $request->input('length', 100);
	        if ($length != -1) {
	            $ViewDartQuery->skip($start)->take($length);
	        }       	

	        $ViewDartData = $ViewDartQuery->get();
	        $totalRecords = DB::table('view_dart')->where('view_dart.school_id', '=', $school_id)->count();
	        $filteredRecords = $ViewDartQuery->count();
	      

	        $data = $ViewDartData->map(function($row) {
	            return [
	            	'name' => $row->name,
	            	'date' => date("d-m-Y", strtotime($row->date)),
	            	'period' => $row->period,
	                'classandsec' => \App\Helpers\Helper::getClassAndSection($row->custm_cls_id) ?? '---',
	                'skillareas' => \App\Helpers\Helper::getSkillArea($row->skill_area_id) ?? '---',
	                'sports' => \App\Helpers\Helper::getSports($row->skillsports_id) ?? '---',
	                'techniques' => \App\Helpers\Helper::getTechnique($row->technique_id) ?? '---',
	                'title' => $this->getActivityTitle($row),
	                'present_count' => $row->present ?? '---',
	                'absent_count' => $row->absent ?? '---',
	                'data' => $row // original data
	            ];
	        });
	        
	        // Return the custom data in the response
	        if ($request->ajax()) {
	            return response()->json([
	                'draw' => intval($request->draw),
	                'recordsTotal' => $totalRecords,
	                'recordsFiltered' => $totalRecords,
	                'data' => $data
	            ]);
	        }

	        return view('school.viewschooldart', compact('title','trainerList','classList'));
			

 		} catch (\Exception $e) {

			\Log::error('Error while Retrival of view-dart: ' . $e->getMessage());
			return redirect()->back()->with('error', 'Form submission failed!');
		}
 		

    }

    /**
     * Date : 15-Jan-2025
     * Modified code for accessing other duties inside the view dart module.
     * */
    public function viewSchoolDart_bkup(Request $request) {


		try {


			$title   = 'View Dart';	
			$SchoolUserId  =  \Auth::id();
			$role_id =  \Auth::user()->role_id;
		
			if($role_id != 4)
			{
				die('--you are not a school. school can only access--');
			}

			$school_id = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');

			$school = School::find($school_id);
			$trainerList = $school->getTrainers->where('status',1);
			foreach ($trainerList as $trainer) {
			    $trainer->name = User::where('id', $trainer->trainer_id)->orderBy('name')->first()->name;
			}

			$classList = $school->getClasses;
			foreach ($classList as $class) 	{			
			   $class->name = Sclass::where('id', $class->class_id)->orderBy('name')->first()->name;
			}

			
			$ViewDartQuery = DB::table('view_dart')
		    ->select('users.name','view_dart.*'	)
		    ->join('users', 'users.id', '=', 'view_dart.trainer_id')
		    ->where('view_dart.school_id', '=' , $school_id);
		    
	        if ($request->has('search') && $request->search['value']) {
	            $searchValue = $request->search['value'];
	            $ViewDartQuery->where(function ($query) use ($searchValue) {
	                $query->where('view_dart.name', 'like', '%' . $searchValue . '%');
	            });
	        }

	        if ($request->has('order')) {
	            $columnIndex = $request->input('order.0.column');
	            $columnName = $request->input('columns.' . $columnIndex . '.data');
	            $orderDirection = $request->input('order.0.dir');
	            $ViewDartQuery->orderBy($columnName, $orderDirection);
	        }

	        $start = $request->input('start', 0);
	        $length = $request->input('length', 100);
	        if ($length != -1) {
	            $ViewDartQuery->skip($start)->take($length);
	        }       	

	        $ViewDartData = $ViewDartQuery->get();
	        $totalRecords = DB::table('view_dart')->where('view_dart.school_id', '=', $school_id)->count();
	        $filteredRecords = $ViewDartQuery->count();
	      

	        $data = $ViewDartData->map(function($row) {
	            return [
	            	'name' => $row->name,
	            	'date' => $row->date,
	            	'period' => $row->period,
	                'classandsec' => \App\Helpers\Helper::getClassAndSection($row->custm_cls_id) ?? '---',
	                'skillareas' => \App\Helpers\Helper::getSkillArea($row->skill_area_id) ?? '---',
	                'sports' => \App\Helpers\Helper::getSports($row->skillsports_id) ?? '---',
	                'techniques' => \App\Helpers\Helper::getTechnique($row->technique_id) ?? '---',
	                'title' => $this->getActivityTitle($row),
	                'present_count' => $row->present ?? '---',
	                'absent_count' => $row->absent ?? '---',
	                'data' => $row    // original data
	            ];
	        });
	        
	        // Return the custom data in the response
	        if ($request->ajax()) {
	            return response()->json([
	                'draw' => intval($request->draw),
	                'recordsTotal' => $totalRecords,
	                'recordsFiltered' => $totalRecords,
	                'data' => $data
	            ]);
	        }
			
	 		return view('school.viewschooldart', compact('title','trainerList','classList'));

 		} catch (\Exception $e) {
			\Log::error('Error while Retrival of view-dart: ' . $e->getMessage());
			return redirect()->back()->with('error', 'Form submission failed!');
		}
    }



    private function getActivityTitle($row) {
	    if (empty($row->activity_id)) {
	        return \App\Helpers\Helper::getOtherDuties($row->other_duties_id);
	    }

	    $activitytitle = \App\Helpers\Helper::getActivity($row->activity_id);
	    $classSection = \App\Helpers\Helper::getClassAndSection($row->custm_cls_id);
	    $skillareas = \App\Helpers\Helper::getSkillArea($row->skill_area_id);
	    $sports = \App\Helpers\Helper::getSports($row->skillsports_id);
	    $techniques = \App\Helpers\Helper::getTechnique($row->technique_id);

	    return '<a href="javascript:void(0)" onclick="modelContent(' . $row->activity_id . ', \'' . $skillareas . '\', \'' . $sports . '\', \'' . $techniques . '\', \'' . $classSection . '\')">' . $activitytitle . '</a>';
	}


	public function viewSchoolDart_bk(Request $request) 
	{

		$dates = Helper::LastTwoDates();
		$fromDate = $dates[1];
		$toDate   = $dates[0];



		$title   = 'View Dart';	
		$SchoolUserId  =  \Auth::id();
		$role_id =  \Auth::user()->role_id;
	
		if($role_id != 4)
		{
			die('--you are not a school. school can only access--');
		}

		$SchoolId = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');
		
		
		#echo "<pre>";
		#print_r($SchoolId);
		#die('----change the detail----');
		
		
		$school = School::find($SchoolId);
		$trainerList = $school->getTrainers->where('status',1);
		foreach ($trainerList as $trainer) 
		{
		    $trainer->name = User::where('id', $trainer->trainer_id)->orderBy('name')->first()->name;
		}

		$classList = $school->getClasses;
		foreach ($classList as $class) 
		{
		   $class->name = Sclass::where('id', $class->class_id)->orderBy('name')->first()->name;
		}

		$trainersData = DB::table('schools')
		    ->selectRaw('
		        schools.id as schools_id,
		        school_trainers.trainer_id as trainer_id,
		        users.name as name,
		        reports.custom_class_id,
		        reports.period,
		        reports.date,
		        reports.skill_area_id,
		        reports.skill_sports_id,
		        reports.technique_id,
		        reports.activity_id,
		        reports.level,
		        custom_classes.section as section,
		        class.name as class,
		        skillareas.name as skillareas,
		        sports.name as sports,
		        techniques.name as techniques,
		        activity.title as title,
		        SUM(CASE WHEN reports.level = 0 THEN 1 ELSE 0 END) AS absent_count,
		        SUM(CASE WHEN reports.level != 0 THEN 1 ELSE 0 END) AS present_count'
		    )
		    ->join('school_trainers', 'school_trainers.school_id', '=', 'schools.id')
		    ->join('users', 'users.id', '=', 'school_trainers.trainer_id')
		    ->join('reports', 'reports.submitted_by', '=', 'school_trainers.trainer_id')
		    ->join('custom_classes', 'custom_classes.id', '=', 'reports.custom_class_id')
		    ->join('class', 'class.id', '=', 'custom_classes.class_id')
		    ->join('skillareas', 'skillareas.id', '=', 'reports.skill_area_id')
		    ->join('sports', 'sports.id', '=', 'reports.skill_sports_id')
		    ->join('techniques', 'techniques.id', '=', 'reports.technique_id')
		    ->join('activity', 'activity.id', '=', 'reports.activity_id')
		    ->where('schools.id', $SchoolId)
		    ->where('school_trainers.status', 1)
			->whereBetween('reports.date', [$fromDate, $toDate])
		    ->groupBy(
		        'schools_id', 'trainer_id', 'name', 'reports.custom_class_id',
		        'reports.period', 'reports.date', 'reports.skill_area_id',
		        'reports.skill_sports_id', 'reports.technique_id', 'reports.activity_id',
		        'reports.level', 'section', 'class', 'skillareas',
		        'sports', 'techniques', 'title'
		    )
			
		    //->orderBy('reports.created_at', 'DESC')
    		->get();

		return view('school.viewdart', compact('title','trainerList','classList','trainersData'));
    }










   
    public function getReport(Request $request){
		
		#die('---kuch toh log khage----');

    	if($request->ajax()){
			
			
			$SchoolUserId  =  \Auth::id();
			
			$school_id = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');
			
			#echo "<pre>";
			#echo 'school principal id-'.$SchoolUserId;
			#echo "<br>";
			#print_r($school_id);
			#die('-----change the detail----');
			
			

    		$formData = $request->all();

    		$trainer_id = $formData['trainer_id'] ?? '';
			$class      = $formData['custom_class_id'] ?? '';

			$class_parts = explode("-", $class);
			$class_id = $class_parts[0] ?? '';
			$section_id = $class_parts[1] ?? '';

			$from_date = $formData['from_date'];   
			$to_date = $formData['to_date'];
			
			#echo $from_date;
			#echo "<br>";
			#echo $to_date;
			#die('---change the data---');			

    		
			$query = Report::with(['trainer','level','customClass','class','skillArea','sport','technique','activity'])
			   // ->whereRaw("STR_TO_DATE(date, '%d/%m/%Y') >= '$from_date'")
			   // ->whereRaw("STR_TO_DATE(date, '%d/%m/%Y') <= '$to_date'")
				->whereBetween('date', [$from_date, $to_date]);
				
				
				
				
				

			if (!empty($trainer_id)) {
			    if (!empty($class)) {
			        $reports = $query->where('submitted_by', $trainer_id)->where('class_id', $class_id)->where('custom_class_id', $section_id)->get();
			    } else {
			        $reports = $query->where('submitted_by', $trainer_id)->get();
			    }
			} else {
			    if (!empty($class)) {
			        $reports = $query->where('class_id', $class_id)->where('custom_class_id', $section_id)->get();
			    } else {
			        $reports = $query->get();
			    }
			}

            foreach ($reports as $report) {

            	$present = Report::where('submitted_by', $report->submitted_by)->where('period', $report->period)
	        		->where('custom_class_id', $report->custom_class_id)
	        		->where('activity_id', $report->activity_id)	
	        		->where('level', '<>', 0)
	        		->count();

			    $absent = Report::where('submitted_by', $report->submitted_by)->where('period', $report->period)
		        	->where('custom_class_id', $report->custom_class_id)
		        	->where('activity_id', $report->activity_id)
		        	->where('level', '=', 0)->count();
				        	    		
			    $report->present = $present;  
			    $report->absent = $absent;    		
			    $report->class_name = $report->customClass->class->name;
			    $report->class_section = $report->customClass->section;
			}
  

    		$responseData = [
		        'success' => true,
		        'data' => $reports,
		    ];

		    return response()->json($responseData);
    	}
    }
    

    public function skillreport() {

    	$school = School::find(2823);
    	
    	$classList = DB::table('schools')
    	->select('schools.id as school_id','schools.school_name','custom_classes.id as custom_class_id','custom_classes.section','class.name')
    	->join('custom_classes','custom_classes.school_id','schools.id')
    	->join('class','class.id', 'custom_classes.class_id')
    	->where('schools.id' , 2823)->get();


	    $students = DB::table('schools')
	    ->select(
	        'schools.id as school_id',
	        'students.id as student_id',
	        'students.student_name',
	        'students.custom_class_id',
	        'students.dob',
	        'students.gender',
	        'students.rollno',
	        'custom_classes.section',
	        'class.name as class',
	        DB::raw("GROUP_CONCAT(DISTINCT reports.level ORDER BY reports.level SEPARATOR ', ') as levels"),
	        DB::raw("COUNT(reports.id) as completedActivites"),
	        DB::raw("SUM(CASE WHEN reports.level = 0 THEN 1 ELSE 0 END) as absent"),
	        DB::raw("SUM(CASE WHEN reports.level <> 0 THEN 1 ELSE 0 END) as present")
	    )
	    ->from('schools')
	    ->join('students', 'students.school_id', '=', 'schools.id')
	    ->join('reports', 'reports.student_id', '=', 'students.id')
	    ->join('custom_classes', 'custom_classes.id', '=', 'students.custom_class_id')
	    ->join('class', 'class.id', '=', 'custom_classes.class_id')
	    ->where('schools.id', 2823)
	    ->groupBy('school_id', 'students.rollno','students.id', 'student_name', 'custom_class_id', 'dob', 'gender', 'section', 'class')
	    ->orderBy('students.id')
	    ->get();

	  
	    $title = 'Skills-Report';
    	return view('school.skillreports', compact('title','students','classList'));
    }






    /**
     * 05-08-2024
     * Method used to get all the school's student details.
     * */

    public function ManageStudents(Request $request){

    	$userId = Auth::user()->id;
		$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		$data = ScustomClass::where('school_id', $schoolId)->select('class_id','section')->get()->toArray();
		$customClass1 = array();

		foreach($data as $value){

			$class = $value['class_id'];
			$section = $value['section'];

			if(!isset($customClass1[$class])){
				$customClass1[$class] = [];
			}

			$customClass1[$class][] = $section;
		}


		$school = School::find($schoolId);
		$classList = $school->getClasses;
		foreach ($classList as $class) {

		    $originalClass = Sclass::where('id', $class->class_id)->orderBy('orders')->first();
		    $class->name = !empty($class->nomenclature) 
		        ? $class->nomenclature 
		        : ($originalClass ? $originalClass->name : null);

		}
		$classList = $classList->sortBy('orders')->values();
		$classList->prepend((object)[
	        'class_id' => '',
	        'name' => 'Select Class',
	        'section' => ''
	    ]);
			
		$sub = DB::table('custom_classes')
		    ->select(DB::raw('MIN(id) as min_id'))
		    ->where('school_id', $schoolId)
		    ->groupBy('class_id');

		$classes = DB::table('custom_classes')
	    ->join('class', 'class.id', '=', 'custom_classes.class_id')
	    ->join('schools', 'schools.id', '=', 'custom_classes.school_id')
	    ->whereIn('custom_classes.id', $sub)
	    ->select(
	        'schools.id as schools_id',
	        'custom_classes.id as custom_class_id',
	        'custom_classes.class_id as id',
	        'custom_classes.section',
	        DB::raw("
	            CASE 
	                WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
	                THEN custom_classes.nomenclature 
	                ELSE class.name 
	            END AS className
	        ")
	    )
	    ->orderBy('school_id')->orderby('custom_classes.orders')
	    ->get();



		$studentsQuery = DB::table('schools')
		->join('students', 'students.school_id', '=' , 'schools.id')
		->leftJoin('class', 'students.class_id', '=', 'class.id')
    	->leftJoin('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
		->select(
			'schools.id as schools_id',
			'schools.school_code as school_code',
			'students.student_uid',
			'students.id as student_id',
			'students.student_name as student_name',
			'students.gender',
			'students.class_id',
			'students.section_id',
			'students.custom_class_id',
			'students.dob',
			'students.email_id',
			'students.rollno',
			'students.status',
			DB::raw("CASE 
                    WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                    THEN custom_classes.nomenclature 
                    ELSE class.name 
                 END AS display_classname"),
			'custom_classes.section'
			)
		->where('schools.id', $schoolId)
		->orderBy('display_classname', 'asc')
		->orderBy('custom_classes.section', 'asc')
		->orderBy('students.rollno', 'asc');


		if ($request->has('class_id')) {
	        $classFilter = $request->input('class_id');
	        list($class_id, $section_id) = explode('-', $classFilter);
	        if (!empty($class_id)) {
	            $studentsQuery->where('students.class_id', $class_id);
	        }
	        if (!empty($section_id)) {
	            $studentsQuery->where('students.section_id', $section_id);
	        }
	    }

        if ($request->has('status')) {
	        $status = $request->input('status');
	        if (!empty($status)) {
	        	$studentsQuery->where('students.status', $status);
	        }
	    }

	    $studentsDetails = $studentsQuery->get();

	
    	if($request->ajax()){

			return Datatables::of($studentsDetails)
	        ->addIndexColumn()
	        ->addColumn('class_id', function($row) {
	        	return $row->display_classname;
            })

            ->addColumn('registration_no', function($row){
            	return $row->student_uid;
            })	

			->addColumn('email', function($row){
				// $emailHtml = '<input class="form-control email-input" type="email" name="email" data-id="' . htmlspecialchars($row->email_id) . '" value="' . htmlspecialchars($row->email_id) . '">';
            	return $row->email_id;
            	// return $emailHtml;
            })
            ->addColumn('rollno', function($row){
            	return $row->rollno;
            })	

	        ->addColumn('section_id', function($row) use ($customClass1){
	        	$html = '<select class="form-control mx-0 section" name="section_id" data-section="'.$row->section_id.'" data-id= '.$row->student_id.' value="'.$row->class_id.'" >
	                <option value="">Section</option>';
                	foreach ($customClass1[$row->class_id] as $section) {
					    $html .= '<option value="' . $row->class_id . '"';
					    if ($row->section_id == $section) {
					        $html .= ' selected';
					    }
					    $html .= '>' . $section . '</option>';
					}
	        	$html .= '</select>';
                return $html;
            })

            ->addColumn('gender' , function($row) {
            	$gender = ['Male','Female'];
            	$genderHtml = '<select class="form-control form-control-sm studentGender" name="gender" data-gender="'.$row->gender.'" data-id="'.$row->student_id.'" >
	                <option value="">Select Gender</option>';
					foreach ($gender as $data) {
						$genderHtml .= '<option value="' . $data . '"';
						if ($data == $row->gender) {
							$genderHtml .= ' selected';
						}
						$genderHtml .= '>' . $data . '</option>';
					}
				$genderHtml .= '</select>';
            	return $genderHtml;
            })

	        ->addColumn('dob', function($row) {
	        	$formatted_date = null;
		        if (!empty($row->dob)) {
		            $timestamp = strtotime($row->dob);
		            if ($timestamp !== false) {
		                $formatted_date = date('Y-m-d', $timestamp);
		            } else {
		                $formatted_date = 'Fill date';
		            }
		        } else {
		            $formatted_date = 'No date provided';
		        }

		   		$datehtml = '';
		        if($formatted_date !== 'Fill date'){
		    		$datehtml .= '<input class="datepicker updated_date" data-dob="'.date('d-m-Y', strtotime($row->dob)).'" data-id="'.$row->student_id.'" type="date" name="birth_date" value="'.$formatted_date.'">';
		        } else {
					$datehtml .= '<input class="datepicker" data-dob="'.date('d-m-Y', strtotime($row->dob)).'" data-id="' . $row->student_id . '" type="text" name="birth_date" placeholder="Fill date" onfocus="this.type=\'date\'" onblur="this.type=\'text\'" id="date" value="Fill date">';
				}

                return $datehtml;
            })

	        ->addColumn('status', function($row){
	        	$status = ['active','transfer'];
            	$statusHtml = '<select class="form-control studentStatus" name="status" data-status="'.$row->status.'" data-id="'.$row->student_id.'" >
	                <option value="">Select Status</option>';
					foreach ($status as $data) {
						$statusHtml .= '<option value="' . $data . '"';
						if ($data == $row->status) {
							$statusHtml .= ' selected';
						}
						$statusHtml .= '>' . ucfirst($data) . '</option>';
					}
				$statusHtml .= '</select>';
            	return $statusHtml;
            })

            ->rawColumns(['rollno','registration_no','gender','class_id','section_id','dob','status'])
	        ->toJson();
        }

        if($studentsDetails->count() > 0){
        	$check  = 'true';
        }else{
        	$check = 'false';
        }

		$title = 'Manage Students';
		return view('school.managestudent', compact('title','studentsDetails','check','classes','classList'));
	} 


   	/**
   	 * Upadte in manage students of the students
   	 * */



   	public function updateName(Request $request){

		try {
			$studentId = $request->post('student_id');
			$newName = $request->post('newName');
	        DB::table('students')->where('id', $studentId)->update([ 'student_name' => $newName]);
	        echo 'Student Name updated sucessfully';
	    } catch (\Exception $e) {
		    return $e->getMessage();
		}
   	}

	
   	public function updateRollNo(Request $request){
   		   
		$studentData = DB::table('students')
			->select('student_name', 'school_id', 'custom_class_id', 'section_id')
			->where('id', $request->student_id)
			->first();

		$existedRollNo = DB::table('students')
			->where('rollno', $request->newRollno)
			->where('school_id', $studentData->school_id)
			->where('custom_class_id', $studentData->custom_class_id)
			->where('section_id', $studentData->section_id)
			->exists();

		if($existedRollNo){
			return response()->json([
				'status' => false,
				'message' => 'Roll number is already assigned to another student in the same class and section.',
			], 409);
		}else{
			try {
				$studentId = $request->post('student_id');
				$newRollno = $request->post('newRollno');
			    DB::table('students')->where('id', $studentId)->update([ 'rollno' => $newRollno]);
			    echo 'Roll no. updated sucessfully';
			} catch (\Exception $e) {
			    return $e->getMessage();
			}

		}
   	}

	public function rollNoSuggestion(Request $request){
		$studentId = $request->student_id;
		// $studentId = "6824";
		// dd("hello");

		$studentData = DB::table('students')
			->select('student_name', 'school_id', 'custom_class_id', 'section_id', 'rollno')
			->where('id', $studentId)
			->first();

		$assignedRollNumbers = DB::table('students')
			->where('school_id', $studentData->school_id)
			->where('custom_class_id', $studentData->custom_class_id)
			->where('section_id', $studentData->section_id)
			->whereNotNull('rollno')
			->pluck('rollno')
			->map(function ($num) {
				return (int) $num;
			})
			->toArray();

		$maxAssigned = !empty($assignedRollNumbers) ? max($assignedRollNumbers) : 0;

		$studentCount = DB::table('students')
			->where('school_id', $studentData->school_id)
			->where('custom_class_id', $studentData->custom_class_id)
			->where('section_id', $studentData->section_id)
			->count();

		$maxRange = max($maxAssigned, $studentCount);

		$suggestions = [];

		for ($i = 1; $i <= $maxRange; $i++) {
			if (!in_array($i, $assignedRollNumbers)) {
				$suggestions[] = $i;
				if (count($suggestions) >= 5) break;
			}
		}

		$next = $maxRange + 1;
		while (count($suggestions) < 5) {
			if (!in_array($next, $assignedRollNumbers)) {
				$suggestions[] = $next;
			}
			$next++;
		}

		return response()->json([
			'suggested_roll_numbers' => $suggestions
		]);
	}

   	public function updateAdmissionNo(Request $request){

		$studentData = DB::table('students')
			->select('student_name', 'school_id')
			->where('id', $request->student_id)
			->first();

		$existedUID = DB::table('students')
			->where('student_uid', $request->newUID)
			->where('school_id', $studentData->school_id)
			->where('id', '!=', $request->student_id)
			->exists();

		if($existedUID){
			return response()->json([
				'status' => false,
				'message' => 'Admission Number is already assigned to another student.',
			], 409);
		}else{
			try {
				$studentId = $request->post('student_id');
				$newUID = $request->post('newUID');
			    DB::table('students')->where('id', $studentId)->update([ 'student_uid' => $newUID]);
			    echo 'Admission Number updated sucessfully';
			} catch (\Exception $e) {
			    return $e->getMessage();
			}
		}
   	}


   	public function updatedob(Request $request){

		try {
			$studentId = $request->post('student_id');
			$newDate = $request->post('new_date');
	        DB::table('students')->where('id', $studentId)->update([ 'dob' => $newDate]);
	        echo 'DOB updated sucessfully';
	    } catch (\Exception $e) {
		    return $e->getMessage();
		}
   	}

	public function updateEmail(Request $request){
		try {
			$studentId = $request->post('student_id');
			$newEmail = $request->post('newEmail');
	        DB::table('students')
				->where('id', $studentId)
				->update(['email_id' => $newEmail]);
			echo 'Email updated sucessfully';
	    } catch (\Exception $e) {
		    return $e->getMessage();
		}
   	}

   	/**
   	 * Update Class Section
   	 * */
   	public function updateSection(Request $request){

		try {

			$userId = Auth::user()->id;
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');

			$studentId = $request->post('student_id');
			$classId = $request->post('classId');
			$section = $request->post('section');

			$customClassData = DB::table('custom_classes')->where('school_id', $schoolId)->where('class_id', $classId)->where('section' , $section)->get();
			if($customClassData->isNotEmpty()){

				foreach($customClassData as $data){
					Sstudent::where('id', $studentId)->update([
			           'class_id' => $data->class_id,
			           'custom_class_id' => $data->id,
			           'section_id' => $section,
			        ]);

			        Report::where('student_id', $studentId)->update([
			           'class_id' => $data->class_id,
			           'custom_class_id' => $data->id,
			        ]);
				}
	        	echo 'Section updated sucessfully';

			}else{
				echo "Selected Section for this class not available";
			}

	    } catch (\Exception $e) {
		    return $e->getMessage();
		}

   	}

   	/**
   	 * Add or Register New Student Student.
   	 * */
   	public function addStudent(Request $request){


   		$rules = [
		    'student_name'  => 'required|string|max:100|regex:/^[a-zA-Z][a-zA-Z\s.\']*$/u',	
		    'studentuid'    => 'required|min:8',
		    'email'         => 'required|email|max:255',
		    'gender'        => 'required|in:Male,Female',
		    'dob'           => 'required|date',
		    'section'       => 'required|not_in:0',
		    'class'         => 'required|not_in:0',
		    'rollno'        => ['required', 'numeric','digits_between:1,4',
		    function ($attribute, $value, $fail) use ($request) {
		        $exists = Sstudent::where('class_id', $request->input('class'))->where('school_id', $request->input('schools_id'))->where('section_id', $request->input('section'))->where('rollno', $value)->value('student_name');

		            if ($exists) {
		                $fail('The roll number is already assigned to : ' .$exists );
		            }
		        }
		    ],

		    'student_uid'   => ['required', 'numeric',
		        function ($attribute, $value, $fail) use ($request) {
		            $existingStudent = Sstudent::where('student_uid', $value) ->where('school_id', $request->input('schools_id'))->first();
		            if ($existingStudent) {
		                $fail('The registration number is already assigned to : ' . ucfirst($existingStudent->student_name));
		            }
		        }
			],
		];

		// Custom validation messages
		$customMessages = [
		    'student_name.required' => 'Please enter student name',
		    'student_name.regex'   => 'Name should contain only letters, spaces, and dots and apostrophe.',
		    'student_name.max'      => 'Maximum character length is 100',

		    'student_uid.required'   => 'Please enter student registration number',
		    'student_uid.numeric'    => 'Registration number should only contain numeric values',
		    // 'student_uid.digits_between' => 'Registration number should be between 1 and 12 digits',

		    'email.required'        => 'Email address is required!',
		    'email.email'           => 'Please provide a valid email address',

		    'gender.required'       => 'Please select gender',
		    'dob.required'          => 'Please select student\'s birth date',
		    'class.required'        => 'Please select class',
		    'section.required'      => 'Please assign class section',

		    'rollno.required'       => 'Please assign roll number to the student',
		    'rollno.numeric'        => 'Roll number should only contain numeric values',
		    'rollno.digits_between' => 'Roll number should be between 1 and 4 digits',

		    'studentuid.required'   => 'Please provide student user id',
		    'studentuid.min'        => 'Student user id must be at least 8 characters',
		];


	    $validator = Validator::make($request->all(), $rules, $customMessages);

	    if ($validator->fails()) {
	        return response()->json(['status' => 'fail', 'error' => $validator->errors()]);
	    }

	    try {

	    	$custom_class_id = DB::table('custom_classes') ->where('class_id', $request->post('class'))
	            ->where('section', $request->post('section'))->where('school_id', $request->post('schools_id'))
	            ->value('id');

	        $words = explode(" ", $request->post('student_name'));
	        $namefirstletter = $words[0];
	        $password = strtolower($namefirstletter) . '@' . $request->post('student_uid');


	        if (!empty($custom_class_id)) {
	            $data = Sstudent::create([
	                'school_id'     => $request->post('schools_id'),
	                'school_code'   => $request->post('school_code'),
	                'student_uid'   => $request->post('student_uid'),
	                'student_name'  => $request->post('student_name'),
	                'gender'        => $request->post('gender'),
	                'class_id'      => $request->post('class'),
	                'custom_class_id'=> $custom_class_id,
	                'section_id'    => $request->post('section'),
	                'dob'           => $request->post('dob'),
	                'user_id'       => $request->post('studentuid'),
	                'password'      => $password,
	                'email_id'      => $request->post('email'),
	                'rollno'        => $request->post('rollno'),
	                'status'        => $request->post('status'),
	            ]);

	            $className = Sclass::find($data->class_id)->value('name');
	            return response()->json([
	                'className' => $className,
	                'data' => $data,
	                'student_name' => $request->post('student_name'),
	                'StudentUserId' => $request->post('studentuid'),
	                'Password' => $password,

	                'status' => 'success',
	                'message' => 'Student added successfully'
	            ]);
	        } else {
	            return response()->json([
	                'status' => 'fail',
	                'message' => 'Selected section for this class is not available'
	            ]);
	        }
	    } catch (\Exception $e) {
	        return response()->json([
	            'status' => 'fail',
	            'message' => 'Failed to add student: ' . $e->getMessage()
	        ]);
	    }
   	}

   	/**
   	 * Get Section based on selected class.
   	 * */
   	public function getClassSection(Request $request){

   		$userId = Auth::user()->id;
		$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');

   		if($request->ajax()){
   			$classAndSection = ScustomClass::where('school_id',$schoolId)->where('class_id',$request->post('classId'))->select('section')->groupBy('section')->get();
			return response()->json(['status' => 'success', 'data' => $classAndSection]);
   			echo $html;
   		}
   	}

   	public function changegender(Request $request){

   		try {
			$userId = Auth::user()->id;
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');

			if($request->ajax()){
				Sstudent::find($request->post('studentId'))->update([
					'gender' => $request->post('gender'),
				]);

				echo 'Gender updated sucessfully';
			}

		} catch (\Exception $e) {
			return $e->getMessage();
		}
   	}

   	public function changeStatus(Request $request)
	{

   		try {
			$userId = Auth::user()->id;
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');

			if($request->ajax()){
				Sstudent::find($request->post('studentId'))->update([
					'status' => $request->post('status'),
				]);

				echo 'Status updated sucessfully';
			}

		} catch (\Exception $e) {
			return $e->getMessage();
		}
   	}
	


	/**
   	 * 28-05-2025
   	 * Download the template for uploading the student profile data.
   	 * */
   	public function downloadTemplate() {
      	
        $templatePath = public_path('downloads/PersonalProfile.xlsx');

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return Response::download($templatePath, 'PersonalProfile.xlsx', $headers);
    }

    /**
   	 * Download student profile's Sample Data.
   	 * */
    public function sampleData() {
      	

      	// echo "string"; exit();

        $templatePath = public_path('downloads/SampleData.xlsx');

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return Response::download($templatePath, 'SampleData.xlsx', $headers);
    }


    public function downloadDuplicates(){
        $failedRecordsPath = storage_path('app/duplicate_records.json');
        if (!file_exists($failedRecordsPath)) {
            abort(404, 'No failed import records found.');
        }

        $failedRecords = json_decode(file_get_contents($failedRecordsPath), true);
        return Excel::download(new ExportImproperData($failedRecords, 'duplicate'), 'DuplicateRecords_'.date("d-m-Y H:i:s").'.xlsx');
    }

    public function downloadErrorList(){
        $failedRecordsPath = storage_path('app/failed_imports.json');
        if (!file_exists($failedRecordsPath)) {
            abort(404, 'No failed import records found.');
        }

        $failedRecords = json_decode(file_get_contents($failedRecordsPath), true);
        return Excel::download(new ExportImproperData($failedRecords,'error_list'), 'ErrorList_'.date("d-m-Y H:i:s").'.xlsx');
    }

    

    public function importStudentData(Request $request) {    
	
	
	// echo "<pre>";
	// print_r($request->all()); exit();
	
	

    	$validator = Validator::make($request->all(), [
	       /* 'upload_student_profile' => ['required','file','mimes:xls,xlsx','max:3000',
	            function($attribute, $value, $fail) {
	                if ($value->isValid()) {
	                    $fileName = $value->getClientOriginalName();
						//echo $fileName;
						//echo "------------";
	                    if ($fileName !== 'PersonalProfile.xlsx') {
	                        $fail('Invalid file name. Please upload the file named "PersonalProfile.xlsx".');
	                    }
	                }
	            }
	        ],*/
	    ], 
	    [
	        'upload_student_profile.required'=> 'Please select a document file.',
	        'upload_student_profile.file'	 => 'No file has been selected. Please choose a file.',
	        'upload_student_profile.mimes' 	 => 'The selected file must be in either the xls or xlsx format.',
	        'upload_student_profile.max' 	 => 'File size should not be more than 3MB.',
	    ]);

        if ($validator->fails()){
        	
            $errorContent = '<ul style="list-style-type: none;">';
            foreach($validator->errors()->getMessages() as $validationErrors){
                if (is_array($validationErrors)) {
                    foreach($validationErrors as $validationError){
                        $errorContent .= '<li>'.$validationError.'</li>';
                    }
                } else {
                    $errorContent .= '<li>'.$validationError.'</li>';
                }
            }
            $errorContent .= '</ul>';

            return response()->json([                 
                'error' => $errorContent,             
            ]);             
        }


        $file = $request->file('upload_student_profile');
        $userId = Auth::user()->id;
		$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
        $action = $request->post('event');
        $importData = new ImportStudentProfile($schoolId, $action);   
    	$dataArray = Excel::toArray($importData, $file);
	    $totalRecords = count($dataArray[0]);

        if($action == 'preview'){

        	if(Sstudent::where('school_id','=', $schoolId)->select('id')->count() > 0 ){

        		/*$existingRecords = Sstudent::whereIn('student_uid', array_column($dataArray[0], 'student_uid'))->get();
		        $duplicates = array_filter($dataArray[0], function($row) use ($existingRecords) {
		            return in_array($row['student_uid'], $existingRecords->pluck('student_uid')->toArray());
		        });*/



		        $conditions = array_map(function($row) {
				    return [
				        'student_uid' => $row['student_uid'],
				        'school_code' => $row['school_code'],
				    ];
				}, $dataArray[0]);

		        $existingRecords = Sstudent::where(function($query) use ($conditions) {
				    foreach ($conditions as $condition) {
				        $query->orWhere(function($q) use ($condition) {
				            $q->where('student_uid', $condition['student_uid'])
				              ->where('school_code', $condition['school_code']);
				        });
				    }
				})->get();

		        $existingRecordsArray = $existingRecords->map(function($record) {
				    return [
				        'student_uid' => $record->student_uid,
				        'school_code' => $record->school_code,
				    ];
				})->toArray();


		        $duplicates = array_filter($dataArray[0], function($row) use ($existingRecordsArray) {
				    return in_array([
				        'student_uid' => $row['student_uid'],
				        'school_code' => $row['school_code'],
				    ], $existingRecordsArray);
				});
				


        		$summary = '';
        		$summary = 'The Excel file contains '.$totalRecords . ' records. Please review and confirm to proceed with the import.';
		        $confirmButtonText = "Yes, Import it!";
		        $buttonClass = 'btn-import';

		        $identicalrecords = $totalRecords - count($duplicates);
		       	if(!empty($duplicates) && $identicalrecords > 0){
		        	Storage::disk('local')->put('duplicate_records.json', json_encode($duplicates));
		        	$confirmButtonText = "Yes, Overwrite it!";
		        	$buttonClass = 'btn-overwrite';
		        	$summary = '<p>The Excel file contains '.$totalRecords.' records including '.count($duplicates).' duplicate entries
		        			<a href="'.route('downloadDuplicates').'"> click to view</a></p>


		        			<div class="form-group mt-2">
	                            <label>Do you want to overwrite existing records?</label>
	                            <input type="radio" id="overwrite" name="importOption" value="override" data-id="Yes, Overwrite it!" checked>
	                            <label for="overwrite">Yes, Overwrite it</label><br>
	                            <input type="radio" id="skip" name="importOption" value="skipandimport" data-id="Skip & Import">
	                            <label for="skip">No, Skip Overwrite & Import New Records Only</label>
	                        </div>';

		        } else if(!empty($duplicates) ){
		        	Storage::disk('local')->put('duplicate_records.json', json_encode($duplicates));
		        	$confirmButtonText = "Overwrite it!";
		        	$buttonClass = 'btn-overwrite';
		        	$summary = '<p>The Excel file contains '.$totalRecords.' records including '.count($duplicates).' duplicate entries
		        			<a href="'.route('downloadDuplicates').'"> click to view</a></p>';
		        }

        	}else{		 
        		$confirmButtonText = "Yes, Import it!";
        		$buttonClass = 'btn-import';    
		       	$summary = 'The Excel file contains '.$totalRecords . ' records. Please review and confirm to proceed with the import.';
        	}

	       	return response()->json(['summary' => $summary,'icon' => 'info','cnfmText' => $confirmButtonText,'btnclass'=>$buttonClass]);

        }else if($action == 'import' || $action == 'skipandimport'){
        	$summary = '';
	        Excel::import($importData, $file);
	        $importedData = $importData->getImportedData();
	        $imProperFormatData =  $importData->imProperFormatData();
	        $summary .= 'Import completed! '.count($importedData).' records were successfully imported into the database.';

	        if(!empty($imProperFormatData)){
	           	Storage::disk('local')->put('failed_imports.json', json_encode($imProperFormatData)); 
	           	$summary .= ' <p>'.count($imProperFormatData).' records could not be imported. <a href="'.route('downloadErrorList').'"> click here to view</a></p>';
	        }

	        return response()->json(['summary' => $summary, 'icon' => 'sucess']);

        }else if($action == 'override'){
        	$summary = '';
	        Excel::import($importData, $file);
	        $importedData = $importData->getImportedData();
	        $imProperFormatData =  $importData->imProperFormatData();

	        $summary .= 'Import completed! '.count($importedData).' records were successfully imported into the database.';
	        if(!empty($imProperFormatData)){
	           	Storage::disk('local')->put('failed_imports.json', json_encode($imProperFormatData)); 
	           	$summary .= ' <p>'.count($imProperFormatData).' records could not be imported. <a href="'.route('downloadErrorList').'"> click here to view</a></p>';
	        }

	        return response()->json(['summary' => $summary, 'icon' => 'sucess']);
        }
    }

	public function generateIdCard(Request $request) {

		$request->validate([
            'student_ids'   => 'required|array',
            'student_ids.*' => 'integer|exists:students,id',
        ]);

        $studentIds = $request->input('student_ids', []);

		$students = DB::table('schools')->select('schools.school_name','schools.logo','schools.school_code','schools.address','schools.pincode','students.student_name','students.gender','students.student_uid','class.name as class_name','students.section_id')
	    	->join('students','students.school_id', 'schools.id')
	    	->join('class','class.id', 'students.class_id')			
			->where('students.status', 'active')
	    	->whereIn('students.id', $studentIds)->get();

        $activeCount = DB::table('students')
            ->whereIn('id', $studentIds)
            ->where('status', 'active')
            ->count();

        if ($activeCount === 0) {
            return response()->json(['error' => true, 'message' => 'No active students found']);
        }
		$grouped = $students->groupBy(function ($student) {
			return $student->class_name . '_' . $student->section_id;
		});

		// Create a temporary ZIP file
		$zipFileName = 'student_I-Cards'. '.zip';
		$zipPath = tempnam(sys_get_temp_dir(), 'zip');
		$zip = new ZipArchive;
		$zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

		foreach ($grouped as $key => $group) {
			$first = $group->first();
			$className = preg_replace('/[^A-Za-z0-9\-]/', '-', $first->class_name);
			$sectionName = 'Section-' . $first->section_id;

			$pdf = PDF::loadView('school.generate.studentIcard', ['students' => $group]);
			$pdfContent = $pdf->output();
			$zip->addFromString("{$className}/{$sectionName}_student_icards.pdf", $pdfContent);
		}

		$zip->close();
		return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
		
    }

	
	public function DOTNETREPORT(Request $request) 
	{
		
		$userId = Auth::user()->id;
		$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		
		#echo "<pre>";
		#print_r($schoolId);
		#die("----change the detail----");
			
		
		$pID = $request->query('p');
		$pID = $pID ?? 1;
		#$name   = "RelayAuth";
		#$value  = $this->generateRandomString();
		#$domain = "goforfit.in";
		
		$cookieValue = $request->cookie('my_cookie_dot');
		
	
		#$cookienm = base64_encode(base64_encode($ck_name));
		#$cookievl = base64_encode(base64_encode($ck_value));
		#$cookiedm = base64_encode(base64_encode($ck_domain));
		//$url ="https://view.goforfit.in/relay/validate.aspx?uname=principal.pragyanam&utype=3&pid=1&cval=$value";

		/*$oneMonth = 60 * 24 * 30;
		Cookie::queue('name', $name, $oneMonth);
		Cookie::queue('value', $value, $oneMonth);
		Cookie::queue('domain', $domain, $oneMonth);*/

		//return redirect()->away($url);
		if($schoolId == 2823)
		{
			//die('---first inside---');
		 $plaintext = 'uname=principal.pragyanam&utype=3&pid='.$pID.'&cval='.$cookieValue;
        }
		
		if($schoolId == 2824)
		{
			//die('----second inside---');
		 $plaintext = 'uname=ncsprincipal&utype=3&pid='.$pID.'&cval='.$cookieValue;
        }
		$encrypt_url = $this->GetEncryptedURL($plaintext ?? '');
			
		// Create the cookie
		#$cookie = cookie('my_cookie_dot', $value, 60, '/', $domain, true, false, false, 'None');

		/*return response('Cookie is set')->cookie($cookie)->withHeaders([
		'Location' => $encrypt_url
		])->setStatusCode(302);*/
		
		//return response(view('school.managestudent', compact('title', 'classes', 'check', 'classList')))
		//->cookie($cookie);
		
		$title = 'Fitness Assessment';
		if($pID  == 1)
			$title = 'Fitness Assessment';
		elseif($pID  == 2)
			$title = 'Age Wise Performance';
		elseif($pID  == 3)
			$title = 'Institute Wise Performance';
		else
			$title = 'Top Performers';			
		
		return view('school.reports', compact('title', 'encrypt_url'));
		
	}
	
	
	private function GetEncryptedURL($plaintext)
	{
		
		$password = '12345678901';
		$method   = 'aes-256-cbc';

		// Must be exact 32 chars (256 bit)
		$password = substr(hash('sha256', $password, true), 0, 32);
		#echo "Password:" . $password . "\n";

		// IV must be exact 16 chars (128 bit)
		$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

		// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
		$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));

		// My secret message 1234
		#$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);

		#echo 'plaintext=' . $plaintext . "\n";
		#echo 'cipher=' . $method . "\n";
		#echo 'encrypted to: ' . $encrypted . "\n";
		#echo 'decrypted to: ' . $decrypted . "\n\n";
		
		
		#$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);
	
		$url ="https://view.goforfit.in/relay/validate.aspx?edata=$encrypted";
		
		return $url; 
		
	}
	
	private function generateRandomString($length = 5) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for($i = 0; $i < $length; $i++) 
		{
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}

		return $randomString;
	}
	

	/**
	 * View For Fms Report.
	 * */
	public function FMSReport(Request $request)
	{
		
		$title         = 'FMS Development';
		$userId        =  \Auth::id();
		#$userDetail   =  Auth::user();
		$role_id       =  \Auth::user()->role_id;
		
		$schoolId = 0;
		if($role_id == 3)
		{
			$schoolId = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->pluck('school_id');
		}
		else if($role_id == 4)
		{
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		}
		else
		{
			die('--you dont have access for this panel. sorry for inconvenation--');
		}
		
		
		if($schoolId == 2823)
		{
	
			$classes = DB::table('custom_classes')
			->join('class','class.id','=','custom_classes.class_id')
			->select('custom_classes.id','class_id','section','class.name AS classname')
			->WhereIn('school_id', array($schoolId))
			->where('custom_classes.status','1')
			//->where('custom_classes.id','<=','10')
			->orderBy('custom_classes.orders', 'ASC')
			->get();
			
			
		}
		
		
		if($schoolId == 2824)
		{
		
		 $classes = DB::table('custom_classes')
		->join('class','class.id','=','custom_classes.class_id')
		->select('custom_classes.id','class_id','section','class.name AS classname')
		->WhereIn('school_id', array($schoolId))
		->where('custom_classes.status','1')
		//->where('custom_classes.id','<=','10')
		->orderBy('custom_classes.orders', 'ASC')
		->get();
		
		}

		if(empty($classes)){
			$classes = [];
		}

		
		return view('school.fms-report-show-students', compact('title', 'schoolId', 'classes'));
		
	}
	
	/**
	 * Fetch Students Details based on selected class.
	 * */
	public function getStudentAccordingToClass(Request $request)
	{


		$SstudentDetail = Sstudent::where('school_id', $request->school_id)->where('custom_class_id', $request->custom_class_id)->get();
		if(count($SstudentDetail)>0)
		{
			return Response::json(array('success'=>true, 'studentList'=>$SstudentDetail));
		}
		else
		{
			return Response::json(array('success'=>false, 'studentList'=>''));
		}
		
	}
	
	/**
	 * View FMS Report.
	 * */
	public function SchoolFMSskillReport(Request $request)
	{
		//die('---change the detail1---');
		$title        = 'FMS Development';
		$studentId    = $request->query('studentId');
		
		$studentInfo = DB::table('students')
		->join('schools', 'schools.id', '=' , 'students.school_id')
		->where('students.id', $studentId)
		->select('students.*','schools.school_name')
		->first();


		$ReportDetails = DB::table('skillreport_skilltype_termtype_mapping as reportMapping')
        ->join('skill_reports', 'skill_reports.id', '=', 'reportMapping.skill_report_id')
        ->join('skill_types', 'skill_types.id', '=', 'reportMapping.skill_type_id')
        ->join('term_types', 'term_types.id', '=', 'reportMapping.term_type_id')
        ->select('reportMapping.*', 'skill_reports.skill_name', 'skill_type_name', 'description', 'term_name')
        ->where('student_id', $studentId)
        ->where('reportMapping.status', 1)
        ->whereIn('reportMapping.skill_report_id', [1, 2, 3, 4])
        ->orderBy('reportMapping.skill_type_id', 'ASC')
        ->get()
        ->groupBy('skill_report_id');
	

		$ReportDetail1 = $ReportDetails->get(1, collect());
		$ReportDetail2 = $ReportDetails->get(2, collect());
		$ReportDetail3 = $ReportDetails->get(3, collect());
		$ReportDetail4 = $ReportDetails->get(4, collect());
		
		return view('school.fms-report', compact('title', 'studentInfo', 'ReportDetail1', 'ReportDetail2', 'ReportDetail3', 'ReportDetail4'));
	}
	
	/**
	 * Download FMS Report.
	 * */
	public function SchoolFMSskillReportPDF(Request $request)
	{
			//die('---change the detail1-222---');
		   //try {
			$title        = 'FMS Development';
			$studentId    = $request->query('studentId');
			
			$studentInfo = DB::table('students')
			->join('schools', 'schools.id', '=' , 'students.school_id')
			->where('students.id', $studentId)
			->select('students.*','schools.school_name', 'schools.logo')
			->first();

	
		
			$ReportDetails = DB::table('skillreport_skilltype_termtype_mapping as reportMapping')
			->join('skill_reports', 'skill_reports.id', '=', 'reportMapping.skill_report_id')
			->join('skill_types', 'skill_types.id', '=', 'reportMapping.skill_type_id')
			->join('term_types', 'term_types.id', '=', 'reportMapping.term_type_id')
			->select('reportMapping.*', 'skill_reports.skill_name', 'skill_type_name', 'description', 'term_name')
			->where('student_id', $studentId)
			->where('reportMapping.status', 1)
			->whereIn('reportMapping.skill_report_id', [1, 2, 3, 4])    //C1, c2, c3, c4
			->orderBy('reportMapping.skill_type_id', 'ASC')
			->get()
			->groupBy('skill_report_id');
			
			
			$ReportDetail1 = $ReportDetails->get(1, collect());
			$ReportDetail2 = $ReportDetails->get(2, collect());
			$ReportDetail3 = $ReportDetails->get(3, collect());
			$ReportDetail4 = $ReportDetails->get(4, collect());
			
			// echo "<pre>";
			// print_r($ReportDetail1);
			// die('----hello india----');
			
			
			
		
		
		//return view('school.fms-report-pdf', compact('title', 'studentInfo', 'ReportDetail1', 'ReportDetail2', 'ReportDetail3', 'ReportDetail4'));
	
		$pdf = PDF::loadView('school.fms-report-pdf', compact('title', 'studentInfo', 'ReportDetail1', 'ReportDetail2', 'ReportDetail3', 'ReportDetail4'));
		$titlepdf        = 'FMS-Report';
		return $pdf->stream($titlepdf.'-'.$studentId.'.pdf');
		
		/*} 
		catch(\Exception $e) 
		{
			return response()->json(['message' => 'An error occurred while generating the report. Please try again later.'], 500);
        }*/
		
		
	
	}
	
	
	/**
	 * Download All FMS Report Class-Wise. 
	 * */
	public function multiplePDFDOwnload(Request $request) {
		

		$SstudentDetail = Sstudent::where('school_id', $request->school_id)->where('custom_class_id', $request->custom_class_id)->get();
		$pdfFiles = [];
		
		
		$classSectionInfo = DB::table('custom_classes')
			->join('class', 'class.id', '=' , 'custom_classes.class_id')
			->where('custom_classes.id', $request->custom_class_id)
			->select('class.name','custom_classes.section')
			->first();
			
		$ClassSection =	$classSectionInfo->name.'-'.$classSectionInfo->section;
	
		$title  = 'FMS Development';


		// Loop through your data and generate PDFs
		foreach ($SstudentDetail as $index => $data) 
		{
				
			$studentInfo = DB::table('students')
			->join('schools', 'schools.id', '=' , 'students.school_id')
			->where('students.id', $data->id)
			->select('students.*','schools.school_name', 'schools.logo')
			->first();
			
			
			$ReportDetails = DB::table('skillreport_skilltype_termtype_mapping as reportMapping')
			->join('skill_reports', 'skill_reports.id', '=', 'reportMapping.skill_report_id')
			->join('skill_types', 'skill_types.id', '=', 'reportMapping.skill_type_id')
			->join('term_types', 'term_types.id', '=', 'reportMapping.term_type_id')
			->select('reportMapping.*', 'skill_reports.skill_name', 'skill_type_name', 'description', 'term_name')
			->where('student_id', $data->id)
			->where('reportMapping.status', 1)
			->whereIn('reportMapping.skill_report_id', [1, 2, 3, 4])
			->orderBy('reportMapping.skill_type_id', 'ASC')
			->get()
			->groupBy('skill_report_id');


			$ReportDetail1 = $ReportDetails->get(1, collect());
			$ReportDetail2 = $ReportDetails->get(2, collect());
			$ReportDetail3 = $ReportDetails->get(3, collect());
			$ReportDetail4 = $ReportDetails->get(4, collect());
		
		
			// Initialize DOMPDF
			$dompdf = new Dompdf();

			// Load your view or HTML content
			$html = view('school.fms-report-pdf', compact('title', 'studentInfo', 'ReportDetail1', 'ReportDetail2', 'ReportDetail3', 'ReportDetail4'))->render();
			$dompdf->loadHtml($html);

			// Render the PDF
			$dompdf->render();

			// Store the PDF file temporarily
			$output = $dompdf->output();
			$pdfFileName = $data->student_name."_{$data->student_uid}.pdf";
			Storage::put("temp/{$pdfFileName}", $output);

			// Keep track of the file path
			$pdfFiles[] = storage_path("app/temp/{$pdfFileName}");
			
			//die('---reach here---');
	
		}
		
		
		// Call function to create ZIP file
		return $this->createZipAndDownload($pdfFiles, $ClassSection);
		
	}
	
	
	/**
	 * Convert the mulitple file into Zip.
	 * */
	private function createZipAndDownload($pdfFiles, $ClassSection)
	{
		$zipFileName = $ClassSection.'.'.'zip';
		$zip = new ZipArchive();

		//Path where the zip file will be temporarily stored
		$zipFilePath = storage_path("app/temp/{$zipFileName}");

		if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) 
		{
			//Add each PDF file to the ZIP archive
			foreach ($pdfFiles as $pdfFile) 
			{
				$fileName = basename($pdfFile); // Extract the file name
				$zip->addFile($pdfFile, $fileName);
			}

			// Close the ZIP archive
			$zip->close();
		}

		// Download the ZIP file
		return response()->download($zipFilePath)->deleteFileAfterSend(true);
	}
   

   	/**
   	 * Note: Static data has been used for the categorization of sports. This may need to be updated in the future if additional sports categories are introduced.
   	 * */
   	public function MapSports(Request $request){

		$title = 'Map Sports';	 
		$SchoolUserId  =  \Auth::id();
		$school_id = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');
		$school = School::with('sports')->findOrFail($school_id);
		$skills = DB::table('skillareas')->where('status', 1)->where('id', '<>', 8)->get();

		// Handle AJAX request

		$fms_sports_id = ['19', '20', '21'];

	    if ($request->ajax()) {        

	        if ($request->skill_id == 1) {
	            $sports = Sport::where('display_for','=', 'school')->whereIn('id', $fms_sports_id)->orderBy('name')->get();
	        } elseif ($request->skill_id == 2) {
	        	$sports = Sport::where('display_for','=', 'school')->whereNotIn('id', $fms_sports_id)->orderBy('name')->get();
	        } else {
	            $sports = Sport::where('display_for','=', 'school')->orderBy('name')->get();
	        }

	        // Assign category to each sport
		    foreach ($sports as $sport) {
		        if (in_array($sport->id, $fms_sports_id)) {
		            $sport->category = 'Fundamental Movement Skills';
		        } else {
		            $sport->category = 'Specialised Sports Coaching';
		        }
		    }

	        $mappedSports = $school->sports->pluck('id')->toArray();
	        $alwaysChecked = $fms_sports_id;

	        $html = '';
	        foreach ($sports as $index => $sport) {
	            $isChecked = in_array($sport->id, $mappedSports) || in_array($sport->id, $alwaysChecked) ? 'checked' : '';
	            $category = $sport->category ?? 'N/A';

	            $html .= '<tr>';
	            $html .= '<td>' . ($index + 1) . '</td>';
	            $html .= '<td>' . htmlspecialchars($sport->name) . '</td>';
	            $html .= '<td>' . htmlspecialchars($category) . '</td>';
	            $html .= '<td class="text-center">';
	            $html .= '<input type="checkbox" name="sports[]" value="' . $sport->id . '" ' . $isChecked . '>';
	            $html .= '</td>';
	            $html .= '</tr>';
	        }

	        return response()->json(['html' => $html]);
	    }

		$sports = Sport::where('display_for','=', 'school')->orderBy('name', 'ASC')->get();
		foreach ($sports as $sport) {
		    if (in_array($sport->id, $fms_sports_id)) {
		        $sport->category = 'Fundamental Movement Skills';
		    } else {
		        $sport->category = 'Specialised Sports Coaching';
		    }
		}

		return view('school.map-sports', compact('title','sports','school','skills'));
	}

	public function SaveMappedSports(Request $request, $id){

		$request->validate([
			'sports' => 'required|exists:sports,id',
			'sports' => 'required|array',
			'sports.*' => 'exists:sports,id',
        ]);

		$SchoolUserId  =  \Auth::id();
		$school_id = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');
		$school = School::findOrFail($school_id);

		$filteredSports = collect($request->sports)
        ->reject(fn($sport_id) => in_array($sport_id, [19, 20 ,21]))
        ->values()
        ->all();

		$syncData = [];
		foreach ($filteredSports  as $sport_id) {
		    $syncData[$sport_id] = ['skill_id' => 2];
		}

		$school->sports()->sync($syncData);
		return redirect()->back()->with('success', 'Sports Mapped successfully!');
	}



	/**
     * Manage Trainers.
     * */
	public function RegisterTrainer(Request $request){

        $state = State::where('id', $request->state)->first();          
        $district = District::where('id', $request->district)->first();


        $validator = Validator::make($request->all(), [
            'trainerName' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Transgender',
            'qualification' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,phone|digits:10',
            'state' => 'required|integer|exists:states,id',
            'district' => 'required|integer|exists:districts,id',
            'city' => 'required|string|max:255',
            'block' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'marketing_consent' => 'accepted',
            'privacy_policy' => 'accepted',
            'term_condition' => 'accepted',
            'dob' => ['required', 'date', 'after_or_equal:start_date',
                function ($attribute, $value, $fail) use ($request) {
                    $dob = \Carbon\Carbon::parse($value);  $age = $dob->age;

                    if ($request->has('term_condition') && $age < 18) {
                        $fail('You must be at least 18 years old to accept the Terms and Conditions.');
                    }
                }],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $dob = $request->post('dob');
        $password = str_replace('-', '', $dob);

        $teacher = Teacher::create([
            'name' => $request->trainerName,
            'email' => $request->email,
            'phone' => $request->mobile,
            'position' => 'Trainer',
            'role_id' => 3,
            'status'  => 1,
            'password' => Hash::make($password),
        ]);

        if($teacher){ 
            $usermeta = new Usermeta();
            $usermeta->user_id = $teacher->id;
            $usermeta->state = $state->name;
            $usermeta->state_id = $state->id;
            $usermeta->district = $district->name;
            $usermeta->district_id = $district->id;
            $usermeta->city = $request->city;
            $usermeta->school_name = null;
            $usermeta->school_id = null;
            $usermeta->created_by = Auth::user()->id ?? null;
            $usermeta->class = null;
            $usermeta->subject = null;
            $usermeta->qualification = $request->qualification;
            $usermeta->dob = $request->dob;
            $usermeta->achievement = $request->achievement ?? null;
            $usermeta->gender = $request->gender;    
            $usermeta->save();
        }



        $school_id = DB::table('school_reference')->where('school_user_id', auth()->id())->value('school_id');
	    $exists = DB::table('school_trainers')->where('trainer_id', $request->trainer_id)->where('school_id', $school_id)->exists();
	    if ($exists) {
	        return response()->json(['message' => 'Trainer is already mapped to this school.'], 200);
	    }

	    // Insert mapping
	    DB::table('school_trainers')->insert([
	        'trainer_id' => $teacher->id,
	        'school_id' => $school_id,
	        'status' => 0,
	        'created_at' => now(),
	        'updated_at' => now(),
	        'mapped_on'  => now(),
	    ]);

        $teacher->save();
        $serial = str_pad($teacher->id, 7, '0', STR_PAD_LEFT);
        $self_registrationId = 'GFFT' . $serial;
        $teacher->update(['self_registrationId' => $self_registrationId]);

        /*
        $recipient = [
            'email' => $teacher->email,
            'name' => $teacher->name,
        ];
        $subject = 'Welcome to GoForFit, '. $teacher->name .' – Your Registration Is Successful!';
        $htmlContent = $view->make('emails.self_registration_mail', [
            'user' => $teacher,
            'password' => $password,
            'registrationId' => $self_registrationId,
        ])->render();

        $emailService->send($recipient, $subject, $htmlContent);
        */

        return back()->with('success', 'Trainer saved successfully!');
    }

    public function getDistrictList(Request $request) {

        $stateId = $request->post('stateId');
        $cities = District::where('state_id', $stateId)->get(['id', 'name']);
        return response()->json($cities);
    }



	public function MapTrainer(Request $request) {

		$title = 'Manage Trainer';	
		$SchoolUserId  =  \Auth::id();
		$school_id = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');
		
		$mappedTrainers = DB::table('school_trainers as map')
	    ->join('users as u', 'u.id', '=', 'map.trainer_id')
	    ->where('map.school_id', $school_id)
	    ->select('u.id','u.self_registrationId as self_registrationId','u.name', 'u.email','u.phone', 
	        DB::raw("CASE WHEN map.status = 1 THEN 'Mapped' ELSE 'Un-Mapped' END as status")
	    )->get();


        // echo "<pre>"; print_r($mappedTrainers);exit();

		if($request->ajax()){

			$request->validate([
		        'trainer_id' => 'required|exists:users,id'
		    ]);

		    $school_id = DB::table('school_reference')->where('school_user_id', auth()->id())->value('school_id');
		    $exists = DB::table('school_trainers')->where('trainer_id', $request->trainer_id)->where('school_id', $school_id)->where('status', 0)->exists();


		    if ($exists) {
		    	DB::table('school_trainers')->where('trainer_id', $request->trainer_id)->where('school_id', $school_id)
	                ->update([
	                    'status' => 1,
	                    'updated_at' => now(),
	                    'mapped_on' => now(),
	                ]);

	            return response()->json(['message' => 'Trainer mapped successfully!'], 200);
		    }

		   
		    DB::table('school_trainers')->insert([
		        'trainer_id' => $request->trainer_id,
		        'school_id' => $school_id,
		        'status' => 1,
		        'created_at' => now(),
		        'updated_at' => now(),
		        'mapped_on'  => now(),
		    ]);
			

			return response()->json(['message' => 'Trainer mapped successfully!'], 200);
		}

        $state_list  = State::orderBy('name', 'asc')->get();   
        $cities = District::orderBy('name', 'asc')->get(['id', 'name']);
        return view('school.map-trainer', compact('title','mappedTrainers','state_list','cities'));
	}



	public function UnMapTrainer(Request $request) {

	    $title = 'DeActivate Trainer';
	    $schoolUserId = auth()->id();
	    $school_id = DB::table('school_reference')->where('school_user_id', $schoolUserId)->where('status', 1)->value('school_id');

	    if ($request->ajax()) {

	        $request->validate([
	            'trainer_id' => 'required|exists:users,id',
	        ]);

	        $trainerId = $request->trainer_id;
	        $exists = DB::table('school_trainers')->where('trainer_id', $trainerId)->where('school_id', $school_id)->where('status', 1)->exists();

	        if ($exists) {
	          
	            DB::table('school_trainers')->where('trainer_id', $trainerId)->where('school_id', $school_id)
	                ->update([
	                    'status' => 0,
	                    'updated_at' => now(),
	                    'unmapped_on' => now(),
	                ]);

	            return response()->json(['message' => 'Trainer unmapped successfully!'], 200);
	        } else {
	            return response()->json(['message' => 'Trainer mapping not found.'], 404);
	        }
	    }
	}

	public function RemoveTrainer(Request $request) {

		if($request->ajax()){

			$trainer_id = $request->trainer_id;
			$school_id = DB::table('school_reference')->where('school_user_id', auth()->id())->value('school_id');
			
			DB::table('school_trainers')->where('school_id', $school_id)->where('trainer_id', $trainer_id)->delete();

		    return response()->json(['message' => 'Trainer Removed successfully!'], 200);
		}

	}

	public function autocomplete(Request $request) {
	    $query = $request->get('term');
	    $result = [];

		$schoolUserId = auth()->id();
	    $school_id = DB::table('school_reference')->where('school_user_id', $schoolUserId)->where('status', 1)->value('school_id');		
	    $dbQuery = DB::table('users')->where('self_registrationId','<>', null );


	    if (strpos($query, '@') !== false) {
	       
	        $trainers = $dbQuery->where('email', 'like', "%{$query}%")->limit(10)->get();
	        foreach ($trainers as $trainer) {
				$trainer_id = $trainer->id;
				$activated = DB::table('school_trainers')->where('trainer_id',$trainer_id)->where('school_id',$school_id)->where('status',1)->exists();
				$maskedMobile = str_repeat("X", strlen($trainer->phone) - 4) . substr($trainer->phone, -4);
				$result[] = [
	                'label' => $trainer->name, 
	                'value' => $trainer->name,
	                'userid' => $trainer->id,
	                'id'    => $trainer->self_registrationId,
	                'name'  => $trainer->name,
	                'email' => $this->maskEmail($trainer->email),
	                'phone' => $maskedMobile,
					'activated'=>$activated,
	            ];
	        }

	    } elseif (preg_match('/^GFFT[0-9\-]*$/i', $query)) {
	        // $trainers = DB::table('users')->where('self_registrationId', 'like', "%{$query}%")->limit(10)->get();

	        $trainers = $dbQuery->where('self_registrationId', 'like', "%{$query}%")->limit(10)->get();

	        foreach ($trainers as $trainer) {
				$trainer_id = $trainer->id;
				$activated = DB::table('school_trainers')->where('trainer_id',$trainer_id)->where('school_id',$school_id)->where('status',1)->exists();
				$maskedMobile = str_repeat("X", strlen($trainer->phone) - 4) . substr($trainer->phone, -4);
				$result[] = [
	                'label' => $trainer->name, 
	                'value' => $trainer->name,
	                'userid' => $trainer->id,
	                'id'    => $trainer->self_registrationId,
	                'name'  => $trainer->name,
	                'email' => $this->maskEmail($trainer->email),
	                'phone' => $maskedMobile,
					'activated'=>$activated,
	            ];
	        }

	    } else {
 
	        // $trainers = DB::table('users')->where('name', 'like', "%{$query}%")->limit(10)->get();
	        $trainers = $dbQuery->where('name', 'like', "%{$query}%")->limit(10)->get();
			
	        foreach ($trainers as $trainer) {
				$trainer_id = $trainer->id;
				$activated = DB::table('school_trainers')->where('trainer_id',$trainer_id)->where('school_id',$school_id)->where('status',1)->exists();
				$maskedMobile = str_repeat("X", strlen($trainer->phone) - 4) . substr($trainer->phone, -4);
				$result[] = [
	                'label' => $trainer->name, 
	                'value' => $trainer->name,
	                'userid' => $trainer->id,
	                'id'    => $trainer->self_registrationId,
	                'name'  => $trainer->name,
	                'email' => $this->maskEmail($trainer->email),
	                'phone' => $maskedMobile,
					'activated'=>$activated,
	            ];
	        }
	    }

	    return response()->json($result);
	}

	public function maskEmail($email) {
		$parts = explode("@", $email);
		$name = $parts[0];
		$domain = $parts[1];

		$visible = substr($name, 0, 4);
		$masked = str_repeat("*", max(0, strlen($name) - 4));

		return $visible . $masked . '@' . $domain;
	}



	/*
	public function MapTrainer(Request $request , EmailServiceInterface $emailService, ViewFactory $view){
		
		$title = 'Map Trainer';	
		$SchoolUserId  =  \Auth::id();
		$school_id = DB::table('school_reference')->where('school_user_id',$SchoolUserId)->where('status', 1)->value('school_id');
		
		$mappedTrainers = DB::table('school_trainers as map')
        ->join('users as u', 'u.id', '=', 'map.trainer_id')
        ->where('map.school_id', $school_id)
        ->select( 'u.id', 'u.self_registrationId as self_registrationId', 'u.name', 'u.email', 'u.phone')
        ->get();

		if($request->ajax()){

			$request->validate([
		        'trainer_id' => 'required|exists:users,id'
		    ]);


		    $school_id = DB::table('school_reference')->where('school_user_id', auth()->id())->value('school_id');
		    $exists = DB::table('school_trainers')->where('trainer_id', $request->trainer_id)->where('school_id', $school_id)->exists();
		    if ($exists) {
		        return response()->json(['message' => 'Trainer is already mapped to this school.'], 200);
		    }

		    // Insert mapping
		    DB::table('school_trainers')->insert([
		        'trainer_id' => $request->trainer_id,
		        'school_id' => $school_id,
		        'status' => 1,
		        'created_at' => now(),
		        'updated_at' => now(),
		        'mapped_on'  => now(),
		    ]);


		  
		    $teacher = Teacher::findOrFail($request->trainer_id);
        	$password = str_replace('-', '', $teacher->dob);

		    $recipient = [
	            'email' => $teacher->email,
	            'name' => $teacher->name,
	        ];
	        $subject = 'Hi !'.$teacher->name .' – Your School Mapping Is Complete';
	        $htmlContent = $view->make('emails.mapping_confm_mail', [
	            'user' => $teacher,
	            'school' => auth()->user()->name,
	            'registrationId' => $teacher->self_registrationId,
	        ])->render();

	        $emailService->send($recipient, $subject, $htmlContent);


			return response()->json(['message' => 'Trainer mapped successfully!'], 200);
		}

		return view('school.map-trainer', compact('title','mappedTrainers'));
	}


	public function autocomplete(Request $request) {
	    $query = $request->get('term');
	    $result = [];

	   $dbQuery = DB::table('users')->where('self_registrationId','<>', null );
	    if (strpos($query, '@') !== false) {
	       
	        // $trainers = DB::table('users')->where('email', 'like', "%{$query}%")->limit(10)->get();

	        $trainers = $dbQuery->where('email', 'like', "%{$query}%")->limit(10)->get();
	        foreach ($trainers as $trainer) {
	            $result[] = [
	                'label' => $trainer->email,
	                'value' => $trainer->email,
	                'userid' => $trainer->id,
	                'id'    => $trainer->self_registrationId,
	                'name'  => $trainer->name,
	                'email' => $trainer->email,
	                'phone' => $trainer->phone,
	            ];
	        }

	    } elseif (preg_match('/^GFFT[0-9\-]*$/i', $query)) {
	        // $trainers = DB::table('users')->where('self_registrationId', 'like', "%{$query}%")->limit(10)->get();

	        $trainers = $dbQuery->where('self_registrationId', 'like', "%{$query}%")->limit(10)->get();

	        foreach ($trainers as $trainer) {
	            $result[] = [
	                'label' => $trainer->self_registrationId,
	                'value' => $trainer->self_registrationId,
	                'userid' => $trainer->id,
	                'id'    => $trainer->self_registrationId,
	                'name'  => $trainer->name,
	                'email' => $trainer->email,
	                'phone' => $trainer->phone,
	            ];
	        }

	    } else {
 
	        // $trainers = DB::table('users')->where('name', 'like', "%{$query}%")->limit(10)->get();
	        $trainers = $dbQuery->where('name', 'like', "%{$query}%")->limit(10)->get();

	        foreach ($trainers as $trainer) {
	            $result[] = [
	                'label' => $trainer->name, 
	                'value' => $trainer->name,
	                'userid' => $trainer->id,
	                'id'    => $trainer->self_registrationId,
	                'name'  => $trainer->name,
	                'email' => $trainer->email,
	                'phone' => $trainer->phone,
	            ];
	        }
	    }

	    return response()->json($result);
	}

	*/


	/**
	 * Fitness Reports
	 * */

	public function FitnessReports(Request $request){


		$title         = 'Fitness Reports';
		$userId = Auth::user()->id;
		$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		

		$school = School::find($schoolId);
		$classList = $school->getClasses;

		foreach ($classList as $class) {
		    $originalClass = Sclass::where('id', $class->class_id)->orderBy('orders')->first();
		    $class->name = !empty($class->nomenclature) 
		        ? $class->nomenclature 
		        : ($originalClass ? $originalClass->name : null);

		}

		$classList = $classList->sortBy('orders')->values();
		$classList->prepend((object)[
	        'class_id' => '',
	        'name' => 'Select Class',
	        'section' => ''
	    ]);

		$classes = DB::table('schools')
		->select('class.id','class.name as className', 'nomenclature')
		->join('custom_classes' ,'custom_classes.school_id' ,'=' ,'schools.id')
		->join('class','class.id','=','custom_classes.class_id')
		->where('schools.id' ,$schoolId )
		->where('class.status' , 1 )
		->groupBy('class.id','class.name','nomenclature')
		->orderBY('class.orders')
		->get();

		

		$studentsQuery = DB::table('schools')
			->join('students', 'students.school_id', '=' , 'schools.id')
			->leftJoin('class', 'students.class_id', '=', 'class.id')
	    	->leftJoin('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
			->select(
				'schools.id as schools_id',
				'schools.school_code as school_code',
				'students.id as student_id',
				'students.student_uid as admissionnumber',
				'students.student_name as student_name',
				'students.gender',
				'students.class_id',
				'students.section_id',
				'students.custom_class_id',
				'students.dob',
				'students.email_id',
				'students.rollno',
				'students.status',
				DB::raw("CASE 
	                    WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
	                    THEN custom_classes.nomenclature 
	                    ELSE class.name 
	                 END AS display_classname"),
	        	'custom_classes.section'
			)
			->where('schools.id', $schoolId)->where('students.status', 'active');


		if ($request->has('class_id')) {
	        $classFilter = $request->input('class_id');
	        list($class_id, $section_id) = explode('-', $classFilter);
	        if (!empty($class_id)) {
	            $studentsQuery->where('students.class_id', $class_id);
	        }
	        if (!empty($section_id)) {
	            $studentsQuery->where('students.section_id', $section_id);
	        }
	    }

	    $studentsDetails = $studentsQuery->get();


	    if($request->ajax()){


			return Datatables::of($studentsDetails)
	        ->addIndexColumn()

			->addColumn('checkbox', function($row) {
		        return '<input type="checkbox" class="row-select" value="'.$row->student_id.'">';
		    })

	        ->addColumn('class_id', function($row) {
	        	return $row->display_classname;
            })

	       
	        ->addColumn('dob', function($row) {
	        	$formatted_date = null;
		        if (!empty($row->dob)) {
		            $timestamp = strtotime($row->dob);
		            if ($timestamp !== false) {
		                $formatted_date = date('d-m-Y', $timestamp);
		            } else {
		                $formatted_date = 'Fill date';
		            }
		        } else {
		            $formatted_date = 'No date provided';
		        }
                return $formatted_date;
            })

	        ->addColumn('viewReport', function($row) {
			    $url = route('reports.view', $row->student_id); 
			    $html = '<a href="'.$url.'" class="btn btn-sm btn-primary" style="text-align:center;" target="_blank">View</a>';

				$cbse_classes  = ['9','10','11','12'];

				if (in_array($row->class_id, $cbse_classes) && Auth::user()->id == 974) {
					$cbseUrl = route('reports.cbse', $row->student_id);
					$html .= ' <a href="'.$cbseUrl.'" class="btn btn-sm btn-success" target="_blank">CBSE</a>';
				}

			    return $html;
			})

            ->rawColumns(['checkbox','class_id','dob','viewReport'])
	        ->toJson();
        }

		return view('school.fitnessreports', compact('title','studentsDetails','classes','classList'));
		
	}



	public function ViewFitnessReport($id) {

	    $studentId = $id;
	    $studentsData = $this->getStudentData($studentId);

	    // echo "<pre>"; print_r($studentsData);exit();
	    
	    $TermMasterId = $this->getTermId($studentsData->schools_id);

	    $dob          = Carbon::parse($studentsData->dob);
	    $studentAge   = $dob->age;
	    $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';
	    $ageGender    = $studentAge . strtolower(substr($studentsData->gender, 0, 1));

	    // Fetch report + benchmarks
	    $reportData    = $this->getReportData($studentId,$TermMasterId);
	    $mappedReport  = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);

	    $groupedReport = $mappedReport->groupBy('Category');


	    // echo "<pre>"; print_r($studentsData); exit();
		$getBmiBenchmark = $getBmiBenchmark =  $this->getBmiBenchmark($ageGender);

	    $higherClasses = [4,5,6,7,8,9,10,11,12];
	    if (in_array($studentsData->class_id, $higherClasses)) {

			[$orderedReportData, $getFitnessBenchmark] = $this->getSeniorReportData($studentId, $studentAge, $studentGender, $groupedReport);
	        return view('assessor.reports.senior-report', compact('studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark'
	        ));

	    } else {

            [$orderedReportData, $FmsReportData, $getFitnessBenchmark] =
            $this->getJuniorReportData($studentsData->class_id, $studentId, $studentAge, $studentGender, $groupedReport, $TermMasterId);

            return view('assessor.reports.junior-report', compact('studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark'));

	    }
	}

	/**
	 * Date : 19-09-2025
	 * Get Activities Gallary.
	 * */
	public function ActivityGallary(){

		$title = 'Activities Gallary';
		return view('activity.media.gallary', compact('title'));
	}

	/**
	 * Date : 19-09-2025
	 * Function To Generate Students Credentials.
	 * */
	
	public function generateCredentials(Request $request) {
	 
	    $request->validate([
	        'student_ids'   => 'required|array',
	        'student_ids.*' => 'integer|exists:students,id',
	        'export_type'   => 'sometimes|in:excel,pdf,json',
	        'select_all'    => 'boolean'
	    ]);

	    $studentIds = $request->input('student_ids', []);
	    $exportType = $request->input('export_type', 'excel');

		$activeCount = DB::table('students')->whereIn('id', $studentIds)
                    ->where('status', 'active')
                    ->count();


		if ($activeCount === 0) {
			return response()->json(['error' => false,'message' => 'No active students']);
		}

	    if ($exportType === 'excel') {
	        return Excel::download(new StudentsCredentialsExport($studentIds), 'students-credentials.xlsx');
	    }

	    return response()->json([
	        'message' => 'Unsupported export type.',
	        'export_type' => $exportType,
	        'student_ids_count' => count($studentIds)
	    ], 400);
	}

	public function generateClassSectionCredentials(Request $request)
    {
        $request->validate([
            'student_ids'   => 'required|array',
            'student_ids.*' => 'integer|exists:students,id',
            'export_type'   => 'required|in:single,separate',
        ]);

        $studentIds = $request->input('student_ids', []);
        $exportType = $request->input('export_type', 'single');

        $activeCount = DB::table('students')
            ->whereIn('id', $studentIds)
            ->where('status', 'active')
            ->count();

        if ($activeCount === 0) {
            return response()->json(['error' => true, 'message' => 'No active students found']);
        }

        if ($exportType === 'single') {
            $export = new StudentsCredentialsExport($studentIds);
            $fileName = 'students-credentials-all-classes.xlsx';
            return Excel::download($export, $fileName);
        } else {
            return $this->generateClassFolderStructure($studentIds);
        }
    }

    private function generateClassFolderStructure($studentIds)
    {
        $classesWithSections = DB::table('students')
            ->leftJoin('class', 'students.class_id', '=', 'class.id')
            ->leftJoin('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
            ->whereIn('students.id', $studentIds)
            ->where('students.status', 'active')
            ->select(
                DB::raw("CASE 
                    WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                    THEN custom_classes.nomenclature 
                    ELSE class.name 
                END AS class_name"),
                'custom_classes.section'
            )
            ->distinct()
            ->orderBy('class_name')
            ->orderBy('custom_classes.section')
            ->get();

        if ($classesWithSections->isEmpty()) {
            return response()->json(['error' => true, 'message' => 'No class-section data found']);
        }

        $classGroups = [];
        foreach ($classesWithSections as $item) {
            $className = $item->class_name;
            if (!isset($classGroups[$className])) {
                $classGroups[$className] = [];
            }
            $classGroups[$className][] = $item->section;
        }

        $zipFileName = 'students-credentials-class-wise.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        if (!file_exists(dirname($zipPath))) {
            mkdir(dirname($zipPath), 0755, true);
        }

        $zip = new ZipArchive();
        
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($classGroups as $className => $sections) {
                $cleanClassName = $this->cleanFileName($className);
                
                foreach ($sections as $section) {
                    // Create export for each class-section
                    $export = new StudentsCredentialsExport(
                        $studentIds, 
                        $className, 
                        $section
                    );
                    
                    $cleanSection = $this->cleanFileName($section);
                    $fileName = "Section {$cleanSection}.xlsx";
                    $folderPath = "{$cleanClassName}/";
                    
                    // Store Excel file temporarily
                    $tempFileName = "temp_{$cleanClassName}_{$cleanSection}.xlsx";
                    Excel::store($export, 'temp/' . $tempFileName);
                    $tempExcelPath = storage_path('app/temp/' . $tempFileName);
                    
                    // Add to zip with folder structure
                    if (file_exists($tempExcelPath)) {
                        $zip->addFile($tempExcelPath, $folderPath . $fileName);
                    }
                }
            }
            
            $zip->close();
            
            // Clean up temporary Excel files
            foreach ($classGroups as $className => $sections) {
                $cleanClassName = $this->cleanFileName($className);
                foreach ($sections as $section) {
                    $cleanSection = $this->cleanFileName($section);
                    $tempFileName = "temp_{$cleanClassName}_{$cleanSection}.xlsx";
                    $tempExcelPath = storage_path('app/temp/' . $tempFileName);
                    
                    if (file_exists($tempExcelPath)) {
                        unlink($tempExcelPath);
                    }
                }
            }
            
            // Return zip file as download
            return response()->download($zipPath)->deleteFileAfterSend(true);
        }
        
        return response()->json(['error' => true, 'message' => 'Failed to create zip file'], 500);
    }

    private function cleanFileName($name)
    {
        // Clean filename - remove special characters and replace with underscores
        return preg_replace('/[^a-zA-Z0-9\-]/', '-', $name);
    }

    // Method to get class-section summary for frontend display
    public function getClassSectionSummary(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'integer|exists:students,id'
        ]);

        $studentIds = $request->input('student_ids');

        $classSummary = DB::table('students')
            ->leftJoin('class', 'students.class_id', '=', 'class.id')
            ->leftJoin('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
            ->whereIn('students.id', $studentIds)
            ->where('students.status', 'active')
            ->select(
                DB::raw("CASE 
                    WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                    THEN custom_classes.nomenclature 
                    ELSE class.name 
                END AS class_name"),
                'custom_classes.section',
                DB::raw('COUNT(students.id) as student_count')
            )
            ->groupBy('class_name', 'custom_classes.section')
            ->orderBy('class_name')
            ->orderBy('custom_classes.section')
            ->get();

        // Group by class for summary
        $groupedSummary = [];
        foreach ($classSummary as $item) {
            $className = $item->class_name;
            if (!isset($groupedSummary[$className])) {
                $groupedSummary[$className] = [
                    'class_name' => $className,
                    'sections' => [],
                    'total_students' => 0
                ];
            }
            $groupedSummary[$className]['sections'][] = [
                'section' => $item->section,
                'student_count' => $item->student_count
            ];
            $groupedSummary[$className]['total_students'] += $item->student_count;
        }

        return response()->json([
            'class_summary' => array_values($groupedSummary),
            'total_selected' => count($studentIds)
        ]);
    }


	public function schoolUsers(){
		$title = "School Users";

		$state_list  = State::orderBy('name', 'asc')->get();   
        $cities = District::orderBy('name', 'asc')->get(['id', 'name']);
		return view('school.manageSchoolUsers',compact('title', 'state_list'));
	}

	public function addSchoolUsers(Request $request){

		$parent = Auth::user()->id;

		$state = State::where('id', $request->state)->first();          
        $district = District::where('id', $request->district)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Transgender',
            'qualification' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'state' => 'required|integer|exists:states,id',
            'district' => 'required|integer|exists:districts,id',
            'city' => 'required|string|max:255',
            'block' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'dob' => 'required', 'date',
        ]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'Validation failed.',
				'errors'  => $validator->errors()
			], 422);
		}
		
		$school_id = DB::table('school_reference')->where('school_user_id', $parent)->value('school_id');
		$schoolData = DB::table('schools')
		->select('school_name',
			'school_code',	
		)->where('id',$school_id)->first();

		$password = 'GFFS@'.$schoolData->school_code;

		$existEmail = DB::table('users')->where('email', $request->email)->exists();
	    if ($existEmail) {
	        return response()->json(['message' => 'Email id already registered'], 409);
	    }

		$user_id = DB::table('users')->insertGetId([
			'name'     => $request->name,
			'email'    => $request->email,
			'phone'    => $request->mobile,
			'position' => 'VICE PRINCIPAL',
			'userid'    => $request->email,
			'password' => Hash::make($password),
			'role_id'  => 8,
			'status'   => 1,
		]);

		if($user_id) {
			$usermeta = new Usermeta();
			$usermeta->user_id = $user_id;
			$usermeta->state = $state->name;
			$usermeta->state_id = $state->id;
			$usermeta->district = $district->name;
			$usermeta->district_id = $district->id;
			$usermeta->city = $request->city;
			$usermeta->school_name = $schoolData->school_name;
			$usermeta->school_id = $school_id;
			$usermeta->created_by = Auth::user()->id ?? null;
			$usermeta->class = null;
			$usermeta->subject = null;
			$usermeta->qualification = $request->qualification;
			$usermeta->dob = $request->dob;
			$usermeta->achievement = $request->achievement ?? null;
			$usermeta->gender = $request->gender;    
			$usermeta->save();
		}

	    DB::table('school_reference')->insert([
	        'school_user_id' => $user_id,
	        'school_id' => $school_id,
	        'status' => 1,
	        'created_at' => now(),
	        'updated_at' => now(),
	    ]);

        // $school_user->save();
        $serial = str_pad($user_id, 6, '0', STR_PAD_LEFT);
        $self_registrationId = 'GFFSU' . $serial;
       	DB::table('users')
		->where('id', $user_id)
		->update(['self_registrationId' => $self_registrationId]);

		return response()->json(['message' => 'School user added successfully!'], 200);
		
	}



	/**
	 * Date : 23-10-2025
	 * Function: Create School's users.
	 * */
	public function CreateUsers() {

		$title = 'Create Viewer';

		$user = Auth::user();
		$DashboardModule = DashboardModule::select('role_id','name','slug','route_name','icon','order_no','status')
		->whereIn('role_id', [0, $user->role_id])
		->where('status',1)->orderBy('name')->get();

        $school_id = DB::table('school_reference')->where('school_user_id', $user->id)->where('status', 1)->value('school_id');
		
		// $schoolUsers = DB::table('school_reference as sref')
	    // ->join('users as u', 'u.id', '=', 'sref.school_user_id')
	    // ->where('sref.school_id', $school_id)
	    // ->select('u.id','u.self_registrationId as self_registrationId', 'u.userid' ,'u.name', 'u.email','u.phone', 'u.position',
	    //     DB::raw("CASE WHEN sref.status = 1 THEN 'Active' ELSE 'Inactive' END as status")
	    // )->where('u.role_id', 2)->get();    		// RoleId 2 is for School Users
	   

		$schoolUsers = DB::table('school_reference as sref')
			->join('users as u', 'u.id', '=', 'sref.school_user_id')
			->join('usermetas as um', 'um.user_id', '=', 'u.id')
			->leftJoin(DB::raw('
				JSON_TABLE(
					um.module_access,
					"$[*]" COLUMNS (route_name VARCHAR(255) PATH "$")
				) as jm
			'), DB::raw('1'), '=', DB::raw('1'))
			->leftJoin('dashboard_modules as m', 'm.route_name', '=', 'jm.route_name')
			->where('sref.school_id', $school_id)
			->where('u.role_id', 2)
			->select(
				'u.id',
				'u.self_registrationId',
				'u.userid',
				'u.name',
				'u.email',
				'u.phone',
				'u.position',
				'um.gender',
				'um.dob',
				'um.qualification',
				DB::raw("GROUP_CONCAT(DISTINCT m.name SEPARATOR ', ') as module_names"),
				DB::raw("CASE WHEN sref.status = 1 THEN 'Active' ELSE 'Inactive' END as status")
			)
			->groupBy('u.id','u.self_registrationId','u.userid','u.name','u.email','u.phone','um.gender','um.dob','um.qualification','u.position','sref.status')
			->get();


	   	// echo "<pre>"; print_r($schoolUsers);exit();

	
		$state_list  = State::orderBy('name', 'asc')->get();   
        $cities = District::orderBy('name', 'asc')->get(['id', 'name']);
		$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $school_id)->first();


		return view('school.users.school-users', compact('title','state_list','cities','DashboardModule','schoolUsers','SchoolDetails'));
	}


	private function generateUserId() {
	    $prefix = 'GFFSU';
	    $lastUser = User::orderBy('id', 'desc')->first();

	    if ($lastUser && $lastUser->userid) {
	        preg_match('/\d+$/', $lastUser->userid, $matches);
	        $number = isset($matches[0]) ? (int)$matches[0] + 1 : 1;
	    } else {
	        $number = 1;
	    }
	    $userid = $prefix . str_pad($number, 7, '0', STR_PAD_LEFT);
	    return $userid;
	}


	public function StoreViewers(Request $request) {

        $request->validate([
            'trainerName' => 'required|string|max:255',
            'gender' => 'required|string',
            'qualification' => 'required|string|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'mobile' => 'required|digits:10|unique:users,phone',
            'designation' => 'required|string',
            'dob' => 'required|date',
            'module_access' => 'required|array|min:1',
            'module_access.*' => 'string'
        ]);

        DB::beginTransaction();

        try {

			$dob = $request->post('dob');
			$password = str_replace('-', '', $dob).'@f365';

	        $user = User::create([
	            'name' => $request->trainerName,
	            'email' => $request->email,
	            'phone' => $request->mobile,                
	            'position' => $request->designation,
	            'userid' => $this->generateUserId(),
	            'self_registrationId' => $this->generateUserId(),
	            'password' => Hash::make($password), 
	            'role_id' => 2,   
	            'status' => 1, 
	            'created_at' => now(),
	            'updated_at' => now(),
	        ]);


	        /*
	        $legacyRole = \DB::table('roles')->where('id', 2)->first();
		    $spatieRole = SpatieRole::where('name', $legacyRole->name)->first();

		    if ($spatieRole) {
		        $user->assignRole($spatieRole->name);
		    }
			*/

	        $creatorId = Auth::id();
	        $schoolId = DB::table('school_reference')->where('school_user_id', $creatorId)->where('status', 1)->value('school_id');
	        if (!$schoolId) {
	            throw new \Exception("Creator is not linked to any school in school_reference.");
	        }

	        DB::table('school_reference')->insert([
	            'school_id' => $schoolId,
	            'school_user_id' => $user->id,
	            'status' => 1,
	            'created_at' => now(),
	            'updated_at' => now(),
	        ]);

	        UserMeta::updateOrCreate(
	            ['user_id' => $user->id],
	            [
	                'gender' => $request->gender,
	                'dob' => $request->dob,
	                'qualification' => $request->qualification,
	                'address' => $request->address,
	                'module_access' => json_encode($request->module_access),
	                'created_by' => $creatorId,
	                'created_at' => now(),
	                'updated_at' => now(),
	            ]
	        );

	        DB::commit();

			if ($request->ajax()) {
				return response()->json(['status' => 'success', 'message' => 'Viewer added and linked to school successfully!']);
			}
			return redirect()->back()->with('success', 'Viewer added and linked to school successfully!');

        } catch (\Throwable $e) {
	       DB::rollBack();

			if ($request->ajax()) {
				return response()->json(['status' => 'error', 'message' => 'Failed to add viewer: ' . $e->getMessage()], 500);
			}
			return redirect()->back()->with('error', 'Failed to add viewer: ' . $e->getMessage());
	    }
    }


    public function handleUsersAction(Request $request) {

	    $request->validate([
	        'users_id' => 'required|integer|exists:users,id',
	        'action' => 'required|string|in:activate,deactivate,delete'
	    ]);

	    $users = User::find($request->users_id);

	    if(!$users) {
	        return response()->json(['success' => false, 'message' => 'Trainer not found']);
	    }

	    switch($request->action) {
	        case 'activate':
	            DB::table('school_reference')->where('school_user_id', $request->users_id)->update(
	            	[  'status' => 1 , 'updated_at' => now()]
			    );
	            $message = 'Trainer activated successfully';
	            break;

	        case 'deactivate':
	            DB::table('school_reference')->where('school_user_id', $request->users_id)->update(
	            	[ 'status' => 0, 'updated_at' => now()]
			    );
	            $message = 'Trainer deactivated successfully';
	            break;

	        case 'delete':

	            DB::table('usermetas')->where('user_id', $request->users_id)->delete();
                DB::table('school_reference')->where('school_user_id', $request->users_id)->delete();

                $users->delete();

	            $message = 'Trainer deleted successfully';
	            break;

	        default:
	            return response()->json(['success' => false, 'message' => 'Invalid action']);
	    }

	    return response()->json(['success' => true, 'message' => $message]);
	}



	public function exportSchoolUsers(Request $request) {

	    $schoolUserIds = $request->input('school_user_ids', []);
	    if(empty($schoolUserIds)) {

	        return response()->json(['message' => 'No users selected'], 400);
	    }

	    $timestamp = Carbon::now()->format('Ymd_His');
		if($request->role=='trainer'){
			$fileName = "trainers-credential_{$timestamp}.xlsx";
			return Excel::download(new TrainerCredentials($schoolUserIds), $fileName);
		}
		else{
			$fileName = "school-users_{$timestamp}.xlsx";
			return Excel::download(new SchoolUserCredentials($schoolUserIds), $fileName);
		}

	}


	public function updateViewer(Request $request){

		$userId = $request->viewerId;

		$request->validate([
			'trainerName'    => 'required|string|max:255',
			'gender'         => 'required|string',
			'qualification'  => 'required|string|max:255',
			'email'          => 'required|email|unique:users,email,' . $userId,			
            'mobile' => 'required|digits:10|unique:users,phone,' . $userId,
			'designation'    => 'required|string',
			'dob'            => 'required|date',
			'module_access'  => 'required|array|min:1',
			'module_access.*'=> 'string'
		]);

		DB::table('users')
			->where('id', $userId)
			->update([
				'name'       => $request->trainerName,
				'email'      => $request->email,
				'phone'      => $request->mobile,
				'position'   => $request->designation,
				'updated_at' => now(),
			]);

		DB::table('usermetas')
			->where('user_id', $userId)
			->update([
				'gender'        => $request->gender,
				'qualification' => $request->qualification,
				'dob'           => $request->dob,
				'module_access' => json_encode($request->module_access),
				'updated_at'    => now(),
			]);

		// Return JSON response instead of redirect
		return response()->json([
			'status' => 'success',
			'message' => 'Viewer details updated successfully!',
		]);
	}



	public function StudentsSportsMapping(Request $request, DataTableListService $dataTable) {

	    $title = 'Students Sports Mapping';
	    $creatorId = Auth::id();
	    $schoolId = DB::table('school_reference')->where('school_user_id', $creatorId)->where('status', 1) ->value('school_id');
	    $school = School::find($schoolId);

	    if ($request->ajax()) {	      

	        $query = DB::table('students as s')
	            ->leftJoin('class as c', 's.class_id', '=', 'c.id')

	            ->leftJoin('custom_classes', 's.custom_class_id', '=', 'custom_classes.id')

	            ->leftJoin('student_map_sports as sms', function ($join) use ($schoolId) {
	                $join->on('s.id', '=', 'sms.student_id')
	                    ->where('sms.school_id', '=', $schoolId);
	            })
	            ->leftJoin('sports as sp', 'sms.sports_id', '=', 'sp.id')
	            ->leftJoin('users as u', 'sms.submitted_by', '=', 'u.id')
	            ->where('s.school_code', '=', $school->school_code)
	            ->select(
	                's.id',
	                's.student_name as student_name',
	                's.class_id',
	                'c.name as class',
	                's.section_id',
	                's.rollno',
	                DB::raw("CASE WHEN sp.name IS NULL THEN '---' ELSE sp.name END as sport_name"),
	                DB::raw("CASE WHEN u.name IS NULL THEN '---' ELSE u.name END as submitted_by"),
	                DB::raw("CASE WHEN sms.created_at IS NULL THEN '---' ELSE DATE_FORMAT(sms.created_at, '%d-%m-%Y') END as mapped_on"),
	                DB::raw("CASE 
							WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
							THEN custom_classes.nomenclature 
							ELSE c.name 
						 END AS display_classname"),
					'custom_classes.section'

	            )
	            ->orderByRaw('CASE WHEN sp.id IS NULL THEN 1 ELSE 0 END')
	            ->orderBy('s.class_id')
	            ->orderBy('s.section_id')
	            ->orderBy('s.student_name');

            if ($request->filled('class')) {
	            $classFilter = $request->input('class');
	            list($class_id, $section_id) = array_pad(explode('-', $classFilter), 2, null);

	            if (!empty($class_id)) {
	                $query->where('s.class_id', $class_id);
	            }

	            if (!empty($section_id)) {
	                $query->where('s.section_id', $section_id);
	            }
	        }
	        $filters = [
	            'class_id' => function ($query, $value) {
	                list($class_id, $section_id) = array_pad(explode('-', $value), 2, null);

	                if (!empty($class_id)) {
	                    $query->where('s.class_id', $class_id);
	                }

	                if (!empty($section_id)) {
	                    $query->where('s.section_id', $section_id);
	                }
	            },
	        ];
			
			$search = $request->input('search.value');
			if ($search) {
				$query->where(function ($q) use ($search) {
					$q->where('s.student_name', 'LIKE', "%{$search}%")
					->orWhere('s.section_id', 'LIKE', "%{$search}%")
					->orWhere('sp.name', 'LIKE', "%{$search}%")
					->orWhere('u.name', 'LIKE', "%{$search}%");
				});
			}

	        return $dataTable
            ->setQuery($query)
            ->setColumns([
			    'student_name' => 's.student_name',
			    // 'class' => 'display_classname',
			    'section_id' => 's.section_id',
			    'sport_name' => 'sp.name',
			    'submitted_by' => 'u.name',
			    'mapped_on' => 'sms.created_at'
			])
            ->setFilters($filters)
            ->render($request);
	    }

	    return view('school.modules.students-sports-mapping', compact('title'));
	}


    public function ExportStudentsSportsMapping(Request $request) {
	    
	    $ids = $request->input('student_ids');

	    if (empty($ids)) {
	        return response()->json(['error' => 'No IDs provided'], 400);
	    }
	    $creatorId = Auth::id();
    	$schoolId = DB::table('school_reference')->where('school_user_id', $creatorId)->where('status', 1)->value('school_id');    	
    	$school = DB::table('schools')->select('school_name')->where('id', $schoolId)->first();

    	$schoolName = $school->school_name ?? 'Unknown School';

	    $fileName = 'student_sports_mapping_' . now()->format('Y_m_d_H_i_s') . '.xlsx';

	    return Excel::download(new \App\Exports\StudentSportsMappingExport($ids, $schoolId, $schoolName), $fileName);
	}


	// date: 10-11-2025 login as student method 

	public function loginAsStudent(Request $request){

        // dd($request->student_id);
        $student = Sstudent::where('id', $request->student_id)
	        ->where('status', 'active')
	        ->first();

        // dd($student);
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student has been transferred.']);
        }

		$class = DB::table('custom_classes')
			->join('class','class.id','=','custom_classes.class_id')
			->join('students','students.custom_class_id','=' ,'custom_classes.id')
			->select('custom_classes.id','custom_classes.class_id','custom_classes.section',

				DB::raw("CASE 
					WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
					THEN custom_classes.nomenclature 
					ELSE class.name 
				END AS classname")

				// 'class.name AS classname'
			)->where('students.id',$request->student_id)->first();

        session([
            'Auth_id' => Auth::guard('web')->id(),
            'impersonate_guard' => 'web',
			'student_id' => $request->student_id,
			'student_name' => $student->student_name,
			'clsss' => $class->classname,
			'section' => $student->section_id,
			'rollno' => $student->rollno,
        ]);
        Auth::guard('sstudent')->login($student);

        $request->session()->regenerate();
        $cookie = cookie(
            'my_cookie_dot',
            $this->generateRandomString(),
            60,
            '/',
            config('app.cookie_domain'),
            true,
            true,
            false,
            'None'
        );

        return response()->json([
            'success' => true,
            'redirect_url' => route('student.dashboard')
        ])->cookie($cookie);

        return response()->json([
            'success' => true,
            'redirect_url' => route('student.dashboard')
        ]);
    }

    public function leaveStudent(Request $request){
        $schoolId = session('Auth_id');
        $guard = session('impersonate_guard');

        if (!$schoolId || !$guard) {
            return response()->json(['success' => false, 'message' => 'No impersonation session found']);
        }

        Auth::guard('sstudent')->logout();

        $user = Auth::guard($guard)->loginUsingId($schoolId);

        session()->forget(['Auth_id', 'impersonate_guard', 'student_id', 'student_name', 'clsss', 'section', 'rollno']);
        $request->session()->regenerate();
        $cookie = cookie(
            'my_cookie_dot',
            $this->generateRandomString(),
            60,
            '/',
            config('app.cookie_domain'),
            true,
            true,
            false,
            'None'
        );

        return response()->json([
            'success' => true,
            'redirect_url' => route('managestudent')
        ])->cookie($cookie);
    }

	// for cbse report card 
	public function ViewCbseReport($id){

		$studentId = $id;
	    $studentsData = $this->getStudentData($studentId);
	    $TermMasterId = $this->getTermId($studentsData->schools_id);
		
	    $dob          = Carbon::parse($studentsData->dob);
	    $studentAge   = $dob->age;
	    $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';
	    $ageGender    = $studentAge . strtolower(substr($studentsData->gender, 0, 1));
		
	    $reportData    = $this->getReportData($studentId,$TermMasterId);

		
		
	    $mappedReport  = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);
		
	    $groupedReport = $mappedReport->groupBy('Category');
		// echo"<pre>";print_r($groupedReport);exit();
		$classes = [9,10,11,12];

		return view('assessor.reports.cbse-report', compact('studentsData','groupedReport','classes'));
	}
}
