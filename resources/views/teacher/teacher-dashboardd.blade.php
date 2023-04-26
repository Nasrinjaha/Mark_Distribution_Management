<!doctype html>
<html lang="en">
  <head>
      @include('teacher.include.header')
      @include('teacher.include.dashboard-css')
  </head>
  <body>
		
<div class="wrapper d-flex align-items-stretch">
    @include('teacher.include.sidebar')
    <div id="content" class="p-4 p-md-5">
        @include('teacher.include.navbar')
        <div class="cntnt">
        {{-- <h2>Adminn's Dashboard</h2>teacher
        <br>
            <h2><b>Name : </b>{{$admin->name}}</h2>
            <h2><b>Email : </b>{{$admin->email}}</h2> --}}
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card-box bg-blue">
                    <div class="inner">
                        <h3> {{$courses}} </h3>
                        <p> Current session's Course's </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    </div>
                    <a href="{{url('/teacher-courses')}}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-box bg-red">
                    <div class="inner">
                        <h3> {{$prevs}} </h3>
                        <p> Previous session's Course's </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{url('/teacher-previous-coursess')}}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="card-box bg-orange dv1">
                        <div class="inner">
                            <p> My Profile </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                        </div>
                        <a href="{{url('/teacher-profile')}}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>  
     </div>
  </div>
 
  </body>
</html>
<script src="js/main.js"></script>