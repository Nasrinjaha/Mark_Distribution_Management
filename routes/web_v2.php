<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AlternateAdminController;
use App\Http\Controllers\AlternativeTeacherController;

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



Route::get('/template',[NavigationController::class,'Template']);


Route::get('/',[AuthController::class,'Login']);
Route::post('/post-login', [AuthController::class,'postLogin']); 

Route::middleware(['IsLoggedin'])->group(function (){
    Route::get('logout', [AuthController::class, 'Logout']); 
});
Route::middleware(['IsLoggedin','IsAdmin'])->group(function (){

    Route::get('create-course', [AlternateAdminController::class,'CreateCourse']); 
    Route::post('/store-course', [AlternateAdminController::class, 'StoreCourse']);

    Route::get('/all-course', [AlternateAdminController::class, 'Allcourse']);
    Route::get('/edit-course/{id}', [AlternateAdminController::class, 'EditCourse']); 
    Route::post('/update-course/{id}', [AlternateAdminController::class, 'UpdateCourse']);

    Route::get('/session', [AlternateAdminController::class, 'Session']); 
    Route::get('/start-session', [AlternateAdminController::class, 'StartSession']); 
    Route::post('/store-session', [AlternateAdminController::class, 'StoreSession']);
    Route::get('/session-courses', [AlternateAdminController::class, 'SessionCourses']); 

    Route::post('/active-session', [AlternateAdminController::class, 'ActiveSession']);
    Route::post('/deactive-session', [AlternateAdminController::class, 'DeactiveSession']);




    Route::get('/get-teacher2', [AlternateAdminController::class,'GetTeacher']);
    Route::get('/get-course-data/{course_id}', [AlternateAdminController::class, 'getcoursedata']);


});


Route::middleware(['IsLoggedin','IsStudent'])->group(function (){

    Route::get('/student-dashboard', [StudentController::class,'dashboard']); 
});


Route::middleware(['IsLoggedin','IsTeacher'])->group(function (){

    Route::get('/teacher-dashboard', [AlternativeTeacherController::class,'dashboard']); 

    Route::get('/edit-teacher-info', [AlternativeTeacherController::class,'EditInfo']);
    Route::post('/update-teacher-info', [AlternativeTeacherController::class, 'UpdateInfo']);
    
    Route::get('/edit-teacher-password', [AlternativeTeacherController::class,'EditPass']);
    Route::post('/update-teacher-pass', [AlternativeTeacherController::class, 'UpdatePass']);

    Route::get('/teacher-previous-courses', [AlternativeTeacherController::class,'PreviousCourse']);

});


