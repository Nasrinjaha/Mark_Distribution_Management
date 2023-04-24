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
                        Create Section
                    </div>
                    <div class="card-body">

                        <form  align="center" action="{{ url('/store-section') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <br>
                            @if(Session::has('suc_msg'))
                            <div class="row 4 haha">
                                <div class="alert alert-success">
                                    <strong>{{Session::get('suc_msg')}}</strong> 
                                </div>
                            </div>  
                            @endif
                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Section Name   :</label>
                                <input type="text" name="secname" class="form-control-sm">
                            </div>
                            @if(Session::has('dup_msg'))
                            <div class="row 4 haha">
                                <div class="alert alert-warning ">
                                    <strong>{{Session::get('dup_msg')}}</strong> 
                                </div>
                            </div> 
                            @endif
                            <div class="form-group abc">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <body>
</html>

<script src="js/main.js"></script>

