<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Session;

class AuthController extends Controller
{
    public function Login(){
        return view('login');
    }

    public function postLogin(Request $r){
        $email = $r->mail;
        $pass  =  $r->pass;
        $users = Student::select("*")
                  ->where("email", "=", $email)
                  ->where("pass", "=", $pass )
                  ->first();     
       if($users){
          $id = $users->id;
          //echo($id);
          $student = Student::find($id); 
          $name = $student->name;
          $email = $student->email;
          $pp =$student->img;
          Session:: put('pp',$pp);
          Session:: put('id',$id);
          Session:: put('Role','student');
          return redirect('student-dashboard');
       }
       else{
          $users = Teacher::select("*")
                  ->where("email", "=", $email)
                  ->where("pass", "=", $pass )
                  ->first();
          if($users){
              $id = $users->id;
              //echo($id);
              $teacher = Teacher::find($id); 
              $name = $teacher->name;
              $email = $teacher->email;
              $pp =$teacher->img;
              Session:: put('pp',$pp);
              Session:: put('id',$id);
              Session:: put('Role','teacher');
              return redirect('teacher-dashboard');
          }
          else{
              $users = Admin::select("*")
                  ->where("email", "=", $email)
                  ->where("pass", "=", $pass )
                  ->first();
                  if($users){
                      $id = $users->id;
                      $admin = Admin::find($id);
                      $name = $admin->name;
                      $email = $admin->email;
                      $pp = $admin->img;

                      Session:: put('id',$id);
                      Session:: put('Role','admin');
                      Session:: put('pp',$pp);
                      return redirect('admin-dashboardd');
                  }
                  else{
                      return redirect()->back()->with('err_msg','wrong pass or email');
                  }
          }
       }
      
  }

  public function Logout(){
    Session::forget(['id','role']);
    return redirect()->to('/');
  }
}