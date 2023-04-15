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
            <form  align="center" action="{{ url('/assign-course') }}" enctype="multipart/form-data" method="post">
    @csrf
    @if(Session::has('suc_msg'))
        <div align="center">
            <div class="alert alert-success">
                <strong>{{Session::get('suc_msg')}}</strong> 
            </div>
        </div>  
     @endif
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
    <br>
     
        <table id="course_table" class="table table-striped table-bordered " style="width:100%;">
            <thead>
                <tr>
                        <th>Student ID</th>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Semester</th>
                        <th>Section</th>
                        <th>Approve</th>
                </tr>
            </thead>
            <tbody>
               
                <tr>
                        <!-- <td>{{ $enroll->st_id }}</td>
                        <td>{{ $enroll->Name }}</td>
                        <td>{{ $enroll->Course_code }}</td>
                        <td>{{ $enroll->semester }}</td>
                        <td>{{ $enroll->section }}</td>  
                        <td>
                            <form method="POST" action="{{ url('apprve/'.$enroll->enroll_id) }}">
                                @csrf
                                <button type="submit">Approve</button>
                            </form>
                        </td>                -->
                </tr>
            </tbody>
        </table>  
        <button type="submit" name="submit" id="button" class="btn btn-primary">assign</button>
    </form>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#course_table').hide();
            $('#button').hide();
            $("#session").change(function(){
                
                var session_id = $(this).val();
                if(session_id!=" "){

                
                    //$("#course_table").empty();
                    $.ajax({
                        url: 'http://127.0.0.1:8000/available-course/'+session_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            console.log(response.users);
                            var len = response.users.length;
                            var html = '';
                            for(var i=0;i<len;i++){
                                html+='<tr>';
                                html+='<td><input type="checkbox" id="checkbox'+response.users[i].acid+'" name="check[]" value="'+response.users[i].acid+'"></td>';
                                html+='<td>'+response.users[i].Course_code+'</td>';
                                html+='<td>'+response.users[i].Name+' - '+response.users[i].section+'</td>';
                                html+='</tr>'
                                //console.log(response.users[i].section);
                            }
                            $('#crctble').append(html);
                            $('#course_table').show();
                            $('#button').show();

                            response.users.forEach(myFunction);

                            function myFunction(item) {
                                var course = "#checkbox"+item.course_id+"("+item.section+")";
                                //console.log(course);
                                $(course).attr('checked', 'checked');
                            }
                
                        }
                    });
                 }
                else{
                    $('#course_table').hide();
                    $('#button').hide();
                }
            });
           
        });
    </script>

