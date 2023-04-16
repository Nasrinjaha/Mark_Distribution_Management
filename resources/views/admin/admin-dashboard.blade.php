@extends('admin.layout.full')
@section('content')
<div class="cntnt">
   <h2>Admin's Dashboard</h2>
   <br>
    <h2><b>Name : </b>{{$admin->name}}</h2>
    <h2><b>Email : </b>{{$admin->email}}</h2>


    <p></p>
    <p></p>
</div>  
<div class="card">
    <div class="card-header" align="center">
        Create Student
    </div>
    <div class="card-body">
    </div>
</div>
@stop