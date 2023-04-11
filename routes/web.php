<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;

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

    Route::get('/admin-dashboard', [AdminController::class,'dashboard']); 

    Route::get('/create-teacher', [AdminController::class,'CreateTeacher']); 
    Route::post('/store-teacher', [AdminController::class, 'StoreTeacher']); 
   
    Route::get('/create-student', [AdminController::class,'CreateStudent']);
    Route::post('/store-student', [AdminController::class, 'StoreStudent']); 

    Route::get('/all-students', [AdminController::class, 'AllStudents']); 
    Route::get('/edit-student/{id}', [AdminController::class, 'EditStudent']); 
    // Route::post('/update-student/{id}', [AdminController::class, 'UpdateStudent']); 
    Route::get('/delete-student/{id}', [AdminController::class, 'DeleteStudent']); 

    Route::get('/all-teachers', [AdminController::class, 'AllTeachers']); 
    //Route::get('/edit-teacher', [AdminController::class, 'EditTeacher']); 
    Route::get('/edit-teacher/{id}', [AdminController::class, 'EditTeacher']); 
    // Route::post('/update-teacher/{id}', [AdminController::class, 'UpdateTeacher']); 
    Route::get('/delete-teacher/{id}', [AdminController::class, 'DeleteTeacher']); 
  
    Route::get('/check', [AdminController::class, 'check']);

    Route::get('/get-course', [AdminController::class, 'getCourse']); 
    Route::post('/assign-course', [AdminController::class, 'assignCourse']);
    Route::get('/get-selected-course/{id}', [AdminController::class, 'getSelectedCourse']);


    Route::get('/create-section', [AdminController::class, 'CreateSection']);
    Route::post('/store-section', [AdminController::class, 'StoreSection']);
    

});


Route::middleware(['IsLoggedin','IsStudent'])->group(function (){

    Route::get('/student-dashboard', [StudentController::class,'dashboard']); 
});


Route::middleware(['IsLoggedin','IsTeacher'])->group(function (){

    Route::get('/teacher-dashboard', [TeacherController::class,'dashboard']); 

});


