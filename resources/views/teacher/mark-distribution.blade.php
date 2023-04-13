@extends('teacher.layout.full')
@section('content')
<h2 align="center">Mark Distribution</h2>
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
     
   <table id="teacherassign" class="table table-striped table-bordered" style="width:100%;">
    <thead>
        <tr>
            <th>Category Name</th>
            <th>Marks</th>
            <th>Add</th>
        </tr>
    </thead>
     <tbody>
        <tr>
            <td>Report</td>
            <td>20</td>
            <td><button class="btn btn-primary"><i class="fa fa-plus"></i> Add</button></td>
        </tr>
        
    </tbody>
    </table>
 
    <button type="submit" name="submit" id="button" class="btn btn-primary">assign</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        // $('#teacherassign').hide();
        // $('#button').hide();
        $("#session").change(function(){
            
            var session_id = $(this).val();
            if(session_id!=" "){
                //$("#district").empty();
                console.log(session_id);
                $.ajax({
                    url: 'http://127.0.0.1:8000/get-teacherassign-course/'+session_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        console.log(response.users);

                        var len = response.users.length;
                        str = '';
                        // for(var i=0; i<len; i++){
                        //     str += '<option value="'+response.users[i].id+'">'+response.users[i].Name+'</option>'
                        // }
                        // $("#course").append(str);
                        //alert(response)
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
@stop