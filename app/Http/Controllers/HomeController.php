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
use App\Models\Technique;
use App\Models\Comment;
use App\Models\Conceptactivity;
use App\Models\ActivityTechnique;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
	public function __construct()
    {
       // $this->middleware('auth');
    }
	
    public function index(Request $request)
	{
		if(!empty(Auth::User()->role_id))
				{
					$data = Auth::User();
					if($data->role_id == 3 || $data->role_id == 4)
					return redirect()->route('filldart.dashboard');

				}elseif(!empty(Auth::guard('sstudent')->user()))
				{    
					return redirect()->route('student.dashboard');
				}else
				{
					#return redirect()->route('login');
				}
		
		
				
		
			
		
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
		
        $title='All Activities';		
		$classes  = Sclass::orderBY('orders','ASC')->get();			
		$skillareas = Skill::orderBY('name','ASC')->get();
		$sportskills = Sport::orderBY('name','ASC')->get();
		$techniques = Technique::orderBY('name','ASC')->get();		
	
		if($request->input('searchdata') == 'searchdata'){
			
			$data = Activity::leftJoin('activity_technique','activity_technique.act_id', '=', 'activity.id')->select(['activity.*']);
	
			if(!empty($request->sclass)){
			   $data = $data->where('activity_technique.class_id',  $request->sclass );
			}			
			
			if(!empty($request->skillarea)){
				$data = $data->where('activity_technique.skillarea_id', $request->skillarea);		
			}

			if(!empty($request->technique)){
				$data = $data->where('activity_technique.technique_id', $request->technique);
			}
			
			if(!empty($request->skillsports)){
				$data = $data->where('activity_technique.sportskill_id', $request->skillsports);
			}


			$data = $data->where('activity.status', 1)->orderBy('activity.id', 'DESC')->groupBy('activity.id');
			$count = $data->get()->count();	
			$posts = $data->paginate(40);						
         				
		 } else if($request->input('search')=='Search'){ 
		 
			$data = Activity::leftJoin('activity_technique','activity_technique.act_id', '=', 'activity.id')			
				 ->select(['activity.*']);
						 
            if($request->activity_name){				
			   
			   $data = $data->where('activity.title', 'LIKE', "%".$request->activity_name."%");
			}
			
			$count = $data->where('activity.status','=','1')->count();
			$posts = $data->where('activity.status','=','1')->orderBy('activity.id', 'DESC')->groupBy('activity.id')->paginate(40);									
		               				
		}else {   			  
			 
			$data = Activity::leftJoin('activity_technique','activity_technique.act_id', '=', 'activity.id')->select(['activity.*']);
			$count = Activity::count();
			$posts = $data->where('activity.status',1)->orderBy('activity.id', 'DESC')->groupBy('activity.id')->paginate(40);			
		}
		
		return view('sport',compact('title','posts','count','classes','skillareas','sportskills','techniques'));
		
	}		
	
    public function academic(Request $request){	
	    //dd($request);die;	 
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();			
			//return $subjects;
        //DB::enableQueryLog();		
		
		 if($request->input('searchdata') == 'searchdata'){
			//dd($request->all());	
           $data = DB::table('chapter')
				 ->orderBY('chapter.id','asc')
				 ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description','chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status']);

			

			
			if($request->aclass ){
				
				//dd($request->class_id);
			   $data = $data->where('chapter.class_id', $request->aclass );
			}
		    if($request->subject){
				
				//dd($request->subject_id);
			   $data = $data->where('chapter.subject_id',$request->subject);
			}
						
			
			$chapter = $data->where('chapter.status','=','1')->paginate(36);			
			$count = $data->where('chapter.status','=','1')->count();				
         				
		 } else if($request->input('search')=='Search'){ 
		 
			$data = DB::table('chapter') 
				   ->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description','chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status']);

						 
            if($request->chpter_name){				
			   
			   $data = $data->where('chapter.name', 'LIKE', "%".$request->chpter_name."%");
			}
			
			$chapter = $data->where('chapter.status','=','1')->paginate(36);
			
			$count = $data->where('chapter.status','=','1')->count();						
		               				
		} else {   			  
			 
			$data = DB::table('chapter')
				   ->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status']);
				  
			 
			$chapter = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(36);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
						
		}
		
        return view('academic',compact('title','chapter','classes','subjects','count'));		  		
    }    	
	
	public function activity_details($acid){	
		
		$title='Show Activity Details';	
		$teaching  = Teachingthrough::all();
		
        $actdata = DB::table('activity')->where('id', '=', $acid)->get();				

		return view('activitydetail', compact('title','actdata','teaching'));
	}
	
	public function concepts($cid){
        //dd($cid);die;			
		$title='Chapters';		
        $chapter = DB::table('chapter')
					->leftJoin('subject','subject.id','=','chapter.subject_id')
					->select('chapter.*','subject.id as subid','subject.name as subname')
					->where('chapter.id', $cid)->get();
		$total = DB::table('concept')->where('chapter_id', $cid)->count();	
		$concept = DB::table('concept')->where('chapter_id', $cid)->get();
		//dd($chapter);
		return view('concepts', compact('title','chapter','concept','total'));
	}	
	
	public function chpactconcepts($cid,$chpid){
			
	    $title='Chapters Activity';		
        //$chapter = DB::table('chapter')->where('id', $chpid)->get();
		$chapter = DB::table('chapter')
					->leftJoin('subject','subject.id','=','chapter.subject_id')
					->leftJoin('class','class.id','=','chapter.class_id')
					->select('chapter.*','subject.id as subid','subject.name as subname','class.name as clsname')
					->where('chapter.id', $chpid)->get();
		$activity = DB::table('activity')->where('id', $cid)->get();
        $concept = DB::table('concept')->where('chapter_id', $chpid)->get();
		$actconcepts = Conceptactivity::
						leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
						->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
						->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
						->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
						->select('activity_concept.act_id', 'activity_concept.con_id', 'class.name as clsname', 'subject.name as subjectname', 'chapter.name as chaptername', 'concept.name as conceptname')
						->where('act_id', $cid)
						->get();
		//dd($actconcepts);
		$acttechniques = ActivityTechnique::
						leftJoin('class', 'class.id', '=', 'activity_technique.class_id')
						->leftJoin('skillareas', 'skillareas.id', '=', 'activity_technique.skillarea_id')
						->leftJoin('sports', 'sports.id', '=', 'activity_technique.sportskill_id')
						->leftJoin('techniques', 'techniques.id', '=', 'activity_technique.technique_id')
						->select('activity_technique.act_id', 'activity_technique.class_id', 'activity_technique.skillarea_id', 'activity_technique.sportskill_id','activity_technique.technique_id', 'class.name as clsname',
						'skillareas.name as skillareaname', 'sports.name as sportsname', 'techniques.name as techniquename'
						)
						->where('act_id', $cid)
						->get();
						//dd($acttechniques);
		$comments = Comment::
						leftJoin('users','users.id', '=', 'activity_comments.commented_by')
						->select('activity_comments.rating','activity_comments.comment',
						'activity_comments.activity_id','activity_comments.commented_by','users.name')
						->where('activity_comments.activity_id',$cid)
						->get();
		return view('chpactconcepts', compact('title','concept','activity','chapter','actconcepts','acttechniques','comments'));
	}
	
	public function actconcepts($cid)
	{
		//die('---');
		//$this->middleware('auth');
        //dd($cid);die;			
		$title='Activity Details';		
        //$chapter = DB::table('chapter')->where('id', $cid)->get();
		$total = DB::table('activity')->where('id', $cid)->count();	
		$activity = DB::table('activity')->where('id', $cid)->get();
		//dd($activity);
		$actconcepts = Conceptactivity::
						leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
						//->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
						//->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
						//->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
						//->select('activity_concept.act_id', 'activity_concept.con_id', 'class.name as clsname', 'subject.name as subjectname', 'chapter.name as chaptername', 'concept.name as conceptname')
						->select('activity_concept.act_id', 'activity_concept.con_id', 'class.name as clsname')
						->where('act_id', $cid)
						->get();
		//dd($actconcepts);
		$acttechniques = ActivityTechnique::
						leftJoin('class', 'class.id', '=', 'activity_technique.class_id')
						->leftJoin('skillareas', 'skillareas.id', '=', 'activity_technique.skillarea_id')
						->leftJoin('sports', 'sports.id', '=', 'activity_technique.sportskill_id')
						->leftJoin('techniques', 'techniques.id', '=', 'activity_technique.technique_id')
						->select('activity_technique.act_id', 'activity_technique.class_id', 'activity_technique.skillarea_id', 'activity_technique.sportskill_id','activity_technique.technique_id', 'class.name as clsname',
						'skillareas.name as skillareaname', 'sports.name as sportsname', 'techniques.name as techniquename'
						)
						->where('act_id', $cid)
						->get();
						//dd($acttechniques);
		$comments = Comment::
						leftJoin('users','users.id', '=', 'activity_comments.commented_by')
						->select('activity_comments.rating','activity_comments.comment',
						'activity_comments.activity_id','activity_comments.commented_by','users.name','activity_comments.activity_sports',
						'activity_comments.activity_subject','activity_comments.qualityofactivity','activity_comments.creativity','activity_comments.id')
						->where('activity_comments.activity_id',$cid)
						->get();
		return view('actconcepts', compact('title','activity','total','actconcepts','acttechniques','comments'));
	}
	
	public function chapter(Request $request){	
	    //dd($request);die;	 
		$title='Academic';	
		$classes  = Sclass::all();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')
				->get();
				
			
        //DB::enableQueryLog();class_id
			
		 if($request->input('searchdata') == 'searchdata'){
				
           $data = DB::table('chapter') 					
				 ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description','chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status']);

						 
			if($request->class_id){
				
			   $data = $data->where('chapter.class_id', '=', $request->class_id );
			}
			
			if($request->subject_id){
				
			   $data = $data->where('chapter.subject_id', 'LIKE', "%".$request->subject_id."%");
			}			
			
			$chapter = $data->where('chapter.status','=','1')->paginate(50);	
			
			$count = $data->where('chapter.status','=','1')->count();				
				
         				
		 } else if($request->input('search')=='Search'){ 
		 
			$data = DB::table('chapter') 					
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description','chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status']);

						 
            if($request->chpter_name){				
			   
			   $data = $data->where('chapter.name', 'LIKE', "%".$request->chpter_name."%");
			}
			
			$chapter = $data->where('chapter.status','=','1')->paginate(50);
			
			$count = $data->where('chapter.status','=','1')->count();						
		               				
		} else {   			  
			 
			$data = DB::table('chapter') 					
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description','chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status']);
			 
			$chapter = $data->where('chapter.status','=','1')->paginate(50);			
			
			$count = $data->where('chapter.status','=','1')->count();				
		}		
       
	    return view('chapter',compact('title','chapter','classes','subjects','count'));		
    }	
	
    public function arrayPaginator($array, $request){
		$page = $request->get('page', 1);
		$perPage = 40;
		$offset = ($page * $perPage) - $perPage;

		return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
			['path' => $request->url(), 'query' => $request->query()]);
	}
		
	public function academyHome(Request $request)
	{
		//$classes = Sclass::skip(5)->take(3)->get();
		//dd($classes);
		
		/*$subjectid = DB::table('subject')
						->select("chapter.subject_id","subject.name",
						DB::raw("(GROUP_CONCAT(chapter.subject_id)) as subject"),DB::raw("(GROUP_CONCAT(chapter.class_id)) as cls"))
						->leftjoin("chapter","chapter.subject_id","=","subject.id")
						->groupBy("subject.id")
						->get();
				dd($subjectid);*/
		
		//$count = $subjectids->count();
		//dd($classes);
		return view('academyhome');
	}
	public function class6Hindi(Request $request){
		$chapter = '';
		$title='Academic';	
		 $classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter')
				   ->orderBY('chapter.id','asc')		
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',6)
				   ->where('chapter.subject_id',12);
				  
			 
			$cl6hindi = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6hindi','classes','subjects','count','chapter'));
	}
	public function class6Eng(Request $request){
		$chapter = '';
		$cl6hindi = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter')
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',6)
				   ->where('chapter.subject_id',13);
				  
			 
			$cl6eng = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi'));
	}
	public function class6Math(Request $request){
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',6)
				   ->where('chapter.subject_id',44);
				  
			 
			$cl6math = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math'));
	}
	public function class6Science(Request $request){
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',6)
				   ->where('chapter.subject_id',17);
				  
			 
			$cl6sc = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc'));
	}
	public function class6Social(Request $request){
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',6)
				    ->whereIn('chapter.subject_id',[24,25,26]);
					
				  
			 
			$cl6sst = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst'));
	}
	public function class6San(Request $request){
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 					
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',6)
				   ->where('chapter.subject_id',17);
				  
			 
			$cl6san = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san'));
	}
	public function class7Hindi(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',7)
				   ->where('chapter.subject_id',12);
				  
			 
			$cl7hindi = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(50);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san','cl7hindi'));
	}
	public function class7Eng(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',7)
				   ->where('chapter.subject_id',13);
				  
			 
			$cl7eng = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng'));
	}
	public function class7Math(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter')
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',7)
				   ->where('chapter.subject_id',44);
				  
			 
			$cl7math = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math'));
	}
	public function class7Science(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$cl7math = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter')
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',7)
				   ->where('chapter.subject_id',17);
				  
			 
			$cl7sc = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math','cl7sc'));
	}
	public function class7Social(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$cl7math = '';
		$cl7sc = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',7)
				   ->whereIn('chapter.subject_id',[24,25,26]);
				  
			 
			$cl7sst = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math','cl7sc','cl7sst'));
	}
	public function class7San(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$cl7math = '';
		$cl7sc = '';
		$cl7sst = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 					
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',7)
				   ->where('chapter.subject_id',17);
				  
			 
			$cl7san = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math','cl7sc','cl7san'));
	}
	
	
	public function class8Hindi(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$cl7math = '';
		$cl7sc = '';
		$cl7sst = '';
		$cl7san = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',8)
				   ->where('chapter.subject_id',12);
				  
			 
			$cl8hindi = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math','cl7sc','cl7san','cl8hindi'));
	}
	public function class8Eng(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$cl7math = '';
		$cl7sc = '';
		$cl7sst = '';
		$cl7san = '';
		
		
		$cl8hindi = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter')
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',8)
				   ->where('chapter.subject_id',13);
				  
			 
			$cl8eng = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math','cl7sc','cl7san','cl8hindi','cl8eng'));
	}
	public function class8Math(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$cl7math = '';
		$cl7sc = '';
		$cl7sst = '';
		$cl7san = '';
		
		
		$cl8hindi = '';
		$cl8eng = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter')
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',8)
				   ->where('chapter.subject_id',44);
				  
			 
			$cl8math = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math','cl7sc','cl7san','cl8hindi','cl8eng','cl8math'));
	}
	public function class8Science(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$cl7math = '';
		$cl7sc = '';
		$cl7sst = '';
		$cl7san = '';
		
		
		$cl8hindi = '';
		$cl8eng = '';
		$cl8math = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter') 
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->orderBY('chapter.id','ASC')
				   ->where('chapter.class_id',8)
				   ->where('chapter.subject_id',17);
				  
			 
			$cl8sc = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math','cl7sc','cl7san','cl8hindi','cl8eng','cl8math','cl8sc'));
	}
	public function class8Social(Request $request)
	{
		$chapter = '';
		$cl6hindi = '';
		$cl6eng = '';
		$cl6math = '';
		$cl6sc = '';
		$cl6sst = '';
		$cl6san = '';
		
		$cl7hindi = '';
		$cl7eng = '';
		$cl7math = '';
		$cl7sc = '';
		$cl7sst = '';
		$cl7san = '';
		
		
		$cl8hindi = '';
		$cl8eng = '';
		$cl8math = '';
		$cl8sc = '';
		$title='Academic';	
		$classes  = Sclass::orderBY('orders','ASC')->get();	        
        $subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')->orderBY('A.name','ASC')
				->get();
		$data = DB::table('chapter')
					->orderBY('chapter.id','asc')
			       ->select(['chapter.id','chapter.class_id','chapter.subject_id','chapter.name','chapter.description',
				   'chapter.image','chapter.url','chapter.learning_outcomes','chapter.unit','chapter.book','chapter.order','chapter.status'])
				   ->where('chapter.class_id',8)
				  ->whereIn('chapter.subject_id',[24,25,26]);
				  
			 
			$cl8sst = $data->where('chapter.status','=','1')->orderBY('chapter.class_id','ASC')->paginate(30);
			//dd($chapter);
						
			$count = $data->where('chapter.status','=','1')->count();
		return view('academic',compact('title','cl6eng','classes','subjects','count','chapter','cl6hindi','cl6math','cl6sc','cl6sst','cl6san',
		'cl7hindi','cl7eng','cl7math','cl7sc','cl7san','cl8hindi','cl8eng','cl8math','cl8sc','cl8sst'));
	}
	
}