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
use App\Models\Technique;
use App\Models\Sport;
use App\Models\Class_SkillArea_Sports_Tech;


class TechniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {	
        //$techs = Technique::all();
		//return view('admin.techniques.index', compact('techs'));
		
		if($request->input('search') == 'search'){
		$search_text = $request->input('name');
		 $techs = DB::table('techniques')
					->select("techniques.id","techniques.name",DB::raw("(GROUP_CONCAT(class_skillarea_sports_tech.class_id)) as cls"),
					DB::raw("(GROUP_CONCAT(class_skillarea_sports_tech.skillarea_id)) as skillarea"),
					DB::raw("(GROUP_CONCAT(class_skillarea_sports_tech.sports_id)) as sports") )
					->leftjoin("class_skillarea_sports_tech","class_skillarea_sports_tech.tech_id","=","techniques.id")
					->groupBy('techniques.id')
					->where('techniques.name',$search_text)
					->get();
				//return $techs;	
		}
		else{
			 $techs = DB::table('techniques')
					->select("techniques.id","techniques.name",DB::raw("(GROUP_CONCAT(class_skillarea_sports_tech.class_id)) as cls"),
					DB::raw("(GROUP_CONCAT(class_skillarea_sports_tech.skillarea_id)) as skillarea"),
					DB::raw("(GROUP_CONCAT(class_skillarea_sports_tech.sports_id)) as sports") )
					->leftjoin("class_skillarea_sports_tech","class_skillarea_sports_tech.tech_id","=","techniques.id")
					->groupBy('techniques.id')
					->get();
									
		}
		$classarr = Sclass::all()->keyBy('id')->toArray();
		$skillareasarr = Skill::all()->keyBy('id')->toArray();
		$sportsarr = Sport::all()->keyBy('id')->toArray();
		$count = $techs->count();
		
		#echo "<pre>";
		#print_r($skillareasarr);
		#die('---change the detail----');
				
		return view('admin.techniques.index', compact('techs', 'classarr', 'skillareasarr', 'sportsarr','count'));
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.techniques.create');
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
            'name' => 'required|unique:techniques|min:2',
           
        ]);

        
        $tech = new Technique();
        $tech->name = $request->name;
        $tech->save();
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
		$classskill = array();
		$clssklarea = array();
		$clssports = array();
		
		
		$skills = Skill::all();
		$sports = Sport::all();
		$classes = Sclass::orderBy('orders','ASC')->get();
		
		
		$classdata = DB::table('class_skillarea_sports_tech')->select('class_id')->where('tech_id', $id)->get();
		
		$skillareadata = DB::table('class_skillarea_sports_tech')->select('skillarea_id')->where('tech_id', $id)->get();
		$sportsdata = DB::table('class_skillarea_sports_tech')->select('sports_id')->where('tech_id', $id)->get();
		
		if(!empty($classdata)){
			foreach($classdata as $cls)
			{
				array_push($classskill,$cls->class_id);
			}
		}
		//return $classskill;
		if(!empty($skillareadata)){
			foreach($skillareadata as $skl)
			{
				array_push($clssklarea,$skl->skillarea_id);
			}
		}
		
		if(!empty($sportsdata)){
			foreach($sportsdata as $spt)
			{
				array_push($clssports,$spt->sports_id);
			}
		}
		
        $tech = Technique::findOrFail($id);
        return view('admin.techniques.edit',compact('tech','classes','skills','sports','classskill','clssklarea','clssports'));
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
		 $request->validate([
          
			'tech' => 'required',
			
           
        ]);
		
		if(empty($request->class)){
		$techno = DB::table('techniques')->where('name',$request->tech)->count();
		$tech = Technique::find($id);
		
			if($techno == 0)
			{
			$tech->name = $request->tech;
			$tech->save();
			}
			else{
			$tech->save();
			}
		}
		else{
			DB::table('class_skillarea_sports_tech')->where('tech_id', $id)->delete();
			//dd($request->skill);
       for($i=0;$i<count($request->class); $i++)
		{
			for($j=0;$j<count($request->skill); $j++)
			{
				for($k=0;$k<count($request->sport); $k++)
				{
			$data[]=[
			
			'class_id' => $request->class[$i],
			'skillarea_id' => $request->skill[$j],
			'sports_id' => $request->sport[$k],
			'tech_id' => $id,
			
			
			];
				}
			}
			
		}
		
		Class_SkillArea_Sports_Tech::insert($data);
		
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
        $tech = Technique::findOrFail($id);
		$tech->delete();
		return back()->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
	
	public function clsTech(Request $request)
	{
		$techs = Technique::all();
		$skills = Skill::all();
		$sports = Sport::all();
		$classes = Sclass::all();
		
		return view('admin/techniques/class-tech',compact('techs','classes','skills','sports'));
	}
	public function storeclsTech(Request $request)
	{
		
		
		 $request->validate([
          
			'tech' => 'required',
			'class' => 'required',
			'skill' => 'required',
			'sport' => 'required',
           
        ]);
		
		for($i=0;$i<count($request->class); $i++)
		{
			$data[]=[
			
			'class_id' => $request->class[$i],
			'skillarea_id' => $request->skill[$i],
			'sports_id' => $request->sport[$i],
			'tech_id' => $request->tech,
			
			
			];
			
		}
		
		Class_SkillArea_Sports_Tech::insert($data);
		
		
		return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
	}
}
