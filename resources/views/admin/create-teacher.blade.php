@extends('admin.layout.full')
@section('content')
<div class="card">
    <div class="card-header" align="center">
        Create Teacher
    </div>
    <div class="card-body">

        <form  align="center" action="{{ url('/store-teacher') }}" enctype="multipart/form-data" method="post">
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
                <label class="col-form-label-sm" for="">Name    :</label>
                <input type="text" name="name" class="form-control-sm">
            </div>
            <div class="form-group">
                <label class="col-form-label-sm" for="">Email   :</label>
                <input type="text" name="email" class="form-control-sm">
            </div>
            @if(Session::has('dup_msg'))
            <div class="row 4 haha">
                <div class="alert alert-warning ">
                    <strong>{{Session::get('dup_msg')}}</strong> 
                </div>
            </div> 
            @endif
            <div class="form-group">
                <label class="col-form-label-sm" for="">Birth Date  :</label>
                <input type="date" name="birth_date" class="form-control-sm">
            </div>

            <div class="form-group">
                <label class="col-form-label-sm" for="">Address :</label>
                <input type="text" name="address" class="form-control-sm" >
            </div>

            <div class="mb-3">
                <label class="col-form-label-sm" for="">Password :</label>
                <input type="password" name="pass1"  class="form-control-sm" placeholder="Enter password" required>
            </div>

            <div class="mb-3">
                <label class="col-form-label-sm" for="">C Password :</label>
                <input type="password" class="form-control-sm" name="pass2"   placeholder="Enter password" required>
            </div>
            @if(Session::has('err_msg'))
            <div class="haha">
                <div class="row 4">
                    <div class="alert alert-danger ">
                        <strong>{{Session::get('err_msg')}}</strong> 
                    </div>
                </div> 
            </div>
            @endif
            <div class="form-group abc">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        
        </form>
    </div>
</div>
@stop