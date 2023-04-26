<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Assigncourse;
use Session;
use App\Models\Course;
use DB;
use App\Models\Session as ses;

class AlternativeTeacherController extends Controller
{
    public function dashboard(){
        $id = Session::get('id');
        $lst=DB::table('sessions')->max('id');
        $teacher = Teacher::find($id);
        $courses =DB::table('assigncourses')
        ->select('courses.id','courses.Course_code','courses.Name','courses.Semester','courses.Type','assigncourses.id','assigncourses.session_id','assigncourses.teacher_id','assigncourses.course_id','assigncourses.section')
        ->join('courses','courses.id','=','assigncourses.course_id')
        ->where('assigncourses.session_id','=',$lst)
        ->where('assigncourses.teacher_id','=',$id)
        ->get()->count();
        $teachers = DB::table('teachers')->count();
        $prevs =DB::table('assigncourses')
        ->select('courses.id','courses.Course_code','courses.Name','courses.Semester','courses.Type','assigncourses.id','assigncourses.session_id','assigncourses.teacher_id','assigncourses.course_id','assigncourses.section')
        ->join('courses','courses.id','=','assigncourses.course_id')
        ->where('assigncourses.session_id','<',$lst)
        ->where('assigncourses.teacher_id','=',$id)
        ->get()->count();
        $last = ses::latest()->first();
        return view('teacher.teacher-dashboardd',compact(['teacher','prevs','courses','teachers','last'])); 
    }
    public function Courses(){
        $id = Session::get('id');
        // $id = 3;
        // $lst=8;
        $lst=DB::table('sessions')->max('id');
        $courses=DB::table('assigncourses')
            ->select('courses.id','courses.Course_code','courses.Name','courses.Semester','courses.Type','assigncourses.id','assigncourses.session_id','assigncourses.teacher_id','assigncourses.course_id','assigncourses.section')
            ->join('courses','courses.id','=','assigncourses.course_id')
            ->where('assigncourses.session_id','=',$lst)
            ->where('assigncourses.teacher_id','=',$id)
            ->get();
        //dd($courses);
        return view('teacher.assigned-courses', compact(['courses']));
    }
    public function dashboardd(){
        $id = Session::get('id');
        $teacher = Teacher::find($id);
        $last = Session::latest()->first();
        return view('teacher.teacher-dashboardd',compact('teacher','last')); 
    }
    public function TeacherProfile(){
        $id = Session::get('id');
        $teacher = Teacher::find($id);
        return view('teacher.teacher-profile',compact(['teacher']));
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
        ->select('assigncourses.session_id', 'assigncourses.teacher_id', 'assigncourses.course_id', 'courses.Name', 'courses.Course_code', 'sessions.Session_name', 'assigncourses.section')
        ->join('courses','assigncourses.course_id','=','courses.id')
        ->join('sessions','assigncourses.session_id','=','sessions.id')
        ->where('assigncourses.session_id','<',$secid)
        ->where('assigncourses.teacher_id','=',$tid)
        ->orderBy('assigncourses.session_id','asc')
        ->get();
        return view('teacher.previous-course', compact('session'));
    }
    public function PreviousCoursee(){
        $tid = Session::get('id');
        $secid = DB::table('sessions')->max('id');

        $semester =DB::table('semesters')
        ->whereIn('id', function ($query) use ($secid, $tid) {
            $query->select(DB::raw('DISTINCT courses.Semester'))
                ->from('assigncourses')
                ->join('courses', 'assigncourses.course_id', '=', 'courses.id')
                ->where('assigncourses.session_id', '<', $secid)
                ->where('assigncourses.teacher_id', '=', $tid)
                ->orderBy('assigncourses.session_id', 'ASC');
        })
        ->get();
    
        $session=DB::table('assigncourses')
        ->select(DB::raw('DISTINCT assigncourses.session_id, sessions.Session_name'))
        ->join('sessions', 'assigncourses.session_id', '=', 'sessions.id')
        ->where('assigncourses.session_id', '<', $secid)
        ->where('assigncourses.teacher_id', '=', $tid)
        ->orderBy('assigncourses.session_id', 'asc')
        ->get();

        return view('teacher.teacher-previous-course', compact('session','semester','tid'));
    }

    public function getPreviousCourse($ses,$sem,$tid){
        //$users = Assigncourse::where('session_id', $id)->get();
       //dd($tid,$secid);
       $sessions =DB::table('assigncourses')
       ->select('assigncourses.session_id', 'assigncourses.teacher_id', 'assigncourses.course_id', 'courses.Name', 'courses.Course_code', 'sessions.Session_name', 'assigncourses.section', 'courses.Semester')
       ->join('courses', 'assigncourses.course_id', '=', 'courses.id')
       ->join('sessions', 'assigncourses.session_id', '=', 'sessions.id')
       ->where('assigncourses.session_id', '=', $ses)
       ->where('assigncourses.teacher_id', '=', $tid)
       ->where('courses.Semester', '=', $sem)
       ->orderBy('assigncourses.session_id', 'ASC')
       ->get();
   
        
        //dd($sessions);
        if($sessions){
            return response()->json(array('sessions'=> $sessions));
        }
         
    }
}
