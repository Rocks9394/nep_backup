<?php


namespace App\Helpers;
use DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Session;

class Helper
{
    public static function customSection($custom_class_id)
    {
		return DB::table('custom_classes')->where('id', $custom_class_id)->value('section'); 
    }
	
	 public static function LastTwoDates()
	 {
		$lastTwoDates = DB::table('reports')->select('date')->distinct()->orderBy('date', 'desc')->limit(7)->pluck('date');
		return $lastTwoDates;
	 }
	 
	/**
	 * 05-08-2024
	 * */
	 
	public static function className($class_id)
    {
        return DB::table('class')->where('id', $class_id)->value('name');
    }
	
	public static function changeToRoman($custom_class_id) {
    
		$string = DB::table('custom_classes')->select('nomenclature','section')->where('id', $custom_class_id)->first();

	    if(str_starts_with($string->nomenclature, 'Class')){
	        $number = trim($string->nomenclature, 'Class');
			$map = array('X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
			$returnValue = '';
			while ($number > 0) {
				foreach ($map as $roman => $int) {
					if($number >= $int) {
						$number -= $int;
						$returnValue .= $roman;
						break;
					}
				}
			}
			$classSection =	$returnValue.'-'.$string->section;
	    }else{
	        $classSection =	$string->nomenclature.'-'.$string->section;        
	    }
	    return $classSection;
	}
	
	public static function GetSchoolLogo()
	{
		$schoolId = null;

		if(auth()->guard('web')->check()){
			$user = Auth::user();
			$userRole = $user->role_id;

			if ($userRole == 4) {
				$schoolId = DB::table('school_reference')->where('school_user_id', $user->id)->where('status', 1)->value('school_id');
				
			} elseif ($userRole == 3) {

				if (Session::has('SelectSchoolId')) {
					$schoolId = Session::get('SelectSchoolId');
				} else {
					$schoolId = DB::table('school_trainers')->where('trainer_id', $user->id)->where('status', 1)->value('school_id');
				}

			}
		}else if(auth()->guard('sstudent')->check()){
			$schoolId = auth()->guard('sstudent')->user()->school_id;
		}
		$SchoolName = DB::table('schools')
		->select('school_name','logo')
		->where('id', $schoolId)->first();
		return $SchoolName;
	}
		
	public static function ClassSectionName($customId)
    {
		$classes = DB::table('custom_classes')
		->join('class', 'class.id', '=', 'custom_classes.class_id')
		->select('class.name','custom_classes.section')
		->where('custom_classes.id', $customId)
		->where('custom_classes.status', '1')
		->orderBy('custom_classes.orders', 'ASC')
		->first();
		
		return $classes;
    }

    public static function getClassAndSection($custom_class_id) {


    	$classData = DB::table('custom_classes')
	        ->join('class', 'class.id', '=', 'custom_classes.class_id')
	        ->where('custom_classes.id', $custom_class_id)
	        ->select(
	            'custom_classes.section',
	            DB::raw("CASE 
	                        WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
	                        THEN custom_classes.nomenclature 
	                        ELSE class.name 
	                    END AS class_name")
	        )
	        ->first();

	    if ($classData) {
	        return $classData->class_name . ' - ' . $classData->section;
	    }

	    return null;

	    
        /*$data =  DB::table('custom_classes')
        ->select('custom_classes.section','class.name')
        ->join('class','class.id','=', 'custom_classes.class_id')
        ->where('custom_classes.id', $custom_class_id)->get();
        foreach($data as $value){
        	$classandsection = $value->name .'-'.$value->section;
        }
        return $classandsection;*/
    }

	public static function getActiveTerm(){
		$SchoolId = Session::get('SelectSchoolId');
		$currentTerm = DB::table('term_masters')
			->select(
				'term_name',
				'academic_year',
				'term_start_date',
				'term_end_date'
			)
		->where('school_id', $SchoolId)
		->where('is_active', '1')
		->orderBy('id', 'DESC')
		->first();
			
		$activeTerm = false;

		if ($currentTerm && isset($currentTerm->term_end_date)) {
			$termEndDate = Carbon::parse($currentTerm->term_end_date);
			$today = Carbon::today();

			$activeTerm = $termEndDate->greaterThanOrEqualTo($today);
		}
		return $activeTerm;
	}

    public static function getSkillArea($skill_area_id){
    	return DB::table('skillareas')->where('id',$skill_area_id)->value('name');
    }

    public static function getSports($skillsports_id){
    	return DB::table('sports')->where('id',$skillsports_id)->value('name');
    }

    public static function getTechnique($technique_id){
    	return DB::table('techniques')->where('id',$technique_id)->value('name');
    }

    public static function getActivity($activity_id){
    	return DB::table('activity')->where('id',$activity_id)->value('title');
    }

    public static function getOtherDuties($other_duties_id){
    	return DB::table('trainer_other_duties')->where('id',$other_duties_id)->value('name');
    }

	public static function auditLog($actionType, $description = null)
    {
        if (Auth::check()) {

			DB::table('audit_logs')->insert([
				'user_id'     => Auth::id(),
				'action_type' => $actionType,
				'ip_address'  => Crypt::encryptString(request()->ip()),
				'user_agent'  => request()->header('User-Agent'),
				'description' => $description,
				'created_at'  => now(),
				'updated_at'  => now(),
			]);
        }
    }

    /**
     * Date: 24-10-2025
     * Get School Informations 
     * */

    public static function GetSchoolDetails() {
		
		$hasSchools = false;
		$SchoolDetails = null;
		if (Auth::guard('web')->check()) {
			$user = auth()->user();
		    $userId = $user->id;
		    $roleId = $user->role_id;

			switch ($roleId) {

				case 2: //School-User Dashboard
					$schoolRef = DB::table('school_reference')->where('school_user_id', $userId)->first();
					$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $schoolRef->school_id)->first();

					break;

				case 3:  //Trainer Dashboard
					$schoolId = DB::table('school_trainers')->where('trainer_id', $userId)->where('status', 1)->pluck('school_id')->toArray();

					if (Session::has('SelectSchoolId')) {
						$schoolId = Session::get('SelectSchoolId');
					} elseif (count($schoolId) === 1) {
						$schoolId = $schoolId[0];
					} else{
						$schoolId = null;
					}

					$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $schoolId)->first();
					break;

				case 4: //School Dashboard
					$schoolId = DB::table('school_reference')->where('school_user_id', $userId)->where('status', 1)->value('school_id');
					$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $schoolId)->first();

					break;

				case 9:
					$SchoolDetails = null;
					break;
				default:
					abort(403, 'Unauthorized access');
			}

		} elseif(Auth::guard('sstudent')->check()) {

			$stdInfo = Auth::guard('sstudent')->user();
			$SchoolDetails = DB::table('schools')->select('school_name','logo','school_code')->where('id', $stdInfo->school_id)->first();
		}
		return $SchoolDetails;
	}

}