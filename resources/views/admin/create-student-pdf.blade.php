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
        <h4>Student's Name = {{$stu->name}}</h4>
        <h4>Student's Email = {{$stu->email}}</h4>
        <h4>Student's Date of Birth = {{$stu->dob}}</h4>
        <h4>Student's Address = {{$stu->address}}</h4>
        <br><br><br><br>
        <h4>Student's' Profile Picture = <img src="{{ public_path('thumbnail/'.$stu->img) }}" alt=""></h4>
        <div align="center">
        </div>
        
    </div>
</body>
</html>