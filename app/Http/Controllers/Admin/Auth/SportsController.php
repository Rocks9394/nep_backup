<?php

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\Sport;
use App\Models\Skill;
use App\Models\Sclass;
use App\Models\Class_SkillArea_Sports;

class SportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
		
	
		
	if($request->input('search') == 'search'){
		$search_text = $request->input('name');
		$sports = DB::table('sports')
		->select("sports.id","sports.name"
		   ,DB::raw("(GROUP_CONCAT(class_skillarea_sports.class_id)) as cls"), DB::raw("(GROUP_CONCAT(class_skillarea_sports.skillarea_id)) as skillarea") )
		->leftjoin("class_skillarea_sports","class_skillarea_sports.sports_id","=","sports.id")
		->groupBy('sports.id')
		->where('sports.name',$search_text)
		->get();
		}
		
		else{
			$sports = DB::table('sports')
		->select("sports.id","sports.name"
		   ,DB::raw("(GROUP_CONCAT(class_skillarea_sports.class_id)) as cls"), DB::raw("(GROUP_CONCAT(class_skillarea_sports.skillarea_id)) as skillarea") )
		->leftjoin("class_skillarea_sports","class_skillarea_sports.sports_id","=","sports.id")
		->groupBy('sports.id')
		->get();
		
		
		
			#echo "<pre>";
			#print_r($sports);
			#die('---change the detail----');
		
		
		}
	   
	   $count = $sports->count();
		
		$classarr = Sclass::all()->keyBy('id')->toArray();
		
		$skillareasarr = Skill::all()->keyBy('id')->toArray();
		
		return view('admin.sports.index', compact('sports', 'classarr', 'skillareasarr','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
		
        return view('admin.sports.create');
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
	'name' => 'required|unique:sports',
           
        ]);

        
        $sport = new Sport();
        $sport->name = $request->name;
        $sport->save();
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
		
		/*$clsskill = array();
		$classes = Sclass::orderBy('orders','ASC')->get();
		$clasdata = DB::table('class_skillarea')->select('class_id')->where('skillarea_id', $id)->get();
		if(!empty($clasdata)){
			foreach($clasdata as $cls){
				array_push($clsskill,$cls->class_id);
			}
		}*/
		
		
		$classskill = array();
		$clssklarea = array();
		
		$skills = Skill::all();
		$classes = Sclass::orderBy('orders','ASC')->get();
		
		$classdata = DB::table('class_skillarea_sports')->select('class_id')->where('sports_id', $id)->get();
		
		$skillareadata = DB::table('class_skillarea_sports')->select('skillarea_id')->where('sports_id', $id)->get();
		//dd($skillareadata);
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
		//print_r($clssklarea);
        $sport = Sport::findOrFail($id);
        return view('admin.sports.edit',compact('sport','classes','skills','classskill','clssklarea'));
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
          
			'sport' => 'required',
			
           
        ]);
		if(empty($request->class)){
		$sportno = DB::table('sports')->where('name',$request->sport)->count();
		$sport = Sport::find($id);
		
			if($sportno == 0)
			{
			$sport->name = $request->sport;
			$sport->save();
			}
			else{
			$sport->save();
			}
		}
		
		else{
		
		DB::table('class_skillarea_sports')->where('sports_id', $id)->delete();
		//dd($request->skill);
		
		for($i=0;$i<count($request->skill); $i++)
		{
			for($j=0;$j<count($request->class); $j++)
			{
			$data[]=[
			'skillarea_id' => $request->skill[$i],
			'class_id' => $request->class[$j],
			'sports_id' => $id,
			];
			}
		}
		//return $data;
		Class_SkillArea_Sports::insert($data);

		
		}
        
        //Sport::whereId($id)->update($data);
        return redirect('admin/sports')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sport = Sport::findOrFail($id);
		$sport->delete();
		return back()->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
	
	public function clsSports(Request $request)
	{
		$skills = Skill::all();
		$sports = Sport::all();
		$classes = Sclass::all();
		return view('admin/sports/class-sports',compact('sports','classes','skills'));
	}
	public function storeclsSports(Request $request)
	{
		
		//$a = $request->all();
		//print_r($a);
		//exit();
		
		$request->validate([
          
			'sport' => 'required',
			'class' => 'required',
			'skill' => 'required',
           
        ]);
		
		
		for($i=0;$i<count($request->class); $i++)
		{
			$data[]=[
			
			'class_id' => $request->class[$i],
			'skillarea_id' => $request->skill[$i],
			'sports_id' => $request->sport,
			];
			
		}
		Class_SkillArea_Sports::insert($data);
		
		
		return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
	}
}
