<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UpdateFitnessTestResults
{
    protected function UpdateLowerTestStatus($studentId, $termId, $testTypeId, $score, $schoolId, $height = null, $weight = null)
    {
        $columns = [
            1  => 'running',
            2  => 'hopping',
            3  => 'jumping_landing',
            4  => 'one_foot_balance',
            5  => 'skipping',
            6  => 'dodging',
            15 => 'beam_walk',
            7  => 'catching_receiving_bounce',
            8  => 'catching_small_ball',
            9  => 'under_arm_throw',
            10 => 'over_arm_throw',
            11 => 'striking_drop_hit',
            12 => 'dribbling_hands',
            13 => 'dribbling_feet',
            14 => 'kicking_ball',
            17 => 'flamingo_balance',
            16 => 'plate_tapping',
            18 => 'bmi',
        ];

        if (!isset($columns[$testTypeId])) {
            return; // invalid test type
        }

        $column = $columns[$testTypeId];

        $data = [
            'school_id'  => $schoolId,
            $column      => $score,
            'updated_at' => now(),
        ];

        if (!is_null($height)) {
            $data['height'] = $height . ' cm';
        }
        if (!is_null($weight)) {
            $data['weight'] = $weight . ' kg';
        }

        // Insert or update
        DB::table('LowerTestResultsSummary')->updateOrInsert(
            ['student_id' => $studentId, 'term_id' => $termId],
            array_merge($data, ['created_at' => now()])
        );
    }

    public function UpdateSeniorTestStatus($studentId, $termId, $testTypeId, $score, $schoolId, $height = null, $weight = null)
    {
        $columns = [
            22 => 'sit_and_reach',
            20 => 'run_600m',
            23 => 'pushups',
            19 => 'dash_50m',
            21 => 'curlup',
            18 => 'bmi',
        ];

        if (!isset($columns[$testTypeId])) {
            return; // invalid test type
        }

        $column = $columns[$testTypeId];

        $data = [
            'school_id'  => $schoolId,
            $column      => $score, // assuming score is the BMI score
            'updated_at' => now(),
        ];

        if (!is_null($height)) {
            $data['height'] = $height . ' cm';
        }
        if (!is_null($weight)) {
            $data['weight'] = $weight . ' kg';
        }

        DB::table('SeniorTestResultsSummary')->updateOrInsert(
            ['student_id' => $studentId, 'term_id' => $termId],
            array_merge($data, ['created_at' => now()])
        );
    }
}
