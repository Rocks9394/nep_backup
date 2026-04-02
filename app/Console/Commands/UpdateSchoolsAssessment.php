<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateSchoolsAssessment extends Command
{
    protected $signature = 'schools:update-assessment';
    protected $description = 'Insert or update schools assessment summary by school_id';

    public function handle()
    {
        $this->info('assessment scheduler start');

        // Class to skill mapping
        $classSkillMapping = [
            1 => range(1, 18),
            2 => range(1, 18),
            3 => range(1, 18),
            4 => range(18, 23),
            5 => range(18, 23),
            6 => range(18, 23),
            7 => range(18, 23),
            8 => range(18, 23),
            9 => range(18, 23),
            10 => range(18, 23),
            11 => range(18, 23),
            12 => range(18, 23),
            14 => [1, 3, 4, 7, 15],
            14 => [1, 4, 5],
            14 => [1, 2, 3, 4, 7, 12, 15],
            14 => [1, 2, 3, 4, 5, 7, 9, 12, 14, 15],
            // Add more class mappings if needed
        ];

        // Build the INSERT statement
       DB::statement("
            INSERT INTO schools_assessment (
                school_id,
                school_code,
                school_name,
                region,
                registered_students,
                completed,
                ongoing,
                yet_to_start
            )
            SELECT
                sc.id AS school_id,
                sc.school_code,
                sc.school_name,
                sc.region,
                COUNT(*) AS registered_students,
                SUM(CASE WHEN status_calc = 'completed' THEN 1 ELSE 0 END) AS completed,
                SUM(CASE WHEN status_calc = 'ongoing' THEN 1 ELSE 0 END) AS ongoing,
                SUM(CASE WHEN status_calc = 'yet_to_start' THEN 1 ELSE 0 END) AS yet_to_start
            FROM (
                SELECT 
                    s.id AS student_id,
                    s.school_id,
                    s.class_id,
                    CASE 
                        -- Completed
                        WHEN s.class_id >= 4 AND s.class_id <= 12 
                            AND (SELECT COUNT(DISTINCT TestTypeID) 
                                FROM SeniorTestResults se 
                                WHERE se.StudentID = s.id 
                                    AND se.TestTypeID IN (" . implode(',', range(18,23)) . ")) = " . count(range(18,23)) . "
                        THEN 'completed'

                        WHEN s.class_id < 4 OR s.class_id > 12
                            AND (SELECT COUNT(DISTINCT skill_report_id) 
                                FROM skillreport_skilltype_termtype_mapping f
                                WHERE f.student_id = s.id 
                                    AND f.skill_report_id IN (" . implode(',', range(1,18)) . ")) = " . count(range(1,18)) . "
                        THEN 'completed'

                        -- Ongoing
                        WHEN s.class_id >= 4 AND s.class_id <= 12 
                            AND (SELECT COUNT(DISTINCT TestTypeID) 
                                FROM SeniorTestResults se 
                                WHERE se.StudentID = s.id 
                                    AND se.TestTypeID IN (" . implode(',', range(18,23)) . ")) > 0
                        THEN 'ongoing'

                        WHEN s.class_id < 4 OR s.class_id > 12
                            AND (SELECT COUNT(DISTINCT skill_report_id) 
                                FROM skillreport_skilltype_termtype_mapping f
                                WHERE f.student_id = s.id 
                                    AND f.skill_report_id IN (" . implode(',', range(1,18)) . ")) > 0
                        THEN 'ongoing'

                        ELSE 'yet_to_start'
                    END AS status_calc
                FROM students s
                WHERE s.status = 'active'
            ) AS t
            INNER JOIN schools sc ON sc.id = t.school_id
            GROUP BY sc.id, sc.school_code, sc.school_name, sc.region
            ON DUPLICATE KEY UPDATE
                school_code = VALUES(school_code),
                school_name = VALUES(school_name),
                region = VALUES(region),
                registered_students = VALUES(registered_students),
                completed = VALUES(completed),
                ongoing = VALUES(ongoing),
                yet_to_start = VALUES(yet_to_start)
            ");

        $this->info('[' . now()->toDateTimeString() . '] Schools assessment inserted/updated successfully.');
    }

    /**
     * Generate the SQL condition to check skills based on class and type.
     */
    protected function getSkillCondition($classSkillMapping, $type)
    {
        $conditions = [];

        foreach ($classSkillMapping as $classId => $skillIds) {
            $skillCheck = [];
            foreach ($skillIds as $skillId) {
                if ($classId >= 4 && $classId <= 12) {
                    // Use SeniorTestResults table
                    $skillCheck[] = "se.TestTypeID = {$skillId}";
                } else {
                    // Use skillreport_skilltype_termtype_mapping table
                    $skillCheck[] = "f.skill_report_id = {$skillId}";
                }
            }

            $skillCheckStr = implode(' OR ', $skillCheck);

            if ($type === 'completed') {
                // All skills must exist
                $conditions[] = "(COUNT(DISTINCT CASE WHEN s.class_id = {$classId} AND ({$skillCheckStr}) THEN 1 END) = " . count($skillIds) . ")";
            } elseif ($type === 'ongoing') {
                // Some but not all
                $conditions[] = "(COUNT(DISTINCT CASE WHEN s.class_id = {$classId} AND ({$skillCheckStr}) THEN 1 END) > 0 AND COUNT(DISTINCT CASE WHEN s.class_id = {$classId} AND ({$skillCheckStr}) THEN 1 END) < " . count($skillIds) . ")";
            } elseif ($type === 'yet_to_start') {
                // None of the skills exist
                $conditions[] = "(COUNT(DISTINCT CASE WHEN s.class_id = {$classId} AND ({$skillCheckStr}) THEN 1 END) = 0)";
            }
        }

        return implode(' OR ', $conditions);
    }
}