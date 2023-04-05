@extends('student.layout.full')
@section('content')
<div class="cntnt">
   <h2>Student's Dashboard</h2>
   <br>
    <h2><b>Name : </b>{{$student->name}}</h2>
    <h2><b>Email : </b>{{$student->email}}</h2>


    <p></p>
    <p></p>
</div>   
@stop