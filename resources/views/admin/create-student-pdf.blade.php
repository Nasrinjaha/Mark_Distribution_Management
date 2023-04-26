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
        <h1 align="center">Student Details</h1><br>
        <h5 align="center">Student's' Profile Picture </h5> <br>
        <div align="center">
            <img src="{{ public_path('thumbnail/'.$stu->img) }}"  alt="">
        </div>
        <br><br>
        <h5>Student's Name = {{$stu->name}}</h5>
        <h5>Student's Email = {{$stu->email}}</h5>
        <h5>Student's Date of Birth = {{$stu->dob}}</h5>
        <h5>Student's Address = {{$stu->address}}</h5>
        <br><br>
        </div>
        
    </div>
</body>
</html>