<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Session;
use Image;
class StudentController extends Controller
{
    public function dashboard(){
        $id = Session::get('id');
        $student = Student::find($id);
        return view('student.student-dashboard',compact('student')); 
    }
}
