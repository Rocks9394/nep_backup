<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\ReportHelperTrait;

use App\Jobs\MergeClassSectionPdfJob;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GenerateStudentReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable, ReportHelperTrait;

    public int $schoolId;
    public int $classId;
    public string $sectionId;
    public int $studentId;
    public int $termIds;
    public $timeout = 900;
    public $tries = 3;

    public $report_batch;

    public function __construct(int $schoolId, int $classId, string $sectionId, int $studentId, $report_batch, $termIds) {

        $this->schoolId = $schoolId;
        $this->classId = $classId;
        $this->sectionId = $sectionId;
        $this->studentId = $studentId;
        $this->report_batch = $report_batch;
        $this->termIds = $termIds;
    }

    public function handle() {

        ini_set('memory_limit', '512M');
        set_time_limit(600);

        $classFolder = $this->getClassFolderName($this->classId);
        $relativePath = "{$this->schoolId}/batch_{$this->report_batch}/{$classFolder}/section_{$this->sectionId}";
         // $relativePath = "{$this->schoolId}/batch_{$this->report_batch}/class_{$this->classId}/section_{$this->sectionId}";

        $disk = Storage::disk('reports');
        if (!$disk->exists($relativePath)) {
            $disk->makeDirectory($relativePath);
        }
        $tmpDir = $disk->path($relativePath);

        try {

            $pdfFile = $this->generateStudentPdfById($this->studentId, $tmpDir, $this->termIds);
            
            if (!$pdfFile || !file_exists($pdfFile)) {
                throw new \Exception("PDF generation failed for student {$this->studentId}");
            }

            \App\Models\ReportRequest::where('student_id', $this->studentId)
            ->update([
                'status' => 'generated',
                'file_path' => $relativePath . '/' . basename($pdfFile),
                'generated_at' => now(),
            ]);
            

        } catch (\Throwable $e) {

            \App\Models\ReportBatch::where('id', $this->report_batch)
            ->update([
                'status' => 'failed',
            ]);


            Log::error("GenerateStudentReportJob failed", [
                'student' => $this->studentId,
                'err' => $e->getMessage(),
                'batch_id' => $this->report_batch
            ]);
            throw $e;
        } 
    }

    protected function generateStudentPdfById($studentId, $batchDir, $termIds){
        
        $studentsData = $this->getStudentData($studentId);
        if (!$studentsData) return null;


        $TermMasterId = $this->getCurrentAndPreviousTermIds($studentsData->schools_id, (int) $termIds);
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

            [$orderedReportData, $getFitnessBenchmark] = $this->getSeniorReportData($studentId, $studentAge, $studentGender, $groupedReport);
            $pdf = Pdf::loadView('reports.fitness.pdf.senior-report', compact('studentsData','orderedReportData','getFitnessBenchmark','getBmiBenchmark'
            ));
        } else {
            [$orderedReportData, $FmsReportData, $getFitnessBenchmark] = $this->getJuniorReportData($studentsData->class_id, $studentId, $studentAge, $studentGender, $groupedReport, $TermMasterId 
            );
            $pdf = Pdf::loadView('reports.fitness.pdf.junior-report', compact('studentsData','orderedReportData','FmsReportData','getFitnessBenchmark','getBmiBenchmark'
            ));
        }

        $pdfFile = $batchDir . "/student_{$studentId}.pdf";
        $pdf->save($pdfFile);
        return $pdfFile;
    }
}
