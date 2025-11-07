<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\Weakness;

class ActivityWeaknessController extends Controller
{
   	public function __construct()
    {
        $this->middleware('auth:admin');
    }
	
    public function index(Request $request) 
    {
    	 $title='Activity Wekness';
		 
		 $actwekness  = Weakness::paginate(50);
		 $classes  = Sclass::all();	
         $subjects  = Subject::all();       			 
         $chapters  = Chapter::all();
		 $concepts  = Concept::all();
		 $activity  = Activity::all();        	 
		
    	return view('admin.actweakness.index',compact('title','actwekness','classes','subjects','chapters','concepts','activity'));
    }
    
    public function create()
    {
         $title='Activity Wekness';		 
		 $activity  = Activity::all();   
		 $classes  = Sclass::all();
         $chapters  = Chapter::all();
         $subjects  = Subject::all();
         $concepts  = Concept::all();         	 
		
       return view('admin.actweakness.create', compact('title','classes','chapters','subjects','activity','concepts'));
    }
   
    public function store(Request $request){		
		//dd($request);die();
		$request->validate([
            'activity_id' => 'required', 
            'weakness_type' => 'required', 
            'class_id' => 'required',
            'subject_id' => 'required',
            'chapters' => 'required',
            'concepts' => 'required',	
        ]);
		
					
		$weakness = new Weakness; 
		$weakness->activity_id = $request->activity_id;			
		$weakness->class_id = $request->class_id;			
		$weakness->weakness_type = $request->weakness_type;			
		$weakness->subject_id = $request->subject_id;
		$weakness->chapter_id = $request->chapters;
		$weakness->concept_id = $request->concepts;	
		$weakness->status = $request->status;		
		$weakness->save();	
		
        return redirect()->route('admin.actweakness.index')->with('success','Activity Weakness has been created successfully.');
    }
    
    public function show($id)
    {
        $weakness = Weakness::findOrFail($id);
        return view('admin.actweakness.show', compact('weakness'));
    }
   
    public function edit($id)
    {
		$title='Activity Wekness';		
		$weakness = Weakness::findOrFail($id);
		$activity  = Activity::all();   
		$classes  = Sclass::all();		
		$subjects  = Subject::all();
		$chapters  = Chapter::all();
		$concepts  = Concept::all();		
		 			
        return view('admin.actweakness.edit',compact('title','weakness','classes','subjects','chapters','concepts','activity')); 
    }
   
    public function update(Request $request, $id){
         //dd($request);die();		 
		$request->validate([
            'activity_id' => 'required', 
            'weakness_type' => 'required', 
            'class_id' => 'required',
            'subject_id' => 'required',
            'chapters' => 'required',
            'concepts' => 'required',	
        ]);
		 
		$weakness = Weakness::find($id);		
        $weakness->activity_id = $request->activity_id;			
		$weakness->class_id = $request->class_id;			
		$weakness->weakness_type = $request->weakness_type;			
		$weakness->subject_id = $request->subject_id;
		$weakness->chapter_id = $request->chapters;
		$weakness->concept_id = $request->concepts;	
		$weakness->status = $request->status;		
		$weakness->save();
		
        return redirect('admin/actweakness')->with(['status' => 'success' , 'msg' => 'Successfully Updated']);
    }
    
    public function destroy(Weakness $weakness,$id){ 	  
	   $actweakness = Weakness::where('id', $id)->first()->delete();      
       return redirect()->route('admin.actweakness.index')
        ->with('success','Activity Weakness deleted successfully');	 
    }
}