@extends('teacher.layout.full')
@section('content')
<div class="cntnt">
   <h2>Teacher's Dashboard</h2>
   <br>
    <h2><b>Name : </b>{{$teacher->name}}</h2>
    <h2><b>Email : </b>{{$teacher->email}}</h2>


    <p></p>
    <p></p>
</div>  
@stop