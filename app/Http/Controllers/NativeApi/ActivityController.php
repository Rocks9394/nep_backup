<?php

namespace App\Http\Controllers\NativeApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use DB;
use Response;
use App\Models\Sstudent;

class ActivityController extends Controller
{
 	
 	public function ActivityDetail (Request $request) {

 		$activiy_id = $request->input('act_id');
 		$class_id = $request->input('class_id');

		$activities = DB::table('activity_technique')
	    ->join('activity', 'activity.id', '=', 'activity_technique.act_id')
	    ->join('techniques', 'techniques.id', '=', 'activity_technique.technique_id')
	    ->join('skillareas', 'skillareas.id', '=', 'activity_technique.skillarea_id')
	    ->join('sports', 'sports.id', '=', 'activity_technique.sportskill_id')
	    ->join('class', 'class.id', '=', 'activity_technique.class_id')
	    ->select(
	        'class.name as class',
	        'skillareas.name as skillArea',
	        'sports.name as skillSport',
	        'techniques.name as technique',
	        'activity.title',
	        'activity.url as video_url',
	        'activity.image',
	        'activity.learning_outcomes',
	        'activity.description',
	        'activity.change_it as variation',
	        'activity.coaching as coaching_tips',
	        'activity.equipment'
	    )
	    ->where('activity_technique.is_active', 1)
	    ->where('activity_technique.act_id', $activiy_id)
	    ->where('activity_technique.class_id', $class_id)
	    ->get();

	    // ->map(function ($item) {
     //        if ($item->image && !filter_var($item->image, FILTER_VALIDATE_URL)) {         
     //            $item->image = asset('uploads/activities/' . $item->image);
     //        }            
           
     //        if (empty($item->image)) {
     //            $item->image = asset('images/default-placeholder.png');
     //        }

     //        return $item;
     //    });
	    // ;


		return Response::json([
			'success'=>true, 
			'activityDetail'=>$activities
		]);
 	}

 	public function schoolRecords(Request $request) {

		$id = $request->input('student_id');
		$studentDetails = Sstudent::where('id', $id)->get()->toArray();


		echo "<pre>"; print_r($studentDetails); exit();


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

		uasort($classData, function ($a, $b) use ($customOrder) {
		    $aWeight = $customOrder[$a['class']] ?? 100 + (int)$a['class_id'];
		    $bWeight = $customOrder[$b['class']] ?? 100 + (int)$b['class_id'];

		    // If weights are equal, sort by section
		    if ($aWeight === $bWeight) {
		        return strcmp($a['section'], $b['section']);
		    }

		    return $aWeight <=> $bWeight;
		});


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
	
		
    	$title = 'Dashboard';
    	return view('school.dashboard', compact('title','SchoolData','classData','trainerActivities', 'latestActivity', 'PEActivityCount')); 
    }


}
