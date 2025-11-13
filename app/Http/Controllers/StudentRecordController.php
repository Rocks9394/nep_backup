<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sclass;
use App\Models\School;
use App\Models\Sstudent;
use App\Models\Report;

use Carbon\Carbon;
use DB;
use Response;
use Auth;
use Session;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Helper;
use App\Models\TermMaster;
use App\Traits\ReportHelperTrait;
use Illuminate\Contracts\View\Factory as ViewFactory;

use Illuminate\Support\Facades\Log;

class StudentRecordController extends Controller
{
	use ReportHelperTrait;
	
	function __construct()
	{
		$this->middleware('auth.auth_student');
	}	


	public function index(Request $request)
	{

   		$studentId = $request->get('student_id');
	    $schoolId = $request->get('schools_id');
    
		
		$stdInfo = Auth::guard('sstudent')->user();
		Session::put('SelectSchoolId',$stdInfo->school_id);
		
		$countFMS = DB::table('skillreport_skilltype_termtype_mapping as reportMapping')->where('student_id', $stdInfo->id)->count();
	
		
		$title = 'Dashboard';
		return view('parent.index', compact('title', 'countFMS','stdInfo'));
	}
	
	public function dashboard()
	{
		
		$title = 'Student-Dashboard';
		return view('parent.dashboard', compact('title'));
	}

	public function skillReport(Request $request) {


		$UserData = Auth::guard('sstudent')->user();
		$school_id = Auth::guard('sstudent')->user()->school_id;
		$levels = DB::table('levels')->select('level_name','level_value','description')->where('status','=', 1)->orderBy('orders')->get();
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

		$reportDetail['studentProfile'] = [
			'name' => $UserData->student_name, 
			'class' => $studentClassData->class_display_name ?? null,
			'section' => $studentClassData->section ?? null,
			'rollno' => $UserData->rollno, 
			'dob' => $UserData->dob,
			'gender' => $UserData->gender
		];

		$formatReportData = function($reportCard) use (&$reportDetail){

			foreach($reportCard as $key => $data) {

				$existingData = $reportDetail['reportCardDetails'][$data->skillsport][$data->techniques][$data->activity][0] ?? null;
				if (!$existingData || $data->level > $existingData['level']) {
				    $reportDetail['reportCardDetails'][$data->skillsport][$data->techniques][$data->activity][0] = ['level' => $data->level, 'level_name'  => $data->level_name];
				}
			}
		};

		if($request->ajax()){

			$termId = $request->post('session_term_id');
			$reportCardDetail = DB::select('CALL getStudentsReportTermWize(?, ?)', [$UserData->id, $termId]);			
			$formatReportData($reportCardDetail);

			$html = view('parent.partials.report_card_details', compact('reportDetail','levels'))->render();
	        return response()->json(['html' => $html]);
		}

		$termId = TermMaster::where('school_id', $school_id)->where('is_active', 1)
		->whereDate('term_start_date', '<=', today())
		->whereDate('term_end_date', '>=', today())
		->value('id');
		$reportCardDetail = DB::select('CALL getStudentsReportTermWize(?, ?)', [$UserData->id, $termId]);
		$formatReportData($reportCardDetail);

		$title = 'Skill Reports';


		// echo "<pre>"; print_r($reportDetail);exit();
		return view('parent.skillreport2', compact('title','levels','reportDetail','SessionAndTerm'));



		/*
		$studentId = Auth::guard('sstudent')->user();
		$studentsDetails = Sstudent::with([
			'StudentReport' => function($query){
				$query->select('id','school_id','student_id','level','submitted_by','skill_area_id','skill_sports_id','technique_id','activity_id','class_id')->orderBy('period', 'ASC')
					->with([ 'skillArea', 'sport', 'technique',
						'level' => fn ($class) => $class->select('id','level_name','level_value','description'),
						'classname' => fn ($class) => $class->select('id','name'),
						'activity'=> fn ($activity) => $activity->select('id','title') 
					]);
			},
		])->where('id', $studentId->id)->get();

		$studentsDetails = $studentsDetails->map(function($sports) {
		    $sports->StudentReport = $sports->StudentReport->sortBy(function($report) {
		        return $report->sport->name ?? '';
		    });
		    return $sports;
		});


		$levels = DB::table('levels')->select('level_name','level_value','description')->where('status','=', 1)->orderBy('orders')->get();

	    $title = 'Skill Reports'; 
		return view('parent.skillreport', compact('title', 'studentsDetails','levels','studentProfile'));
		*/

	}


	public function dailyreport(Request $request){ 

		
		$UserData = Auth::guard('sstudent')->user();
		$school_id = Auth::guard('sstudent')->user()->school_id;
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


				//echo "<pre>"; print_r($reportCardDetail);exit();		
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




	/* for testing purpose only */
	public function skillReportTest(Request $request) {
				
		$UserData = Auth::guard('sstudent')->user();
		$school_id = Auth::guard('sstudent')->user()->school_id;
		$SessionAndTerm = TermMaster::where('school_id', $school_id)->where('is_active',1)->select('id','term_name','academic_year')->get();

		$dailyReportCard['studentProfile'] = [
			'name' => $UserData->student_name, 
			'class' => Helper::className($UserData->class_id),
			'section' => $UserData->section_id,
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


			//echo "string"; exit();

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





	public function createloginpage()
	{
		return view('parent.login');
	}
	
	public function FMSskillReport(){
		$user       = Auth::guard('sstudent')->user();
		$studentId  = $user->id;
		
		$title        = 'FMS Development';
		
		$studentInfo = DB::table('students')
		->join('schools', 'schools.id', '=' , 'students.school_id')
		->where('students.id', $studentId)
		->select('students.*','schools.school_name')
		->first();
		
		$schoolId = $studentInfo->school_id;
		
		// $termIds = TermMaster::where('school_id', $schoolId)
		// ->where('is_active', 1)
		// ->whereDate('term_start_date', '<=', today())
		// ->whereDate('term_end_date', '>=', today())
		// ->value('id');

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		if ($month < 4 || ($month == 3 && $day <= 31)) {
			$academicYear = ($year - 1) . '-' . $year;
		} else {
			$academicYear = $year . '-' . ($year + 1);
		}


		$termsDetail = DB::table('term_masters')
			->select('id')
			->where('school_id', $schoolId)
			->where('is_active', '1')
			->where('academic_year', $academicYear)
			->orderBy('id', 'DESC')
			->limit(2)
			->get();

		$termIds = $termsDetail->pluck('id')->toArray();
		
		$skills = [1,2,3,4];

		$ReportDetail = DB::table('skillreport_skilltype_termtype_mapping as sstm')
			->join('term_masters as tm', 'tm.id', '=', 'sstm.term_master_id')
			->join('skill_reports', 'skill_reports.id', '=', 'sstm.skill_report_id')
			->join('skill_types', 'skill_types.id', '=', 'sstm.skill_type_id')
			->select(
				'tm.id as term_id',
				'tm.term_name',
				'skill_reports.id as skill_report_id',
				'skill_reports.skill_name',
				'skill_types.id as skill_type_id',
				'skill_types.skill_type_name',
				'skill_types.description',
				'sstm.student_id',
				'sstm.skill_type_value'
			)
			->where('sstm.student_id', $studentId)
			->whereIn('sstm.skill_report_id', $skills)
			->whereIn('sstm.term_master_id', $termIds)
			->orderBy('sstm.skill_report_id', 'ASC')
			->orderBy('sstm.skill_type_id', 'ASC')
			->get();

		
		// echo "<pre>"; print_r($ReportDetail);exit();		
		

		return view('parent.fms-report', compact('title', 'studentInfo', 'termsDetail', 'ReportDetail'));
		
	
	}
	
	public function FitnessAssessment(Request $request) 
	{
		#die('---change the detail---');
		$user    = Auth::guard('sstudent')->user();
		$userId  = $user->user_id;
		
		$pID = 1;	
		$cookieValue = $request->cookie('my_cookie_dot');
		$plaintext = 'uname='.$userId.'&utype=5&pid='.$pID.'&cval='.$cookieValue;

		$encrypt_url = $this->GetEncryptedURL($plaintext);
		
		$title = 'Fitness Assessment';
		return view('parent.fitness-assessment', compact('title', 'encrypt_url'));
		
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

	
		$url ="https://view.goforfit.in/relay/validate.aspx?edata=$encrypted";
		
		return $url; 
		
	}
	
	
	public function FMSskillReportPDF(Request $request)
	{
		
	  try {
			$title        = 'FMS Development';
			
			$user       = Auth::guard('sstudent')->user();
			$studentId  = $user->id;
			
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
			->whereIn('reportMapping.skill_report_id', [1, 2, 3, 4])
			->orderBy('reportMapping.skill_type_id', 'ASC')
			->get()
			->groupBy('skill_report_id');
		

			$ReportDetail1 = $ReportDetails->get(1, collect());
			$ReportDetail2 = $ReportDetails->get(2, collect());
			$ReportDetail3 = $ReportDetails->get(3, collect());
			$ReportDetail4 = $ReportDetails->get(4, collect());
			
			//return view('school.fms-report-pdf', compact('title', 'studentInfo', 'ReportDetail1', 'ReportDetail2', 'ReportDetail3', 'ReportDetail4'));
		
			$pdf = PDF::loadView('parent.fms-report-pdf', compact('title', 'studentInfo', 'ReportDetail1', 'ReportDetail2', 'ReportDetail3', 'ReportDetail4'));
			$titlepdf        = 'FMS-Report';
			return $pdf->download($titlepdf.'-'.$studentId.'.pdf');
		} 
		catch(\Exception $e) 
		{
			return response()->json(['message' => 'An error occurred while generating the report. Please try again later.'], 500);
        }
	
	
	}

	public function viewProfile(){
		$title = "Student Profile";
		$student = Auth::guard('sstudent')->user();
		return view('parent.profile.index', compact('title', 'student'));
	}

	public function updateProfile(Request $request) {

	    $request->validate([
			'studentEmail' => 'required|email|max:255',
			'gender' => 'required|string|in:Male,Female,TransGender',
			'userid' => 'required|string|max:255',
		]);

	    $student = Auth::guard('sstudent')->user();

		$student->update([
			'email_id' => $request->input('studentEmail'),
			'gender' => $request->input('gender'),
			'user_id' => $request->input('userid')
		]);

		$student->save();
	    
	    return redirect()->route('student.dashboard')->with('message', 'Profile updated successfully!');
	}


	public function ViewFitnessReport($id) {

		$studentId = $id;
	    $studentsData = $this->getStudentData($studentId);

	    
	    $TermMasterId = $this->getTermId($studentsData->schools_id);

	    // echo "<pre>"; print_r($TermMasterId);exit();
		
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

}
