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
                                    <form method="get" action="{{ url('apprve/'.$enroll->enroll_id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <br>
                                        <a data-toggle="modal" data-target="#enroll{{$enroll->enroll_id}}" class="btn btn-danger">Delete</a>
                                        <div class="modal" id="enroll{{$enroll->enroll_id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
        
                                        <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Confirmation</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
        
                                        <!-- Modal body -->
                                                     <div class="modal-body">
                                                        Are you sure you want to delete?
                                                    </div>
        
                                        <!-- Modal footer -->
                                                     <div class="modal-footer">
                                            <form align="center" action="{{url('deletreq/'.$enroll->enroll_id)}}" enctype="multipart/form-data" method="get">
                                                {{ csrf_field() }}
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            <button type="submit"  name = "submit" class="btn btn-success">Yes</button>
                                            </form>
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
