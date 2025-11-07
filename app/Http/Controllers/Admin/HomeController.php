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

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:admin');
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
                ->where('A.class_id', $request->class_id)
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

    public function get_chapters(Request $request){		    	
			

		$subjects = DB::table('chapter as A')
                ->select('A.id', 'A.name')
				->where('A.subject_id', $request->subject_id)
				->where('A.class_id', $request->class_id)
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
				->where('A.subject_id', $request->subject_id)
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
		
	public function getconcepts(Request $request){	
		$cp_id = $request->cp_id;	   
		$data = json_decode($cp_id,true);
		$concept = Concept::whereIn('chapter_id', $data)->orderby('name', 'asc')->get();
		
		$sub = '';
		
		if(!empty($concept)){
			foreach($concept as $sb){              
			   $sub.='<option value="'.$sb['id'].'">'.$sb['name'].'</option>';
			}
		} 
		
        return $sub;
    }
    
    public function getcheptors(Request $request){         
		 //dd($request->sub_id);die;		 
	    $sbj_id = $request->sub_id;	   
		$data = json_decode($sbj_id,true);
		$chapter = Chapter::whereIn('subject_id', $data)->orderby('name', 'asc')->get();

		$csub = '';
		if(!empty($chapter)){
			foreach($chapter as $csb){              
			   $csub .= '<option value="'.$csb['id'].'">'.$csb['name'].'</option>';
			}
		} 
		
        return $csub;
    }   
	
	

}
