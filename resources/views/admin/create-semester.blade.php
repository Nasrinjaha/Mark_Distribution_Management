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
            <div class="card">
                <div class="card-header" align="center">
                    Create Semester
                </div>
                <div class="card-body">
                        <button type="" class="btn btn-primary" id="submit"> Current semester's </button>

                        <form  align="center" action="{{ url('/store-semester') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <br>
                            @if(Session::has('suc_msg'))
                            <div class="row 4 haha">
                                <div class="alert alert-success">
                                    <strong>{{Session::get('suc_msg')}}</strong> 
                                </div>
                            </div>  
                            @endif
                            <div class="form-group">
                                <label class="col-form-label-sm" for="">Semester Name   :</label>
                                <input type="text" name="semname" class="form-control-sm" required>
                            </div>
                            @if(Session::has('dup_msg'))
                            <div class="row 4 haha">
                                <div class="alert alert-warning ">
                                    <strong>{{Session::get('dup_msg')}}</strong> 
                                </div>
                            </div> 
                            @endif
                            <div class="form-group abc">
                                <button type="submit" class="btn btn-primary" id="submitonno">Save</button>
                            </div>
                        </form>
                        <table id="sem" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>
        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            fg = 1;
            $("#sem").hide();
            $("#submit").click(function(evt){
                evt.preventDefault();
                $("#sem").hide();
                $("#sem").empty();
                 
                $.ajax({
                    url: 'http://127.0.0.1:8000/get-semester',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        console.log(response.semesters);
                        var len = response.semesters.length;
                        var r =  Math.floor(len/4);
                        var k =0 ;
                        console.log(len%4);
                        html = ' ';
                        str = ' ';
                       console.log(r);


                        if(r>0){
                            for(var i=0;i<4;i++){
                                str+='<th>Name</th>';
                            }
                        }
                        else{
                            for(var j=0;j<(len%4);j++){
                                str+='<th>Name</th>';
                            }
                        }
                        $('#sem').append(str);
                        if(r>0){
                            for(var i=0;i<r;i++){
                                html+='<tr>';  
                                for(var j=0;j<4;j++){
                                    html+='<td>'+ response.semesters[k].name+'</td>';
                                    console.log(response.semesters[k].name);  
                                    k++;
                                }
                                html+='</tr>';
                                //$("#sem").append(html);

                            } 
                        }
                        if(len%4!=0){
                            html+='<tr>';   
                            for(var j=0;j<(len%4);j++){
                                html+='<td>'+ response.semesters[k].name+'</td>'; 
                                console.log(response.semesters[k].name);  
                                k++;
                            }
                            html+='</tr>';  
                        }
                        $("#sem").append(html); 
                        if(fg==1){
                            $("#sem").show();
                            fg=0;
                        }
                        else{
                            $("#sem").hide();
                            fg=1;
                        }
                        
                      
                 
                    }
                });
            });
        });
    </script>
<script src="js/main.js"></script>

