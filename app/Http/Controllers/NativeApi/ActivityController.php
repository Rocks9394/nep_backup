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


	    $activities = $activities->map(function($activity) {	
		    if (!empty($activity->image)) {
		        if (str_contains($activity->image, 'wp-content')) {
		            $activity->final_image = $activity->image;
		        } elseif (file_exists(public_path('/' . $activity->image))) {
		            $activity->final_image = asset('/' . $activity->image);
		        } else {
		            $activity->final_image = asset('change-activities/default_activity_img.svg');
		        }
		    } else {
		        $activity->final_image = asset('change-activities/default_activity_img.svg');
		    }

		    return $activity;
		});

	    
		return Response::json([
			'success'=>true, 
			'activityDetail'=>$activities
		]);
 	}

 	public function schoolRecords(Request $request) {

		$id = $request->input('student_id');
		$StudentDetails = Sstudent::select('school_id','id as student_id','class_id','section_id','custom_class_id')->where('id', $id)->first();

		
		// echo "<pre>"; print_r($StudentDetails);

		$SchoolData = [];

		$SchoolData['SelectedSports'] = DB::table('student_map_sports')
		->join('sports','sports.id','=', 'student_map_sports.sports_id')
		->select('sports.name','sports.id as sports_id')
		->where('student_map_sports.student_id', $id)->get()->toArray();
 

		$SchoolData['totalStudents'] = Sstudent::where('school_id', $StudentDetails->school_id)	    
	    ->where('custom_class_id', $StudentDetails->custom_class_id)
	    ->where('status', '<>', 'transfer')
	    ->selectRaw("
	        count(*) as total,
	        count(case when gender = 'male' then 1 end) as male,
	        count(case when gender = 'female' then 1 end) as female
	    ")->first()
	    ->toArray();
			

		 $activeSession = DB::table('schools')
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
		->where('schools.id', $StudentDetails->school_id)
		->where('reports.custom_class_id', $StudentDetails->custom_class_id)
		->groupBy('schools_id','school_trainers.trainer_id','reports.custom_class_id','reports.period', 'reports.date', 'reports.activity_id','reports.skill_area_id','reports.skill_sports_id','TrainerName')
		->get();


		$SchoolData['TotalSession'] = [ 
			'ActiveSession' => $activeSession->count(),
			'ActiveMinutes' => $activeSession->count() * 40,
		];



		$PEActivities = DB::table('schools')
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
		->where('schools.id', $StudentDetails->school_id)
		->where('reports.class_id', $StudentDetails->class_id)
		->groupBy('schools_id','reports.class_id', 'reports.activity_id','reports.skill_area_id','reports.skill_sports_id')
		->get();


		$SchoolData['TotalPEActivities'] = [ 
			'PEActivities' => $PEActivities->count(),
			'FMS' =>  $PEActivities->groupBy('skill_area_id')->count(),
			'Sports' => $PEActivities->where('skill_area_id', '2')->groupBy('skill_sports_id')->count(),
		];

		return Response::json([
			'success'=>true, 
			'SchoolDetails'=>$SchoolData
		]);
    }


    public function LearnSport(Request $request) {
    
    	$items = DB::table('learn_sports')->select('id', 'name', 'img')
		->where('status', 'active')->orderBy('sequence', 'asc')->get();

		$path = 'https://nep.goforfit.in/change-sports/';

 		$result = $items->map( function($items) use ($path) {
 			$array = [
 				'id' => $items->id,
 				'title' => $items->name,
 				'img'  => $path.$items->img,
 			];
 			return $array;
 		});

 		return Response::json([
 			'success' => true,
 			'sports' => $result
 		]);
    }

    public function SportsDetails(Request $request,$sport_id) {

		$title = 'Sports Details';

		$items = DB::table('learn_sports') ->select('name', 'img', 'video', 'desc','id')
		->where('id', $sport_id)->get();

		$path = 'https://nep.goforfit.in/change-sports/';
		$sport_details = $items->map( function($items) use ($path) {
 			$array = [
 				'id' => $items->id,
 				'name' => $items->name,
 				'desc'  =>  $items->desc,
 				'video'  =>  $items->video,
 				'img'  => $path.$items->img,
 			];
 			return $array;
 		});
		

        if (!$sport_details) {
	        return response()->json(['message' => 'Sport not found'], 404);
	    }

	    $videos = DB::table('sports_videos_tutorial')
        ->where('sport_id', $sport_id)
        ->where('status', 'active')
        ->orderBy('chapter')
        ->get();



        $chaptersDetails = $videos->groupBy('chapter')->map(function($chapterVideos, $chapterKey) {
	        return [
	            'chapter_number' => $chapterKey,
	            'chapter_name' => $chapterVideos->first()->chapter_name,
	            'video_count' => $chapterVideos->count(),
	            'videos' => $chapterVideos
	        ];
	    })
	    ->sortBy(function($item) {
		    preg_match('/\d+/', $item['chapter_number'], $matches);
		    return isset($matches[0]) ? (int)$matches[0] : 0;
		})
	    ->values();

        return response()->json([
	        'success' => true,
	        'sport' => $sport_details,
	        'chapters' => $chaptersDetails
	    ]);


    }

    public function TestVideos() {	
	    $TestData = DB::table('fitness_test_videos')
	        ->join('skill_reports', 'skill_reports.TestTypeMasterID', '=', 'fitness_test_videos.testType_id')
	        ->select(
	            'skill_reports.id',
	            'skill_reports.skill_name',
	            'skill_reports.icons',
	            'fitness_test_videos.testType_id',
	            'fitness_test_videos.type_video',
	            'fitness_test_videos.video_url'
	        )
	        ->get();


	    $imageurl = 'https://nep.goforfit.in/uploads/BatteryOfTests/';   

	    $skill_data = $TestData->groupBy('id')->map(function ($items) use ($imageurl) {
	  
	        $firstItem = $items->first();

	        return [
	            'id' => $firstItem->id,
	            'skill_name' => $firstItem->skill_name,
	            'icons' => $imageurl.$firstItem->icons,
	            'ageGroup'   =>  $firstItem->id <= 18 ? '3-8' : '9-18',
	            'languages' => $items->map(function ($video) {
	                return [
	                    'lang' => $video->type_video,
	                    'video_url' => str_replace("https://www.youtube.com/watch?v=", "", $video->video_url),
	                ];
	            })->values()
	        ];
	    })->values();

	    return response()->json([
	        'status' => true,
	        'TestData' => $TestData,
	        'test_skills' => $skill_data
	    ]);
	}



}
