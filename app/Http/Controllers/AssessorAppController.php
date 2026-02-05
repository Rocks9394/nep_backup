<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sclass;
use App\Models\Teachingthrough;
use App\Models\Skill;
use App\Models\Sport;
use App\Models\Technique;
use App\Models\School;
use App\Models\Activity;
use App\Models\Report;
use DB;
use Response;
use Validator;
use Redirect;
use paginate;
use Session;
use PDF;
use Dompdf\Dompdf;
use App\Models\TermMaster;
use App\Services\DataTableListService;
use App\Exports\TestScoreTemplete;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportTestImproperData;
use App\Rules\ExcelTestHeaderValidation;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Imports\ImportFMSTestData;
use App\Imports\ImportFitnessTestData;
use App\Models\TestImportLog;
use Illuminate\Support\Facades\Storage;
use App\Models\Sstudent;
use App\Models\SkillReportSkillTypeTermTypeMapping;
use App\Models\SeniorTestResult;
use Carbon\Carbon;
use Auth;
use App\Traits\ReportHelperTrait;
use Illuminate\Support\Facades\Crypt;
use App\Traits\UpdateFitnessTestResults;


class AssessorAppController extends Controller
{
    use ReportHelperTrait, UpdateFitnessTestResults;

    public function __construct() {

	    $this->middleware(function ($request, $next) {        
	        if (auth()->user()->role_id != 3) {
	            abort(403, 'Unauthorized access.');
	        }

	        return $next($request);
	    })->except(['TestStatusHigherClass','TestStatusLowerClass','ViewFitnessReport','uploadTestData','testScoreSample','downloadTestTemplete','importTestData','downloadTestUploadedFile','downloadTestErrorFile']);
	}
	
	public function index(Request $request)
	{
		$title = 'Assessor APP';
		return view('assessor.index', compact('title'));
	}
	
	
	/**
	 * Fitness Assessment Dashbaord.
	 * */
	public function alltests(Request $request) {
		
		#$junior = array(10, 11, 12,2, 6, 3);
		$junior = array(10, 11, 12);
		$junior1 = array(2, 6, 3);
		
		$senior = array(8, 9, 5, 4, 15, 3);
		$cbseTests = array(6, 7, 1, 2, 131);
	
		$juniorData = DB::table('TestCategoryMaster')->whereIn('TestCategoryID',$junior)->orderByRaw('FIELD(TestCategoryID, ' . implode(',', $junior) . ')')->get();
		
		$juniorData1 = DB::table('TestCategoryMaster')->whereIn('TestCategoryID',$junior1)->orderByRaw('FIELD(TestCategoryID, ' . implode(',', $junior1) . ')')->get();
		
		$seniorData = DB::table('TestCategoryMaster')->whereIn('TestCategoryID',$senior)->orderByRaw('FIELD(TestCategoryID, ' . implode(',', $senior) . ')')->get();

		$cbseData = DB::table('TestCategoryMaster')->whereIn('TestCategoryID',$cbseTests)->orderByRaw('FIELD(TestCategoryID, ' . implode(',', $cbseTests) . ')')->get();
		
		$title = 'TAKE FITNESS ASSESSMENT';

		$userAgent = $request->header('User-Agent');


		$isPureChrome =
		(
			(str_contains($userAgent, 'Chrome') && 
			!str_contains($userAgent, 'Edg') &&
			!str_contains($userAgent, 'OPR') &&
			!str_contains($userAgent, 'SamsungBrowser'))
			||
			str_contains($userAgent, 'CriOS')
		);

		$isUnsupportedBrowser =
			str_contains($userAgent, 'Edg') || 
			str_contains($userAgent, 'OPR') ||
			str_contains($userAgent, 'Opera Mobi') ||
			str_contains($userAgent, 'Opera Mini') ||
			str_contains($userAgent, 'Safari') ||
			str_contains($userAgent, 'Ulaa') ||
			str_contains($userAgent, 'Firefox') ||
			str_contains($userAgent, 'SamsungBrowser') ||
			(
				str_contains($userAgent, 'Android') &&
				str_contains($userAgent, 'Version/') &&
				str_contains($userAgent, 'Safari') &&
				!str_contains($userAgent, 'Chrome')
			);


		if (!$isPureChrome && $isUnsupportedBrowser){
			return view('assessor.alltests', compact('title', 'juniorData', 'cbseData', 'juniorData1', 'seniorData'))->with('warning', 'Some features may not work properly!');
		}

		if(Session::get('SelectSchoolId')){	
			$SchoolId = Session::get('SelectSchoolId');			
		}else{			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();
			$SchoolId = $SchoolTrainers[0]->id;		  	
		}

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
		
	
		return view('assessor.alltests', compact('title', 'juniorData', 'cbseData', 'juniorData1', 'seniorData', 'terms', 'selectedTerm'));
	
	}
	
    public function locomotorSkills($TestcategoryId, $reportId, $SeniorBMI = false) {
		
		
		$CategoryName = DB::table('TestCategoryMaster')->where('TestCategoryID',$TestcategoryId)->value('TestCategoryName');
			
		$testType = DB::table('TestTypeMaster')->where('TestCategoryID',$TestcategoryId)->where('TestsApplicable',1)->get();
		#$testType = DB::table('TestTypeMaster')->where('TestCategoryID',$TestcategoryId)->get();

		$title = $CategoryName ?? 'Test';

		
		
		$testTypeIds = $testType->pluck('TestTypeID');

		$videos = DB::table('fitness_test_videos')
			->whereIn('testType_id', $testTypeIds)
			->get();


		return view('assessor.locomotorSkills', compact('title','testType', 'TestcategoryId', 'SeniorBMI','videos','testTypeIds'));
	}
	
	
	public function PhysicalSkills($TestcategoryId, $SeniorBMI = false) {
		
		$CategoryName = DB::table('TestCategoryMaster')->where('TestCategoryID',$TestcategoryId)->value('TestCategoryName');
			
		$testType = DB::table('TestTypeMaster')->where('TestCategoryID',$TestcategoryId)->where('TestsApplicable',2)->where('TestTypeID', '!=', 1014)->get();
		#$testType = DB::table('TestTypeMaster')->where('TestCategoryID',$TestcategoryId)->get();

		$title = $CategoryName ?? 'Test';

		$testTypeIds = $testType->pluck('TestTypeID');

		$videos = DB::table('fitness_test_videos')
			->whereIn('testType_id', $testTypeIds)
			->get();
			
		return view('assessor.locomotorSkills', compact('title','testType', 'TestcategoryId', 'SeniorBMI','videos'));		

	}


    public function FMSTypes($TestTypeId, $SeniorBMI = false) {
	
		$skillReport = DB::table('skill_reports')->select('id','skill_name','TestTypeMasterID')->where('TestTypeMasterID',$TestTypeId)->first();
		$skillTypes = DB::table('skill_types')->where('skill_report_id',$skillReport->id)->where('status', 1)->get();

		$title             = $skillReport->skill_name;
		$skillReportId     = $skillReport->id;
		$TestTypeMasterID  = $TestTypeId;
		
		$userId  = \Auth::id();
		
		
		if(Session::get('SelectSchoolId')){	
			$SchoolId = Session::get('SelectSchoolId');			
		}else{			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();
			$SchoolId = $SchoolTrainers[0]->id;		  	
		}
		

		$primaryClass_id = DB::table('class_fitness_tests')->where('test_type_id', $TestTypeId) ->where('is_active', 'active')
			->pluck('class_id')->toArray();

		$selectedClass = DB::table('custom_classes')
			->join('class','class.id','=','custom_classes.class_id')			
			->join('students','students.custom_class_id','=' ,'custom_classes.id')
			->select('custom_classes.id','custom_classes.class_id','custom_classes.section',

				DB::raw("CASE 
					WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
					THEN custom_classes.nomenclature 
					ELSE class.name 
				END AS classname")

				// 'class.name AS classname'
			)
			->whereIn('class.id', $primaryClass_id)
			->where('custom_classes.school_id', $SchoolId)
			->where('students.status','active')
			->orderBy('custom_classes.orders', 'ASC')
			->groupBy(
			'custom_classes.id',
			'custom_classes.class_id',
			'custom_classes.section',
			'custom_classes.nomenclature',
			'class.name',
				DB::raw("CASE 
					WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
					THEN custom_classes.nomenclature 
					ELSE class.name 
				END")
			)
			->get();



		$classes = DB::table('custom_classes')
			->join('class','class.id','=','custom_classes.class_id')
			->join('students','students.custom_class_id','=' ,'custom_classes.id')
			->select('custom_classes.id','custom_classes.class_id','custom_classes.section',

				DB::raw("CASE 
					WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
					THEN custom_classes.nomenclature 
					ELSE class.name 
				END AS classname")

				// 'class.name AS classname'
			)
			->whereIn('class.id', array(1,2,3))
			->where('custom_classes.school_id', $SchoolId)
			->where('students.status','active')
			->orderBy('custom_classes.orders', 'ASC')
			->groupBy(
			'custom_classes.id',
			'custom_classes.class_id',
			'custom_classes.section',
			'custom_classes.nomenclature',
			'class.name',
				DB::raw("CASE 
					WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
					THEN custom_classes.nomenclature 
					ELSE class.name 
				END")
			)
		->get();
	
		
		$query = DB::table('custom_classes')
			->join('class','class.id','=','custom_classes.class_id')
			->join('students','students.custom_class_id','=' ,'custom_classes.id')
			->select('custom_classes.id','custom_classes.class_id','custom_classes.section',
			DB::raw("CASE 
				WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
				THEN custom_classes.nomenclature 
				ELSE class.name 
			END AS classname")

			// 'class.name AS classname'
			)
		->Where('custom_classes.school_id', $SchoolId)
		->where('students.status','active')
			->orderBy('custom_classes.orders', 'ASC')
			->groupBy(
			'custom_classes.id',
			'custom_classes.class_id',
			'custom_classes.section',
			'custom_classes.nomenclature',
			'class.name',
				DB::raw("CASE 
					WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
					THEN custom_classes.nomenclature 
					ELSE class.name 
				END")
			);

		$seniorclasses = $query->whereIn('class.id', array(4,5,6,7,8,9,10,11,12))->get();
		$additionalClasses = $query->whereIn('class.id', array(9,10,11,12))->get();
		
		
		$students = DB::table('students')
		->join('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
		->join('class', 'class.id', '=', 'custom_classes.class_id')
		->select(
			'students.id',
			'students.rollno',
			'students.student_name',
			'students.custom_class_id',
			'custom_classes.section',
			DB::raw("CASE 
				WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
				THEN custom_classes.nomenclature 
				ELSE class.name 
			END AS classname")
		)
		->where('students.school_id', $SchoolId)
		->orderBy('custom_classes.orders', 'ASC')
		->get();

		$TermMasterId =  $this->getTermId($SchoolId);

		if($skillReport->skill_name == 'BMI' && $SeniorBMI == false)
		{

			$title = $skillReport->skill_name;
			return view('assessor.bmi', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
		}
		elseif($skillReport->skill_name == 'BMI' && $SeniorBMI == true)
		{
		
			$classes = $seniorclasses;
			$title = $skillReport->skill_name;
			return view('assessor.senior-bmi', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
		}
		elseif($skillReport->skill_name == 'Flamingo Balance Test')
		{
			$title = $skillReport->skill_name;
			return view('assessor.flamingo', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		elseif($skillReport->skill_name == 'Plate Tapping')
		{
			$title = $skillReport->skill_name;
			return view('assessor.plate-tapping', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		// additional tests for cbse report 
		elseif($skillReport->skill_name == 'Flamingo Balance Test' && $SeniorBMI == true)
		{
			$classes = $additionalClasses;
			$title = $skillReport->skill_name;
			return view('assessor.flamingo', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		elseif($skillReport->skill_name == 'Plate Tapping' && $SeniorBMI == true)
		{
			$classes = $additionalClasses;
			$title = $skillReport->skill_name;
			return view('assessor.plate-tapping', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		//hand wall toss
		elseif($skillReport->skill_name == 'Alternative Hand Wall Toss Test')
		{
			$classes = $additionalClasses;
			$title = $skillReport->skill_name;
			return view('assessor.hand-toss', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}			
		//flexed/Bent Arm hang
		elseif($skillReport->skill_name == 'Flexed/Bent Arm Hang')
		{
			$classes = $additionalClasses;
			$title = $skillReport->skill_name;
			return view('assessor.bent-armhang', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		// Shuttle Run (4×10 m)
		elseif($skillReport->skill_name == 'Shuttle Run (4×10 m)')
		{
			$classes = $additionalClasses;
			$title = $skillReport->skill_name;
			return view('assessor.shuttle-run', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		// Vertical Jump
		elseif($skillReport->skill_name == 'Vertical Jump')
		{
			$classes = $additionalClasses;
			$title = $skillReport->skill_name;
			return view('assessor.vertical-jump', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		elseif($skillReport->skill_name == 'Push Ups')
		{
			$classes = $seniorclasses;
			
			$title = $skillReport->skill_name;
			return view('assessor.muscular-endurance', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		elseif($skillReport->skill_name == 'Partial curl up 30 sec')
		{
			$classes = $seniorclasses;
			
			$title = $skillReport->skill_name;
			return view('assessor.strength', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		elseif($skillReport->skill_name == 'Sit and Reach Test')
		{
			$classes = $seniorclasses;
			
			$title = $skillReport->skill_name;
			return view('assessor.flexibility', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		elseif($skillReport->skill_name == '50 mt. dash' || $skillReport->skill_name == '600 meter run/walk')
		{
			
			$classes = $seniorclasses;
			
			
			$title = $skillReport->skill_name;
			return view('assessor.speed', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
			
		}
		else{
			
			$classes = $selectedClass;
			
			return view('assessor.fms-types', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','students'));
		}
	
	}
	

   
    function SubmitFMSType(Request $request) {
			
		$alldata = $request->all();
		$userId  = \Auth::id();
		
		if(Session::get('SelectSchoolId'))
		{	
			$SchoolId = Session::get('SelectSchoolId');
			
		}else
		{
			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

			$SchoolId = $SchoolTrainers[0]->id;
		  	
		}
		
		$TermMasterId =  $this->getTermId($SchoolId);

		if(!empty($alldata['description']) && count($alldata['description']) > 0) {

			foreach($alldata['description'] as $key =>$val)	{

				$TypeMapping = new SkillReportSkillTypeTermTypeMapping();
				$TypeMapping->school_id         = $alldata['SchoolId'];
				$TypeMapping->term_master_id    = $TermMasterId;
				$TypeMapping->student_id        = $alldata['student_id'];
				$TypeMapping->skill_report_id   = $alldata['skillReportId'];
				$TypeMapping->skill_type_id     = $val;
				$TypeMapping->skill_type_value  = !empty($val)?'Y':'';
				//$TypeMapping->term_type_id    = $request->sector;
				$TypeMapping->term_type_id      =  1;
				$TypeMapping->status      		=  1;
				$TypeMapping->created_at        = now();
				$TypeMapping->updated_at        = now();
				$TypeMapping->save();
				
			}

			$score = count($alldata['description']) . ' / 5';			
			$this->UpdateLowerTestStatus($alldata['student_id'], $TermMasterId, $alldata['skillReportId'], $score, $alldata['SchoolId'], null, null);
			
			$message = $this->TestMessage($alldata['student_id'],$alldata['skillReportId']);
			return response()->json(['success' => true,'message' => $message]);
			
		} else {	
			
			return response()->json(['success' => false,'message' => 'Something went wrong.']);
		}
				
			
	}

    public function SubmitBMIRecord(Request $request) {
	   
	    $alldata = $request->all();
		$userId  = \Auth::id();
		
		if(Session::get('SelectSchoolId')) 	{	
			$SchoolId = Session::get('SelectSchoolId');
			
		}else {			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();
			$SchoolId = $SchoolTrainers[0]->id;		  	
		}		
		
		$TermMasterId =  $this->getTermId($SchoolId);

		$student = Sstudent::where('id',$alldata['student_id'])->select('gender','dob')->first();
		$dob = Carbon::parse($student->dob);
	    $studentAge = $dob->age;
	    $studentGender = $student->gender;
	    $ageGender = $studentAge . strtolower(substr($studentGender, 0, 1));

		if($alldata['height'] !='' &&  $alldata['weight'] !='') {
				
		    $HeightMM = $alldata['height'] / 100; 
			$BMI = $alldata['weight'] / ($HeightMM * $HeightMM);


			/* SP for calculating BMI benchmark */
			$result = DB::selectOne("CALL GetBmiLevel(?, ?)", [$ageGender, $BMI]); 

		
			$Result = new SeniorTestResult();
			
			$Result->SchoolID     = $alldata['SchoolId'];
			$Result->StudentID    = $alldata['student_id'];
			$Result->TermId       = $TermMasterId;
			$Result->TestTypeID   = $alldata['skillReportId'];
			$Result->Score   	  = $BMI;
			$Result->created_at   = now();
			$Result->CreatedBy    = $userId;
			$Result->updated_at   = now();
			$Result->ModifiedBy   = $userId;
			$Result->height       = $alldata['height'];
			$Result->weight       = $alldata['weight'];
			$Result->level        = $result->level_code;
			$Result->save();
		
			$BMIValue = round($BMI, 2);
			$BMIDisplay = $BMIValue. ' kg/m²';

			if($request->input('testtype') === 'seniorbmi') {

				// Need to craete the Method
				$this->UpdateSeniorTestStatus($alldata['student_id'],$TermMasterId, $alldata['skillReportId'],$BMIDisplay,$alldata['SchoolId'], $alldata['height'], $alldata['weight']);
			}

			if($request->input('testtype') === 'juniorbmi') {				
				$this->UpdateLowerTestStatus($alldata['student_id'], $TermMasterId, $alldata['skillReportId'], $BMIDisplay, $alldata['SchoolId'], $alldata['height'], $alldata['weight']);
			}
	
			$message = $this->TestMessage($alldata['student_id'],$alldata['skillReportId']);
			return response()->json(['success' => true,'message' => $message]);
		} else {
			return response()->json(['success' => false,'message' => 'Something went wrong.']);
		}
	   
	   
    }
   

  	function timeToMilliseconds($time) {
	    list($minutes, $seconds, $milliseconds) = explode(":", $time);
	    $totalMilliseconds = ($minutes * 60 * 1000) + ($seconds * 1000) + $milliseconds;
	    return $totalMilliseconds;
	}


    public function SubmitFlamingoRecord(Request $request) {
	   
	    $alldata = $request->all();
		$userId  = \Auth::id();
		
		
		if(Session::get('SelectSchoolId'))
		{	
			$SchoolId = Session::get('SelectSchoolId');
			
		}else
		{
			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

			$SchoolId = $SchoolTrainers[0]->id;
		  	
		}
		
		
		$TermMasterId =  $this->getTermId($SchoolId);
		

		$checktime = $this->timeToMilliseconds($alldata['timetaken']);
		$checkSeconds = intval($checktime / 1000);
		$pauseCount = $alldata['total_number'];

		if ($checkSeconds < 30 && $alldata['total_number'] > 14) {
		    $alldata['total_number'] = 1000;
		}else if ($checkSeconds < 60 && $alldata['total_number'] > 26) {
		    $alldata['total_number'] = 500;
		}else{
			$alldata['total_number'] = $pauseCount;

		}

		if($alldata['total_number'] >='00' && $alldata['student_id'] !='') 	{

		
		    // $levels = $this->GetFitnessLevel($alldata['student_id'], $alldata['TestTypeMasterID'], $alldata['total_number'], 'Less_is_better');
			$levels = $this->GetFitnessTestLevel($alldata['student_id'], $alldata['TestTypeMasterID'], $alldata['total_number'], 'Less_is_better');

			$Result = new SeniorTestResult();
			
			$Result->SchoolID     = $alldata['SchoolId'];
			$Result->StudentID    = $alldata['student_id'];
			$Result->TermId       = $TermMasterId;
			$Result->TestTypeID   = $alldata['skillReportId'];
			$Result->Score   	  = $alldata['total_number'];
			$Result->created_at   = now();
			$Result->CreatedBy    = $userId;
			$Result->updated_at   = now();
			$Result->ModifiedBy   = $userId;
			$Result->level        = $levels;
			$Result->save();
		
			$score = $alldata['total_number'] .' times';
			$this->UpdateLowerTestStatus($alldata['student_id'], $TermMasterId, $alldata['skillReportId'], $score , $alldata['SchoolId'], null, null);

	
			$message = $this->TestMessage($alldata['student_id'],$alldata['skillReportId']);
			return response()->json(['success' => true,'message' => $message]);
			
		}else
		{
			return response()->json(['success' => false,'message' => 'Something went wrong.']);
		}
	   
    }
  
   
    public function SubmitPlateTappingRecord(Request $request) {
	   
		$alldata = $request->all();
		$userId  = \Auth::id();
		

		if(Session::get('SelectSchoolId'))
		{	
			$SchoolId = Session::get('SelectSchoolId');
			
		}else
		{
			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

			$SchoolId = $SchoolTrainers[0]->id;
		  	
		}
		
		
		$TermMasterId =  $this->getTermId($SchoolId);
		
		

		if($alldata['total_miliseconds'] !='' && $alldata['student_id'] !='')
		{

			$milliseconds = $alldata['total_miliseconds']; 
			$seconds = $milliseconds / 1000; 		    
		    $levels = $this->GetFitnessTestLevel($alldata['student_id'], $alldata['TestTypeMasterID'], $milliseconds, 'Less_is_better');

		    //$levels = $this->GetFitnessLevel($alldata['student_id'], $alldata['TestTypeMasterID'], $alldata['total_miliseconds'], 'Less_is_better');
		    
			$Result = new SeniorTestResult();
			
			$Result->SchoolID     = $alldata['SchoolId'];
			$Result->StudentID    = $alldata['student_id'];
			$Result->TermId       = $TermMasterId;
			$Result->TestTypeID   = $alldata['skillReportId'];
			$Result->Score   	  = $alldata['total_miliseconds'];
			$Result->created_at   = now();
			$Result->CreatedBy    = $userId;
			$Result->updated_at   = now();
			$Result->ModifiedBy   = $userId;
			$Result->level        = $levels;
			$Result->save();

			$score = $seconds .' Sec';
			$this->UpdateLowerTestStatus($alldata['student_id'], $TermMasterId, $alldata['skillReportId'], $score , $alldata['SchoolId'], null, null);
			
			$message = $this->TestMessage($alldata['student_id'],$alldata['skillReportId']);
			return response()->json(['success' => true,'message' => $message]);
			
		}else
		{
			return response()->json(['success' => false,'message' => 'Something went wrong.']);
		}
	   
    }

   
    public function SubmitSpeedRecord(Request $request) 	{
		$alldata = $request->all();
		$userId  = \Auth::id();
		
		$students = $request->students ?? [];
		

		if(Session::get('SelectSchoolId'))
		{	
			$SchoolId = Session::get('SelectSchoolId');
			
		}else
		{
			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

			$SchoolId = $SchoolTrainers[0]->id;
		  	
		}
		
		
		$TermMasterId =  $this->getTermId($SchoolId);
		
		
		
		if(count($students) >0)	{
			$studentIdsArray = [];
			foreach($students as $key => $val) 	{
				
				$studentId = $val['id'];
				$studentIdsArray[] = $val['id']; 
				$studentTime = $val['time'];

				$studentTimeInSec = $studentTime / 1000;
				if($alldata['TestTypeMasterID'] == 54 || $alldata['TestTypeMasterID'] == 19){
					$levels = $this->GetFitnessTestLevel($studentId, $alldata['TestTypeMasterID'], $studentTime, 'Less_is_better');
				}

				$Result = new SeniorTestResult();
				$Result->SchoolID     = $alldata['SchoolId'];
				$Result->TermId       = $TermMasterId;
				$Result->TestTypeID   = $alldata['skillReportId'];
				$Result->StudentID    = $studentId;
				$Result->Score   	  = $studentTime;
				$Result->created_at   = now();
				$Result->CreatedBy    = $userId;
				$Result->updated_at   = now();
				$Result->ModifiedBy   = $userId;
				$Result->level        = $levels ?? '';
				$Result->save();


				$score = $studentTimeInSec .' Sec';
				$this->UpdateSeniorTestStatus($studentId,$TermMasterId, $alldata['skillReportId'],$score,$alldata['SchoolId'], null, null);
				$messages[] = $this->TestMessage($studentId, $alldata['skillReportId']);
			}

			$message = $this->TestMessage($studentIdsArray, $alldata['skillReportId']);
			return response()->json(['success' => true, 'message' => $message]);
			
			
		}else {
			return response()->json(['success' => false,'message' => 'Something went wrong.']);
		}
	
	}


    public function SubmitPushUpRecord(Request $request)
	{
		
		$alldata = $request->all();
		$userId  = \Auth::id();
			
		if(Session::get('SelectSchoolId'))
		{	
			$SchoolId = Session::get('SelectSchoolId');
			
		}else
		{
			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

			$SchoolId = $SchoolTrainers[0]->id;
		  	
		}
		
		
		$TermMasterId =  $this->getTermId($SchoolId);
		
		if($alldata['total_push_up'] !='' && $alldata['student_id'] !='') {

			$levels = $this->GetFitnessTestLevel($alldata['student_id'], $alldata['TestTypeMasterID'], $alldata['total_push_up'], 'More_is_better');

			$Result = new SeniorTestResult();
			
			$Result->SchoolID     = $alldata['SchoolId'];
			$Result->StudentID    = $alldata['student_id'];
			$Result->TermId       = $TermMasterId;
			$Result->TestTypeID   = $alldata['skillReportId'];
			$Result->Score   	  = $alldata['total_push_up'];
			$Result->created_at   = now();
			$Result->CreatedBy    = $userId;
			$Result->updated_at   = now();
			$Result->ModifiedBy   = $userId;
			$Result->level        = $levels;
			$Result->save();
		
			$score = $alldata['total_push_up'] .' times'; 	
			$this->UpdateSeniorTestStatus($alldata['student_id'],$TermMasterId, $alldata['skillReportId'], $score ,$alldata['SchoolId'], null, null);

			$message = $this->TestMessage($alldata['student_id'],$alldata['skillReportId']);
			return response()->json(['success' => true,'message' => $message]);
			
		}else {
		     return response()->json(['success' => false,'message' => 'Something went wrong.']);
		}


	}		
	
	
	public function SubmitPartialCurlUpRecord(Request $request)
	{
		
		$alldata = $request->all();
		$userId  = \Auth::id();
	
	
		if(Session::get('SelectSchoolId'))
		{	
			$SchoolId = Session::get('SelectSchoolId');
			
		}else
		{
			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

			$SchoolId = $SchoolTrainers[0]->id;
		  	
		}
		
		
		$TermMasterId =  $this->getTermId($SchoolId);
		
		
		if($alldata['count_total_number'] !='' && $alldata['student_id'] !='') {

			$levels=$this->GetFitnessTestLevel($alldata['student_id'], $alldata['TestTypeMasterID'], $alldata['count_total_number'], 'More_is_better');

			$Result = new SeniorTestResult();
			
			$Result->SchoolID     = $alldata['SchoolId'];
			$Result->StudentID    = $alldata['student_id'];
			$Result->TermId       = $TermMasterId;
			$Result->TestTypeID   = $alldata['skillReportId'];
			$Result->Score   	  = $alldata['count_total_number'];
			$Result->created_at   = now();
			$Result->CreatedBy    = $userId;
			$Result->updated_at   = now();
			$Result->ModifiedBy   = $userId;
			$Result->level        = $levels;
			$Result->save();
		
			$score = $alldata['count_total_number'] .' times';
			$this->UpdateSeniorTestStatus($alldata['student_id'],$TermMasterId, $alldata['skillReportId'], $score,$alldata['SchoolId'], null, null);

			$message = $this->TestMessage($alldata['student_id'],$alldata['skillReportId']);
			return response()->json(['success' => true,'message' => $message]);
			
		}else
		{
					return response()->json(['success' => false,'message' => 'Something went wrong.']);
		}
	}
	
	
	public function SubmitSitAndReachRecord(Request $request)
	{
		
		$alldata = $request->all();
		$userId  = \Auth::id();
		
		if(Session::get('SelectSchoolId'))
		{	
			$SchoolId = Session::get('SelectSchoolId');
			
		}else
		{
			
			$SchoolTrainers = DB::table('school_trainers')
			->join('schools','schools.id','=','school_trainers.school_id')
			->select('schools.school_name','schools.id','schools.logo')
			->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

			$SchoolId = $SchoolTrainers[0]->id;
		  	
		}
		
		
		$TermMasterId =  $this->getTermId($SchoolId);
		
		
		if($alldata['result'] !='' && $alldata['student_id'] !='') 	{

			$studentScore = $alldata['result'] / 10;
			$levels = $this->GetFitnessTestLevel($alldata['student_id'], $alldata['TestTypeMasterID'], $alldata['result'], 'More_is_better');

			$Result = new SeniorTestResult();
			
			$Result->SchoolID     = $alldata['SchoolId'];
			$Result->StudentID    = $alldata['student_id'];
			$Result->TermId       = $TermMasterId;
			$Result->TestTypeID   = $alldata['skillReportId'];
			$Result->InitialScore = $alldata['initial_cm'];
			$Result->FinalScore   = $alldata['final_cm'];
			$Result->Score   	  = $alldata['result'];
			$Result->created_at   = now();
			$Result->CreatedBy    = $userId;
			$Result->updated_at   = now();
			$Result->ModifiedBy   = $userId;
			$Result->level        = $levels;
			$Result->save();
				
			$score = $studentScore .' cm';
			$this->UpdateSeniorTestStatus($alldata['student_id'],$TermMasterId, $alldata['skillReportId'], $score,$alldata['SchoolId'], null, null);

			$message = $this->TestMessage($alldata['student_id'],$alldata['skillReportId']);
			return response()->json(['success' => true,'message' => $message]);

		}else
		{
			return response()->json(['success' => false,'message' => 'Something went wrong.']);
		}
		
	}
	
	

	public function agility()
	{
		$title = 'Agility';
		return view('assessor.agility', compact('title'));
	}





	public function studentCode()
	{
		$title = 'Enter Test';
		return view('assessor.student-code', compact('title'));
	}

	public function TestPage() {

	    $title = 'Juniors Report';
		$pdf = PDF::loadView('assessor.reports')->setPaper('A4', 'portrait');
		return $pdf->stream($title . '.pdf');
	}
	
	public function TestPageS() {

		$title = 'Seniors Report';
		$pdf = PDF::loadView('assessor.reports-senior')->setPaper('A4', 'portrait');
		return $pdf->stream($title . '.pdf');
	}
	
    public function PrimaryCLassReport() {

		$title = 'Primary CLass Report';
		$pdf = PDF::loadView('assessor.reports.primary-report')->setPaper('A4', 'portrait');
		return $pdf->stream($title . '.pdf');
	}

	public function PrimaryCLassReportHtml() {

		$title = 'Primary CLass Report Html';
		return view('assessor.reports.primary-report-html', compact('title'));

	}

	
	public function manipulativeSkills()
	{
		$title = 'Manipulative Skills';
		return view('assessor.manipulativeSkills', compact('title'));
	}
	
	public function bodyManagement()
	{
		$title = 'Body Management Skills';
		return view('assessor.body-management', compact('title'));
	}
	
	public function running()
	{
		$title = 'Running';
		return view('assessor.running', compact('title'));
	}
	
	public function speed()
	{
		$title = 'Speed';
		return view('assessor.speed', compact('title'));
	}
	
	public function strength()
	{
		$title = 'Core Strength';
		return view('assessor.strength', compact('title'));
	}
	
	public function bmi()
	{
		$title = 'BMI';
		return view('assessor.bmi', compact('title'));
	}
	
	public function scan()
	{
		$title = 'Scan';
		return view('assessor.scan', compact('title'));
	}
	
	public function flexibility()
	{
		$title = 'Flexibility';
		return view('assessor.flexibility', compact('title'));
	}
	

	
	public function ReportsPage()
	{


		$title = 'Reports Page';
		$pdf = PDF::loadView('assessor.reportspdf', compact('title'));
		$filename  = 'Reports.pdf';
		return $pdf->download($filename);
	}
	
	public function plateTapping()
	{
		$title = 'Plate Tapping';
		return view('assessor.plate-tapping', compact('title'));
	}
	
	public function flamingo()
	{
		$title = 'Flamingo';
		return view('assessor.flamingo', compact('title'));
	}
	
	public function MuscularEndurance()
	{
		$title = 'muscular Endurance';
		return view('assessor.muscular-endurance', compact('title'));
	}
	
	
	public function getStudentsRoll(Request $request) {


		
		$userId = Auth::id();

		if (Session::has('SelectSchoolId')) {
            $SchoolId = Session::get('SelectSchoolId');
        } else {
            $SchoolId = DB::table('school_trainers')
			->join('schools', 'schools.id', '=', 'school_trainers.school_id')
			->where('school_trainers.trainer_id', $userId)
			->where('school_trainers.status', 1)
			->value('schools.id');
        }

	    $school = School::find($SchoolId);
		
	    $query = $request->get('query');
	    $classCustom = $request->get('class_id'); 

		$testStatus = $request->test_status;
		// $TermMasterId = $request->TermMasterId;
		$skillReportId = $request->skillReportId;
		$testType = $request->testType;
	    if (!$classCustom) {
	        return response()->json([]);
	    }

		$termMasterId =  $this->getTermId($SchoolId);

	    [$customClassId, $classId, $sectionId] = explode('-', $classCustom);


		$getData =  DB::table('students')
				->where('school_code', $school->school_code)
				->where('class_id', $classId)
				->where('custom_class_id', $customClassId)
				->where('section_id', $sectionId)
				->where('status','active');

			if ($testStatus == "all") {
				$students = $getData->select('id', 'rollno', 'student_name','user_id')
					->orderBy('rollno', 'asc')
					->get();
			} else if ($testStatus == "remaining" && $testType == "allFmsTest") {
				$students = $getData->whereNotExists(function ($query) use ($skillReportId,$termMasterId) {
						$query->select(DB::raw(1))
							->from('skillreport_skilltype_termtype_mapping as mapping')
							->whereRaw('mapping.student_id = students.id')
							->where('mapping.skill_report_id', '=', $skillReportId)
							->where('mapping.term_master_id', '=', $termMasterId);
					})
					->select('students.id', 'students.rollno', 'students.student_name', 'students.user_id')
					->orderBy('students.rollno', 'asc')
					->get();
			} else {
				$students = $getData->whereNotExists(function ($query) use ($skillReportId,$termMasterId) {
						$query->select(DB::raw(1))
							->from('SeniorTestResults as mapping')
							->whereRaw('mapping.StudentID = students.id')
							->where('mapping.TestTypeID', '=', $skillReportId)
							->where('mapping.TermId', '=', $termMasterId);
					})
					->select('students.id', 'students.rollno', 'students.student_name', 'students.user_id')
					->orderBy('students.rollno', 'asc')
					->get();
			}

			
	    return response()->json($students);
	}


	public function fetchStudentDetail(Request $request) {
		
		$classId = $request->class_id;
		$customClassId = $request->custom_class_id;
		$rollNo = $request->roll_no;
		$student_id = $request->studentId;
		$skillReportId = $request->skillReportId;
		$testType = $request->testType;

		$SchoolId = $request->school_id;
		$school = School::find($SchoolId);
		
		$student_reg_no = $request->student_reg_no;
		
		if($student_reg_no){
			$scan_classes = $request->scan_classes;
			$classIds = collect($scan_classes)->pluck('class_id')->toArray();

			$existsInSchool = DB::table('students')
            ->where('user_id', 'LIKE', "%{$student_reg_no}%")
            ->where('school_id', $SchoolId)
            ->exists();

			if (!$existsInSchool) {
				return response()->json(['error' => false,'message' => 'You/Student are not authorised']);
			}

			$existsInClass = DB::table('students')
				->where('user_id', 'LIKE', "%{$student_reg_no}%")
				->whereIn('class_id', $classIds)
				->exists();

			if (!$existsInClass) {
				return response()->json(['error' => false,'message' => 'Student not eligible for test.']);
			}	
			if (is_string($scan_classes)) {
				$scan_classes = json_decode($scan_classes, true);
			}

			$student = DB::table('students')
			->where('students.user_id', 'LIKE', "%{$student_reg_no}%")
			->join('custom_classes', 'students.class_id', '=','custom_classes.class_id')
			->join('class', 'custom_classes.class_id', '=', 'class.id')
			->join('schools', 'students.school_id', '=', 'schools.id')
			->where('students.status', 'active')
			->where('students.school_id', $SchoolId)
			->whereIn('students.class_id', $classIds)
			->select(
				'students.id',
				'students.user_id',
				'students.rollno',
				'students.school_id',
				'students.school_code',
				'students.student_name',
				'students.gender',
				'students.dob',
				'custom_classes.id as custom_class_id',
				'custom_classes.section',
				DB::raw("
					CASE 
						WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
						THEN custom_classes.nomenclature 
						ELSE class.name 
					END AS classname
				")
			)
			->first();

			$cls = $student->classname;
			$sec = $student->section;
			$className = $cls.'-'.$sec;
		}else{
			
			$className = $request->class_name;
			$student =  DB::table('students')
			->where('id', $student_id)
			->select('id', 'rollno','user_id' ,'school_id','school_code','student_uid','student_name','gender','custom_class_id','class_id','section_id','dob')->where('status','active')
			->first();
		}
		
		
		if ($student) {

			$dob = $student->dob ;
			$age = Carbon::parse($dob)->age;
			$schoolId = $student->school_id;

	        
			$termMasterId =  $this->getTermId($schoolId);


	        switch ($testType) {
	        	case 'allFmsTest':
	        		$testExists = DB::table('skillreport_skilltype_termtype_mapping')   
	                ->where('student_id', $student->id)
	                ->where('school_id', $schoolId)
	                ->where('term_master_id', $termMasterId)
	                ->where('skill_report_id', $skillReportId)
	                ->exists();
	        		break;

	        	case 'fitnessTest':
	        		$testExists = DB::table('SeniorTestResults')    
	                ->where('StudentID', $student->id)
	                ->where('SchoolID', $schoolId)
	                ->where('TermId', $termMasterId)
	                ->where('TestTypeID', $skillReportId)
	                ->exists();
	        		break;

	        	default:
	        		
	        		break;
	        }

			return response()->json([
				'success' => true,
				'data' => [
					'name' => $student->student_name,
					'class_name' => $className ?? 'N/A',
					'student_registration_no' => $student->user_id ?? 'N/A',
					'student_id' => $student->id ?? 'N/A',
					'Age' => $age ?? 'N/A',
					'Gender' => $student->gender ?? 'N/A',
					'student_roll_no' =>$student->rollno ?? 'N/A',
					'test_already_given' => $testExists ? true : false,
				]
			]);
		} else 	{
			return response()->json(['success' => false,'message' => 'The student is not found in selected class.']);
		}
    }


    /**
     * Date : 01-05-2025.
     * Clear Existing Records If Retake Of Test Is Required.
     * */
	public function clearExistingRecords(Request $request) {


	    $studentId = $request->student_id;
	    $classId   = $request->class_id;
	    $testType = $request->testType;

	    try {

	        //$schoolId = $request->school_id;
	        $termMasterId =  $this->getTermId($request->school_id);

		 // echo "<pre";  print_r($termMasterId);exit();

			switch ($testType) {
	        	case 'allFmsTest':
	        		$testExists = DB::table('skillreport_skilltype_termtype_mapping')
	                ->where('student_id', $studentId)
	                ->where('school_id', $request->school_id)
	                ->where('term_master_id', $termMasterId)
	                ->where('skill_report_id', $request->skillReportId)
	                ->delete();
	                $this->UpdateLowerTestStatus($studentId, $termMasterId, $request->skillReportId, null, $request->school_id, null, null);
	        		break;

	        	case 'fitnessTest':
	        		$testExists = DB::table('SeniorTestResults')
	                ->where('StudentID', $studentId)
	                ->where('SchoolID', $request->school_id)
	                ->where('TermId', $termMasterId)
	                ->where('TestTypeID', $request->skillReportId)
	                ->delete();

	                if($request->skillReportId == 18){
	                	//UpdateFitnessTestResults::dispatch($studentId,$termMasterId, $request->skillReportId,'---', $schoolId, '', '');
	                    $this->UpdateLowerTestStatus($studentId, $termMasterId, $request->skillReportId, null, $request->school_id, '', '');
						$this->UpdateSeniorTestStatus($studentId, $termMasterId, $request->skillReportId, null, $request->school_id, '', '');
	                }else{
	                    //UpdateFitnessTestResults::dispatch($studentId,$termMasterId, $request->skillReportId,'---', $schoolId, null, null);
	                    $this->UpdateLowerTestStatus($studentId, $termMasterId, $request->skillReportId, null, $request->school_id, null, null);
						$this->UpdateSeniorTestStatus($studentId, $termMasterId, $request->skillReportId, null, $request->school_id, '', '');
	                }

	        		break;

	        	default:
	        		
	        		break;
	        }

	        return response()->json([
	            'success' => true,
	            'message' => 'Old test record has been removed. You can now retake the test.'
	        ]);

	    } catch (\Exception $e) {
	        return response()->json([
	            'success' => false,
	            'message' => 'Error while deleting test records: ' . $e->getMessage()
	        ], 500);
	    }
	}



	/**
	 * 02-09-2025
	 * Get Fitness Level Based on Score and Benchmark. 
	 * */
/*	private function GetFitnessLevel($Student_id, $TestTypeMasterID, $Score, $ScoreCritera) {

		$student = Sstudent::where('id', $Student_id)->select('gender','dob')->first();
		$dob = Carbon::parse($student->dob);
	    $studentAge = $dob->age;
	    $genderValue = match (strtolower($student->gender)) {
		    'male'   => 1,
		    'female' => 2
		};
		
		$result = DB::selectOne("CALL GetFitnessLevel(?, ?, ?, ?, ?)", [
	        $TestTypeMasterID, $studentAge, $genderValue, $Score, $ScoreCritera
	    ]);

	    return $result;
	}*/

	/**
	 * 02-09-2025
	 * Get Fitness Level Based on Score and Benchmark Using MySQL Function. 
	 * */
    private function GetFitnessTestLevel($Student_id, $TestTypeMasterID, $Score, $ScoreCritera) {

		$student = Sstudent::where('id', $Student_id)->select('gender','dob')->first();
		$dob = Carbon::parse($student->dob);
	    $studentAge = $dob->age;
	    $gender = strtolower($student->gender) === 'male' ? 'Boys' : 'Girls';
	    
	    $result = DB::selectOne("SELECT get_fitness_level(:skill_report_id, :age, :gender, :score, :criteria) AS level", [
            'skill_report_id' => $TestTypeMasterID,
            'age'             => $studentAge,
            'gender'          => $gender,
            'score'           => $Score,
            'criteria'        => $ScoreCritera,
        ]);

        return $result->level ?? 'N.A.';
	}

	protected function TestMessage($studentIds, $testTypeId) {

	    $testNames = [
	        1  => 'Running',
	        2  => 'Hopping',
	        3  => 'Jumping & Landing',
	        4  => 'One Foot Balance',
	        5  => 'Skipping',
	        6  => 'Dodging',
	        7  => 'Catching & Receiving Bounce Ball',
	        8  => 'Catching Small Ball With Two Hands',
	        9  => 'Under Arm Throw',
	        10 => 'Over Arm Throw',
	        11 => 'Striking drop & hit forward',
	        12 => 'Dribbling With Hands',
	        13 => 'Dribbling With Feet',
	        14 => 'Kicking Stationary Ball',
	        15 => 'Beam Walk',
	        16 => 'Plate Tapping',
	        17 => 'Flamingo Balance',
	        18 => 'BMI',
	        19 => '50 Mt. Dash',
	        20 => '600 meter run/walk',
	        21 => 'Partial curl up 30 sec',
	        22 => 'Sit and Reach Test',
	        23 => 'Push Ups'
	    ];

	    if (!isset($testNames[$testTypeId])) {
	        return "Unknown test (ID: {$testTypeId}).";
	    }

	    $studentIds = is_array($studentIds) ? $studentIds : [$studentIds];
	    $studentNames = DB::table('students')->whereIn('id', $studentIds)->pluck('student_name')->toArray();

	    if (empty($studentNames)) {
	        return "No student found for this test.";
	    }

	    if (count($studentNames) === 1) {
	        $namesStr = $studentNames[0];
	    } else {
	        $last = array_pop($studentNames);
	        $namesStr = implode(', ', $studentNames) . ' and ' . $last;
	    }

	    return "The {$testNames[$testTypeId]} score for {$namesStr} has been saved in the database.";
	}






	/**
	 * Date : 22-09-2025
	 * Show FitnessTest Staus.
	 * */

	public function ViewFitnessReport($id) {

	    $studentId = $id;

	    $studentsData = $this->getStudentData($studentId);  

 	    $TermMasterId = $this->getTermId($studentsData->schools_id);
	    $dob          = Carbon::parse($studentsData->dob);


	    $studentAge   = $dob->age;
	    $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';

	    $ageGender    = $studentAge . strtolower(substr($studentsData->gender, 0, 1));

	    // Fetch report + benchmarks
	    $reportData    = $this->getReportData($studentId,$TermMasterId);
	    $mappedReport  = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);
	    $groupedReport = $mappedReport->groupBy('Category');

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


    public function enterTest($schoolId = 2831)  {

	    $columns = [
	        22 => 'sit_and_reach',
	        20 => 'run_600m',
	        23 => 'pushups',
	        19 => 'dash_50m',
	        21 => 'curlup',
	        18 => 'bmi',
	    ];

	    // 1. Fetch all results for the given school, skip null students
	    $results = DB::table('SeniorTestResults')
	        ->where('SchoolID', $schoolId)
	        ->whereNotNull('StudentID')
	        ->whereNotNull('TermId')
	        ->select(
	            'StudentID', 'SchoolID', 'TermId', 'TestTypeID', 'Score',
	            'height', 'weight', 'BMI', 'created_at'
	        )
	        ->orderBy('created_at')
	        ->get();

	    if ($results->isEmpty()) {
	        return "No records found for school ID: {$schoolId}";
	    }

	    // 2. Group results by Term + Student
	    $grouped = $results->groupBy(function ($row) {
	        return $row->TermId . '-' . $row->StudentID;
	    });

	    $count = 0;

	    foreach ($grouped as $group) {
	        $firstRow = $group->first();
	        $studentId = $firstRow->StudentID;
	        $termId    = $firstRow->TermId;
	        $schoolIDFromRow = $firstRow->SchoolID;

	        $data = [
	            'school_id'  => $schoolIDFromRow,
	            'student_id' => $studentId,
	            'term_id'    => $termId,
	            'updated_at' => now(),
	        ];

	        // 3. Loop through test results for this student-term and convert scores
	        foreach ($group as $row) {
	            if (isset($columns[$row->TestTypeID])) {
	                $col = $columns[$row->TestTypeID];
	                $data[$col] = $this->convertScore($row->TestTypeID, $row->Score);
	            }

	            if ($row->height) {
	                $data['height'] = $row->height . ' cm';
	            }
	            if ($row->weight) {
	                $data['weight'] = $row->weight . ' kg';
	            }
	        }

	        // 4. Insert or update the summary table
	        DB::table('SeniorTestResultsSummary')->updateOrInsert(
	            [
	                'student_id' => $studentId,
	                'term_id'    => $termId,
	                'school_id'  => $schoolIDFromRow,
	            ],
	            array_merge($data, ['created_at' => now()])
	        );

	        $count++;
	    }

	    return "Sync completed successfully. {$count} student summaries updated.";
	}

	/**
	 * Helper function to convert raw scores into display format
	 */
	protected function convertScore($testTypeID, $score)
	{
	    switch ($testTypeID) {
	        case 22: // sit_and_reach
	        	return ($score / 10) . ' cm';
	        case 17:
	        case 23: // pushups
	        case 21: // curlup
	            return intval($score) . ' times';

	        case 20: // run_600m
	            $totalMs = intval($score);
	            $minutes = floor($totalMs / 60000);
	            $seconds = floor(($totalMs % 60000) / 1000);
	            $milliseconds = $totalMs % 1000;
	            return "{$minutes}min {$seconds}sec {$milliseconds}ms";

	        case 16:
	        case 19: // dash_50m
	        	$secWithMs = $score / 1000.0;
                $fmt = number_format($secWithMs, 3, '.', '');
                $trimmed = rtrim(rtrim($fmt, '0'), '.');
                return $trimmed . ' sec';
	        case 18: // bmi
	            return round($score, 2) . ' kg/m²';

	        default:
	            return $score;
	    }
	}


	public function enterTest_bk($schoolId = 2823)
	{
	    $columns = [
	        1  => 'running',
	        2  => 'hopping',
	        3  => 'jumping_landing',
	        4  => 'one_foot_balance',
	        5  => 'skipping',
	        6  => 'dodging',
	        7  => 'catching_receiving_bounce',
	        8  => 'catching_small_ball',
	        9  => 'under_arm_throw',
	        10 => 'over_arm_throw',
	        11 => 'striking_drop_hit',
	        12 => 'dribbling_hands',
	        13 => 'dribbling_feet',
	        14 => 'kicking_ball',
	        15 => 'beam_walk',
	        16 => 'plate_tapping',        // from SeniorTestResults
	        17 => 'flamingo_balance',     // from SeniorTestResults
	        18 => 'bmi'                   // from SeniorTestResults
	    ];

	    $count = 0;

	    /* Part 1: Handle skillreport_skilltype_termtype_mapping (1–15) */
	    
	    $records = DB::table('skillreport_skilltype_termtype_mapping')
	        ->where('school_id', $schoolId)
	        ->where('status', 1)
	        ->select('student_id','school_id','term_master_id as term_id',
	                 'skill_report_id','skill_type_value','created_at')
	        ->orderBy('created_at')
	        ->get();

	    if ($records->isNotEmpty()) {
	        $grouped = $records->groupBy(function ($row) {
	            return $row->term_id . '-' . $row->student_id . '-' . $row->skill_report_id;
	        });

	        foreach ($grouped as $group) {
	            $studentId  = $group->first()->student_id;
	            $schoolId   = $group->first()->school_id;
	            $termId     = $group->first()->term_id;
	            $reportId   = $group->first()->skill_report_id;

	            if (!isset($columns[$reportId]) || $termId === null) {
	                continue;
	            }

	            $column = $columns[$reportId];

	            // count Ys
	            $yesCount = $group->where('skill_type_value', 'Y')->count();
	            $total    = 5;
	            $score    = "{$yesCount} / {$total}";

	            $data = [
	                'school_id'  => $schoolId,
	                'student_id' => $studentId,
	                'term_id'    => $termId,
	                $column      => $score,
	                'updated_at' => now(),
	            ];

	            DB::table('LowerTestResultsSummary')->updateOrInsert(
	                ['student_id' => $studentId, 'term_id' => $termId],
	                array_merge($data, ['created_at' => now()])
	            );

	            $count++;
	        }
	    }


		/*Part 2: Handle SeniorTestResults (16–18)*/
	    $seniorRecords = DB::table('SeniorTestResults')
	        ->where('SchoolID', $schoolId)
	        ->select('StudentID','SchoolID','TermId','TestTypeID','Score','height','weight','created_at')
	        ->orderBy('created_at')
	        ->get();

	    if ($seniorRecords->isNotEmpty()) {
	        foreach ($seniorRecords as $row) {
	            $studentId = $row->StudentID;
	            $schoolId  = $row->SchoolID;
	            $termId    = $row->TermId;
	            $reportId  = $row->TestTypeID;
	            $score     = $row->Score;

	            if (!isset($columns[$reportId]) || $termId === null) {
	                continue;
	            }

	            $column = $columns[$reportId];

	            // custom formatting
	            if ($reportId == 16) {
	                $score = $this->convertScore($reportId, $row->Score);
	            } elseif ($reportId == 17) {
	                $score = $this->convertScore($reportId, $row->Score);
	            } elseif ($reportId == 18) {
	                $score = $this->convertScore($reportId, $row->Score);
	            }

	            $data = [
	                'school_id'  => $schoolId,
	                'student_id' => $studentId,
	                'term_id'    => $termId,
	                $column      => $score,
	                'updated_at' => now(),
	            ];

	            if (!empty($row->height)) {
	                $data['height'] = $row->height . ' cm';
	            }
	            if (!empty($row->weight)) {
	                $data['weight'] = $row->weight . ' kg';
	            }

	            DB::table('LowerTestResultsSummary')->updateOrInsert(
	                ['student_id' => $studentId, 'term_id' => $termId],
	                array_merge($data, ['created_at' => now()])
	            );

	            $count++;
	        }
	    }

	    return "Junior + Senior sync completed successfully. {$count} summary records updated.";
	}

	
	public function uploadTestData(Request $request, DataTableListService $dataTable){

		$title = "Upload Test Data";
		$userId = Auth::id();
		
		$SchoolId = Session::get('SelectSchoolId') ?? DB::table('school_reference')
		->where('school_user_id',$userId)
		->where('status', 1)
		->value('school_id');

		$skillIds = DB::table('skill_reports')->get();

		$junior = [10, 11, 12, 2, 6, 3];
		$senior = [8, 9, 5, 4, 15, 3];

		$juniorData = DB::table('TestCategoryMaster')
			->join('TestTypeMaster', 'TestTypeMaster.TestCategoryID', '=', 'TestCategoryMaster.TestCategoryID')
			->join('skill_reports', 'skill_reports.TestTypeMasterID', '=', 'TestTypeMaster.TestTypeID')
			->whereIn('TestTypeMaster.TestsApplicable', [1,2])
			->where('TestTypeMaster.TestTypeID', '!=', 1014)
			->whereIn('TestCategoryMaster.TestCategoryID', $junior)
			->select([
				'TestCategoryMaster.TestCategoryID',
				'TestCategoryMaster.TestCategoryName',
				'TestCategoryMaster.TestCategoryImage',
				'TestTypeMaster.TestTypeID',
				'TestTypeMaster.TestTypeName',
				'skill_reports.id as SkillReportID',
				'skill_reports.skill_name',
				'skill_reports.TestTypeMasterID'
			]);

		$seniorData = DB::table('TestCategoryMaster')
			->join('TestTypeMaster', 'TestTypeMaster.TestCategoryID', '=', 'TestCategoryMaster.TestCategoryID')
			->join('skill_reports', 'skill_reports.TestTypeMasterID', '=', 'TestTypeMaster.TestTypeID')
			->where('TestTypeMaster.TestsApplicable', 2)
			->whereIn('TestCategoryMaster.TestCategoryID', $senior)
			->select([
				'TestCategoryMaster.TestCategoryID',
				'TestCategoryMaster.TestCategoryName',
				'TestCategoryMaster.TestCategoryImage',
				'TestTypeMaster.TestTypeID',
				'TestTypeMaster.TestTypeName',
				'skill_reports.id as SkillReportID',
				'skill_reports.skill_name',
				'skill_reports.TestTypeMasterID'
			]);
			
		
		$dataQuery = $juniorData->union($seniorData);
		$orderCategories = array_merge($junior, $senior);

		$combinedDataQuery = DB::query()
			->fromSub($dataQuery, 'combined')
			->orderByRaw('FIELD(TestCategoryID, ' . implode(',', $orderCategories) . ')')->orderBy('SkillReportID');

		$filters = [
			'skills' => function ($combinedDataQuery, $value) {
				$combinedDataQuery->where('SkillReportID', $value);
			},
		];


		$juniorClasses = [1,2,3];
		$seniorclasses = [4,5,6,7,8,9,10,11,12];

		if ($request->ajax()) {
			return $dataTable
				->setQuery($combinedDataQuery)
				->setFilters($filters)
				->setSearchableColumns(['skill_name'])
				->setSortableColumns(['skill_name' => 'skill_name'])
				->enableDefaultOrdering (false)
				->addCustomColumn('downloadTemplate', function ($row) {
					$id = $row->SkillReportID;
					return '<a type="button" href="javascript:void(0);" class="btn btn-primary btn-sm text-light w-40 download-template" 
								data-id="' . $id . '">
								<i class="fa-solid fa-download"></i> Template</a>';
				})
				->addCustomColumn('downloadSample', function ($row) {
					$id = $row->SkillReportID;
					return '<a type="button" href="javascript:void(0);" class="btn btn-success btn-sm text-light w-40 download-sample" 
								data-id="' . $id . '">
								<i class="fa-solid fa-download"></i> Sample</a>';
				})
				->addCustomColumn('classType', function ($row) use ($junior, $senior, $juniorClasses, $seniorclasses) {

					
					if ($row->TestCategoryID == 3) {

						$allClasses = array_merge($juniorClasses, $seniorclasses);
						$badges = '';
						foreach ($allClasses as $class) {
							$badges .= '<span class="badge p-2 m-1"
								style="border: 1px solid #6c757d; font-size: 13px; font-weight: 500;"> Class-'
								. $class .
							'</span>';
						}
						return $badges;
					}

					if (in_array($row->TestCategoryID, $junior)) {
						$classIds = DB::table('class_fitness_tests')
							->join('class', 'class.id', '=', 'class_fitness_tests.class_id')
							->where('class_fitness_tests.skill_id', $row->SkillReportID)
							->pluck('class.name')
							->unique()
							->sort()
							->values()
							->toArray();

						if (empty($classIds)) {
							return '';
						}

						$badges = '';
						foreach ($classIds as $class) {
							$badges .= '<span class="badge p-2 m-1"
								style="border: 1px solid #6c757d; font-size: 13px; font-weight: 500;">' . $class .'</span>';
						}

						return $badges;
					}
					if (in_array($row->TestCategoryID, $senior)) {
						$badges = '';
						foreach ($seniorclasses as $class) {
							$badges .= '<span class="badge p-2 m-1"
								style="border: 1px solid #6c757d; font-size: 13px; font-weight: 500;"> Class-'
								. $class .
							'</span>';
						}
						return $badges;
					}

					return '';
				})

			->render($request);
		}

		$logs = TestImportLog::with('user')
        ->where('user_id', Auth::id())->where('is_active', 'active')
        ->orderBy('created_at', 'desc')
        ->get();

		return view('assessor.upload-test-data', compact('title', 'skillIds', 'SchoolId', 'logs'));
	}

	public function testScoreSample(Request $request) {
		$skillId = $request->skillId;
        $fileName = 'Test_Sample_' . $skillId . '.xlsx';
		$filePath = public_path('downloads/SampleTemplates/' . $fileName);

		if (!file_exists($filePath)) {
			return response()->json([
				'message' => 'Sample file not found for this skill.'
			], 404);
		}

		$headers = [
			'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		];

		return response()->download($filePath, $fileName, $headers);
    }

	private function getClassesBySkill(int $skillId): array{
		
        if ($skillId >= 1 && $skillId <= 17) {
			return DB::table('class_fitness_tests')
			->where('skill_id', $skillId)
			->pluck('class_id')
			->unique()
			->values()
			->toArray();
        }

        if ($skillId === 18) {
            return range(1, 12);
        }

        return range(4, 12);
    }

	public function downloadTestTemplete(Request $request){
		
        try {
            set_time_limit(0);
            ini_set('memory_limit', '1024M');

            $skillIds = $request->input('skillIds', []);
            $schoolId = $request->schoolId;
            $status   = $request->status;

            if (empty($skillIds)) {
                return response()->json(['error' => 'No skills selected'], 400);
            }

            $schoolCode = DB::table('schools')
                ->where('id', $schoolId)
                ->value('school_code');

            if (!$schoolCode) {
                return response()->json(['error' => 'Invalid school'], 404);
            }

            $timestamp = date('d_Hi');

            $skills = DB::table('skill_reports')
                ->whereIn('id', $skillIds)
                ->pluck('skill_name', 'id');

            if (count($skillIds) === 1) {

                $skillId  = $skillIds[0];
                $classIds = $this->getClassesBySkill($skillId);

                $studentIds = DB::table('students')
                    ->where('school_code', $schoolCode)
                    ->whereIn('class_id', $classIds)
                    ->where('status', 'active')
                    ->pluck('id')
                    ->toArray();

                $skillName = $skills[$skillId] ?? 'Unknown Skill';
                $skillName = str_replace('600 meter run/walk', '600 meter run', $skillName);

                $export = new TestScoreTemplete(
                    $studentIds,
                    $skillName,
                    $skillId,
                    $schoolId,
                    $status
                );

                $fileName = "{$schoolCode}_{$skillName}_{$timestamp}_test_score.xlsx";

                return Excel::download($export, $fileName);
            }

            $zipFileName = "skill_templates_{$timestamp}.zip";
            $zipPath = storage_path("app/{$zipFileName}");

            $zip = new ZipArchive();
            $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

            $studentCache = [];
            $tempFiles = [];

            foreach ($skillIds as $skillId) {

                $classIds = $this->getClassesBySkill($skillId);
                $classKey = implode('-', $classIds);

                if (!isset($studentCache[$classKey])) {
                    $studentCache[$classKey] = DB::table('students')
                        ->where('school_code', $schoolCode)
                        ->whereIn('class_id', $classIds)
                        ->where('status', 'active')
                        ->pluck('id')
                        ->toArray();
                }

                $studentIds = $studentCache[$classKey];

                $skillName = $skills[$skillId] ?? 'Unknown Skill';
                $skillName = str_replace('600 meter run/walk', '600 meter run', $skillName);

                $export = new TestScoreTemplete(
                    $studentIds,
                    $skillName,
                    $skillId,
                    $schoolId,
                    $status
                );

                $tempFileName = uniqid('skill_', true) . '.xlsx';

                Excel::store(
                    $export,
                    $tempFileName,
                    'local',
                    ExcelExcel::XLSX
                );

                $fullPath = storage_path("app/{$tempFileName}");
                $tempFiles[] = $fullPath;

                $zip->addFile(
                    $fullPath,
                    "{$schoolCode}_{$skillName}_{$timestamp}_test_score.xlsx"
                );
            }

            $zip->close();

            foreach ($tempFiles as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            return response()
                ->download($zipPath)
                ->deleteFileAfterSend(true);

        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
	
	public function importTestData(Request $request){

		$userId = Auth::user()->id;

		$schoolId = DB::table('school_reference')
			->where('school_user_id', $userId)
			->where('status', 1)
			->value('school_id');

		$schoolCode = DB::table('schools')
			->where('id', $schoolId)
			->value('school_code');
			
		// DB::table('test_import_status')->updateOrInsert(
	    //     ['school_id' => $schoolId],
	    //     ['status' => DB::raw('status')]
	    // );

	    // $statusRow = DB::table('test_import_status')->where('school_id', $schoolId)->first();

	    // if ($statusRow->status === 'processing') {
	    //     $lastUpdated = Carbon::parse($statusRow->updated_at);
	    //     if ($lastUpdated->diffInMinutes(now()) <= 5) {
	    //     	return response()->json([
		// 	    	'error' => 'error',
		// 	        'icon' => 'info',
		// 	        'title' => 'Import in Progress',
		// 	        'summary' => 'An import is already in progress. Please wait before uploading again.'
		// 	    ]);
	    //     }

	    //     DB::table('test_import_status')->where('school_id', $schoolId)->update(['status' => 'idle']);
	    // }

	    // DB::table('test_import_status')->where('school_id', $schoolId)->update([
	    //     'status' => 'processing',
	    //     'updated_at' => now()
	    // ]);

		try {
			$validator = Validator::make($request->all(), [
				'test_score' => [
					'required',
					'file',
					'mimes:xls,xlsx',
					'max:3000',
					new ExcelTestHeaderValidation,
					function ($attribute, $value, $fail) use ($schoolCode) {
						$originalName = $value->getClientOriginalName();

						if (!str_starts_with($originalName, $schoolCode)) {
							$fail("Invalid file name. The file must start with your school code");
						}

						if (!preg_match('/_test_score\.xlsx$/', $originalName)) {
							$fail('Invalid file name. The file name must end with "_test_score.xlsx".');
						}
					}
				],
			]);

			if ($validator->fails()) {
				$errorContent = '<ul style="list-style-type:none">';
				$dynamicTitle = 'Validation Error';

				foreach ($validator->errors()->all() as $error) {
					$errorContent .= "<li>{$error}</li>";

					if (str_contains($error, 'file name')) {
						$dynamicTitle = 'Filename Mismatch';
					} elseif (str_contains($error, 'headers')) {
						$dynamicTitle = 'Template Format Error';
					} elseif (str_contains($error, 'size')) {
						$dynamicTitle = 'File Too Large';
					}
				}

				$errorContent .= '</ul>';

				return response()->json([
					'error' => true,
					'icon' => 'error',
					'title' => $dynamicTitle,
					'summary' => $errorContent
				]);
			}

			$file = $request->file('test_score');
			$action = $request->post('event', 'preview');

			$spreadsheet = IOFactory::load($file->getPathname());
			$sheet = $spreadsheet->getActiveSheet();

			$skillId = (int) trim($sheet->getCell('A1')->getValue());
			if (!$skillId) {
				return response()->json([
					'error' => true,
					'icon' => 'error',
					'title' => 'Invalid Template',
					'summary' => 'Skill ID is missing or invalid in the uploaded file.'
				]);
			}

			$highestRow = $sheet->getHighestRow();
			$studentIds = [];

			for ($row = 4; $row <= $highestRow; $row++) {
				$studentId = trim($sheet->getCell('A' . $row)->getValue());
				if ($studentId !== '') {
					$studentIds[] = $studentId;
				}
			}

			$studentIds = array_unique($studentIds);
			$totalStudents = count($studentIds);

			$termMasterId = TermMaster::where('school_id', $schoolId)
				->where('is_active', 1)
				->whereDate('term_start_date', '<=', today())
				->whereDate('term_end_date', '>=', today())
				->value('id');

			if ($action === 'preview') {
				return response()->json([
					'step' => 'preview',
					'total_students' => $totalStudents
				]);
			}

			if ($skillId >= 1 && $skillId <= 15) {
				$existingCount = DB::table('skillreport_skilltype_termtype_mapping')
					->where('school_id', $schoolId)
					->where('skill_report_id', $skillId)
					->where('term_master_id', $termMasterId)
					->whereIn('student_id', $studentIds)
					->distinct('student_id')
					->count();
			} else {
				$existingCount = DB::table('SeniorTestResults')
					->where('SchoolID', $schoolId)
					->where('TestTypeID', $skillId)
					->where('TermId', $termMasterId)
					->whereIn('StudentID', $studentIds)
					->count();
			}
			// dd($existingCount);

			if ($action === 'import' && $existingCount > 0) {
				return response()->json([
					'step' => 'confirm_override',
					'total_students' => $totalStudents,
					'existing_students' => $existingCount
				]);
			}

			$filename = $file->getClientOriginalName();
			$storedPath = $file->storeAs('import_tests', $filename);
			

			$log = TestImportLog::create([
				'school_id' => $schoolId,
				'user_id' => $userId,
				'file_path' => $storedPath,
				'skill_report_id' => $skillId,
				'status' => 'queued',
				'message' => 'Test data has been queued. Please wait for completion.',
				'is_active' => 'active',
				'started_at' => now(),
			]);

			if ($action) {
				$importData = ($skillId >= 1 && $skillId <= 15)
				? new ImportFMSTestData($schoolId, $action, $userId, $skillId, $log->id)
				: new ImportFitnessTestData($schoolId, $action, $userId, $skillId, $log->id);
				
				Excel::import($importData, $file);

				return response()->json([
					'icon' => 'success',
					'title' => 'Import Queued',
					'summary' => 'Test score import queued successfully. Check View History for the upload status.'
				]);
			}

		} catch (\Throwable $e) {
			
			return response()->json([
				'error' => true,
				'icon' => 'error',
				'title' => 'Error',
				'summary' => 'Import failed. Please try again later. ' . $e->getMessage(),
			]);
		} finally {
	        DB::table('test_import_status')->where('school_id', $schoolId)->update(['status' => 'idle', 'updated_at' => now()]);
	    }
	}
	    
	public function downloadTestUploadedFile($logId) {

        $log = TestImportLog::findOrFail($logId);
	    $filePath = $log->file_path; 

	    if (!$filePath || !Storage::disk('azure')->exists($filePath)) {
	        abort(404, 'File not found.');
	    }

	    return Storage::disk('azure')->download( $filePath, basename($filePath),
	        ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
	    );
    }

	public function downloadTestErrorFile($logId) {

	    $log = TestImportLog::findOrFail($logId);
	    $filePath = $log->error_file; 
		$skillId = $log->skill_report_id;

		$skillName = DB::table('skill_reports')
					->where('id', $skillId)
					->value('skill_name');
		if ($skillName == '600 meter run/walk') {
			$skillName = '600 meter run';
		}

	    $fileName = pathinfo($filePath, PATHINFO_FILENAME);

	    if (!$filePath || !Storage::disk('local')->exists($filePath)) {
	        abort(404, 'File not found.');
	    }
	    $jsonData = json_decode(Storage::disk('local')->get($filePath), true);

	    if (!is_array($jsonData)) {
	        abort(500, 'Invalid JSON data.');
	    }

	    return Excel::download(new ExportTestImproperData($jsonData, $skillId, $skillName), $fileName . '.xlsx');
	}


}
