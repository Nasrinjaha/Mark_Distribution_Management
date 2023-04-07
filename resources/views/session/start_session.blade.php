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
            <table id="example" class="table table-striped table-bordered " style="width:100%;">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Course Credit</th>
                        <th>Student Limit(Per Section)</th>
                        <th>Hour</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $crc)
                    <tr>
                        <td>{{ $crc->Name }}</td>
                        <td>{{ $crc->Course_code }}</td>
                        <td>{{ $crc->Credit }}</td>
                        <td>{{ $crc->Student_limit }}</td>
                        <td>{{ $crc->Hour }}</td>
                        <td>
                            @if($crc->Type==1)
                                Theory 
                            @else
                                Lab
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="ctype" class="form-label">Select Number of section</label>
                                <select name="type" class="form-group" id="ctype">
                                  <option value=""></option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                                <a href="{{ url ('/edit-course/'.$crc->id) }}" onclick="location.href = document.getElementById('ctype').value;">Go</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
