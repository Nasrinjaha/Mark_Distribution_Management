@extends('admin.layout.full')
@section('content')
<div class="card">
    <div class="card-header" align="center">
        Create Course
    </div>
    <div class="card-body">

        <form  align="center" action="{{ url('/store-course') }}" enctype="multipart/form-data" method="post">
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
                <label class="col-form-label-sm" for="">Course Title    :</label>
                <input type="text" name="name" class="form-control-sm">
            </div>
            <div class="form-group">
                <label class="col-form-label-sm" for="">Course Code   :</label>
                <input type="text" name="ccode" class="form-control-sm">
            </div>
            @if(Session::has('dup_msg'))
            <div class="row 4 haha">
                <div class="alert alert-warning ">
                    <strong>{{Session::get('dup_msg')}}</strong> 
                </div>
            </div> 
            @endif
            <div class="form-group">
                <label class="col-form-label-sm" for="">Couse Credit  :</label>
                <input type="number" name="crdit" class="form-control-sm" step="any">
            </div>
            <div class="form-group">
                <label class="col-form-label-sm" for="">Course Hour   :</label>
                <input type="number" name="hour" class="form-control-sm" step="any">
            </div>
            <div class="form-group">
                <label for="ctype" class="form-label">Course Type</label>
                <select name="type" class="form-group" id="ctype">
                  <option value="">Select Type</option>
                  <option value="lab">LAB</option>
                  <option value="theory">Theory</option>
                </select>
            </div>


            <div class="form-group abc">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        
        </form>
    </div>
</div>
@stop