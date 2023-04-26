<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 align="center">Course Details</h1><br>
        <h6>Course Name = {{$course->Name}}</h6>
        <h6>Course Code = {{$course->Course_code}}</h6>
        <h6>Semester = {{$course->Semester}}</h6>
        <h6>Course Credit = {{$course->Credit}}</h6>
        <h6>Student limit = {{$course->Student_limit}}</h6>
        <h6>Course Hour = {{$course->Hour}}</h6>
        @if($course->Type==1)
            <h6>Course Type = Theory</h6>
        @else
            <h6>Course Type = LAB</h6>
        @endif
    </div>
</body>
</html>