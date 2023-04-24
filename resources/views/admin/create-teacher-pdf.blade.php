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
        <h1 align="center">Teacher Details</h1><br>
        <h5 align="center">Teacher's' Profile Picture </h5> <br>
        <div align="center">
            <img src="{{ public_path('thumbnail/'.$tec->img) }}"  alt="">
        </div>
        <br><br>
        <h5>Teacher's Name = {{$tec->name}}</h5>
        <h5>Teacher's Email = {{$tec->email}}</h5>
        <h5>Teacher's Date of Birth = {{$tec->dob}}</h5>
        <h5>Teacher's Address = {{$tec->address}}</h5>
        
    </div>
</body>
</html>