<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncLowerFitnessSummry extends Command
{
    protected $signature = 'sync:lower-fitness-summary';

    protected $description = 'Synchronize SeniorTestResults into LowerTestResultsSummary table';

    public function handle()
    {
        DB::statement("
            INSERT INTO LowerTestResultsSummary ( 
                student_id,
                term_id,
                school_id,
                flamingo_balance,
                plate_tapping,
                created_at,
                updated_at
            )
            SELECT
                r.StudentID,
                r.TermId,
                r.SchoolID,

                -- Flamingo-Balance (TestTypeID = 17)
                MAX(CASE 
                    WHEN r.TestTypeID = 17
                    THEN r.Score 
                END),
                -- plate_tapping (TestTypeID = 16)
                MAX(CASE 
                    WHEN r.TestTypeID = 16
                    THEN r.Score 
                END),

                NOW(),
                NOW()

            FROM SeniorTestResults r
            GROUP BY r.SchoolID, r.StudentID, r.TermId

            ON DUPLICATE KEY UPDATE
                flamingo_balance = VALUES(flamingo_balance),                
                plate_tapping = VALUES(plate_tapping),
                updated_at   = NOW()
        ");

        $this->info('LowerTestResultsSummary synchronized successfully ');
    }
}
