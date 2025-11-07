<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Concept;
use App\Exports\ConceptExport;
use Excel;

class ConceptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }	
	
    public function index(Request $request){    			
		
		$classes  = Sclass::orderBy('orders','asc')->get();
		$subjects = Subject::orderBy('name','asc')->get();
		$chapters = Chapter::orderBy('name','asc')->get();
			
		if( !empty($request->input('search')) && $request->input('search') == 'Search'){ 
			
			$results = Concept::select('concept.*', 'class.name as clsname','subject.name as subname', 'chapter.name as chapname')
							->leftJoin('subject','subject.id','=','concept.subject_id')
							->leftJoin('class','class.id','=','concept.class_id')
							->leftJoin('chapter','chapter.id','=','concept.chapter_id')
							->where('concept.name', 'LIKE', "%{$request->name}%" )
							->orderBy('id','desc');
		}else if( !empty($request->input('search')) && $request->input('search') == 'searchdata'){
				
			$results = Concept::select('concept.*', 'class.name as clsname','subject.name as subname', 'chapter.name as chapname')
							->leftJoin('subject','subject.id','=','concept.subject_id')
							->leftJoin('class','class.id','=','concept.class_id')
							->leftJoin('chapter','chapter.id','=','concept.chapter_id');
				if(!empty($request->input('aclass'))){
					
					$results = $results->where('concept.class_id', $request->input('aclass') );
				}
				if(!empty($request->input('subject'))){			
					$results = $results->where('concept.subject_id', $request->input('subject') );
				}
				if(!empty($request->input('chapter'))){			
					$results = $results->where('concept.chapter_id', $request->input('chapter') );
				}
				
				$results = $results->orderBy('id','desc');
		
		}else{		
			
			$results = Concept::select('concept.*', 'class.name as clsname','subject.name as subname', 'chapter.name as chapname')
							->leftJoin('subject','subject.id','=','concept.subject_id')
							->leftJoin('class','class.id','=','concept.class_id')
							->leftJoin('chapter','chapter.id','=','concept.chapter_id')
							->orderBy('id','desc');

		}
		
		$count = $results->count(); 
		$results = $results->paginate(50);
		
    	return view('admin.concepts.index',compact('results','classes','subjects','chapters','count'));
		
    	
    }
    
    public function create()
    {
        
		$classes  = Sclass::orderBy('orders','asc')->get();		
		$subjects = Subject::orderBy('name','asc')->get();
		$chapters = Chapter::orderBy('name','asc')->get();		
		
		
        return view('admin.concepts.create', compact('chapters','classes','subjects'));
    }
   
    public function store(Request $request){		
		//dd($request);		   
		$request->validate([ 
			'class_id'=>'required|numeric',
			'subject_id'=>'required|numeric',
			'chapter_id'=>'required|numeric',
			'name' => 'required|unique:chapter' ,
			'image.*'=>'required|image|mimes:jpg,jpeg,png,gif|max:2048',
			'learning_outcomes.*'=>'required',
			'description.*'=>'required',
			'order.*'=>'required|numeric',
		], [
			'class_id.required' => 'The class is required',
			'subject_id.required' => 'The subject is required',
			'chapter_id.required' => 'The chapter is required',
			'name.required' => 'The concept cannot be empty',
			
		]);	
	
      $name = $request->name;
      $url = $request->url;     
      $learning_outcomes = $request->learning_outcomes;
      $description = $request->description;
      $order = $request->order;
      $status = $request->status; 
      $file = $request->file('image');		
	 	 
	  for($count=0;$count< count($name);$count++){
		 
		    $concept = new Concept;
			   
		    if(!empty($file[$count])&&($file[$count]!== null)){						
				$extension = $file[$count]->getClientOriginalExtension();
				$filename[$count] = time().'.'.$extension;
				$destinationPath = public_path('uploads');
				$file[$count]->move($destinationPath, $filename[$count]);
				$concept->image = $filename[$count];			
			}				
					   
			$concept->class_id = $request->class_id;       
			$concept->subject_id = $request->subject_id;       
			$concept->chapter_id = $request->chapter_id; 
			$concept->url = $url[$count];
			$concept->name = $name[$count]; 				
			$concept->learning_outcomes = $learning_outcomes[$count];
			$concept->description = $description[$count];
			$concept->user_id = Auth::user()->id;       		
			$concept->order = $order[$count];
            $concept->status = $status[$count];				
			$concept->save();		
       }		
		
	   return redirect()->back()->with('success','Concept has been created successfully.');
    }

    
    public function show($id)
    {
        $concept = Concept::findOrFail($id);
        return view('admin.concepts.show', compact('concept'));
    }
   
    public function edit($id)
    {
        $classes  = Sclass::orderBy('orders','asc')->get();		
		$subjects = Subject::orderBy('name','asc')->get();
		$chapters = Chapter::orderBy('name','asc')->get();		
		$concepts = Concept::findOrFail($id);
		
        return view('admin.concepts.edit',compact('concepts','classes','subjects','chapters')); 
    }
   
    public function update(Request $request, $id){ 	
	  	  
	    $request->validate([ 
			'class_id' =>'required|numeric',
			'subject_id' =>'required|numeric',
			'chapter_id' =>'required|numeric',
			'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/u' ,
			'learning_outcomes'=>'required',
			'description'=>'required',
			'order'=>'required|numeric',
		], [
			'class_id.required' => 'The class is required',
			'subject_id.required' => 'The subject is required',
			'chapter_id.required' => 'The chapter is required',
			'name.required' => 'The concept cannot be empty',
			'name.regex' => 'Concept can have alphabets and numbers only',
		]); 
		
        $concepts = Concept::find($id);

			$file = $request->file('image');
			$year = date("Y/m");
			
			if($file!== null){
				$image1 = $request->file('image')->store($year,['disk'=> 'uploads']);
				$filename = url('storage/app/public/uploads/'.$image1);
				$concepts->image = $filename;	
			}	  
		
		$concepts->class_id = $request->class_id;
		$concepts->subject_id = $request->subject_id;
		$concepts->chapter_id = $request->chapter_id;
		$concepts->name = $request->name;
		$concepts->url = $request->url;
		$concepts->description = $request->description;
		$concepts->learning_outcomes = $request->learning_outcomes;
        $concepts->order = $request->order;
		$concepts->status = $request->status;
		$concepts->upd_user_id = Auth::user()->id;
		$concepts->save();
		
		
        return redirect()->back()->with(['success' =>  'Concept has been updated successfully.']);
    }

    
    public function destroy(Concept $concept)
    {
       $concept->delete();
       return redirect()->route('admin.concepts.index')
        ->with('success','Concept deleted successfully');
    }
	
	public function conceptExport()
	{
		//dd(request()->all());
		
		//exit();
		if( request()->has('class') || request()->has('subject') || request()->has('chapter'))
		{
			//dd(request()->all());
			return Excel::download(new ConceptExport,'concept.xlsx');
		}
	}
}

