<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batch;
use App\Jobs\GenerateClassSectionReportJob;
use App\Jobs\MergeClassSectionPdfJob;

class GenerateSchoolReportsMasterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $schoolId;
    public array $studentIds;
    public int $report_batch;

    public $timeout = 3600;
    public $tries = 3;

    public function __construct(int $schoolId, array $studentIds = [], $report_batch) {
        $this->schoolId = $schoolId;
        $this->studentIds = $studentIds;
        $this->report_batch = $report_batch;
    }


    public function handle() {

        
        $students = DB::table('students')->where('school_id', $this->schoolId)->where('status', 'active')
            ->select('id', 'class_id', 'section_id')
            ->when(!empty($this->studentIds), fn($q) => $q->whereIn('id', $this->studentIds))
            ->get();


        if ($students->isEmpty()) {
            Log::warning("No students found", ['school_id' => $this->schoolId]);
            return;
        }

        $classSections = [];
        foreach ($students as $s) {
            $classSections[$s->class_id][$s->section_id][] = $s->id;
        }


        foreach ($classSections as $classId => $sections) {
            foreach ($sections as $sectionId => $studentIds) {
                GenerateClassSectionReportJob::dispatch(
                    $this->schoolId,
                    $classId,
                    $sectionId,
                    $studentIds,
                    $this->report_batch
                )->onQueue('report_generation');
            }
        }

        \App\Models\ReportBatch::where('id', $this->report_batch)->update([
            'total_students' => count($students),
            'status' => 'in_progress',
        ]);

    }

}