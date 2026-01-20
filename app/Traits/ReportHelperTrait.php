<?php  

namespace App\Traits;
use App\Models\TermMaster;
use Auth;
use Illuminate\Support\Facades\DB;

trait ReportHelperTrait
{

    public function getStudentData($studentId) {
        
        return DB::table('students')
            ->leftJoin('schools', 'students.school_id', '=', 'schools.id')
            ->leftJoin('class', 'students.class_id', '=', 'class.id')
            ->leftJoin('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
            ->join('usermetas', 'usermetas.school_id', '=', 'schools.id')
            ->select(
                'schools.school_name','schools.school_code','schools.id as schools_id','schools.logo', 'class.name as class',
                'students.id as student_id','students.student_uid as admissionnumber',
                'students.student_name as student_name','students.gender',
                'students.class_id','students.section_id','students.custom_class_id',
                'students.dob','students.email_id','students.rollno','students.status', 'usermetas.signature',
                DB::raw("CASE 
                    WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                    THEN custom_classes.nomenclature ELSE class.name END AS display_classname"),
                'custom_classes.section'
            )
            ->where('students.id', $studentId)->where('students.status', 'active')
            ->first();
    }


    public function getTermId($schoolId) {

        return TermMaster::where('school_id', $schoolId)
            ->where('is_active', 1)
            ->whereDate('term_start_date', '<=', today())
            ->whereDate('term_end_date', '>=', today())
            ->value('id');
    }


    public function getReportData($studentId) {

        return DB::table('SeniorTestResults')
            ->join('skill_reports','skill_reports.id','=','SeniorTestResults.TestTypeId')
            ->join('TestTypeMaster','TestTypeMaster.TestTypeId','=','skill_reports.TestTypeMasterID')
            ->join('TestCategoryMaster','TestCategoryMaster.TestCategoryID','=','TestTypeMaster.TestCategoryID')
            ->join('term_masters','term_masters.id','=', 'SeniorTestResults.TermId')
            ->select(
                'SeniorTestResults.TestTypeID',
                'SeniorTestResults.TermId',
                'SeniorTestResults.created_at',
                'SeniorTestResults.Score',
                'skill_reports.skill_name',
                'skill_reports.TestTypeMasterID',
                'SeniorTestResults.weight',
                'SeniorTestResults.height',
                'TestTypeMaster.TestCategoryID',
                'TestTypeMaster.ScoreUnit',
                'TestCategoryMaster.TestCategoryName',
                'TestTypeMaster.ScoreCriteria'
            )
            ->orderBy('SeniorTestResults.created_at', 'desc')
            ->where('StudentID', $studentId)
            ->get();
    }
    /*
    public function getReportData($studentId,$TermMasterId) {

        return DB::table('SeniorTestResults')
            ->join('skill_reports','skill_reports.id','=','SeniorTestResults.TestTypeId')
            ->join('TestTypeMaster','TestTypeMaster.TestTypeId','=','skill_reports.TestTypeMasterID')
            ->join('TestCategoryMaster','TestCategoryMaster.TestCategoryID','=','TestTypeMaster.TestCategoryID')
            // ->join('term_masters','term_masters.id','=', 'SeniorTestResults.TermId')
            ->select(
                'SeniorTestResults.TestTypeID',
                'SeniorTestResults.TermId',
                'SeniorTestResults.created_at',
                'SeniorTestResults.Score',
                'skill_reports.skill_name',
                'skill_reports.TestTypeMasterID',
                'SeniorTestResults.weight',
                'SeniorTestResults.height',
                'TestTypeMaster.TestCategoryID',
                'TestTypeMaster.ScoreUnit',
                'TestCategoryMaster.TestCategoryName',
                'TestTypeMaster.ScoreCriteria'
            )
            ->where('SeniorTestResults.TermId', $TermMasterId)
            ->orderBy('SeniorTestResults.created_at', 'desc')
            ->where('StudentID', $studentId)->get();
    }*/


    public function mapReportData($reportData, $studentAge, $studentGender, $ageGender) {

        $bmibenchMark = DB::table('LP_BMI_List')->where('Age','=', $ageGender)->get()->groupBy(function ($row) {
            return $row->Age;
        });

        return $reportData->map(function ($item) use ($bmibenchMark, $studentAge, $studentGender, $ageGender) {

            $bmiBenchmarkRow = $bmibenchMark->get($ageGender)?->first();     
            $getPerformance = $this->getPerformance($item, $studentAge, $studentGender, $bmiBenchmarkRow);              

            $normalizedScore = $this->formatValue($item->Score, $item->ScoreUnit);

            return [
                'Category'   => $item->TestCategoryName,
                'TermId'     => $item->TermId,
                'created_at' => \Carbon\Carbon::parse($item->created_at)->format('d M Y'),
                'Level'      => $getPerformance['level'] ?? '',
                'Test_Name'  => $item->skill_name,
                'score'      => $normalizedScore,
                'recommendation' => $getPerformance['outcomes'] ?? '',
                'height'    => $item->height, 
                'weight'   => $item->weight,
            ];
        });
    }

    private function getPerformance($item, $studentAge, $studentGender, $bmiBenchmarkRow) {


        $score = $item->Score;
        $skill_type_id = $item->TestTypeID;
        $test_master_id = $item->TestTypeMasterID;
        $score_criteria = $item->ScoreCriteria;
        $score_unit  = $item->ScoreUnit;
        $test_category_name = $item->TestCategoryName;

        $level = 'N.A.';
        $recommendation = '';

        if ($test_category_name === 'Body Composition' && $bmiBenchmarkRow) {
            $levels = ['UW','N','OW','OB']; 
            $level = 'OB';

            foreach ($levels as $lvl) {
                if (!empty($bmiBenchmarkRow->$lvl)) {
                    if ($item->Score < $bmiBenchmarkRow->$lvl) {
                        $level = $lvl;
                        break; 
                    }
                }
            }

            $bmiLevelLabels = [
                'UW' => "UW",
                'N'  => "Normal",
                'OW' => "OW",
                'OB' => "OB",
            ];

            return [
                'level' => $bmiLevelLabels[$level] ?? $level,
                'outcomes' => '' // You can also add BMI-specific outcomes if you have a table
            ];
        }

        $level = $this->getFitnessLevel1($test_master_id, $studentAge, $studentGender, $score, $score_criteria);

       
        
        $recommendation = DB::table('fitnessRecommandation')->where('skill_reports_id', $item->TestTypeID)->where('level', '=', $level)
            ->value('recommendations');

        // Human-readable labels
        $levelLabels = [
            'L0' => "Inadequate",
            'L1' => "Very Low",
            'L2' => "Low",
            'L3' => "Developing",
            'L4' => "Moderate",
            'L5' => "Good",
            'L6' => "High",
            'L7' => "Excellent",
            'L8' => "Beyond L7",
        ];

        return [
            'level' => $level . ' (' . ($levelLabels[$level] ?? $level) . ')',
            'outcomes' => $recommendation ?? ''
        ];
    }

  

    /* Get Levels */
    public function getFitnessLevel1($skillReportId, $studentAge, $studentGender, $score, $score_criteria)  {

        // echo "string3"; exit();


        $result = DB::selectOne("SELECT get_fitness_level2(:skill_report_id, :age, :gender, :score, :criteria) AS level", [
            'skill_report_id' => $skillReportId,
            'age'             => $studentAge,
            'gender'          => $studentGender,
            'score'           => $score,
            'criteria'        => $score_criteria,
        ]);
  


        return $result->level ?? 'N.A.';
    }



    /* BMI Benchmark */
    public function getBmiBenchmark($ageGender) {
        $bmiBenchmarkRow = DB::table('LP_BMI_List')->where('Age', $ageGender)->first();
        if (!$bmiBenchmarkRow) {
            return null; 
        }
        
        return [
            'UW' => 'BMI < ' . $bmiBenchmarkRow->UW,
            'N'  => $bmiBenchmarkRow->UW . ' ≤ BMI < ' . $bmiBenchmarkRow->N,
            'OW' => $bmiBenchmarkRow->N . ' ≤ BMI < ' . $bmiBenchmarkRow->OW,
            'OB' => 'BMI ≥ ' . $bmiBenchmarkRow->OW
        ];
    }

    /* Fitness Benchmark */
    public function getBenchmark($age, $gender, $categories_id) {   

        // Fetch benchmarks from DB
        $benchmarks = DB::table('fitness_benchmarks')
            ->join('TestTypeMaster','TestTypeMaster.TestTypeId','=', 'fitness_benchmarks.skill_reports_id')
            ->join('TestCategoryMaster','TestCategoryMaster.TestCategoryID','=', 'TestTypeMaster.TestCategoryID')
            ->join('skill_reports','skill_reports.TestTypeMasterID','=', 'TestTypeMaster.TestTypeID')
            ->select('fitness_benchmarks.*', 
                'TestTypeMaster.ScoreCriteria',
                'TestTypeMaster.ScoreUnit',
                'skill_reports.skill_name'
            )
            ->where('Age', $age)
            ->where('Gender', $gender)
            ->whereIn('TestCategoryMaster.TestCategoryID', $categories_id)
            ->get();

        $formattedBenchmarks = $this->formatBenchmarkRanges($benchmarks);

        return $formattedBenchmarks;
    }

    public function formatBenchmarkRanges($benchmarks) {

        return $benchmarks->map(function($item) {
            $ranges = [];
            for ($i = 1; $i <= 7; $i++) {
                $low  = $item->{"l{$i}_low"};
                $high = $item->{"l{$i}_high"};
                if ($low !== null && $high !== null) {
                    $ranges["L{$i}"] = $this->formatValue($low, $item->ScoreUnit) . ' - ' . $this->formatValue($high, $item->ScoreUnit);
                } else {
                    $ranges["L{$i}"] = '-';
                }
            }

            return (object)[
                'skill_name'    => $item->skill_name,
                'unit'          => $item->unit,
                'ScoreCriteria' => $item->ScoreCriteria,
                'ranges'        => $ranges
            ];
        });
    }

    public function formatValue($value, $unit) {
        switch ($unit) {
            case 'msec':
                $milliseconds = $value % 1000;
                $totalSeconds = intdiv($value, 1000);
                $minutes = intdiv($totalSeconds, 60);
                $seconds = $totalSeconds % 60;

                if ($minutes > 0) {
                    $parts = [];
                    $parts[] = $minutes . 'min';
                    if ($seconds > 0) {
                        $parts[] = $seconds . 'sec';
                    }
                    if ($milliseconds > 0) {
                        $parts[] = str_pad($milliseconds, 3, '0', STR_PAD_LEFT) . 'ms';
                    }
                    return implode(' ', $parts);
                }

                $secWithMs = $value / 1000.0;
                $fmt = number_format($secWithMs, 3, '.', '');
                $trimmed = rtrim(rtrim($fmt, '0'), '.');
                return $trimmed . ' sec';

            case 'mm':
                return ($value / 10) . ' cm';

            case 'number':
                return intval($value) . ' times';

            default:
                return $value;
        }
    }


    protected function getSeniorReportData($studentId, $studentAge, $studentGender, $groupedReportData) {

        $senior = [8, 9, 5, 4, 15, 3];

        $seniorData = DB::table('TestCategoryMaster')
            ->join('TestTypeMaster', 'TestTypeMaster.TestCategoryID','=', 'TestCategoryMaster.TestCategoryID')
            ->join('skill_reports', 'skill_reports.TestTypeMasterID','=', 'TestTypeMaster.TestTypeID')
            ->whereIn('TestCategoryMaster.TestCategoryID', $senior)
            ->orderByRaw('FIELD(TestCategoryMaster.TestCategoryID, ' . implode(',', $senior) . ')')
            ->select('TestCategoryMaster.TestCategoryID','TestCategoryMaster.TestCategoryName','skill_reports.skill_name')
            ->where('TestCategoryMaster.IsActive', 1)
            ->get();

        $orderedReportData = collect();
        foreach ($seniorData as $cat) {
            $categoryName = $cat->TestCategoryName . " (" . $cat->skill_name . ")";
            $data = $groupedReportData->get($cat->TestCategoryName, collect());
            $orderedReportData->put($categoryName, $data);
        }

        $categories_id2 = [3,10,12,11,8,9,5,4,15,3];
        $fitnessBenchmark = $this->getBenchmark($studentAge, $studentGender, $categories_id2);

        return [$orderedReportData, $fitnessBenchmark];
    }



    protected function getJuniorReportData($classId , $studentId, $studentAge, $studentGender, $groupedReportData, $TermMasterId)  {
        
        $junior1 = [2,6,3];    //TestCategoryMasterID
        $juniorData1 = DB::table('TestCategoryMaster')
            ->join('TestTypeMaster', 'TestTypeMaster.TestCategoryID','=', 'TestCategoryMaster.TestCategoryID')
            ->join('skill_reports', 'skill_reports.TestTypeMasterID','=', 'TestTypeMaster.TestTypeID')
            ->whereIn('TestCategoryMaster.TestCategoryID', $junior1)
            ->orderByRaw('FIELD(TestCategoryMaster.TestCategoryID, ' . implode(',', $junior1) . ')')
            ->select('TestCategoryMaster.TestCategoryID','TestCategoryMaster.TestCategoryName','skill_reports.skill_name')
            ->where('TestCategoryMaster.IsActive', 1)
            ->get();

        $orderedReportData = collect();

        foreach ($juniorData1 as $cat) {
            $categoryName = $cat->TestCategoryName . " (" . $cat->skill_name . ")";
            $data = $groupedReportData->get($cat->TestCategoryName, collect());
            $orderedReportData->put($categoryName, $data);
        }

        $junior = [10,12,11];
        $allSkills = DB::table('TestCategoryMaster as tcm')
            ->join('TestTypeMaster as ttm', 'ttm.TestCategoryID', '=', 'tcm.TestCategoryID')
            ->join('skill_reports as sr', 'sr.TestTypeMasterID', '=', 'ttm.TestTypeID')
            ->join('class_fitness_tests as cft', 'sr.TestTypeMasterID','=', 'cft.test_type_id')
            ->whereIn('tcm.TestCategoryID', $junior)->where('cft.class_id', $classId)->where('cft.is_active','active')
            ->select('tcm.TestCategoryID', 'tcm.TestCategoryName', 'sr.skill_name', 'ttm.TestTypeID')
            ->get()->groupBy('TestCategoryName');

        // echo "<pre>"; print_r($allSkills);exit();



        $fmsCategory = DB::table('skillreport_skilltype_termtype_mapping as sst')
            ->join('skill_reports as sr', 'sr.id', '=', 'sst.skill_report_id')
            ->join('skill_types as st', 'st.id', '=', 'sst.skill_type_id')
            ->join('TestTypeMaster as ttm', 'ttm.TestTypeID', '=', 'sr.TestTypeMasterID')
            ->join('TestCategoryMaster as tcm', 'tcm.TestCategoryID', '=', 'ttm.TestCategoryID')
            ->where('sst.student_id', $studentId)
            ->where('sst.term_master_id', $TermMasterId)
            ->orderBy('sst.created_at', 'desc')
            ->select(
                'tcm.TestCategoryName',
                'sr.skill_name',
                'sr.id as skill_report_id',
                'sr.TestTypeMasterID',
                DB::raw('COUNT(sr.skill_name) as skill_count')
            )
            ->groupBy('tcm.TestCategoryName','sr.id','sr.skill_name','sr.TestTypeMasterID','sst.created_at')
            ->get()
            ->groupBy('TestCategoryName');


            // echo "<pre>"; print_r($categoryName);exit();
        $FmsReportData = collect($allSkills)->mapWithKeys(function ($skills, $categoryName) use ($fmsCategory) {


            $report = $skills->map(function ($skill) use ($fmsCategory, $categoryName) {

                $studentSkill = $fmsCategory->get($categoryName, collect())->firstWhere('skill_name', $skill->skill_name);

                $count = $studentSkill->skill_count ?? 0;

                if ($count == 1) {
                    $outcome = 'Emerging';   //
                } elseif ($count == 2) {
                    $outcome = 'Developing';
                } elseif ($count == 3) {
                    $outcome = 'Acquired';
                } elseif ($count >= 4) {
                    $outcome = 'Accomplished';
                } else {
                    $outcome = 'N.A.';
                }

                $recommendation = null;
                if ($studentSkill) {
                    $recommendation = DB::table('fms_recommendations')
                        ->where('skill_reports_id', $studentSkill->skill_report_id)
                        ->where('outcomes', $outcome)
                        ->value('recommendations');
                }


                return [
                    'Test_Name'      => $skill->skill_name,
                    'recommendation' => $recommendation,
                    'outcome'        => $outcome,
                    'count'         => $count,
                ];
            });

            return [$categoryName => $report->toArray()];
        });

        $categories_id1 = [6,2];
        $fitnessBenchmark = $this->getBenchmark($studentAge, $studentGender, $categories_id1);
            

          

                
         


        return [$orderedReportData, $FmsReportData, $fitnessBenchmark];
    }
    
}
