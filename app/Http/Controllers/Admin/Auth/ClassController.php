<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\Sclass;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }	
		
    public function index(Request $request){ 		
			 
		if( !empty($request->input('search')) && $request->input('search') == 'Search'){
			$request->validate([ 'name' => 'required' ], [ 'aclass.required' => 'class cannot be empty' ]);
			$results = Sclass::select('*')->where('name', 'LIKE', "%{$request->name}%")->orderBy('orders','asc');
		}else{
			$results  = Sclass::orderBy('orders','asc');
		}
		$count = $results->count(); 
		$results= $results->paginate(50);
    	return view('admin.classes.index',compact('results','count'));
    }
    
    public function create()
    {
        return view('admin.classes.create');
    }
   
    public function store(Request $request){		
		
		$request->validate([ 'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/u|unique:class' ], ['name.required' => 'Class cannot be empty', 'name.regex' => 'Class can have alphabets & number only', 'name.unique' => 'Class with this name already exist' ]); 
		
		$class = new Sclass;       
        $class->name = $request->name; 		
        $class->status = $request->status;
        $class->save();
		
        return redirect()->back()->with('success','Class has been created successfully.');

		
    }
    
    public function show($id)
    {
        $title='Class';	
        $class = Sclass::findOrFail($id);
        return view('admin.classes.show', compact('class','title'));
    }
   
    public function edit($id)
    {
        $class = Sclass::findOrFail($id);
        return view('admin.classes.edit',compact('class')); 
    }
   
    public function update(Request $request, $id)
    {
		$request->validate([ 'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/u' ], ['name.required' => 'Class cannot be empty', 'name.regex' => 'Class can have alphabets & numbers only' ]); 
		
		$name = Sclass::where('name', $request->input('name'))->first();
		$class = Sclass::find($id);
			
		if($name === null){
			$class->name = $request->name;       
			$class->status = $request->status;       
			$class->save();      
		}else{
			$class->status = $request->status;       
			$class->save(); 
		}			
		
			return redirect()->back()->with('success','Class has been updated successfully.');
    }
    
    public function destroy(Sclass $classes,$id)
    {
	   $classes = Sclass::where('id', $id)->first()->delete();
       return redirect()->route('admin.classes.index')->with('success','Class deleted successfully');
    }
}