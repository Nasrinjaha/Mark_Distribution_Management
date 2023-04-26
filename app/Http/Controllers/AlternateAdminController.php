<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Assigncourse;
use App\Models\Enroll;
use App\Models\Student;
use Image;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use App\Models\Teacher;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportCourse;
use App\Exports\ExportTeacher;
use App\Exports\ExportStudent;
use App\Models\Semester;
use App\Models\Session as Sess;
use App\Models\Section;

class AlternateAdminController extends Controller
{
    public function dashboardd(){
        $id = Session::get('id');
        $admin = Admin::find($id);
        $students = DB::table('students')->count();
        $courses = DB::table('courses')->count();
        $teachers = DB::table('teachers')->count();
        $last = Session::latest()->first();
        //dd($last);
        return view('admin.admin-dashboardd',compact(['admin','students','courses','teachers','last'])); 
    }

    public function AdminProfile(){
        $id = Session::get('id');
        $ad= Admin::find($id);
        $admin=$ad[0];
        return view('admin.admin-profile',compact(['admin']));
    }
    public function AdminEditProfile(){
        $id = Session::get('id');
        $admin = Admin::find($id);
        return view('admin.admin-edit-profile',compact(['admin']));
    }
    public function AdminUpdateProfile(Request $req){
        $name = $req->name;
        $email = $req->email;
        $birth_date = $req->birth_date;
        $address = $req->address;
        $id = Session::get('id');
        $obj = Admin::find($id);
        $obj->name = $name;
        $obj->email = $email;
        $obj->dob = $birth_date;
        $obj->address = $address;
        if($obj->save()){
           return redirect('/admin-profile');
          // echo "updated";
        }
    }

    public function AdminEditPassword(){
        $id = Session::get('id');
        $admin = Admin::find($id);
        return view('admin.admin-edit-pass',compact(['admin']));
    }
    public function AdminUpdatePassword(Request $req){
        $current = $req->pass1;
        $new = $req->pass2;
        $re_new = $req->pass3;
        $id = Session::get('id');
        $admin = Admin::find($id);
        if($current!=$admin->pass){
            return redirect()->back()->with('dup_msg1','Wrong Password!!!!!');
        }
        if($new!=$re_new){
            return redirect()->back()->with('dup_msg2','New password does not match with retyped password!!!!!');
        }
        $obj = Admin::find($id);
        $obj->pass = $new;
        if($obj->save()){
            return redirect('/admin-password-update')->with('suc_msg','Password Successfully Updated!!!!!');;
         }
    }
    public function CreateCourse(){
        $semesters = Semester::select('*')->get();
        return view('admin.create-course',compact(['semesters'])); 
    }

    public function StoreCourse(Request $req){
        $name = $req->name;
        $code = $req->ccode;
        $credit = $req->crdit;
        $hour=$req->hour;
        $sem=$req->sem;
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
                $obj->Semester= $sem;
                $obj->Type= $type;
                if($obj->save()){
                // return redirect('employees');
                    return redirect()->back()->with('suc_msg','successfully inserted');
                }
            }
    }
    public function CreateSemester(){
        return view('admin.create-semester');
    }
    public function Allcourse(){
        $courses = Course::all();
        return view('admin.course', compact('courses'));
    }
    public function EditCourse($id){
        $course = Course::find($id);
        $sem = $course->Semester;
        $co_sem = Semester::find($sem);
        $semesters = Semester::select('*')->get();
        return view('admin.edit-course', compact(['course','semesters','co_sem']));
    }

    public function UpdateCourse(Request $req, $id){
        $name = $req->name;
        $code = $req->ccode;
        $credit = $req->crdit;
        $hour=$req->hour;
        $sem=$req->sem;

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
        $obj->Semester=$sem;
        $obj->Student_limit	=$limit;
        if($obj->save()){
           return redirect('/all-course');
          // echo "updated";
        }
    }
    public function DeleteCourse($id){
        $course = Course::find($id);

        DB::table('courses')
            ->where('id', '=', $id)
            ->delete();

        return redirect('/all-course');
    }
    public function assignCourse(Request $r){
        //dd($r);
        $indx=$r->
        $name = $r->session;
        $course = $r->input('check');
        //echo $course;
        for($count = 0; $count < count($course); $count++)
        {          
            echo $course[$count];
        }
    }
    public function getSelectedCourse($id){
         //dd($r);
         $msg = "This is a simple message.";
         return response()->json(array('msg'=> $msg), 200);
    }

    public function Session(){
        $ses = Session::all();
        return view('admin.session',compact('ses'));
    }
    public function StartSession(){
        //$last  = Session::max('id');
        $last = Session::latest()->first();
        //dd($last);
        return view('admin.new_session',compact(['last']));
    }
    public function SessionCourses(){
        $courses = Course::all();
        return view('admin.start_session',compact('courses'));
    }
    public function StoreSession(){
        $last = Session::latest()->first();
        $year=$last->Year;
        if($last->Name=="Spring"){
            $new_name="Fall";
        }
        else{
            $new_name="Spring";
            $year++;
        }
        $obj = new Session();
        $obj->Session_name=$new_name." ".$year;
        $obj->Name=$new_name;
        $obj->Year=$year;
        $obj->Status=0;
        if($obj->save()){
            return redirect('/session');
        }
    }
    public function DeactiveSession(Request $r){
        $id = $r->session;
        $ses = Session::find($id);
        //echo "deactive ". $ses->Status;
        $ses->Status=1;
        if($ses->save()){
           return redirect('/session');
        }
    }
    public function ActiveSession(Request $r){
        $id = $r->session;
        $ses = Session::find($id);
       // echo "active ". $ses->Status;
        $ses->Status=0;
        if($ses->save()){
            return redirect('/session');
        }
    }

    public function GetTeacher(){
        $ses = Session::all();
       // $course = Assigncourse::where('session_id', $id)->get();
        return view('admin.teacher-assign2', compact('ses'));
    }

    public function getcoursedata($id,$sid){
        //dd($course_id);

        $users = DB::table('assigncourses')
            ->select(DB::raw('COUNT(id)'))
            ->where('session_id','=',$sid)
            ->where('course_id','=',$id)
            ->get();
        if($users){
            return response()->json(array('section'=> $users));
        }
    }

    public function Enrollreq(){
        $lst=DB::table('sessions')->max('id');
        $enroll=DB::table('assigncourses')
        ->select('assigncourses.id', 'assigncourses.session_id', 'assigncourses.section', 'enrolls.id as enroll_id', 'enrolls.status', 'enrolls.st_id', 'enrolls.assigncourse_id', 'courses.Course_code', 'courses.Name', 'courses.semester')
        ->join('enrolls','assigncourses.id','=','enrolls.assigncourse_id')
        ->join('courses','assigncourses.course_id','=','courses.id')
        ->where('assigncourses.session_id','=',$lst)
        ->where('enrolls.status','=',0)
        ->get();
        $cnt=count($enroll);
        $last = Session::latest()->first();
        return view('admin.enroll-request', compact(['enroll','cnt','last']));
    }
    public function AppEnrollreq($id){
        $obj =Enroll::find($id);
        $obj->status = 1;
        if($obj->save()){
            return redirect()->back();
        }
    }
    public function DeleteEnrollreq($id){
        $obj =Enroll::find($id);

        DB::table('enrolls')
            ->where('id', '=', $id)
            ->delete();

        return redirect('/enrollment');
    }
    public function getsemester(){
        $semesters = Semester::select('*')->get();
        // dd($semesters);
        if($semesters){
            return response()->json(array('semesters'=> $semesters));
        }
    }

    public function viewCoursepdf($id){
        $course = Course::find($id);
        $pdf = Pdf::loadView('admin.create-course-pdf',compact('course'));
        return $pdf->stream();
    }

    public function downloadCoursepdf($id){
        $course = Course::find($id);
        $pdf = Pdf::loadView('admin.create-course-pdf',compact('course'));
        return $pdf->download();
    }
    
    public function viewTeacherepdf($id){
        $tec =Teacher::find($id);
        $pdf = Pdf::loadView('admin.create-teacher-pdf',compact('tec'));
        return $pdf->stream();
    }

    public function downloadTeacherpdf($id){
        $tec =Teacher::find($id);
        $pdf = Pdf::loadView('admin.create-teacher-pdf',compact('tec'));
        return $pdf->download();
    }
    public function viewStudentepdf($id){
        $stu =Student::find($id);
        $pdf = Pdf::loadView('admin.create-student-pdf',compact('stu'));
        return $pdf->stream();
    }

    public function downloadStudentpdf($id){
        $stu =Student::find($id);
        $pdf = Pdf::loadView('admin.create-student-pdf',compact('stu'));
        return $pdf->download();
    }
    
    public function course_execel_crt(){
        return Excel::download(new ExportCourse, 'Courses.xlsx');
    }

    public function teacher_execel_crt(){
        return Excel::download(new ExportTeacher, 'Teachers.xlsx');
    }
    public function student_execel_crt(){
        return Excel::download(new ExportStudent, 'Students.xlsx');
    }


}
