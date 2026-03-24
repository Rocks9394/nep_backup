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

		// 1. Validate ALL incoming data
		$validated = $request->validate([
			'exercise_id'   => 'required',
			'student_id'    => 'required',
			'student_name'  => 'required|string',
			'roll_no'       => 'nullable|string',
			'class_info'    => 'nullable|string',
			'exercise_type' => 'required|string',
			'score'         => 'required|numeric',
			'time_taken'    => 'nullable|numeric',
			'trainerID'     => 'required' // Added this to validation
		]);

		// 2. Fetch Trainer
		$User = DB::table('users')
			->select('id')
			->where('id', $validated['trainerID'])->first();

		if (!$User) {
			return response()->json(['status' => 'error', 'message' => 'Trainer not found'], 404);
		}

		Log::info('step2: trainer found', ['id' => $User->id]);

		// 3. Fetch School ID
		$SchoolTrainers = DB::table('school_trainers')
			->join('schools', 'schools.id', '=', 'school_trainers.school_id')
			->select('schools.id')
			->where('school_trainers.trainer_id', $User->id)
			->where('school_trainers.status', 1)
			->first(); // Use first() instead of get() to avoid array index issues

		if (!$SchoolTrainers) {
			return response()->json(['status' => 'error', 'message' => 'No active school found for this trainer'], 404);
		}

		$SchoolId = $SchoolTrainers->id;
		Log::info('step3: school id found', ['school_id' => $SchoolId]);

		// 4. Insert into Database
		DB::table('exercise_logs')->insert([
			'exercise_id'   => $validated['exercise_id'],
			'student_id'    => $validated['student_id'],
			'school_id'     => $SchoolId,
			'exercise_type' => $validated['exercise_type'],
			'reps'          => $validated['score'],
			'total_time'    => $validated['time_taken'] ?? 0,
			'submitted_by'  => $User->id,
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