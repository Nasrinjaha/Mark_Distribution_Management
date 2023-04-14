<!DOCTYPE html>
<html lang="en">
<head>
@include('admin.include.header')

</head>
<body>
<div class="wrapper d-flex align-items-stretch">
     @include('admin.include.sidebar')
        <div id="content" class="p-4 p-md-5">
            @include('admin.include.navbar')
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
                                  
                                    <a href="{{ url ('/abc/'.$enroll->enroll_id) }}" type="submit" class="btn btn-secondary">Approve</a>
                                  
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
