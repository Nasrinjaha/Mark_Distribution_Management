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
                <div>
                    <h2 align="center">Teacher's Assign</h2>
                    <form  align="center" action="{{ url('/assign-teacher') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @if(Session::has('suc_msg'))
                            <div align="center">
                                <div class="alert alert-success">
                                    <strong>{{Session::get('suc_msg')}}</strong> 
                                </div>
                            </div>  
                        @endif
                        <div class="row">


                            <div class="col 4">
                                <select name = "session"  class="form-control"  id="session">
                                <option value=" ">--Choose Session--</option>
                                    @foreach($ses as $s)
                                        @if($s->Status)
                                            <ul>
                                                <option value="{{$s->id}}">{{$s->Session_name}}</option>
                                            </ul>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col 4">
                                <select name="semester" class="form-control" id="semester">
                                <option value="">--choose Semester--</option>
                                @foreach($semester as $sem)
                                    <option value="{{$sem->id}}">{{$sem->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="col 4">
                                <select name = "course"  class="form-control"  id="course">
                                    <!-- <option value="">--Choose Course--</option> -->
                                </select>
                                 <br>
                            </div>
                        </div>
                        
                       
                            
                        <table id="teacherassign" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Assign Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>     
                                </tr> 
                            </tbody>
                        </table>
                     <button type="submit" name="submit" id="button" class="btn btn-primary">Assign</button>
                    </form>
                </div>
            </div>  
        </div>     
    </body>
</html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#teacherassign').hide();
        $('#button').hide();
        $('#semester').hide();
        $('#course').hide();

        $("#session").change(function(){
            
            var session_id = $(this).val();
            if(session_id!=" "){
                $("#course").empty();
               
                $('#teacherassign').empty();
                $('#button').hide();
                $('#semester').show();
                $("#course").hide();

                $("#semester").change(function(){
                    var semester = $(this).val();
                    if(semester!=" "){
                       // $('#course').show();
                        $("#course").empty();
                        $('#teacherassign').empty();
                        $('#button').hide();

                        $.ajax({
                            url: 'http://127.0.0.1:8000/get-assign-course/'+session_id+semester,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response){
                                console.log(response.users);
                                $("#course").empty();
                                var len = response.users.length;
                                str = '<option value="">--Choose Course--</option>';
                                for(var i=0; i<len; i++){
                                    str += '<option value="'+response.users[i].id+'">'+response.users[i].Name+'</option>'
                                }
                                $("#course").append(str);
                                //alert(response)
                            }
                        });

                        $("#course").show();




                        $(document).ready(function(){
                        $("#course").change(function(){
                            var id = $(this).val();
                            
                            if(id!=""){
                                // $('#teacherassign').hide();
                                // $('#button').hide();
                                $.ajax({
                                    url: 'http://127.0.0.1:8000/get-section/'+id+session_id,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(response){
                                        //console.log(response);
                                        var len = response.section.length;
                                        var len2 = response.teachers.length;
                                        console.log(len);
                                        var table_str = '<tr><th>Section</th><th>Assign Teacher</th></tr>';
                                        for(var i=0; i<len; i++){
                                            var tid = response.section[i].teacher_id;
                                            table_str += '<td><input type="text" name="section[]" id="section'+i+'" value="'+response.section[i].section+'" required></td>'
                                            table_str += '<td><select name="teacher[]" id="teacher">'
                                            table_str +=  '<option value="">--choose Teacher--</option>'
                                            for(var j=0;j<len2;j++){
                                                if(response.teachers[j].id == tid){
                                                    table_str +=  '<option value="'+response.teachers[j].id+'" selected>'+ response.teachers[j].name+'</option>'
                                                }
                                                else {
                                                    table_str +=  '<option value="'+response.teachers[j].id+'" >'+ response.teachers[j].name+'</option>'
                                                }
                                            }
                                            
                                            table_str += '</select></tr>'
                                            
                                        }
                                        $("#teacherassign").html(table_str);
                                        $('#teacherassign').show();
                                        $('#button').show();
                                        
                                    }
                                });
                            }
                            else{
                                $('#teacherassign').hide();
                                $('#button').hide();
                            }

                        });
                            
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
