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
                <div align="center" style="background-color:green">
                    <h3>Currently {{$cnt}} student's request is pending</h3>
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
                                <th>Approve</th>
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
                                        <button type="submit">Approve</button>
                                    </form>
                                    
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
