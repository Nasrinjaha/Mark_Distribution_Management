<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Course;

class SessionController extends Controller
{
    public function Session(){
        $ses = Session::all();
        return view('session.session',compact('ses'));
    }
    public function StartSession(){
        //$last  = Session::max('id');
        $last = Session::latest()->first();
        //dd($last);
        return view('session.new_session',compact(['last']));
    }
    public function SessionCourses(){
        $courses = Course::all();
        return view('session.start_session',compact('courses'));
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
    public function DeactiveSession($id){
        $ses = Session::find($id);
        $ses->Staus=0;
        if($ses->save()){
            return view('session.session');
        }
    }
    public function ActiveSession($id){
        $ses = Session::find($id);
        $ses->Staus=1;
        if($ses->save()){
            return view('session.session');
        }
        
    }

}
