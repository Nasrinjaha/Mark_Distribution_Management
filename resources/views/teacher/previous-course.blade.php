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
                
                <div style=" margin-top: 50px">
                    <table id="example" class="table table-striped table-bordered " style="width:100%;">
                        <thead>
                            <tr>
                                <th>Session</th>
                                <th>Semester</th>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($session as $sec)
                            <tr>
                                <td>{{ $sec->Session_name }}</td>
                                <td>{{ $sec->Semester }}</td>
                                <td>{{ $sec->Name }}</td>
                                <td>{{ $sec->Course_code }}</td>
                                <td>{{ $sec->section }}</td>
                                <td>
                                    <a href="#" class="btn btn-secondary">View</a>
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
