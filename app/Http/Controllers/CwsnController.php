<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\RpwdCategoryMapping;
use Illuminate\Support\Facades\Crypt;
use App\Traits\ReportHelperTrait;
use App\Models\SeniorTestResult;
use App\Traits\UpdateFitnessTestResults;

class CwsnController extends Controller
{
    use ReportHelperTrait, UpdateFitnessTestResults;

    /**
     * Method to show all the cwsn Test category list.
     * Date : 09-07-2026
     * */

    public function showCWSNCategory($pwd_category_id,  $SeniorBMI = false) {

        $TestcategoryId = Crypt::decrypt($pwd_category_id);

        $CategoryName = DB::table('TestCategoryMaster')->where('TestCategoryID',$TestcategoryId)->value('TestCategoryName');
        
        $testType = DB::table('TestTypeMaster')->where('TestCategoryID',$TestcategoryId)
        ->where('TestsApplicable',5)
        ->orderBy('DisplayOrder')
        ->where('isActive', 1)
        ->get();


         // echo "<pre>"; print_r($CategoryName); exit();


        $title = $CategoryName ?? 'Test';
        $testTypeIds = $testType->pluck('TestTypeID');

        $videos = DB::table('fitness_test_videos')->whereIn('testType_id', $testTypeIds)->get();           
        return view('assessor.cwsnSkillsTest', compact('title','testType', 'SeniorBMI','videos','pwd_category_id'));       
    }


    /* Not in working */
    public function showCWSNCategory1($pwd_category_id) {

        // $pwd_category_id = Crypt::decrypt($pwd_category_id);

        $categoryInfo = DB::table('pwd_categories')->where('id', $pwd_category_id)->first();

        if (!$categoryInfo) {
            abort(404, 'Category Not Found');
        }

        $mappedCategories = RpwdCategoryMapping::where('pwd_category_id', $pwd_category_id)
        ->whereNotNull('TestCategoryId')
        ->with('testCategory') 
        ->get()
        ->pluck('testCategory')
        ->unique('TestCategoryID') 
        ->sortBy('TestCategoryName') 
        ->values();
        
         $title = $categoryInfo->disability_category;

         return view('assessor.cwsn.pwd_specific_tests', compact('title', 'categoryInfo', 'mappedCategories','pwd_category_id'));
    }

    /**
     * Date : 24-08-2026
     * Method to get all skill test for CWSN mapped with the available cwsn.
     * Note : This method is not in working.
     * */
    public function CWSNSkillsTest($pwd_category_id, $test_category_id,  $SeniorBMI = false) {

        $CategoryName = DB::table('TestCategoryMaster')->where('TestCategoryID',$test_category_id)->value('TestCategoryName');
        $testType = RpwdCategoryMapping::where('pwd_category_id', $pwd_category_id)
            ->where('TestCategoryId', $test_category_id)
            ->with('testType')
            ->get()
            ->pluck('testType')->sortBy('TestTypeName');

        $title = $CategoryName ?? 'Test';
        $testTypeIds = $testType->pluck('TestTypeID');

        $videos = DB::table('fitness_test_videos')
            ->whereIn('testType_id', $testTypeIds)
            ->get();
        return view('assessor.cwsnSkillsTest', compact('title','testType', 'SeniorBMI','videos','pwd_category_id'));        
    }

    /**
     * UI Selection for CWSN Test
     * */
    public function CwsnTestTypes($pwd_category_id, $TestTypeId, $SeniorBMI = false) {

        $pwd_category_id = Crypt::decrypt($pwd_category_id);

        $skillReport = DB::table('skill_reports')->select('id','skill_name','TestTypeMasterID')->where('TestTypeMasterID',$TestTypeId)->first();
        $skillReportId     = $skillReport->id;
        $TestTypeMasterID  = $TestTypeId;
        $userId  = \Auth::id();


        if(Session::get('SelectSchoolId')) {    
            $SchoolId = Session::get('SelectSchoolId');
        } else {
            $SchoolTrainers = DB::table('school_trainers')
            ->join('schools','schools.id','=','school_trainers.school_id')
            ->select('schools.school_name','schools.id','schools.logo')
            ->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

            if ($SchoolTrainers->isEmpty()) {               
                return redirect()->route('filldart.dashboard');           
            } else {
                $SchoolId = $SchoolTrainers->first()->id;
            }           
        }
        
        $classes = DB::table('custom_classes')
        ->join('class','class.id','=','custom_classes.class_id')
        ->select('custom_classes.id','class_id','section', DB::raw("CASE 
                WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                THEN custom_classes.nomenclature 
                ELSE class.name 
            END AS classname")
        )
        ->whereIn('class.id', array(6,7,8,9,10,11,12))
        ->Where('school_id', $SchoolId)
        ->orderBy('custom_classes.orders', 'ASC')
        ->get();

        // $classCount = DB::table('students')
        //     ->where('school_id', $SchoolId)
        //     ->where('academic_year', '2026-2027')
        //     ->distinct();

        // print_r( $classCount);
        // exit();

        
        $skillTypes = DB::table('skill_types')->where('skill_report_id',$skillReport->id)->where('status', 1)->get();
        $title = $skillReport->skill_name;



        // echo "<pre>"; print_r($pwd_category_id);exit();

        switch ($skillReport->skill_name) {

            case '20-m PACER':
            case 'Modified 15-m PACER':
                return view('assessor.cwsn.forms.pacer', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','pwd_category_id','TestTypeId'));
                break;

            case 'One-mile run/walk':
                return view('assessor.cwsn.forms.speed', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','pwd_category_id','TestTypeId'));
                break;

            case 'Curl-up':
            case 'Modified Curl-up':
                return view('assessor.cwsn.forms.curlup', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));

            case 'BMI':

                return view('assessor.cwsn.forms.cwsn-bmi', compact('title', 'skillTypes','skillReportId','TestTypeMasterID', 'classes', 'SchoolId','pwd_category_id','TestTypeId'));
                break;

            case 'Push-up':   //start button with beep at 3sec of intervwal with live count tracker
            case 'Dumbbell Press':  // start button with cadence at 4sec of intervwal with live count tracker (50 counts)
            case 'Pull-up':         // without timer
            case 'Modified Pull-Up': // withput timer
                return view('assessor.cwsn.forms.pushup', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));
                break;

            case 'Trunk Lift':                
                return view('assessor.cwsn.forms.trunk-lift', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));
                break;
            
            case 'Back Saver Sit and Reach':
                return view('assessor.cwsn.forms.sit-and-reach', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));
                break;

            case 'Reverse curl':
                return view('assessor.cwsn.forms.reverse_curl', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));
                break;

            case 'Seated Push-up':
            case 'Isometric Push-up':
                return view('assessor.cwsn.forms.seated-pushup', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));
                break;

            case 'Shoulder Stretch':
                return view('assessor.cwsn.forms.shoulder-streatch', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));
                break;

            case 'Modified Apley Test':                
                return view('assessor.cwsn.forms.apleytest', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));
                break;

            case '40-Meter Push/Walk Test':                
                return view('assessor.cwsn.forms.push-walk', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','TestTypeId','pwd_category_id'));
                break;

            default:

                echo "default route"; exit;
                return view('assessor.cwsn.forms.pacer', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','pwd_category_id','TestTypeId','pwd_category_id'));
                break;
        }
    }


    /**
     * CWSN Form Submission.
     * */
    public function SubmitCwsnTest(Request $request) {
       
        $alldata = $request->all();
        $userId  = \Auth::id();
        
        if(Session::get('SelectSchoolId'))  {   
            $SchoolId = Session::get('SelectSchoolId');            
        }else {            
            $SchoolTrainers = DB::table('school_trainers')
            ->join('schools','schools.id','=','school_trainers.school_id')
            ->select('schools.school_name','schools.id','schools.logo')
            ->where('school_trainers.trainer_id',$userId)->where('school_trainers.status', 1)->get();

            if ($SchoolTrainers->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'No active school assigned to trainer.']);
            }
            $SchoolId = $SchoolTrainers[0]->id;           
        }

        $TermMasterId =  $this->getTermId($SchoolId);
        $skillReportId = (int) $request->input('skillReportId');

        // echo "<pre>"; print_r($skillReportId); exit();

        switch ($skillReportId) {

            case 29:        //20-m PACER
            case 30:        //Modified 15-m PACER
                
                if($alldata['laps_completed'] !='' && $alldata['student_id'] !='')  {

                    $totalLaps = (int) $request->input('laps_completed');

                    

                    $TestScore = $totalLaps;
                    $levels = 'N.A.';
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);
                    
                } 
                return response()->json(['success' => false, 'message' => 'Laps calculation data missing.']);
                break;

            
            case 32:        //One-mile run/walk               
                $students = $request->students ?? [];

                if (!empty($students)) {
                    $studentIdsArray = [];

                    foreach($students as $key => $val) {
                        $studentId = $val['id'];
                        $studentIdsArray[] = $val['id']; 
                        $studentTime = $val['time'];
                        $studentTimeInSec = $studentTime / 1000;
                        
                        $levels = 'N.A.';
                        $alldata['student_id'] = $studentId;
                        $this->storeFormData($alldata, $TermMasterId, $userId, $studentTime, $levels);
                    }

                    $message =  $this->TestMessage($studentIdsArray, $skillReportId);
                    return response()->json(['success' => true,'message' => $message]); 
                }
                return response()->json(['success' => false, 'message' => 'No student performance dataset selected.']);
                break;
            case 43:        //Curl Up
            case 44:        //Modified Curl Up               
                if (isset($alldata['count_total_number']) && $alldata['count_total_number'] !== '' && !empty($alldata['student_id'])) {

                    $levels = 'N.A.';
                    $TestScore = $alldata['count_total_number'];
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);      
                    
                } 
                return response()->json(['success' => false, 'message' => 'Repetition summary missing.']);
                break;
            case 46:        // Pull-up
            case 47:        // Push-up
            case 57:        // Modified Pull-Up
            case 45:        // Dumbbell Press
                if (isset($alldata['total_push_up']) && $alldata['total_push_up'] !== '' && !empty($alldata['student_id'])) {

                    $levels = 'N.A.';
                    $TestScore = $alldata['total_push_up'];
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);                    
                } 
                return response()->json(['success' => false, 'message' => 'Total score value target missing.']);
                break;
            case 49:        // Trunk Lift

                if (isset($alldata['trunk_lift']) && $alldata['trunk_lift'] !== '' && !empty($alldata['student_id'])) {

                    $levels = 'N.A.';
                    $TestScore = $alldata['trunk_lift'];
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);                    
                } 
                return response()->json(['success' => false, 'message' => 'Trunk lift metrics missing.']);
                break;
            case 48:        //Seated Push-Up
            case 55:        // Isometric Push-Up
                 if (isset($alldata['modified_pushup']) && $alldata['modified_pushup'] !== '' && !empty($alldata['student_id'])) {

                    $levels = 'N.A.';
                    $modified_pushup = $alldata['modified_pushup'];
                    $TestScore = $this->timeToMilliseconds($modified_pushup);
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);                    
                } 
                return response()->json(['success' => false, 'message' => 'Duration measurements missing.']);
      
                break;
            case 56:        // Reverse Curl-up

                if (isset($alldata['reverse_curlup']) && $alldata['reverse_curlup'] !== '' && !empty($alldata['student_id'])) {               
                    $levels = 'N.A.';
                    $TestScore = $alldata['reverse_curlup'];
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);                    
                } 
                return response()->json(['success' => false, 'message' => 'Pass/Fail assessment result missing.']);
                break;
            case 37:        // Modified Apley Test

                if (isset($alldata['aplay_test']) && $alldata['aplay_test'] !== '' && !empty($alldata['student_id'])) {               
                    $levels = 'N.A.';
                    $alldata['RightScore'] =  $alldata['right_apley_level'];
                    $alldata['LeftScore'] =  $alldata['left_apley_level'];
                    $alldata['additional_score'] =  $alldata['LeftScore'] . ' | ' . $alldata['RightScore'];
                    $TestScore = null;
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);                    
                } 

                return response()->json(['success' => false, 'message' => 'Right Aplay /Left Aplay assessment result missing.']);
                break;
            case 35:        //Shoulder Streatch Test

                if (isset($alldata['score_left']) && $alldata['score_left'] !== '' && 
                isset($alldata['score_right']) && $alldata['score_right'] !== '' && 
                !empty($alldata['student_id'])) {

                    $levels = 'N.A.';
                    $alldata['RightScore'] =  $alldata['right_shoulder_status'];
                    $alldata['LeftScore'] =  $alldata['left_shoulder_status'];
                    $alldata['additional_score'] =($alldata['LeftScore'] == 1 ? 'P' : 'F') . ' | ' . ($alldata['RightScore'] == 1 ? 'P' : 'F');
                    $TestScore = null;

                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);                    
                } 

                return response()->json([
                    'success' => false, 
                    'message' => 'Both Left and Right arm assessment metrics are required.'
                ]);
                break;
            case 36:        // Back Saver Sit and Reach

                if (isset($alldata['score_left']) && $alldata['score_left'] !== '' && 
                    isset($alldata['score_right']) && $alldata['score_right'] !== '' && 
                    !empty($alldata['student_id'])) {

                    $levels = 'N.A.';
                    $alldata['RightScore'] =  (float) $alldata['score_right'] * 10; 
                    $alldata['LeftScore'] =  (float) $alldata['score_left'] * 10;
                    $alldata['additional_score'] =  $alldata['LeftScore']/10 . ' | ' . $alldata['RightScore']/10;
                    $TestScore = null;
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels); 
                }
                
                return response()->json([
                    'success' => false, 
                    'message' => 'Both valid Left and Right leg performance dimensions are required.'
                ]);
                break;

            case 58:

                if (isset($alldata['assessment_result']) && $alldata['assessment_result'] !== '' && 
                    isset($alldata['heart_rate_status']) && $alldata['heart_rate_status'] !== '' && 
                    !empty($alldata['student_id'])) {

                    $levels = 'N.A.';
                    $assessment_result =  $alldata['assessment_result'];
                    $heart_rate_status =  $alldata['heart_rate_status'];
                    $TestScore = false;

                    if($assessment_result == 1 && $heart_rate_status){
                        $TestScore = true;
                    }
                    
                    return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);                    
                } 

                return response()->json(['success' => false, 'message' => 'Right Aplay /Left Aplay assessment result missing.']);
            case 33:
                
                $BmiData  = $this->CwsnBmiCalcualtion($alldata);

                $TestScore = $BmiData['bmiScore'];
                $alldata['weight'] = $BmiData['weight'];
                $alldata['height'] = $BmiData['height'];

                $levels = 'N.A.';
                return $this->storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels);
                              
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid Test Type assignment mapping error.']);
                break;
        }
    }

    protected function CwsnBmiCalcualtion($alldata){

        $height = 0; $weight = 0;

        if (!empty($alldata['height']) && is_numeric($alldata['height'])) {
            $height = (float) $alldata['height'];
        } elseif (isset($alldata['segment_floor_to_knee'], $alldata['segment_knee_to_hip'], $alldata['segment_hip_to_head']) ) {
            $height = (float) ($alldata['segment_floor_to_knee'] + $alldata['segment_knee_to_hip'] + $alldata['segment_hip_to_head']);
        }

        if(isset($alldata['amputation_raw_weight'] , $alldata['anthropo_wt_id'])){
           
            $rawWeight =  (float) $alldata['amputation_raw_weight'];

            switch ($alldata['anthropo_wt_id']) {
                case 5:

                    $weight = $rawWeight + ($rawWeight/18);     //below knee amputaion
                    break;

                case 6:
                    $weight = $rawWeight + ($rawWeight/9);      //Above knee amputaion 
                    break;

                case 7:
                    $weight = $rawWeight + ($rawWeight/6);     // Hip amputation
                    break;

                default:
                    $weight = $rawWeight;
                    break;
            }

        } elseif (isset($alldata['total_combined_weight'], $alldata['wheelchair_tare_weight'])) {

            $weight = (float)($alldata['total_combined_weight'] - $alldata['wheelchair_tare_weight']);

        } elseif (!empty($alldata['weight']) && is_numeric($alldata['weight'])) {

            $weight = (float)$alldata['weight'];
        }

        if ($height <= 0) {
            return 0; 
        }

        $heightInMeters = $height / 100;
        $bmiScore = $weight / ($heightInMeters * $heightInMeters);
        $score = round($bmiScore, 2);
        $bmiData = ['bmiScore' => $score, 'height' => $height, 'weight' => $weight];
        return $bmiData;
    }

    protected function storeFormData($alldata, $TermMasterId, $userId, $TestScore, $levels){

        $height = $alldata['height'] ?? null;
        $weight = $alldata['weight'] ?? null;

        $Result = new SeniorTestResult();
        $Result->SchoolID     = $alldata['SchoolId'];
        $Result->StudentID    = $alldata['student_id'];
        $Result->TermId       = $TermMasterId;
        $Result->TestTypeID   = $alldata['skillReportId'];
        $Result->Score        = $TestScore;
        $Result->height       = $height;
        $Result->weight       = $weight;
        $Result->LeftScore    = $alldata['LeftScore'] ?? null;
        $Result->RightScore   = $alldata['RightScore'] ?? null;

        $Result->created_at   = now();
        $Result->CreatedBy    = $userId;
        $Result->updated_at   = now();
        $Result->ModifiedBy   = $userId;
        $Result->level        = $levels;

        $Result->save();
        
        
        if (in_array($alldata['skillReportId'], [35, 36, 37])){
            $this->UpdateCWSNTestStatus($alldata['student_id'], $TermMasterId, $alldata['skillReportId'] , $alldata['additional_score'] ,$alldata['SchoolId'] , $height, $weight);
        }else{
            $this->UpdateCWSNTestStatus($alldata['student_id'], $TermMasterId, $alldata['skillReportId'] , $TestScore ,$alldata['SchoolId'] , $height, $weight);
        }

        $message = $this->TestMessage($alldata['student_id'], $alldata['skillReportId']);

        return response()->json(['success' => true,'message' => $message]);    
    }
  

    private function TestMessage($studentIds, $testTypeId) {

        $testNames = [
            29  => '20-m PACER',
            30  => 'Modified 15-m PACER',
            26  => 'Target Aerobic Movement Test',
            32  => 'One-mile run/walk',
            33  => 'BMI',
            35  => 'Shoulder Stretch',
            36  => 'Back Saver Sit and Reach',
            37  => 'Modified Apley Test',
            38 => 'Modified Thomas Test',
            39 => 'Target Stretch Test',
            43 => 'Curl-up',
            44 => 'Modified Curl-up',
            45 => 'Dumbbell Press',
            46 => 'Pull-up',
            47 => 'Push-up',
            48 => 'Seated Push-up',
            49 => 'Trunk Lift',
            50 => 'Wheelchair Ramp Test',
            51 => 'Bench Press',
            52 => 'Flexed Arm Hang',
            53 => 'Extended Arm Hang',
            54 => 'Dominant Grip Strength',
            55 => 'Isometric Push-up',
            56 => 'Reverse curl',
            57 => 'Modified Pull-Up',
            58 => '40-Meter Push/Walk Test'
        ];

        if (!isset($testNames[$testTypeId])) {
            return "Unknown test (ID: {$testTypeId}).";
        }

        $studentIds = is_array($studentIds) ? $studentIds : [$studentIds];
        $studentNames = DB::table('students')->whereIn('id', $studentIds)->pluck('student_name')->toArray();

        if (empty($studentNames)) {
            return "No student found for this test.";
        }

        if (count($studentNames) === 1) {
            $namesStr = $studentNames[0];
        } else {
            $last = array_pop($studentNames);
            $namesStr = implode(', ', $studentNames) . ' and ' . $last;
        }

        return "The {$testNames[$testTypeId]} score for {$namesStr} has been saved in the database.";
    }


    private function submitPacerScore(Request $request) {

        $request->validate([
            'student_id'     => 'required',
            'laps_completed' => 'required|integer|min:0',
            'skillReportId'  => 'required',
        ]);

        $totalLaps = (int) $request->input('laps_completed');

        // 2. Standard PACER Matrix: [Level => Number of Shuttles in that level]
        $pacerMatrix = [
            1 => 7,  2 => 8,  3 => 8,  4 => 9,  5 => 9,  6 => 10, 7 => 10, 8 => 11,
            9 => 11, 10 => 11, 11 => 12, 12 => 12, 13 => 13, 14 => 13, 15 => 14, 
            16 => 14, 17 => 15, 18 => 15, 19 => 16, 20 => 16, 21 => 16
        ];

        // Default fallback state if laps are 0
        $calculatedLevel = 1;
        $calculatedShuttle = 0;
        $accumulatedLaps = 0;

        // 3. Step-by-step loop calculation
        if ($totalLaps > 0) {
            $matched = false;
            
            foreach ($pacerMatrix as $level => $shuttlesInLevel) {
                // Check if the student's score falls within this specific level tier
                if ($totalLaps <= ($accumulatedLaps + $shuttlesInLevel)) {
                    $calculatedLevel = $level;
                    $calculatedShuttle = $totalLaps - $accumulatedLaps;
                    $matched = true;
                    break;
                }
                // Build the running threshold count
                $accumulatedLaps += $shuttlesInLevel;
            }

            // Cap safety check: if they exceed standard level 21 constraints
            if (!$matched) {
                $calculatedLevel = 21;
                $calculatedShuttle = $totalLaps - $accumulatedLaps + $pacerMatrix[21];
            }
        }

        // 4. Update or Store data into your Database
        // Assuming you are saving to a fitness/skills report model:
        /*
        $report = StudentSkillReport::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'id' => $request->skillReportId
            ],
            [
                'total_laps' => $totalLaps,
                'achieved_level' => $calculatedLevel,
                'achieved_shuttle' => $calculatedShuttle,
                'school_id' => $request->SchoolId
            ]
        );
        */

        // 5. Return JSON structure matching your frontend's SubmitForm handler
        return response()->json([
            'status' => 'success',
            'message' => 'PACER data processed successfully!',
            'data' => [
                'total_laps' => $totalLaps,
                'final_level' => $calculatedLevel,
                'final_shuttle' => $calculatedShuttle
            ]
        ]);
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

    function timeToMilliseconds($timeStr) {
        if (empty($timeStr)) return 0;

        $parts = explode(':', $timeStr);

        if (count($parts) === 2) {
            $seconds = (int) $parts[0];
            $msPart = $parts[1];

            // Standard timer displays usually show 2 digits for MS (centiseconds, 00-99)
            // e.g., "40:50" = 40s + 500ms
            if (strlen($msPart) === 2) {
                $milliseconds = (int) $msPart * 10;
            } else {
                $milliseconds = (int) $msPart;
            }

            return ($seconds * 1000) + $milliseconds;
        }

        return (int) $timeStr;
    }

}
