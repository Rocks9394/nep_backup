<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Concept;
use App\Models\School;
use App\Model\Uploadactivity;
use App\Model\Classactivity;
use App\Imports\ChapterImport;
use App\Imports\ActivityImport;
use App\Imports\SchoolImport;
use Maatwebsite\Excel\Facades\Excel;
//https://www.youtube.com/watch?v=KKOMJQBkPLE&list=PLz_YkiqIHesvWMGfavV8JFDQRJycfHUvD&index=33

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function importchapter()
    {  
		$title='Import Concept';
        $classes  = Sclass::all();
		$subjects = Subject::all(); 		
        return view('admin.activitiesupload.chapter',compact('title','classes','subjects'));
    }
	
	public function chapimport(Request $request){		
        
		if(empty($request->file('file'))){
          
		  return back()->with('error','Please upload .exel file !.');
        
		} else {
			
                request()->validate([
                    'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
                ]);
				
				$chfile=request()->file('file');
                
                Excel::import(new ChapterImport( $request->class_id, $request->subject_id ), $chfile);	
				
                return back()->with('status', 'Excel Data Imported successfully.');				
               return redirect()->back()->with('success','Concept has been created successfully.');         
            }
    }

    /*public function chapimport(Request $request){
        $chfile=request()->file('file');
		 $data = [
			'class_id' => $request->class_id, 
			'subject_id' => $request->subject_id, 
		];
		
		//Excel::import(new ChapterImport($data), $chfile);		      
		Excel::import(new ChapterImport($request->class_id,$request->subject_id), $chfile);		      
        return back();
    }*/
	
    public function importactivity()
    {      
	  $title='Import Activity'; 	  
	  return view('admin.activitiesupload.index',compact('title'));
    }        
   
    public function import() 
    {
       $csvfile=request()->file('file');	   
		
		//dd($csvfile);die;
		
		Excel::import(new ActivityImport, $csvfile);
		
		//die()             
        return back();
    }
	
	public function export() 
    {
        return Excel::download(new ActivityExport, 'activity.xlsx');
    }
		
	public function schoolDetail(Request $request)
	{
		return view('admin.schools.upload');
	}
	public function schoolImport(Request $request)
	{
		 request()->validate([
                    'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
                ]);
		Excel::import(new SchoolImport,request()->file('file'));
		return back()->with('status', 'Excel Data Imported successfully.');
		
	}
}

