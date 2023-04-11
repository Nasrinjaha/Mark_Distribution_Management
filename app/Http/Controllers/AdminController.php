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
class AdminController extends Controller
{
    public function dashboard(){
        $id = Session::get('id');
        $admin = Admin::find($id);
        return view('admin.admin-dashboard',compact('admin')); 
    }

    public function CreateStudent(){
        return view('admin.create-student');
    }

    public function StoreStudent(Request $req){
        $name = $req->name;
        $email = $req->email;
        $birth_date = $req->birth_date;

        $address = $req->address;

        $pass = $req->pass1;
        $pass2 = $req->pass2;
        //dd($req);

        if($pass==$pass2){
            $users = Student::select("*")
                ->where("email", "=", $email)
                ->first();  
            if($users){
                return redirect()->back()->with('dup_msg','duplicate email!!!!!');
            } 
            else{
                $obj = new Student(); 
                $obj->name = $name;
                $obj->email = $email;
                $obj->dob = $birth_date;
                $obj->address = $address;
                $obj->pass=$pass;
                $obj->img = 'user.png';
                if($obj->save()){
                // return redirect('employees');
                    return redirect()->back()->with('suc_msg','successfully inserted');
                }
            }
            
        }
        else{
            return redirect()->back()->with('err_msg','password doesn\'t match!!!');
        }
    }

    
    public function CreateTeacher(){
        return view('admin.create-teacher');
    }

    public function StoreTeacher(Request $req){
        $name = $req->name;
        $email = $req->email;
        $birth_date = $req->birth_date;

        $address = $req->address;

        $pass = $req->pass1;
        $pass2 = $req->pass2;
       

        if($pass==$pass2){
            $users = Teacher::select("*")
                ->where("email", "=", $email)
                ->first();  
            if($users){
                return redirect()->back()->with('dup_msg','duplicate email!!!!!');
            } 
            else{
                $obj = new Teacher(); 
                $obj->name = $name;
                $obj->email = $email;
                $obj->dob = $birth_date;
                $obj->address = $address;
                $obj->pass=$pass;
                $obj->img = 'user.png';
                if($obj->save()){
                // return redirect('employees');
                    return redirect()->back()->with('suc_msg','successfully inserted');
                }
            }
            
        }
        else{
            return redirect()->back()->with('err_msg','password doesn\'t match!!!');
        }
    }

    public function AllStudents(){
        $students = Student::all();
        return view('admin.students', compact('students'));
    }


    public function EditStudent($id){
        $student = Student::find($id); // SELECT * from employees WHERE id=1
        
        return view('admin.edit-student', compact('student'));
    }

    public function updateStudent(Request $req, $id){
        $name = $req->name;
        $email = $req->email;
        $birth_date = $req->birth_date;
        $address = $req->address;

        $obj = Student::find($id);
        $obj->name = $name;
        $obj->email = $email;
        $obj->dob = $birth_date;
        $obj->address = $address;
        if($obj->save()){
           return redirect('/all-students');
          // echo "updated";
        }
    }

    public function DeleteStudent($id){
        Student::find($id)->delete();
        return redirect('/all-students');
    }

    public function AllTeachers(){
        $teachers = Teacher::all();
        return view('admin.teachers', compact('teachers'));
    }
    public function EditTeacher($id){
        $teacher = Teacher::find($id); // SELECT * from employees WHERE id=1
        
        return view('admin.edit-teacher', compact('teacher'));
    }

    public function updateTeacher(Request $req, $id){
        $name = $req->name;
        $email = $req->email;
        $birth_date = $req->birth_date;
        $address = $req->address;

        $obj = Teacher::find($id);
        $obj->name = $name;
        $obj->email = $email;
        $obj->dob = $birth_date;
        $obj->address = $address;
        if($obj->save()){
           return redirect('/all-teachers');
          // echo "updated";
        }
    }

    public function DeleteTeacher($id){
        Teacher::find($id)->delete();
        return redirect('/all-teachers');
    }

    public function getCourse(){
        $ses = Sess::all();
        $courses = Course::all();
        return view('admin.course-assign',compact('ses','courses'));
        //return view('admin.temp',compact('ses','courses'));
    }

    public function haha(){
        $teachers = Teacher::all();
        return view('admin.h', compact('teachers'));

    }
    public function check(){
        
        return view('admin.check');
    }
    public function assignCourse(Request $r){
       // dd($r);

        $sessionid = $r->session;
        Assigncourse::where('session_id', $sessionid)->delete();
        $course = $r->input('check');
        //echo $course;
        for($count = 0; $count < count($course); $count++)
        {  
            $obj = new Assigncourse();         
            $obj->course_id = $course[$count];
            $obj->session_id=$sessionid;
            if($obj->save()){
             }
             else{
                echo "failed";
             }
        }
        return redirect()->back()->with('suc_msg','Successfully inserted');
    }
    public function getSelectedCourse($id){
        $users = Assigncourse::where('session_id', $id)->get();
        if($users){
            return response()->json(array('users'=> $users));
        }
         
    }
    public function CreateSection(){
        return view('admin.create-section');
    }

    public function StoreSection(Request $r){
        $name = $r->secname;
        $users = Section::select("*")
        ->where("name", "=", $name)
        ->first();  
        if($users){
            return redirect()->back()->with('dup_msg','Already exist Section!!!!!');
        } 
        else{
            $obj = new Section(); 
            $obj->name = $name;
            if($obj->save()){
                return redirect()->back()->with('suc_msg','successfully inserted');
            }
        }
        return view('admin.create-section');
    }

}
