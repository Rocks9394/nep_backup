<?php

namespace App\Http\Controllers\NativeApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Dompdf\Dompdf;
use PDF;
use DB;

use App\Traits\ReportHelperTrait;

class ReportController extends Controller
{
 	use ReportHelperTrait;

    public function downloadFitnessReport($id = null, $term_id = null) {

		if($id){
			$studentId = Crypt::decryptString($id);
		}else{
			$studentId = Auth::guard('student-api')->user()->id;
		}
        
        $studentsData = $this->getStudentData($studentId);
        if (!$studentsData) {
	        return response()->json(['status' => false, 'message' => 'Student not found'], 404);
	    }

        
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
