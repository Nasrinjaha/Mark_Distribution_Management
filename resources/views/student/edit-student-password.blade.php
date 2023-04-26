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
                        Update Password
                    </div>
                    <div class="card-body">

                        <form align="center" action="{{url('/update-student-password/')}}" enctype="multipart/form-data" method="post">
                        @csrf  
                        <br>
                            <center><img src="{{ asset('thumbnail/'.$student->img)  }}" alt=""></center>
                            <br>
                            @if(Session::has('suc_msg'))
                            <div class="row 4 haha">
                                <div class="alert alert-success">
                                    <strong>{{Session::get('suc_msg')}}</strong> 
                                </div>
                            </div>  
                            @endif
                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Current Password    :</label>
                                <input type="text" name="pass1" class="form-control-sm">
                            </div>
                            @if(Session::has('dup_msg1'))
                            <div align="center">
                                <div class="alert alert-warning ">
                                    <strong>{{Session::get('dup_msg1')}}</strong> 
                                </div>
                            </div> 
                            @endif
                            <div class="form-group">
                                <label class="col-form-label-sm" for="">New Password    :</label>
                                <input type="text" name="pass2" class="form-control-sm">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Retype New Password    :</label>
                                <input type="text" name="pass3" class="form-control-sm">
                            </div>
                            @if(Session::has('dup_msg2'))
                            <div align="center">
                                <div class="alert alert-warning ">
                                    <strong>{{Session::get('dup_msg2')}}</strong> 
                                </div>
                            </div> 
                            @endif

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
