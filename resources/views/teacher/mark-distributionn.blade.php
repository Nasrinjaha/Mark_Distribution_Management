<!DOCTYPE html>
<html lang="en">
<head>
    @include('teacher.include.header')
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
     @include('teacher.include.sidebar')
        <div id="content" class="p-4 p-md-5">
            @include('teacher.include.navbar')
            <div> 
                <h2 align="center">Mark Distribution</h2>
                <form  align="center" action="{{ url('/mark-distribution') }}" enctype="multipart/form-data" method="post" id="my-form">
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
                                <th>Category Name</th>
                                <th>Marks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic">  
                        </tbody>
                    </table>
                   <button type="submit" name="submit" id="button" class="btn btn-primary">Assign</button>
                </form>
                </div>
            </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
        var n=1;
        var sum=0;
        $(document).ready(function(){
            
            $('#my-form').on('input',function(){
                sum=0;
                for(var x=0;x<n;x++){
                    var value=$('#marks'+x).val();
                    if(value){
                        console.log(value);
                        sum = sum+ parseInt(value);
                    }
                    
                }
                console.log('-----------------');
                console.log('sum = '+sum);
                if(sum==100){
                    $('#button').show();
                }
                else{
                    $('#button').hide();
                }

            });
           
            $(document).on('click','#add_btn',function(){
              
               
                    var html = '';
                    html+='<tr>';
                    html+='<td><input id="cat" type="text" name="category[]"></td>';
                    html+='<td><input id="marks'+ n +'" type="number" name="marks[]"></td>';
                    html+='<td><button class="btn btn-danger" id="rmv_btn"><i class="fa fa-minus"></i></button></td>';
                    html+='</tr>';
                    $('#dynamic').append(html);
                    n++;


            });
            $(document).on('click','#rmv_btn',function(){

                $(this).closest('tr').remove();
                sum=0;
                for(var x=0;x<n;x++){
                    var value=$('#marks'+x).val();
                    if(value){
                        console.log(value);
                        sum = sum+ parseInt(value);
                    }
                    
                }
                console.log('-----------------');
                console.log('sum = '+sum);
                
                //console.log(rmv);
               // console.log(this.sum);
               if(sum==100){
                    $('#button').show();
                }
                else{
                    $('#button').hide();
                }
                

            });
            $('#teacherassign').hide();
            $('#button').hide();
            $("#session").change(function(){
                var session_id = $(this).val();
                if(session_id!=" "){

                    $("#course").empty();
                    $("#dynamic").empty();
                    $('#teacherassign').hide();
                    $('#button').hide();
                   
                    //console.log(session_id);
                    $.ajax({
                        url: 'http://127.0.0.1:8000/get-teacherassign-course/'+session_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            console.log(response.users);
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
                            $("#dynamic").empty();
                            $.ajax({
                                url: 'http://127.0.0.1:8000/distributed-course/'+id,
                                type: 'GET',
                                dataType: 'json',
                                success: function(response){
                                    console.log(response.users);
                                    var len = response.users.length;
                                    if(len!=" "){
                                        $('#dynamic').empty();
                                        var html = '';
                                        for(var i=0; i<len; i++){

                                            if(i==0){
                                                html = '';
                                                html+='<tr>';
                                                html+='<td><input type="text" name="category[]" value="'+response.users[i].category+'"></td>';
                                                html+='<td><input type="number" name="marks[]" id="marks0" value="'+response.users[i].marks+'"></td>';
                                                sum+=response.users[i].marks;
                                                //console.log(sum);
                                                html+='<td><button type="button" class="btn btn-success" id="add_btn"><i class="fa fa-plus"></i></button></td>';
                                                html+='</tr>';
                                                $('#dynamic').append(html);
                                            }
                                            else{
                                              
                                                html = '';
                                                html+='<tr>';
                                                html+='<td><input type="text" name="category[]" value="'+response.users[i].category+'"></td>';
                                                html+='<td><input type="number" name="marks[]" id="marks'+i+'" value="'+response.users[i].marks+'"></td>';
                                                html+='<td><button class="btn btn-danger" id="rmv_btn"><i class="fa fa-minus"></i></button></td>';
                                                sum+=response.users[i].marks;
                                                //console.log(sum);
                                                html+='</tr>';
                                                $('#dynamic').append(html);
                                            }
                                            
                                        }
                                        n=len;
                                        
                                        $('#teacherassign').show();
                                        //$('#button').show();
                                      
                                    }
                                    else{
                                        $('#dynamic').empty();
                                        var html = '';
                                        html+='<tr>';
                                        html+='<td><input type="text" name="category[]"></td>';
                                        html+='<td><input type="number" name="marks[]" id="marks0"></td>';
                                        html+='<td><button type="button" class="btn btn-success" id="add_btn"><i class="fa fa-plus"></i></button></td>';
                                        html+='</tr>';
                                        $('#dynamic').append(html);
                                        $('#teacherassign').show();
                                        //$('#button').show();
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
<script src="js/main.js"></script> 
