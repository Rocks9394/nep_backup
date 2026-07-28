<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\RpwdCategoryMapping;
use Illuminate\Support\Facades\Crypt;

class CwsnController extends Controller
{
    /**
     * Method to show all the cwsn Test category list.
     * Date : 09-07-2026
     * */
    public function showCWSNCategory($pwd_category_id) {


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

        // echo "<pre>"; print_r($mappedCategories); exit();
        
        $title = $categoryInfo->disability_category;

        return view('assessor.cwsn.pwd_specific_tests', compact('title', 'categoryInfo', 'mappedCategories','pwd_category_id'));
    }

    /**
     * Method to get all skill test for CWSN mapped with the available cwsn.
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


    public function CwsnTestTypes($pwd_category_id, $TestTypeId, $SeniorBMI = false) {

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
    
        
        $skillTypes = DB::table('skill_types')->where('skill_report_id',$skillReport->id)->where('status', 1)->get();
        $title = $skillReport->skill_name;

        // echo "<pre>"; print_r($title);exit();

        switch ($skillReport->skill_name) {

            case '20-m PACER':
            case 'Modified 15-m PACER':
                return view('assessor.cwsn.forms.pacer', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','pwd_category_id'));
                break;

            case 'One-mile run/walk':

                return view('assessor.cwsn.forms.speed', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','pwd_category_id'));
                break;

            case 'Curl-up':
            case 'Modified Curl-up':
                return view('assessor.cwsn.forms.curlup', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));

            case 'BMI':

                return view('assessor.cwsn.forms.cwsn-bmi', compact('title', 'skillTypes','skillReportId','TestTypeMasterID', 'classes', 'SchoolId','pwd_category_id'));
                break;

            case 'Push-up':
            case 'Dumbbell Press':
            case 'Pull-up':
            case 'Modified Pull-Up':
                return view('assessor.cwsn.forms.pushup', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
                break;

            case 'Trunk Lift':
                
                return view('assessor.cwsn.forms.trunk-lift', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
                break;
            
            case 'Back Saver Sit and Reach':
                return view('assessor.cwsn.forms.sit-and-reach', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
                break;

            case 'Reverse curl':
                return view('assessor.cwsn.forms.reverse_curl', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
                break;

            case 'Seated Push-up':
            case 'Isometric Push-up':
                return view('assessor.cwsn.forms.seated-pushup', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
                break;
            case 'Shoulder Stretch':

                return view('assessor.cwsn.forms.shoulder-streatch', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
                break;

            case 'Modified Apley Test':
                
                return view('assessor.cwsn.forms.apleytest', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId'));
                break;
            default:

                echo "default route"; exit;
                return view('assessor.cwsn.forms.pacer', compact('title', 'skillTypes', 'skillReportId', 'TestTypeMasterID', 'classes', 'SchoolId','pwd_category_id'));
                break;
        }
    }
}
