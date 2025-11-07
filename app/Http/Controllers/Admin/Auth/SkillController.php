<?php

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\Skill;
use App\Models\Sclass;
use App\Models\ClassSkill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$allskills = Skill::all();
		/*$skills = DB::table('class_skillarea')
					->leftjoin('skillareas','skillareas.id','=','class_skillarea.skillarea_id')
					->leftjoin('class','class.id','=','class_skillarea.class_id')
					->select('class.name as classname','skillareas.name as skillname', DB::raw('GROUP_CONCAT(data.name)'))
					//->groupBy('class_skillarea.skillarea_id')
					->get();*/
		/*$skills = DB::select("SELECT data.skillname,data.skillid ,GROUP_CONCAT(data.name) as 
		clas FROM(SELECT cls.name,skillar.name as skillname,skillar.id as skillid, clsskl.skillarea_id FROM `class_skillarea` clsskl LEFT JOIN class cls on cls.id = clsskl.class_id 
		LEFT JOIN skillareas skillar on skillar.id = clsskl.skillarea_id) as data GROUP BY(data.skillarea_id)");*/
	$skills = DB::table('skillareas')
		->select("skillareas.id","skillareas.name"
		   ,DB::raw("(GROUP_CONCAT(class_skillarea.class_id)) as cls"), DB::raw("(GROUP_CONCAT(class_skillarea.skillarea_id)) as skillarea") )
		->leftjoin("class_skillarea","class_skillarea.skillarea_id","=","skillareas.id")
		->groupBy('skillareas.id')
		->get();
		//return $skills;
		$classarr = Sclass::all()->keyBy('id')->toArray();
		return view('admin.skills.index', compact('skills','classarr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
           
        ]);

        
        $skill = new Skill();
         $skill->name = $request->name;
         $skill->save();
        return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		     
 		$clsskill = array();
		$classes = Sclass::orderBy('orders','ASC')->get();
		$clasdata = DB::table('class_skillarea')->select('class_id')->where('skillarea_id', $id)->get();
		if(!empty($clasdata)){
			foreach($clasdata as $cls){
				array_push($clsskill,$cls->class_id);
			}
		}
		$skill = Skill::findOrFail($id);
		
		
        return view('admin.skills.edit',compact('skill','clsskill','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$request->validate([ 'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/u' ],
		['name.required' => 'Subject cannot be empty', 'name.regex' => 'Skills can have alphabets & numbers only' ]); 
		

		
		$skilldata = DB::table('skill')->where('name',$request->name)->count();
		$skills = Skill::find($id);		    
			
		if($skilldata == 0){
			$skills->name = $request->name; 
			
			$skills->save();
		}else{
			
			$skills->save();  
		}

		if(!empty($id)){
                
				DB::table('class_skillarea')->where('skillarea_id', '=', $id)->delete();				
				
				if(!empty($request->class)){					
					foreach($request->class as $val){
                     $data = array( 'class_id' => $val, 'skillarea_id' => $id );
                     DB::table('class_skillarea')->insert($data);
				  }							   
				}		
		}

			
			
		
        
        return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $skill = Skill::findOrFail($id);
		 $skill->delete();
		return back()->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
	public function clsSkill(Request $request)
	{
		$skills = Skill::all();
		$classes = Sclass::all();
		return view('admin/skills/class-skillarea',compact('skills','classes'));
	}
	public function storeclsSkill(Request $request)
	{
		
		
		 $request->validate([
          
			'skill' => 'required',
			'class' => 'required',
           
        ]);
		
		
		for($i=0;$i<count($request->class); $i++)
		{
			$data[]=[
			
			'class_id' => $request->class[$i],
			'skillarea_id' => $request->skill,
			
			
			];
			
		}
		
		ClassSkill::insert($data);
		
		
		return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
	}
}
