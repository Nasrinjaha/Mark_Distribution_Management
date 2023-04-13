<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Session as Sess;
use App\Models\Course;
use App\Models\Assigncourse;
use App\Models\Section;

use Illuminate\Http\Request;
use Session;
use Image;
use DB;
class TeacherController extends Controller
{
    public function dashboard(){
        $id = Session::get('id');
        $teacher = Teacher::find($id);
        return view('teacher.teacher-dashboard',compact('teacher')); 
    }

    public function getCourse(){
        $ses = Sess::all();
        return view('teacher.mark-distribution',compact('ses')); 
    }
    public function getTeacherAssignCourse($id){
        //$users = Assigncourse::where('session_id', $id)->get();
        $tid = Session::get('id');
        $users = DB::table('assigncourses')
            ->join('courses', 'assigncourses.course_id', '=', 'courses.id')
            ->where('assigncourses.session_id','=',$id)
            // ->where('assigncourses.teacher_id','=',$tid)
            ->select('courses.*')
            ->distinct()//section concate
            ->get();
        
        dd($users);
        if($users){
            return response()->json(array('users'=> $users));
        }
         
    }
}
