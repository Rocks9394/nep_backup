<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sstudent extends Authenticatable
{
   use HasFactory;

   protected $guarded = [];
   protected $table = 'students';
 
   protected $fillable = ['school_id','school_code','student_uid','student_name','gender','class_id','custom_class_id','section_id','dob','user_id','password', 'email_id','rollno','status','last_updated','is_active'];

	// protected $guard = 'sstudent';

	
   public function getAuthIdentifierName() {
		return 'id';
	}

   // Define the password for authentication (date_of_birth)
	public function getAuthPassword() {
	  // return $this->dob;
		// return $this->student_uid;
		return $this->password;
	}

	public function getStudentIdAttribute()
    {
        return $this->school_id . $this->student_uid;
    }


	public function StudentReport()
	{
		return $this->hasMany(Report::class,'student_id');
	}
	
	
	
	
	public function class()
    {
        return $this->belongsTo(CustomClass::class, 'class_id');
    }
	
	
	public function customClass()
    {
        return $this->belongsTo(CustomClass::class, 'custom_class_id');
    }
	
	public function studentInfo()
    {
        return $this->hasOne(StudentInfo::class, 'student_id');
    }

	
}
