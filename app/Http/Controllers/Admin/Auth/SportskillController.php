<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\Sclass;
use App\Models\Skill;
use App\Models\Sport;

class SportskillController extends Controller
{
    	
		
    public function index(Request $request){ 
	$sports = Sport::all();
	
	$classes = Sclass::all();
	
	$skills = Skill::all();
	
		
		
		return view('admin.sportskills.index',compact('sports','classes','skills'));	
		
    }
    
    public function create()
    {
		$sports = Sport::select('id','name')->orderBy('name','asc')->get();
	
	$classes = Sclass::select('id','name')->orderBy('name','desc')->get();
	
	$skills = Skill::select('id','name')->orderBy('name','asc')->get();
	
		
		
		
        return view('admin.sportskills.create',compact('sports','classes','skills'));	
    }
   
    public function store(Request $request){		
		
		        
    }
    
    public function show($id)
    {
       
    }
   
    public function edit($id)
    {
        
    }
   
    public function update(Request $request, $id)
    {
		
    }
    
    public function destroy(Sclass $classes,$id)
    {
	 
    }
}