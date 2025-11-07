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
use Mail;
use App\Models\SportVideo;


class PEActivityController extends Controller
{
	
	public function __construct()
    {
    	$this->middleware('auth:web,sstudent');
        $this->middleware('auth');
    }
	

	public function index(Request $request){
   		$title = 'P.E Activities';
		return view('fill-darts.pe-activity', compact('title')); 	
    }


	public function getactive()
	{
		$title = 'Get Active';
		return view('parent.getactive', compact('title'));
	}


	public function LearnSports() {

		$title = 'Learn Sports';
		$sports = DB::table('learn_sports')
		->select('id', 'name', 'img', 'video', 'desc', 'sequence')
		->where('status', 'active')
		->orderBy('sequence', 'asc')
		->get();

		return view('fill-darts.learn-sports.sport_list', compact('title','sports'));

	}


	public function SportsVideos($sport_id) {

		$title = 'Sports Details';

		$videos = DB::table('sports_videos_tutorial')->where('sport_id', $sport_id)->where('status', 'active')->orderBy('chapter')->get();        
        $chaptersDetails = $videos->groupBy('chapter')->map(function($chapterVideos) {
	        return [
	            'chapter_name' => $chapterVideos->first()->chapter_name,
	            'chapterVideos' => $chapterVideos
	        ];
	    })->sortBy(function($chapter, $chapterNumber) {
	        preg_match('/\d+/', $chapterNumber, $matches);
	        return isset($matches[0]) ? (int)$matches[0] : $chapterNumber;
	    });

	    $sport_details = DB::table('learn_sports')->where('id', $sport_id)->select('name','img','video','desc')->first();
        return view('fill-darts.learn-sports.sports', compact('title', 'chaptersDetails','sport_details'));
    }


    public function SportsTopicVideos($sport_id, $topic_id){

    	$videos = DB::table('sports_videos_tutorial')->where('sport_id', $sport_id)->orderBy('chapter')->get();        
        $chapters_details = $videos->groupBy('chapter')->map(function($chapterVideos) {
	        return [
	            'chapter_name' => $chapterVideos->first()->chapter_name,
	            'chapterVideos' => $chapterVideos
	        ];
	    })->sortBy(function($chapter, $chapterNumber) {
	        preg_match('/\d+/', $chapterNumber, $matches);
	        return isset($matches[0]) ? (int)$matches[0] : $chapterNumber;
	    });

	    $topic_details = DB::table('sports_videos_tutorial')->where('id', $topic_id)->first();
    	$title = 'Sports Details';

    	return view('fill-darts.learn-sports.details', compact('title','chapters_details','topic_details'));
    }


	public function LearnSportsTest() {


		$title = 'Learn Sports';
		$sports = DB::table('sports_tutorial_videos')
	    ->join('learn_sports', 'learn_sports.id', '=', 'sports_tutorial_videos.sport_id')
	    ->select(
	        'sports_tutorial_videos.sport_id',
	        'sports_tutorial_videos.sport_name',
	        'learn_sports.sequence',
	        'learn_sports.img'
	    )
	    ->where('learn_sports.status','active')
	    ->distinct()
	    ->orderBy('learn_sports.sequence')
	    ->get();

	    //echo "<pre>"; print_r($sports);exit();


		return view('fill-darts.sports.test.sports-view', compact('title','sports'));
	}

	public function SportsVideosTest($sport_id) {

		$title = 'Sports Details';

		$videos = DB::table('sports_tutorial_videos')->where('sport_id', $sport_id)->orderBy('chapter')->get();
        $sport_name = collect($videos)->first()->sport_name;


        $groupedChapters = $videos->groupBy('chapter')->map(function($chapterVideos) {
	        return [
	            'chapter_topic' => $chapterVideos->first()->chapter_topic,
	            'videos' => $chapterVideos
	        ];
	    })->sortBy(function($chapter, $chapterNumber) {
	        preg_match('/\d+/', $chapterNumber, $matches);
	        return isset($matches[0]) ? (int)$matches[0] : $chapterNumber;
	    });

       // echo "<pre>"; print_r($groupedChapters);exit();

        
        return view('fill-darts.sports.test.videos', compact('title', 'groupedChapters','sport_name'));
    }





    public function getactiveTest($value='') {
		$title = 'Get Active';
		return view('fill-darts.sports.getactive', compact('title'));
	}

}
