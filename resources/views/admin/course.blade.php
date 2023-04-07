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
                <div>
                    <form method="post" action="{{ URL::to('store-excel') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row 3">
                            <div class="form-group">
                                <label class="visually-hidden">Excel</label>
                                <input type="file" class="form-control" id="email" placeholder="Enter excel file" name="file">
                                <br>
                                @error('excel_file')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Import excel fil</button>
                        <a class="btn btn-primary"  href="{{ url('export-excel') }}">Export excel file</a>
                    </form>
                </div>
                <div style=" margin-top: 50px">
                    <table id="example" class="table table-striped table-bordered " style="width:100%;">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Course Credit</th>
                                <th>Student Limit(Per Section)</th>
                                <th>Hour</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $crc)
                            <tr>
                                <td>{{ $crc->Name }}</td>
                                <td>{{ $crc->Course_code }}</td>
                                <td>{{ $crc->Credit }}</td>
                                <td>{{ $crc->Student_limit }}</td>
                                <td>{{ $crc->Hour }}</td>
                                <td>
                                    @if($crc->Type==1)
                                        Theory 
                                    @else
                                        Lab
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url ('/edit-course/'.$crc->id) }}" class="btn btn-secondary">Edit</a>
                                    <a data-toggle="modal" data-target="#crc{{$crc->id}}" class="btn btn-danger">Delete</a>
                                    <div class="modal" id="crc{{$crc->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
            
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Confirmation</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
            
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                Are you sure you want to delete?
                                            </div>
            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                <a href="{{ url('delete-crc/'.$crc->id) }}" class="btn btn-success">Yes</a>
                                            </div>
        
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
