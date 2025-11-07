<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Models\Subject;
use App\Models\Activityrelation;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\Sclass;
use App\Models\Tag;
use App\Models\Teachingthrough;
use App\Models\Classactivity;
use App\Models\Subjectactivity;
use App\Models\Chapteractivity;
use App\Models\Conceptactivity;
use App\Models\Skillactivity;
use App\Models\Categoryactivity;
use App\Models\Skill;
use App\Models\Sport;
use App\Models\Sportactivity;
use App\Models\Category;
use App\Models\Class_subject;

//use Illuminate\Pagination\Paginator;

class PostController extends Controller
{
   	public function __construct()
    {
        $this->middleware('auth:admin');
    }	
	
	public function index(Request $request){
    	$title='Activity';		
		//dd($request);die;		
        //DB::enableQueryLog();		
        
		$classes  = Sclass::all();
		$subjects  = DB::table('subject')->leftJoin('concept', 'subject.id', '=', 'concept.subject_id')->get();
        $chapters  = DB::table('chapter')->leftJoin('concept', 'chapter.id', '=', 'concept.chapter_id')->get();      
        $concepts  = Concept::all();     	 
        $teaching  = Teachingthrough::all();		 
		$tags  = Tag::all();		
		
		$posts ='';
		 
		if($request->input('searchdata')=='searchdata'){		

          if(!empty($request->classSelect2)){			
		     
			 $cats=$request->classSelect2;
			 
             $usersStr = implode(',', $cats); //actcls.class_id'

             $actsql = "SELECT act.id,act.title, act.teach_id, act.image, act.description, act.status, rdata.act_id, rdata.cls from ( SELECT bb.act_id, GROUP_CONCAT(bb.name) cls FROM ( SELECT actcls.act_id, cls.name
				FROM activity_class actcls LEFT Join class cls on actcls.class_id = cls.id where actcls.class_id IN ($usersStr) ) bb GROUP BY bb.act_id ) rdata LEFT JOIN activity act on rdata.act_id = act.id ORDER BY act.id asc";	
		 }			 

         $posts = DB::select(DB::raw($actsql));
        
        } else if($request->input('search')=='Search'){ 
		
		  	
			if(!empty($request->activity_name)){
				
				$stitle=trim($request->activity_name);	

                $actsql= "SELECT act.id,act.title, act.teach_id, act.image, act.description, act.status, rdata.act_id, rdata.cls from ( SELECT bb.act_id, GROUP_CONCAT(bb.name) cls FROM ( SELECT actcls.act_id, cls.name FROM activity_class actcls LEFT Join class cls on actcls.class_id = cls.id ) bb GROUP BY bb.act_id ) rdata LEFT JOIN activity act on rdata.act_id = act.id WHERE act.title LIKE '%$stitle%' ORDER BY act.id asc";	
		
			}else{
				
				$actsql = "SELECT act.id, act.title, act.teach_id, act.image, act.description, act.status, rdata.act_id, rdata.cls from ( SELECT bb.act_id, GROUP_CONCAT(bb.name) cls FROM ( SELECT actcls.act_id, cls.name
				FROM activity_class actcls LEFT Join class cls on actcls.class_id = cls.id ) bb GROUP BY bb.act_id ) rdata LEFT JOIN activity act on rdata.act_id = act.id ORDER BY act.id asc";	
			}

           $posts = DB::select(DB::raw($actsql));				

		} else {			
			
			$actsql = "SELECT act.id,act.title, act.teach_id, act.image, act.description, act.status, rdata.act_id, rdata.cls from ( SELECT bb.act_id, GROUP_CONCAT(bb.name) cls FROM ( SELECT actcls.act_id, cls.name
			FROM activity_class actcls LEFT Join class cls on actcls.class_id = cls.id ) bb GROUP BY bb.act_id ) rdata LEFT JOIN activity act on rdata.act_id = act.id ORDER BY act.id asc";	

			$posts = DB::select(DB::raw($actsql));
			 					
		}
		
		
		//dd(DB::getQueryLog());
		
    	return view('admin.posts.index',compact('title','posts','classes','subjects','chapters','concepts','teaching','tags'));
    }   
    
    public function create()
    {
		$title='Activity';		 
		$posts  = Activity::all();
		$classes  = Sclass::all();
		$allsubject = Subject::all();
		
		$subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')
				->get();
		
		
		$chapters  = DB::table('concept')->leftJoin('chapter', 'chapter.id', '=', 'concept.chapter_id')->get();      
		$concepts  = Concept::all();     
		$skills = DB::table('skill')->select(DB::raw('DISTINCT name,id, COUNT(*) AS skid'))
				->groupBy('id')
				->where('name','!=','null')
				->orderBy('skid', 'desc')
				->get();	
				
		$tags = Tag::all();
		$sports = Sport::all();
		$teaching = Teachingthrough::all();		 	 
		
         return view('admin.posts.create', compact('title','classes','chapters','subjects','posts','skills','concepts','sports','tags','teaching','allsubject'));
    }	
   
    public function store(Request $request){		
		//dd($request);die();		
		$request->validate([
            'title' => 'required',             	
        ]);		
		
       // DB::enableQueryLog();		
		
		$activity = new Activity; 
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
        $activity->what_you_need = $request->what_you_need;		
        $activity->what_to_do = $request->what_to_do;		
        $activity->change_it = $request->change_it;		
        $activity->coaching = $request->coaching;		
        $activity->game_rules = $request->game_rules;		
        $activity->equipment = $request->equipment;		
        $activity->playing_area = $request->playing_area;		
        $activity->scoring = $request->scoring;		
        $activity->safety = $request->safety;		
        $activity->ask_the_Players = $request->ask_the_Players;		
        $activity->assignments = $request->assignments;		
        $activity->projects = $request->projects;		
		$activity->status = $request->status;
		
		if(!empty($request->teaching_through)){
			
			$activity->teach_id = implode(',',$request->teaching_through);			   		  
		}	
		
		
		if($activity->save()){

            if(!empty($request->classes)){	  		  
				
				$cdata = array(
					'act_id' => $activity->id,					
					'class_id' => $request->classes	
				);

               echo $cda=DB::table('activity_class')->insert($cdata);				
				
				/* $clscount = DB::table('activity_class')
						->where('class_id', $request->classes)							
						->where('act_id', $activity->id)
						->count();

				if($clscount > 0){						
				  //exist;						
				}else{					
				   DB::table('activity_class')->insert($cdata);
				}			 */   
		    }			
		
			if(!empty($request->concepts)){				  		  
				
				$data = array(
					'act_id' => $activity->id,					
					'con_id' => $request->concepts	
				);
				
				$condata = array(
					'class_id' => $request->classes,					
					'subject_id' => $request->subjects,
					'chapter_id' => $request->chapters                    		
				);

				$count = DB::table('concept')
						->where('class_id', $request->classes)							
						->where('subject_id', $request->subjects)							
						->where('chapter_id', $request->chapters)					
						->count();

				if($count > 0){						
				  //exist;						
				}else{	
				
					DB::table('concept')->insert($condata);					
					DB::table('activity_concept')->insert($data);
				}			   
		    }			
									
			if(!empty($request->input('tags'))){				
			  foreach($request->input('tags') as $value){
				  
					$data = array(
						'activity_id' => $activity->id,
					    'activity_key' => 'tag',
					    'activity_value' => $value	
					);

					$count = DB::table('activity_relation')
							->where('activity_id', $activity->id)
							->where('activity_key', 'LIKE', '%tag%')
							->where('activity_value', $value)
							->count();

					if($count > 0){						
					  //exist;						
					}else{						
						DB::table('activity_relation')->insert($data);
					}			
			    } 
		    }
			
			############################skills############################/
			
			if(!empty($request->input('skills'))){				
			     foreach($request->input('skills') as $value){ 				 
					$data = array(
						'act_id' => $activity->id,
					    'skill_id' =>$value,					    
					);

					$count = DB::table('activity_skill')
							->where('act_id', $activity->id,)							
							->where('skill_id', $value)
							->count();

					if($count > 0){	
					
					 //exist;
					 
					}else{
						
						DB::table('activity_skill')->insert($data);
					}			
			    } 
		    }
			
			//dd(DB::getQueryLog());			
		}		          
     
        return redirect()->route('admin.posts.index')->with('success','Post has been created successfully.');
    }
    
    public function show($id)
    {
        $post = Activity::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }
   
    public function edit($id)
    {
		$title=' Activity';
		$post = Activity::findOrFail($id);
		$classes  = Sclass::all();
		
		$subjects=DB::table('subject as A')
                ->select('A.id','A.name')
                ->rightjoin('concept as B', function($join) {
                    $join->on('A.id', '=', 'B.subject_id');
                })
                ->groupBy('A.id')
                ->groupBy('A.name')
				->get();
				
		$chapters = DB::table('concept')->leftJoin('chapter', 'chapter.id', '=', 'concept.chapter_id')->get();	    
		//$concepts = Concept::all(); 
        $concepts = DB::table('concept')->select(DB::raw('DISTINCT name,id, COUNT(*) AS cid'))
				->groupBy('id')
				->where('name','!=','null')
				->orderBy('cid', 'desc')
				->get();

				
		$tags = Tag::all();
		$sports = Sport::all();
		$teaching = Teachingthrough::all();
		$allsubject = Subject::all();
		
		$sport_activity = Sportactivity::where('act_id', $id)->get();
		
		$sportdata=array();
		
		if(!empty($sport_activity)){								
		  foreach($sport_activity as $spact){
			array_push($sportdata, $spact->sport_id); 									   
		  }
		}		
       
		$skact = DB::table('activity_skill')
				->where('act_id', $id)
				->get();		
				
		$skillact=array();
		
		if(!empty($skact)){								
		  foreach($skact as $sact){
			array_push($skillact,$sact->skill_id); 									   
		  }
		}		
		
		$skills = DB::table('skill')->select(DB::raw('DISTINCT name,id, COUNT(*) AS skid'))
				->groupBy('id')
				->where('name','!=','null')
				->orderBy('skid', 'desc')
				->get();	
				
		$tagarry=array();
		
		$acttags = DB::table('activity_relation')
				->where('activity_id', $id)
				->where('activity_key', 'LIKE', '%tag%')->get();
		
        if(!empty($acttags)){								
		  foreach($acttags as $k=>$v){
			  
			array_push($tagarry,$v->activity_value);	
		  }
		} 			
 			
        return view('admin.posts.edit',compact('title','post','classes','subjects','chapters','concepts','skills','sports','tags','teaching','tagarry','skillact','allsubject','sportdata')); 
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
        $activity->what_you_need = $request->what_you_need;		
        $activity->what_to_do = $request->what_to_do;		
        $activity->change_it = $request->change_it;		
        $activity->coaching = $request->coaching;		
        $activity->game_rules = $request->game_rules;		
        $activity->equipment = $request->equipment;		
        $activity->playing_area = $request->playing_area;		
        $activity->scoring = $request->scoring;		
        $activity->safety = $request->safety;		
        $activity->ask_the_Players = $request->ask_the_Players;		
        $activity->assignments = $request->assignments;		
        $activity->projects = $request->projects;
		
		if(!empty($request->teaching_through)){
			
		  $activity->teach_id = implode(',',$request->teaching_through);			  
		}         	
       
		$activity->status = $request->status;       
        $activity->save();	
		
		if($activity->save()){
			
			if(!empty($request->concepts)){	
				$data = array(
					'act_id'=>$activity->id,					
					'con_id'=>$request->concepts
				);
				
				$condata = array(
					'class_id' => $request->classes,					
					'subject_id' => $request->subjects,
					'chapter_id' => $request->chapters,                    		
					'act_id' => $id,                    		
				);				
						
				//$c_exists = Category::where('name','=',$cat)->exists();

				$catcount = DB::table('concept')
						->where('class_id', '=', $request->classes)							
						->where('subject_id', '=', $request->subjects)							
						->where('chapter_id', '=', $request->chapters)					
						->where('act_id', '=', $id)					
						->count();

				if($catcount > 0){						
				  //exist;						
				}else{	
					DB::table('concept')->insert($condata);					
					DB::table('activity_concept')->insert($data);
				}			   
		    }			
						
			if(!empty($request->input('tags'))){
			  DB::table('activity_relation')
				 ->where('activity_key', 'LIKE', '%tag%')	
				 ->where('activity_id', $id)->delete();
				 
			     foreach($request->input('tags') as $value){ 			  
					$data = array(
						'activity_id' => $id,
					    'activity_key' => 'tag',
					    'activity_value' => $value	
					);

					$count = DB::table('activity_relation')
							->where('activity_id', $id)
							->where('activity_key', 'LIKE', '%tag%')
							->where('activity_value', $value)
							->count();

					if($count > 0){
                      //exist;							
					}else{
						
						DB::table('activity_relation')->insert($data);
					}			
			    } 
		    }			
			
		   ############################skills############################/
			
			if(!empty($request->input('skills'))){				
			     foreach($request->input('skills') as $value){
					 
					$data = array(
						'act_id' => $id,
					    'skill_id' =>$value,					    
					);

					$count = DB::table('activity_skill')
							->where('act_id', $id)							
							->where('skill_id', $value)
							->count();

					if($count > 0){	
					
					 //exist;
					 
					}else{
						
						DB::table('activity_skill')->insert($data);
					}			
			    } 
		    }
			
		    ############################skills############################			
		}			

        return redirect('admin/posts')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }
	
	
	public function saveactivityconcept(Request $request){	    
		//dd($request['acdata']);    		
		$actval=array();
		$class=array();
		$subject=array();
		$chapter=array();
		$concept=array();
		$status=array();
		
		
		
        if(!empty($request['acdata'])){			
			foreach($request['acdata'] as $data){
				//print_r($data);
				$condata = array(
					'act_id' => $request['act_val'],					
					'con_id' => $data['concept_id'],
					'class_id' =>	$data['class_id'],
					'subject_id' =>	$data['subject_id'],
					'chapter_id' =>	$data['chapter_id'] 					
				);
				//$condata
				DB::table('activity_concept')->insert($condata);
			}				
		}
		print_r( $condata );
		exit();
				
       
		exit();
		
		 if(!empty($class)){			
			foreach($class as $k=>$v){				
			 					
			    $clsdata = array(
					'act_id'=>$actval[0],					
					'class_id'=>$v
				);
				
				$condata = array(
					'act_id'=>$actval[0],					
					'con_id'=>$concept[$k]            		
				);				
						
				$catcount = DB::table('activity_concept')											
						->where('act_id', '=', $actval[0])
                        ->where('con_id', '=', $concept[$k])								
						->count();

				if($catcount > 0){						
				  //exist;						
				}else{	
					DB::table('activity_class')->insert($clsdata);					
					DB::table('activity_concept')->insert($condata);
				}		
			}			
		}	
		  			
		return redirect('admin/posts')->with(['status' => 'success' , 'msg' => 'Successfully added']);
	}	
	
	public function sportdelete(Request $request){		
		//dd($request);die(); 
			
		$actid = $request->actid;	   
		$sport_id = $request->sport_id;	   
				          
		if(!empty($actid) && !empty($sport_id)){	
		
		   $despt = DB::table('activity_sports')											
						->where('act_id', '=', $actid)
                        ->where('sport_id', '=', $sport_id)								
						->delete();
		}  
		
        return redirect()->route('admin.posts.index')->with('success','sport deleted successfully.');	   
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
		
        return redirect()->route('admin.posts.index')->with('success','class deleted successfully.');	   
    }
	
	public function skldelete(Request $request){		
		//dd($request);die(); 
		/* //"actid" => "4"
		// "skl_id" => "69"	  */
		
		$actid = $request->actid;	   
		$skl_id = $request->skl_id;	   
				          
		if(!empty($actid) && !empty($skl_id)){	
		
		   $delskl = DB::table('activity_skill')											
						->where('act_id', '=', $actid)
                        ->where('skill_id', '=', $skl_id)								
						->delete();
		}  
		
        return redirect()->route('admin.posts.index')->with('success','skill deleted successfully.');	   
    }
	
	public function conceptsdelete(Request $request){		
		//dd($request);die();  
		$actid = $request->actid;	   
		$conc_id = $request->conc_id;	   
				          
		if(!empty($actid) && !empty($conc_id)){	
		
		   $delconc = DB::table('activity_concept')											
						->where('act_id', '=', $actid)
                        ->where('con_id', '=', $conc_id)								
						->delete();
		}  
		
        return redirect()->route('admin.posts.index')->with('success','Concept deleted successfully.');	   
    }
	
	public function saveskills(Request $request){		
		//dd($request);die();
          
		$sportact = $request->sportact;	   
		$skills = $request->skills;	   
		$sdata = json_decode($skills,true);		
		          
		foreach($sdata as $key=>$value){			
			
			$sptdata = DB::table('activity_skill')->where('act_id',$sportact)->where('skill_id', $value)->count();		

			if($sptdata >0){
			  //exit;			   
			}else{
				$skillactivity = new Skillactivity;	
				$skillactivity->act_id = $sportact;  		
				$skillactivity->skill_id = $value;
				$skillactivity->save();	
			}		   
		}  
		
        return redirect()->route('admin.posts.index')->with('success','skills has been created successfully.');	   
    }
	
	public function savesports(Request $request){		
		//dd($request);die();		
		$sportact = $request->sportact;	   
		$sports = $request->sports;	   
		$sdata = json_decode($sports,true);		
		          
		foreach($sdata as $key=>$value){			
			
			$sptdata = DB::table('activity_sports')->where('act_id',$sportact)->where('sport_id', $value)->count();		

			if($sptdata >0){
			  //exit;			   
			}else{
				$sportactivity = new Sportactivity;	
				$sportactivity->act_id = $sportact;  		
				$sportactivity->sport_id = $value;
				$sportactivity->save();	
			}		   
		}  
		
        return redirect()->route('admin.posts.index')->with('success','sports has been created successfully.');	   
    }
		
	public function getclssubject(Request $request){		
		//dd($request);die();
		$class = $request->class_id;	   
		$subject = $request->subject;	   
		$sdata = json_decode($subject,true);		
		          
		foreach($sdata as $key => $value){			
			
			$clasdata = DB::table('class_subject')->where('subject_id', $value)->where('class_id',$class)->count();		

			if($clasdata >0){
			  //exit;			   
			}else{
				$class_subject = new Class_subject;	
				$class_subject->class_id = $class;  		
				$class_subject->subject_id = $value;
				$class_subject->save();	
			}		   
		}  
		
        return redirect()->route('admin.posts.index')->with('success','Class Subject has been created successfully.');	   
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
			
		   return redirect()->route('admin.posts.index')->with('success','concept has been created successfully.');	
				
		}else{
		  	
		  return redirect()->route('admin.posts.index')->with('success','concept name already exist.');
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
			
		   return redirect()->route('admin.posts.index')->with('success','chapter has been created successfully.');	
				
		}else{
		  	
		  return redirect()->route('admin.posts.index')->with('success','chapter name already exist.');
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
			
		   return redirect()->route('admin.posts.index')->with('success','Subject has been created successfully.');	
				
		}else{
		  	
		  return redirect()->route('admin.posts.index')->with('success','Subject name already exist.');
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
			
		   return redirect()->route('admin.posts.index')->with('success','class has been created successfully.');	
				
		}else{
		  	
		  return redirect()->route('admin.posts.index')->with('success','Class name already exist.');
		} 
    }
    
    public function destroy(Activity $post)
    {
      //dd($post);die();
	  $post->delete();
       return redirect()->route('admin.posts.index')
        ->with('success','activity deleted successfully');
    }
}