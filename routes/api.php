<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NativeApi\AuthController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\NativeApi\TrainerProfileController;
use App\Http\Controllers\NativeApi\StudentProfileController;
use App\Http\Controllers\NativeApi\ReportController;
use App\Http\Controllers\NativeApi\ActivityController;
use App\Http\Controllers\ExerciseResultController;
use App\Http\Controllers\Api\Fitness365Controller;
use App\Http\Controllers\NativeApi\GeneralController;



Route::get('/app-version', function () {
    return response()->json([
        'latestVersion' => '1.7.4',
        'minVersion'    => '1.0.0',   
        'apkUrl'        => 'https://nep.goforfit.in/public/downloads/apk/app-release.apk',
        'releaseNotes'  => 'New updates are ready! Tap download to stay fit with our latest features.', 
        // 'releaseNotes'  => "• Bug fixes\n• Performance improvements\n• New dashboard",
        'forceUpdate'   => false
    ]);
});



Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:student-api')->group(function () {
    Route::get('/student/profile', [StudentProfileController::class, 'show']);
    Route::get('/student/dashboard', [StudentProfileController::class,'dashboard'])->name('students.dashboard');
    Route::get('/reports-download', [ReportController::class, 'downloadFitnessReport']);
    Route::get('daily-tracker', [StudentProfileController::class,'dailyreport']);
    Route::get('skill-report', [StudentProfileController::class,'SkillReports']);

    Route::get('activity-detail', [ActivityController::class,'ActivityDetail']);
    Route::get('school-records', [ActivityController::class,'schoolRecords']);
    Route::post('profile/update', [StudentProfileController::class, 'updateProfile']);
});

Route::middleware('auth:user-api')->group(function () {
    Route::get('/user/profile', [TrainerProfileController::class, 'show']);
    
});

Route::middleware('auth:student-api')->group(function () {
	Route::get('learn-sport', [ActivityController::class,'LearnSport']);
	Route::get('learn-sport/{id}', [ActivityController::class, 'SportsDetails']);
	Route::get('battery-of-test', [ActivityController::class, 'TestVideos']);
});

Route::middleware('auth:student-api,user-api')->group(function () {
	Route::get('activitylist', [GeneralController::class,'GetActivityList']);
	Route::get('getactivity', [GeneralController::class,'activityAccordingToClass']);
});








// This creates the URL: https://nep.goforfit.in/api/save-exercise-result
Route::post('/save-exercise-result', [ExerciseResultController::class, 'store']);


// fitness 365/cisce data api 

Route::get('states-data', [Fitness365Controller::class,'stateData']);
Route::get('states-fitness-data', [Fitness365Controller::class,'stateWiseFitnessData']);













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