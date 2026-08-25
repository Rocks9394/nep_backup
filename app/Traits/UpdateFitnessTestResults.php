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

    private function UpdateCWSNTestStatus($studentId, $termId, $testTypeId, $score, $schoolId, $height, $weight) {


        $columns = [
            29 => '20m_pacer',
            30 => '15m_pacer',
            32 => '1mile_run_walk',
            35 => 'shoulder_stretch',
            36 => 'sit_and_reach',
            37 => 'modified_apley_test',
            43 => 'curlup',
            44 => 'modified_curlup',
            45 => 'dumbbell_press',
            46 => 'pullup',
            47 => 'pushup',
            48 => 'seated_pushup',
            49 => 'trunk_lift',
            55 => 'Isometric_pushup',
            56 => 'reverse_curl',
            57 => 'modified_pullup',
            58 => '40m_push_walk',
            33 => 'cwsn_bmi'        
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

        if ($testTypeId == 33) {

            if (!is_null($height) && $height != '') {
               $data['height'] = $height . ' cm';
            }else{
                $data['height'] = '---';
            }

            if (!is_null($weight) && $weight != '') {
                $data['weight'] = $weight . ' kg';
            }else{
                $data['weight'] = '---';
            }
        }

        try {

            DB::table('CwsnTestResultSummary')->updateOrInsert(
                ['student_id' => $studentId, 'term_id' => $termId],
                array_merge($data, ['created_at' => now()])
            );

        } catch (\Illuminate\Database\QueryException $e) {

            if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
                
                Log::warning('Duplicate CWSN Test Result ignored', [
                    'student_id' => $studentId,
                    'term_id'    => $termId,
                    'test_type'  => $testTypeId,
                ]);

                return;
            }

            throw $e; 
        }
    }
    
}
