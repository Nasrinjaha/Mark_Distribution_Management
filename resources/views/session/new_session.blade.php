@extends('admin.layout.full')
@section('content')
<div class="card">
        <?php
        $year=$last->Year;
        if($last->Session_name=="Spring"){
            $new_name="Fall";
        }
        else{
            $new_name="Spring";
            $year++;
        }
        ?>

    <div class="card bg-success text-white" align="center">
        <div class="card-body">START SESSION {{$new_name}} {{$year}}</div>
    </div>
    
</div>
<div style="margin-top:15px ; border:0px" align="center">
    <a href="{{ url('/session-courses') }}" class="btn btn-primary">Start New Session</a>
</div>

@stop