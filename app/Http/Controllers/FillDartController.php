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
use App\Models\TrainerActivity;
use App\Models\TrainerOtherDuty;
use DB;
use Response;
use Validator;
use Redirect;
use paginate;
use App\Helpers\Helper;
use Session;
use Excel;
use App\Imports\TermExamImportData;
use App\Models\ViewDart;
use App\Models\TermMaster;

class FillDartController extends Controller
{
	
	public function __construct()
    {
        //$this->middleware('auth');
		$this->middleware(['auth','trainerschool'])->except('ParisOlympics');
    }

    public function dashboard_bk(Request $request)	{


		$user = auth()->user();
	    $roleId = $user->role_id;
	    $userId = $user->id;

	    $dashboardModules = collect();
	    $title = 'Dashboard';
	    $SchoolName = null;
	    $SchoolTrainers = collect();
	    $hasSchools = false;


		switch ($roleId) {

			case '9': //HeadQuarter Dashboard
				return redirect()->route('cicse.dashboard');
				break;
			
			case '2': //Schoo-User Dashboard

				$schoolRef = DB::table('school_reference')->where('school_user_id', $userId)->first();
				$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $schoolRef->school_id)->first();

				if ($schoolRef && $schoolRef->status == 1) {
			       $allowedModules = json_decode($user->usermeta->module_access ?? '[]', true);
					$dashboardModules = DB::table('dashboard_modules')->whereIn('slug', $allowedModules)->where('status', 1)->orderBy('id')->get();
			    }

				break;

			case '3':  //Trainer Dashboard
				$SchoolTrainers = DB::table('school_trainers')
				->join('schools','schools.id','=','school_trainers.school_id')
				->select('schools.school_name','schools.id','schools.logo')
				->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();


				$hasSchools = $SchoolTrainers->isNotEmpty();

				if($hasSchools && count($SchoolTrainers) == 1) {
					Session::put('SelectSchoolId', $SchoolTrainers[0]->id);
					$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $SchoolTrainers[0]->id)->first();
				}
					
				$select_school_id = $request->input('select_school_id');
				if($hasSchools &&  !empty($select_school_id)) {
				 	Session::put('SelectSchoolId', $select_school_id);	
				  	$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $select_school_id)->first();
				}
				
				if(Session::get('SelectSchoolId')) {
				  $SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', Session::get('SelectSchoolId'))->first();
				}
				break;

			case '4': //School Dashboard
				$allowedModules = DB::table('dashboard_modules')->where('status', 1)->pluck('slug') ->toArray();
				$dashboardModules = DB::table('dashboard_modules')->whereIn('slug', $allowedModules)->where('status', 1)->orderBy('id')->get();

				$schoolId = DB::table('school_reference')->where('school_user_id', $userId)->where('status', 1)->value('school_id');
				$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $schoolId)->first();

				break;
			default:
				abort(403, 'Unauthorized access');
		}

		
	    // echo "<pre>"; print_r($dashboardModules);exit();

		return view('fill-darts.dashboard', compact('title','SchoolTrainers','SchoolDetails', 'hasSchools','dashboardModules'));
	}


	public function dashboard(Request $request)	{
		
		$userId  =  \Auth::id();
		$title   = 'Dashboard';
		$SchoolName = '';
		
		$SchoolTrainers = DB::table('school_trainers')
		->join('schools','schools.id','=','school_trainers.school_id')
		->select('schools.school_name','schools.id','schools.logo')
		->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();
		
		$hasSchools = $SchoolTrainers->isNotEmpty();  // true if user has one or more schools


		if($hasSchools && count($SchoolTrainers) == 1) {
			// Automatically select the only school
			Session::put('SelectSchoolId', $SchoolTrainers[0]->id);
			$SchoolName = DB::table('schools')->select('school_name','logo')->where('id', $SchoolTrainers[0]->id)->first();
		}
			
		$select_school_id = $request->input('select_school_id');

		
		if($hasSchools &&  !empty($select_school_id)) {
			// User selected a school from modal
		 	Session::put('SelectSchoolId', $select_school_id);	
		  	$SchoolName = DB::table('schools')->select('school_name','logo')->where('id', $select_school_id)->first();
		}
		
		// If school selected in session, get school name
		if(Session::get('SelectSchoolId')) {
		  $SchoolName = DB::table('schools')->select('school_name','logo')->where('id', Session::get('SelectSchoolId'))->first();
		}
		

		$user = auth()->user();
		$roleId = $user->role_id;		
		$dashboardModules = collect();

		switch ($roleId) {

		    case 2: // School Role
		    	$SchoolDetails = null;
		        $schoolRef = DB::table('school_reference')->where('school_user_id', $userId)->first();

		        if ($schoolRef) {
		            $SchoolDetails = DB::table('schools')->select('school_name', 'logo', 'school_code')->where('id', $schoolRef->school_id)
		                ->first();
		        }

		        if ($schoolRef && $schoolRef->status == 1) {
		            $allowedModules = json_decode($user->usermeta->module_access ?? '[]', true);
		            $dashboardModules = DB::table('dashboard_modules')
		                ->whereIn('route_name', $allowedModules)
		                ->whereIn('role_id', [0,4])
		                ->where('status', 1)
		                ->orderBy('order_no', 'asc')
		                ->get();
		        }

		        return view('fill-darts.dashboard', compact('title','SchoolTrainers', 'SchoolDetails', 'hasSchools','dashboardModules'));
		        break;

		    default:
		        break;
		}

		// session()->forget('term_id');
		
		return view('fill-darts.dashboard', compact('title','SchoolTrainers','SchoolName', 'hasSchools'));
	}



	public function index(Request $request) {
		
		#$lastDates = Helper::LastTwoDates();
		#print_r($lastDates);
		#die('-----');
		
		try
		{

		$userId  =  \Auth::id();
		$role_id =  \Auth::user()->role_id;

		if($role_id != 3)
		{
			die('--you are not a teacher. teacher can only access--');
		}
		
		if(!empty(Session::get('SelectSchoolId')))
		{	
			$SchoolTrainers = DB::table('school_trainers')->where('trainer_id',$userId)->where('school_id',Session::get('SelectSchoolId'))->where('status', 1)->pluck('school_id');
			
		}else{
			
			$SchoolTrainers = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->pluck('school_id');	
		}
		

		
		$title = 'Fill DART';
		
		//$classes  = Sclass::orderBY('orders','ASC')->get();			
		//$skillareas = Skill::orderBY('name','ASC')->get();
		
		$sportskills = Sport::orderBY('name','ASC')->get();
		$techniques  = Technique::orderBY('name','ASC')->get();	
		$schools = School::WhereIn('id', $SchoolTrainers)->orderBY('school_name','ASC')->get();		
		$levels = DB::table('levels')->get();

		// $classes = DB::table('custom_classes')
		// ->join('class','class.id','=','custom_classes.class_id')
		// ->select('custom_classes.id','class_id','section',

		// 	DB::raw("CASE 
        //         WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
        //         THEN custom_classes.nomenclature 
        //         ELSE class.name 
        //     END AS classname")

		// 	// 'class.name AS classname'
		// )
		// ->WhereIn('school_id', $SchoolTrainers)
		// ->orderBy('custom_classes.orders', 'ASC')
		// ->get();


		$schoolId = $SchoolTrainers[0];
		
		$classes = DB::table('custom_classes')
		->join('class','class.id','=','custom_classes.class_id')
		->join('students','students.custom_class_id','=' ,'custom_classes.id')
		->select('custom_classes.id','custom_classes.class_id','custom_classes.section',

			DB::raw("CASE 
	            WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
	            THEN custom_classes.nomenclature 
	            ELSE class.name 
	          END AS classname")
		)
		->where('students.status','active')
		->WhereIn('students.school_id', array($schoolId))
		->groupBy(
			'custom_classes.id',
			'custom_classes.class_id',
			'custom_classes.section',
			DB::raw("CASE 
				WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
				THEN custom_classes.nomenclature 
				ELSE class.name 
			END")
		)
		->orderBy('custom_classes.orders', 'ASC')
		->get();
		
		$TrainerOtherDuty = TrainerOtherDuty::orderBy('sequence', 'asc')->where('status','active')->get();
		
		}catch(\Exception $e)
		{
			echo "<pre>";
			print_r($e->getMessage());
			die('---change the detail');
		}
		
		

		if(!empty($schoolId) && $schoolId == 2824)
		{
		 return view('fill-darts.index-ncs', compact('title','sportskills','techniques', 'schools','levels', 'classes', 'schoolId', 'TrainerOtherDuty')); 
		}else
		{
			return view('fill-darts.index', compact('title','sportskills','techniques', 'schools','levels', 'classes', 'schoolId', 'TrainerOtherDuty'));
		} 
	}



	/*
	Purpose :- Get the custom class from the school basis.
	Author:- Ajay(Bhawani) 
	*/

	public function testdata(Request $request)
	{
				$school_id  = $request->school_id;
				
				 $classes = DB::table('custom_classes')
				 ->join('class','class.id','=','custom_classes.class_id')
				->select('custom_classes.id','class_id','section','class.name AS classname')
				->where('school_id', $school_id)
				->orderBy('custom_classes.orders', 'ASC')
				->get();

				$cls = '<option value="" >--select--</option>';
				if(!empty($cls))
				{
					foreach($classes as $clses)
					{
						$cls .= '<option value="'.$clses->id.'-'.$clses->class_id.'">'.$clses->classname.'-'.$clses->section.'</option>';
					}
				}
				return $cls;

	 }


	
	public function getActivity(Request $request)
	{

					$myArray = explode('-', $request->class_id);
					$cnt = count($myArray);	
					if($cnt >1)
					{
						$custm_cls_id  = $myArray[0];
						$class_id      = $myArray[1];
					}else
					{
						$class_id  = $myArray[0];
					}


					$getactivity = DB::table('activity')
					->join('activity_technique','activity_technique.act_id','=','activity.id')
					->join('class','class.id','=','activity_technique.class_id')
					->join('skillareas','skillareas.id','=','activity_technique.skillarea_id')
					->join('sports','sports.id','=','activity_technique.sportskill_id')
					->join('techniques','techniques.id','=','activity_technique.technique_id')
					->select('activity.id','activity.title')
					->where('activity_technique.class_id', $class_id)
					//->where('activity_technique.skillarea_id', $request->skillarea_id)
					->where('activity_technique.sportskill_id', $request->sports_id)
					->where('activity_technique.technique_id', $request->technique_id)
					->where('activity_technique.is_active','1')
					//->orderBy('techniques.name', 'ASC')
					->groupBy('activity.id')
					->get();
					
					$act = '<option value="" >--select--</option>';
				
				if(!empty($act))
				{
					foreach($getactivity as $acts)
					{
						$act .= '<option value="'.$acts->id.'">'.$acts->title.'</option>';
					}
				}
				return $act;
	}


	function getStudents(Request $request)
	{
		
		
			//die('---hello india--');
			// Perform a join between student_map_sports and students to get the necessary data
			/*$students = DB::table('student_map_sports as sms')
			->join('students as s', 'sms.student_id', '=', 's.id')
			->where('sms.school_id', 2824)
			->select('sms.id as map_id', 's.class_id', 's.custom_class_id')
			->get();

			// Now update all records in a single query
			foreach ($students as $student) 
			{
				DB::table('student_map_sports')
				->where('id', $student->map_id) // Update based on student_map_sports's unique id
				->update([
				'class_id' => $student->class_id,
				'custom_class_id' => $student->custom_class_id,
				]);
			}*/
			
			
		
		
		
		/*$one = DB::table('student_map_sports')
		->where('school_id', 2823)
		->get();
		
		foreach($one as $kone => $vone )
		{
			
		$two = DB::table('students')
		->where('school_id', 2823)
		->where('id', $vone->student_id)
		->first();
		
		DB::table('student_map_sports')
		->where('school_id', 2823)
		->update([
		'class_id' => $two->class_id,
		'custom_class_id' => $two->custom_class_id,
		]);
			
		}*/
		
		
		
		//echo "<pre>";
		//die('---light weight dddd dgg	---');
		
		$myArray       =  explode('-', $request->class_id);
		$school_id     =  $request->school_id;
		$sports_id     =  $request->sports_id;
		$skillarea_id  =  $request->skillarea_id;		
		
		
		
		$custm_cls_id  =  $myArray[0];
		$class_id      =  $myArray[1];
		
		if($skillarea_id == 2)
		{
			
		$gtstud = DB::table('student_map_sports')
		->join('students','students.id', '=','student_map_sports.student_id')
		->select('students.id','student_name')
		->where('student_map_sports.school_id', $school_id)
		->where('student_map_sports.custom_class_id', $custm_cls_id)
		->where('student_map_sports.class_id', $class_id)
		->where('student_map_sports.sports_id', $sports_id)
		->where('students.status', 'active')
		->get();
		
		}else
		{
			
		$gtstud = DB::table('students')
		->select('students.id','student_name')
		->where('school_id', $school_id)
		->where('custom_class_id', $custm_cls_id)
		->where('class_id', $class_id)
		->where('status', 'active')
		->get();
		
		#echo "<pre>";
		#print_r($gtstud);
		#die('---light weight dgg	---');
			
		}
				
	    $getActivity = Activity::where('id', $request->activity_id)->first();
		if (!$getActivity) 
		{
			return response()->json(['error' => 'Activity not found'], 404);
		}

		$word = "wp-content"; 
		$img = '';
		$mystring = $getActivity->image;
		if(strpos($mystring, $word) !== false) 
		{
			$img = '<img src="' . $getActivity->image . '"  alt="first" width="100" height="100">';
		}elseif (file_exists(public_path('uploads/' . $getActivity->image)))
		{
			$img = '<img src="' . asset('public/uploads/' . $getActivity->image) . '" alt="second" width="100" height="100">';
		}else 
		{
			$img = '<img src="' . asset('public/uploads/images.jpg') . '" alt="third" width="100" height="100">';
		}
	
	
		return Response::json(array('success'=>true,'result'=>$gtstud, 'getActivity'=>$getActivity, 'activityImg' => $img));

	}


	function SubmitFillDart(Request $request)
	{

		$alldata = $request->all();
		$userId  = \Auth::id();

		$validator  = Validator::make($request->all(), [
            'school_id'   => 'required|integer|min:1',
            'sclass'      => 'required',
            'period'      => 'required|integer|min:1',
			'date'        => 'required',
			'skillarea'   => 'required|integer|min:1',
			'skillsports' => 'required|integer|min:1',
			'technique'   => 'required|integer|min:1',
			'std_idd.*'    => 'required',
			'activity'    => 'required|integer|min:1',
			
        ]);
		
		
        if($validator->fails()) 
		{
            return Redirect::back()->withErrors($validator)->withInput();
        }

		$myArray = explode('-', $request->sclass);
		$cnt = count($myArray);
		if($cnt>1)
		$class_id  = $myArray[1];
        else
		$class_id  = $myArray[0];  

		$studentids = $request->std_idd;
		$levels    = $request->level;
		
		
		$sid = $request->school_id;
		$TermMasterId = TermMaster::where('school_id', $sid)
		 ->where('is_active', 1)
		->whereDate('term_start_date', '<=', today())
		->whereDate('term_end_date', '>=', today())
		->value('id');

		$present = $absent = [];
		foreach($levels as $val){
			if($val == 0){
				$absent[] = $val;
			}else{
				$present[] = $val;
			}
		}


		DB::beginTransaction();

		try {
		
			foreach($studentids as $key => $val)
			{
			  Report::where('school_id',$request->school_id)->where('custom_class_id',$request->custm_cls_id)->where('date',$request->date)->where('period',$request->period)->where('submitted_by',$userId)->delete();
			}
				
			//$dateConvert =  $request->date;
				
			
			foreach($studentids as $key => $val)
			{

				$reports = new Report;
				$reports->school_id       =  $request->school_id;
				$reports->term_master_id  =  $TermMasterId;
				$reports->class_id        =  $class_id;
				$reports->custom_class_id =  $request->custm_cls_id;
				$reports->period          =  $request->period;
				$reports->date            =  $request->date;
				$reports->skill_area_id   =  $request->skillarea;
				$reports->skill_sports_id =  $request->skillsports;
				$reports->technique_id    =  $request->technique;
				$reports->activity_id     =  $request->activity;
				$reports->student_id      =  $val;
				$reports->level           =  $levels[$val];
				$reports->submitted_by    =  $userId;
				$reports->status          =  1;
				$reports->save(); 

			}
			
			ViewDart::updateOrCreate(
			    [
			        'school_id' => $request->school_id,
					'term_master_id'  =>  $TermMasterId,
			        'trainer_id' => $userId,
			        'period' => $request->period,
			        'custm_cls_id' => $request->custm_cls_id,
			        'skill_area_id' => $request->skillarea,
			        'skillsports_id' => $request->skillsports,
			        'technique_id' => $request->technique,
			        'activity_id' => $request->activity,
			        'date' => $request->date,
			    ],
			    [
			        'total_student' => count($studentids),
			        'present' => count($present),
			        'absent' => count($absent),
			    ]
			);

			DB::commit();

			return redirect()->back()->with('success', 'Form submitted successfully!');

		} catch (\Exception $e) {

			DB::rollback();
			\Log::error('Error submission of view-dart: ' . $e->getMessage());
			return redirect()->back()->with('error', 'Form submission failed!');
		}

	}


	function SubmitOtherDuty(Request $request)
	{

		$alldata = $request->all();
		$userId  = \Auth::id();

		$validator  = Validator::make($request->all(), [
		'school_id'              => 'required|integer|min:1',
		'other_class'            => 'required',
		'period'                 => 'required|integer|min:1',
		'other_date'    		 => 'required',
		'other_duty_activity'    => 'required|integer|min:1',

		]);


		if($validator->fails()) 
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//Report::where('school_id',$request->school_id)->where('custom_class_id',$request->custm_cls_id)->where('date',$request->date)->where('period',$request->period)->where('submitted_by',$userId)->delete();
		
		$myArray = explode('-', $request->other_class);
		
		$sid = $request->school_id;

		$TermMasterId = TermMaster::where('school_id', $sid)
		->where('is_active', 1)
		->whereDate('term_start_date', '<=', today())
		->whereDate('term_end_date', '>=', today())
		->value('id');
		
		$cnt = count($myArray);
		if($cnt>1)
		{
		 $custm_cls_id  = $myArray[0];
		 $class_id      = $myArray[1];
		}
		else
		 $class_id  = $myArray[0];  
	
		DB::beginTransaction();

		$dateConvert =  $request->other_date;
		
		try {

			$reports = new Report;
			$reports->school_id                  =  $request->school_id;
			$reports->term_master_id  			 =  $TermMasterId;
			$reports->class_id                   =  $class_id;
			$reports->custom_class_id            =  $custm_cls_id;
			$reports->period                     =  $request->period;
			$reports->date                       =  $dateConvert;
			$reports->other_duty_activity_id     =  $request->other_duty_activity;
			$reports->submitted_by               =  $userId;
			$reports->status                     =  1;
			$reports->save(); 

			ViewDart::create(
			    [
			        'school_id' => $request->school_id,
					'term_master_id'  =>  $TermMasterId,
			        'trainer_id' => $userId,
			        'period' => $request->period,
			        'custm_cls_id' => $custm_cls_id,
			        'other_duties_id' =>  $request->other_duty_activity,
			        'date' => $request->other_date,
			    ]
			);


			DB::commit();

			return redirect()->back()->with('success', 'Form submitted successfully!');

		} catch (\Exception $e) {

			DB::rollback();
			\Log::error('Error submission of view-dart: ' . $e->getMessage());
			return redirect()->back()->with('error', 'Form submission failed!');

		}
	}
	

	function SubmitFillDartNCS(Request $request) {
			
		$dateArray = explode(",", $request->date);
		$alldata = $request->all();
		$userId  = \Auth::id();
		

		$validator  = Validator::make($request->all(), [
            'school_id'   => 'required|integer|min:1',
            'sclass'      => 'required',
            'period'      => 'required|integer|min:1',
			'date'        => 'required',
			'skillarea'   => 'required|integer|min:1',
			'skillsports' => 'required|integer|min:1',
			'technique'   => 'required|integer|min:1',
			'std_idd.*'    => 'required',
			'activity'    => 'required|integer|min:1',
			
        ]);
		
		
        if($validator->fails()) 
		{
            return Redirect::back()->withErrors($validator)->withInput();
        }

		$myArray = explode('-', $request->sclass);
		$cnt = count($myArray);
		if($cnt>1)
		$class_id  = $myArray[1];
        else
		$class_id  = $myArray[0];  

		$studentids = $request->std_idd;
		$levels    = $request->level;
		
		$sid = $request->school_id;
	
		$TermMasterId = TermMaster::where('school_id', $sid)
		 ->where('is_active', 1)
		->whereDate('term_start_date', '<=', today())
		->whereDate('term_end_date', '>=', today())
		->value('id');

		$present = $absent = [];
		foreach($levels as $val){
			if($val == 0){
				$absent[] = $val;
			}else{
				$present[] = $val;
			}
		}
		
		DB::beginTransaction();

		try {


			foreach($dateArray as  $datekey => $dateval) {
			
				foreach($studentids as $key => $val)
				{
				  Report::where('school_id',$request->school_id)->where('custom_class_id',$request->custm_cls_id)->where('date',$dateval)->where('period',$request->period)->where('submitted_by',$userId)->delete();
				}
				
				//$dateConvert =  $request->date;
				

				foreach($studentids as $key => $val)
				{
					// Enable query logging
					//DB::enableQueryLog();

					$reports = new Report;
					$reports->school_id       =  $request->school_id;
					$reports->term_master_id  =  $TermMasterId;
					$reports->class_id        =  $class_id;
					$reports->custom_class_id =  $request->custm_cls_id;
					$reports->period          =  $request->period;
					$reports->date            =  $dateval;
					$reports->skill_area_id   =  $request->skillarea;
					$reports->skill_sports_id =  $request->skillsports;
					$reports->technique_id    =  $request->technique;
					$reports->activity_id     =  $request->activity;
					$reports->student_id      =  $val;
					$reports->level           =  $levels[$val];
					$reports->submitted_by    =  $userId;
					$reports->status          =  1;
					$reports->save(); 
					
					// Print the last executed query
					//echo "<pre>";
					//print_r(DB::getQueryLog());

					ViewDart::updateOrCreate(
					    [
					        'school_id' => $request->school_id,
							'term_master_id' => $TermMasterId,
					        'trainer_id' => $userId,
					        'period' => $request->period,
					        'custm_cls_id' => $request->custm_cls_id,
					        'skill_area_id' => $request->skillarea,
					        'skillsports_id' => $request->skillsports,
					        'technique_id' => $request->technique,
					        'activity_id' => $request->activity,
					        'date' => $dateval,
					    ],
					    [
					        'total_student' => count($studentids),
					        'present' => count($present),
					        'absent' => count($absent),
					    ]
					);


				}
			}

			DB::commit();
			return redirect()->back()->with('success', 'Form submitted successfully!');

		} catch (\Exception $e) {

			DB::rollback();
			\Log::error('Error submission of ncs-view-dart: ' . $e->getMessage());
			return redirect()->back()->with('error', 'Form submission failed!');
		}

	}

	
	
	function SubmitFillDartNCS_bk(Request $request) {
			
		$dateArray = explode(",", $request->date);
		$alldata = $request->all();
		$userId  = \Auth::id();
		
		#echo "<pre>";
		#print_r($dateArray);
		#print_r($alldata);
		#print_r($userId);
		#die('----');

		$validator  = Validator::make($request->all(), [
            'school_id'   => 'required|integer|min:1',
            'sclass'      => 'required',
            'period'      => 'required|integer|min:1',
			'date'        => 'required',
			'skillarea'   => 'required|integer|min:1',
			'skillsports' => 'required|integer|min:1',
			'technique'   => 'required|integer|min:1',
			'std_idd.*'    => 'required',
			'activity'    => 'required|integer|min:1',
			
        ]);
		
		
        if($validator->fails()) 
		{
            return Redirect::back()->withErrors($validator)->withInput();
        }

		$myArray = explode('-', $request->sclass);
		$cnt = count($myArray);
		if($cnt>1)
		$class_id  = $myArray[1];
        else
		$class_id  = $myArray[0];  

		$studentids = $request->std_idd;
		$levels    = $request->level;
		
		
		foreach($dateArray as  $datekey => $dateval)
		{
		
			foreach($studentids as $key => $val)
			{
			  Report::where('school_id',$request->school_id)->where('custom_class_id',$request->custm_cls_id)->where('date',$dateval)->where('period',$request->period)->where('submitted_by',$userId)->delete();
			}
			
			//$dateConvert =  $request->date;
			

			foreach($studentids as $key => $val)
			{
				// Enable query logging
				//DB::enableQueryLog();

				$reports = new Report;
				$reports->school_id       =  $request->school_id;
				$reports->class_id        =  $class_id;
				$reports->custom_class_id =  $request->custm_cls_id;
				$reports->period          =  $request->period;
				$reports->date            =  $dateval;
				$reports->skill_area_id   =  $request->skillarea;
				$reports->skill_sports_id =  $request->skillsports;
				$reports->technique_id    =  $request->technique;
				$reports->activity_id     =  $request->activity;
				$reports->student_id      =  $val;
				$reports->level           =  $levels[$val];
				$reports->submitted_by    =  $userId;
				$reports->status          =  1;
				$reports->save(); 
				
				// Print the last executed query
				//echo "<pre>";
				//print_r(DB::getQueryLog());

			}
		
		
			
		}

		return redirect()->back()->with('success', 'Form submitted successfully!');


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


	function ViewDart(request $request)
	{
    
		$title   = 'View DART';
		$userId  = \Auth::id();
		$name    = \Auth::user()->name;

		//$SchoolTrainers = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->pluck('school_id');
		//$schools = School::WhereIn('id', $SchoolTrainers)->orderBY('school_name','ASC')->get();	
		//return view('fill-darts.view-dart',compact('title', 'schools'));


		$getTrainerReport = DB::table('reports')
		->select('date', 'period', 'class.name as classname', 'section', 'title')
		->join('custom_classes','custom_classes.id','=','reports.custom_class_id')
		->join('class','class.id','=','reports.class_id')
		->join('activity','activity.id','=','reports.activity_id')
		->groupBy(['custom_class_id','date'])
		->where('submitted_by', $userId);
		//->get();

		$count = $getTrainerReport->count(); 
		$results =$getTrainerReport->paginate(40);

		return view('fill-darts.view-dart',compact('title','getTrainerReport', 'name', 'count', 'results'));

	}

	function ViewDartByClass(request $request)
	{
		
		$getDataByClass = DB::table('students')
		->select('id', 'student_name', 'gender', 'dob', 'email_id')
		->where('school_id', $request->school_id)
		->where('class_id', $request->class_id)
		->where('custom_class_id', $request->custm_cls_id)
		->get();

		return Response::json(array('success'=>true,'result'=>$getDataByClass));

	}


	function getFillDARTSkillArea(request $request)
	{
		
		$userId  = \Auth::id();
		$date = $request->input('date_id');
		//Convert the date to the desired format (dd/mm/yyyy)
		//$formattedDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
		$formattedDate = $date;
		
		$userId  = \Auth::id();
		$DataAlreadyExistORNOT = DB::table('reports')
		->select('reports.*')
		->where('school_id', $request->school_id)
		->where('date', "$formattedDate")
		->where('custom_class_id', $request->custom_class_id)
		->where('period', $request->period_id)
		->where('submitted_by', $userId)
		->get();
		

		/*$skillarea = DB::table('class_skillarea')
			->leftjoin('skillareas','skillareas.id', '=' ,'class_skillarea.skillarea_id')
			->select('skillareas.name','skillareas.id')
			->where('class_skillarea.class_id', $request->class_id)->orderBy('skillareas.name', 'ASC')
			->get();*/
			
			$skillarea = DB::table('skillareas')
			->select('skillareas.name','skillareas.id')
			->where('status', 1)
			->orderBy('skillareas.name', 'ASC')
			->get();

			$sarea = '<option value="">--select--</option>';

			if(!empty($sarea))
			{
				foreach($skillarea as $skill)
				{
					$sarea .= '<option value="'.$skill->id.'">'.$skill->name.'</option>';
				}
			}


		if(count($DataAlreadyExistORNOT)>0) 
		{
			return Response::json(array('success'=>true,'alreadyexist'=>true, 'result'=>$DataAlreadyExistORNOT, 'skillarea' => $sarea));

		}else
		{

			/*$skillarea = DB::table('class_skillarea')
			->leftjoin('skillareas','skillareas.id', '=' ,'class_skillarea.skillarea_id')
			->select('skillareas.name','skillareas.id')
			->where('class_skillarea.class_id', $request->class_id)->orderBy('skillareas.name', 'ASC')
			->get();*/
			
			$skillarea = DB::table('skillareas')
			->select('skillareas.name','skillareas.id')
			->where('status', 1)
			->orderBy('skillareas.name', 'ASC')
			->get();

			$sarea = '<option value="">--select--</option>';

			if(!empty($sarea))
			{
				foreach($skillarea as $skill)
				{
					$sarea .= '<option value="'.$skill->id.'">'.$skill->name.'</option>';
				}
			}
	
			return Response::json(array('success'=>true,'alreadyexist'=>false,'skillarea'=>$sarea));

		}

		
	}
	
	
	public function ParisOlympics()
	{
		$title = "Paris 2024";
		return view('fill-darts.paris-medals', compact('title'));
	}
	
	
	
	function TrainerActivity(Request $request)
	{

			$alldata = $request->all();
			$userId  = \Auth::id();
		
			#echo "<pre>";
			#print_r($alldata);
			#die('---jai shree shaym---');

			$validator  = Validator::make($request->all(), [
				'remarks'              => 'required',
				'activity_type'        => 'required',
			]);
		
		
			if($validator->fails()) 
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}
		
			 $date = date('Y-m-d');
		
			$TrainerActiviy = new TrainerActivity;
			$TrainerActiviy->date            =  $date;
			$TrainerActiviy->activity_type   =  $request->activity_type;
			$TrainerActiviy->trainer_id      =  $userId;
			$TrainerActiviy->activity        =  $request->remarks;
			$TrainerActiviy->status          =  1;
			$TrainerActiviy->save(); 

		

		return redirect()->back()->with('success', 'Form submitted successfully!');


	}
	
	
	function termsExam(Request $request)
	{
		$title = 'Terms Exam Import'; 
		return view('fill-darts.term-exam-import-data', compact('title'));
	}
	
	
	function termsExamImportData(Request $request)
	{
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new TermExamImportData, $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
	}
	

	
	
	
	
}
