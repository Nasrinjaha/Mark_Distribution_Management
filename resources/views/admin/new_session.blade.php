@extends('admin.layout.full')
@section('content')
<h3 align="center">Create Session</h3>
<br><br>
<div class="row" >
    <div class="col 4">

    </div>
    <div class="col 4">
        <?php
        $year=$last->Year;
        if($last->Name=="Spring"){
            $new_name="Fall";
        }
        else{
            $new_name="Spring";
            $year++;
        }
        ?>
        <div class="card bg-success text-white" align="center">
            <div class="card-body">CREATE SESSION {{$new_name}} {{$year}}</div>
        </div>
    </div>
    <div class="col 4">

    </div>
    
</div>
<br>
<form  align="center" action="{{ url('/store-session') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div style="margin-top:15px ; border:0px" align="center">
        <button type="submit" class="btn btn-primary">Create</button>
        {{-- <a href="{{ url('/web_v2/store-session') }}" class="btn btn-primary"></a> --}}
    </div>
</form>
@stop