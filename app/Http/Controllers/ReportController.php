<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;
use PDF;
use DB;
use Auth;
use Session;
use DataTables;
use Carbon\Carbon;
use App\Models\School;
use App\Models\Sclass;
use App\Models\Sstudent;
use App\Traits\ReportHelperTrait;


use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batch;
use Throwable;
use App\Jobs\GenerateReportBatchJob;
use App\Jobs\MergeSchoolReportsJob;
use App\Services\DataTableListService;

use App\Jobs\GenerateSchoolReportsMasterJob;

use App\Models\ReportBatch;
use App\Models\ReportRequest;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

use App\Services\ClassSectionService;

class ReportController extends Controller {
	
	use ReportHelperTrait;	

	protected $higherClasses;

    public function __construct() {	
   
        $this->middleware('auth:web');
        $this->higherClasses = [4, 5, 6, 7, 8, 9, 10, 11, 12];
        $this->lowerClass = [1, 2, 3];
    }
	
	private function notEmpty($column) {
		
	    return "COALESCE(NULLIF(TRIM(REPLACE(REPLACE(REPLACE($column, '---', ''), '--', ''), 'N/A', '')), ''), '') <> ''";
	}



	/**
	 * Fitness Test Reports Module
	 * */

	public function FitnessReports(Request $request, DataTableListService $dataTable) {

		$title  = 'Assessment Report';
		$userId = Auth::user()->id;
		$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		$school = School::find($schoolId);
		


		$studentsQuery = DB::table('schools')
		->where('students.school_code', $school->school_code)
		->where('students.status', 'active')
		->join('students', 'students.school_id', '=' , 'schools.id')
		->leftJoin('report_requests', 'report_requests.student_id', '=', 'students.id')

		->leftJoin('class', 'students.class_id', '=', 'class.id')
    	->leftJoin('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
    	->leftJoin('SeniorTestResultsSummary as senior', function ($join) {
            $join->on('students.id', '=', 'senior.student_id')
                 ->on('students.school_id', '=', 'senior.school_id');
        })
        ->leftJoin('LowerTestResultsSummary as lower', function ($join) {
            $join->on('students.id', '=', 'lower.student_id')
                 ->on('students.school_id', '=', 'lower.school_id');
        })
		->select(
			'schools.id as schools_id',
			'schools.school_code as school_code',
			'students.id',
			'students.student_uid as admissionnumber',
			'students.student_name as student_name',
			'students.gender',
			'students.class_id',
			'students.section_id',
			'students.custom_class_id',
			'students.dob',
			'students.email_id',
			'students.rollno',
			'students.status',
			'report_requests.status as report_status',
			
			DB::raw("
	            CASE 
	                WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
	                THEN custom_classes.nomenclature
	                ELSE class.name
	            END AS display_classname
	        "),

			'custom_classes.section',
			
		);
	
	    $statusCase = "
		CASE 
		    WHEN students.class_id IN (" . implode(',', $this->higherClasses) . ") THEN 
		        CASE 
		            WHEN 
		                " . $this->notEmpty('senior.sit_and_reach') . " AND
		                " . $this->notEmpty('senior.run_600m') . " AND
		                " . $this->notEmpty('senior.pushups') . " AND
		                " . $this->notEmpty('senior.dash_50m') . " AND
		                " . $this->notEmpty('senior.curlup') . " AND
		                " . $this->notEmpty('senior.bmi') . " AND
		                " . $this->notEmpty('senior.height') . " AND
		                " . $this->notEmpty('senior.weight') . "
		            THEN 'Completed'
		            ELSE 'Incomplete'
		        END
		    ELSE 
		        CASE 
		            WHEN 
		                " . $this->notEmpty('lower.running') . " AND
		                " . $this->notEmpty('lower.hopping') . " AND
		                " . $this->notEmpty('lower.jumping_landing') . " AND
		                " . $this->notEmpty('lower.skipping') . " AND
		                " . $this->notEmpty('lower.dodging') . " AND
		                " . $this->notEmpty('lower.one_foot_balance') . " AND
		                " . $this->notEmpty('lower.beam_walk') . " AND
		                " . $this->notEmpty('lower.catching_receiving_bounce') . " AND
		                " . $this->notEmpty('lower.catching_small_ball') . " AND
		                " . $this->notEmpty('lower.under_arm_throw') . " AND
		                " . $this->notEmpty('lower.over_arm_throw') . " AND
		                " . $this->notEmpty('lower.striking_drop_hit') . " AND
		                " . $this->notEmpty('lower.dribbling_hands') . " AND
		                " . $this->notEmpty('lower.dribbling_feet') . " AND
		                " . $this->notEmpty('lower.kicking_ball') . " AND
		                " . $this->notEmpty('lower.flamingo_balance') . " AND
		                " . $this->notEmpty('lower.plate_tapping') . " AND
		                " . $this->notEmpty('lower.bmi') . " AND
		                " . $this->notEmpty('lower.height') . " AND
		                " . $this->notEmpty('lower.weight') . "
		            THEN 'Completed'
		            ELSE 'Incomplete'
		        END
		END";

	    $studentsQuery->addSelect(DB::raw("$statusCase AS test_status"));
	    
		$filters = [

			'class' => function ($studentsQuery, $value) {
                 $studentsQuery->where('students.class_id', $value);
            },

            'section' => function ($studentsQuery, $value) {
                 $studentsQuery->where('students.section_id', $value);
            },

            'class-section' => function ($studentsQuery, $value) {
                list($class_id, $section_id) = array_pad(explode('-', $value), 2, null);

                if (!empty($class_id)) {
                    $studentsQuery->where('students.class_id', $class_id);
                }

                if (!empty($section_id)) {
                    $studentsQuery->where('students.section_id', $section_id);
                }
            },

            'status' => function ($studentsQuery, $value) {            	
	           if ($value === 'complete') {
			        $studentsQuery->having('test_status', '=', 'Completed');
			    } elseif ($value === 'incomplete') {
			        $studentsQuery->having('test_status', '=', 'Incomplete');
			    }
	        }
        ];


        // echo "<pre>"; print_r($studentsQuery->get());exit();

		if ($request->ajax()) {

		    return $dataTable
	        ->setQuery($studentsQuery)
	        ->setFilters($filters)
	        ->setSearchableColumns(['student_name', 'student_uid'])

	        ->setSortableColumns([
            	'display_classname' => DB::raw("
                    CASE 
                        WHEN custom_classes.nomenclature IS NOT NULL 
                             AND custom_classes.nomenclature <> '' 
                        THEN custom_classes.nomenclature
                        ELSE class.name
                    END
                "),
                'section_id'        => 'custom_classes.section',
                'rollno'            => DB::raw('CAST(students.rollno AS UNSIGNED)'),
                'student_name'      => 'students.student_name',
                'admissionnumber'   => 'students.student_uid',
                'gender'            => 'students.gender',
            ])

			->addCustomColumn('viewReport', function ($row) {
                $encryptedId = Crypt::encryptString($row->id);
                $url = route('reports.view.test', $encryptedId);
                return '<a href="' . $url . '" class="btn-link mr-1" target="_blank">View</a>';
            })
            ->addCustomColumn('testStatus', function ($row) {
                $status = $row->test_status ?? 'Incomplete';
                if ($status === 'Completed') {
                    return '<span class="badge bg-success text-light p-2" style="font-size:14px;" >Completed</span>';
                }
                return '<span class="badge text-light p-2 btn-primary" style="font-size:14px;">Incomplete</span>';
            })
           
            ->render($request);
	    }

	    return view('reports.fitnessreports',compact('title'));	
	}


	/**
	 * View Individual Reports
	 * */
    public function ViewFitnessReport($id)	 {

 	    $studentId = Crypt::decryptString($id);
	    $studentsData = $this->getStudentData($studentId);
	    $TermMasterId = $this->getTermId($studentsData->schools_id);

	    $dob          = Carbon::parse($studentsData->dob);
	    $studentAge   = $dob->age;
	    $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';
	    $ageGender    = $studentAge . strtolower(substr($studentsData->gender, 0, 1));

	    // Fetch report + benchmarks
	    $reportData    = $this->getReportData($studentId);
	    $mappedReport  = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);
	    $groupedReport = $mappedReport->groupBy('Category');
		$getBmiBenchmark = $getBmiBenchmark =  $this->getBmiBenchmark($ageGender);

	    if (in_array($studentsData->class_id, $this->higherClasses)) {

			[$orderedReportData, $getFitnessBenchmark] = $this->getSeniorReportData($studentId, $studentAge, $studentGender, $groupedReport);
	       
/*	        return view('assessor.reports.senior-report', compact('studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark'
	        ));
*/

	        $pdf = PDF::loadView('reports.fitness.senior-report', compact('studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark'
	        ));
			$filename  = 'Reports.pdf';
			return $pdf->stream($filename);


	    } else {

	    	[$orderedReportData, $FmsReportData, $getFitnessBenchmark] =
            $this->getJuniorReportData($classId = null,  $studentId, $studentAge, $studentGender, $groupedReport, $TermMasterId);
	        
/* return view('assessor.reports.junior-report', compact('studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark'));
*/
	        $pdf = Pdf::loadView('reports.fitness.junior-report', compact(
                'studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark'
            ));

            $filename  = 'Reports.pdf';
			return $pdf->stream($filename);
	    }
	}


	/**
	 * 
	 * Handling Report Card Generation.
	 * */

	public function queueBulkReportCards(Request $request) {

		try {
            
            $userId = Auth::id();
            $schoolId = DB::table('school_reference')->where('school_user_id', $userId)->where('status', 1)->value('school_id');

            if (!$schoolId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No school found for the current user.'
                ], 400);
            }

            $studentIds = $request->input('student_ids', []);
            if (empty($studentIds)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No student IDs provided.'
                ], 400);
            }

            $report_batch = ReportBatch::create([
			    'school_id' => $schoolId,
			    'status' => 'pending',
			]);



            foreach ($studentIds as $studentId) {            	
			    ReportRequest::updateOrCreate(
			        ['student_id' => $studentId],
			        [
			            'school_id' => $schoolId,
			            'batch_id' => $report_batch->id,
			            'status' => 'requested',
			            'requested_at' => now(),
			        ]
			    );
			}			

	
            GenerateSchoolReportsMasterJob::dispatch($schoolId, $studentIds, $report_batch->id)->onQueue('report_generation');
            return response()->json([
                'status' => 'queued',
                'message' => 'You will receive a notification with a download link once the report card generated.'
            ]);

        } catch (\Throwable $e) {
            Log::error("Failed to queue report generation", ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while starting report generation.'
            ], 500);
        }
	}



	public function CheckReportAvailablity() {

		$userId = Auth::id();
        $schoolId = DB::table('school_reference')->where('school_user_id', $userId)->where('status', 1)->value('school_id');
	    $reports = DB::table('report_batches')
	    	->where('school_id', $schoolId)
	    	->select('total_students','completed_students','status','download_path','created_at')
	    	->get();

	    // echo "<pre>"; print_r($reports);exit();

	    if ($reports->isEmpty()) {
	        return response()->json([
	            'html' => '<p class="text-center text-muted">No report requests found.</p>'
	        ]);
	    }

	    $html = view('reports.modals.available-report-cards', compact('reports'))->render();

	    return response()->json(['html' => $html]);
	}


	public function requestDownload(Request $request, $batchId) {

        $batch = ReportBatch::findOrFail($batchId);
        $schoolId = DB::table('school_reference')->where('school_user_id', Auth::id())
        ->where('status', 1)->value('school_id');
       
        if ($schoolId !== $batch->school_id) {
            abort(403, 'Unauthorized access to this report');
        }

        $signedUrl = URL::temporarySignedRoute(
            'report.download.signed',
            now()->addMinutes(15),
            ['batchId' => $batchId]
        );

        return redirect($signedUrl);
    }


    public function downloadSigned(Request $request, $batchId) {

        if (! $request->hasValidSignature()) {
            abort(403, 'This download link has expired or is invalid.');
        }

        $batch = ReportBatch::findOrFail($batchId);
        $schoolId = DB::table('school_reference')->where('school_user_id', Auth::id())
        ->where('status', 1)->value('school_id');

        if ($schoolId !== $batch->school_id) {
            abort(403, 'Unauthorized access to this report');
        }

        $zipPath = $batch->final_zip_path;        

        if (! file_exists($zipPath)) {
            abort(404, 'Report file not found.');
        }

        return response()->download($zipPath, basename($zipPath));
    }




	/**
	 * Higher Class Test Summanry
	 * */

    public function HigherClassTestSummary(Request $request)  {

        $userId = Auth::user()->id;
      	$role_id =  \Auth::user()->role_id;

        if($role_id == 3){

        	if(Session::get('SelectSchoolId')) {
				$schoolId = Session::get('SelectSchoolId');
			}else{
				$schoolId = DB::table('school_trainers')
				->join('schools','schools.id','=','school_trainers.school_id')
				->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->value('school_trainers.school_id');
			}
        }

        if($role_id == 4 || $role_id == 2){
        	$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
        	// $ajaxUrl = route('higherclass.status');
        }
		
        $ajaxUrl = route('higherclasstestsummary');

        $school = School::find($schoolId);
		$higherClass = $this->higherClasses;

		$classList = $school->getClasses
			->filter(function ($class) use ($higherClass) {
		        return in_array($class->class_id, $higherClass);
		    })
			->map(function ($class) {
	        $originalClass = Sclass::where('id', $class->class_id) ->orderBy('orders')->first();

	        $class->name = !empty($class->nomenclature)
	            ? $class->nomenclature
	            : ($originalClass ? $originalClass->name : null);

	        return $class;
	    });

		$classList->prepend((object)[
	        'class_id' => '',
	        'name' => 'All Class',
	        'section' => ''
	    ]);



        if ($request->ajax()) {

            $start = $request->input('start', 0);
            $length = $request->input('length', 100);
		
            $query = DB::table('students as s')
		        ->leftJoin('SeniorTestResultsSummary as r', 's.id', '=', 'r.student_id')
		        ->leftJoin('class', 's.class_id', '=', 'class.id')
				->leftJoin('custom_classes', 's.custom_class_id', '=', 'custom_classes.id')
			        ->select( 's.id', 's.student_name', 's.rollno' ,'r.sit_and_reach', 'r.run_600m', 'r.pushups', 'r.dash_50m',  'r.curlup',  'r.bmi', 'r.height', 'r.weight', 's.class_id','s.section_id',
			             DB::raw("CASE 
							WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
							THEN custom_classes.nomenclature 
							ELSE class.name 
						 END AS display_classname"),
					'custom_classes.section'
	            )
			    ->whereIn('class.id', $higherClass)		
				->where('s.status', 'active')      
		        ->where('s.school_code', $school->school_code);
		      

			if ($request->input('class')) {
		        $classFilter = $request->input('class');

		        list($class_id, $section_id) = explode('-', $classFilter, 2);
		        if (!empty($class_id)) {
		            $query->where('s.class_id', $class_id);
		        }
		        if (!empty($section_id)) {
		            $query->where('s.section_id', $section_id);
		        }
		    }


		    $status = $request->input('status');
			$tests  = $request->input('test', []);
		    $allTests = ['sit_and_reach','run_600m','pushups','dash_50m','curlup','bmi','flamingo','plate_tapping'];

		    if (!empty($request->status) && !empty($tests)) {
	            if (in_array('all', $tests)) {
	                $tests = $allTests;
	            }

	            $query->where(function ($q) use ($tests, $request) {
	                if ($request->status === 'complete') {
	                    foreach ($tests as $test) {
	                        $q->whereNotNull("r.$test");
	                    }
	                } elseif ($request->status === 'incomplete') {
	                    foreach ($tests as $test) {
	                        $q->orWhereNull("r.$test");
	                    }
	                }
	            });
	        }

	        $searchValue = $request->input('search.value');
	        if (!empty($searchValue)) {
			    $query->where(function ($q) use ($searchValue) {
			        $q->orWhere('s.student_name', 'LIKE', "%{$searchValue}%")
			          ->orWhere('s.rollno', 'LIKE', "%{$searchValue}%");
			    });
			}


	        if ($request->has('order')) {
	            $order = $request->order[0];
	            $colIndex = $order['column'];
	            $direction = $order['dir']; // asc | desc
	            $colName = $request->columns[$colIndex]['data'];

	            $sortableColumns = [
	                'class_name'     => DB::raw("display_classname"),
	                'student_name'   => 's.student_name',
	                'sit_and_reach'  => 'r.sit_and_reach',
	                'run_600m'       => 'r.run_600m',
	                'pushups'        => 'r.pushups',
	                'dash_50m'       => 'r.dash_50m',
	                'curlup'         => 'r.curlup',
	                'bmi'            => 'r.bmi',
	                'height'         => 'r.height',
	                'weight'         => 'r.weight',
	            ];

	            if (array_key_exists($colName, $sortableColumns)) {
	                $query->orderBy($sortableColumns[$colName], $direction);
	            }
	        }

            $recordsTotal = $query->count();
        	$draw = intval($request->input('draw'));
        	$studentlist = $query->skip($start)
            ->take($length == -1 ? $recordsTotal : $length)->get();
	
	        $flattenedList = $studentlist->map(function ($item) use ($role_id) {

	        	if($role_id == 3){
	        		$view_link = route('trainer.reports.view', ['id' => Crypt::encryptString($item->id)]);
	        	}

				if($role_id == 4 || $role_id == 2){
					$view_link = route('reports.view', ['id' => Crypt::encryptString($item->id)]);
	        	}

	            return [
	                'id' => $item->id,
	                'student_name' => $item->student_name,
	           		'class_name' => $item->display_classname.'-'. $item->section,
	           		'rollno' => $item->rollno ?? 'N.A.',
	                'sit_and_reach' => $item->sit_and_reach ?? '---',
	                'run_600m' => $item->run_600m ?? '---',
	                'pushups' => $item->pushups ?? '---',
	                'dash_50m' => $item->dash_50m ?? '---',
	                'curlup' => $item->curlup ?? '---',
	                'bmi' => $item->bmi ?? '---',
	                'height' => $item->height ?? '---',
	                'weight' => $item->weight ?? '---',	                
	                'view_link' => $view_link,
	            ];
	        });

            return response()->json([
	            'draw' => intval($draw),
	            'recordsTotal' => $recordsTotal,
	            'recordsFiltered' => $recordsTotal,
	            'data' => $flattenedList
	        ]);
        }

       	$title = 'Fitness Test Status (Class 4 to 12)';
        return view('reports.summary.higherclass', compact('title','classList','ajaxUrl'));
    }

    /**
     * Lower Class Test Summary
     * */
    public function LowerClassTestSummary(Request $request) {


	    $userId  = Auth::user()->id;
	    $role_id = Auth::user()->role_id;


	    if ($role_id == 3) {

	    	if(Session::get('SelectSchoolId')) {
				$schoolId = Session::get('SelectSchoolId');
			}else{
				$schoolId = DB::table('school_trainers')
	            ->join('schools', 'schools.id', '=', 'school_trainers.school_id')
	            ->where('school_trainers.trainer_id', $userId)
	            ->where('school_trainers.status', 1)
	            ->value('school_trainers.school_id');
			}
	        //$ajaxUrl = route('trainer.lowerclass.status');
	    } elseif ($role_id == 4 || $role_id == 2) {
	        $schoolId = DB::table('school_reference')->where('school_user_id', $userId)->where('status', 1)->value('school_id');
	       // $ajaxUrl = route('lowerclass.status');
	    }

	    $ajaxUrl = route('lowerclasstestsummary');


	    $school = School::find($schoolId);
	    $lowerClass = $this->lowerClass;


	    $classList = DB::table('custom_classes as cc')
        ->leftJoin('class as c', 'c.id', '=', 'cc.class_id')
        ->where('cc.school_id', $schoolId)
        ->whereIn('cc.class_id', $lowerClass)
        ->select(
            'cc.class_id',
            DB::raw("CASE 
                WHEN cc.nomenclature IS NOT NULL AND cc.nomenclature <> '' 
                THEN cc.nomenclature 
                ELSE c.name 
             END as name"),
            'cc.section'
        )
        ->orderBy('c.orders')
        ->get();

	    $classList->prepend((object)[
	        'class_id' => '',
	        'name'     => 'All Class',
	        'section'  => ''
	    ]);

	    if ($request->ajax()) {
	        $start  = $request->input('start', 0);
	        $length = $request->input('length', 100);
	        $draw   = intval($request->input('draw'));


	        $query = DB::table('students as s')
	            ->leftJoin('LowerTestResultsSummary as r', 's.id', '=', 'r.student_id')
	            ->leftJoin('class', 's.class_id', '=', 'class.id')
	            ->leftJoin('custom_classes', 's.custom_class_id', '=', 'custom_classes.id')
	            ->where('s.school_code', $school->school_code)
				->where('s.status', 'active')
	            ->whereIn('class.id', $lowerClass)
	            ->select(
	                's.id',
	                's.student_name','s.rollno',
	                's.class_id',
	                's.section_id',
	                'r.running', 'r.hopping', 'r.jumping_landing', 'r.one_foot_balance',
	                'r.skipping', 'r.dodging', 'r.beam_walk', 'r.catching_receiving_bounce',
	                'r.catching_small_ball', 'r.under_arm_throw', 'r.over_arm_throw',
	                'r.striking_drop_hit', 'r.dribbling_hands', 'r.dribbling_feet',
	                'r.kicking_ball', 'r.flamingo_balance', 'r.plate_tapping',
	                'r.bmi', 'r.height', 'r.weight',
	                DB::raw("CASE 
	                            WHEN custom_classes.nomenclature IS NOT NULL 
	                                 AND custom_classes.nomenclature <> '' 
	                            THEN custom_classes.nomenclature 
	                            ELSE class.name 
	                         END AS display_classname"),
	                'custom_classes.section'
	            );

	        if ($request->filled('class')) {
	            [$class_id, $section_id] = explode('-', $request->input('class'));
	            if (!empty($class_id)) {
	                $query->where('s.class_id', $class_id);
	            }
	            if (!empty($section_id)) {
	                $query->where('s.section_id', $section_id);
	            }
	        }


	        $tests      = $request->input('test', []);
	        $status     = $request->input('status');
	        $allTests   = [
	            'running', 'hopping', 'jumping_landing', 'one_foot_balance', 'skipping',
	            'dodging', 'beam_walk', 'catching_receiving_bounce', 'catching_small_ball',
	            'under_arm_throw', 'over_arm_throw', 'striking_drop_hit', 'dribbling_hands',
	            'dribbling_feet', 'kicking_ball', 'flamingo_balance', 'plate_tapping', 'bmi'
	        ];

	        if (!empty($status) && !empty($tests)) {
	            if (in_array('all', $tests)) {
	                $tests = $allTests;
	            }

	            $query->where(function ($q) use ($tests, $status) {
	                if ($status === 'complete') {
	                    foreach ($tests as $test) {
	                        $q->whereNotNull("r.$test");
	                    }
	                } elseif ($status === 'incomplete') {
	                    foreach ($tests as $test) {
	                        $q->orWhereNull("r.$test");
	                    }
	                }
	            });
	        }


	        $searchValue = $request->input('search.value');
	        if (!empty($searchValue)) {
			    $query->where(function ($q) use ($searchValue) {
			        $q->orWhere('s.student_name', 'LIKE', "%{$searchValue}%")
			          ->orWhere('s.rollno', 'LIKE', "%{$searchValue}%");
			    });
			}


	        $columns = [
	            0 => 'display_classname',
	            1=>  's.rollno',
	            2 => 's.student_name',
	            3 => 'r.running',
	            4 => 'r.hopping',
	            5 => 'r.jumping_landing',
	            6 => 'r.skipping',
	            7 => 'r.dodging',
	            8 => 'r.one_foot_balance',
	            9 => 'r.beam_walk',
	            10 => 'r.catching_receiving_bounce',
	            11 => 'r.catching_small_ball',
	            12 => 'r.under_arm_throw',
	            13 => 'r.over_arm_throw',
	            14 => 'r.striking_drop_hit',
	            15 => 'r.dribbling_hands',
	            16 => 'r.dribbling_feet',
	            17 => 'r.kicking_ball',
	            18 => 'r.flamingo_balance',
	            19 => 'r.plate_tapping',
	            20 => 'r.bmi',
	            21 => 'r.height',
	            22 => 'r.weight'
	        ];

	        if ($request->has('order.0.column')) {
	            $colIndex = $request->input('order.0.column');
	            $colDir   = $request->input('order.0.dir');

	            if (isset($columns[$colIndex])) {
	                $query->orderBy($columns[$colIndex], $colDir);
	            }
	        } else {
	            $query->orderBy('s.student_name', 'asc');
	        }

	        $recordsTotal = DB::table('students as s')
	            ->where('s.school_code', $school->school_code)
	            ->whereIn('s.class_id', $lowerClass)
	            ->count();

	        $draw = intval($request->input('draw'));
	        $studentlist = $query->skip($start)->take($length == -1 ? $recordsTotal : $length)->get();
	        $flattenedList = $studentlist->map(function ($item) use ($role_id) {

	           /* $view_link = $role_id == 3
	                ? route('trainer.reports.view', ['id' => Crypt::encryptString($item->id)])
	                : route('reports.view', ['id' => Crypt::encryptString($item->id)]);*/

	            $view_link = route('reports.view', ['id' => Crypt::encryptString($item->id)]);

	            return [
	                'id'            => $item->id,
	                'student_name'  => $item->student_name,
	                'class_name'    => $item->display_classname . '-' . $item->section,
	                'rollno'        => $item->rollno ?? 'N.A.',
	                'running'       => $item->running ?? '---',
	                'hopping'       => $item->hopping ?? '---',
	                'jumping_landing' => $item->jumping_landing ?? '---',
	                'one_foot_balance' => $item->one_foot_balance ?? '---',
	                'skipping'      => $item->skipping ?? '---',
	                'dodging'       => $item->dodging ?? '---',
	                'beam_walk'     => $item->beam_walk ?? '---',
	                'catching_receiving_bounce' => $item->catching_receiving_bounce ?? '---',
	                'catching_small_ball' => $item->catching_small_ball ?? '---',
	                'under_arm_throw' => $item->under_arm_throw ?? '---',
	                'over_arm_throw'  => $item->over_arm_throw ?? '---',
	                'striking_drop_hit' => $item->striking_drop_hit ?? '---',
	                'dribbling_hands' => $item->dribbling_hands ?? '---',
	                'dribbling_feet'  => $item->dribbling_feet ?? '---',
	                'kicking_ball'    => $item->kicking_ball ?? '---',
	                'flamingo_balance' => $item->flamingo_balance ?? '---',
	                'plate_tapping'   => $item->plate_tapping ?? '---',
	                'bmi'             => $item->bmi ?? '---',
	                'height'          => $item->height ?? '---',
	                'weight'          => $item->weight ?? '---',
	                'view_link'       => $view_link,
	            ];
	        });

	        return response()->json([
	            'draw'            => $draw,
	            'recordsTotal'    => $recordsTotal,
	            'recordsFiltered' => $recordsTotal,
	            'data'            => $flattenedList
	        ]);
	    }

	    $title = 'Fitness Test Status (Class 1 to 3)';
	    return view('reports.summary.lowerclass', compact('title', 'classList', 'ajaxUrl'));
	}



}
