<?php

namespace App\Jobs;

use App\Models\SkillBatch;
use App\Models\SkillReportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Dompdf\Dompdf;
use Dompdf\Options;
use ZipArchive;

class GenerateBulkSkillReportsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $schoolId;
    protected $studentIds;
    protected $batchId;
    protected $termId;

    public $timeout = 3600;

    public function __construct($schoolId, $studentIds, $batchId, $termId)
    {
        $this->schoolId   = $schoolId;
        $this->studentIds = $studentIds;
        $this->batchId    = $batchId;
        $this->termId     = $termId;
    }

    public function handle()
    {
        try {
            ini_set('memory_limit', '1024M');

            SkillBatch::where('id', $this->batchId)->update([
                'total_students' => count($this->studentIds),    
                'status' => 'in_progress'
            ]);

            $termRange = $this->getTermRange($this->termId);
            $school = DB::table('schools')->where('id', $this->schoolId)->first();
            $termID = $this->termId;
            $completedCount = 0;

            // Group students by class + section
            $studentsGrouped = DB::table('students')
                ->join('custom_classes', 'custom_classes.id', '=', 'students.custom_class_id')
                ->join('class', 'class.id', '=', 'students.class_id')
                ->select(
                    'students.id',
                    'students.student_name',
                    'class.name as classname',
                    'custom_classes.section'
                )
                ->whereIn('students.id', $this->studentIds)
                ->orderBy('class.name')
                ->orderBy('custom_classes.section')
                ->get()
                ->groupBy(function ($item) {
                    return $item->classname . '_' . $item->section;
                });

            $basePath = storage_path('app/public/skill_reports/');
            if (!file_exists($basePath)) {
                mkdir($basePath, 0777, true);
            }

            $sectionFiles = [];

            foreach ($studentsGrouped as $groupKey => $sectionStudents) {

                $className   = $sectionStudents->first()->classname;
                $sectionName = $sectionStudents->first()->section;

                $classFolder = str_replace(' ', '-', $className);
                $classPath   = $basePath . $classFolder;

                if (!file_exists($classPath)) {
                    mkdir($classPath, 0777, true);
                }

                $sectionHtml = '';

                foreach ($sectionStudents as $studentRow) {

                    $studentId = $studentRow->id;

                    // Mark student as processing
                    SkillReportRequest::where('batch_id', $this->batchId)
                        ->where('student_id', $studentId)
                        ->update(['status' => 'processing']);

                    try {
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

                        $data = compact('student', 'school', 'getReportData', 'getSkills', 'termID');

                        $sectionHtml .= View::make(
                            'reports.skills.skill-reports-pdf',
                            $data
                        )->render();

                        $sectionHtml .= '<div style="page-break-after: always;"></div>';

                        // Mark student as completed
                        SkillReportRequest::where('batch_id', $this->batchId)
                            ->where('student_id', $studentId)
                            ->update(['status' => 'completed']);

                    } catch (\Throwable $studentException) {
                        Log::error("Skill Report failed for student {$studentId}", [
                            'error' => $studentException->getMessage()
                        ]);

                        SkillReportRequest::where('batch_id', $this->batchId)
                            ->where('student_id', $studentId)
                            ->update(['status' => 'failed']);
                    }

                    $completedCount++;
                    SkillBatch::where('id', $this->batchId)
                        ->update(['completed_students' => $completedCount]);
                }

                // Generate section PDF
                $options = new Options();
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isRemoteEnabled', true);
                $options->set('chroot', public_path());

                $dompdf = new Dompdf($options);
                $dompdf->loadHtml($sectionHtml);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                $sectionFilePath = $classPath . "/Section-{$sectionName}.pdf";
                file_put_contents($sectionFilePath, $dompdf->output());

                $sectionFiles[] = [
                    'absolute' => $sectionFilePath,
                    'relative' => $classFolder . "/Section-{$sectionName}.pdf"
                ];
            }

            // Generate final zip
            $zipName = "Skill_Reports_Batch_{$this->batchId}.zip";
            $zipPath = $basePath . $zipName;

            $zip = new ZipArchive;
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
                foreach ($sectionFiles as $file) {
                    $zip->addFile($file['absolute'], $file['relative']);
                }
                $zip->close();
            }
            
            // Update batch final info
            SkillBatch::where('id', $this->batchId)->update([
                'status' => 'completed',
                'download_path' => "skill_reports/{$zipName}",
                'final_zip_path' => "skill_reports/{$zipName}",
                'expires_at' => now()->addDays(7),
            ]);

            // Cleanup section PDFs
            foreach ($sectionFiles as $file) {
                if (file_exists($file['absolute'])) {
                    unlink($file['absolute']);
                }
            }

            // Remove class folders
            $folders = glob($basePath . '*', GLOB_ONLYDIR);
            foreach ($folders as $folder) {
                @rmdir($folder);
            }

        } catch (\Throwable $e) {
            Log::error("Bulk Skill Report Failed", [
                'error' => $e->getMessage()
            ]);

            SkillBatch::where('id', $this->batchId)
                ->update(['status' => 'failed']);
        }
    }

    private function getTermRange($termId)
    {
        return DB::table('term_masters')
            ->where('id', $termId)
            ->select('term_start_date', 'term_end_date')
            ->first();
    }
}
