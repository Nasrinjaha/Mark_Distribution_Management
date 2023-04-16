<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Session;
use DB;

class AlternativeTeacherController extends Controller
{
    public function dashboard(){
        $id = Session::get('id');
        $teacher = Teacher::find($id);
        return view('teacher.teacher-dashboard',compact('teacher')); 
    }
    public function EditInfo(){
        $id = Session::get('id');
        $teacher = Teacher::find($id); // SELECT * from employees WHERE id=1

        return view('teacher.edit-teacher-info', compact('teacher'));
    }

    public function UpdateInfo(Request $req){
        $id = Session::get('id');
        $name = $req->name;
        $email = $req->email;
        $dob = $req->birth_date;
        $address=$req->address;
        $users = Teacher::select("*")
        ->where("email", "=", $email)
        ->first();  
        if($users && ($users->id!=$id)){
            return redirect()->back()->with('dup_msg','Already exist Email!!!!!');
        } 
        $obj = Teacher::find($id);
        $obj->name = $name;
        $obj->email = $email;
        $obj->dob = $dob;
        $obj->address = $address;
        if($obj->save()){
           return redirect('/edit-teacher-info')->with('suc_msg','Information Successfully Updated!!!!!');;
        }
    }
    public function EditPass(){
        $id = Session::get('id');
        $teacher = Teacher::find($id);
        return view('teacher.edit-teacher-pass', compact('teacher'));
    }
    public function UpdatePass(Request $req){
        $current = $req->pass1;
        $new = $req->pass2;
        $re_new = $req->pass3;
        $id = Session::get('id');
        $teacher = Teacher::find($id);
        if($current!=$teacher->pass){
            return redirect()->back()->with('dup_msg1','Wrong Password!!!!!');
        }
        if($new!=$re_new){
            return redirect()->back()->with('dup_msg2','New password does not match with retyped password!!!!!');
        }
        $obj = Teacher::find($id);
        $obj->pass = $new;
        if($obj->save()){
            return redirect('/edit-teacher-password')->with('suc_msg','Password Successfully Updated!!!!!');;
         }
    }

    public function PreviousCourse(){
        $tid = Session::get('id');
        $secid = DB::table('sessions')->max('id');

        $session =DB::table('assigncourses')
        ->select('assigncourses.session_id', 'assigncourses.teacher_id', 'assigncourses.course_id', 'courses.Name', 'courses.Course_code', 'sessions.Session_name', 'assigncourses.Semester', 'assigncourses.section')
        ->join('courses','assigncourses.course_id','=','courses.id')
        ->join('sessions','assigncourses.session_id','=','sessions.id')
        ->where('assigncourses.session_id','<',$secid)
        ->where('assigncourses.teacher_id','=',$tid)
        ->orderBy('assigncourses.session_id','asc')
        ->orderBy('assigncourses.Semester','asc')
        ->get();
        return view('teacher.previous-course', compact('session'));
    }
}
