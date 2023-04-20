@extends('teacher.layout.full')
@section('content')
<h2 align="center">Mark Distribution</h2>
<form  align="center" action="{{ url('/store-student-marks') }}" enctype="multipart/form-data" method="post">
    @csrf
    @if(Session::has('suc_msg'))
        <div align="center">
            <div class="alert alert-success">
                <strong>{{Session::get('suc_msg')}}</strong> 
            </div>
        </div>  
     @endif
     @if(Session::has('err_msg'))
        <div align="center">
            <div class="alert alert-danger">
                <strong>{{Session::get('err_msg')}}</strong> 
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

        </tr>
    </thead>
     <tbody id="dynamic">
              

        
    </tbody>
    </table>
 
    <button type="submit" name="submit" id="button" class="btn btn-primary">assign</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $('#teacherassign').hide();
            $('#button').hide();
            $("#session").change(function(){
                var session_id = $(this).val();
                if(session_id!=" "){

                    $("#course").empty();
                    $('#teacherassign').empty();
                    $('#teacherassign').hide();
                    $('#button').hide();
                   
                    //console.log(session_id);
                    $.ajax({
                        url: 'http://127.0.0.1:8000/get-teacherassign-course/'+session_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            //console.log(response.users);
                            var len = response.users.length;
                            str = '<option value="">--Choose Course--</option>';
                            for(var i=0; i<len; i++){
                                str += '<option value="'+response.users[i].acid+'">'+response.users[i].Name+' - '+response.users[i].section+'</option>'
                            }
                            $("#course").append(str);
                            //str = '';
                            //response = null;
                            //alert(response)
                        }
                    });

                    $("#course").change(function(){
                        var id = $(this).val();

                        if(id!=" "){
                            $('#teacherassign').empty();
                            $.ajax({
                                url: 'http://127.0.0.1:8000/student-marks-assign/'+id,
                                type: 'GET',
                                dataType: 'json',
                                success: function(response){
                                    //console.log(response.users);
                                    var len = response.users.length;
                                    //console.log(len);
                                    var len2 = response.category.length;
                                    console.log(response.category);
                                    if(len2>0){
                                        $('#teacherassign').empty();
                                        str = '<th>Student ID</th><th>Name</th>';
                                        for(var i=0; i<len2; i++){
                                            str += '<th>'+response.category[i].category +'('+response.category[i].marks+')</th>';
                                        }
                                        str += '<th>Total(100)</th>';


                                        $('#teacherassign').append(str);
                                        html = '';
                                        for(var i=0; i<len; i++){
                                            html+='<tr>';
                                            html+= '<td>'+response.users[i].st_id +'</td>';
                                            html+='<td>'+response.users[i].name +'</td>';
                                            var tmark=0;
                                            var not = 0;
                                            for(var j=0; j<len2; j++){
                                               
                                                var marks='';
                                                $.ajax({
                                                    url: 'http://127.0.0.1:8000/get-student-marks-assign/'+response.users[i].st_id+'/'+response.category[j].id+'/'+id,
                                                    type: 'GET',
                                                    async: false,
                                                    dataType: 'json',
                                                    success: function(std_response){
                                                        //console.log(std_response.assignmarks); 
                                                        
                                                        marks=std_response.assignmarks;
                                                        if(marks!=" "){
                                                            tmark+=marks;
                                                        }
                                                        else{
                                                            not+=1;
                                                        }
                                                        
                                                        
                                                    }
                                                });
                                                //alert(marks);
                                                html+='<td><input type="number" id='+ response.users[i].st_id+'/'+response.category[j].marks+'/'+i+'/'+j+' name="'+response.category[j].category+'[]" value="'+marks+'"> / '+response.category[j].marks+'</td>';

                                                
                                            }
                                            console.log(not);
                                            if(not==len2){
                                                html+='<td>not assigned yet</td>';
                                            }
                                            else{
                                                html+='<td>'+tmark+' / 100</td>';
                                            }
                                            html+='<td><input type="hidden" name="student[]" value='+ response.users[i].st_id +'></td>';
                                            html+='</tr>';
                                        }
                                        $('#teacherassign').append(html);
                                        $('#teacherassign').show();
                                        //$('#dynamic').show();
                                        $('#button').show();  
                                    }
                                    else{
                                       
                                        $('#teacherassign').hide();
                                        $('#button').hide();
                                        alert('mark distribution are not conducted');
                                    }
                                    
                                }
                            });
                        }
                        else{
                            $('#teacherassign').hide();
                            $('#button').hide();
 
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