<?php  

namespace App\Traits;
use App\Models\TermMaster;
use Auth;
use Illuminate\Support\Facades\DB;

trait ReportHelperTrait
{

    protected function getClassFolderName(int $classId): string {

        return match ($classId) {
            14 => 'Class_Nursery',
            18 => 'Class_Pre_Nursery',
            22 => 'CLass_LKG',
            23 => 'CLass_UKG',
            default => 'Class_' . $classId,
        };
    }



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

     public function getTermId($schoolId) {
        if (session()->has('term_id')) {
            return session('term_id');
        }else{
            return TermMaster::where('school_id', $schoolId)
            ->where('is_active', 1)
            ->whereDate('term_start_date', '<=', today())
            ->whereDate('term_end_date', '>=', today())
            ->value('id');
        }
    }


    protected function getCurrentAndPreviousTermIds_bk(int $schoolId, int $selectedTermId): array {
        $terms = TermMaster::where('school_id', $schoolId)
            ->where('is_active', 1)
            ->orderBy('term_start_date', 'desc')
            ->get(['id']);

        $selectedIndex = $terms->search(fn ($term) => $term->id == $selectedTermId);

        if ($selectedIndex === false) {
            return [$selectedTermId];
        }

        return array_filter([
            $terms[$selectedIndex]->id ?? null,       // current
            $terms[$selectedIndex + 1]->id ?? null    // previous
        ]);
    }


    public function getReportData($studentId, $termIds) {

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
            ->whereIn('SeniorTestResults.TermId', $termIds)
            ->get();
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

    protected function getCurrentAndPreviousTermIds(int $schoolId, int $selectedTermId): array {
        
        $terms = TermMaster::where('school_id', $schoolId)->where('is_active', 1)
            ->orderBy('term_start_date', 'desc')->get(['id', 'term_start_date']);

        $selectedIndex = $terms->search(fn ($term) => $term->id == $selectedTermId);

        if ($selectedIndex === false) {
            return [$selectedTermId];
        }

        $termIds = [$terms[$selectedIndex]->id];

     
        if (isset($terms[$selectedIndex + 1])) {
            $termIds[] = $terms[$selectedIndex + 1]->id;
        }

        return $termIds;
    }

    
    protected function getJuniorReportData(int $classId, int $studentId, int $studentAge,string $studentGender,$groupedReportData, array $termIds) {

        [$currentTermId, $previousTermId] = $termIds + [null, null];


        $juniorCategoryOrder = [2, 6, 3];
        $juniorData = DB::table('TestCategoryMaster as tcm')
            ->join('TestTypeMaster as ttm', 'ttm.TestCategoryID', '=', 'tcm.TestCategoryID')
            ->join('skill_reports as sr', 'sr.TestTypeMasterID', '=', 'ttm.TestTypeID')
            ->whereIn('tcm.TestCategoryID', $juniorCategoryOrder)
            ->where('tcm.IsActive', 1)
            ->where('ttm.TestTypeID', '!=', 1014)
            ->orderByRaw( 'FIELD(tcm.TestCategoryID, ' . implode(',', $juniorCategoryOrder) . ')' )
            ->select(
                'tcm.TestCategoryName',
                'sr.skill_name'
            )->get();

        $orderedReportData = collect();

        foreach ($juniorData as $row) {
            $key = $row->TestCategoryName . ' (' . $row->skill_name . ')';
            $orderedReportData->put(
                $key,
                $groupedReportData->get($row->TestCategoryName, collect())
            );
        }


        $fmsCategories = [10, 12, 11];

        $allSkills = DB::table('TestCategoryMaster as tcm')
            ->join('TestTypeMaster as ttm', 'ttm.TestCategoryID', '=', 'tcm.TestCategoryID')
            ->join('skill_reports as sr', 'sr.TestTypeMasterID', '=', 'ttm.TestTypeID')
            ->join('class_fitness_tests as cft', 'cft.test_type_id', '=', 'sr.TestTypeMasterID')
            ->whereIn('tcm.TestCategoryID', $fmsCategories)
            ->where('cft.class_id', $classId)
            ->where('cft.is_active', 'active')
            ->select(
                'tcm.TestCategoryName',
                'sr.skill_name'
            )
            ->get()
            ->groupBy('TestCategoryName');

        $fmsRaw = DB::table('skillreport_skilltype_termtype_mapping as sst')
            ->join('skill_reports as sr', 'sr.id', '=', 'sst.skill_report_id')
            ->join('TestTypeMaster as ttm', 'ttm.TestTypeID', '=', 'sr.TestTypeMasterID')
            ->join('TestCategoryMaster as tcm', 'tcm.TestCategoryID', '=', 'ttm.TestCategoryID')
            ->where('sst.student_id', $studentId)
            ->whereIn('sst.term_master_id', array_filter([$currentTermId, $previousTermId]))
            ->select(
                'tcm.TestCategoryName',
                'sr.skill_name',
                'sst.term_master_id',
                DB::raw('COUNT(*) as skill_count'),
                DB::raw('MAX(sr.id) as skill_report_id')
            )
            ->groupBy(
                'tcm.TestCategoryName',
                'sr.skill_name',
                'sst.term_master_id'
            )
            ->get()
            ->groupBy(['TestCategoryName', 'skill_name']);

        $FmsReportData = $allSkills->mapWithKeys(function ($skills, $categoryName) use ( $fmsRaw, $currentTermId, $previousTermId) {

            $records = $skills->map(function ($skill) use ($fmsRaw,$categoryName, $currentTermId,$previousTermId ) {

                $rows = $fmsRaw[$categoryName][$skill->skill_name] ?? collect();

                $current = $rows->firstWhere('term_master_id', $currentTermId);
                $previous = $rows->firstWhere('term_master_id', $previousTermId);

                $currentCount  = $current->skill_count ?? 0;
                $previousCount = $previous->skill_count ?? 0;

                $outcome = match (true) {
                    $currentCount === 1 => 'Emerging',
                    $currentCount === 2 => 'Developing',
                    $currentCount === 3 => 'Acquired',
                    $currentCount >= 4  => 'Accomplished',
                    default             => 'N.A.',
                };

                $recommendation = null;
                if ($current?->skill_report_id) {
                    $recommendation = DB::table('fms_recommendations')
                        ->where('skill_reports_id', $current->skill_report_id)
                        ->where('outcomes', $outcome)
                        ->value('recommendations');
                }

                return [
                    'Test_Name'      => $skill->skill_name,
                    'current_count'  => $currentCount,
                    'previous_count' => $previousCount,
                    'outcome'        => $outcome,
                    'recommendation' => $recommendation,
                ];
            });

            return [$categoryName => $records->values()];
        });


        $fitnessBenchmark = $this->getBenchmark( $studentAge,  $studentGender, [6, 2] );
        return [
            $orderedReportData,
            $FmsReportData,
            $fitnessBenchmark
        ];
    }




    
}
