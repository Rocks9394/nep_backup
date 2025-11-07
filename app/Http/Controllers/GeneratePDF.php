<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Activity;
use App\Models\Conceptactivity;
use App\Models\ActivityTechnique;

class GeneratePDF extends Controller
{
    //
	public function generateActivityPDF(Request $request){
		
		if(isset($request->activities)){
			$string = str_replace(' ', '', $request->activities);
			$activityIDs = explode(",",$string);
		}
		//dd($activityIDs);
		$activities  = Activity::
		leftJoin('activity_concept', 'activity.id', '=', 'activity_concept.act_id')
		->leftJoin('activity_technique', 'activity.id', '=', 'activity_technique.act_id')
		->leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
		->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
		->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
		->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
		->leftJoin('class as c1', 'c1.id', '=', 'activity_technique.class_id')
		->leftJoin('skillareas', 'skillareas.id', '=', 'activity_technique.skillarea_id')
		->leftJoin('sports', 'sports.id', '=', 'activity_technique.sportskill_id')
		->leftJoin('techniques', 'techniques.id', '=', 'activity_technique.technique_id')
		->whereIn('activity.id', $activityIDs)->get(['activity.*', 'class.name as clsname', 'subject.name as subjectname', 'chapter.name as chaptername', 'concept.name as conceptname','c1.name as cls1name','skillareas.name as skillareaname', 'sports.name as sportsname', 'techniques.name as techniquename']);
		
        $pdf = PDF::loadView('activityPDF', compact('activities'));
        return $pdf->download('activities.pdf');
	}
	
	
	public function generateActivityPDFshow(Request $request){
		return view('activityPDFForm');
	}
}
