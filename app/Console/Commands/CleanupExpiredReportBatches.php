<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReportBatch;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class CleanupExpiredReportBatches extends Command
{
    protected $signature = 'reports:cleanup';

    protected $description = 'Check And Clean Generted Report at regular';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle() {  

        $disk = Storage::disk('reports');
        ReportBatch::whereNotNull('expires_at')->where('expires_at', '<', now())->whereNotNull('final_zip_path')
        ->chunkById(50, function ($batches) use ($disk) {
            foreach ($batches as $batch) {

                $zipPath = $batch->final_zip_path;
                $batchDirectory = dirname($zipPath);
                if ($disk->exists($batchDirectory)) {
                    $disk->deleteDirectory($batchDirectory);
                }

                $batch->delete();
            }
        });

        $report_requests = DB::table('report_requests')
            ->where('created_at', '<', Carbon::now()->subDays($expiry_date))->delete();

        $this->info("Data older than {$expiry_date} days removed successfully from report_requests table");
        $this->info('Old reports cleanup completed successfully');
        return Command::SUCCESS;

    }
}
