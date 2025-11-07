<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Activityrelation;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\Sclass;
use DB;
use App\Models\Class_SkillArea_Sports;
use App\Models\Class_SkillArea_Sports_Tech;
use App\Models\Class_SkillArea;
use App\Models\Skill;


class Academy extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['getSkillarea','getSports','getTechnique','gets_subject', 'get_chapters','get_concepts']);
    }
    
    public function index()
    {   
        return view('admin.home');
    }

    public function gets_subject(Request $request){
		
		$subjects = DB::table('class_subject as A')
                ->select('A.subject_id', 'B.name')
				->leftjoin('subject as B', function($join) {
                    $join->on('B.id', '=', 'A.subject_id');
                })
                ->where('A.class_id', $request->class_id)->orderBy('B.name', 'ASC')
                ->get();
		
		$csub = '<option value="">--Select--</option>';
		
			if(!empty($subjects)){
				foreach($subjects as $csb){ 			
					//print_r($csb->subject_id); print_r($csb->name);	 echo '<br>';				
					$csub .= '<option value="'.$csb->subject_id.'">'.$csb->name.'</option>';
				}
			}
				
        return $csub;		
	}

    public function get_chapters(Request $request)
	{		    	
			
		$subjects = DB::table('chapter as A')
                ->select('A.id', 'A.name')
				->where('A.subject_id', $request->subject_id)
				->where('A.class_id', $request->class_id)->orderBy('A.name', 'ASC')
				->get();
		
		$csub = '<option value="">--Select--</option>';
		
			if(!empty($subjects)){
				foreach($subjects as $csb){ 			
					//print_r($csb->subject_id); print_r($csb->name);	 echo '<br>';				
					$csub .= '<option value="'.$csb->id.'">'.$csb->name.'</option>';
				}
			}
				
        return $csub;		
    }   		
	
	public function get_concepts(Request $request){		

		$subjects = DB::table('concept as A')
                ->select('A.id', 'A.name')
				->where('A.chapter_id', $request->chapter_id)
				->where('A.class_id', $request->class_id)
				->where('A.subject_id', $request->subject_id)->orderBy('A.name', 'ASC')
                ->get();
		
		$csub = '<option value="">--Select--</option>';
		
			if(!empty($subjects)){
				foreach($subjects as $csb){ 			
					//print_r($csb->subject_id); print_r($csb->name);	 echo '<br>';				
					$csub .= '<option value="'.$csb->id.'">'.$csb->name.'</option>';
				}
			}
				
        return $csub;
    } 
		
	
	
	public function saveactivityconcept(Request $request)
	{	    
		
        if(!empty($request->acdata)){
			
			foreach($request->acdata as $data){
			
				$condata = array(
					'act_id' => $request->act_val,					
					'con_id' => $data['concept_id'],
					'class_id' =>	$data['class_id'],
					'subject_id' =>	$data['subject_id'],
					'chapter_id' =>	$data['chapter_id'] 					
				);
				
				$resac = DB::table('activity_concept')->where('act_id', $request->act_val)->where('con_id', $data['concept_id'])->first();
				if(empty($resac)){
					DB::table('activity_concept')->insert($condata);
				}
								
				
				$resacls = DB::table('activity_class')->where('act_id', $request->act_val)->where('class_id', $data['class_id'])->first();
				if(empty($resacls)){
					$clsdata = array(
						'act_id' => $request->act_val,					
						'class_id'=> $data['class_id']
					);
					DB::table('activity_class')->insert($clsdata);
				}
				
			}				
		}
		
		//exit(); 			
		//return redirect('admin/posts/4/edit')->with(['status' => 'success' , 'msg' => 'Successfully added']);
	}
	public function getSkillarea(Request $request)
	{
		
		$skillarea = DB::table('class_skillarea')
						->join('skillareas','skillareas.id', '=' ,'class_skillarea.skillarea_id')
						->select('skillareas.name','skillareas.id')
						->where('class_skillarea.class_id', $request->class_id)->orderBy('skillareas.name', 'ASC')
						->get();
		//return $skillarea;
		
		$sarea = '<option value="">--select--</option>';
		
				if(!empty($sarea)){
					foreach($skillarea as $skill){
						$sarea .= '<option value="'.$skill->id.'">'.$skill->name.'</option>';
					}
				}
		
				
        return $sarea;		
	}
	public function getSports(Request $request)
	{
		
		#echo "<pre>";
		#print_r($request->all());
		#die;
		//die('---final amt---');
		
		/*
		$skillsports = DB::table('class_skillarea_sports')
					->leftJoin('sports','sports.id', '=', 'class_skillarea_sports.sports_id')
					->select(['sports.id','sports.name'])
					->where('class_skillarea_sports.class_id', $request->class_id)
					->where('class_skillarea_sports.skillarea_id', $request->skillarea_id)->orderBy('sports.name', 'ASC')
					->get();
		//return $skillsports;
		*/
		

		$school_id        =  0;
		$skillarea_id     = $request->skillarea_id??0;
		$myArray = explode('-', $request->class_id);
		$cnt = count($myArray);	
		
		/*echo $skillarea_id;
		
		if($school_id !=0 && $skillarea_id ==2)
		{
			die('--a--');
		}elseif($skillarea_id!=1)
		{
			die('---b--');
		}
		else{
			die('---c--');
		}
		
		die('---change the detail---');
		die('---change the detail---');*/
		
		if($cnt >1)
		{
		 $custm_cls_id  = $myArray[0];
		 $class_id      = $myArray[1];
		 $school_id     = $request->school_id;
		}else
		{
		 $class_id  = $myArray[0];
		}
		
		$skillarea = DB::table('class_skillarea')
		->join('skillareas','skillareas.id', '=' ,'class_skillarea.skillarea_id')
		->where('class_skillarea.class_id', $class_id)
		->pluck('skillareas.id');
		
	
		
		if($school_id !=0 && $skillarea_id ==2)
		{
			
			$skillsports = DB::table('school_do_sports')
			->Join('sports','sports.id', '=', 'school_do_sports.sports_id')
			->select(['sports.id','sports.name'])
			->where('school_do_sports.school_id', $school_id)
			->where('school_do_sports.skill_id', $skillarea_id)
			->orderBy('sports.name', 'ASC')
			->groupBy('sports.id')
			->get(); 

		}
		elseif($skillarea_id == 8)
		{
		
			$skillsports1 = DB::table('school_do_sports')
			->Join('sports','sports.id', '=', 'school_do_sports.sports_id')
			->select(['sports.id','sports.name'])
			->where('school_do_sports.school_id', $school_id)
			//->wherein('school_do_sports.skill_id', $skillarea)
			->orderBy('sports.name', 'ASC')
			->groupBy('sports.id')
			->get()->toArray(); 
			
			
			
			
			
			
			$skillsports11 = DB::table('class_skillarea_sports')
			->Join('sports','sports.id', '=', 'class_skillarea_sports.sports_id')
			->select(['sports.id','sports.name'])
			->where('class_skillarea_sports.class_id', $class_id)
			->where('class_skillarea_sports.skillarea_id', 1)
			->orderBy('sports.name', 'ASC')
			->groupBy('sports.id')
			->get()->toArray(); 
			
			$skillsports = array_merge($skillsports11, $skillsports1);
			
			
			#echo "------------------";
			#echo "<pre>";
			#print_r($skillsports);
			#die('---');

		}else
		{
			$skillsports = DB::table('class_skillarea_sports')
			->Join('sports','sports.id', '=', 'class_skillarea_sports.sports_id')
			->select(['sports.id','sports.name'])
			->where('class_skillarea_sports.class_id', $class_id)
			->where('class_skillarea_sports.skillarea_id', $request->skillarea_id)->orderBy('sports.name', 'ASC')
			->groupBy('sports.id')
			->get(); 

		}			
		
				
		 $sport = '<option value=""> --select--</option>';
		 
		 //$sport;
		
			//if(!empty($sport))
			//{
				foreach($skillsports as $sports) 
				{
					$sport .= '<option value="'.$sports->id.'">'.$sports->name.'</option>';
				}
			//}
			return $sport;
	}
	
	public function getTechnique(Request $request)
	{
		
		$myArray = explode('-', $request->class_id);
		$cnt = count($myArray);	
		if($cnt >1)
		{
		 $custm_cls_id  = $myArray[0];
		 $class_id  = $myArray[1];
		}else{
		 $class_id  = $myArray[0];
		}
		
		//return $request->skillarea_id.'-'.$request->class_id.'-'.$request->sports_id;
		//die('----');
		
		
		$techniques = DB::table('class_skillarea_sports_tech')
					->join('techniques','techniques.id','=','class_skillarea_sports_tech.tech_id')
					->select('techniques.id','techniques.name')
					->where('class_skillarea_sports_tech.class_id', $class_id)
					//->where('class_skillarea_sports_tech.skillarea_id', $request->skillarea_id)
					->where('class_skillarea_sports_tech.sports_id', $request->sports_id)
					->groupBy('techniques.id','techniques.name')
					->orderBy('techniques.name', 'ASC')
					->get();
					
					
					
					/*
					$techniques = DB::table('activity_technique')
					->leftjoin('techniques','techniques.id','=','activity_technique.technique_id')
					->select('techniques.id','techniques.name')
					->where('activity_technique.class_id', $class_id)
					->where('activity_technique.skillarea_id', $request->skillarea_id)
					->where('activity_technique.sportskill_id', $request->sports_id)->orderBy('techniques.name', 'ASC')
					->groupBy('techniques.id')
					->get();*/
					
					
					
					
			$tech = '<option value="" >--select--</option>';
				
				if(!empty($tech))
				{
					foreach($techniques as $techs)
					{
						$tech .= '<option value="'.$techs->id.'">'.$techs->name.'</option>';
					}
				}
				return $tech;
	}
	
	
	public function getClassesSchoolWise(Request $request)
	{
		//dd('---stop the process---');
		$school_id  = $request->school_id;
		//echo $school_id;
		
		 $classes = DB::table('custom_classes')
		->select('id','class_id','section')
		->where('school_id', $school_id)
		->orderBy('orders', 'ASC')
		->get();

		$cls = '<option value="" >--select--</option>';
		if(!empty($cls))
		{
			foreach($classes as $clses)
			{
				$cls .= '<option value="'.$clses->id.'">'.$clses->class_id.'-'.$clses->section.'</option>';
			}
		}
		return $cls;


	}


	/**
	 * This function is used to check the cloned data exist or not.
	 * */
	public function CheckCloneData(Request $request) {

		$rowid = $request->post('rowId');
		$selectedValues = $request->post('selectedValues');

		$class_id = $selectedValues['skillclass']; 
		$skillarea_id = $selectedValues['skillarea'];
		$sports_id = $selectedValues['skillsports'];
		$technique_id = $selectedValues['technique'];
		$school_id        =  0;

		//echo "<pre>"; print_r($selectedValues);


		$skillarea = DB::table('class_skillarea')
		->join('skillareas','skillareas.id', '=' ,'class_skillarea.skillarea_id')
		->select('skillareas.name','skillareas.id')
		->where('class_skillarea.class_id',  $class_id)->orderBy('skillareas.name', 'ASC')
		->get()->toArray();

		$skillareaIds = array_column($skillarea, 'id');


		if (!in_array($skillarea_id, $skillareaIds)) {
		    $sarea = '<option value="">--select--</option>';
			if(!empty($sarea)){
				foreach($skillarea as $skill){
					$sarea .= '<option value="'.$skill->id.'">'.$skill->name.'</option>';
				}
			}							
	        return response()->json(['picklist' => $sarea, 'picklist_name' => 'skillarea']);
		}
		else{
			if($skillarea_id == 7){
				$sarea = '<option value="">--select--</option>';
				return response()->json(['picklist' => $sarea, 'picklist_name' => 'skillsports']);
			}
		}




		if($school_id !=0 && $skillarea_id ==2) {
			
			die('----one day---');
			$skillsports = DB::table('school_do_sports')
			->Join('sports','sports.id', '=', 'school_do_sports.sports_id')
			->select(['sports.id','sports.name'])
			->where('school_do_sports.school_id', $school_id)
			->where('school_do_sports.skill_id', $skillarea_id)
			->orderBy('sports.name', 'ASC')
			->groupBy('sports.id')
			->get()->toArray();


		} elseif($skillarea_id!=1 && $skillarea_id!=2)	{


			echo "skillarea_id ".$skillarea_id;
			die('----second day---');
		
			$skillsports = DB::table('school_do_sports')
			->Join('sports','sports.id', '=', 'school_do_sports.sports_id')
			->select(['sports.id','sports.name'])
			->where('school_do_sports.school_id', $school_id)
			->wherein('school_do_sports.skill_id', $skillarea)
			->orderBy('sports.name', 'ASC')
			->groupBy('sports.id')
			->get()->toArray();

		} else {


			$skillsports = DB::table('class_skillarea_sports')
			->Join('sports','sports.id', '=', 'class_skillarea_sports.sports_id')
			->select(['sports.id','sports.name'])
			->where('class_skillarea_sports.class_id', $class_id)
			->where('class_skillarea_sports.skillarea_id', $skillarea_id)->orderBy('sports.name', 'ASC')
			->groupBy('sports.id')
			->get()->toArray();
		}


		$skillsportsIds = array_column($skillsports, 'id');

		

		if (!in_array($sports_id, $skillsportsIds)) {
		    $sport = '<option value=""> --select--</option>';		 
			foreach($skillsports as $sports) {
				$sport .= '<option value="'.$sports->id.'">'.$sports->name.'</option>';
			}
			return response()->json(['picklist' => $sport, 'picklist_name' => 'skillsports']);
		}




		$techniques = DB::table('class_skillarea_sports_tech')
		->join('techniques','techniques.id','=','class_skillarea_sports_tech.tech_id')
		->select('techniques.id','techniques.name')
		->where('class_skillarea_sports_tech.class_id', $class_id)
		->where('class_skillarea_sports_tech.sports_id', $sports_id)
		->groupBy('techniques.id','techniques.name')
		->orderBy('techniques.name', 'ASC')
		->get()->toArray();
				
		$techniquesIds = array_column($techniques, 'id');	
		if (!in_array($technique_id, $techniquesIds)) {

		    $tech = '<option value="" >--select--</option>';			
			if(!empty($tech)){
				foreach($techniques as $techs) {
					$tech .= '<option value="'.$techs->id.'">'.$techs->name.'</option>';
				}
			}
			return response()->json(['picklist' => $tech, 'picklist_name' => 'technique']);
		}

	}
	
}	
