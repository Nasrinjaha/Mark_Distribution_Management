@extends('admin.layout.full')
@section('content')
<h2 align="center">Running Session's</h2>
<form  align="center" action="{{ url('/assign-course') }}" enctype="multipart/form-data" method="post">
    @csrf
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
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $crc)
                <tr>
                    <td><input type="checkbox" id="checkbox" name="check[]"></td>
                    <td>{{ $crc->Course_code }}</td>
                    <td>{{ $crc->Name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>  
        <button type="submit" name="submit" id="button" class="btn btn-primary">assign</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#course_table').hide();
            $('#button').hide();
            $("#session").change(function(){
                
                var session_id = $(this).val();
                if(session_id!=" "){

                
                    //$("#district").empty();
                    $.ajax({
                        url: 'http://127.0.0.1:8000/get-selected-course/'+session_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            $('#course_table').show();
                            $('#button').show();
                            //alert(response)
                        /* var districts = response.districts;
                            var len = districts.length;
                            str = ' <option value="">SELECT DISTRICT</option>';
                            for(var i=0; i<len; i++){
                                str += '<option value="'+districts[i].id+'">'+districts[i].name+'</option>'
                                
                            }
                            $("#district").append(str);*/
                        }
                    });
                }
            });
           
        });
    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script>
            /*$(document).ready(function(){
                //hide the table initially
                $('#course_table').hide()
                $('#session').change(function(){
                    /*$.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });*/
                    var session = $('#session').val();
                    if(session != " "){
                        
                        $.ajax({
                            url: 'http://127.0.0.1:8000/get-selected-course/',
                            type: 'POST',
                            dataType: 'json',
                            data: session,
                            success:function(data) {
                                // $("#msg").html(data.msg);
                                console.log(data);
                                $('#course_table').show()
                            }
                        })
                    }
                    else{
                        $('#course_table').hide()
                    }
                })
            })
        </script> -->
@stop