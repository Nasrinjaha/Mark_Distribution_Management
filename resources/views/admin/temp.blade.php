<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h3>Create Teacher</h3>
        <form action="">
            <div class="form-group">
                <label for="">Division</label>
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
        <button type="submit" name="submit" class="btn btn-primary">assign</button>
    </form>
    
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#course_table').hide();
            $("#session").change(function(){
                
                var session_id = $(this).val();
                //$("#district").empty();
                $.ajax({
                    url: 'http://127.0.0.1:8000/get-selected-course/'+session_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        $('#course_table').show();
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
            });
            $("#submitBtn").click(function(evt){
                evt.preventDefault();
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/store-teacher',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        teacher_division: $("#division").val(),
                        teacher_district: $("#district").val(),
                        teacher_name: $("#name").val()
                    },
                    success: function(response){
                        console.log(response.msg)
                    }
                });
            });
        });
    </script>
</body>
</html>