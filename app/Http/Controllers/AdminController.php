<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Session as Sess;
use App\Models\Course;
use App\Models\Assigncourse;
use App\Models\Section;
use App\Models\Semester;

use Illuminate\Http\Request;
use Session;
use Image;
use DB;
class AdminController extends Controller
{
    public function dashboard(){
        $id = Session::get('id');
        $admin = Admin::find($id);
        return view('admin.admin-dashboardd',compact('admin')); 
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
        $sec = $r->input('s');
        //echo $course;
        for($count = 0; $count < count($course); $count++)
        {  
            $section = $sec[$course[$count]];
            $v = 'A';
            for($i=0;$i<$section;$i++){
                $obj = new Assigncourse(); 
                $obj->session_id=$sessionid;
                $obj->course_id=$course[$count];
                $obj->teacher_id=0;
                $obj->section=0;
                if($obj->save()){
                }
                else{
                    echo "failed";
                }
            }
        }
        return redirect()->back()->with('suc_msg','Successfully inserted');
    }
    public function getSelectedCourse($id){
        $users = Assigncourse::where('session_id', $id)
                            ->select('course_id', DB::raw('count(*) as total'))
                            ->groupBy('course_id')
                            ->get();
         

        $allcourses = Course::all();
                            
                               
        if($users){
            return response()->json(['users'=> $users,'allcourses'=>$allcourses]);
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

    public function GetTeacher(){
        $ses = Sess::all();
        $semester= Semester::all();
        return view('admin.teacher-assign', compact('ses','semester'));
    }

    public function getAssignCourse($id,$sid){
        //$users = Assigncourse::where('session_id', $id)->get();
       //dd($sid);
        $users = DB::table('assigncourses')
            ->join('courses', 'assigncourses.course_id', '=', 'courses.id')
            ->join('semesters', 'courses.semester', '=', 'semesters.id')
            ->where('assigncourses.session_id','=',$id)
            ->where('courses.semester','=',$sid)
            ->select('courses.*')
            ->distinct()//section concate
            ->get();
        
        //dd($users);
        if($users){
            return response()->json(array('users'=> $users));
        }
         
    }
    public function getSection($id,$sid){
        //dd($course_id);

        $users = DB::table('assigncourses')
            ->select('assigncourses.section','assigncourses.teacher_id')
            ->where('session_id','=',$sid)
            ->where('course_id','=',$id)
            ->get();

        $teachers = Teacher::where('id','<>', 0)->get();
        if($users){
            return response()->json(array('section'=> $users,'teachers'=>$teachers));
        }
    }

    public function StoreSectionTeacher(Request $r){
        
        $sid = $r->session;
        $id = $r->course;
        $section=$r->input('section');
       //dd($section);
        $teacher = $r->input('teacher');
        //dd($r );
        $obj = Assigncourse::where('session_id','=',$sid)
                    ->where('course_id','=',$id)
                    ->get();
        $length = count($obj);    
        
         $flag = 1;
         for($count = 0; $count<$length;$count++){ 
             if($teacher[$count]!=""){
               
                $obj[$count]->teacher_id=$teacher[$count];
                //echo "b";
             }
             else{
                $obj[$count]->teacher_id=0;

             }
             $obj[$count]->section=$section[$count];
             $obj[$count]->save();

            if($obj[$count]->save()){
            }
            else{
                $flag = 0;
            }
             
           }
            if($flag){
                return redirect()->back()->with('suc_msg','successfully updated');
            }
            
        }

    public function SessionEnrollmentRequest(){
        $ses = Sess::all();
        //dd($ses);
        // $course = Assigncourse::where('session_id', $id)->get();
         return view('admin.temp', compact('ses'));

    }

    public function EnrollmentRequest(){
        $lst=DB::table('sessions')->max('id');
        $enroll=DB::table('assigncourses')
            ->select('assigncourses.id', 'assigncourses.session_id', 'assigncourses.section', 'enrolls.id as enroll_id', 'enrolls.status', 'enrolls.st_id', 'enrolls.assigncourse_id', 'courses.Course_code', 'courses.Name', 'courses.semester')
            ->join('enrolls','assigncourses.id','=','enrolls.assigncourse_id')
            ->join('courses','assigncourses.course_id','=','courses.id')
            ->where('assigncourses.session_id','=',$lst)
            ->where('enrolls.status','=',0)
            ->get();

        return view('admin.temp', compact('enroll'));
    }
    public function ApproveEnrollmentRequest($id){
        $user = Enroll::find($id);
        $user->status = 1;
        if($user->save()){
            return redirect()->back();
        }
    }
    
    public function storeSemester(Request $r){
        //dd($r);
        $name = $r->semname;
        $users = Semester::select("*")
        ->where("name", "=", $name)
        ->first();  
        if($users){
            return redirect()->back()->with('dup_msg','Already exist Semester!!!!!');
        } 
        else{
            $obj = new Semester(); 
            $obj->name = $name;
            if($obj->save()){
                return redirect()->back()->with('suc_msg','successfully inserted');
            }
        }
        
    }

    public function adminImageEdite(){
        $id = Session::get('id');
        $admin = Admin::find($id);
        return view('admin.admin-edit-image',compact(['admin']));
    }
    public function UpdateProfileImage(Request $req){

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


        $obj = Admin::find($id);
        $obj->img = $filename;
        if($obj->save()){
            return redirect('admin-image-update');
        }
    }
    public function editDesgnatoin(){
        $teachers = Teacher::all();
        return view('admin.edit-designation', compact('teachers'));
    }
    public function UpdateDesgnatoin(Request $r){
        dd($r);
    }

}
