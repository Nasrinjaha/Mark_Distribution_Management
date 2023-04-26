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
                <div>
                    <h2 align="center">My conducted Course's</h2>
                    <br>
                        <div class="row">

                            <div class="col 6">
                                <select name = "session"  class="form-control"  id="session">
                                <option value=" ">--Choose Session--</option>
                                    @foreach($session as $s)
                                        <ul>
                                            <option value="{{$s->session_id}}">{{$s->Session_name}}</option>
                                        </ul>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col 6">
                                <select name="semester" class="form-control" id="semester">
                                <option value="">--choose Semester--</option>
                                @foreach($semester as $sem)
                                    <option value="{{$sem->id}}">{{$sem->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <br>
                        </div>
                        <br>
                       
                            
                        <table id="teacherassign" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Session</th>
                                    <th>Course Name</th>
                                    <th>Course Code</th>
                                    <th>Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>  

                                </tr> 
                            </tbody>
                        </table>
                </div>
            </div>  
        </div>     
    </body>
</html>
<script> var tid = {{ $tid }};</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
    $('#teacherassign').hide();
    $('#semester').hide();

    $("#session").change(function(){
        var session_id = $(this).val();
        if(session_id!=" "){
            $('#teacherassign').empty();
            $('#semester').show();
            $("#course").hide();

            $("#semester").change(function(){
                var semester = $(this).val();
                if(semester!=" "){
                    $('#teacherassign').empty();
                    $.ajax({
                       
                        url: 'http://127.0.0.1:8000/get-previous-course/'+session_id+semester+tid,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            console.log(response.sessions);
                            var len = response.sessions.length;
                            var table_str = '<tr><th>Session</th><th>Course Name</th><th>Course Code</th><th>Section</th><th>Action</th></tr>';
                            //console.log(session_id,"  ",semester,"  ",tid);
                            for(var i=0;i<len;i++){
                                table_str += '<tr><td>'+response.sessions[i].Session_name+'</td><td>'+response.sessions[i].Name+'</td><td>'+response.sessions[i].Course_code+'</td><td>'+response.sessions[i].section+'</td><td><a href="#" class="btn btn-primary">View Details</a></td></tr>'
                            }
                            $("#teacherassign").html(table_str);
                            $('#teacherassign').show();
                        }
                    });
                }
                else{
                    $('#teacherassign').hide();
                    $('#button').hide();
                    alert('select a semester!');
                }
            });
        }
        else{
            $('#teacherassign').hide();
            $('#button').hide();
        }
    });     
});

</script> 
<script src="js/main.js"></script>
