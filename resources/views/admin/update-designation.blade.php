<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.include.header2')
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
     @include('admin.include.sidebar')
        <div id="content" class="p-4 p-md-5">
            @include('admin.include.navbar')
            <div class="card">
                    <div class="card-header" align="center">
                        Edit Teacher Designation
                    </div>
                    <div class="card-body">

                        <form align="center" action="{{url('/update-teacher-designation/'.$teacher->id)}}" enctype="multipart/form-data" method="post">
                        @csrf  
                        <br>
                            <center><img src="{{ asset('thumbnail/'.$teacher->img)  }}" alt=""></center>
                            
                            <br>
                            @if(Session::has('suc_msg'))
                            <div class="row 4 haha">
                                <div class="alert alert-success">
                                    <strong>{{Session::get('suc_msg')}}</strong> 
                                </div>
                            </div>  
                            @endif
                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Designation    :</label>
                                <input type="text" name="dname" class="form-control-sm" value="{{$teacher->designation}}">
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
