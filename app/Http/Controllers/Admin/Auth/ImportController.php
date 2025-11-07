<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;

use Auth;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Imports\ChapterImport;
use App\Imports\ConceptImport;
use App\Imports\ActivityImport;
use App\Imports\UpdateConceptImport;
use App\Imports\UpdateChapterImport;
use App\Imports\ImportActivites;
use App\Exports\ExportImproperActivityData;
use App\Exports\ExportDuplicateActivities;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Teachingthrough;
use App\Models\Activity;
use App\Models\Sclass;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Concept;
use App\Model\Uploadactivity;
use App\Model\Classactivity;
 
  
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

    public function chapimport(Request $request)
    {
        $chfile=request()->file('file');
		/* $data = [
			'class_id' => $request->class_id, 
			'subject_id' => $request->subject_id, 
		];  */
		
		//Excel::import(new ChapterImport($data), $chfile);		      
		Excel::import(new ChapterImport($request->class_id,$request->subject_id), $chfile);		      
        return back();
    }	
	
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
	
	
	public function importConcept(Request $request)
	{
		$classes  = Sclass::orderBy('orders','asc')->get();		
		$subjects = Subject::orderBy('name','asc')->get();
		$chapters = Chapter::orderBy('name','asc')->get();	
		return view('admin.activitiesupload.concept',compact('classes','subjects','chapters'));
		
	}
	public function conceptImport(Request $request)
	{
		//dd($request->class_id);
		
		request()->validate([
                    'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
					'class_id' => 'required',
					'subject_id' => 'required',
					'chapter_id' => 'required',
                ]);
		$concept=request()->file('file');
		Excel::import(new ConceptImport($request->class_id,$request->subject_id,$request->chapter_id), $concept);	
		return back()->with('status', 'Excel Data Imported successfully.');
	}
	public function updateImportConcept(Request $request)
	{
		//dd($updated_concept);
		//exit();
		request()->validate([
                    'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
					
                ]);
		$updated_concept=request()->file('file');
		
		Excel::import(new UpdateConceptImport(),$updated_concept);
		return back();
	}	
	
	public function updateImportChapter(Request $request)
	{
		//dd($updated_chapter);
		//exit();
		request()->validate([
                    'file'  => 'required|mimes:xls,xlsx,csv|max:2048',
					
                ]);
		$updated_chapter=request()->file('file');
		
		Excel::import(new UpdateChapterImport(),$updated_chapter);
		return back();
	}



	/**
	 * Manage Activity
	 * */
	public function manageActivity(){

		$teachingthrough = Teachingthrough::where('status', 1)->select('name','id')->get();
		$classes = Sclass::where('status', 1)->select('name','id')->get();
		$title='Manage Activity'; 	  
		return view('admin.activitiesupload.manage-activity',compact('title','teachingthrough','classes'));
	} 



	public function importActivities(Request $request) 	{

	    $validator = Validator::make($request->all(), [
	    	/*
	        'import_activity' => [
	            'required', 'file', 'mimes:xls,xlsx', 'max:3000',
	            function ($attribute, $value, $fail) {
	                if ($value->isValid()) {
	                    $fileName = $value->getClientOriginalName();
	                    if ($fileName !== 'Activity_List.xlsx') {
	                        $fail('Invalid file name. Please upload the file named "Activity_List.xlsx".');
	                    }
	                }
	            }
	        ]
	        */
	        'import_activity'    => 'required', 'file', 'mimes:xls,xlsx', 'max:3000',
	        'teachingthrough_ids' => 'required|array|min:1',
    		'class_ids' => 'required|array|min:1'

	    ], [
	        'import_activity.required' => 'Please select a document file.',
	        'import_activity.file'     => 'No file has been selected. Please choose a file.',
	        'import_activity.mimes'    => 'The selected file must be in either the xls or xlsx format.',
	        'import_activity.max'      => 'File size should not be more than 3MB.',

	        'teachingthrough_ids.required' => 'Please select at least one Teaching Through option.',
		    'teachingthrough_ids.min' => 'Please select at least one Teaching Through option.',
		    'class_ids.required' => 'Please select at least one Class.',
		    'class_ids.min' => 'Please select at least one Class.',
	    ]);

	    if ($validator->fails()) {
	        $errorContent = '<ul style="list-style-type: none;">';
	        foreach ($validator->errors()->getMessages() as $validationErrors) {
	            foreach ((array) $validationErrors as $validationError) {
	                $errorContent .= "<li>{$validationError}</li>";
	            }
	        }
	        $errorContent .= '</ul>';
	        return response()->json(['error' => $errorContent]);
	    }

	    $teachingIds = $request->input('teachingthrough_ids', []);
		$classIds = $request->input('class_ids', []);


	    $file = $request->file('import_activity');
	    $action = $request->post('event'); 		
	    $userId = Auth::id();
	    $schoolId = Auth::user()->school_id;

	    $importInstance = new ImportActivites($action, $teachingIds, $classIds);



	    $dataArray = Excel::toArray($importInstance, $file);
	    $totalRecords = count($dataArray[0]);


	    if($action == 'preview'){

	    	$importInstance = new ImportActivites($action, $teachingIds, $classIds);			
			Excel::import($importInstance, $file);

			$duplicates = $importInstance->getDuplicateRecords();
			$totalRecords = $importInstance->getTotalRecords();
			$duplicateCount = count($duplicates);
			$identicalRecords = $totalRecords - $duplicateCount;

	
	        if(!empty($duplicates) && $identicalRecords > 0){

	        	$confirmButtonText = "Yes, Overwrite it!";
	        	$buttonClass = 'btn-overwrite';
	        	$summary = '<p>Found '.$totalRecords.' records in the Excel file — '.count($duplicates).' are duplicates. <a href="'.route('admin.duplicateactivities').'"> click to view - 1</a></p>
	        			<div class="form-group mt-2">
                            <label>Do you want to overwrite existing records?</label>
                            <input type="radio" id="overwrite" name="importOption" value="override" data-id="Yes, Overwrite it!" checked>
                            <label for="overwrite">Yes, Overwrite it</label><br>
                            <input type="radio" id="skip" name="importOption" value="skipandimport" data-id="Skip & Import">
                            <label for="skip">No, Skip Overwrite & Import New Records Only</label>
                        </div>';

	        } else if(!empty($duplicates) ){
	  
	        	$confirmButtonText = "Overwrite it!";
	        	$buttonClass = 'btn-overwrite';
	        	$summary = '<p>All '.$totalRecords.' records in the Excel file are duplicates. <a href="'.route('admin.duplicateactivities').'"> click to view </a></p>';
	        }else{

	        	//echo "new records";
				$confirmButtonText = "Yes, Import it!";
				$buttonClass = 'btn-import';    
				$summary = 'The Excel file contains '.$totalRecords . ' records. Please review and confirm to proceed with the import.';
	        }


	       	return response()->json(['summary' => $summary,'icon' => 'info','cnfmText' => $confirmButtonText,'btnclass'=>$buttonClass]);


        } else if($action == 'import' || $action == 'skipandimport'){  
        	
        	$summary = '';
	        Excel::import($importInstance, $file);
	        $importedData = $importInstance->getImportedData();
	        $imProperFormatData =  $importInstance->imProperFormatData();
	        $summary .= 'Import completed! '.count($importedData).' records were successfully imported into the database.';

	        if(!empty($imProperFormatData)){
	           	// Storage::disk('local')->put('error_activity.json', json_encode($imProperFormatData)); 
	           	$summary .= ' <p>'.count($imProperFormatData).' records could not be imported. <a href="'.route('admin.errorlist').'"> click here to view</a></p>';
	        }

	        return response()->json(['summary' => $summary, 'icon' => 'sucess']);

        }else if($action == 'override'){

        	$summary = '';
	        Excel::import($importInstance, $file);
	        $importedData = $importInstance->getImportedData();
	        $imProperFormatData =  $importInstance->imProperFormatData();
	        $summary .= 'Import completed! '.count($importedData).' records were successfully imported into the database.';

	        if(!empty($imProperFormatData)){
	           	$summary .= ' <p>'.count($imProperFormatData).' records could not be imported. <a href="'.route('admin.errorlist').'"> click here to view</a></p>';
	        }

	        return response()->json(['summary' => $summary, 'icon' => 'sucess']);
        }
	}


	public function downloadErrorList(){

        $failedRecordsPath = storage_path('app/error_activity.json');

        if (!file_exists($failedRecordsPath)) {
            abort(404, 'No failed import records found.');
        }

        $failedRecords = json_decode(file_get_contents($failedRecordsPath), true);
        return Excel::download(new ExportImproperActivityData($failedRecords,'error_list'), 'ErrorList_'.date("d-m-Y H:i:s").'.xlsx');
    }


    public function downloadTemplate($val) {
      	

    	if($val == 'template'){
    		$templatePath = public_path('downloads/ActivityFormat.xlsx');
    		$fileName = 'ActivityFormat.xlsx';
    	}

    	if($val == 'sample'){
    		$templatePath = public_path('downloads/ActivitySampleData.xlsx');
    		$fileName = 'ActivitySampleData.xlsx';
    	}
        
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return Response::download($templatePath, $fileName, $headers);
    }

    public function downloadSample() {
      	
        $templatePath = public_path('downloads/ActivityFormat.xlsx');

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return Response::download($templatePath, 'ActivityFormat.xlsx', $headers);
    }

    

    public function duplicateActivities() {

	    $path = storage_path('app/duplicate_records.json');

	    if (!file_exists($path)) {
	        return redirect()->back()->with('error', 'No duplicate data found to export.');
	    }

	    $data = json_decode(file_get_contents($path), true);

	    return Excel::download(new ExportDuplicateActivities($data, 'error_list'), 'Duplicate_Activities.xlsx');
	}
	

}