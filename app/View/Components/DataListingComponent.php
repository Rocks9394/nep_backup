<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;
use DB;
use Session;
use App\Models\School;
use App\Models\Sclass;
use Illuminate\Support\Facades\Cache;

class DataListingComponent extends Component
{
    public $id;
    public $headers;
    public $columns;
    public $ajaxUrl;
    public $title;
    public $exportButtons;
    public $enableExportButtons;
    public $enableClassFilter;
    public $enableOnlyClassFilter;
    public $enableSkillNameFilter;
    public $enableClassSectionFilter;
    public $enableStatusFilter;
    public $enableSchoolTermsFilter;
    public $enableSportsFilter;

    public $classes;
    public $skillIds;
    public $schoolTerms;
    public $sports;

    public $statuses;
    public $pageLength;
    public $enableLengthMenu;
    public $searchPlaceholder;
    public $statusModeFlag;
    public $selectedStatus;

    public $selectedClass;     // ADD THIS PROPERTY FOR PRE-SELECTED CLASS
    public $selectedOnlyClass; // ADD THIS PROPERTY FOR PRE-SELECTED CLASS
    public $selectedSection;   // ADD THIS FOR PRE-SELECTED SECTION
    public $exportButtonText;   // ADD THIS TO CHANGE EXPORT BUTTON -> BULK ACTION

    public function __construct(
        $id, 
        $headers = [], 
        $columns = [], 
        $ajaxUrl = '', 
        $title = '', 
        $exportButtons = [], 
        $classes = [],
        $skillIds = [],
        $schoolTerms = [],
        $sports = [],

        $enableClassFilter = false, 
        $enableOnlyClassFilter = false,
        $enableSkillNameFilter = false,
        $enableClassSectionFilter = false, 
        $enableStatusFilter = false,
        $enableSchoolTermsFilter = null,
        $enableSportsFilter = false,

        $statusModeFlag = 0,
        $enableExportButtons = false,
        $enableLengthMenu = true,
        $pageLength = 100,
        $searchPlaceholder = 'Search...',
        $selectedClass = null,      // ADD THIS PARAMETER
        $selectedOnlyClass = null,  // ADD THIS PARAMETER
        $selectedSection = null,    // ADD THIS PARAMETER
        $selectedStatus = null,      // ADD THIS PARAMETER
        $exportButtonText = null        //Add this for Export button text

        ){

        $this->id = $id;
        $this->headers = $headers;
        $this->columns = $columns;
        $this->ajaxUrl = $ajaxUrl;             

        $this->enableStatusFilter = filter_var($enableStatusFilter, FILTER_VALIDATE_BOOLEAN);
        $this->statusModeFlag = (int)$statusModeFlag;
        $this->enableClassFilter = filter_var($enableClassFilter, FILTER_VALIDATE_BOOLEAN);
        $this->enableOnlyClassFilter = filter_var($enableOnlyClassFilter, FILTER_VALIDATE_BOOLEAN);
        $this->enableSkillNameFilter = filter_var($enableSkillNameFilter, FILTER_VALIDATE_BOOLEAN);
        $this->enableClassSectionFilter = filter_var($enableClassSectionFilter, FILTER_VALIDATE_BOOLEAN);

         $this->enableSchoolTermsFilter = filter_var($enableSchoolTermsFilter, FILTER_VALIDATE_BOOLEAN);
         $this->enableSportsFilter = filter_var($enableSportsFilter, FILTER_VALIDATE_BOOLEAN);

        $this->enableExportButtons = filter_var($enableExportButtons, FILTER_VALIDATE_BOOLEAN);
        $this->enableLengthMenu = filter_var($enableLengthMenu, FILTER_VALIDATE_BOOLEAN); 
        $this->pageLength = (int)$pageLength;
        $this->selectedClass = $selectedClass;          // SET SELECTED CLASS
        $this->selectedOnlyClass = $selectedOnlyClass;  // SET SELECTED CLASS
        $this->selectedStatus = $selectedStatus;        // SET SELECTED STATUS
        $this->selectedSection = $selectedSection;      // SET SELECTED SECTION
        $this->searchPlaceholder = $searchPlaceholder;
        $this->exportButtonText = $exportButtonText;
        
 
        $this->classes = $this->SchoolClassList();
        $this->skillIds = $this->SkillIds();
        $this->schoolTerms = $this->getSchoolTerms();
        $this->sports = $this->getSports();

        $defaultButtons = $this->enableExportButtons ? [ ['type' => 'excelHtml5', 'text' => 'Excel']] : [];
        $this->exportButtons = array_merge($defaultButtons, $exportButtons ?? []);


        // if ($this->enableStatusFilter) {
        //     $this->statuses = $this->enableStatusFilter();
        // }
        if ($this->enableStatusFilter) {
            $this->statuses = $this->getStatuses();
        }
    }

    protected function SkillIds() {
        return DB::table('skill_reports')
        ->select('id', 'skill_name', 'TestTypeMasterID', 'icons', 'status', 'created_at', 'updated_at')
        ->get();
    }


    protected function SchoolClassList() {

        $creatorId = Auth::id();
        if(Auth::user()->role_id == 4){
            $schoolId = DB::table('school_reference')->where('school_user_id', $creatorId)->where('status', 1)->value('school_id');
        }else{

            if(Session::get('SelectSchoolId')) {   
                $schoolId = Session::get('SelectSchoolId');
                
            }else {
                
                $schoolId = DB::table('school_trainers')
                ->join('schools','schools.id','=','school_trainers.school_id')
                ->select('schools.school_name','schools.id','schools.logo')
                ->where('school_trainers.trainer_id',$creatorId)->where('school_trainers.status', 1)->value('trainer_id');
            }
        }
        

        $school = School::find($schoolId);
        $classList = $school->getClasses;

        $classOrder = [
            'pre-nursery' => 1,
            'prenursery'  => 1,
            'nursery'     => 2,
            'lkg'         => 3,
            'ukg'         => 4,
        ];
        $baseClasses = Sclass::pluck('name', 'id');

        $classList = $classList->map(function ($class) use ($baseClasses) {

            $baseName = strtolower($baseClasses[$class->class_id] ?? '');
            return [
                'base_name' => $baseName,
                'name' => !empty($class->nomenclature)  ? $class->nomenclature : ($baseClasses[$class->class_id] ?? null),
                'class_id' => $class->class_id,
                'section' => $class->section,
            ];
        })
        ->sortBy(function ($item) use ($classOrder) {

            $normalized = str_replace([' ', '-'], '', $item['base_name']);

            if (isset($classOrder[$normalized])) {
                $classSort = $classOrder[$normalized];
            } elseif (preg_match('/class\s*(\d+)/i', $item['base_name'], $matches)) {
                $classSort = 100 + (int) $matches[1];
            } else {
                $classSort = 999;
            }
            
            $section = $item['section'];
            $sectionSort = is_numeric($section) ? (int) $section : ord(strtoupper($section)) - ord('A');
            return [$classSort, $sectionSort];

        })->values();

        return $classList;
    }
    

    protected function getStatuses(): array{
        
        if ($this->statusModeFlag === 1) {
            return [
                ['value' => 'all', 'label' => 'All'],
                ['value' => 'incomplete', 'label' => 'Incomplete'],
            ];
        }
        return [
            ['value' => 'all', 'label' => 'All'],
            ['value' => 'complete', 'label' => 'Complete'],
            ['value' => 'pending', 'label' => 'Ongoing'],
            ['value' => 'yet_to_start', 'label' => 'Yet To Start'],
        ];
    }

    protected function getSchoolTerms() {

        $creatorId = Auth::id();
        if(Auth::user()->role_id == 4){
            $schoolId = DB::table('school_reference')->where('school_user_id', $creatorId)->where('status', 1)->value('school_id');
        }else{

            if(Session::get('SelectSchoolId')) {   
                $schoolId = Session::get('SelectSchoolId');
                
            }else {
                
                $schoolId = DB::table('school_trainers')
                ->join('schools','schools.id','=','school_trainers.school_id')
                ->select('schools.school_name','schools.id','schools.logo')
                ->where('school_trainers.trainer_id',$creatorId)->where('school_trainers.status', 1)->value('trainer_id');
            }
        }

        $cacheKey = "school_terms_{$schoolId}";
        return Cache::remember($cacheKey, now()->addHours(6), function () use ($schoolId) {
            return School::find($schoolId)
            ->getTerms()      
            ->where('is_active', 1)
            ->get()         
            ->map(fn ($term) => [
                'term_id'   => $term->id,
                'school_id' => $term->school_id,
                'term_name' => $term->term_name,
            ])
            ->values()->toArray();
        });
    }

    protected function getSports() {
        $userId = Auth::id();
        
		if(Auth::user()->role_id == 3){
			if(Session::get('SelectSchoolId')){	
				$schoolId = Session::get('SelectSchoolId');	
			}else{
				$schoolId = DB::table('school_trainers')->where('trainer_id',$userId)->where('status', 1)->value('school_id');
			}
		}else{
			$schoolId = DB::table('school_reference')->where('school_user_id',$userId)->where('status', 1)->value('school_id');
		}

        $sports = DB::table('student_map_sports')
        ->join('sports', 'sports.id', '=', 'student_map_sports.sports_id')
        ->where('school_id',$schoolId)->select('sports.name', 'sports.id')
        ->groupBy('sports.id', 'sports.name')
        ->orderBy('sports.name')
        ->get()
        ->toArray();
        return $sports;

    }

    public function render() {

        return view('components.listing-data');
    }
}