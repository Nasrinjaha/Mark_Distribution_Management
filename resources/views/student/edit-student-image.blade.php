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
                        Edit Profile Picture
                    </div>
                    <div class="card-body">

                        <form align="center" action="{{url('/update-student-image/')}}" enctype="multipart/form-data" method="post">
                        @csrf  
                        
                            <center><img src="{{ asset('thumbnail/'.$student->img)  }}" alt=""></center>
                            <br>
                            @if(Session::has('suc_msg'))
                            <div class="row 4 haha">
                                <div class="alert alert-success">
                                    <strong>{{Session::get('suc_msg')}}</strong> 
                                </div>
                            </div>  
                            @endif  
                            <br>
                            <div align="center">
                                <div class="form-group" align="center">
                                    <label class="col-form-label-sm" for="">choose file   :</label>
                                    <input type="file" name="img" class="form-control-sm">
                                </div>
                                @if(Session::has('dup_msg1'))
                                <div align="center">
                                    <div class="alert alert-warning ">
                                        <strong>{{Session::get('dup_msg1')}}</strong> 
                                    </div>
                                </div> 
                                @endif
                            
                                <div class="form-group" align="center">
                                    <button type="submit"  name = "submit" class="btn btn-primary">Save</button>
                                </div>
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

