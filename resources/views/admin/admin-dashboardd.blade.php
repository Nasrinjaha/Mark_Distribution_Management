@extends('admin.layout.full2')
@section('content')
<div class="cntnt">
   {{-- <h2>Adminn's Dashboard</h2>
   <br>
    <h2><b>Name : </b>{{$admin->name}}</h2>
    <h2><b>Email : </b>{{$admin->email}}</h2> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
  <div class="row">
      <div class="col-lg-4 col-sm-6">
          <div class="card-box bg-red">
              <div class="inner">
                  <h3> {{$students}} </h3>
                  <p> Current Student's </p>
              </div>
              <div class="icon">
                  <i class="fa fa-users"></i>
              </div>
              <a href="{{url('/all-students')}}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue">
                <div class="inner">
                    <h3> {{$courses}} </h3>
                    <p> Available Courses </p>
                </div>
                <div class="icon">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                </div>
                <a href="{{url('/all-course')}}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> {{$teachers}} </h3>
                    <p> Faculty Members </p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </div>
                <a href="{{url('/all-teachers')}}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
</div>  

@stop