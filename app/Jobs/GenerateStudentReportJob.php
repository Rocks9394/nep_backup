<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\ReportHelperTrait;

use App\Jobs\MergeClassSectionPdfJob;
use Intervention\Image\Facades\Image;

class GenerateStudentReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable, ReportHelperTrait;

    public int $schoolId;
    public int $classId;
    public string $sectionId;
    public int $studentId;
    public $timeout = 900;
    public $tries = 3;

    public $report_batch;

    public function __construct(int $schoolId, int $classId, string $sectionId, int $studentId, $report_batch)
    {
        $this->schoolId = $schoolId;
        $this->classId = $classId;
        $this->sectionId = $sectionId;
        $this->studentId = $studentId;
        $this->report_batch = $report_batch;
    }

    public function handle() {


        ini_set('memory_limit', '512M');
        set_time_limit(600);

        $tmpDir = storage_path("app/reports/{$this->schoolId}/batch_{$this->report_batch}/class_{$this->classId}/section_{$this->sectionId}");
        if (!is_dir($tmpDir)) mkdir($tmpDir, 0755, true);

        try {

            $pdfFile = $this->generateStudentPdfById($this->studentId, $tmpDir);

             \App\Models\ReportRequest::where('student_id', $this->studentId)
            ->update([
                'status' => 'generated',
                'file_path' => $pdfFile,
                'generated_at' => now(),
            ]);
            

        } catch (\Throwable $e) {
            Log::error("GenerateStudentReportJob failed", [
                'student' => $this->studentId,
                'err' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    protected function generateStudentPdfById($studentId, $batchDir){
        
        $studentsData = $this->getStudentData($studentId);
        if (!$studentsData) return null;

        $TermMasterId = $this->getTermId($studentsData->schools_id);

        $dob = \Carbon\Carbon::parse($studentsData->dob);
        $studentAge = $dob->age;
        $studentGender = strtolower($studentsData->gender) === 'male' ? 'Boys' : 'Girls';
        $ageGender = $studentAge . strtolower(substr($studentsData->gender,0,1));

        $reportData = $this->getReportData($studentId);
        $mappedReport = $this->mapReportData($reportData, $studentAge, $studentGender, $ageGender);
        $groupedReport = $mappedReport->groupBy('Category');
        $getBmiBenchmark = $this->getBmiBenchmark($ageGender);

        if (in_array($studentsData->class_id, [4,5,6,7,8,9,10,11,12])) {
            [$orderedReportData, $getFitnessBenchmark] = $this->getSeniorReportData(
                $studentId, $studentAge, $studentGender, $groupedReport
            );
            $pdf = Pdf::loadView('reports.fitness.senior-report', compact(
                'studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark'
            ));
        } else {
            [$orderedReportData, $FmsReportData, $getFitnessBenchmark] = $this->getJuniorReportData($classId = null,
                $studentId, $studentAge, $studentGender, $groupedReport, $TermMasterId // <-- pass TermMasterId
            );
            $pdf = Pdf::loadView('reports.fitness.junior-report', compact(
                'studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark'
            ));
        }

        $pdfFile = $batchDir . "/student_{$studentId}.pdf";
        $pdf->save($pdfFile);
        return $pdfFile;
    }
}
