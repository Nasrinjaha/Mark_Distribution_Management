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
                    <h2 align="center">Results</h2>
                    <br>
                        <div class="row">

                            <div class="col 6">
                                <select name = "session"  class="form-control"  id="session">
                                <option value=" ">--Choose Course--</option>
                                    @foreach($crc as $s)
                                        <ul>
                                            <option value="{{$s->id}}">{{$s->Name}} ({{$s->section}}) </option>
                                        </ul>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
    $('#teacherassign').hide();

    $("#session").change(function(){
        var session_id = $(this).val();
        if(session_id!=" "){

            
                        $('#teacherassign').empty();
                        var table_str='';
                        var l;
                        $.ajax({
                        
                            url: 'http://127.0.0.1:8000/result-categoryy/'+session_id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response){
                                console.log(response.category);
                                var len = response.category.length;
                                l=len;
                                console.log(len);
                                if(len==0){
                                    
                                    alert('mark distrubution are not conducted');
                                }
                                // console.log(session_id,"  ",semester,"  ",tid);
                                else{
                                   
                                    table_str+='<tr><th>Student Name</th><th>Student ID</th>';
                                    for(var i=0;i<len;i++){
                                        table_str += '<th>'+response.category[i].category+' ('+response.category[i].marks+')</th>'
                                    }
                                    table_str+='<th>Total</th><th>Grade</th></tr>';
                                }
                               console.log(table_str);
                                // $("#teacherassign").html(table_str);
                                // $('#teacherassign').show();
                            }
                        });
                        $.ajax({     
                            url: 'http://127.0.0.1:8000/result-markk/'+session_id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response){
                                console.log(response.mark);
                                var len = response.mark.length;
                                var sum=0,grade;
                                var lgrade;
                                // console.log(len);
                                console.log("                       ",l);
                                for(var i=0;i<len;i++){
                                    if(i%l==0){
                                        sum=0;
                                        table_str += '<tr><td>'+response.mark[i].name+'</td><td>'+response.mark[i].st_id+'</td>'
                                        table_str += '<td>'+response.mark[i].marks+'</td>'
                                        sum+=(response.mark[i].marks);
                                    }
                                    else{
                                        table_str += '<td>'+response.mark[i].marks+'</td>'
                                        sum+=(response.mark[i].marks);
                                    }
                                    if(i%l==l-1){
                                        if(sum>=80){
                                            grade=4.00;
                                            lgrade='A+';
                                        }
                                        else if(sum>=75){
                                            grade=3.75;
                                            lgrade='A';
                                        }
                                        else if(sum>=70){
                                            grade=3.50;
                                            lgrade='A-';
                                        }
                                        else if(sum>=65){
                                            grade=3.25;
                                            lgrade='B+';
                                        }
                                        else if(sum>=60){
                                            grade=3.00;
                                            lgrade='B';
                                        }
                                        else if(sum>=55){
                                            grade=2.75;
                                            lgrade='B-';
                                        }
                                        else if(sum>=50){
                                            grade=2.50;
                                            lgrade='C+';
                                        }
                                        else if(sum>=45){
                                            grade=2.25;
                                            lgrade='C';
                                        }
                                        else if(sum>=40){
                                            grade=2.00;
                                            lgrade='D';
                                        }
                                        else{
                                            grade=0;
                                            lgrade='F';
                                        }
                                        console.log(sum);
                                        table_str+='<td>'+sum+'</td><td>'+lgrade+'</td></tr>'
                                    }
                                    
                                }
                                if(len==0){

                                }
                                else{
                                    $("#teacherassign").html(table_str);
                                    $('#teacherassign').show();
                                }
                               
                            }
                        });
                    }

                    else{
                        $('#teacherassign').hide();
                        $('#semster').hide();
                    }   
            });
            
});

</script> 
<script src="js/main.js"></script>