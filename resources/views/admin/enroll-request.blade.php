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
                @if($last->Enrollment_status==0)
                    {{-- <button class="btn btn-primary" align="center">Turn Enrollment On</button> --}}
                    <a data-toggle="modal" data-target="#abc{{$last->id}}"  class="btn btn-success">Turn Enrollment On</a>
                    <div class="modal" id="abc{{$last->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Turn On</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                           
                            <div class="modal-body">
                                Are you sure you want to Turn On?
                            </div>

                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <a href="{{ url('enrollmentswitching/'.$last->id) }}" class="btn btn-success">Yes</a>
                            </div>

                            </div>
                        </div>
                    </div>
                @elseif($last->Enrollment_status==1)
                    {{-- <button class="btn btn-primary" align="center">Turn Enrollment OFF</button> --}}
                    <a data-toggle="modal" data-target="#def{{$last->id}}"  class="btn btn-danger">Turn Enrollment OFF</a>
                    <div class="modal" id="def{{$last->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Turn OFF</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <div class="modal-body">
                                Are you sure you want to Turn Off?
                            </div>

                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <a href="{{ url('enrollmentswitching/'.$last->id) }}" class="btn btn-success">Yes</a>
                            </div>

                            </div>
                        </div>
                    </div>
                @endif
                <div align="center" style="background-color:white">
                    <h2>Pending {{$cnt}} student's -> {{$last->Session_name}}</h2>
                </div>
                <div style=" margin-top: 50px">
                    <table id="example" class="table table-striped table-bordered " style="width:100%;">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Semester</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enroll as $enroll)
                            <tr>
                                <td>{{ $enroll->st_id }}</td>
                                <td>{{ $enroll->Name }}</td>
                                <td>{{ $enroll->Course_code }}</td>
                                <td>{{ $enroll->semester }}</td>
                                <td>{{ $enroll->section }}</td>
                                
                                 <td>
                                     <!-- <a href="{{ url('apprve/'.$enroll->enroll_id) }}"class="btn btn-success">Approve</a>  -->

                                    <a data-toggle="modal" data-target="#abc{{$enroll->enroll_id}}"  class="btn btn-success">Approve</a>
                                    <div class="modal" id="abc{{$enroll->enroll_id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            
                                            <div class="modal-header">
                                                <h4 class="modal-title">Approve Confirmation</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            
                                            <div class="modal-body">
                                                Are you sure you want to Approve?
                                            </div>

                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                <a href="{{ url('apprve/'.$enroll->enroll_id) }}" class="btn btn-success">Yes</a>
                                            </div>

                                            </div>
                                        </div>
                                    </div>

                                    <a data-toggle="modal" data-target="#enroll{{$enroll->enroll_id}}"  class="btn btn-danger">Delete</a>
                                    <div class="modal" id="enroll{{$enroll->enroll_id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Confirmation</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                        
                                            <div class="modal-body">
                                                Are you sure you want to delete?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                <a href="{{url('deletreq/'.$enroll->enroll_id)}}"class="btn btn-success">Yes</a>
                                            </div>

                                            </div>
                                        </div>
                                    </div> 

                                    


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<script src="js/main.js"></script>
