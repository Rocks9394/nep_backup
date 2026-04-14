<?php

namespace App\Http\Controllers\NativeApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Models\Skill;
use App\Models\Technique;
use App\Models\Sport;
use App\Models\Sstudent;

class GeneralController extends Controller {


	public function GetActivityList(){
		
		$videos = [
		    ['id' => 'g1rCLbqosQU', 'title' => 'Balance'],
		    ['id' => 'u8jSpu9qceQ', 'title' => 'Abdominal muscular strength and Endurance'],
		    ['id' => 'EjjvPin7sZc', 'title' => 'Muscular Endurance for Children'],
		    ['id' => 'SCcs5ccJp8E', 'title' => 'Muscular Endurance for Adults'],
		    ['id' => 'FMN9GRh5oj0', 'title' => 'Agility for 65+'],
		    ['id' => '2mM5m5XLHT8', 'title' => 'Flexibility for 65+'],
		    ['id' => 'WQTEnfNmwFo', 'title' => 'Abdominal Muscular Strength & Endurance for 19-65'],
		    ['id' => 'QwhZl7IbtR4', 'title' => 'Cardiovascular Endurance'],
		    ['id' => 'wD3DenG9JiQ', 'title' => 'Flexibility for 9-18'],
		    ['id' => 'msjIcQ0lKCk', 'title' => 'Flexibility for 19 to 65'],
		    ['id' => 'LZRKCMrFVCQ', 'title' => 'Aerobic Endurance for 65+'],
		    ['id' => 'GX-w7lOUd0c', 'title' => 'Muscular Endurance for 65+'],
		    ['id' => 'BxvdqGqeGiY', 'title' => 'Flexibility for 65+'],
		];

		return Response::json([
			'status' => true,
			'video'  => $videos,
		]);
	}

	function activityAccordingToClass(Request $request) {

		try{

			$userId  = Auth::guard('student-api')->user()->id;
			$schoolId = null;
		
			/*
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
		    */

	        if (!$request->has('custom_class_id') || !$request->custom_class_id) {
	            return Response::json(['success' => false, 'message' => 'Class ID is required'], 400);
	        }


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
				'activity.id',
		        'activity.title',
		        'activity.image',
		        'skillareas.name as skillname', 
		        'sports.name as sportsname', 
		        'techniques.name as techniquename',
		        'activity_technique.class_id'

			)

			->where('activity_technique.class_id',$classId)
			->where('activity.teach_id', 2)->where('activity.status', 1);

		
	        if ($request->filled('skill_area_id')) {
	            $activityQuery->where('activity_technique.skillarea_id', $request->skill_area_id);
	        }

	        if ($request->filled('sport_skill_id')) {
	            $activityQuery->where('activity_technique.sportskill_id', $request->sport_skill_id);
	        }

	        if ($request->filled('technique_id')) {
	            $activityQuery->where('activity_technique.technique_id', $request->technique_id);
	        }


        	$skillAreas = DB::table('class_skillarea')
            ->join('skillareas', 'skillareas.id', '=', 'class_skillarea.skillarea_id')
            ->select('skillareas.name', 'skillareas.id')
            ->where('class_skillarea.class_id', $classId)
            ->orderBy('skillareas.name', 'ASC')
            ->get();


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
	                    ->groupBy('sports.id','sports.name')
	                    ->get();

	            } elseif ($skillAreaId == 8) { // Sports for All
	                $schoolSports = DB::table('school_do_sports')
	                    ->join('sports', 'sports.id', '=', 'school_do_sports.sports_id')
	                    ->select('sports.id', 'sports.name')
	                    ->where('school_do_sports.school_id', $school_id)
	                    ->orderBy('sports.name', 'ASC')
	                    ->groupBy('sports.id','sports.name')
	                    ->get()
	                    ->toArray();

	                $classSports = DB::table('class_skillarea_sports')
	                    ->join('sports', 'sports.id', '=', 'class_skillarea_sports.sports_id')
	                    ->select('sports.id', 'sports.name')
	                    ->where('class_skillarea_sports.class_id', $classId)
	                    ->where('class_skillarea_sports.skillarea_id', 1) // Fundamental Movement Skills
	                    ->orderBy('sports.name', 'ASC')
	                    ->groupBy('sports.id','sports.name')
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
	                    ->groupBy('sports.id','sports.name')
	                    ->get();
	            }

        	}

            // Get sports based on school and skill area
        	$sportsQuery = DB::table('class_skillarea_sports')
            ->join('sports', 'sports.id', '=', 'class_skillarea_sports.sports_id')
            ->select('sports.id', 'sports.name')
            ->where('class_skillarea_sports.class_id', $classId);

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
        	$activities = $activityQuery->orderBy('skillareas.name')->orderBy('sports.name')->orderBy('techniques.name')->get();

			$doneActivityIds = DB::table('reports')
		    ->where('school_id', $request->school_id)
		    ->where('custom_class_id', $request->custom_class_id)
		    ->pluck('activity_id')
		    ->toArray();


			$activities = $activities->map(function($activity) use ($doneActivityIds) {
		
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

			    $activity->status = in_array($activity->id, $doneActivityIds) ? 'Completed' : 'upcoming';

			    return $activity;
			});

			return Response::json([
	            'success' => true,
	            'activitieslist' => $activities,

	            'skillArea' => $skillAreas,
	            'sports' => $sports,
	            'technique' => $techniques
	        ]);

		} catch (\Exception $e) {
	        return Response::json([
	            'success' => false,
	            'message' => 'An error occurred: ' . $e->getMessage()
	        ], 500);
	    }
	}


}