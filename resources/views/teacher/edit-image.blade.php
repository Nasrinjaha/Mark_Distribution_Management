<!DOCTYPE html>
<html lang="en">
<head>
    @include('teacher.include.header')
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
     @include('teacher.include.sidebar')
        <div id="content" class="p-4 p-md-5">
            @include('teacher.include.navbar')
            <div class="card">
                    <div class="card-header" align="center">
                        Edit Profile Picture
                    </div>
                    <div class="card-body">

                        <form align="center" action="{{url('/store-teacher-image/')}}" enctype="multipart/form-data" method="post">
                        @csrf  
                        
                            <center><img src="{{ asset('thumbnail/'.$teacher->img)  }}" alt=""></center>
                            <br>
                            <div class="form-group">
                            @if(Session::has('suc_msg'))
                            <div align="center">
                                <div class="alert alert-success">
                                    <strong>{{Session::get('suc_msg')}}</strong> 
                                </div>
                            </div>  
                            @endif
                            <div class="form-group">
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
                        
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
<script src="js/main.js"></script> 

