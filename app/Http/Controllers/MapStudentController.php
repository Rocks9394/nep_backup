<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentMapSports;
use DB;
use Response;
use Validator;
use Redirect;
use Session;
use App\Models\Sport;
use Auth;
use App\Models\Skill;
use App\Models\Technique;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class MapStudentController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth')->except(['lessionPlanDetails','activityAccordingToClass', 'fetchactivityAccordingToClass']);
    }
	
	public function dashboard()
	{
		$title = 'Map Students';
		return view('fill-darts.dashboard', compact('title')); 
	} 
	
	public function index(Request $request)
	{
		
   		 $title = 'Map Students';
		 
		 $userId  =  \Auth::id();
		 $role_id =  \Auth::user()->role_id;
		 $SchoolTrainers = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->pluck('school_id');
		
		if($role_id != 3)
		{
			die('--you are not a teacher. teacher can only access--');
		}
		
		if(empty($SchoolTrainers))
		{
			die('--we dont have access for this panel. sorry for inconvenation--');
		}

		$schoolId = $SchoolTrainers[0];
		
		// $classes_test = DB::table('custom_classes')
		// ->join('class','class.id','=','custom_classes.class_id')
		// ->select('custom_classes.id','class_id','section',

		// 	DB::raw("CASE 
	    //         WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
	    //         THEN custom_classes.nomenclature 
	    //         ELSE class.name 
	    //       END AS classname")
			
		// 	// 'class.name AS classname'
		// )
		// ->WhereIn('school_id', array($schoolId))
		// ->orderBy('custom_classes.orders', 'ASC')
		// ->get();


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

		$sports = DB::table('sports')->get();

		return view('fill-darts.map-students', compact('title', 'schoolId', 'classes', 'sports')); 
		
    }


	public function UpdateStudentSports(request $request)
	{
	
		$alldata = $request->all();
		$userId  = \Auth::id();
		
		
		$validator  = Validator::make($request->all(), [
            'school_id'     => 'required|integer|min:1',
            'by_class_id'   => 'required',
            'std_idd.*'     => 'required',
			//'sports.*'    => 'required',
        ]);

        if($validator->fails()) 
		{
            return Redirect::back()->withErrors($validator)->withInput();
        }

		$myArray          =  explode('-', $request->by_class_id);
		$custom_class_id  =  $myArray[0];
		$class_id         =  $myArray[1];  

		$school_id   =  $request->school_id;
		$studentids  =  $request->std_idd;
		$sports      =  $request->sports;


		$StudentDataAlreadyExist = StudentMapSports::where('school_id',$school_id)->where('custom_class_id',$custom_class_id)->get();


		if(count($StudentDataAlreadyExist)>0) 
		{
			
			foreach($studentids as $key => $val)
			{
				StudentMapSports::where('school_id',$school_id)->where('custom_class_id',$custom_class_id)->delete();
			}

		}



		foreach($studentids as $key => $val)
		{
			 if (isset($sports[$val]) && is_array($sports[$val])) 
			 {
				foreach ($sports[$val] as $sport_id) 
				{
					$mapdata                  =   new StudentMapSports;
					$mapdata->school_id       =   $request->school_id;
					$mapdata->class_id        =   $class_id;
					$mapdata->custom_class_id =   $custom_class_id;
					$mapdata->student_id      =   $val;
					$mapdata->sports_id       =   $sport_id;
					$mapdata->status          =   '1';
					$mapdata->submitted_by    =   $userId;
					$mapdata->status          =   1;
					$mapdata->save(); 
				}
			}

		}

		return redirect()->back()->with('success', 'Form submitted successfully!');



	}



	function getStudentsAccordingToClass(Request $request)
	{
		$myArray       = explode('-', $request->class_id);
		$school_id     = $request->school_id;
		$custm_cls_id  = $myArray[0];
		$class_id      = $myArray[1];

		// Retrieve students according to class
		$gtstud = DB::table('students')
			->select('students.id', 'student_name')
			->where('school_id', $school_id)
			->where('custom_class_id', $custm_cls_id)
			->where('class_id', $class_id)
			->where('status', 'active')
			->get();

		// Retrieve existing student-sports mappings
		$StudentDataAlreadyExist = StudentMapSports::where('school_id', $school_id)
			->where('custom_class_id', $custm_cls_id)
			->get();

		// Group existing sports data by student ID
		$mappedStudents = [];
		foreach ($StudentDataAlreadyExist as $data) {
			$mappedStudents[$data->student_id][] = $data->sports_id;
		}

		if (count($StudentDataAlreadyExist) > 0) {
			return Response::json([
				'success' => true,
				'alreadyexist' => true,
				'studentrecord' => $gtstud,
				'mappedstudent' => $mappedStudents
			]);
		} else {
			return Response::json([
				'success' => true,
				'alreadyexist' => false,
				'studentrecord' => $gtstud,
				'mappedstudent' => $mappedStudents
			]);
		}
	}



	function activityAccordingToClass(Request $request)
	{
		
		$title    = 'Activity Planner';
		$userId   =  \Auth::id();
		$role_id  =  \Auth::user()->role_id ?? '';
		$schoolId = null;
		

		// $classeQuery = DB::table('custom_classes')
		//  ->join('class','class.id','=','custom_classes.class_id')
		//  ->select('custom_classes.id','class_id','section',
		//  	DB::raw("CASE 
	    //         WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
	    //         THEN custom_classes.nomenclature 
	    //         ELSE class.name 
	    //     END AS classname"),
		//  	)
		// ->where('custom_classes.status','1');


		$classeQuery = DB::table('custom_classes')
			->join('class','class.id','=','custom_classes.class_id')
			->join('students','students.custom_class_id','=' ,'custom_classes.id')
			->select('custom_classes.id','custom_classes.class_id','custom_classes.section',
		 	DB::raw("CASE 
	            WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
	            THEN custom_classes.nomenclature 
	            ELSE class.name 
	        END AS classname"),
		 	)		
			->where('students.status','active')
			->where('custom_classes.status','1');

		if (\Auth::guard('sstudent')->check() || session('Auth_id')) {
	        $UserData = \Auth::guard('sstudent')->user();
	        $schoolId = $UserData->school_id;
	        $classId = $UserData->custom_class_id;
	        $classeQuery->where('students.id', $UserData->id)->where('custom_classes.id', $classId);
	    }
		elseif($role_id == 4) {
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
			$classeQuery->WhereIn('custom_classes.school_id', array($schoolId))
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

		} 
		elseif($role_id == 3) {
			if(Session::get('SelectSchoolId')){	
				$schoolId = Session::get('SelectSchoolId');			
			}else{			
				$schoolId = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->pluck('school_id');
			}
			$classeQuery->WhereIn('custom_classes.school_id', array($schoolId))
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
			
		} 

	    $classes = $classeQuery->orderBy('custom_classes.orders', 'ASC')->get();


		$skillareas = Skill::orderBy('name', 'ASC')->where('status',  1)->select('id','name')->get();
		$sportskills = Sport::orderBy('name', 'ASC')->get();
		$techniques = Technique::orderBy('name', 'ASC')->get();

		// return view('fill-darts.activity-according-class', compact('title', 'schoolId', 'classes'));
		return view('fill-darts.activity-according-class', compact('title', 'schoolId', 'classes','skillareas','sportskills','techniques'));
		

	}




	
	/* Get Records Custom Classes */
	function fetchactivityAccordingToClass(Request $request) {


		try{

			$userId   =  \Auth::id();
			$role_id  =  \Auth::user()->role_id ?? '';
			$school_id = null;


			if($role_id == 3) {
				$school_id = DB::table('school_trainers')->where('status', 1)->pluck('school_id') ->toArray();

			} elseif($role_id == 4) {
				$school_id = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');

			} elseif (\Auth::guard('sstudent')->check()) {
		        $UserData = \Auth::guard('sstudent')->user();
		        $school_id = $UserData->school_id;
		       
		    }


			// Validate required parameters
	        if (!$request->has('custom_class_id') || !$request->custom_class_id) {
	            return Response::json(['success' => false, 'message' => 'Class ID is required'], 400);
	        }

	        // Get class ID
	        $classId = DB::table('custom_classes')->where('id', $request->custom_class_id)->value('class_id');

	        if (!$classId) {
	            return Response::json(['success' => false, 'message' => 'Invalid Class ID'], 400);
	        }


	        // Main query for activities
			$activityQuery = DB::table('activity_technique')
			->join('activity','activity.id','=','activity_technique.act_id')
			->join('skillareas','skillareas.id','=','activity_technique.skillarea_id')
			->join('sports','sports.id','=','activity_technique.sportskill_id')
			->join('techniques','techniques.id', '=', 'activity_technique.technique_id')
			->select(
				'activity_technique.act_id as activity_id',
				'skillareas.name as skillname', 
				'sports.name as sportsname', 
				'techniques.name as techniquename',  
				'activity.id',
				'title',
				'image',
				'description',
				'learning_outcomes',
				'change_it', 
				'skillareas.id as skillId', 
				'sports.id as sportsID', 
				'techniques.id as techniqueId')
			->where('activity_technique.class_id',$classId)
			->where('activity.teach_id', 2)->where('activity.status', 1);


			// Apply filters if provided
	        if ($request->filled('skill_area_id')) {
	            $activityQuery->where('activity_technique.skillarea_id', $request->skill_area_id);
	        }

	        if ($request->filled('sport_skill_id')) {
	            $activityQuery->where('activity_technique.sportskill_id', $request->sport_skill_id);
	        }

	        if ($request->filled('technique_id')) {
	            $activityQuery->where('activity_technique.technique_id', $request->technique_id);
	        }



        	// Get skill areas for the class
        	$skillAreas = DB::table('class_skillarea')
            ->join('skillareas', 'skillareas.id', '=', 'class_skillarea.skillarea_id')
            ->select('skillareas.name', 'skillareas.id')
            ->where('class_skillarea.class_id', $classId)
            ->orderBy('skillareas.name', 'ASC')
            ->get();


            // Get sports based on different conditions
        	$sports = collect();

        	if ($request->filled('skill_area_id')) {
        		$skillAreaId = $request->skill_area_id;

        		if ($skillAreaId == 2) { // Specialised Sports Coaching
	                $sports = DB::table('school_do_sports')
	                    ->join('sports', 'sports.id', '=', 'school_do_sports.sports_id')
	                    ->select('sports.id', 'sports.name')
	                    ->where('school_do_sports.school_id', $school_id)
	                    ->where('school_do_sports.skill_id', $skillAreaId)
	                    ->orderBy('sports.name', 'ASC')
	                    ->groupBy('sports.id')
	                    ->get();

	            } elseif ($skillAreaId == 8) { // Sports for All
	                $schoolSports = DB::table('school_do_sports')
	                    ->join('sports', 'sports.id', '=', 'school_do_sports.sports_id')
	                    ->select('sports.id', 'sports.name')
	                    ->where('school_do_sports.school_id', $school_id)
	                    ->orderBy('sports.name', 'ASC')
	                    ->groupBy('sports.id')
	                    ->get()
	                    ->toArray();

	                $classSports = DB::table('class_skillarea_sports')
	                    ->join('sports', 'sports.id', '=', 'class_skillarea_sports.sports_id')
	                    ->select('sports.id', 'sports.name')
	                    ->where('class_skillarea_sports.class_id', $classId)
	                    ->where('class_skillarea_sports.skillarea_id', 1) // Fundamental Movement Skills
	                    ->orderBy('sports.name', 'ASC')
	                    ->groupBy('sports.id')
	                    ->get()
	                    ->toArray();

	                $sports = collect(array_merge($classSports, $schoolSports))->unique('id');
	            } else { // Fundamental Movement Skills (1) or others
	                $sports = DB::table('class_skillarea_sports')
	                    ->join('sports', 'sports.id', '=', 'class_skillarea_sports.sports_id')
	                    ->select('sports.id', 'sports.name')
	                    ->where('class_skillarea_sports.class_id', $classId)
	                    ->where('class_skillarea_sports.skillarea_id', $skillAreaId)
	                    ->orderBy('sports.name', 'ASC')
	                    ->groupBy('sports.id')
	                    ->get();
	            }

        	}

            // Get sports based on school and skill area
        	$sportsQuery = DB::table('class_skillarea_sports')
            ->join('sports', 'sports.id', '=', 'class_skillarea_sports.sports_id')
            ->select('sports.id', 'sports.name')
            ->where('class_skillarea_sports.class_id', $classId);


	        // Get techniques based on class, skill area, and sport
        	$techniquesQuery = DB::table('class_skillarea_sports_tech')
            ->join('techniques', 'techniques.id', '=', 'class_skillarea_sports_tech.tech_id')
            ->select('techniques.id', 'techniques.name')
            ->where('class_skillarea_sports_tech.class_id', $classId);

            if ($request->filled('skill_area_id')) {
	            $techniquesQuery->where('class_skillarea_sports_tech.skillarea_id', $request->skill_area_id);
	        }

	        if ($request->filled('sport_skill_id')) {
	            $techniquesQuery->where('class_skillarea_sports_tech.sports_id', $request->sport_skill_id);
	        }

	        $techniques = $techniquesQuery->groupBy('techniques.id', 'techniques.name')->orderBy('techniques.name', 'ASC')->get();


	        // Finalize activities query
        	$activities = $activityQuery->orderBy('skillareas.name')->orderBy('sports.name')->orderBy('techniques.name')->get();

        	foreach ($activities as $activity) {
			    if (!empty($activity->image)) {
			        if (str_contains($activity->image, 'wp-content')) {
			            $activity->final_image = $activity->image;
			        } elseif (file_exists(public_path('uploads/' . $activity->image))) {
			            $activity->final_image = asset('public/uploads/' . $activity->image);
			        } else {
			            $activity->final_image = asset('public/change-activities/default_activity_img.svg');
			        }
			    } else {
			        $activity->final_image = asset('public/change-activities/default_activity_img.svg');
			    }
			}


	        $doneActivities = DB::table('reports')
			->where('reports.school_id',$request->school_id)
			->where('custom_class_id',$request->custom_class_id)
			->select('skill_area_id', 'skill_sports_id', 'technique_id', 'activity_id')
			->groupBy('skill_area_id', 'skill_sports_id', 'technique_id', 'activity_id')
			->get();


			return Response::json([
	            'success' => true,
	            'activitieslist' => $activities,
	            'ActivityAlreadyDone' => $doneActivities,
	            'skillarea' => $skillAreas,
	            'sportskills' => $sports,
	            'techniques' => $techniques
	        ]);

		} catch (\Exception $e) {
	        return Response::json([
	            'success' => false,
	            'message' => 'An error occurred: ' . $e->getMessage()
	        ], 500);
	    }
	}
	
	function fetchactivityAccordingToClass_bk(Request $request)
	{

		/*$getactivity = DB::table('reports')
		->join('activity','activity.id','=','reports.activity_id')
		->join('skillareas','skillareas.id','=','reports.skill_area_id')
		->join('sports','sports.id','=','reports.skill_sports_id')
		->join('techniques','techniques.id', '=', 'reports.technique_id')
		->select('reports.activity_id','skillareas.name as skillname', 'sports.name as sportsname', 'techniques.name as techniquename',  'activity.id','title','image','description','learning_outcomes','change_it')->where('reports.school_id',$request->school_id)->where('custom_class_id',$request->custom_class_id)
		->groupBy('reports.activity_id', 'skillareas.name', 'sports.name', 'techniques.name', 'activity.id', 'title', 'image', 'description', 'learning_outcomes', 'change_it')
		->get();
		
		$classId = DB::table('custom_classes')
		 ->Where('id', $request->custom_class_id)
		 ->where('custom_classes.status','1')
		 ->value('class_id');
		 
		 
		$posts = DB::table('activity')
		->leftJoin('activity_technique','activity_technique.act_id','=','activity.id')
		->join('skillareas','skillareas.id','=','activity_technique.skillarea_id')
		->join('sports','sports.id','=','activity_technique.sportskill_id')
		->join('techniques','techniques.id', '=', 'activity_technique.technique_id')
		->select('activity_technique.act_id  as activity_id','skillareas.name as skillname', 'sports.name as sportsname', 'techniques.name as techniquename',  'activity.id','title','image','description','learning_outcomes','change_it')->where('activity_technique.class_id',$classId)
		->groupBy('activity_technique.act_id', 'skillareas.name', 'sports.name', 'techniques.name', 'activity.id', 'title', 'image', 'description', 'learning_outcomes', 'change_it')
		->get(); 
		
		return Response::json(array('success'=>true, 'activitieslist'=>$getactivity, 'futureActivityList'=>$posts));
		
		*/
		
		

		$classId = DB::table('custom_classes')->where('id',$request->custom_class_id)->value('class_id');
		
		 // Single optimized query combining both
		$getactivity = DB::table('activity_technique')
		->join('activity','activity.id','=','activity_technique.act_id')
		->join('skillareas','skillareas.id','=','activity_technique.skillarea_id')
		->join('sports','sports.id','=','activity_technique.sportskill_id')
		->join('techniques','techniques.id', '=', 'activity_technique.technique_id')
		->select('activity_technique.act_id as activity_id','skillareas.name as skillname', 'sports.name as sportsname', 'techniques.name as techniquename',  'activity.id','title','image','description','learning_outcomes','change_it', 'skillareas.id as skillId', 'sports.id as sportsID', 'techniques.id as techniqueId')
		->where('activity_technique.class_id',$classId)
		->orderBy('skillareas.name') 
	    ->orderBy('sports.name')   
	    ->orderBy('techniques.name')
		->get();
		
		
		
		 $DoneActivityId = DB::table('reports')
		->where('reports.school_id',$request->school_id)
		->where('custom_class_id',$request->custom_class_id)
		->select('skill_area_id', 'skill_sports_id', 'technique_id', 'activity_id')
		->groupBy('skill_area_id', 'skill_sports_id', 'technique_id', 'activity_id')
		->get();
		
		
		return Response::json(array('success'=>true, 'activitieslist'=>$getactivity, 'ActivityAlreadyDone' => $DoneActivityId));
		
		
		
		/*$finalactivity = [];

		foreach($getactivity as $key=>$val)
		{
			$finalactivity[] = DB::table('activity')->select('id','title','image','description','learning_outcomes','change_it')->where('id',$val->activity_id)->first();
		}*/


		// $sportskills = Sport::orderBY('name','ASC')->get();
		// $techniques = Technique::orderBY('name','ASC')->get();	
		// $schools = School::WhereIn('id', $SchoolTrainers)->orderBY('school_name','ASC')->get();		
		// $levels = DB::table('levels')->get();

		// $classes = DB::table('custom_classes')
		// ->join('class','class.id','=','custom_classes.class_id')
		// ->select('custom_classes.id','class_id','section','class.name AS classname')
		// ->WhereIn('school_id', $SchoolTrainers)
		// ->orderBy('custom_classes.orders', 'ASC')
		// ->get();

		//$users = User::select('name')->distinct()->get();

		// $getSports = DB::table('reports')
		// ->select('skill_sports_id','sports.name as sportsskillname', DB::raw('count(*) as total'))
		// ->join('sports','sports.id','=','reports.skill_sports_id')
		// ->groupBy('skill_sports_id')
		// //->where('student_id', $studentId)
		// ->get();
	

	}
	
	function getSports(Request $request)
	{
		$school_id     = $request->school_id;
		#$sports = Sport::orderBy('name')->get();
        #return response()->json($sports);
	
		$skillsports = DB::table('school_do_sports')
		->Join('sports','sports.id', '=', 'school_do_sports.sports_id')
		->select(['sports.id','sports.name'])
		->where('school_do_sports.school_id', $school_id)
		->orderBy('sports.name', 'ASC')
		->groupBy('sports.id')
		->get(); 
		
		 return response()->json($skillsports);
	}
	
	function lessionPlanDetails(Request $request)	{
		$ActiviyId     = $request->activiy_id;
		$getactivity = DB::table('activity')->where('id', $ActiviyId)->get();

		foreach ($getactivity as $activity) {
		    if (!empty($activity->image)) {
		        if (str_contains($activity->image, 'wp-content')) {
		            $activity->final_image = $activity->image;
		        } elseif (file_exists(public_path('uploads/' . $activity->image))) {
		            $activity->final_image = asset('public/uploads/' . $activity->image);
		        } else {
		            $activity->final_image = asset('public/change-activities/default_activity_img.svg');
		        }
		    } else {
		        $activity->final_image = asset('public/change-activities/default_activity_img.svg');
		    }
		}

		return Response::json(array('success'=>true, 'activityDetail'=>$getactivity));
	}

	public function checkfiles(Request $request){


		$activities = DB::table('activity')->select('id','image','title')
		->where('status',1)
		->where('teach_id',2)
		->get();

		  $existingImages = [];
		    $missingImages = [];

		    foreach ($activities as $activity) {
		        
		        if (!str_starts_with($activity->image, 'http') && !empty($activity->image)) {
		            $imagePath = public_path('uploads/' . $activity->image);		            
		            if (File::exists($imagePath)) {
		                $existingImages[] = [
		                    'id' => $activity->id,
		                    'image' => $activity->image,
		                    'status' => 'Exists'
		                ];
		            } else {
		                $missingImages[] = [
		                    'id' => $activity->id,
		                    'activity' => $activity->title,
		                    'image' => $activity->image,
		                    'status' => 'Missing'
		                ];
		            }
		        }
		    }

		    Storage::disk('local')->put('missing_images.json', json_encode($missingImages, JSON_PRETTY_PRINT));

		   echo "<pre>";
		    //echo "Existing Images:\n";
		    //print_r($existingImages);
		    
		    echo "\n\nMissing Images: ".count($missingImages);
		    print_r($missingImages);
		    exit;

	}
	
}
