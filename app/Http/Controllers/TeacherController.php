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
             ->where('assigncourses.teacher_id','=',$tid)
            ->select('courses.*','assigncourses.section as section','assigncourses.id as acid')
            ->distinct()//section concate
            ->get();
        
        //dd($users);
        if($users){
            return response()->json(array('users'=> $users));
        }
         
    }

    public function MarkDistribution(Request $r){

        $category = $r->input('category');
        $marks = $r->input('marks');
        //echo $course;
        $sum = 0;
        for($count = 0; $count < count($category); $count++){  
           $sum+=$marks[$count];
        }
        //dd($sum);
        if($sum<100){
            return redirect()->back()->with('err_msg','Distribution failed->(less than 100)');
        }
        else if($sum>100){
            return redirect()->back()->with('err_msg','Distribution failed->(greater than 100)');
        }
        else{

            Markdistribution::where('ac_id', $r->course)->delete();
            for($count = 0; $count < count($category); $count++){  
                $obj = new Markdistribution(); 
                $obj->ac_id=$r->course;
                $obj->category=$category[$count];
                $obj->marks=$marks[$count];
                if($obj->save()){
                    
                }
                else{
                    return redirect()->back()->with('suc_msg','insertion faild');
                }  
            }
            return redirect()->back()->with('suc_msg','Successfully inserted');
        }

        
        
    }   
    public function DistributedCourse($id){
        $users = DB::table('markdistributions')
            ->where('ac_id','=',$id)
            ->select('markdistributions.*')
            ->get();
        
        //dd($users);
        if($users){
            return response()->json(array('users'=> $users));
        }


    }
}
