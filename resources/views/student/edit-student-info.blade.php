<!DOCTYPE html>
<html lang="en">
<head>
    @include('student.include.header')
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
     @include('student.include.sidebar')
        <div id="content" class="p-4 p-md-5">
            @include('student.include.navbar')
            <div class="card">
                    <div class="card-header" align="center">
                        Edit Info
                    </div>
                    <div class="card-body">

                        <form align="center" action="{{url('/update-student-profile-info/')}}" enctype="multipart/form-data" method="post">
                        @csrf  
                        <br>
                            <center><img src="{{ asset('thumbnail/'.$student->img)  }}" alt=""></center>
                            <div class="form-group">
                            <br>
                            <a class="btn btn-primary"  href="{{ url('/downloadStudentpdff/'.$student->id) }}">Download pdf</a>
                                <a class="btn btn-primary"  href="{{ url('/viewStudentpdff/'.$student->id) }}">View pdf</a>
                            </div>
                            <br>
                            @if(Session::has('suc_msg'))
                            <div class="row 4 haha">
                                <div class="alert alert-success">
                                    <strong>{{Session::get('suc_msg')}}</strong> 
                                </div>
                            </div>   
                            @endif
                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Name    :</label>
                                <input type="text" name="name" class="form-control-sm" value="{{$student->name}}">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Email   :</label>
                                <input type="text" name="email" class="form-control-sm" value="{{$student->email}}">
                            </div>

                            @if(Session::has('dup_msg'))
                            <div class="row 4" align="center">
                                <div class="alert alert-warning ">
                                    <strong>{{Session::get('dup_msg')}}</strong> 
                                </div>
                            </div> 
                            @endif

                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Birth Date  :</label>
                                <input type="date" name="birth_date" class="form-control-sm" value="{{$student->dob}}">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Address :</label>
                                <input type="text" name="address" class="form-control-sm" value="{{$student->address}}" >
                            </div>

                            <div class="form-group abc">
                                <button type="submit"  name = "submit" class="btn btn-primary">Save</button>
                            </div>
                        
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
<script src="js/main.js"></script> 