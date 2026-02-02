<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\UserController;
//use App\Http\Controllers\Admin\Auth\PostController;
use App\Http\Controllers\Admin\Auth\ActivityController;

use App\Http\Controllers\Admin\Auth\ClassController;
use App\Http\Controllers\Admin\Auth\SubjectController;
use App\Http\Controllers\Admin\Auth\ChapterController;
use App\Http\Controllers\Admin\Auth\ConceptController;
use App\Http\Controllers\Admin\Auth\BulkconceptController;
use App\Http\Controllers\Admin\Auth\TagController;
use App\Http\Controllers\Admin\Auth\ActivityWeaknessController;
use App\Http\Controllers\Admin\Auth\ImportController;
use App\Http\Controllers\Admin\Auth\SportsController;
use App\Http\Controllers\Admin\Auth\SkillController;
use App\Http\Controllers\Admin\Auth\SportskillController;
use App\Http\Controllers\Admin\Auth\TechniqueController;
use App\Http\Controllers\Admin\Auth\SchollController;
use App\Http\Controllers\Admin\Auth\TeacherController;
use App\Http\Controllers\Admin\Auth\SchoolimportController;
use App\Http\Controllers\Admin\Auth\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\StudentDashboardController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentRecordController;
use App\Http\Controllers\SchoolRecordController;
use App\Http\Controllers\ParentDashoboardController;
use App\Http\Controllers\AssessorAppController;

use App\Http\Controllers\Auth\PasswordRecoveryControlller;
use App\Http\Controllers\Auth\ChangePasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/debug', function () {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Code to debug
    throw new Exception('This is a test exception!');
});



Route::get('get_classes_schoolwise', [App\Http\Controllers\Academy::class, 'getClassesSchoolWise'])->name('get_classes_schoolwise');

Route::get('/assessor-app-index', [App\Http\Controllers\AssessorAppController::class, 'index']);
Route::get('/assessor-app-agility', [App\Http\Controllers\AssessorAppController::class, 'agility']);
//Route::get('/assessor-app-locomotor-skills', [App\Http\Controllers\AssessorAppController::class, 'locomotorSkills'])->name('locomotor.skills');
Route::get('/assessor-app-manipulative-skills', [App\Http\Controllers\AssessorAppController::class, 'manipulativeSkills'])->name('manipulative.skills');
Route::get('/assessor-app-body-management', [App\Http\Controllers\AssessorAppController::class, 'bodyManagement'])->name('body.management');
Route::get('/assessor-app-plate-tapping', [App\Http\Controllers\AssessorAppController::class, 'plateTapping'])->name('assessor.app.plate.tapping');
Route::get('/assessor-app-flamingo', [App\Http\Controllers\AssessorAppController::class, 'flamingo'])->name('assessor.app.flamingo');
Route::get('/assessor-app-muscular-endurance', [App\Http\Controllers\AssessorAppController::class, 'MuscularEndurance'])->name('assessor.app.muscular-endurance');
Route::get('/assessor-app-running', [App\Http\Controllers\AssessorAppController::class, 'running']);
Route::get('/assessor-app-speed', [App\Http\Controllers\AssessorAppController::class, 'speed'])->name('assessor.app.speed');
Route::get('/assessor-app-strength', [App\Http\Controllers\AssessorAppController::class, 'strength'])->name('assessor.app.strength');
Route::get('/assessor-app-flexibility', [App\Http\Controllers\AssessorAppController::class, 'flexibility'])->name('assessor.app.flexibility');
#Route::get('/assessor-app-bmi', [App\Http\Controllers\AssessorAppController::class, 'bmi'])->name('assessor.app.bmi');

Route::get('/assessor-app-scan', [App\Http\Controllers\AssessorAppController::class, 'scan'])->name('scan');
Route::get('/assessor-app-enter-test', [App\Http\Controllers\AssessorAppController::class, 'enterTest']);
Route::get('/assessor-app-student-code', [App\Http\Controllers\AssessorAppController::class, 'studentCode']);

Route::get('/testfile', [App\Http\Controllers\AssessorAppController::class, 'TestPage']);
Route::get('/reportsPage', [App\Http\Controllers\AssessorAppController::class, 'ReportsPage']);
Route::get('/reports-senior', [App\Http\Controllers\AssessorAppController::class, 'TestPageS']);
Route::get('primary-class', [App\Http\Controllers\AssessorAppController::class, 'PrimaryCLassReport']);
Route::get('primary-class-report', [App\Http\Controllers\AssessorAppController::class, 'PrimaryCLassReportHtml']);




Route::get('get_students_roll', [AssessorAppController::class, 'getStudentsRoll'])->name('studentRollNo.autocomplete');
Route::post('delete-student-test', [App\Http\Controllers\AssessorAppController::class, 'clearExistingRecords'])->name('delete-student-test');


Route::group(['middleware' => 'auth'], function () {
	//Dynamic URL For Junior Reports
	Route::get('/assessor-app-alltests', [App\Http\Controllers\AssessorAppController::class, 'alltests'])->name('all-test');
	Route::get('/assessor-app-test/{TestcategoryId}', [App\Http\Controllers\AssessorAppController::class, 'locomotorSkills'])->name('assessor-app-test');
	Route::get('/assessor-app-physical-test/{TestcategoryId}', [App\Http\Controllers\AssessorAppController::class, 'PhysicalSkills'])->name('assessor.app.physical.test');
	Route::get('/assessor-app-physical-senior-test/{TestcategoryId}/{SeniorBMI}', [App\Http\Controllers\AssessorAppController::class, 'PhysicalSkills'])->name('assessor.app.physical.senior.test');
	Route::get('/assessor-app-fms-skills/{TestTypeId}', [App\Http\Controllers\AssessorAppController::class, 'FMSTypes'])->name('fms-types');
	Route::get('/assessor-app-fms-skills-senior/{TestTypeId}/{SeniorBMI}', [App\Http\Controllers\AssessorAppController::class, 'FMSTypes'])->name('fms-types-senior');
	Route::post('assessor-app-fms-types-submit',[App\Http\Controllers\AssessorAppController::class, 'SubmitFMSType'])->name('fms.types.submit');
	Route::get('/fetch-student', [App\Http\Controllers\AssessorAppController::class, 'fetchStudentDetail'])->name('fetch.student.detail');
	Route::get('/assessor-app-bmi', [App\Http\Controllers\AssessorAppController::class, 'bmi'])->name('assessor.app.bmi');
	Route::post('assessor-app-bmi-record-submit',[App\Http\Controllers\AssessorAppController::class, 'SubmitBMIRecord'])->name('bmi.record.submit');
	Route::post('assessor-app-flamingo-record-submit',[App\Http\Controllers\AssessorAppController::class, 'SubmitFlamingoRecord'])->name('flamingo.record.submit');
	Route::post('assessor-app-plate-tapping-record-submit',[App\Http\Controllers\AssessorAppController::class, 'SubmitPlateTappingRecord'])->name('plate.tapping.record.submit');
	Route::post('assessor-app-push-up-record-submit',[App\Http\Controllers\AssessorAppController::class, 'SubmitPushUpRecord'])->name('push.up.record.submit');
	Route::post('assessor-app-partial-curl-up-record-submit',[App\Http\Controllers\AssessorAppController::class, 'SubmitPartialCurlUpRecord'])->name('partial.curl.up.record.submit');
	Route::post('assessor-app-sit-and-reach-record-submit',[App\Http\Controllers\AssessorAppController::class, 'SubmitSitAndReachRecord'])->name('sit.and.reach.record.submit');
	Route::post('assessor-app-speed-record-submit',[App\Http\Controllers\AssessorAppController::class, 'SubmitSpeedRecord'])->name('speed.record.submit');

	// to view reports on trainer 
	Route::get('higherclass1/status', [AssessorAppController::class, 'TestStatusHigherClass'])->name('trainer.higherclass.status');
	Route::get('lowerclass2/status', [AssessorAppController::class, 'TestStatusLowerClass'])->name('trainer.lowerclass.status');
	Route::get('report/{id}', [AssessorAppController::class, 'ViewFitnessReport'])->name('trainer.reports.view');


});



//Route::get('/', function (){return view('home');}); 
Route::get('/academyhome', [App\Http\Controllers\HomeController::class, 'academyHome'])->name('academyhome');
Route::get('/sport', [App\Http\Controllers\HomeController::class, 'index'])->name('sport');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
//Route::view('concepts','concepts');
Route::get('/chapter', [App\Http\Controllers\HomeController::class, 'chapter'])->name('chapter');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/chapter_details/{id}',[App\Http\Controllers\HomeController::class, 'chapter_details'])->name('chapter_details');
Route::get('/activity_details/{id}',[App\Http\Controllers\HomeController::class, 'activity_details'])->name('activity_details');



Auth::routes();
Route::post('get-district', [RegisterController::class,'getDistrict'])->name('getdistrict');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware'=>'auth.auth_student'],function()
{

    Route::get('/parent-dashboard', [ParentDashoboardController::class, 'index'])->name('parent-dashboard');
    
    Route::post('/update-profile', [ParentDashoboardController::class, 'updateProfile'])->name('updateProfile');

    Route::post('/recordcalories', [ParentDashoboardController::class, 'foodstore'])->name('record.calories');
    Route::post('/set-calorie-target', [ParentDashoboardController::class, 'setCalorieTarget'])->name('setCalorieTarget');
    Route::delete('/delete-meal/{id}', [ParentDashoboardController::class, 'deleteMeal'])->name('delete-meal');

    Route::post('/water-intake', [ParentDashoboardController::class, 'waterstore'])->name('water-intake.store');
    Route::get('/water-intake-by-date', [ParentDashoboardController::class, 'showByDate'])->name('water-intake.by-date');

    Route::post('/day-sleep/store', [ParentDashoboardController::class, 'storeDaySleep'])->name('day.sleep.store');
    Route::post('/night-sleep/store', [ParentDashoboardController::class, 'storeNightSleep'])->name('night.sleep.store');
    Route::get('/sleep-history', [ParentDashoboardController::class, 'showHistory'])->name('sleep.history');


});




Route::namespace("Admin")->prefix('admin')->group(function(){
	Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');
	
	Route::namespace('Auth')->group(function(){				
		Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
		Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');
		Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
		Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.postlogin');
		Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
				
	});
});

Route::group(['prefix'=>'admin', 'as'=>'admin.', 'middleware'=>'auth:admin'], function(){	
	Route::resource('users', UserController::class); 
	Route::post('user-district', [UserController::class,'getDistrict'])->name('userdistrict');
	Route::post('userrole', [UserController::class,'userRole'])->name('userrole');
	Route::get('status/{type}/{id}',[UserController::class,'status']);
	Route::get('userdetails',[UserController::class,'Userdetails'])->name('userdetails');
	Route::resource('sports', SportsController::class);
	Route::resource('skills', SkillController::class);
	Route::get('clsskill',[SkillController::class,'clsSkill'])->name('clsskill');
	Route::post('storeclsskill',[SkillController::class,'storeclsSkill'])->name('storeclsskill');
	Route::resource('techniques', TechniqueController::class);
	Route::resource('sportskills', SportskillController::class);
	//Route::resource('posts', PostController::class);  
	Route::resource('activities', ActivityController::class);	
	Route::resource('classes', ClassController::class);    
	Route::resource('subjects', SubjectController::class);    
	Route::resource('chapters', ChapterController::class);    
	Route::resource('concepts', ConceptController::class);  
	Route::resource('bulkconcepts', BulkconceptController::class);  
	Route::resource('tags', TagController::class);  
	Route::resource('actweakness', ActivityWeaknessController::class);
	Route::resource('schools' , SchollController::class);
	Route::post('school-district', [SchollController::class,'getschoolDistrict'])->name('school-district');
	Route::resource('teachers' , TeacherController::class);
	Route::post('teacher-district', [TeacherController::class,'getteacherDistrict'])->name('teacher-district');
	
	Route::get('importactivity', [ImportController::class, 'importActivity'])->name('importActivity');
	// Route::get('importactivity', [ImportController::class, 'importActivity'])->name('importActivity');
	

	/* Manage Activity */
	Route::get('manage-activity', [ImportController::class, 'manageActivity'])->name('manage-activity');
	Route::post('import-activity', [ImportController::class, 'importActivities'])->name('import-activity');
	Route::get('import/errorlist', [ImportController::class, 'downloadErrorList'])->name('errorlist');
	Route::get('download/{val}', [ImportController::class, 'downloadTemplate'])->name('download-template');
	Route::get('duplicate-activities', [ImportController::class, 'duplicateActivities'])->name('duplicateactivities');
	



	Route::post('import', [ImportController::class, 'import'])->name('import');
	Route::get('importchapter', [ImportController::class, 'importChapter'])->name('importChapter');
	Route::post('chapimport', [ImportController::class, 'chapimport'])->name('chapimport');	
	
	Route::post('import', [ImportController::class, 'import'])->name('import');
	Route::get('importchapter', [ImportController::class, 'importChapter'])->name('importChapter');
	Route::post('chapimport', [ImportController::class, 'chapimport'])->name('chapimport');
	
	Route::get('importconcept', [ImportController::class, 'importConcept'])->name('importconcept');
	Route::post('conceptimport', [ImportController::class, 'conceptImport'])->name('conceptimport');
	
	Route::get('clssport',[SportsController::class,'clsSports'])->name('clssport');
	Route::post('storeclssports',[SportsController::class,'storeclsSports'])->name('storeclssports');
	Route::get('clstech',[TechniqueController::class,'clsTech'])->name('clstech');
	Route::post('storeclstech',[TechniqueController::class,'storeclsTech'])->name('storeclstech');
	
	Route::get('upload',[SchoolimportController::class,'schoolDetail'])->name('upload');
	Route::post('schoolimport',[SchoolimportController::class,'schoolImport'])->name('schoolimport');
	
	Route::get('teacherupload',[SchoolimportController::class,'teacherDetail'])->name('teacherupload');
	Route::post('submitteacher',[SchoolimportController::class,'teacherImport'])->name('submitteacher');
	Route::resource('students' , StudentController::class);
	
	Route::get('import-teachers',[App\Http\Controllers\Admin\ImportData::class,'importteachers'])->name('importteachers');
	Route::post('import-teachers',[App\Http\Controllers\Admin\ImportData::class,'uploadteachers'])->name('uploadteachers');
	
	Route::get('concept_export',[ConceptController::class,'conceptExport'])->name('concept_export');
	Route::post('updateconcept', [ImportController::class, 'updateImportConcept'])->name('updateconcept');	
	
	Route::get('chapter_export',[ChapterController::class,'chapterExport'])->name('chapter_expor');
	Route::post('updatechapter', [ImportController::class, 'updateImportChapter'])->name('updatechapter');	
	
});


// 23-09 trainer profile update 
Route::get('editprofile/{id}', [App\Http\Controllers\ViewTrainerController::class, 'trainerProfile'])->name('editprofile');
Route::put('update-profile/{id}',[App\Http\Controllers\ViewTrainerController::class, 'trainerUpdate'])->name('update-profile');

Route::get('modify-trainer-record',[App\Http\Controllers\ViewTrainerController::class, 'modifyTrainerRecord'])->name('modify.trainer.record');
Route::post('modify-trainer-record-submit',[App\Http\Controllers\ViewTrainerController::class, 'modifyTrainerRecordSubmit'])->name('modify.trainer.record.submit');

Route::post('getReport',[App\Http\Controllers\ViewTrainerController::class, 'getReport'])->name('getReport');
Route::get('showlist',[App\Http\Controllers\ViewTrainerController::class, 'showlist'])->name('showlist');

Route::get('getactive', [App\Http\Controllers\PEActivityController::class, 'getactive'])->name('getactive');
Route::get('getactive-test', [App\Http\Controllers\PEActivityController::class, 'getactiveTest'])->name('getactiveTest');



/**
 * 19-06-2024
 * Route for handling all report.
 * */
Route::get('skills-report', [ReportController::class,'index'])->name('skill-report');
Route::post('generate-reportcards', [ReportController::class, 'queueBulkReportCards'])->name('generate.reportcards');

/* Download Generated Report Cards */

Route::get('report/download/{batchId}', [ReportController::class, 'requestDownload'])->name('report.download.permanent');
Route::get('report/download/{batchId}/signed', [ReportController::class, 'downloadSigned'])->name('report.download.signed');


Route::get('reports/{id}/{term_id}', [ReportController::class, 'ViewFitnessReport'])->name('reports.view.test');
Route::get('reports/{id}/{term_id}/download', [ReportController::class, 'downloadFitnessReport'])->name('download.fitness.reports');
Route::get('/fitness-report/available', [ReportController::class, 'CheckReportAvailablity'])->name('fitness.report.available');





/**
 * 21-06-2024
 * Students/Parent Dashboard
 * */

Route::middleware('auth.auth_student')->group(function () {
	// testing dashboard
	Route::get('student/dashboard', [StudentDashboardController::class, 'dashboard'])->name('student.test.dashboard');
	
	Route::get('student-dashboard', [StudentRecordController::class, 'index'])->name('student.dashboard');
	Route::get('skill-report', [StudentRecordController::class,'skillReport'])->name('skill.report');
	Route::get('daily-tracker', [StudentRecordController::class,'dailyreport'])->name('skill.dailyreport');
	Route::get('dashboard' , [StudentRecordController::class, 'dashboard'])->name('dashboard');
	
	Route::get('viewReport' , [StudentRecordController::class, 'ViewFitnessReport'])->name('student.report');
	
	Route::get('fms-skills-report', [StudentRecordController::class,'FMSskillReport'])->name('fms.skills.reports');
	
	Route::get('fms-skills-report-pdf', [StudentRecordController::class,'FMSskillReportPDF'])->name('fms.skills.reports.pdf');
		
	Route::get('parent-fitness-assessment-report', [StudentRecordController::class,'FitnessAssessment'])->name('parent.fitness.assessment.report');
 
	/* Temperory route for testing purpose */
	Route::get('reporttest', [StudentRecordController::class,'skillReportTest'])->name('skill.report2'); 
	Route::get('student-profile', [StudentRecordController::class,'viewProfile'])->name('student.profile');
	Route::put('student-profile-update', [StudentRecordController::class,'updateProfile'])->name('profile.update');
	

});


/**
 * 21-06-2024
 * Principal/School Dashboard
 * */
Route::prefix('school')->group(function(){  
	
	//Route::get('dashboard', [SchoolRecordController::class,'SchoolDashboard'])->name('schoolDashboard');
	//Route::get('viewdart', [SchoolRecordController::class,'viewSchoolDart'])->name('viewschooldart');

	

	Route::get('manage-student', [SchoolRecordController::class,'ManageStudents'])->name('managestudent')->middleware('module_access:managestudent');	
	Route::post('updatedob', [SchoolRecordController::class,'updatedob'])->name('updatedob');
	Route::post('updateEmail', [SchoolRecordController::class,'updateEmail'])->name('updateEmail');
	Route::post('updateName', [SchoolRecordController::class,'updateName'])->name('updateName');
	Route::post('updateRollNo', [SchoolRecordController::class,'updateRollNo'])->name('updateRollNo');
	Route::post('updateAdmissionNo', [SchoolRecordController::class,'updateAdmissionNo'])->name('updateAdmissionNo');
	Route::post('rollNoSuggestion', [SchoolRecordController::class,'rollNoSuggestion'])->name('rollNoSuggestion');

	Route::post('updatesection', [SchoolRecordController::class,'UpdateSection'])->name('updatesection');
	Route::post('addstudent',[SchoolRecordController::class, 'addStudent'])->name('addstudent');
	Route::post('getclasssection', [SchoolRecordController::class, 'getClassSection'])->name('getclasssection');
	Route::post('changegender',[SchoolRecordController::class, 'changeGender'])->name('changegender');
	Route::post('changestatus',[SchoolRecordController::class, 'changeStatus'])->name('changestatus');

	Route::get('fetchStudents',[SchoolRecordController::class, 'fetchStudents'])->name('fetchStudents');


	Route::get('mapping-sports', [SchoolRecordController::class,'MapSports'])->name('mapping.sports')->middleware('module_access:mapping.sports');
	Route::put('mapping-sports/{id}', [SchoolRecordController::class,'SaveMappedSports'])->name('mapping.sports.update');
	
	/* Handle Trainers */
	Route::get('map-trainer', [SchoolRecordController::class,'MapTrainer'])->name('mapping.trainer')->middleware('module_access:mapping.trainer');;
	Route::get('autocomplete-trainer', [SchoolRecordController::class, 'autocomplete'])->name('autocomplete.trainer');
	Route::post('trainer-map', [SchoolRecordController::class, 'MapTrainer'])->name('trainer.map');
	Route::post('trainer-unmap', [SchoolRecordController::class, 'UnMapTrainer'])->name('trainer.unmap');
	Route::post('remove-trainer', [SchoolRecordController::class, 'RemoveTrainer'])->name('remove.trainer');


	/* download template for bulk upload */
	Route::get('download-template', [SchoolRecordController::class, 'downloadTemplate'])->name('download-template');
	Route::get('sample-data', [SchoolRecordController::class, 'sampleData'])->name('sample-data');
	Route::get('import/download-duplicates', [SchoolRecordController::class, 'downloadDuplicates'])->name('downloadDuplicates');
	Route::get('import/downloadErrorList', [SchoolRecordController::class, 'downloadErrorList'])->name('downloadErrorList');	
	Route::post('import-student-data', [SchoolRecordController::class, 'importStudentData'])->name('import-student-data');

	
	/* Generate I-Card */
	Route::post('generate-card', [SchoolRecordController::class, 'generateIdCard'])->name('generatecard');
    Route::post('generate-credentials', [SchoolRecordController::class, 'generateCredentials'])->name('generatecredentials');
	// Class-section wise credential generation
	Route::post('/get-class-section-summary', [SchoolRecordController::class, 'getClassSectionSummary'])->name('get.class.section.summary');
	Route::post('/generate-class-section-credentials', [SchoolRecordController::class, 'generateClassSectionCredentials'])->name('generate.class.section.credentials');

	/* Report Cards */
	Route::get('fms-report', [SchoolRecordController::class, 'FMSReport'])->name('fms.report');
	Route::get('fitness-report', [SchoolRecordController::class, 'FitnessReports'])->name('fitness.report')->middleware('module_access:fitness.report');
	Route::get('reports/{id}', [SchoolRecordController::class, 'ViewFitnessReport'])->name('reports.view');
	
	/* On Development Phase  */
	Route::get('fitness-report-test', [ReportController::class, 'FitnessReports'])->name('fitness.report.test')->middleware('module_access:fitness.report');


	Route::get('reports-cbse/{id}', [ReportController::class, 'ViewCbseReport'])->name('reports.cbse');




	Route::get('test-relay-auth', [SchoolRecordController::class,'DOTNETREPORT'])->name('test.relay.auth');

	/*Activity Gallary */  
	Route::get('activity.gallary', [SchoolRecordController::class,'ActivityGallary'])->name('activity.gallary');
	

	Route::get('get-student-according-class', [SchoolRecordController::class, 'getStudentAccordingToClass'])->name('get.student.according.class'); 
	Route::get('school-fms-skills-report', [SchoolRecordController::class,'SchoolFMSskillReport'])->name('school.fms.skills.reports');
	
	Route::get('school-fms-skills-report-pdf', [SchoolRecordController::class,'SchoolFMSskillReportPDF'])->name('school.fms.skills.reports.pdf');

    Route::get('school-fms-skills-multiple-pdf-download', [SchoolRecordController::class,'multiplePDFDOwnload'])->name('school.fms.skills.multiple.pdf.download');
	
	// update school profile 
	Route::get('profile', [SchoolRecordController::class, 'viewProfile'])->name('update.profile');
    Route::put('profile/{id}', [SchoolRecordController::class,'updateProfile'])->name('school.profile.update');


	Route::get('school-user', [SchoolRecordController::class, 'schoolUsers'])->name('school.user');
    Route::post('add-school-user', [SchoolRecordController::class,'addSchoolUsers'])->name('add.school.user');


    Route::get('create-users', [SchoolRecordController::class, 'CreateUsers'])->name('create.users')->middleware('module_access:create.users');
	Route::post('viewers/store', [SchoolRecordController::class, 'StoreViewers'])->name('viewers.store');
	Route::post('users/action', [SchoolRecordController::class, 'handleUsersAction'])->name('users.action');
	Route::post('export-users', [SchoolRecordController::class, 'exportSchoolUsers'])->name('export.school.users');
	Route::post('update-viewer-details', [SchoolRecordController::class, 'updateViewer'])->name('update.viewer.details');

	Route::get('students-sports', [SchoolRecordController::class, 'StudentsSportsMapping'])->name('students-sports-mapping')->middleware('module_access:managestudent');
	Route::post('students-sports/export', [SchoolRecordController::class, 'ExportStudentsSportsMapping'])->name('expoort.students-sports-mapping');
   

	/* Change Password */
	Route::get('password/change', [ChangePasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('security-settings/questions', [ChangePasswordController::class, 'updateQuestions'])->name('security.update-questions');
    Route::post('security-settings/password', [ChangePasswordController::class, 'updatePassword'])->name('security.update-password')->middleware(['auth', 'check.questions']);

	// login as student routes 
	Route::post('login-as-student', [SchoolRecordController::class, 'loginAsStudent'])->name('school.loginAsStudent');
    Route::post('leave-student', [SchoolRecordController::class, 'leaveStudent'])->name('school.leaveStudent');

	
	// for uploading test score via excel 

	Route::get('/upload-test-data', [AssessorAppController::class, 'uploadTestData'])->name('upload.test.data');
	Route::get('/sample-score', [AssessorAppController::class, 'testScoreSample'])->name('test.sample');
	Route::post('/test-templete', [AssessorAppController::class, 'downloadTestTemplete'])->name('test.templete');
	Route::post('/import-test-data', [AssessorAppController::class, 'importTestData'])->name('import.test.data');

	Route::get('download-test-file/{logId}', [AssessorAppController::class, 'downloadTestUploadedFile'])->name('download.testuploadedfile');
	Route::get('uploaded-error-file/{logId}', [AssessorAppController::class, 'downloadTestErrorFile'])->name('download.testerrorfile');

	
});

Route::get('school-dashboard-graph', [SchoolRecordController::class,'SchoolDashboardGraph'])->name('schoolDashboardGraph')->middleware('module_access:schoolDashboard');
Route::get('school-dashboard', [SchoolRecordController::class,'SchoolDashboard'])->name('schoolDashboard')->middleware('module_access:schoolDashboard');
Route::get('viewdart', [SchoolRecordController::class,'viewSchoolDart'])->name('viewschooldart')->middleware('module_access:viewschooldart');
Route::post('viewdart',[SchoolRecordController::class, 'getReport'])->name('getDartReport');
Route::get('skillsreport',[SchoolRecordController::class, 'skillreport'])->name('skillreport');


Route::get('view-trainer',[App\Http\Controllers\ViewTrainerController::class, 'index'])->name('view-trainer');
Route::post('view-trainer',[App\Http\Controllers\ViewTrainerController::class, 'getTrainerReport'])->name('getTrainerReport');



Route::get('customlogin', [App\Http\Controllers\Auth\LoginController::class, 'showCustomLoginForm'])->name('customlogin');

// save term in session 
Route::post('/save-term-session', function (Illuminate\Http\Request $request) {
    session(['term_id' => $request->term_id]);
    return response()->json(['success' => true]);
})->name('save.term.session');








Route::get('importactivity', [ImportController::class, 'importActivity'])->name('importActivity');
Route::get('importchapter', [ImportController::class, 'importChapter'])->name('importChapter');
//Route::post('activityconcept',[App\Http\Controllers\Admin\Academy::class, 'saveactivityconcept'])->name('activityconcept');
Route::post('activityconcept',[App\Http\Controllers\Admin\Auth\ActivityController::class, 'saveactivityconcept'])->name('activityconcept');
Route::post('activitytechnique',[App\Http\Controllers\Admin\Auth\ActivityController::class, 'activitytechnique'])->name('activitytechnique');
Route::get('/copy/{id}',[App\Http\Controllers\Admin\Auth\ActivityController::class, 'activity_copy'])->name('activity_copy');

Route::post('conceptsdelete',[App\Http\Controllers\Admin\Auth\ActivityController::class, 'conceptsdelete'])->name('conceptsdelete');
Route::post('techniquedelete',[App\Http\Controllers\Admin\Auth\ActivityController::class, 'techniquedelete'])->name('techniquedelete');


Route::post('/savesports',[App\Http\Controllers\Admin\Auth\PostController::class, 'savesports'])->name('savesports');
Route::post('/class_delete',[App\Http\Controllers\Admin\Auth\PostController::class, 'class_delete'])->name('class_delete');
Route::post('/sportdelete',[App\Http\Controllers\Admin\Auth\PostController::class, 'sportdelete'])->name('sportdelete');
Route::post('/skldelete',[App\Http\Controllers\Admin\Auth\PostController::class, 'skldelete'])->name('skldelete');
Route::post('/saveskills',[App\Http\Controllers\Admin\Auth\PostController::class, 'saveskills'])->name('saveskills');
Route::post('/getclssubject',[App\Http\Controllers\Admin\Auth\PostController::class, 'getclssubject'])->name('getclssubject');
Route::post('/saveclass', [App\Http\Controllers\Admin\Auth\PostController::class, 'saveclass'])->name('saveclass');
Route::post('/savesubject', [App\Http\Controllers\Admin\Auth\PostController::class, 'savesubject'])->name('savesubject');
Route::post('/savechapter', [App\Http\Controllers\Admin\Auth\PostController::class, 'savechapter'])->name('savechapter');
Route::post('/saveconcept', [App\Http\Controllers\Admin\Auth\PostController::class, 'saveconcept'])->name('saveconcept');

Route::get('gets_subject', [App\Http\Controllers\Admin\Academy::class, 'gets_subject'])->name('gets_subject');
Route::get('get_chapters', [App\Http\Controllers\Admin\Academy::class, 'get_chapters'])->name('get_chapters');
Route::get('get_concepts', [App\Http\Controllers\Admin\Academy::class, 'get_concepts'])->name('get_concepts');

Route::get('get_skillarea', [App\Http\Controllers\Admin\Academy::class, 'getSkillarea'])->name('get_skillarea');
Route::get('get_skillsports', [App\Http\Controllers\Admin\Academy::class, 'getSports'])->name('get_skillsports');
Route::get('get_technique', [App\Http\Controllers\Admin\Academy::class, 'getTechnique'])->name('get_technique');


Route::get('check_clone_data', [App\Http\Controllers\Admin\Academy::class, 'CheckCloneData'])->name('check_clone_data');

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('sport');
Route::get('/sport', [App\Http\Controllers\HomeController::class, 'index'])->name('sport');

//Route::view('actconcepts','actconcepts');
//Route::view('concepts','concepts');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/academic', [App\Http\Controllers\HomeController::class, 'academic'])->name('academic');
//Route::get('/concepts/{id}',[App\Http\Controllers\HomeController::class, 'concepts'])->name('concepts');
Route::get('/actconcepts/{id}',[App\Http\Controllers\HomeController::class, 'actconcepts'])->name('actconcepts');
Route::get('/chpactconcepts/{id}/{cid}',[App\Http\Controllers\HomeController::class, 'chpactconcepts'])->name('chpactconcepts');

Route::get('/academic_details/{id}',[App\Http\Controllers\HomeController::class, 'academic_details'])->name('academic_details');
Route::get('/activity_details/{id}',[App\Http\Controllers\HomeController::class, 'activity_details'])->name('activity_details');
Route::view('academyhome1','academyhome1');
Route::get('cl6hindi', [App\Http\Controllers\HomeController::class, 'class6Hindi'])->name('cl6hindi');
Route::get('cl6eng', [App\Http\Controllers\HomeController::class, 'class6Eng'])->name('cl6eng');
Route::get('cl6math', [App\Http\Controllers\HomeController::class, 'class6Math'])->name('cl6math');
Route::get('cl6sc', [App\Http\Controllers\HomeController::class, 'class6Science'])->name('cl6sc');
Route::get('cl6sst', [App\Http\Controllers\HomeController::class, 'class6Social'])->name('cl6sst');

Route::get('cl7hindi', [App\Http\Controllers\HomeController::class, 'class7Hindi'])->name('cl7hindi');
Route::get('cl7eng', [App\Http\Controllers\HomeController::class, 'class7Eng'])->name('cl7eng');
Route::get('cl7math', [App\Http\Controllers\HomeController::class, 'class7Math'])->name('cl7math');
Route::get('cl7sc', [App\Http\Controllers\HomeController::class, 'class7Science'])->name('cl7sc');
Route::get('cl7sst', [App\Http\Controllers\HomeController::class, 'class7Social'])->name('cl7sst');

Route::get('cl8hindi', [App\Http\Controllers\HomeController::class, 'class8Hindi'])->name('cl8hindi');
Route::get('cl8eng', [App\Http\Controllers\HomeController::class, 'class8Eng'])->name('cl8eng');
Route::get('cl8math', [App\Http\Controllers\HomeController::class, 'class8Math'])->name('cl8math');
Route::get('cl8sc', [App\Http\Controllers\HomeController::class, 'class8Science'])->name('cl8sc');
Route::get('cl8sst', [App\Http\Controllers\HomeController::class, 'class8Social'])->name('cl8sst');
//Route::view('index','index');



Route::get('/', [App\Http\Controllers\GeneralController::class, 'index'])->name('index');

//Restructure Routes

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'newLoginForm'])->name('login');
Route::get('/login-test', [App\Http\Controllers\Auth\LoginController::class, 'newLoginForm'])->name('login.test');
Route::post('/login-test', [App\Http\Controllers\Auth\LoginController::class, 'loginNew'])->name('auth.login.new');


/* Forget Passsword Route */
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::post('password-reset/check-email-exists', [PasswordRecoveryControlller::class, 'checkEmailExists'])->name('check.email.existance');
Route::post('/password-reset/verify-backup-code', [PasswordRecoveryControlller::class, 'verifySecurityCode'])->name('verify.security-code');
Route::post('/password/recovery/get-questions', [PasswordRecoveryControlller::class, 'getUserSecurityQuestions'])->name('security.get-questions');
Route::post('/password-reset/verify-security-questions', [PasswordRecoveryControlller::class, 'verifySecurityQuestions'])->name('security.verify-questions');



// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
// Route::get('/login-test', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.test');
// Route::post('/login-test', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth.login.test');



/* Self Registration */
/*Route::get('school-registration', [App\Http\Controllers\Auth\RegisterController::class, 'SchoolSelfRegistration'])->name('school.registration');
Route::post('register-school', [App\Http\Controllers\Auth\RegisterController::class, 'RegisterSchool'])->name('register.school');
Route::get('trainer-registration', [App\Http\Controllers\Auth\RegisterController::class, 'TrainerSelfRegistration'])->name('trainer.registration');
Route::post('register-trainer', [App\Http\Controllers\Auth\RegisterController::class, 'RegisterTrainer'])->name('register.trainer');
Route::post('get-cities', [App\Http\Controllers\Auth\RegisterController::class, 'getDistrictList'])->name('getDistrict');
*/

 
Route::get('school-registration', [App\Http\Controllers\Auth\RegisterController::class, 'SchoolSelfRegistration'])->name('school.registration');
Route::post('register-school', [App\Http\Controllers\Auth\RegisterController::class, 'RegisterSchool'])->name('register.school');
Route::post('get-district', [RegisterController::class,'getDistrict'])->name('getdistrict');
Route::get('trainer-registration', [SchoolRecordController::class, 'TrainerSelfRegistration'])->name('school.trainer.registration');
Route::post('register-trainer', [SchoolRecordController::class, 'RegisterTrainer'])->name('school.register.trainer');
Route::post('get-cities', [SchoolRecordController::class, 'getDistrictList'])->name('school.getDistrict');



Route::get('clearcache', function(){
	Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('config:clear'); 
    echo "cache clear"; exit();
});




Route::get('academics', [App\Http\Controllers\HomeController::class, 'academyHome'])->name('academics');
Route::get('chapters/{class}/{subject}/{book?}', [App\Http\Controllers\Academy::class, 'chapters'])->name('chapters');
Route::get('concepts/{chapter}', [App\Http\Controllers\Academy::class, 'concepts'])->name('concepts'); 

Route::get('sports',[App\Http\Controllers\SportsController::class, 'index'])->name('sports');

Route::get('terms-exam',[App\Http\Controllers\FillDartController::class, 'termsExam'])->name('terms.exam');
Route::post('terms-exam-import',[App\Http\Controllers\FillDartController::class, 'termsExamImportData'])->name('terms.exam.import.data');

Route::get('fill-dart',[App\Http\Controllers\FillDartController::class, 'index'])->name('fill.dart');
Route::get('testdata',[App\Http\Controllers\FillDartController::class, 'testdata'])->name('testdata');
Route::get('get_activity',[App\Http\Controllers\FillDartController::class, 'getActivity'])->name('get_activity');
Route::get('get_students',[App\Http\Controllers\FillDartController::class, 'getStudents'])->name('get_students');
Route::post('fill_dart_data_submit',[App\Http\Controllers\FillDartController::class, 'SubmitFillDart'])->name('fill.dart.data.submit');
Route::post('fill_dart_data_submit_ncs',[App\Http\Controllers\FillDartController::class, 'SubmitFillDartNCS'])->name('fill.dart.data.submit.ncs');
Route::get('student-report',[App\Http\Controllers\FillDartController::class, 'StudentReport'])->name('students.report');

Route::post('submit-other-duty',[App\Http\Controllers\FillDartController::class, 'SubmitOtherDuty'])->name('submit.other.duty');
Route::post('trainer-activity',[App\Http\Controllers\FillDartController::class, 'TrainerActivity'])->name('fill.trainer.activity');

Route::get('view-dart',[App\Http\Controllers\FillDartController::class, 'ViewDart'])->name('view.dart');
Route::get('view-dart-by-class',[App\Http\Controllers\FillDartController::class, 'ViewDartByClass'])->name('view.dart.class');
Route::get('getFillDARTSkillArea', [App\Http\Controllers\FillDartController::class, 'getFillDARTSkillArea'])->name('getFillDARTSkillArea');

Route::get('filldart-dashboard', [App\Http\Controllers\FillDartController::class, 'dashboard'])->name('filldart.dashboard');

// Route::get('paris-2024', [App\Http\Controllers\FillDartController::class, 'ParisOlympics'])->name('paris.olympics');

Route::get('read-excel-demo',[App\Http\Controllers\DATController::class, 'ReadExcelDemo'])->name('read.excel.demo');


Route::get('pe-activities', [App\Http\Controllers\PEActivityController::class, 'index'])->name('pe-activities.index');

/* Updated Route */
Route::get('learn-sports', [App\Http\Controllers\PEActivityController::class, 'LearnSports'])->name('learn.sports');
Route::get('sports/{sport_id}', [App\Http\Controllers\PEActivityController::class, 'SportsVideos'])->name('sports.videos');
Route::get('sports/{sport_id}/{topic_id}', [App\Http\Controllers\PEActivityController::class, 'SportsTopicVideos'])->name('topics.videos');


Route::post('student-map-students', [App\Http\Controllers\MapStudentController::class, 'UpdateStudentSports'])->name('student.map.students');
Route::get('get-students-according-class',[App\Http\Controllers\MapStudentController::class, 'getStudentsAccordingToClass'])->name('get.students.according.to.class');
Route::get('map-sports', [App\Http\Controllers\MapStudentController::class, 'index'])->name('map.sports');

Route::get('get-sports', [App\Http\Controllers\MapStudentController::class, 'getSports'])->name('get.sports');


//activity according to class
Route::get('activity-according-to-class', [App\Http\Controllers\MapStudentController::class, 'activityAccordingToClass'])->name('activity.according.to.class');




Route::get('fetch-students-according-class',[App\Http\Controllers\MapStudentController::class, 'fetchactivityAccordingToClass'])->name('fetch.students.according.to.class');

Route::get('lession-plan-details',[App\Http\Controllers\MapStudentController::class, 'lessionPlanDetails'])->name('lession.plan.details');

Route::get('add-activity/{concept?}', [App\Http\Controllers\Academy::class, 'addactivity'])->name('addactivity');
Route::post('add-activity', [App\Http\Controllers\Academy::class, 'activitystore'])->name('activity.store'); 
Route::get('activities', [App\Http\Controllers\Academy::class, 'activities'])->name('activities');
Route::get('my-activities', [App\Http\Controllers\Academy::class, 'myactivities'])->name('myactivities');
Route::get('reloadcaptcha',[App\Http\Controllers\CaptchaController::class, 'reloadCaptcha'])->name('reloadCaptcha');


Route::get('edit-activity/{id}', [App\Http\Controllers\Academy::class, 'editActivity'])->name('edit-activity');
Route::post('update-activity/{id}', [App\Http\Controllers\Academy::class, 'updateActivity'])->name('update-activity');
Route::get('userstatus', [App\Http\Controllers\GeneralController::class, 'userStatus'])->name('userstatus');
Route::get('activitysummary', [App\Http\Controllers\GeneralController::class, 'activityDetails'])->name('activitysummary');
Route::post('storecomment', [App\Http\Controllers\GeneralController::class, 'storeComment'])->name('storecomment');

Route::delete('/commentedelte/{id}', [App\Http\Controllers\GeneralController::class, 'deleteComment'])->name('commentedelte');
Route::get('/editcomment/{id}', [App\Http\Controllers\GeneralController::class, 'editComment'])->name('editcomment');
Route::put('updatecomment/{id}', [App\Http\Controllers\GeneralController::class, 'updateComment'])->name('updatecomment');

Route::get('/admin-manual', [App\Http\Controllers\GeneralController::class, 'AdminManual'])->name('admin.manual');
Route::get('/battery-of-test', [App\Http\Controllers\GeneralController::class, 'TestVideos'])->name('test.videos');

Route::get('generatepdf', [App\Http\Controllers\GeneratePDF::class, 'generateActivityPDFshow'])->name('generateactivitypdfview');
Route::post('generatepdf', [App\Http\Controllers\GeneratePDF::class, 'generateActivityPDF'])->name('generateactivitypdf');
URL::forceScheme('https');

