<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;
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

    Route::get('/admin-dashboard', [AdminController::class,'dashboard']); 
    Route::get('/admin-dashboardd', [AlternateAdminController::class,'dashboardd']);
    Route::get('/admin-profile', [AlternateAdminController::class,'AdminProfile']);

    Route::get('/admin-profile-update', [AlternateAdminController::class,'AdminEditProfile']);
    Route::post('/update-admin-profile', [AlternateAdminController::class,'AdminUpdateProfile']);

    Route::get('/admin-password-update', [AlternateAdminController::class,'AdminEditPassword']);
    Route::post('/update-admin-pass', [AlternateAdminController::class, 'AdminUpdatePassword']);

    Route::get('create-course', [AlternateAdminController::class,'CreateCourse']); 
    Route::post('/store-course', [AlternateAdminController::class, 'StoreCourse']);

    Route::get('create-semester', [AlternateAdminController::class,'CreateSemester']); 
    Route::post('/store-course', [AlternateAdminController::class, 'StoreCourse']);

    Route::get('/all-course', [AlternateAdminController::class, 'Allcourse']);
    Route::get('/edit-course/{id}', [AlternateAdminController::class, 'EditCourse']); 
    Route::post('/update-course/{id}', [AlternateAdminController::class, 'UpdateCourse']);
    Route::get('/delete-crc/{id}', [AlternateAdminController::class, 'DeleteCourse']);
    Route::get('/downloadcoursepdf/{id}',[AlternateAdminController::class,'downloadCoursepdf'])->name('view-pdf');
    Route::get('/viewcoursepdf/{id}',[AlternateAdminController::class,'viewCoursepdf'])->name('download-pdf');

    Route::get('/downloadteacherpdf/{id}',[AlternateAdminController::class,'downloadTeacherpdf'])->name('view-pdf');
    Route::get('/viewteacherpdf/{id}',[AlternateAdminController::class,'viewTeacherepdf'])->name('download-pdf');

    Route::get('/downloadStudentpdf/{id}',[AlternateAdminController::class,'downloadStudentpdf'])->name('view-pdf');
    Route::get('/viewStudentpdf/{id}',[AlternateAdminController::class,'viewStudentepdf'])->name('download-pdf');

    Route::get('/export-course-excel',[AlternateAdminController::class,'course_execel_crt']);
    Route::get('/export-teacher-excel',[AlternateAdminController::class,'teacher_execel_crt']);
    Route::get('/export-student-excel',[AlternateAdminController::class,'student_execel_crt']);

    Route::get('/session', [AlternateAdminController::class, 'Session']); 
    Route::get('/start-session', [AlternateAdminController::class, 'StartSession']); 
    Route::post('/store-session', [AlternateAdminController::class, 'StoreSession']);
    Route::get('/session-courses', [AlternateAdminController::class, 'SessionCourses']); 

    Route::post('/active-session', [AlternateAdminController::class, 'ActiveSession']);
    Route::post('/deactive-session', [AlternateAdminController::class, 'DeactiveSession']);


    Route::get('/get-teacher2', [AlternateAdminController::class,'GetTeacher']);
    Route::get('/get-course-data/{course_id}', [AlternateAdminController::class, 'getcoursedata']);

    Route::get('/enrollment', [AlternateAdminController::class, 'Enrollreq']);
    Route::get('/enrollmentswitching/{id}', [AlternateAdminController::class, 'SwithchEnrollment']);
    Route::get('/apprve/{id}', [AlternateAdminController::class, 'AppEnrollreq']);
    Route::get('/deletreq/{id}', [AlternateAdminController::class, 'DeleteEnrollreq']);

    Route::get('/get-semester', [AlternateAdminController::class, 'getsemester']);

});


Route::middleware(['IsLoggedin','IsStudent'])->group(function (){

    Route::get('/student-dashboard', [StudentController::class,'dashboard']); 
    Route::get('/view_result', [StudentController::class,'ViewResult']);
    Route::get('/result-categoryy/{id}', [StudentController::class,'Category']);
    Route::get('/result-markk/{id}', [StudentController::class,'ResultMarkss']);
});


Route::middleware(['IsLoggedin','IsTeacher'])->group(function (){

    Route::get('/teacher-dashboard', [AlternativeTeacherController::class,'dashboard']); 
    Route::get('/teacher-dashboardd', [AlternativeTeacherController::class,'dashboardd']);
    Route::get('/teacher-profile', [AlternativeTeacherController::class,'TeacherProfile']);
    Route::get('/teacher-courses', [AlternativeTeacherController::class,'Courses']);

    Route::get('/edit-teacher-info', [AlternativeTeacherController::class,'EditInfo']);
    Route::post('/update-teacher-info', [AlternativeTeacherController::class, 'UpdateInfo']);
    
    Route::get('/edit-teacher-password', [AlternativeTeacherController::class,'EditPass']);
    Route::post('/update-teacher-pass', [AlternativeTeacherController::class, 'UpdatePass']);

    Route::get('/teacher-previous-courses', [AlternativeTeacherController::class,'PreviousCourse']);
    Route::get('/teacher-previous-coursess', [AlternativeTeacherController::class,'PreviousCoursee']);
    Route::get('/get-previous-course/{id}{semester}{tid}', [AlternativeTeacherController::class, 'getPreviousCourse']);

    Route::get('/result', [AlternativeTeacherController::class,'Result']);
    Route::get('/result-course/{id}', [AlternativeTeacherController::class,'ResultCourse']);
    Route::get('/result-category/{id}', [AlternativeTeacherController::class,'ResultCategory']);
    Route::get('/result-mark/{id}', [AlternativeTeacherController::class,'ResultMarks']);
    Route::get('/publish_result/{id}', [AlternativeTeacherController::class,'PublishResult']);
});


