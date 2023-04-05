<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
   public function Template(){
     return view('navber');
   }

   public function Login(){
        return view('login');
  }

}
