<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteUploadHistory extends Command
{
    protected $signature = 'delete:upload-history';

    protected $description = 'Delete upload history older than defined retention periods';

    public function handle()
    {
        $testDays = 7;

        $testDeleted = DB::table('test_import_logs')
            ->where('created_at', '<', Carbon::now()->subDays($testDays))
            ->delete();

        $skillReportsData = DB::table('skill_batches')
            ->where('created_at', '<', Carbon::now()->subDays($testDays))
            ->delete();

        $this->info("Deleted {$testDeleted} test import logs older than {$testDays} days.");
        $this->info("Deleted {$skillReportsData} Skill report logs older than {$testDays} days.");
    }
}
