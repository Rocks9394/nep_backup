<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NativeApi\AuthController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\NativeApi\TrainerProfileController;
use App\Http\Controllers\NativeApi\StudentProfileController;




Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:student-api')->group(function () {

    Route::get('/student/profile', [StudentProfileController::class, 'show']);
    Route::get('/student/dashboard', [StudentProfileController::class,'dashboard'])->name('students.dashboard');
  
});


Route::middleware('auth:user-api')->group(function () {
    Route::get('/user/profile', [TrainerProfileController::class, 'show']);
    
});
















Route::get('getclass', [App\Http\Controllers\Api\GetActivityController::class,'getclass']);	
Route::get('getsubject', [App\Http\Controllers\Api\GetActivityController::class,'getsubject']);
Route::get('getchapter', [App\Http\Controllers\Api\GetActivityController::class,'getchapter']);		
Route::get('getconcept', [App\Http\Controllers\Api\GetActivityController::class,'getconcept']);

Route::get('academicactivity', [App\Http\Controllers\Api\GetActivityController::class,'academicactivity']);	
Route::get('sportsactivity', [App\Http\Controllers\Api\GetActivityController::class, 'sportsactivity']);
	
Route::post('getacademicactivity', [App\Http\Controllers\Api\GetActivityController::class,'academicactivity']);	
Route::post('getsportsactivity', [App\Http\Controllers\Api\GetActivityController::class, 'sportsactivity']);
 






//Fitness API APP

//Sleep Module
 	Route::post('sleep/addsleep', [App\Http\Controllers\Api\SleepController::class,'store']);
	Route::get('sleep', [App\Http\Controllers\Api\SleepController::class,'index']);
	Route::post('sleep/updategoal', [App\Http\Controllers\Api\SleepController::class,'goal']);
	
  
//Water
	Route::post('water/addwater', [App\Http\Controllers\Api\WaterController::class,'store']);
	Route::get('water', [App\Http\Controllers\Api\WaterController::class,'index']);
	Route::post('water/updategoal', [App\Http\Controllers\Api\WaterController::class,'goal']);	

//Steps
	Route::post('step/addstep', [App\Http\Controllers\Api\StepController::class,'store']);
	Route::get('step', [App\Http\Controllers\Api\StepController::class,'index']);
	Route::post('step/updategoal', [App\Http\Controllers\Api\StepController::class,'goal']);

//tips
	Route::get('tips', [App\Http\Controllers\Api\TipsController::class,'index']);
	
	/***************************************Nagendra Kumar 27-08-2021 *******************************************/
	
	Route::get('foodchart', [App\Http\Controllers\Api\FoodChartController::class,'index']);
	Route::get('location', [App\Http\Controllers\Api\LocationController::class,'index']);
	
	/***************************************Nagendra Kumar 27-08-2021 *******************************************/
	
	Route::get('foodname', [App\Http\Controllers\Api\FoodChartController::class,'foodname']);
	Route::get('servingquantity', [App\Http\Controllers\Api\FoodChartController::class,'servingquantity']);	

	Route::post('food/calorieintake', [App\Http\Controllers\Api\FoodChartController::class,'calorieintake']);
	Route::get('getcalorieintake', [App\Http\Controllers\Api\FoodChartController::class,'calorieintakeget']);
	Route::delete('food/deletecalorieintake',[App\Http\Controllers\Api\FoodChartController::class,'destroy']);  
		
/*	
	Route::post('user/userinfo', [App\Http\Controllers\Api\UserInfo::class,'store']);
	Route::get('user/userinfo', [App\Http\Controllers\Api\UserInfo::class,'index']);
	Route::post('user/create', [App\Http\Controllers\Api\UserController::class,'store']);
	Route::post('user/login', [App\Http\Controllers\Api\UserController::class,'login']);
	Route::post('user/logout', [App\Http\Controllers\Api\UserController::class, 'logout']);
	Route::post('user/profile', [App\Http\Controllers\Api\UserController::class, 'userProfile']);
	Route::post('user/update', [App\Http\Controllers\Api\UserController::class, 'update']);
	Route::post('user/update_new', [App\Http\Controllers\Api\UserController::class, 'update_new']);
    
//Check User Exist
	Route::post('user/check', [App\Http\Controllers\Api\UserController::class, 'check']);

//Current Logged in User
    Route::post('user/current', [App\Http\Controllers\Api\UserController::class,'getAuthUser']);





//

*/