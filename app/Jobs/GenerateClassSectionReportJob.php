<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\ReportHelperTrait;

use App\Jobs\MergeClassSectionPdfJob;
use Intervention\Image\Facades\Image;

use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batch;

use App\Jobs\DummyJob;
class GenerateClassSectionReportJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels, InteractsWithQueue, Batchable, ReportHelperTrait;

    public int $schoolId;
    public int $classId;
    public string $section;
    public array $studentIds;
    public int $report_batch;
    public int $termIds;
    public string $reportType;
    public $timeout = 1800;
    public $tries = 3;

    
    public function __construct(int $schoolId, int $classId, string $section, array $studentIds, int $report_batch, int $termIds, string $reportType) {

        $this->schoolId = $schoolId;
        $this->classId = $classId;
        $this->section = $section;
        $this->studentIds = $studentIds;
        $this->report_batch = $report_batch;
        $this->termIds = $termIds;
        $this->reportType = $reportType;
    }

    public function handle() {

        $jobs = [];

        foreach (array_chunk($this->studentIds, 100) as $chunk) {
            foreach ($chunk as $studentId) {
                $jobs[] = new GenerateStudentReportJob(
                    $this->schoolId,
                    $this->classId,
                    $this->section,
                    (int) $studentId,
                    $this->report_batch,
                    $this->termIds,
                    $this->reportType
                );
            }
        }

        $schoolId = $this->schoolId;
        $classId = $this->classId;
        $section = $this->section;
        $report_batch_id =  $this->report_batch;

        Bus::batch($jobs)
            ->name("generate_report_card")
            ->then(function (Batch $batch) use ($schoolId, $classId, $section, $report_batch_id) {               
                MergeClassSectionPdfJob::dispatch($schoolId, $classId, $section, $report_batch_id)->onQueue('report_generation');
            })
            ->catch(function (Batch $batch, Throwable $e) {
                Log::error("Batch failed", [
                    'batch_id' => $batch->id,
                    'error' => $e->getMessage()
                ]);
            })
            ->onQueue('report_generation')
            ->dispatch();

        // return response()->json(['batch_id' => $batch->id]);
    }
}
