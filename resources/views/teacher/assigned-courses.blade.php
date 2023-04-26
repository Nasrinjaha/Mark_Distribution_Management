<!DOCTYPE html>
<html lang="en">
<head>
@include('teacher.include.header2')

</head>
<body>
<div class="wrapper d-flex align-items-stretch">
     @include('teacher.include.sidebar')
        <div id="content" class="p-4 p-md-5">
            @include('teacher.include.navbar')
            
                <div style=" margin-top: 50px">
                    <table id="example" class="table table-striped table-bordered " style="width:100%;">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Semester</th>
                                <th>Section</th>
                                <th>Course Type</th>
                                <th>Distibute mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $crc)
                            <tr>
                                <td>{{ $crc->Name }}</td>
                                <td>{{ $crc->Course_code }}</td>
                                <td>{{ $crc->Semester }}</td>
                                <td>{{ $crc->section }}</td>
                                <td>
                                    @if($crc->Type==1)
                                        Theory 
                                    @else
                                        Lab
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url ('/teacher-current-course') }}" class="btn btn-secondary">View</a>
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
