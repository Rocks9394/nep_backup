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
		Log::info('Step 1: Store method called', $request->all());

		try {
			// 1. Validate incoming data
			// Note: Check for invisible characters in field names if copying from elsewhere
		
			$validated = $request->validate([
				'exercise_id'   => 'required',
				'student_id'    => 'required',
				'student_name'  => 'required|string',
				'roll_no'       => 'nullable|string',
				'class_info'    => 'nullable|string',
				'exercise_type' => 'required|string',
				'score'         => 'required',
				'time_taken'    => 'nullable',
				'trainerID'     => 'required' 
			]);

			// 2. Fetch Trainer
			$User = DB::table('users')
				->select('id')
				->where('id', $validated['trainerID'])
				->first();

			if (!$User) {
				return response()->json(['status' => 'error', 'message' => 'Trainer ID not found'], 404);
			}

			Log::info('Step 2: Trainer found', ['id' => $User->id]);

			// 3. Fetch School ID using trainer_id (Corrected column name)
			$SchoolTrainers = DB::table('school_trainers')
				->join('schools', 'schools.id', '=', 'school_trainers.school_id')
				->select('schools.id as school_id') // Alias to avoid confusion
				->where('school_trainers.trainer_id', $User->id) // Corrected from user_id
				->where('school_trainers.status', 1)
				->first();

			if (!$SchoolTrainers) {
				return response()->json(['status' => 'error', 'message' => 'No active school found for trainer ' . $User->id], 404);
			}

			$SchoolId = $SchoolTrainers->school_id;
			Log::info('Step 3: School ID found', ['school_id' => $SchoolId]);

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

			Log::info('Step 5: Data saved successfully');

			return response()->json([
				'status' => 'success',
				'message' => 'Result for ' . $validated['exercise_type'] . ' saved successfully!'
			], 200);

		} catch (\Illuminate\Validation\ValidationException $e) {
			// Returns exact field missing (e.g., "The score field is required")
			return response()->json([
				'status' => 'error', 
				'message' => 'Validation Error', 
				'details' => $e->errors()
			], 422);

		} catch (\Exception $e) {
			// Returns the SQL error directly to help you debug quickly
			Log::error('Store Error: ' . $e->getMessage());
			return response()->json([
				'status' => 'error', 
				'message' => 'Database Error: ' . $e->getMessage()
			], 500);
		}
	}
}