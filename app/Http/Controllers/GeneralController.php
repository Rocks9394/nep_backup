<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\Teachingthrough;
use App\Models\Skill;
use App\Models\Sport;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Region;
use App\Models\School;
use App\Models\Class_SkillArea_Sports;
use App\Models\Technique;
use App\Models\Conceptactivity;
use App\Models\ActivityTechnique;
use App\Models\Comment;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class GeneralController extends Controller
{
    
	public function __construct()
    {
		
        $this->middleware('auth')->except(['index','userStatus', 'TestVideos']);
    }
	
	public function AdminManual(){

        $filePath = storage_path('app/public/staticpages/Traning_manual.pdf');

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
			// 'Content-Disposition' => 'inline; filename="Traning_manual.pdf"',
			// use inline to open in browser and use attachment to download
        ]);
    }

	public function TestVideos(){
		$title = __FUNCTION__;

		$videoData = DB::table('fitness_test_videos')
			->join('skill_reports', 'skill_reports.TestTypeMasterID', '=', 'fitness_test_videos.testType_id')
			->select(
				'skill_reports.id as skill_id',
				'skill_reports.skill_name',
				'skill_reports.icons',
				'fitness_test_videos.testType_id',
				'fitness_test_videos.type_video',
				'fitness_test_videos.video_url'
			)
			->get();

		foreach ($videoData as $video) {
			if ($video->skill_id == 18) {
				$video->skill_name = "Body Mass Index (BMI)";
			}
		}

		$groupedVideos = $videoData->groupBy('skill_id');

		$juniorVideos = collect();
		$seniorVideos = collect();
		

		foreach ($groupedVideos as $skillId => $videos) {
			$icons = $videos->pluck('icons')->unique()->toArray();
			if ($skillId <= 18) {
				$juniorVideos->push([
					'skill_id' => $skillId,
					'videos' => $videos,
					'icons'	=> $icons
				]);
			}
			if($skillId >= 18 ){
				$seniorVideos->push([
					'skill_id' => $skillId,
					'videos' => $videos,
					'icons' => $icons 
				]);
			}
		}
		// dd($juniorVideos);

		return view('homepages.test-videos', compact('title', 'juniorVideos', 'seniorVideos', 'videoData'));
	}

	public function index(Request $request)
	{
		
			
			if(!empty($request->cookie('user_type')) && $request->cookie('user_type')!='')
			{
				 $user_type = $request->cookie('user_type');
				 if($user_type == "Parent")
				 {
					return redirect()->route('student.dashboard');  
				 }
				 if($user_type == "Trainer")
				 {
					return redirect()->route('filldart.dashboard');
				 }
				 if($user_type == "School")
				 {
					return redirect()->route('schoolDashboard');
				 }
				

			}
			
			if(!empty($request->cookie('redirectionRole')) && $request->cookie('redirectionRole')!='')
			{
				 $redirectionRole = $request->cookie('redirectionRole');
				  return redirect()->route($redirectionRole);  
			}


		   //die('---change the detail----');
			/*
				$sports= Class_SkillArea_Sports::
				leftJoin('sports','sports.id','=','class_skillarea_sports.sports_id')
				->leftJoin('class','class.id','=','class_skillarea_sports.class_id')
				->select(['sports.name','class_skillarea_sports.sports_id as sportsid','class_skillarea_sports.class_id as classid','class.name as classname'])
				->whereIn('class_skillarea_sports.class_id',[6,7,8])
				->get();
				dd($sports);
				*/
				
		return view('index');
	}
	
	public function userStatus(Request $request)
	{
		//dd($request->all());
		$regions = Region::all();
		$subjects = Subject::all();
		$schools = School::all();
		$permission = [1,4,5,6,8];
		//$role = DB::table('users')->select('users.role_id')->where('users.role_id',Auth::user()->id)->first();
		$role = Auth::guard('admin')->user()->role_id;
		//dd($role);
	 if(in_array("$role",$permission) ){
			
		if($request->search == 'search')
		{
			//dd($request->all());
			
			$status = DB::table('usermetas')
						 ->rightJoin('users','users.id','=','usermetas.user_id')
						 ->leftJoin('activity','activity.user_id','=','usermetas.user_id')
						 ->leftJoin('regions','regions.id','=','usermetas.region_id')
						 ->leftJoin('subject','subject.id','=','usermetas.subject')
						 ->leftJoin('schools','schools.id','=','usermetas.school_id')
						 ->orderBy('regions.id','DESC')
						 ->select(['users.id as userid','users.email','users.phone','users.name','schools.school_name',
						 'usermetas.subject as subjectname','activity.title','activity.id as actid','usermetas.school_id','usermetas.region_id','usermetas.subject',
						 'regions.name as regionname','regions.id as regionid'
						 ]);
		   $academics	=DB::table('activity_concept')
						->leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
						->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
						->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
						->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
						->leftJoin('activity_comments','activity_comments.activity_id','=','activity_concept.act_id')
						->select('activity_concept.act_id', 'activity_concept.con_id','activity_concept.class_id' , 'activity_concept.subject_id',
						 'activity_concept.chapter_id',
						'class.name as clsname', 'subject.name as subjectname',
						'chapter.name as chaptername', 'concept.name as conceptname','activity_comments.comment','activity_comments.activity_id')
						->get();
						//dd($academics);	
			if($request->region)
			{
				$status = $status->where('regions.id',$request->region);
			}
			if($request->subject)
			{
				$status = $status->where('usermetas.subject',$request->subject);
			}
			$status = $status->paginate(300);
		}
		else{
			
			
			$status = DB::table('usermetas')
						 ->rightJoin('users','users.id','=','usermetas.user_id')
						 ->leftJoin('activity','activity.user_id','=','usermetas.user_id')
						 ->leftJoin('regions','regions.id','=','usermetas.region_id')
						 ->leftJoin('subject','subject.id','=','usermetas.subject')
						 ->leftJoin('schools','schools.id','=','usermetas.school_id')
						 ->orderBy('regions.id','DESC')
						 ->select(['users.id as userid','users.email','users.phone','users.name','schools.school_name',
						 'usermetas.subject as subjectname','activity.title','activity.id as actid','usermetas.school_id','usermetas.region_id','usermetas.subject',
						 'regions.name as regionname'
						 ]);
					$status= $status->paginate(3000);
						 //dd($status);
			$academics	=DB::table('activity_concept')
						->leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
						->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
						->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
						->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
						->leftJoin('activity_comments','activity_comments.activity_id','=','activity_concept.act_id')
						->select('activity_concept.act_id', 'activity_concept.con_id','activity_concept.class_id' , 'activity_concept.subject_id',
						 'activity_concept.chapter_id',
						'class.name as clsname', 'subject.name as subjectname',
						'chapter.name as chaptername', 'concept.name as conceptname','activity_comments.comment','activity_comments.activity_id')
						->get();
						//dd($academics);			 
						 
		
		}
	 
		return view('status',compact('regions','subjects','status','academics'));
	 }
	 else{
		 echo '<script type="text/javascript">alert("hello!");</script>';
		 return redirect('activities')->with('<script type="text/javascript">alert("hello!");</script>');
		 
	    }
	 
	}
	
	public function activityDetails(Request $request){
		
		$classes  = Sclass::orderBy('orders','asc')->get();
		$subjects = Subject::orderBy('name','asc')->get();
		$chapters = Chapter::orderBy('name','asc')->get();
		
		
		
		$permission = [1,4,5,6,8];
		//$role = DB::table('users')->select('users.role_id')->where('users.role_id',Auth::user()->id)->first();
		$role = Auth::user()->role_id;
		//dd($role);
	 if(in_array("$role",$permission) ){
			
			if($request->search == 'search')
			{
		
			$activities = DB::table('activity_concept')
						->leftJoin('activity','activity.id', '=', 'activity_concept.act_id')
						->leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
						->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
						->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
						->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
						->orderBy('activity.id','DESC')
						->select('activity_concept.act_id', 'activity_concept.con_id','activity_concept.class_id' , 'activity_concept.subject_id',
						 'activity_concept.chapter_id',
						'class.name as clsname', 'subject.name as subjectname','activity.id','activity.title','activity.user_id',
						'chapter.name as chaptername', 'concept.name as conceptname');
						
				$users =  Activity::select('users.name','users.email','users.id as uid','users.phone')
									->leftJoin('users', 'users.id', '=', 'activity.user_id')
									->where('activity.status', 1)->orderBy('activity.id', 'DESC')->get();
			
				if(!empty($request->input('aclass'))){
					
					$activities =$activities->where('activity_concept.class_id', $request->input('aclass') );
				}
				if(!empty($request->input('subject'))){			
					$activities = $activities->where('activity_concept.subject_id', $request->input('subject') );
				}
				if(!empty($request->input('chapter'))){			
					$activities = $activities->where('activity_concept.chapter_id', $request->input('chapter') );
				}
				
				$activities = $activities->paginate(300);
			}
			else{
			$activities = DB::table('activity_concept')
						->leftJoin('activity','activity.id', '=', 'activity_concept.act_id')
						->leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
						->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
						->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
						->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
						->orderBy('activity.id','DESC')
						->select('activity_concept.act_id', 'activity_concept.con_id','activity_concept.class_id' , 'activity_concept.subject_id',
						 'activity_concept.chapter_id',
						'class.name as clsname', 'subject.name as subjectname','activity.id as actid','activity.title','activity.user_id',
						'chapter.name as chaptername', 'concept.name as conceptname')
						->paginate(30);
						
			$users =  Activity::select('users.name','users.email','users.id as uid','users.phone')
								->leftJoin('users', 'users.id', '=', 'activity.user_id')
								->where('activity.status', 1)->orderBy('activity.id', 'DESC')->get();			
			
			}
			return view('activitysummary',compact('classes','subjects','chapters','activities','users'));
	 }
		else{
		 echo '<script type="text/javascript">alert("hello!");</script>';
		 return redirect('activities');
		 
	    }
	 
	}
	
	public function storeComment(Request $request)
	{
		
		$act_comment = new Comment();
		$act_comment->activity_id = $request->activity_id;
		//$act_comment->rating = $request->rating;
		$act_comment->comment = $request->comments;
		$act_comment->commented_by = Auth::user()->id;
		$act_comment->name = Auth::user()->name;
		$act_comment->activity_sports = $request->star1;
		$act_comment->activity_subject = $request->star2;
		$act_comment->qualityofactivity = $request->star3;
		$act_comment->creativity = $request->star4;
		$act_comment->save();
		
		
		return response()->json($act_comment);
	}
	
	public function deleteComment($id)
	{
		$act_comment = Comment::find($id);
		$act_comment->delete();
		return response()->json(['success' => 'Record deleteed ']);
	}
	public function editComment($id)
	{
		$act_comment = Comment::find($id);
		return response()->json($act_comment);
	}
	public function updateComment(Request $request,$id)
	{
		$act_comment = Comment::find($id);
		$act_comment->comment = $request->comments;
		$act_comment->save();
		return response()->json($act_comment);
		
	}

}