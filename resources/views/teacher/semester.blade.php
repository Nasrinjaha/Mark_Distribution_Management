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
                <div class="card">
                    <div class="card-header" align="center">
                        Create Section
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <h3>Create Semester</h3>
                            <form action="">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submitBtn" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#submitBtn").click(function(evt){
                evt.preventDefault();
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/store-semester',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        teacher_name: $("#name").val()
                    },
                    success: function(response){
                        console.log(response.msg)
                    }
                });
            });
        });
    </script>
</body>
</html>
<script src="js/main.js"></script>



                       