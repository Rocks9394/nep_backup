<?php

namespace App\Http\Controllers\NativeApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProfileResource;
use App\Models\TermMaster;
use App\Traits\ReportHelperTrait;
use Illuminate\Support\Facades\DB;

class TrainerProfileController extends Controller
{
    use ReportHelperTrait;

    public function show(Request $request) {

        $trainer = Auth::guard('user-api')->user();

        return response()->json([
            'status' => true,
            'account_type' => 'user',
            'data' => new ProfileResource($trainer->load(['schools','usermeta'])),
        ]);
    }

    public function dashboard(Request $request) {

        $user = Auth::guard('user-api')->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }

        $userId = $user->id;
        $roleId = $user->role_id;
        $title = 'Dashboard';
        
        if ($roleId == 3) {
            if ($request->has('select_school_id')) { 
                $schoolId = $request->input('select_school_id'); 
            } else {
                $schoolId = DB::table('school_trainers')
                    ->where('trainer_id', $userId)
                    ->where('status', 1)
                    ->value('school_id');
            }
        } else {
            $schoolId = DB::table('school_reference')
                ->where('school_user_id', $userId)
                ->where('status', 1)
                ->value('school_id');
        }

        $SchoolTrainers = DB::table('school_trainers')
            ->join('schools', 'schools.id', '=', 'school_trainers.school_id')
            ->select('schools.id', 'schools.school_name', 'schools.logo')
            ->where('school_trainers.trainer_id', $userId)
            ->where('school_trainers.status', 1)
            ->get();
        
        $hasSchools = $SchoolTrainers->isNotEmpty();
        $selectSchoolId = $request->input('select_school_id') ?? $SchoolTrainers->pluck('id')->first();

        $SchoolName = DB::table('schools')
            ->select('school_name', 'logo')
            ->where('id', $schoolId)
            ->first();

        $dashboardModules = collect();

   
        if ($roleId == 2) { // School Role
            $schoolRef = DB::table('school_reference')
                ->where('school_user_id', $userId)
                ->first();
            
            $schoolDetails = null;
            if ($schoolRef) {
                $schoolDetails = DB::table('schools')
                    ->select('school_name', 'logo', 'school_code')
                    ->where('id', $schoolRef->school_id)
                    ->first();
            }

            if ($schoolRef && $schoolRef->status == 1) {
                $allowedModules = json_decode($user->usermeta->module_access ?? '[]', true);
                $dashboardModules = DB::table('dashboard_modules')
                    ->whereIn('route_name', $allowedModules)
                    ->whereIn('role_id', [0, 4])
                    ->where('status', 1)
                    ->orderBy('order_no', 'asc')
                    ->get();
            }

            return response()->json([
                'status' => 'success',
                'role_id' => $roleId,
                'data' => [
                    'title' => $title,
                    'user' => $user,
                    'hasSchools' => $hasSchools,
                    'schoolDetails' => $schoolDetails,
                    'schoolTrainers' => $SchoolTrainers,
                    'dashboardModules' => $dashboardModules
                ]
            ], 200);
        }
            
        // Access check fallback for roles other than 3 and 4
        if ($roleId != 4 && $roleId != 3) {
            return response()->json([
                'status' => 'success',
                'role_id' => $roleId,
                'data' => [
                    'title' => $title,
                    'user' => $user,
                    'hasSchools' => $hasSchools,
                    'schoolName' => $SchoolName,
                    'schoolTrainers' => $SchoolTrainers
                ]
            ], 200);
        }

        // 4. Metrics Gathering Logic
        $baseQuery = DB::table('schools_assessment as s')->where('s.school_id', $schoolId);
        $regTrainers = DB::table('users')->where('role_id', 3)->count('id');

        $totals = (clone $baseQuery)
            ->selectRaw('
                COALESCE(SUM(s.registered_students),0) as total_students,
                COALESCE(SUM(s.completed),0) as total_completed,
                COALESCE(SUM(s.ongoing),0) as total_ongoing,
                COALESCE(SUM(s.yet_to_start),0) as total_yet_to_start
            ')
            ->first();
                
        $studentsCount = DB::table('students')
            ->where('school_id', $schoolId)
            ->where('status', 'active')
            ->count();
                
        $currentTermId = $this->getTermId($schoolId);   
        $termIds = $this->getCurrentAndPreviousTermIds($schoolId, (int) $currentTermId);
        $terms = TermMaster::whereIn('id', $termIds)->get();
            
        if ($request->has('term_id')) {
            $selectedTerm = $request->term_id;
            $isValidTerm = TermMaster::where('id', $selectedTerm)
                ->where('school_id', $schoolId)
                ->exists();
            
            if ($isValidTerm) {
                $termIds = $this->getCurrentAndPreviousTermIds($schoolId, (int) $selectedTerm);
            } else {
                $selectedTerm = $currentTermId;
            }
        } else {
            $selectedTerm = $currentTermId;         
        }           
            
        // 5. Health/BMI Data mapping
        $bmiData = DB::table('SeniorTestResults')
            ->join('students','students.id', '=', 'SeniorTestResults.StudentID')
            ->select('LEVEL', DB::raw('COUNT(StudentID) AS Total_Student'),'SeniorTestResults.TermId')
            ->whereIn('SeniorTestResults.TermId', $termIds)
            ->where('SeniorTestResults.SchoolID', $schoolId)
            ->whereIn('LEVEL', ['UW', 'N', 'OW', 'OB'])
            ->groupBy('LEVEL', 'TermId')
            ->orderByRaw("FIELD(LEVEL, 'UW', 'N', 'OW', 'OB')")
            ->get();

        $levels = ['UW', 'N', 'OW', 'OB'];
        $mapped = $bmiData->keyBy(function ($item) {
            return $item->LEVEL . '_' . $item->TermId;
        });

        $healthData = [
            'labels' => $levels
        ];

        foreach ($termIds as $termId) {
            $healthData["term_$termId"] = [];
            foreach ($levels as $level) {
                $key = $level . '_' . $termId;
                $healthData["term_$termId"][] = isset($mapped[$key]) 
                    ? (int) $mapped[$key]->Total_Student 
                    : 0;
            }
        }
            
        // 6. Fitness Matrix Generation
        $data = DB::table('SeniorTestResults as str')
            ->join('skill_reports as sr', 'sr.id', '=', 'str.TestTypeID')
            ->join('students', 'students.id', '=', 'str.StudentID')
            ->select(
                'sr.skill_name',
                'str.level',
                'str.TermId',
                DB::raw('COUNT(StudentID) as total')
            )
            ->where('str.SchoolID', $schoolId)
            ->whereIn('str.TermId', $termIds)
            ->whereIn('str.TestTypeID', [16, 17, 19, 20, 21, 22, 23])
            ->whereNotNull('str.level')
            ->whereNotIn('str.level', ['', 'N.A.'])
            ->whereRaw("str.level REGEXP '^L[1-7]$'")
            ->groupBy('sr.skill_name', 'str.level', 'str.TermId')
            ->orderBy('sr.skill_name')
            ->orderByRaw("CAST(SUBSTRING(str.level, 2) AS UNSIGNED)")
            ->get();

        $skills = [];
        $levels_fitness = [];
        $termsList = [];
        $matrix = [];

        foreach ($data as $row) {
            $skills[$row->skill_name] = true;
            $levels_fitness[$row->level] = true;
            $termsList[$row->TermId] = true;
            $matrix[$row->TermId][$row->skill_name][$row->level] = (int)$row->total;
        }

        $categories = array_keys($skills);
        $levelNames = array_keys($levels_fitness);
        usort($levelNames, function ($a, $b) {
            return (int) substr($a, 1) <=> (int) substr($b, 1);
        });

        $levelColors = [
            'L1'=>'#fe4a5d','L2'=>'#ffaa62','L3'=>'#ffd26e',
            'L4'=>'#74c4d6','L5'=>'#a3d55f','L6'=>'#6bc04b','L7'=>'#00953b'
        ];

        $chartSeries = [];
        foreach ($termsList as $termId => $_) {
            foreach ($levelNames as $level) {
                $rowData = [];
                foreach ($categories as $skill) {
                    $rowData[] = $matrix[$termId][$skill][$level] ?? 0;
                }
                $chartSeries[] = [
                    'name' => "Term {$termId} - {$level}",
                    'data' => $rowData,
                    'color' => $levelColors[$level] ?? '#000000'
                ];
            }
        }

        // 7. Standardized JSON Output Response
        return response()->json([
            'status' => 'success',
            'role_id' => $roleId,
            'data' => [
                'title' => $title,
                'schoolName' => $SchoolName,
                'schoolTrainers' => $SchoolTrainers,
                'hasSchools' => $hasSchools,
                'user' => $user,
                'stats' => [
                    'totalStudents' => (int) $totals->total_students,
                    'totalCompleted' => (int) $totals->total_completed,
                    'totalOngoing' => (int) $totals->total_ongoing,
                    'totalYetToStart' => (int) $totals->total_yet_to_start,
                    'activeStudentsCount' => $studentsCount,
                    'registeredTrainersCount' => $regTrainers,
                ],
                'healthData' => $healthData,
                'fitnessData' => [
                    'categories' => $categories,
                    'levelNames' => $levelNames,
                    'levelColors' => $levelColors,
                    'chartSeries' => $chartSeries,
                    'matrix' => $matrix
                ],
                'terms' => $terms,
                'selectedTerm' => $selectedTerm
            ]
        ], 200);
    }
}
