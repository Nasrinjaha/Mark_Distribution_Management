<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Course;
use Illuminate\Http\Request;
use Session;
use Image;
class AlternateAdminController extends Controller
{

    public function CreateCourse(){
        return view('admin.create-course');
    }

    public function StoreCourse(Request $req){
        $name = $req->name;
        $code = $req->ccode;
        $credit = $req->crdit;
        $hour=$req->hour;
        if($req->type=="lab"){
            $type = 2;
            $limit = 30;
        }
        else{
            $type = 1;
            $limit = 60;
        }
            $users = Course::select("*")
                ->where("Course_code", "=", $code)
                ->first();  
            if($users){
                return redirect()->back()->with('dup_msg','Already exist Course Code!!!!!');
            } 
            else{
                $obj = new Course(); 
                $obj->Name = $name;
                $obj->Course_code = $code;
                $obj->Credit = $credit;
                $obj->Student_limit = $limit;
                $obj->Hour=$hour;
                $obj->Type= $type;
                if($obj->save()){
                // return redirect('employees');
                    return redirect()->back()->with('suc_msg','successfully inserted');
                }
            }
    }
    public function Allcourse(){
        $courses = Course::all();
        return view('admin.course', compact('courses'));
    }
    public function EditCourse($id){
        $course = Course::find($id); // SELECT * from employees WHERE id=1
        
        return view('admin.edit-course', compact('course'));
    }

    public function updateCourse(Request $req, $id){
        $name = $req->name;
        $code = $req->ccode;
        $credit = $req->crdit;
        $hour=$req->hour;
        $users = Course::select("*")
        ->where("Course_code", "=", $code)
        ->first();  
        if($users && ($users->id!=$id)){
            return redirect()->back()->with('dup_msg','Already exist Course Code!!!!!');
        } 
        //dd($req);
        if($req->type=="lab"){
            $type = 2;
            $limit = 30;
        }
        else{
            $type = 1;
            $limit = 60;
        }

        $obj = Course::find($id);
        $obj->Name = $name;
        $obj->Course_code = $code;
        $obj->Credit = $credit;
        $obj->Hour = $hour;
        $obj->Type=$type;
        $obj->Student_limit	=$limit;
        if($obj->save()){
           return redirect('/all-course');
          // echo "updated";
        }
    }



}
