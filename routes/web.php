<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
//use Input;

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

Route::get('/haha',[AdminController::class,'haha']);


Route::get('/',[AuthController::class,'Login']);
Route::post('/post-login', [AuthController::class,'postLogin']); 

Route::middleware(['IsLoggedin'])->group(function (){
    Route::get('logout', [AuthController::class, 'Logout']); 
});
Route::middleware(['IsLoggedin','IsAdmin'])->group(function (){

    Route::get('/admin-dashboardd', [AdminController::class,'dashboard']); 

    Route::get('/create-teacher', [AdminController::class,'CreateTeacher']); 
    Route::post('/store-teacher', [AdminController::class, 'StoreTeacher']); 
   
    Route::get('/create-student', [AdminController::class,'CreateStudent']);
    Route::post('/store-student', [AdminController::class, 'StoreStudent']); 

    Route::get('/all-students', [AdminController::class, 'AllStudents']); 
    Route::get('/edit-student/{id}', [AdminController::class, 'EditStudent']); 
    Route::post('/update-student/{id}', [AdminController::class, 'UpdateStudent']); 
    Route::get('/delete-student/{id}', [AdminController::class, 'DeleteStudent']); 
    Route::post('/store-excel-student',[AdminController::class,'storeStudentExcel']);

    Route::get('/all-teachers', [AdminController::class, 'AllTeachers']); 
    Route::get('/edit-teacher/{id}', [AdminController::class, 'EditTeacher']); 
    Route::post('/update-teacher/{id}', [AdminController::class, 'UpdateTeacher']); 
    Route::get('/delete-teacher/{id}', [AdminController::class, 'DeleteTeacher']); 
    Route::post('/store-excel-teacher',[AdminController::class,'storeTeacherExcel']);

    Route::get('/get-course', [AdminController::class, 'getCourse']); 
    Route::post('/assign-course', [AdminController::class, 'assignCourse']);
    Route::get('/get-selected-course/{id}', [AdminController::class, 'getSelectedCourse']);


    Route::get('/create-section', [AdminController::class, 'CreateSection']);
    Route::post('/store-section', [AdminController::class, 'StoreSection']);

    Route::get('/get-teacher', [AdminController::class,'GetTeacher']);
    Route::get('/get-assign-course/{id}{semester}', [AdminController::class, 'getAssignCourse']);
    Route::get('/get-section/{id}{session_id}', [AdminController::class, 'getSection']);

    Route::post('/assign-teacher', [AdminController::class,'StoreSectionTeacher']);
    Route::get('/check/{id}', [AdminController::class, 'getAssignCourse']);



    Route::get('/enrollment', [AdminController::class, 'SessionEnrollmentRequest']);
    Route::get('/session-enrollment', [AdminController::class, 'EnrollmentRequest']);
    Route::get('/enroll-approve', [AdminController::class, 'ApproveEnrollmentRequest']);

    Route::post('/store-semester', [AdminController::class, 'storeSemester']);


    Route::get('/admin-image-update', [AdminController::class, 'adminImageEdite']);

    Route::post('/store-admin-image', [AdminController::class, 'UpdateProfileImage']);
   
    Route::get('/edit-designation', [AdminController::class, 'editDesgnatoin']);
    Route::get('/update-designation/{id}', [AdminController::class, 'UpdateDesgnatoin']);
    Route::post('/update-teacher-designation/{id}', [AdminController::class, 'UpdateTeacherDesgnatoin']);
    
    Route::post('/store-excel-course',[AdminController::class,'storeCourseExcel']);

    

});


Route::middleware(['IsLoggedin','IsStudent'])->group(function (){

    Route::get('/student-dashboard', [StudentController::class,'dashboard']);
    Route::get('/enroll', [StudentController::class,'Enroll']);
    Route::get('/available-course/{id}', [StudentController::class,'AvailableCourse']);
    Route::post('/enroll-request', [StudentController::class,'EnrollRequest']);


    Route::get('/edit-student-profile-info', [StudentController::class,'editProfileInfo']);
    Route::post('/update-student-profile-info', [StudentController::class,'updateProfileInfo']);

    Route::get('/edit-student-password', [StudentController::class,'editPassword']);
    Route::post('/update-student-password', [StudentController::class,'updatePassword']);

    Route::get('/edit-student-image', [StudentController::class,'editStudentImage']);
    Route::post('/update-student-image', [StudentController::class,'updateProfileImage']);
    
    Route::get('/downloadStudentpdff/{id}',[StudentController::class,'downloadStudentpdff'])->name('download-pdf');
    Route::get('/viewStudentpdff/{id}',[StudentController::class,'viewStudentepdff'])->name('view-pdf');
});


Route::middleware(['IsLoggedin','IsTeacher'])->group(function (){

    Route::get('/teacher-dashboard',[TeacherController::class,'dashboard']); 
    Route::get('/teacher-current-course',[TeacherController::class,'getCourse']);
    Route::get('/get-teacherassign-course/{id}',[TeacherController::class,'getTeacherAssignCourse']);

    Route::post('/mark-distribution',[TeacherController::class,'MarkDistribution']);
    Route::get('/distributed-course/{id}',[TeacherController::class,'DistributedCourse']);

    Route::get('/get-students',[TeacherController::class,'getStudent']);
    Route::get('/student-marks-assign/{cid}',[TeacherController::class,'assignStudent']);
    Route::post('/store-student-marks',[TeacherController::class,'storeMarks']);
    Route::get('/get-student-marks-assign/{stid}/{catid}/{acid}',[TeacherController::class,'getStudentAssignMarks']);
    Route::get('/getsem',[TeacherController::class,'getSemester']);


    Route::get('/edit-teacher-image', [TeacherController::class, 'editImage']);
    Route::post('/store-teacher-image', [TeacherController::class, 'UpdateImage']);


    Route::get('/downloadteacherpdff/{id}',[TeacherController::class,'downloadTeacherpdff'])->name('download-pdf');
    Route::get('/viewteacherpdff/{id}',[TeacherController::class,'viewTeacherepdff'])->name('view-pdf');



});


