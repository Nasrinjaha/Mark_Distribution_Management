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
        $last = Session::latest()->first();
        return view('session.new_session',compact(['last']));
    }
    public function SessionCourses(){
        $courses = Course::all();
        return view('session.start_session',compact('courses'));
    }

}
