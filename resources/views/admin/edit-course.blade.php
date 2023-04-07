@extends('admin.layout.full')
@section('content')
<div class="card">
    <div class="card-header" align="center">
        Edit Course Details
    </div>
    <div class="card-body">

        <form align="center" action="{{url('/update-course/'.$course->id)}}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
        <br>
            <div class="form-group">
            <br>
            <a class="btn btn-primary"  href="{{ url('/downloadstd/'.$course->id) }}">Download pdf</a>
            <a class="btn btn-primary"  href="{{ url('/readstd/'.$course->id) }}">View pdf</a>
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
                <label class="col-form-label-sm" for="">Course Name    :</label>
                <input type="text" name="name" class="form-control-sm" value="{{$course->Name}}">
            </div>
            <div class="form-group">
                <label class="col-form-label-sm" for="">Couse Code   :</label>
                <input type="text" name="ccode" class="form-control-sm" value="{{$course->Course_code}}">
            </div>

            @if(Session::has('dup_msg'))
            <div class="row 4 haha">
                <div class="alert alert-warning ">
                    <strong>{{Session::get('dup_msg')}}</strong> 
                </div>
            </div> 
            @endif
            <div class="form-group">
                <label class="col-form-label-sm" for="">Course Credit  :</label>
                <input type="number" name="crdit" class="form-control-sm" step="any" value="{{$course->Credit}}">
            </div>
            <div class="form-group">
                <label class="col-form-label-sm" for="">Course Hour   :</label>
                <input type="number" name="hour" class="form-control-sm" step="any" value="{{$course->Hour}}" >
            </div>
            <div class="form-group">
                @if($course->Type==1)
                    @php
                        $p= "Theory";
                        $a="theory";
                    @endphp
                @else
                    @php
                        $p= "Lab";
                        $a="lab";
                    @endphp
                @endif
                <label for="ctype" class="form-label">Course Type</label>
                <select name="type" class="form-group" id="ctype" >
                  <option value="<?php echo $a; ?>">{{$p}}</option>
                  <option value="lab">LAB</option>
                  <option value="theory">Theory</option>
                </select>
            </div>
            <div class="form-group abc">
                <button type="submit"  name = "submit" class="btn btn-primary">Save</button>
            </div>
        
        </form>
    </div>
</div>
@stop