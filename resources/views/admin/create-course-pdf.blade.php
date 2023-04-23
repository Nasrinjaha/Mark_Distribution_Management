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
        <h4>Course Name = {{$course->Name}}</h4>
        <h4>Course Code = {{$course->Course_code}}</h4>
        <h4>Semester = {{$course->Semester}}</h4>
        <h4>Course Credit = {{$course->Credit}}</h4>
        <h4>Student limit = {{$course->Student_limit}}</h4>
        <h4>Course Hour = {{$course->Hour}}</h4>
        @if($course->Type==1)
            <h4>Course Type = Theory</h4>
        @else
            <h4>Course Type = LAB</h4>
        @endif
    </div>
</body>
</html>