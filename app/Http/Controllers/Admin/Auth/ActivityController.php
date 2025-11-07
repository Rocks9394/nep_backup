<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\Teachingthrough;
use App\Models\Skill;
use App\Models\Sport;
use App\Models\Technique;
use App\Models\Conceptactivity;
use App\Models\ActivityTechnique;


//use Illuminate\Pagination\Paginator;

class ActivityController extends Controller
{
   	public function __construct()
    { 
		//die('----hello india----');
        $this->middleware('auth:admin');
		
    }	

    public function activity_copy($cid){		
	  
	    $activity = Activity::find($cid);
		
		$lastId = ''; 
		
		if(!empty($activity)){			
			//echo "<pre>";print_r($activity);			
			 $acdata = array(
				'teach_id' => $activity->teach_id,					
				'title'=> 'Copy '.$activity->title,	
				'url' => $activity->url,	
				'image' => $activity->image,	
				'description'=> $activity->description,					
				'learning_outcomes'=> $activity->learning_outcomes,					
				'equipment'=> $activity->equipment,					
				'status'=> $activity->status,					
				'author'=> Auth::user()->id,					
			   );
			   
			 $insid = DB::table('activity')->insertGetId(
					    array(
							'teach_id' => $activity->teach_id,					
							'title'=> 'Copy '.$activity->title,	
							'url' => $activity->url,	
							'image' => $activity->image,	
							'description'=> $activity->description,					
							'learning_outcomes'=> $activity->learning_outcomes,					
							'equipment'=> $activity->equipment,					
							'status'=> $activity->status,					
							'author'=> Auth::user()->id,					
				        )
				   ); 
			 
			 $lastId = $insid;           
		}		
		
		if($lastId){				
			return redirect()->route('admin.activities.edit',$lastId)->with(['status' => 'success' , 'msg' => 'Activity sucessfully created']);
 	    }
	}	
	
	public function activitytechnique(Request $request){	    
		
        if(!empty($request->acdata)){
			
			foreach($request->acdata as $data){
			
				$condata = array(
					'act_id' => $request->act_val,					
					'technique_id' => $data['technique_id'],
					'class_id' =>	$data['class_id'],
					'skillarea_id' =>	$data['skillarea_id'],
					'sportskill_id' =>	$data['skillsports_id'] 					
				);
				
				
				
				$resac = DB::table('activity_technique')->where('act_id', $request->act_val)
				->where('technique_id', $data['technique_id'])
				->where('class_id', $data['class_id'])
				->where('skillarea_id', $data['skillarea_id'])
				->where('sportskill_id', $data['skillsports_id'])
				->first();
				if(empty($resac)){
					DB::table('activity_technique')->insert($condata);
				}
				
				
			}				
		}
		
		exit(); 			
		
	}
	public function index(Request $request){
		//die('------');
		$classes  = Sclass::orderBy('orders', 'ASC')->get();
		$teaching  = Teachingthrough::all();
		$subjects  = DB::table('subject')->orderBy('name', 'ASC')->get();
		$skillareas = Skill::orderBy('name', 'ASC')->get();
		$sportskills = Sport::orderBy('name', 'ASC')->get();
		$techniques = Technique::orderBy('name', 'ASC')->get();
		
		if(!empty($request->filterby)){
			
			if(!empty($request->actname)){
				$posts = Activity::where('title', 'LIKE',"%{$request->actname}%");
				$count = $posts->count();
				$posts = $posts->paginate(100);
				
			}else{
				
				if($request->filterby == 'academy'){
					$posts = Activity::leftJoin('activity_concept', 'activity_concept.act_id', '=', 'activity.id')->select('activity.*');
						
					if(!empty($request->concept)){
						$posts = $posts->where('activity_concept.con_id', $request->concept);
					}else if(!empty($request->chapter)){
						$posts = $posts->where('activity_concept.chapter_id', $request->chapter);
					}else if(!empty($request->subject) && !empty($request->aclass)){
						$posts = $posts->where('activity_concept.class_id', $request->aclass)
						->where('activity_concept.subject_id', $request->subject);
					}else if(!empty($request->subject)){
						$posts = $posts->where('activity_concept.subject_id', $request->subject);
					}else if(!empty($request->aclass)){
						$posts = $posts->where('activity_concept.class_id', $request->aclass);
					}
					
					$count = $posts->count();
					$posts= $posts->groupBy('activity.id')->paginate(100);
					
				}else if($request->filterby == 'sports'){
					
					$posts = Activity::leftJoin('activity_technique', 'activity_technique.act_id', '=', 'activity.id')->select('activity.*');
						
					if(!empty($request->technique)){
						$posts = $posts->where('activity_technique.technique_id', $request->technique);
					}else if(!empty($request->skillsports)){
						$posts = $posts->where('activity_technique.sportskill_id', $request->skillsports);
					}else if(!empty($request->skillarea) && !empty($request->sclass)){
						$posts = $posts->where('activity_technique.class_id', $request->sclass)
						->where('activity_technique.skillarea_id', $request->skillarea);
					}else if(!empty($request->skillarea)){
						$posts = $posts->where('activity_technique.skillarea_id', $request->skillarea);
					}else if(!empty($request->sclass)){
						$posts = $posts->where('activity_technique.class_id', $request->sclass);
					}
					
					$count = $posts->count();
					$posts= $posts->groupBy('activity.id')->paginate(100);
				}
			
			}
			
			return view('admin.activities.index',compact('posts','classes','teaching','subjects', 'skillareas' , 'sportskills' , 'techniques', 'count'));
				
			
		}else{
			
			$count = Activity::count();
			$posts = Activity::orderBy('activity.id','DESC')->paginate(100);
			
			return view('admin.activities.index',compact('posts','classes','teaching','subjects', 'skillareas' , 'sportskills' , 'techniques', 'count'));
		}		
		
    }   
    
    
	public function create()
    {
		$teaching = Teachingthrough::all();		 	 
		return view('admin.activities.create', compact('teaching'));
    }	
   
    public function store(Request $request){		
		
		$request->validate([
            'title' => 'required',
			//'learning_outcomes' => 'required',
			//'description' => 'required',
			//'image' => 'required'		
        ]);		
		
       
		$activity = new Activity(); 
		
		$file = $request->file('image');
		
		if($file!== null){            
		    $extension = $file->getClientOriginalExtension();
			$filename =time().'.'.$extension;
		    $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);                        
           	$activity->image =$filename;	
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
		
		if(!empty($request->teaching_through)){
			$activity->teach_id = implode(',',$request->teaching_through);			  
		}
		
		$activity->status = $request->status;	
		$activity->user_id = Auth::user()->id;
		
		if($activity->save()){
			//print_r($activity->id);
		
			return redirect()->route('admin.activities.edit',$activity->id)->with(['status' => 'success' , 'msg' => 'Activity sucessfully created']);
						
		}
    }
	
    
    public function show($id)
    {
        $post = Activity::findOrFail($id);
        return view('admin.activities.show', compact('post'));
    }
   
    public function edit($id)
    {
		//die('---chng the detail---');
		$post = Activity::findOrFail($id);
		$teaching = Teachingthrough::all();
		$actconcepts = Conceptactivity::
						leftJoin('class', 'class.id', '=', 'activity_concept.class_id')
						->leftJoin('subject', 'subject.id', '=', 'activity_concept.subject_id')
						->leftJoin('chapter', 'chapter.id', '=', 'activity_concept.chapter_id')
						->leftJoin('concept', 'concept.id', '=', 'activity_concept.con_id')
						->select('activity_concept.act_id', 'activity_concept.con_id', 'class.name as clsname', 'subject.name as subjectname', 'chapter.name as chaptername', 'concept.name as conceptname')
						->where('act_id', $id)
						->get();
		
		$acttechniques = ActivityTechnique::
						leftJoin('class', 'class.id', '=', 'activity_technique.class_id')
						->leftJoin('skillareas', 'skillareas.id', '=', 'activity_technique.skillarea_id')
						->leftJoin('sports', 'sports.id', '=', 'activity_technique.sportskill_id')
						->leftJoin('techniques', 'techniques.id', '=', 'activity_technique.technique_id')
						->select('activity_technique.act_id', 'activity_technique.class_id', 'activity_technique.skillarea_id', 'activity_technique.sportskill_id','activity_technique.technique_id', 'class.name as clsname',
						'skillareas.name as skillareaname', 'sports.name as sportsname', 'techniques.name as techniquename'
						)
						->where('act_id', $id)
						->get();
		
		
		$classes  = Sclass::orderBy('orders', 'ASC')->get();
		$skillareas = Skill::orderBy('name', 'ASC')->get();
		$sportskills = Sport::orderBy('name', 'ASC')->get();
		
		$techniques = Technique::all();		
		
        return view('admin.activities.edit',compact('post','classes','teaching','actconcepts', 'skillareas' , 'sportskills' , 'techniques', 'acttechniques')); 
    }
   
    public function update(Request $request, $id){		
        
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
		
		/*if(!empty($request->change_it)){		
			$activity->change_it = $request->change_it;	
		}*/
		
		$activity->change_it = $request->change_it;
		
		if(!empty($request->coaching)){
			$activity->coaching = $request->coaching;
		}
		if(!empty($request->equipment)){
			$activity->equipment = $request->equipment;	
		}
		
		if(!empty($request->teaching_through)){
			$activity->teach_id = implode(',',$request->teaching_through);			  
		}         	
       
		$activity->status = $request->status;       
        	
		
		if($activity->save()){
			return redirect()->back()->with(['status' => 'success' , 'msg' => 'Activity updated sucessfully']);
		}			

        
    }
	
	public function destroy($activityid)
    {
		$activity = Activity::find($activityid);
        $activity->delete();
		return redirect()->back()->with('success','Activity successfully deleted ');
		
    }
	
	
	public function saveactivityconcept(Request $request){	    
		
		
        if(!empty($request['acdata'])){			
			foreach($request['acdata'] as $data){
				$condata = array(
					'act_id' => $request['act_val'],					
					'con_id' => $data['concept_id'],
					'class_id' =>	$data['class_id'],
					'subject_id' =>	$data['subject_id'],
					'chapter_id' =>	$data['chapter_id'] 					
				);
				
				DB::table('activity_concept')->insert($condata);
			}				
		}
		
		return true;
		exit();
		
		 
	}	
	
	public function conceptsdelete(Request $request){		
		 
		$actid = $request->actid;	   
		$conc_id = $request->conc_id;	   
				          
		if(!empty($actid) && !empty($conc_id)){	
		
		   $delconc = DB::table('activity_concept')											
						->where('act_id', $actid)
                        ->where('con_id', $conc_id)								
						->delete();
						return true;
						exit();
		}  
	}
	
	
	public function techniquedelete(Request $request){		
		 
		   
				          
		if(!empty($request->actid) && !empty($request->technique_id)){	
		
		   $delconc = DB::table('activity_technique')											
						->where('act_id', $request->actid)
                        ->where('technique_id', $request->technique_id)
						->where('skillarea_id', $request->skillarea_id)
						->where('class_id', $request->class_id)
						->where('sportskill_id', $request->sportskill_id)
						->delete();
						
						return true;
						exit();
		}  
		
	}
	
	
	
	/*
	public function sportdelete(Request $request){		
		 
			
		$actid = $request->actid;	   
		$sport_id = $request->sport_id;	   
				          
		if(!empty($actid) && !empty($sport_id)){	
		
		   $despt = DB::table('activity_sports')											
						->where('act_id', '=', $actid)
                        ->where('sport_id', '=', $sport_id)								
						->delete();
		}  
		
        return redirect()->route('admin.activities.index')->with('success','sport deleted successfully.');	   
    }	
	
	public function class_delete(Request $request){		
		//dd($request);die();
      			
		$actid = $request->actid;	   
		$cls_id = $request->cls_id;	   
				          
		if(!empty($actid) && !empty($cls_id)){	
		
		   $despt = DB::table('activity_class')											
						->where('act_id', '=', $actid)
                        ->where('class_id', '=', $cls_id)								
						->delete();
		}  
		
        return redirect()->route('admin.activities.index')->with('success','class deleted successfully.');	   
    }
	
	public function skldelete(Request $request){		
		
		
		$actid = $request->actid;	   
		$skl_id = $request->skl_id;	   
				          
		if(!empty($actid) && !empty($skl_id)){	
		
		   $delskl = DB::table('activity_skill')											
						->where('act_id', '=', $actid)
                        ->where('skill_id', '=', $skl_id)								
						->delete();
		}  
		
        return redirect()->route('admin.activities.index')->with('success','skill deleted successfully.');	   
    }
	
	
	
	
	
	
	public function saveconcept(Request $request){		
	    //dd($request);die();		
        $request->validate([
          'clname' => 'required',            
          'subject' => 'required',            
          'chapter' => 'required',            
          'concept' => 'required',            
        ]);		
				
		$name = Concept::where('name', '=', $request->input('concept'))->first();
		
		if($name === null){
			$concept = new Concept;       
			$concept->class_id = $request->clname;      
			$concept->subject_id = $request->subject;      
			$concept->chapter_id = $request->chapter;      
			$concept->name = $request->concept;      
			$concept->status = !empty($request->sts) ? $request->sts : '1';
			$concept->save();
			
		   return redirect()->route('admin.activities.index')->with('success','concept has been created successfully.');	
				
		}else{
		  	
		  return redirect()->route('admin.activities.index')->with('success','concept name already exist.');
		} 
	}
	
	public function savechapter(Request $request){
	   //dd($request);die();	   
        $request->validate([
          'clname' => 'required',            
          'sbname' => 'required',            
          'chpname' => 'required',            
        ]);
		
		$name = Chapter::where('name', '=', $request->input('chpname'))->first();
		if($name === null){
			$chapter = new Chapter;       
			$chapter->class_id = $request->clname;      
			$chapter->subject_id = $request->sbname;      
			$chapter->name = $request->chpname;      
			$chapter->status = !empty($request->sts) ? $request->sts : '1';
			$chapter->save();
			
		   return redirect()->route('admin.activities.index')->with('success','chapter has been created successfully.');	
				
		}else{
		  	
		  return redirect()->route('admin.activities.index')->with('success','chapter name already exist.');
		} 
	}	
	
	public function savesubject(Request $request){        
		//dd($request);die();	
        $request->validate([
          'name' => 'required',            
        ]);
		
		$name = Subject::where('name', '=', $request->input('name'))->first();
		
		if($name === null){
			$subject = new Subject;       
			$subject->name = $request->name;      
			$subject->status = !empty($request->sts) ? $request->sts : '1';
			$subject->save();
			
		   return redirect()->route('admin.activities.index')->with('success','Subject has been created successfully.');	
				
		}else{
		  	
		  return redirect()->route('admin.activities.index')->with('success','Subject name already exist.');
		} 
    }
	
	public function saveclass(Request $request){
         //dd($request);die();		
        $request->validate([
          'name' => 'required',            
        ]);
		
		$name = Sclass::where('name', '=', $request->input('name'))->first();
		if($name === null){
			$class = new Sclass;       
			$class->name = $request->name;      
			$class->status = !empty($request->sts) ? $request->sts : '1';
			$class->save();
			
		   return redirect()->route('admin.activities.index')->with('success','class has been created successfully.');	
				
		}else{
		  	
		  return redirect()->route('admin.activities.index')->with('success','Class name already exist.');
		} 
    }
    
	*/
    
}