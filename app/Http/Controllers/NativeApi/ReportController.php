<?php

namespace App\Http\Controllers\NativeApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Dompdf\Dompdf;
use PDF;
use DB;
use Illuminate\Support\Facades\Log;
use App\Traits\ReportHelperTrait;
use App\Models\TermMaster;

class ReportController extends Controller
{
 	use ReportHelperTrait;

    public function downloadFitnessReport(Request $request) {

		$studentId = Auth::guard('student-api')->user()->id;
        // return "hi";
        $studentsData = $this->getStudentData($studentId);
        if (!$studentsData) {
	        return response()->json(['status' => false, 'message' => 'Student not found'], 404);
	    }

	    $selectedTermId = $request->query('term_id') ?? TermMaster::where('school_id', $studentsData->schools_id) 
        ->where('is_active', 1)
        ->whereDate('term_start_date', '<=', today())
        ->whereDate('term_end_date', '>=', today())
        ->value('id');

		$TermMasterId = $this->getCurrentAndPreviousTermIds($studentsData->schools_id, (int) $selectedTermId);

        // Log::info('Term Master IDs fetched:', ['data' => $TermMasterId]);

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

        $getBmiBenchmark = $this->getBmiBenchmark($ageGender);

        if (in_array($studentsData->class_id, [4,5,6,7,8,9,10,11,12])) {
            [$orderedReportData, $getFitnessBenchmark] = $this->getSeniorReportData($studentId, $studentAge, $studentGender, $groupedReport );

            $pdf = Pdf::loadView('reports.fitness.pdf.senior-report', compact(
                'studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark'
            ));
        } else {

            [$orderedReportData, $FmsReportData, $getFitnessBenchmark] = $this->getJuniorReportData( $studentsData->class_id,
                $studentId, $studentAge, $studentGender, $groupedReport, $TermMasterId 
            );

            $pdf = Pdf::loadView('reports.fitness.pdf.junior-report', compact(
                'studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark'
            ));
        }

		$filename = 'Fitness_Report_Cards-'.date('d-m-Y_H-i-s').'.pdf';
		return $pdf->download($filename);
    }

    


}
