<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\Conceptdetail;

class BulkconceptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }	
	
    public function index(Request $request) 
    {
    	$title ='Bulk Concept'; 
		
		$classes  = Sclass::all();
		$subjects = Subject::all();		
		$count = Concept::count();
		
		//DB::enableQueryLog();

		
     	if($request->input('search')=='search')
    	{
    		$search_txt = $request->chapter_name;
    		
			$concepts  = Concept::select('id','subject_id','name','status','image')			
				->where('post_category','LIKE','%'.$search_txt.'%')
				->orderBy('concept.class_id','asc')
				->orderBy('concept.subject_id','asc')
				->orderBy('concept.chapter_id','asc')				
                ->paginate(10);
    	
		} else { 	
		
          $concepts = DB::table('concept')        
			->leftJoin('chapter', 'chapter.id', '=', 'concept.chapter_id')			
			->leftJoin('subject', 'subject.id', '=', 'concept.subject_id')			
			->select(['concept.id','concept.class_id','subject.name as sbj','chapter.name as chp','concept.name as con','concept.image as img','concept.status']);
			
		  $concepts=$concepts->orderBy('concept.class_id', 'asc')
            ->orderBy('concept.subject_id', 'asc')
            ->orderBy('concept.chapter_id', 'asc')->paginate(10);   	
					
    	}
		
		//dd(DB::getQueryLog()); 
		
    	return view('admin.bulkconcepts.index',compact('concepts','count','title','classes'));
    }
    
    public function create()
    {
        $title ='Bulk Concept'; 
		$classes  = Sclass::all();
		$subjects = Subject::all();
		$chapters = Chapter::all();
		
        return view('admin.bulkconcepts.create', compact('chapters','title','classes','subjects'));
    }
   
    public function store(Request $request)
    {
         //dd($request);die;	
		        
		$request->validate([
            'class_id' => 'required',
            'subjects' => 'required',
            'title' => 'required',
			'chapter' => 'required',      
            'learning_outcomes' => 'required',
        ]);        
		
		$file = $request->file('image');		
		$destinationPath = public_path('uploads');		
       
							
		$chkdata = DB::table('concept')
						->where('class_id', $request->class_id)							
						->where('subject_id', $request->subjects)							
						->where('chapter_id', $request->chapter)					
						->where('name', $request->title)					
						->count();
							
				
		if($chkdata == 0){	
          
            foreach($request->title as $key => $value){			  
			  //echo "<pre>";print_r($key);			  
			   $concept = new Concept;				
				
               if(!empty($file[$key])&&($file[$key]!== null)){						
					$extension = $file[$key]->getClientOriginalExtension();
					$filename[$key] = time().'.'.$extension;
					$destinationPath = public_path('uploads');
					$file[$key]->move($destinationPath, $filename[$key]);
					$concept->image = $filename[$key];			
				}			
			   
				$concept->class_id = $request->class_id;       
				$concept->subject_id = $request->subjects;       
				$concept->chapter_id = $request->chapter; 
				$concept->url = $request->url;
                $concept->name = $value; 				
				$concept->learning_outcomes = $request->learning_outcomes[$key];
			    $concept->description = $request->description[$key];
			    $concept->status = $request->status;			
				$concept->save();
            }
        }		
     
        return redirect()->route('admin.bulkconcepts.index')->with('success','Concept has been created successfully.');
    }

    
    public function show($id)
    {
        $concept = Concept::findOrFail($id);
        return view('admin.bulkconcepts.show', compact('concept'));
    }

   
    public function edit($id)
    {
        $title ='Bulk Concept'; 
		$classes  = Sclass::all();		
		$subjects = Subject::all();
		$chapters = Chapter::all();		
		$concept = Concept::findOrFail($id);
		
		//dd($concept);die;
		
        return view('admin.bulkconcepts.edit',compact('concept','title','classes','subjects','chapters')); 
    }
   
    public function update(Request $request, $id){ 
	
	   //dd($request);die;
	   
		$title ='Bulk Concept'; 
        $imageName = '';
       	$request->validate([
            'class_id' => 'required',
            'subjects' => 'required',
            'title' => 'required',
            'chapter' => 'required',    
                       
        ]);
		
		//DB::enableQueryLog();		
		//$concept = Concept::find($id);
		
		$file = $request->file('image');		
		
		$destinationPath = public_path('uploads');
		
		if(!empty($request->title)){ 		    
            foreach($request->title as $key => $value){			  
			   $concept = Concept::find($id);              
			   
				if(!empty($file[$key])&&($file[$key]!== null)){					 
					$extension = $file[$key]->getClientOriginalExtension();
					$filename[$key] = time().'.'.$extension;
					$destinationPath = public_path('uploads');
					$file[$key]->move($destinationPath, $filename[$key]);
					$image = $filename[$key];
					
				} else {
					$image = $request->hidden_image; 
				}				
				
				/* $updatedata = DB::table('concept')
							->where('class_id', $request->class_id)
							->where('subject_id', $request->subjects)
							->where('chapter_id', $request->chapter)							
							->where('id', $id)							
							->update(array(
									  'url'=>$request->url,									  
									  'learning_outcomes'=>$request->learning_outcomes[$key],
									  'name'=>$value,
									  'image'=>$image,
									  'description'=>$request->description[$key],
									  'status'=>$request->status,
							 ));*/
			   
				$concept->class_id = $request->class_id;       
				$concept->subject_id = $request->subjects;       
				$concept->chapter_id = $request->chapter; 
				$concept->url = $request->url;
                $concept->name = $value; 				
                $concept->image = $image; 				
				$concept->learning_outcomes = $request->learning_outcomes[$key];
			    $concept->description = $request->description[$key];
			    $concept->status = $request->status;			
				$concept->save();
            }
        }

       //dd(DB::getQueryLog()); 		
      
        return redirect('admin/bulkconcepts')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function destroy(Concept $concept)
    {
       $concept->delete();
       return redirect()->route('admin.bulkconcepts.index')
        ->with('success','Concept deleted successfully');
    }
}
