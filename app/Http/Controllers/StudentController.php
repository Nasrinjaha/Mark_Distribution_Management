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
use App\Models\Enroll;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $sid = Session::get('id');
        $acid = $r->input('check');
        //echo $course;
        for($count = 0; $count < count($acid); $count++){  
            $obj = new Enroll(); 
            $obj->assigncourse_id=$acid[$count];
            $obj->st_id=$sid;
            $obj->status=0;
            if($obj->save()){
            }
            else{
                echo "failed";
            }  
        }
        return redirect()->back()->with('suc_msg','Successfully inserted');
    }

    public function editProfileInfo(){
        $id = Session::get('id');
        $student = Student::find($id);
        return view('student.edit-student-info', compact('student'));
    }

    public function   updateProfileInfo(Request $req){
        $id = Session::get('id');
        $name = $req->name;
        $email = $req->email;
        $dob = $req->birth_date;
        $address=$req->address;
        $users =  Student::select("*")
        ->where("email", "=", $email)
        ->first();  
        if($users && ($users->id!=$id)){
            return redirect()->back()->with('dup_msg','Already exist Email!!!!!');
        } 
        $obj =  Student::find($id);
        $obj->name = $name;
        $obj->email = $email;
        $obj->dob = $dob;
        $obj->address = $address;
        if($obj->save()){
           return redirect('/edit-student-profile-info')->with('suc_msg','Information Successfully Updated!!!!!');;
        }
    }
  
    public function editPassword(){
        $id = Session::get('id');
        $student = Student::find($id);
        return view('student.edit-student-password', compact('student'));
    }

    public function updatePassword(Request $req){
        $current = $req->pass1;
        $new = $req->pass2;
        $re_new = $req->pass3;
        $id = Session::get('id');
        $student =  Student::find($id);
        if($current!= $student->pass){
            return redirect()->back()->with('dup_msg1','Wrong Password!!!!!');
        }
        if($new!=$re_new){
            return redirect()->back()->with('dup_msg2','New password does not match with retyped password!!!!!');
        }
        $obj =  Student::find($id);
        $obj->pass = $new;
        if($obj->save()){
            return redirect('/edit-student-password')->with('suc_msg','Password Successfully Updated!!!!!');;
         }
    }

    public function editStudentImage(){
        $id = Session::get('id');
        $student = Student::find($id);
        return view('student.edit-student-image', compact('student'));
    }

    public function updateProfileImage(Request $req){

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


        $obj =  Student::find($id);
        $obj->img = $filename;
        if($obj->save()){
            return redirect('/edit-student-image')->with('suc_msg','Successfully Updated!!!!!');
        }
    }  


    public function viewStudentepdff($id){
        $stu =Student::find($id);
        $pdf = Pdf::loadView('student.create-student-pdf',compact('stu'));
        return $pdf->stream();
    }

    public function downloadStudentpdff($id){
        $stu =Student::find($id);
        $pdf = Pdf::loadView('student.create-student-pdf',compact('stu'));
        return $pdf->download();
    }

    // public function ViewResult(){
    //     $id=Session::get('id');
    //     $secid = DB::table('sessions')->max('id');
    //     $crc=DB::table('assigncourses')
    //     ->join('courses', 'assigncourses.course_id', '=', 'courses.id')
    //     ->select('assigncourses.id', 'courses.Name', 'assigncourses.section')
    //     ->whereIn('assigncourses.id', function($query) use ($id,$secid){
    //         $query->select('assigncourse_id')
    //             ->from('enrolls')
    //             ->where('st_id', '=', $id);
    //     })
    //     ->where('session_id', '=', 8)
    //     ->get();
    
    //     return view('student.student-result', compact('crc'));
    // }
    public function ViewResult(){
        $id=Session::get('id');
        $secid = DB::table('sessions')->max('id');
        $crc=DB::table('assigncourses')
        ->join('courses', 'assigncourses.course_id', '=', 'courses.id')
        ->select('assigncourses.id', 'courses.Name', 'assigncourses.section')
        ->whereIn('assigncourses.id', function($query) use ($id,$secid){
            $query->select('assigncourse_id')
                ->from('enrolls')
                ->where('st_id', '=', $id);
        })
        ->where('session_id', '=', $secid)
        ->get();
        //dd($crc);
        return view('student.student-result', compact('crc','id'));
    }
    public function Category($id){
        $category=DB::table('markdistributions')->where('ac_id', '=', $id)->get();
        if($category){
            return response()->json(array('category'=> $category));
        }
    }
    public function ResultMarkss($id){
        $sid=Session::get('id');
        $mark = DB::table('assignmarks')
        ->join('students', 'assignmarks.st_id', '=', 'students.id')
        ->select('students.name', 'assignmarks.st_id', 'assignmarks.ac_id', 'assignmarks.cat_id', 'assignmarks.marks', 'assignmarks.Publish_sts', 'assignmarks.id')
        ->where('assignmarks.ac_id', '=', $id)
        ->where('assignmarks.st_id', '=', $sid)
        ->where('assignmarks.Publish_sts', '=', 1)
        ->get();

        if($mark){
            return response()->json(array('mark'=> $mark));
        }
    }
}


