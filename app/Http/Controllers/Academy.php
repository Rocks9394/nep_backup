<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Conceptactivity;
use App\Models\ActivityTechnique;
use App\Models\Activity;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\Skill;
use App\Models\Sport;
use App\Models\Comment;
use App\Models\Technique;
use Illuminate\Support\Facades\Auth;

class Academy extends Controller
{
    
	public function __construct()
    {
        //$this->middleware('auth');
		  $this->middleware('auth:admin');
    }
	
	public function chapters(Request $request, $class = null, $subject = null , $book=null)
	{
		

		//$book = '';
		$title=' Chapters';	
		$classes  = Sclass::orderBy('orders','ASC')->get();
		$books = array();
		//$subjects  = Subject::orderBy('name','ASC')->get();
		$subjects = DB::table('subject as A')->select('A.id','A.name')
						->rightjoin('concept as B', function($join) {
							$join->on('A.id', '=', 'B.subject_id');
						})
						->groupBy('A.id')
						->groupBy('A.name')->orderBY('A.name','ASC')
						->get();
				
		$books = Chapter::select('chapter.book' )->where('chapter.class_id', $class)->where('chapter.subject_id', $subject)->groupBy('chapter.book')->get();
		
			
		
			//exit();		
		$chapters = Chapter::select('chapter.id', 'chapter.name', 'chapter.image', 'chapter.url', 'chapter.order' , DB::raw("COUNT(concept.id) as cnt") )->leftJoin('concept' ,'chapter.id' , '=', 'concept.chapter_id'); 
		
		if($class){
			$chapters = $chapters->where('chapter.class_id', $class);
		}
		if($subject){
			$chapters = $chapters->where('chapter.subject_id', $subject);
		}
		if($book){
			$chapters = $chapters->where('chapter.book', $book);
		}
		
		$chapters = $chapters->groupBy('chapter.id')->orderBy('chapter.order','ASC');
		
		$chapters = $chapters->get(); 
		$count = $chapters->count();
		 
		return view('academics.chapters', compact('chapters', 'classes', 'class', 'subject', 'subjects', 'count', 'title','books'));
	}
	
	public function concepts($cid)
	{
        $title='Concepts | Learning Objective';	
		
        $chapter = DB::table('chapter')
					->leftJoin('subject','subject.id','=','chapter.subject_id')
					->leftJoin('class','class.id','=','chapter.class_id')
					->select('chapter.*','subject.id as subid','subject.name as subname', 'class.name as clsname')
					->where('chapter.id', $cid)->get();
					
		//return $chapter; 
		
		$concept = DB::table('concept')->where('chapter_id', $cid);
		$total = $concept->count();	
		$concept = $concept->get();
		
		return view('academics.concepts', compact('title','chapter','concept','total'));
	}
	
	public function addactivity( Request $request, $concept = null)
	{
		
		$title = "Add Activity ";
		
		$classes  = Sclass::orderBy('orders','ASC')->get();
		$subjects = DB::table('subject as A')->select('A.id','A.name')
						->rightjoin('concept as B', function($join) {
							$join->on('A.id', '=', 'B.subject_id');
						})
						->groupBy('A.id')
						->groupBy('A.name')->orderBY('A.name','ASC')
						->get();
						
		$concept =  Concept::select('concept.id', 'concept.name as conceptname',  'concept.class_id', 'concept.subject_id', 'concept.chapter_id', 'class.name as classname', 'subject.name as subjectname', 'chapter.name as chaptername')
							->leftJoin('class', 'class.id', '=', 'concept.class_id')
							->leftJoin('subject', 'subject.id', '=', 'concept.subject_id')
							->leftJoin('chapter', 'chapter.id', '=', 'concept.chapter_id')
							->where( 'concept.id', $concept )
							->get();
							
		return view('academics.addactivity', compact('title', 'concept', 'classes' , 'subjects'));
	}
	
	public function activitystore( Request $request){
		$title = "Add Activity ";
		//dd($request->all());
		
		
			$request->validate([
				'class_id' => 'required',
				'subject_id' => 'required',
				'chapter_id' => 'required',
				'concept_id' => 'required',
				'title' => 'required',
				'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:4096|dimensions:min_width=500,min_height=300,max_width=2000,max_height=2500',
				'learning_outcomes' => 'required',
				'description' => 'required',
				'sclass' => 'required',
				'skillarea' => 'required',
				'skillsports' => 'required',
				'technique' => 'required'
			],
			[	
				'class_id.required' => 'Class is required',
				'subject_id.required' => 'Subject is required',
				'chapter_id.required' => 'Chapter is required',
				'concept_id.required' => 'Concept is required',
				'title.required' => 'Name of activity is required',
				'image.required' => 'Activity Image is required',
				'learning_outcomes.required' => 'Learning Outcomes is required',
				'description.required' => 'Description is required',
				'sclass.required' => 'Class is required',
				'skillarea.required' => 'Skill Area is required',
				'skillsports.required' => 'Skill/Sports is required',
				'technique.required' => 'Technique is required',
			]
			);	
				
		
     
		$activity = new Activity(); 
		
		$file = $request->file('image');
		
		if($file!== null){            
		    $extension = $file->getClientOriginalExtension();
			$filename =time().'.'.$extension;
		    $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);                        
           	$activity->image = $filename;	
			
        }      
	      
       
		$activity->title = $request->title;
		
		if(!empty($request->url)){
			$activity->url = $request->url;
		}
        $activity->description = $request->description;		
        $activity->learning_outcomes = $request->learning_outcomes;	
		
		if(!empty($request->change_it)){		
			$activity->change_it = $request->change_it;	
		}
		if(!empty($request->coaching)){
			$activity->coaching = $request->coaching;
		}
		if(!empty($request->equipment)){
			$activity->equipment = $request->equipment;	
		}
		
		if($request->filterby == 'academy'){
			$activity->teach_id = 1;
		}
		if($request->filterby == 'sports'){
			$activity->teach_id = 2;
		}	
		$activity->status = 1;	
		
		$activity->user_id = Auth::user()->id;
		$act = $activity->save();
		
		if($act){
			
			
				
				$actcon = new Conceptactivity();
				$actcon->act_id = $activity->id;
				$actcon->con_id = $request->concept_id;
				$actcon->class_id = $request->class_id;
				$actcon->chapter_id = $request->chapter_id;
				$actcon->subject_id = $request->subject_id;
				$actcon->save();
				
				//return redirect()->route('addactivity',$request->concept_id)->with(['status' => 'success' , 'msg' => 'Activity sucessfully created']);
			
			
			
				
				$actcon = new ActivityTechnique();
				$actcon->act_id = $activity->id;
				$actcon->technique_id = $request->technique;
				$actcon->class_id = $request->sclass;
				$actcon->skillarea_id = $request->skillarea;
				$actcon->sportskill_id = $request->skillsports;
				$actcon->save();
				
				
				//return redirect()->route('addactivity',$request->concept_id)->with(['status' => 'success' , 'msg' => 'Activity sucessfully created']);
			
						
		}
			return redirect()->route('addactivity',$request->concept_id)->with(['status' => 'success' , 'msg' => 'Activity sucessfully created']);
		
		
	}
	
	
	public function activities(Request $request)
	{		
			//die('---change the detail page----');
			$classes  = Sclass::orderBy('orders','asc')->get();
			$subjects = Subject::orderBy('name','asc')->get();
			$chapters = Chapter::orderBy('name','asc')->get();
			
			
			$title='All Activities';
			$verified_sts= DB::table( 'activity_comments')
						->leftJoin('activity','activity.id','=','activity_comments.activity_id',)
						->select('activity_comments.activity_id','activity.id')
						->get();

			$count_comments = Comment::count();

			if($request->search == 'search')
			{
		
			$data = DB::table('activity')
						->leftJoin('activity_concept','activity_concept.act_id','=','activity.id')
						->leftJoin('users', 'users.id', '=', 'activity.user_id')
						->orderBy('activity.id','DESC')
						->select('activity_concept.act_id', 'activity_concept.con_id','activity_concept.class_id' , 'activity_concept.subject_id',
						 'activity_concept.chapter_id','activity.id', 'activity.image',  'activity.title', 'users.name as usrname');
			
			
				if(!empty($request->input('aclass'))){
					
					$data =$data->where('activity_concept.class_id', $request->input('aclass') );
				}
				if(!empty($request->input('subject'))){			
					$data = $data->where('activity_concept.subject_id', $request->input('subject') );
				}
				if(!empty($request->input('chapter'))){			
					$data = $data->where('activity_concept.chapter_id', $request->input('chapter') );
				}
				$count = $data->count();
				$posts = $data->paginate(80);
			}

			else
			{
		   	$data = Activity::select('activity.id', 'activity.image',  'activity.title', 'users.name as usrname')
			->leftJoin('users', 'users.id', '=', 'activity.user_id')
			->where('activity.status', 1)->orderBy('activity.id', 'DESC');
			$count = $data->count();
			$posts = $data->paginate(100);			
			}
			return view('activity.index',compact('title','posts','count','classes','subjects','chapters','verified_sts','count_comments'));
		
	}
	
	
	
	
	
	
	
	public function myactivities(Request $request){		
			
			$title='My All Activities';		
			$data = Activity::select('activity.id', 'activity.image',  'activity.title', 'users.name as usrname')
			->leftJoin('users', 'users.id', '=', 'activity.user_id')
			->where('activity.user_id', Auth::user()->id)
			->orderBy('activity.id', 'DESC');
			$count = $data->count();
			
			$posts = $data->paginate(16);
			
			
			return view('academics.myactivity',compact('title','posts','count'));
		
	}
	
	public function editActivity(Request $request ,$id)
	{
		//dd($id);
		$data = DB::table('activity')->select('activity.*')->where('activity.id',$id)->first();
		//dd($data);
		$actconcepts = Conceptactivity::
						leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
						->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
						->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
						->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
						->select('activity_concept.act_id', 'activity_concept.con_id','activity_concept.class_id' , 'activity_concept.subject_id',
						 'activity_concept.chapter_id',
						'class.name as clsname', 'subject.name as subjectname', 'chapter.name as chaptername', 'concept.name as conceptname')
						->where('activity_concept.act_id', $id)
						->get();
		//dd($actconcepts);
		$acttechniques = ActivityTechnique::
						leftJoin('class', 'class.id', '=', 'activity_technique.class_id')
						->leftJoin('skillareas', 'skillareas.id', '=', 'activity_technique.skillarea_id')
						->leftJoin('sports', 'sports.id', '=', 'activity_technique.sportskill_id')
						->leftJoin('techniques', 'techniques.id', '=', 'activity_technique.technique_id')
						->select('activity_technique.act_id', 'activity_technique.class_id', 'activity_technique.skillarea_id', 'activity_technique.sportskill_id','activity_technique.technique_id', 'class.name as clsname',
						'skillareas.name as skillareaname', 'sports.name as sportsname', 'techniques.name as techniquename')
						->where('activity_technique.act_id', $id)
						->get();
		//dd($acttechniques);
		$classes  = Sclass::orderBy('orders','ASC')->get();
		$subjects = Subject::all();
		$concepts = Concept::all();
		$chapters = Chapter::all();
		$skills = Skill::all();
		$sports = Sport::all();
		$techniques = Technique::all();
		return view('academics.edit-activity',compact('data','acttechniques','actconcepts','classes','subjects','concepts','chapters'
		,'skills','sports','techniques'));
	}

	public function updateActivity(Request $request ,$id)
	{
		//dd($request);die();		
		
		$request->validate([
            'title' => 'required',           
        ]);
		 
		$activity = Activity::find($id);		
        $file = $request->file('image');
		
		if($file!== null){            
		    $extension = $file->getClientOriginalExtension();
			$filename =time().'.'.$extension;
		    $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);
            $activity->image=$filename;				
        }				
        
		$activity->title = $request->title;
        $activity->url = $request->url;
        $activity->description = $request->description;		
        $activity->learning_outcomes = $request->learning_outcomes;	
		
		if(!empty($request->change_it)){		
			$activity->change_it = $request->change_it;	
		}
		if(!empty($request->coaching)){
			$activity->coaching = $request->coaching;
		}
		if(!empty($request->equipment)){
			$activity->equipment = $request->equipment;	
		}
		if($request->filterby == 'academy'){
			$activity->teach_id = 1;
		}
		if($request->filterby == 'sports'){
			$activity->teach_id = 2;
		}	
		$activity->status = 1;	
		        	
       
		$activity->status = $request->status;       
        	
		$act = $activity->save();
		
		if($act){
			
			if($request->filterby == 'academy'){
				DB::table('activity_concept')->where('act_id', $id)->delete();
				$actcon = new Conceptactivity;
				//dd($id);
				$actcon->act_id = $id;
				$actcon->con_id = $request->concept_id;
				$actcon->class_id = $request->class_id;
				$actcon->chapter_id = $request->chapter_id;
				$actcon->subject_id = $request->subject_id;
				$actcon->save();
				
				return back()->with(['status' => 'success' , 'msg' => 'Activity sucessfully created']);
			}
			
			if($request->filterby == 'sports'){
				DB::table('activity_technique')->where('act_id', $id)->delete();
				$actcon = new ActivityTechnique;
				//dd($actcon);
				$actcon->act_id = $id;
				$actcon->technique_id = $request->technique;
				$actcon->class_id = $request->sclass;
				$actcon->skillarea_id = $request->skillarea;
				$actcon->sportskill_id = $request->skillsports;
				$actcon->save();
				
				
				return back()->with(['status' => 'success' , 'msg' => 'Activity sucessfully created']);
			}
						
		}
		else{
			return back()->with(['status' => 'error' , 'msg' => 'Activity not created']);
		}
					

	}
	
	
	
	public function getClassesSchoolWise(Request $request)
	{
		
		die('----ggf---gfg--');
		$school_id  = $request->school_id;
		//echo $school_id;
		
		 $classes = DB::table('custom_classes')
		->select('id','class_id','section')
		->where('school_id', $school_id)
		->orderBy('orders', 'ASC')
		->get();

		$cls = '<option value="" >--select--</option>';
		if(!empty($cls))
		{
			foreach($classes as $clses)
			{
				$cls .= '<option value="'.$clses->id.'">'.$clses->class_id.'-'.$clses->section.'</option>';
			}
		}
		return $cls;


	}
	
}
