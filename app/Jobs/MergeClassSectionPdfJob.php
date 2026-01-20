<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use setasign\Fpdi\Fpdi;
use App\Notifications\ReportReadyNotification;
use App\Models\School;
use ZipArchive;

class MergeClassSectionPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $schoolId;
    public int $classId;
    public string $sectionId;
    public int $report_batch_id;
    public $timeout = 900;
    public $tries = 3;

    public function __construct(int $schoolId, int $classId, string $sectionId, int $report_batch_id)
    {
        $this->schoolId = $schoolId;
        $this->classId = $classId;
        $this->sectionId = $sectionId;
        $this->report_batch_id = $report_batch_id;
    }


    public function handle() {

        $path = storage_path("app/reports/{$this->schoolId}/batch_{$this->report_batch_id}/class_{$this->classId}/section_{$this->sectionId}");
        $output = storage_path("app/reports/{$this->schoolId}/batch_{$this->report_batch_id}/class_{$this->classId}/section_{$this->sectionId}.pdf");
        
        $pdf = new Fpdi();

        $files = glob("$path/student_*.pdf");
        sort($files);

        foreach ($files as $file) {
            $pageCount = $pdf->setSourceFile($file);
            for ($page = 1; $page <= $pageCount; $page++) {
                $tplIdx = $pdf->importPage($page);
                $pdf->AddPage();
                $pdf->useTemplate($tplIdx);
            }
        }

        $pdf->Output($output, 'F');       
        foreach ($files as $file) @unlink($file);
        @rmdir($path);

        $batch = \App\Models\ReportBatch::where('id', $this->report_batch_id)->latest()->first();

        if ($batch) {
            $batch->increment('completed_students', count($files));
            $this->CheckAndSendNotification($batch);
        }
    }


    protected function CheckAndSendNotification($batch) {

        if ($batch->completed_students >= $batch->total_students) {
            $batch->update(['status' => 'completed']);

            $batchFolder = storage_path("app/reports/{$this->schoolId}/batch_{$this->report_batch_id}");
            $finalPath = $this->createZipAndDownload($batchFolder);

            $downloadUrl = route('report.download.permanent', [
                'batchId'  => $this->report_batch_id,
            ]);

            $batch->update([
                'final_zip_path' => $finalPath,
                'download_path'  => $downloadUrl,
            ]);

            $school = \App\Models\School::find($this->schoolId);

            if ($school && $school->admin) {
                $school->admin->notify(new ReportReadyNotification($this->schoolId, $this->classId, null, $downloadUrl));
                // Log::info("Final notification sent", ['school_id' => $this->schoolId]);
            }
        }
    }
    

    private function createZipAndDownload($batchFolder) {
      
        $zipFileName = "Report_{$this->report_batch_id}_{$this->schoolId}_" . now()->format('Ymd_His') . ".zip";
        $zipFilePath = "{$batchFolder}/{$zipFileName}";
        $zip = new \ZipArchive();

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {

            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($batchFolder, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($files as $file) {
                if ($file->isFile() && pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($batchFolder) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();
            $this->deleteAllExceptZip($batchFolder, $zipFileName);
            return $zipFilePath;
        }

        // Log::error("Failed to create ZIP file", ['path' => $zipFilePath]);
        return null;
    }

    private function deleteAllExceptZip($directory, $zipFileName) {

        $items = new \FilesystemIterator($directory);
        foreach ($items as $item) {
            if ($item->isDir()) {
                $this->deleteDirectory($item->getPathname());
            } elseif ($item->isFile() && $item->getFilename() !== $zipFileName) {
                @unlink($item->getPathname());
            }
        }
    }

    private function deleteDirectory($dir) {
        
        if (!is_dir($dir)) return;

        $files = new \FilesystemIterator($dir);
        foreach ($files as $file) {
            if ($file->isDir()) {
                $this->deleteDirectory($file->getPathname());
            } else {
                @unlink($file->getPathname());
            }
        }
        @rmdir($dir);
    }

}
