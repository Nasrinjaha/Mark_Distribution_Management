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

        <form action="" align="center">
            @csrf
            <br>
            <div class="form-group">
                <label class="col-form-label-sm" for="">Name:</label>
                <input type="text" class="form-control-sm">
            </div>
            <div class="form-group">
                <label class="col-form-label-sm" for="">Email:</label>
                <input type="text" class="form-control-sm">
            </div>
        
        </form>
    </div>
</div>
@stop