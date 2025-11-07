<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Exports\ChapterExport;
use Excel;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
	
	
    public function index(Request $request) 
    {
		    //die('---google drive change the detail of google drive---');
			$classes  = Sclass::orderBy('orders','asc')->get();
			$subjects = Subject::orderBy('name','asc')->get();
			
		if( !empty($request->input('search')) && $request->input('search') == 'Search'){ 
			
			$results = Chapter::select('chapter.*', 'class.name as clsname','subject.name as subname')
							->leftJoin('subject','subject.id','=','chapter.subject_id')
							->leftJoin('class','class.id','=','chapter.class_id')
							->where('chapter.name', 'LIKE', "%{$request->name}%" )
							->orderBy('id','desc');
		}else if( !empty($request->input('search')) && $request->input('search') == 'searchdata'){
				
			$results = Chapter::select('chapter.*', 'class.name as clsname','subject.name as subname')
							->leftJoin('subject','subject.id','=','chapter.subject_id')
							->leftJoin('class','class.id','=','chapter.class_id');
				if(!empty($request->input('aclass'))){
					
					$results = $results->where('chapter.class_id', $request->input('aclass') );
				}
				if(!empty($request->input('subject'))){			
					$results = $results->where('chapter.subject_id', $request->input('subject') );
				}
				$results = $results->orderBy('id','ASC');
		
		}else{		

			$results = Chapter::select('chapter.*', 'class.name as clsname','subject.name as subname')
							->leftJoin('subject','subject.id','=','chapter.subject_id')
							->leftJoin('class','class.id','=','chapter.class_id')
							->orderBy('id','desc');

		}
		
		$count = $results->count(); 
		$results = $results->paginate(50);
		
    	return view('admin.chapters.index',compact('results','classes','subjects','count'));
    }

    
    public function create()
    {
        $title = 'Chapter';
		$classes  = Sclass::orderBy('orders','asc')->get();		 
		$chapters = Chapter::orderBy('name','asc')->get();
		$subjects = Subject::orderBy('name','asc')->get();
        return view('admin.chapters.create', compact('chapters','title','subjects','classes'));
    }
   
    public function store(Request $request){ 

       //dd($request);	
		
		/*$request->validate([ 
			'class_id'=>'required|numeric',
			'subject_id'=>'required|numeric',
			'name.*' => 'required|regex:/^[a-zA-Z0-9 ]+$/u' ,
			'image.*'=>'required|image|mimes:jpg,jpeg,png,gif|max:2048',
			'learning_outcomes.*'=>'required',
			'description.*'=>'required',
			'order.*'=>'required|numeric',
		], [
			'class_id.required' => 'The class is required',
			'subject_id.required' => 'The subject is required',
			'name.required' => 'The chapter cannot be empty',
			'name.regex' => 'Chapter can have alphabets and numbers only',
		]); */
		
	  $name = $request->name;
      $url = $request->url;     
      $learning_outcomes = $request->learning_outcomes;
      $description = $request->description;
      $order = $request->order;
      $status = $request->status; 
      $file = $request->file('image');
	  
	  $pdf = $request->file('file');
	  $link = $request->link; 
	 	 
	  for($count=0;$count< count($name);$count++){		 
		    
			$chapters = new Chapter; 
			   
		    if(!empty($pdf[$count])&&($pdf[$count]!== null)){						
				$extension = $pdf[$count]->getClientOriginalExtension();
				$filename1[$count] = time().'.'.$extension;
				$destinationPath1 = public_path('uploads');
				$pdf[$count]->move($destinationPath1, $filename1[$count]);
				$chapters->file = $filename1[$count];			
			}

			if(!empty($file[$count])&&($file[$count]!== null)){						
				$extension = $file[$count]->getClientOriginalExtension();
				$filename[$count] = time().'.'.$extension;
				$destinationPath = public_path('uploads');
				$file[$count]->move($destinationPath, $filename[$count]);
				$chapters->image = $filename[$count];			
			}
					   
			$chapters->class_id = $request->class_id;       
			$chapters->subject_id = $request->subject_id;
			$chapters->url = $url[$count];
			$chapters->name = $name[$count]; 				
			$chapters->learning_outcomes = $learning_outcomes[$count];
			$chapters->description = $description[$count];
			$chapters->user_id = Auth::user()->id;       		
			$chapters->order = $order[$count];
            $chapters->status = $status[$count];
			$chapters->link = $link[$count];
			$chapters->save();		
        }

		return redirect()->back()->with('success','Chapters has been created successfully.');					
    }
    
    public function show($id){
        $chapters = Chapter::findOrFail($id);
        return view('admin.chapters.show', compact('chapters'));
    }
   
    public function edit($id){
		$classes  = Sclass::orderBy('orders','asc')->get();	
        $subjects = Subject::orderBy('name','asc')->get();
		$chapters = Chapter::findOrFail($id);
        return view('admin.chapters.edit',compact('chapters','subjects','classes')); 
    }
   
    public function update(Request $request, $id){         
		/*$request->validate([ 
			'class_id'=>'required|numeric',
			'subject_id'=>'required|numeric',
			'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/u' ,
			
			'learning_outcomes'=>'required',
			'description'=>'required',
			'order'=>'required|numeric',
		], [
			'class_id.required' => 'The class is required',
			'subject_id.required' => 'The subject is required',
			'name.required' => 'The chapter cannot be empty',
			'name.regex' => 'Chapter can have alphabets and numbers only',
		]);*/ 
		
        $chapters = Chapter::find($id);

			$file = $request->file('image');
			$year = date("Y/m");
			
			if($file!== null){
				$image1 = $request->file('image')->store($year,['disk'=> 'uploads']);
				$filename = url('storage/app/public/uploads/'.$image1);
				$chapters->image = $filename;	
			}	  
		$pdf = $request->file('file');
		
		if($pdf!== null){
				$image2 = $request->file('file')->store($year,['disk'=> 'uploads']);
				$filename1 = url('storage/app/public/uploads/'.$image2);
				$chapters->file = $filename1;	
			}
		
		
		$chapters->class_id = $request->class_id;
		$chapters->subject_id = $request->subject_id;
		$chapters->name = $request->name;
		$chapters->url = $request->url;
		$chapters->description = $request->description;
		$chapters->learning_outcomes = $request->learning_outcomes;
        $chapters->order = $request->order;
		$chapters->status = $request->status;
		$chapters->upd_user_id = Auth::user()->id;
		$chapters->updated_at = date('Y-m-d H:i:s');
		$chapters->link = $request->link;
		$chapters->save();
		
		
        return redirect()->back()->with(['success' =>  'Chapter has been updated successfully.']);
    }
    
    public function destroy(Chapter $chapters,$id)
    {	  	
		$chapters = Chapter::where('id', $id)->first()->delete();
       //$chapters->delete();
       return redirect()->route('admin.chapters.index')
        ->with('success','chapters deleted successfully');
    }
	
	public function chapterExport()
	{
		//dd(request()->all());
		
		//exit();
		if( request()->has('class') || request()->has('subject') )
		{
			//dd(request()->all());
			return Excel::download(new ChapterExport,'chapter.xlsx');
		}
	}
}