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
use App\Models\Assignmark;
use App\Models\Semester;
use Barryvdh\DomPDF\Facade\Pdf;

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
        return view('teacher.mark-distributionn',compact('ses')); 
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

    public function getStudent(){
        $ses = Sess::all();
        return view('teacher.assign-marks',compact('ses'));
    }
    public function assignStudent($cid){
        $tid = Session::get('id');
       // echo $tid;
        $users=DB::table('enrolls')
            ->select('enrolls.st_id','students.name as name','enrolls.id')
            ->join('students','enrolls.st_id','=','students.id')
            ->where('enrolls.assigncourse_id','=',$cid)
            ->where('enrolls.status','=',1)
            ->get();
        //dd($users);

        $category = Markdistribution::where('ac_id', $cid)
                            ->select('*')
                            ->get();  
                               
        if($users){
            return response()->json(array('users'=> $users,'category'=>$category));
        }
    }
    public function storeMarks(Request $r){
        //dd($r);
        $eti=$r->eti;
        $marks= $r->marks;
        $arr = explode('-',$eti);
        $std_id = $arr[0];
        $cat_id = $arr[1];
        $ac_id = $arr[2];

        $data = Assignmark::where('st_id','=',$std_id)
                ->where('cat_id','=',$cat_id)
                ->where('ac_id','=',$ac_id)
                ->first();
        if($data){
            $data->delete();
        }
       // dd($std_id);
        $obj = new Assignmark();
                $obj->st_id = $std_id; 
                $obj->ac_id = $ac_id;
                $obj->cat_id =  $cat_id;
                $obj->marks = $marks;

        if($obj->save()){
            return response()->json([
                'msg' => 'Successfully Inserted',
              
            ]);
        }
        else{
            return response()->json([
                'msg' => 'failed',
              
            ]);
        }
        //return redirect()->back()->with('ERR_msg','FAILED');


    //     $course = $r->course;
    //     $student_id =  $r->student;
    //     $category = Markdistribution::where('ac_id', $course)
    //         ->select('*')
    //         ->get();
    //     $cnt = count( $category);
    //     $num_list = array();
    //    foreach($category as $c){
    //         $cat = $c->category;
            
    //         $cat = $r->input($cat);
    //         array_push($num_list, $cat);
    //    }

    //    for($i=0;$i<count($student_id);$i++){
    //         Assignmark::where('st_id', $student_id[$i])->delete();
    //         for($j=0;$j<$cnt;$j++){
    //             $obj = new Assignmark();
    //             $obj->st_id = $student_id[$i]; 
    //             $obj->ac_id = $course;
    //             $obj->cat_id =  $category[$j]->id;
    //             if($num_list[$j][$i]==""){
    //                 continue;
    //             }
    //             else{

    //                 $checkcatnum = Markdistribution::where('id', $category[$j]->id)
    //                                             ->select('*')
    //                                             ->get();
    //                // dd($checkcatnum[0]->marks);
    //                 if($num_list[$j][$i]>$checkcatnum[0]->marks){
    //                     return redirect()->back()->with('err_msg','undefined marks distribution');
    //                 }
    //                 else{
    //                     $obj->marks=$num_list[$j][$i];
    //                 }
                    
    //             }
    //             $obj->save();
    //         }
    //    }
    //    return redirect()->back()->with('suc_msg','successfully inserted');

               
    }

    public function getStudentAssignMarks($sid,$catid,$acid){
       //dd($sid);
       $users=DB::table('assignmarks')
            ->select('marks')
            ->where('st_id','=',$sid)
            ->where('cat_id','=',$catid)
            ->where('ac_id','=',$acid)
            ->first();
        if($users){
            return response()->json(array('assignmarks'=> $users->marks));
        }
        


    }


    public function storeSemester(Request $req){
        $obj = new Semester();
        $obj->name = $req->teacher_name;
        if($obj->save()){
            return response()->json([
                'msg' => 'Successfully Inserted',
                'teacher' => $obj
            ]);
        }
    }

    public function getSemester(){
        return view('teacher.semester');
    }


    public function editImage(){
        $id = Session::get('id');
        $teacher = Teacher::find($id);
        return view('teacher.edit-image',compact(['teacher']));
    }
    public function UpdateImage(Request $req){

        $id = Session::get('id');
        $originalImage = $req->file('img');
        $thumbnailImage = Image::make($originalImage);

        $thumbnailPath = public_path().'/thumbnail/';
        $originalPath = public_path().'/images/';

        $full_file_name = $originalImage->getClientOriginalName();
        $extension = $originalImage->getClientOriginalExtension();
        $filename = time().'.'.$extension;

        $thumbnailImage->save($originalPath.$filename);
        
        $thumbnailImage->resize(150,150);
        $thumbnailImage->save($thumbnailPath.$filename);  


        $obj = Teacher::find($id);
        $obj->img = $filename;
        if($obj->save()){
            return redirect('admin-image-update')->with('suc_msg','Password Successfully Updated!!!!!');
        }
    }

    public function viewTeacherepdff($id){
        $tec =Teacher::find($id);
        $pdf = Pdf::loadView('teacher.create-teacher-pdf',compact('tec'));
        return $pdf->stream();
    }

    public function downloadTeacherpdff($id){
        $tec =Teacher::find($id);
        $pdf = Pdf::loadView('teacher.create-teacher-pdf',compact('tec'));
        return $pdf->download();
    }
}
