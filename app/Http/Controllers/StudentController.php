<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Session as Sess;
use App\Models\Course;
use App\Models\Assigncourse;
use App\Models\Section;
use App\Models\Markdistribution;

use Illuminate\Http\Request;
use Session;
use Image;
use DB;
class StudentController extends Controller
{
    public function dashboard(){
        $id = Session::get('id');
        $student = Student::find($id);
        return view('student.student-dashboard',compact('student')); 
    }
    public function Enroll(){
        $ses = Sess::all();
        return view('student.Enroll',compact('ses'));
    }
    public function AvailableCourse($id){
        $users = DB::table('assigncourses')
            ->join('courses', 'assigncourses.course_id', '=', 'courses.id')
            ->where('assigncourses.session_id','=',$id)
            ->select('courses.*','assigncourses.section as section','assigncourses.id as acid')
            ->distinct()//section concate
            ->get();
        
        //dd($users);
        if($users){
            return response()->json(array('users'=> $users));
        }

        $users = Assigncourse::where('session_id', $id)->get();
        if($users){
            return response()->json(array('users'=> $users));
        }
    }
    public function EnrollRequest(Request $r){
        dd($r);
    }
}


