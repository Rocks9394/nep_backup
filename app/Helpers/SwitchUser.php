<?php


namespace App\Helpers;
use DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Models\TermMaster;
use Session;

class SwitchUser {
	

    public static function switchuser($userid, $termid) {

		if (Session::has('student_id')) {
            $student_id = Session::get('student_id');
        }else{
            $student_id = $userid;
        }

        $SchoolId = DB::table('students')->where('id', $student_id)->value('school_id');
        $selectedYear = TermMaster::find($termid)->academic_year;
        $admissionNumber = DB::table('students')->where('id',$student_id)->value('student_uid');
        $studentId = DB::table('students')->where('school_id', (string) $SchoolId)->where('academic_year', $selectedYear)->where('student_uid', $admissionNumber)->value('id');

        return $studentId;
    }

    

}