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
use App\Models\SkillBatch;
use App\Models\SkillReportRequest;
use App\Jobs\GenerateBulkSkillReportsJob;
use App\Models\TermMaster;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Cache;
use App\Services\ClassSectionService;

class ReportController extends Controller {
	
	use ReportHelperTrait;	

	protected $higherClasses;

    public function __construct() {	
   
        $this->middleware('auth:web')->except(['ViewFitnessReport', 'downloadFitnessReport']);
        $this->higherClasses = [4, 5, 6, 7, 8, 9, 10, 11, 12];
        $this->lowerClass = [1, 2, 3, 14,18,22,23];
    }
	
	/**
	 * Fitness Test Reports Module
	 * */

	public function FitnessReports(Request $request, DataTableListService $dataTable) {

		$title   = 'Assessment Report';
	    $userId  = Auth::id();
	    $schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');

		// Cache::forget("school_terms_{$schoolId}");
        // Cache::forget("school_current_term_{$schoolId}");
        $cacheKey = "school_current_term_{$schoolId}";
        $terms = Cache::remember($cacheKey,  60, function () use ($schoolId) {
		        return TermMaster::where('school_id', $schoolId)
		            ->where('is_active', 1)
		            ->get(['id', 'school_id', 'term_name', 'term_start_date', 'term_end_date']);
		    }
		);

		$current_term_id = collect($terms)
	    ->first(function ($term) {
	        return today()->between(
	            \Carbon\Carbon::parse($term->term_start_date),
	            \Carbon\Carbon::parse($term->term_end_date)
	        );
	    })['id'] ?? null;
	    

	    if (!$request->ajax()) {	    	
	        return view('reports.fitnessreports', compact('title','current_term_id'));
	    }

	    $term_id = $request->input('school-terms');
	    if(empty($term_id)){
	    	$term_id = $current_term_id;
	    }

	    /* Use DB-View (fitness_report_view) */
	    $query = DB::table('fitness_report_view')->where('school_id', $schoolId)->where('term_id', $term_id);
	    $filters = [

			'class' => function ($query, $value) {
                 $query->where('class_id', $value);
            },

            'section' => function ($query, $value) {
                 $query->where('section_id', $value);
            },

            'class-section' => function ($query, $value) {
                list($class_id, $section_id) = array_pad(explode('-', $value), 2, null);

                if (!empty($class_id)) {
                    $query->where('class_id', $class_id);
                }

                if (!empty($section_id)) {
                    $query->where('section_id', $section_id);
                }
            },

            'status' => function ($query, $value) {            	
	           if ($value === 'complete') {
			        $query->having('test_status', '=', 'Completed');
			    } elseif ($value === 'pending') {
			        $query->having('test_status', '=', 'Ongoing');
			    } elseif ($value === 'yet_to_start') {
			        $query->having('test_status', '=', 'Yet to Start');
			    }
	        },
        ];

        return $dataTable->setQuery($query)->setFilters($filters)

        ->setSearchableColumns(['student_name', 'admission_number'])
		->setSortableColumns([
	    	'display_classname' =>'class_order',
	        'section_id'        => 'section',
	        'rollno'            => 'rollno',
	        'student_name'      => 'student_name',
	        'admission_number'   => 'admission_number',
	        'gender'            => 'gender',
	    ])

        ->addCustomColumn('testStatus', function ($row) {
            $color = match ($row->test_status) {
                'Completed'    => 'bg-success text-light',
                'Ongoing'      => 'bg-warning text-light',
                'Yet to Start' => 'bg-secondary text-light',
                default        => 'bg-secondary text-light',
            };

            return "<span class='badge {$color} p-2'>{$row->test_status}</span>";
        })

        ->addCustomColumn('viewReport', function ($row) {
            $id  = Crypt::encryptString($row->student_id);
            $url = route('reports.view.test', ['id' => $id, 'term_id' => $row->term_id]);
			$html = "<a href='{$url}' target='_blank'>View</a>";
			
			// for heal and activity record (cbse)
			// if ($row->school_id == 15 && ($row->class_id >= 9 && $row->class_id <= 12)) {
			// 	$cbsceUrl = route('reports.cbse', ['id' => $id]);
			// 	$html .= "<br><a href='{$cbsceUrl}' target='_blank'>HRA</a>";
			// }
            return $html;
        })

        ->addCustomColumn('downloadReport', function ($row) {
            $id  = Crypt::encryptString($row->student_id);
            $url = route('download.fitness.reports', ['id' => $id, 'term_id' => $row->term_id]);
            return "<a href='{$url}' class='btn btn-sm btn-primary'>  <i class='fa-solid fa-download'></i> </a>";
        })
        ->render($request);
	}


	/**
	 * View Individual Reports
	 * */
    public function ViewFitnessReport($id=null, $term_id=null) {
		
		if($id){
			$studentId = Crypt::decryptString($id);
		}else{
			$studentId = Auth::guard('sstudent')->user()->id;
		}

	    $studentsData = $this->getStudentData($studentId);

	    if (!empty($term_id)) {
	        $termIds = $this->getCurrentAndPreviousTermIds($studentsData->schools_id, (int) $term_id);
	    } else {
			$selectedTermId = $this->getTermId($studentsData->schools_id);

			$termIds = $this->getCurrentAndPreviousTermIds($studentsData->schools_id, (int) $selectedTermId);
	    }

		// echo"<pre>";print_r($termIds);
	   
	    $currentTermId  = $termIds[0] ?? null;
		$previousTermId = $termIds[1] ?? null;
       

 	    $dob          = Carbon::parse($studentsData->dob);
	    $studentAge   = $dob->age;
	    $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';
	    $ageGender    = $studentAge . strtolower(substr($studentsData->gender, 0, 1));

	    // Fetch report + benchmarks
	    $reportData = $this->getReportData($studentId, $termIds);
	    $mappedReport  = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);
	    $groupedReport = $mappedReport->groupBy('Category')
	    ->map(function ($items) use ($currentTermId, $previousTermId) {
	        return $items
	            ->filter(fn ($row) =>
	                in_array((int) $row['TermId'], [$currentTermId, $previousTermId])
	            )
	            ->groupBy(fn ($row) =>
	                (int) $row['TermId'] === (int) $currentTermId
	                    ? 'Current_Term'
	                    : 'Previous_Term'
	            );
	    });

		$getBmiBenchmark = $getBmiBenchmark =  $this->getBmiBenchmark($ageGender);

	    if (in_array($studentsData->class_id, $this->higherClasses)) {

			[$orderedReportData, $getFitnessBenchmark] = $this->getSeniorReportData($studentId, $studentAge, $studentGender, $groupedReport);
			return view('reports.fitness.html.senior-report', compact('studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark'));
	    } else {

	    	[$orderedReportData, $FmsReportData, $getFitnessBenchmark] =
            $this->getJuniorReportData($studentsData->class_id, $studentId, $studentAge, $studentGender, $groupedReport, $termIds);
			return view('reports.fitness.html.junior-report', compact('studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark'));
	    }
	}


	public function downloadFitnessReport($id = null, $term_id = null) {

		if($id){
			$studentId = Crypt::decryptString($id);
		}else{
			$studentId = Auth::guard('sstudent')->user()->id;
		}
        
        $studentsData = $this->getStudentData($studentId);
        if (!$studentsData) return null;

      
        if (!empty($term_id)) {
	        $TermMasterId = $this->getCurrentAndPreviousTermIds($studentsData->schools_id, (int) $term_id);
	    } else {
	        $selectedTermId = $this->getTermId($studentsData->schools_id);

			$TermMasterId = $this->getCurrentAndPreviousTermIds($studentsData->schools_id, (int) $selectedTermId);
	    }

	    $currentTermId  = $TermMasterId[0] ?? null;
		$previousTermId = $TermMasterId[1] ?? null;


        $dob = \Carbon\Carbon::parse($studentsData->dob);
        $studentAge = $dob->age;
        $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';
        $ageGender = $studentAge . strtolower(substr($studentsData->gender,0,1));

        $reportData = $this->getReportData($studentId, $TermMasterId);
        $mappedReport = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);
        $groupedReport = $mappedReport->groupBy('Category')
	    ->map(function ($items) use ($currentTermId, $previousTermId) {
	        return $items
	            ->filter(fn ($row) =>
	                in_array((int) $row['TermId'], [$currentTermId, $previousTermId])
	            )
	            ->groupBy(fn ($row) =>
	                (int) $row['TermId'] === (int) $currentTermId
	                    ? 'Current_Term'
	                    : 'Previous_Term'
	            );
	    });
		$firstName = strtolower(trim(explode(' ', $studentsData->student_name)[0]));
        $plainPassword = $firstName . '@' . trim($studentsData->admissionnumber);
        $isLetterHead = true;

        $getBmiBenchmark = $this->getBmiBenchmark($ageGender);

        if (in_array($studentsData->class_id, [4,5,6,7,8,9,10,11,12])) {
            [$orderedReportData, $getFitnessBenchmark] = $this->getSeniorReportData($studentId, $studentAge, $studentGender, $groupedReport );

            // $pdf = Pdf::loadView('reports.fitness.pdf.senior-report', compact(
            //     'studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark'
            // ));
			$pdf = Pdf::loadView('reports.fitness.pdf.one-page-senior', compact(
                    'studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark','isLetterHead','plainPassword'
                ));
        } else {

            [$orderedReportData, $FmsReportData, $getFitnessBenchmark] = $this->getJuniorReportData( $studentsData->class_id,
                $studentId, $studentAge, $studentGender, $groupedReport, $TermMasterId 
            );

            // $pdf = Pdf::loadView('reports.fitness.pdf.junior-report', compact(
            //     'studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark'
            // ));
			$pdf = Pdf::loadView('reports.fitness.pdf.one-page-junior', compact(
                'studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark','isLetterHead','plainPassword'
            ));
        }

		$filename = 'Fitness_Report_Cards-'.date('d-m-Y_H-i-s').'.pdf';
		return $pdf->stream($filename);
		return $pdf->download($filename);
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

			$reportType = $request->input('reportType');
            $studentIds = $request->input('student_ids', []);
            $termIds = $request->input('termIds', []);
            $termId  = $termIds[0] ?? null;


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

            GenerateSchoolReportsMasterJob::dispatch($schoolId, $studentIds, $report_batch->id, $termId, $reportType)->onQueue('report_generation');
            return response()->json([
                'status' => 'queued',
                'message' => 'Your report card request has been submitted and is being processed. Please return to this page later. Once the report is ready, it will appear under Available Downloads.'
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
	    	->select('total_students','completed_students','status','download_path','created_at','expires_at')->orderBy('created_at','desc')
	    	->get();

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

        if ($batch->expires_at && now()->greaterThan($batch->expires_at)) {
	        abort(410, 'This report has expired and is no longer available.');
	    }

        $relativePath = $batch->final_zip_path;
        $disk = Storage::disk('reports');

        if (! $relativePath || ! $disk->exists($relativePath)) {
	        abort(404, 'Report file not found.');
	    }

        $generatedAt = $batch->generated_at ? \Carbon\Carbon::parse($batch->generated_at) : \Carbon\Carbon::parse($batch->created_at);
	    $downloadFileName = sprintf('Fitness_Report_Cards_%s.zip', $generatedAt->format('d-m-Y_H-i-s'));

        return $disk->download($relativePath, $downloadFileName);
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

		$TermMasterId = $this->getTermId($schoolId);

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$today = Carbon::today()->toDateString();
		if ($month < 4 || ($month == 3 && $day <= 31)) {
			$academicYear = ($year - 1) . '-' . $year;
		}

		$terms = TermMaster::where('school_id', $schoolId)
            ->where('is_active', 1)
            ->where('academic_year', $academicYear)
			->get();
			
		$filteredTerms = $terms->map(function($term) {
			$term->name = $term->term_name;
			return $term;
		});
		
        $ajaxUrl = route('trainer.higherclass.status');

        $school = School::find($schoolId);
		$higherClass = $this->higherClasses;

		$classList = $school->getClasses
			->filter(function ($class) use ($higherClass) {
		        return in_array($class->class_id, $higherClass);
		    })
			->map(function ($class) {
	        $originalClass = Sclass::where('id', $class->class_id)
	            ->orderBy('orders')
	            ->first();

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
			if ($request->input('term')) {
		        $selectedTerm = $request->input('term');
		        if (!empty($selectedTerm)) {
					$TermMasterId = $selectedTerm;
		        }
		    }
		
            $query = DB::table('students as s')
		        ->leftJoin('SeniorTestResultsSummary as r', function ($join) use ($TermMasterId) {
					$join->on('s.id', '=', 'r.student_id')
						->where('r.term_id', '=', $TermMasterId);
					})
		        ->leftJoin('class', 's.class_id', '=', 'class.id')
				->leftJoin('custom_classes', 's.custom_class_id', '=', 'custom_classes.id')
			        ->select( 's.id', 's.dob', 's.student_name', 's.rollno' ,'r.sit_and_reach', 'r.run_600m', 'r.pushups', 'r.dash_50m',  'r.curlup',  'r.bmi', 'r.height', 'r.weight', 's.class_id','s.section_id',
			             DB::raw("CASE 
							WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
							THEN custom_classes.nomenclature 
							ELSE class.name 
						 END AS display_classname"),
					'custom_classes.section'
	            )
			    ->whereIn('class.id', $higherClass)		
				->where('s.status', 'active')      
		        ->where('s.school_code', $school->school_code)
				->orderBy('s.class_id')
				->orderBy('s.section_id');
		      

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
	                'rollno'		 => 's.rollno',
					'age'   		 => 's.dob',
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
			$recordsFiltered = (clone $query)->count();
        	$studentlist = $query->skip($start)
            ->take($length == -1 ? $recordsTotal : $length)->get();
	
	        $flattenedList = $studentlist->map(function ($item) use ($role_id, $TermMasterId) {

	        	$view_link = route('reports.view.test', ['id' => Crypt::encryptString($item->id), 'term_id' => $TermMasterId]);

				$age = \Carbon\Carbon::parse($item->dob)->age;
				$isValid = $this->isValidAge($item->class_id, $age);

				$studentAge = $isValid ? $age : $age;

	            return [
	                'id' => $item->id,
	                'student_name' => $item->student_name,					
					'age'			=> $studentAge,
					'invalid_age' => $isValid ? 0 : 1, 
	           		'class_name' => $item->display_classname.'-'. $item->section,
	           		'rollno' => $item->rollno ?? 'N.A.',
	                'sit_and_reach' => isset($item->sit_and_reach) ? (int)$item->sit_and_reach / 10 : '---',
	                'run_600m' => is_numeric($item->run_600m)
									? sprintf(
										'%02d:%02d.%02d',
										floor((int)$item->run_600m / 60000),
										floor(((int)$item->run_600m % 60000) / 1000),
										floor(((int)$item->run_600m % 1000) / 10)
									)
									: '---',
	                'pushups' => isset($item->pushups) ? (int)$item->pushups : '---',
	                'dash_50m' => is_numeric($item->dash_50m)
									? sprintf(
										'%02d:%02d.%02d',
										floor((int)$item->dash_50m / 60000),
										floor(((int)$item->dash_50m % 60000) / 1000),
										floor(((int)$item->dash_50m % 1000) / 10)
									)
									: '---',
	                'curlup' => isset($item->curlup) ? (int)$item->curlup : '---',
	                'bmi' => $item->bmi ?? '---',
	                'height' => $item->height ?? '---',
	                'weight' => $item->weight ?? '---',	                
	                'view_link' => $view_link,
	            ];
	        });

            return response()->json([
	            'draw' => intval($draw),
	            'recordsTotal' => $recordsTotal,
	            'recordsFiltered' => $recordsFiltered,
	            'data' => $flattenedList
	        ]);
        }

       	$title = 'Fitness Test Summary (Class 4 to 12)';
        return view('reports.summary.higherclass', compact('title','classList','ajaxUrl','filteredTerms','TermMasterId'));
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

		$TermMasterId = $this->getTermId($schoolId);

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$today = Carbon::today()->toDateString();
		if ($month < 4 || ($month == 3 && $day <= 31)) {
			$academicYear = ($year - 1) . '-' . $year;
		}

		$terms = TermMaster::where('school_id', $schoolId)
            ->where('is_active', 1)
            ->where('academic_year', $academicYear)
			->get();
			
		$filteredTerms = $terms->map(function($term) {
			$term->name = $term->term_name;
			return $term;
		});

	    $ajaxUrl = route('trainer.lowerclass.status');


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

			if ($request->input('term')) {
		        $selectedTerm = $request->input('term');
		        if (!empty($selectedTerm)) {
		            $TermMasterId = $selectedTerm;
		        }
		    }


	        $query = DB::table('students as s')
	            ->leftJoin('LowerTestResultsSummary as r', function ($join) use ($TermMasterId) {
					$join->on('s.id', '=', 'r.student_id')
						->where('r.term_id', '=', $TermMasterId);
				})
	            ->leftJoin('class', 's.class_id', '=', 'class.id')
	            ->leftJoin('custom_classes', 's.custom_class_id', '=', 'custom_classes.id')
	            ->where('s.school_code', $school->school_code)
				->where('s.status', 'active')
	            ->whereIn('class.id', $lowerClass)
	            ->select(
	                's.id',
					's.dob',
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
	            )
				->orderBy('s.class_id')
				->orderBy('s.section_id');

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

	        $applicableTestsByClass = [
				14 => ['running', 'jumping_landing', 'one_foot_balance', 'catching_receiving_bounce', 'beam_walk'],
				18 => ['running', 'one_foot_balance', 'beam_walk'],
				22 => ['running', 'jumping_landing', 'hopping', 'catching_receiving_bounce', 'dribbling_hands', 'one_foot_balance', 'beam_walk'],
				23 => ['running', 'jumping_landing', 'hopping', 'catching_receiving_bounce', 'dribbling_hands', 'kicking_ball', 'skipping', 'under_arm_throw', 'one_foot_balance', 'beam_walk'],
			];


	        if (!empty($status) && !empty($tests)) {

				if (in_array('all', $tests)) {
					$tests = $allTests;
				}

				$query->where(function ($q) use ($tests, $status, $applicableTestsByClass) {

					$q->where(function ($q2) use ($tests, $status, $applicableTestsByClass) {

						$q2->whereNotIn('s.class_id', [14, 18, 22, 23])
						->where(function ($q3) use ($tests, $status) {
								foreach ($tests as $test) {
									$status === 'complete'
										? $q3->whereNotNull("r.$test")
										: $q3->orWhereNull("r.$test");
								}
						});
					});

					foreach ($applicableTestsByClass as $classId => $applicableTests) {

						$filteredTests = array_intersect($tests, $applicableTests);

						if (empty($filteredTests)) {
							continue;
						}

						$q->orWhere(function ($q2) use ($classId, $filteredTests, $status) {
							$q2->where('s.class_id', $classId)
							->where(function ($q3) use ($filteredTests, $status) {
									foreach ($filteredTests as $test) {
										$status === 'complete'
											? $q3->whereNotNull("r.$test")
											: $q3->orWhereNull("r.$test");
									}
							});
						});
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
	            22 => 'r.weight',
				23 => 's.dob'
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
			$recordsFiltered = (clone $query)->count();
	        $studentlist = $query->skip($start)->take($length == -1 ? $recordsTotal : $length)->get();

	        $flattenedList = $studentlist->map(function ($item) use ($role_id, $TermMasterId) {
				
				$view_link = route('reports.view.test', ['id' => Crypt::encryptString($item->id), 'term_id' => $TermMasterId]);
				
				$age = \Carbon\Carbon::parse($item->dob)->age;

				$isValid = $this->isValidAge($item->class_id, $age);

				$studentAge = $isValid ? $age : $age;

	            return [
	                'id'            => $item->id,
	                'student_name'  => $item->student_name,
					'age'			=> $studentAge,
					'invalid_age' => $isValid ? 0 : 1, 
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
	                'flamingo_balance' => !isset($item->flamingo_balance) 
											? '---' 
											: ((int)$item->flamingo_balance === 1000 
												? 'Disqualified' 
												: (int)$item->flamingo_balance),
	                'plate_tapping'   => is_numeric($item->plate_tapping)
										? sprintf(
											'%02d:%02d.%02d',
											floor((int)$item->plate_tapping / 60000),
											floor(((int)$item->plate_tapping % 60000) / 1000),
											floor(((int)$item->plate_tapping % 1000) / 10)
										)
										: '---',
	                'bmi'             => $item->bmi ?? '---',
	                'height'          => $item->height ?? '---',
	                'weight'          => $item->weight ?? '---',
	                'view_link'       => $view_link,
	            ];
	        });

	        return response()->json([
	            'draw'            => $draw,
	            'recordsTotal'    => $recordsTotal,
	            'recordsFiltered' => $recordsFiltered,
	            'data'            => $flattenedList
	        ]);
	    }

	    $title = 'Fitness Test Summary (Class 1 to 3)';
	    return view('reports.summary.lowerclass', compact('title', 'classList', 'ajaxUrl','filteredTerms','TermMasterId'));
	}


	// for cbse report card 
	
	public function ViewCbseReport($id){

		$studentId = Crypt::decryptString($id);
	    $studentsData = $this->getStudentData($studentId);

		$termIds = [$this->getTermId($studentsData->schools_id)];

		$currentTermId  = $termIds[0] ?? null;
		$previousTermId = $termIds[1] ?? null;
       

 	    $dob          = Carbon::parse($studentsData->dob);
	    $studentAge   = $dob->age;
	    $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';
	    $ageGender    = $studentAge . strtolower(substr($studentsData->gender, 0, 1));

	    // Fetch report + benchmarks
	    $reportData = $this->getReportData($studentId, $termIds);
	    $mappedReport  = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);
	    $groupedReport = $mappedReport->groupBy('Category')
	    ->map(function ($items) use ($currentTermId, $previousTermId) {
	        return $items
	            ->filter(fn ($row) =>
	                in_array((int) $row['TermId'], [$currentTermId, $previousTermId])
	            )
	            ->groupBy(fn ($row) =>
	                (int) $row['TermId'] === (int) $currentTermId
	                    ? 'Current_Term'
	                    : 'Previous_Term'
	            );
	    });
		
		$classes = [9,10,11,12];

		return view('reports.fitness.html.cbse-report', compact('studentsData','groupedReport','classes'));
	}

	public function downloadCbseReport($id){

		$studentId = Crypt::decryptString($id);
	    $studentsData = $this->getStudentData($studentId);

		$termIds = [$this->getTermId($studentsData->schools_id)];

		$currentTermId  = $termIds[0] ?? null;
		$previousTermId = $termIds[1] ?? null;
       

 	    $dob          = Carbon::parse($studentsData->dob);
	    $studentAge   = $dob->age;
	    $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';
	    $ageGender    = $studentAge . strtolower(substr($studentsData->gender, 0, 1));

	    // Fetch report + benchmarks
	    $reportData = $this->getReportData($studentId, $termIds);
	    $mappedReport  = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);
	    $groupedReport = $mappedReport->groupBy('Category')
	    ->map(function ($items) use ($currentTermId, $previousTermId) {
	        return $items
	            ->filter(fn ($row) =>
	                in_array((int) $row['TermId'], [$currentTermId, $previousTermId])
	            )
	            ->groupBy(fn ($row) =>
	                (int) $row['TermId'] === (int) $currentTermId
	                    ? 'Current_Term'
	                    : 'Previous_Term'
	            );
	    });
		
		$classes = [9,10,11,12];

		$pdf = Pdf::loadView('reports.fitness.pdf.cbse-report', compact('studentsData','groupedReport','classes'));
		$filename = 'CBSE_Report_Card'.'.pdf';
		return $pdf->download($filename);

		// return view('reports.fitness.html.cbse-report', compact('studentsData','groupedReport','classes'));
	}

	private function isValidAge($class, $age){

		$classDetails = DB::table('class')->where('id', $class)->first();

		if (!$classDetails) {
			return false; 
		}

		$minAge = $classDetails->min_age;
		$maxAge = $classDetails->max_age;

		return ($age >= $minAge && $age <= $maxAge);
	}


	private function getTermRange($termId){
		return DB::table('term_masters')
			->where('id', $termId)
			->select('term_start_date', 'term_end_date')
			->first();
	}

	/**
	 * for skill reports 10/02/2026
	 * **/

	public function SkillReports(Request $request, DataTableListService $dataTable) {

		$title   = 'Skill Report';
	    $userId  = Auth::id();

		if(Auth::user()->role_id == 3){
			if(Session::get('SelectSchoolId')){	
				$schoolId = Session::get('SelectSchoolId');	
			}else{
				$schoolId = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->value('school_id');
			}
		}else{
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		}

		// Cache::forget("school_terms_{$schoolId}");
        // Cache::forget("school_current_term_{$schoolId}");
        $cacheKey = "school_current_term_{$schoolId}";
        $terms = Cache::remember($cacheKey,  60, function () use ($schoolId) {
		        return TermMaster::where('school_id', $schoolId)
		            ->where('is_active', 1)
		            ->get(['id', 'school_id', 'term_name', 'term_start_date', 'term_end_date']);
		    }
		);

		$current_term_id = collect($terms)
	    ->first(function ($term) {
	        return today()->between(
	            \Carbon\Carbon::parse($term->term_start_date),
	            \Carbon\Carbon::parse($term->term_end_date)
	        );
	    })['id'] ?? null;
	    

	    if (!$request->ajax()) {	    	
	        return view('reports.skillreports', compact('title','current_term_id'));
	    }

	    $term_id = $request->input('school-terms');
	    if(empty($term_id)){
	    	$term_id = $current_term_id;
	    }

	    /* Use DB-View (fitness_report_view) */
	    $query = DB::table('fitness_report_view')
		->select(
			'student_id',
			'term_id',
			'display_classname',
			'class_id',
			'section_id',
			'rollno',
			'student_name',
			'admission_number',
			'gender',
			'dob',
		)->where('school_id', $schoolId)->where('term_id', $term_id);
	    $filters = [

			'class' => function ($query, $value) {
                 $query->where('class_id', $value);
            },

            'section' => function ($query, $value) {
                 $query->where('section_id', $value);
            },

            'class-section' => function ($query, $value) {
                list($class_id, $section_id) = array_pad(explode('-', $value), 2, null);

                if (!empty($class_id)) {
                    $query->where('class_id', $class_id);
                }

                if (!empty($section_id)) {
                    $query->where('section_id', $section_id);
                }
            },
        ];

        return $dataTable->setQuery($query)->setFilters($filters)

        ->setSearchableColumns(['student_name', 'admission_number'])
		->setSortableColumns([
	    	'display_classname' =>'class_order',
	        'section_id'        => 'section',
	        'rollno'            => 'rollno',
	        'student_name'      => 'student_name',
	        'admission_number'   => 'admission_number',
	        'gender'            => 'gender',
	    ])

        ->addCustomColumn('viewReport', function ($row) {
            $id  = Crypt::encryptString($row->student_id);
            $url = route('view.skill.report', ['id' => $id, 'term_id' => $row->term_id]);
			$html = "<a href='{$url}' target='_blank'>View</a>";
            return $html;
        })

        ->addCustomColumn('downloadReport', function ($row) {
            $id  = Crypt::encryptString($row->student_id);
            $url = route('view.skill.report', ['id' => $id, 'term_id' => $row->term_id, 'download' => true]);
            return "<a href='{$url}' class='btn btn-sm btn-primary'>  <i class='fa-solid fa-download'></i> </a>";
        })
        ->render($request);
	}


	public function ViewSkillReport(Request $request){

		$userId = Auth::id();

		if ($request->id) {
			$studentId = Crypt::decryptString($request->id);
		} else {
			$studentId = Auth::guard('sstudent')->user()->id;
		}

		if(Auth::user()->role_id == 3){
			if(Session::get('SelectSchoolId')){	
				$schoolId = Session::get('SelectSchoolId');	
			}else{
				$schoolId = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->value('school_id');
			}
		}else{
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		}

		$school = DB::table('schools')->where('id', $schoolId)->first();

		$termId = $request->term_id ?? $this->getTermId($schoolId);
		$termRange = $this->getTermRange($termId);

		$student = DB::table('students')
			->join('custom_classes', 'custom_classes.id', '=', 'students.custom_class_id')
			->join('class', 'class.id', '=', 'students.class_id')
			->select(
				'students.student_name',
				'students.gender',
				'students.dob',
				'students.rollno',
				'students.student_uid',
				'students.email_id',
				'class.name as classname',
				'custom_classes.section'
			)
			->where('students.id', $studentId)
			->first();

		$getReportData = DB::table('reports')
			->select(
				'reports.skill_area_id',
				'skillareas.name as skillname',

				'reports.skill_sports_id',
				'sports.name as sportsskillname',

				'activity.title',
				'activity.learning_outcomes',

				'techniques.name as techniques_name',

				'levels.level_name',
				'levels.orders as rating',
				'levels.description as descriptions'
			)
			->join('skillareas', 'skillareas.id', '=', 'reports.skill_area_id')
			->join('sports', 'sports.id', '=', 'reports.skill_sports_id')
			->join('activity', 'activity.id', '=', 'reports.activity_id')
			->join('techniques', 'techniques.id', '=', 'reports.technique_id')
			->join('levels', 'levels.id', '=', 'reports.level')
			->where('reports.student_id', $studentId)
			->whereBetween('reports.date', [
				$termRange->term_start_date,
				$termRange->term_end_date
			])
			->orderBy('skillareas.name')
			->orderBy('sports.name')
			->get();

			$getSkills = $getReportData
			->groupBy('skillname') // First level
			->map(function ($skillGroup) {
				return $skillGroup->groupBy('sportsskillname'); // Second level
			});



		// echo"<pre>";print_r($getSkills);exit();

		$data = compact('student', 'school', 'getReportData', 'getSkills', 'termId');

		if ($request->boolean('download')) {

			$pdf = Pdf::loadView('reports.skills.skill-reports-pdf', $data);

			$fileName = 'Skill_Report_' . $student->student_name . '.pdf';

			// return $pdf->stream($fileName);

			return $pdf->download($fileName);
		}

		return view('reports.skills.skill-reports', $data);
	}

	// bulk skill reports download 
	public function queueBulkSkillReportCards(Request $request) {
		try {
            
            $userId = Auth::id();

            if(Auth::user()->role_id == 3){
				if(Session::get('SelectSchoolId')){	
					$schoolId = Session::get('SelectSchoolId');	
				}else{
					$schoolId = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->value('school_id');
				}
			}else{
				$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
			}
            if (!$schoolId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No school found for the current user.'
                ], 400);
            }

            $studentIds = $request->input('student_ids', []);
            $termId = $request->term_id ?? $this->getTermId($schoolId);


            if (empty($studentIds)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No student IDs provided.'
                ], 400);
            }

            $report_batch = SkillBatch::create([
			    'school_id' => $schoolId,
			    'status' => 'pending',
			]);

            foreach ($studentIds as $studentId) {            	
			    SkillReportRequest::updateOrCreate(
			        ['student_id' => $studentId],
			        [
			            'school_id' => $schoolId,
			            'batch_id' => $report_batch->id,
			            'status' => 'requested',
			            'requested_at' => now(),
			        ]
			    );
			}			

            GenerateBulkSkillReportsJob::dispatch($schoolId, $studentIds, $report_batch->id, $termId)->onQueue('report_generation');
            return response()->json([
                'status' => 'queued',
                'message' => 'Your report card request has been submitted and is being processed. Please return to this page later. Once the report is ready, it will appear under Available Downloads.'
            ]);

        } catch (\Throwable $e) {
            Log::error("Failed to queue report generation", ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while starting report generation.'
            ], 500);
        }
	}

	public function CheckSkillReportAvailablity() {

		$userId = Auth::id();
        
		if(Auth::user()->role_id == 3){
			if(Session::get('SelectSchoolId')){	
				$schoolId = Session::get('SelectSchoolId');	
			}else{
				$schoolId = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->value('school_id');
			}
		}else{
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		}
		
		$reports = DB::table('skill_batches')
	    	->where('school_id', $schoolId)
	    	->select('id', 'total_students','completed_students','status','download_path','created_at','expires_at')->orderBy('created_at','desc')
	    	->get();

	    if ($reports->isEmpty()) {
	        return response()->json([
	            'html' => '<p class="text-center text-muted">No report requests found.</p>'
	        ]);
	    }
		$type = 'skill';

	    $html = view('reports.modals.available-report-cards', compact('reports', 'type'))->render();
	    return response()->json(['html' => $html]);
	}

	public function SkillReportsDownload($id){

		$report = SkillBatch::findOrFail($id);

		return Storage::disk('public')->download($report->download_path);

	}


}
