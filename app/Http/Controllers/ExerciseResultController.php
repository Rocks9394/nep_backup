<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Log;

class ExerciseResultController extends Controller
{
    public function store(Request $request)
    {
		
		Log::info('step1: Store method called');
		
        // 1. Validate the incoming data (Including Exercise ID and New Fields)
        $validated = $request->validate([
            'exercise_id'   => 'required',        // Captures the 1011
            'student_id'    => 'required',
            'student_name'  => 'required|string',
            'roll_no'       => 'nullable|string',
            'class_info'    => 'nullable|string',
            'exercise_type' => 'required|string',
            'score'         => 'required|numeric',
            'time_taken'    => 'nullable|numeric',
        ]);
		
		
		$userId  = \Auth::id();
		
		Log::info('step2: trainer id-', $userId);
		
		$SchoolTrainers = DB::table('school_trainers')
		->join('schools','schools.id','=','school_trainers.school_id')
		->select('schools.id')
		->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

		$SchoolId = $SchoolTrainers[0]->id;
			
		Log::info('step3: school id-', $SchoolId);
		
		
		Log::info('step4: Incoming request data', $request->all());

        // 2. Insert into MySQL
        // Ensure you have run the ALTER TABLE command to add these columns!
        DB::table('exercise_logs')->insert([
            'exercise_id'   => $validated['exercise_id'],
            'student_id'    => $validated['student_id'],
			'school_id'     => $SchoolId,
            'exercise_type' => $validated['exercise_type'],
            'reps'          => $validated['score'],
            'total_time'    => $validated['time_taken'] ?? 0,
			'submitted_by'  => $userId,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);


		Log::info('step5: data saved successfully');
		
        return response()->json([
            'status' => 'success',
            'message' => 'Result saved successfully!'
        ], 200);
    }
}