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
                    <h2 align="center">Course's Assign</h2>
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
                                        <th>Select</th>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($courses as $crc)
                                    <tr>
                                        <td><input type="checkbox" id="checkbox{{$crc->id}}" name="check[]" value="{{$crc->id}}"></td>
                                        <td>{{ $crc->Course_code }}</td>
                                        <td>{{ $crc->Name }}</td>
                                        <td><input type="number" name="s[{{$crc->id}}]" id="section{{$crc->id}}"></td>                  
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>  
                            <button type="submit" name="submit" id="button" class="btn btn-primary">assign</button>
                        </form>
                    </div>
                </div>
            </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#course_table').hide();
            $('#button').hide();
            $("#session").change(function(){
                
                var session_id = $(this).val();
                //$('#course_table').remove();

                if(session_id!=" "){
                    //$('#course_table').reload()
                    //$('#course_table').empty();
                    //$("#district").empty();
                    $.ajax({
                        url: 'http://127.0.0.1:8000/get-selected-course/'+session_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            $('#course_table').show();
                            $('#button').show();
                            console.log(response.users);
                            var len = response.users.length;
                            var len2 = response.allcourses.length;
                            for(var i=0; i<len2; i++){
                               
                                var course = "#checkbox"+ response.allcourses[i].id;
                                $(course).prop('checked',false);
                                var section = "#section"+response.allcourses[i].id;
                                $(section).val(" ");

                            }
                            
                            for(var i=0; i<len; i++){
                                var course = "#checkbox"+ response.users[i].course_id;
                                $(course).prop('checked',true);
                                var section = "#section"+response.users[i].course_id;
                                $(section).val(response.users[i].total);

                            }
                            /*response.users.forEach(myFunction);

                            function myFunction(item) {
                                var course = "#checkbox"+item.course_id+"("+item.section+")";
                                //console.log(course);
                                $(course).attr('checked', 'checked');
                            }*/
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
    </body>
 </html>
 <script src="js/main.js"></script>
