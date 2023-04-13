@extends('admin.layout.full')
@section('content')
<h2 align="center">Running Session's</h2>
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
    <select name = "course"  class="form-control"  id="course">
        <option value="">--Choose Course--</option>
    </select>
 
   <br>
     
   <table id="course_data_table" class="table table-striped table-bordered" style="width:100%;">
    <thead>
        <tr>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Section</th>
            <th>Assign Teacher</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    </table>
 
    <button type="submit" name="submit" id="button" class="btn btn-primary">assign</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#course_data_table').hide();
        $('#button').hide();
        $("#session").change(function(){
            
            var session_id = $(this).val();
            if(session_id!=" "){
                //$("#district").empty();
                $.ajax({
                    url: 'http://127.0.0.1:8000/get-assign-course/'+session_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        console.log(response.users);

                        var len = response.users.length;
                        str = '';
                        for(var i=0; i<len; i++){
                            str += '<option value="'+response.users[i].id+'">'+response.users[i].Name+'</option>'
                        }
                        $("#course").append(str);
                        //alert(response)
                    }
                });
            }
            else{
                $('#course_table').hide();
                $('#button').hide();
            }
        });

        $(document).ready(function(){
        $("#course").change(function(){
        var id = $(this).val();
        if(id!=""){
            $.ajax({
                url: 'http://127.0.0.1:8000/get-course-data/'+id,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    var len = response.length;
                    var table_str = '';
                    for(var i=0; i<len; i++){
                        table_str += '<tr><td>'+response[i].id+'</td><td>'+response[i].id+'</td><td>'+response[i].Credit+'</td></tr>'
                    }
                    $("#course_data_table tbody").html(table_str);
                    $('#course_data_table').show();
                    $('#button').show();
                }
            });
        }
        else{
            $('#course_data_table').hide();
            $('#button').hide();
        }
    });
        
    });
});
</script> 
@stop