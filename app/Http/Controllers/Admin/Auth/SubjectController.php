<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Class_subject;

class SubjectController extends Controller {
	
	public function __construct()
    {
        $this->middleware('auth:admin');
	}   

	public function index(Request $request) 
    {
    	$classes  = Sclass::all();
		//$clsubject  = DB::table('class_subject')->leftJoin('class','class.id','=','class_subject.class_id')->get();
		
		if( !empty($request->input('search')) && $request->input('search') == 'Search'){ 		
			
			$request->validate([ 'name' => 'required' ], [ 'aclass.required' => 'Subject cannot be empty' ]);
			$results = DB::table('subject')
						->leftJoin('class_subject','subject.id','=','class_subject.subject_id')
						->leftJoin('class','class.id','=','class_subject.class_id')
						->select('subject.id','subject.name', 'subject.status', DB::raw('group_concat(class.name SEPARATOR ", ") as clsnames'))
						->where('subject.name', 'LIKE', "%{$request->name}%" )
						->orderBy('subject.name','asc')->groupBy('subject.id');
		
		}else if( !empty($request->input('search')) && $request->input('search') == 'searchdata'){ 

				$request->validate([ 'aclass' => 'required' ], ['aclass.required' => 'Please select class' ]);
				$results = DB::table('subject')
						->leftJoin('class_subject','subject.id','=','class_subject.subject_id')
						->leftJoin('class','class.id','=','class_subject.class_id')
						->select('subject.id','subject.name', 'subject.status', DB::raw('group_concat(class.name SEPARATOR ", ") as clsnames'))
						->where('class_subject.class_id', $request->input('aclass'))
						->orderBy('subject.name','asc')->groupBy('subject.id');
			
			
		}else{ 

			$results = DB::table('subject')
						->leftJoin('class_subject','subject.id','=','class_subject.subject_id')
						->leftJoin('class','class.id','=','class_subject.class_id')
						->select('subject.id','subject.name', 'subject.status', DB::raw('group_concat(class.name SEPARATOR ", ") as clsnames'))
						->orderBy('subject.name','asc')->groupBy('subject.id');
							
        }
			
			$cntresults = $results->get();
			$count = $cntresults->count(); // Did bcoz count result was not correct
			$results= $results->paginate(50);		
	
			return view('admin.subjects.index',compact('results','count','classes'));
    }
    
    public function create()
    {
        return view('admin.subjects.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([ 'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/u|unique:subject' ], ['name.required' => 'Subject cannot be empty', 'name.regex' => 'Subject can have alphabets and numbers only', 'name.unique' => 'Subject with this name already exist' ]); 
		
		$subject = new Subject;       
        $subject->name = $request->name; 		
        $subject->status = $request->status;
        $subject->save();
		
        return redirect()->back()->with('success','Subjects has been created successfully.');
    }
    
    public function show($id)
    {
        $title = 'Subject';	
        $subject = Subject::findOrFail($id);
        return view('admin.subjects.show', compact('subject','title'));
    }
   
    public function edit($id){
        $clssubj = array();
        $classes  = Sclass::orderBy('orders','asc')->get();
        $clasdata = DB::table('class_subject')->select('class_id')->where('subject_id', $id)->get();
        
		if(!empty($clasdata)){
		  foreach($clasdata as $cls){
			array_push($clssubj,$cls->class_id);
          }		
		}        
 		
		$subject = Subject::findOrFail($id);
        return view('admin.subjects.edit',compact('subject','classes','clssubj')); 
    }
   
    public function update(Request $request, $id)
    {     
		$request->validate([ 'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/u' ], ['name.required' => 'Subject cannot be empty', 'name.regex' => 'Subject can have alphabets & numbers only' ]); 
		
		$clasdata = DB::table('subject')->where('name',$request->name)->count();
		$subject = Subject::find($id);		    
			
		if($clasdata == 0){
			$subject->name = $request->name; 
			$subject->status = $request->status;
			$subject->save();
		}else{
			$subject->status = $request->status;
			$subject->save();  
		}

		if(!empty($id)){
                
				DB::table('class_subject')->where('subject_id', '=', $id)->delete();				
				
				if(!empty($request->class_id)){					
					foreach($request->class_id as $val){
                     $data = array( 'class_id' => $val, 'subject_id' => $id );
                     DB::table('class_subject')->insert($data);
				  }							   
				}
				
		}

		return redirect()->back()->with('success','Subject has been updated successfully.');		
		
	
    }
    
    public function destroy(Subject $subjects,$id)
    {
       $subjects = Subject::where('id', $id)->first()->delete();	   
       return redirect()->route('admin.subjects.index')->with('success','Subject deleted successfully');
    }
}
