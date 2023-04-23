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
                        <a class="btn btn-primary"  href="{{ url('export-teacher-excel') }}">Export excel file</a>
                    </form>
                </div>
                <div style=" margin-top: 50px">
                    <table id="example" class="table table-striped table-bordered " style="width:100%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Birth Date</th>
                                <th>Address</th>
                                <th>Profile Picture</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $techr)
                            <tr>
                                <td>{{ $techr->name }}</td>
                                <td>{{ $techr->email }}</td>
                                <td>{{ $techr->dob }}</td>
                                <td>{{ $techr->address }}</td>
                                <td>
                                    <img src="{{ asset('thumbnail/'.$techr->img)  }}" alt="">
                                </td>
                                <td>
                                    <a href="{{ url ('/edit-teacher/'.$techr->id) }}" class="btn btn-secondary">Edit</a>
                                    <a data-toggle="modal" data-target="#techr{{$techr->id}}" class="btn btn-danger">Delete</a>
                                    <div class="modal" id="techr{{$techr->id}}">
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
                                                <a href="{{ url('delete-teacher/'.$techr->id) }}" class="btn btn-success">Yes</a>
                                            </div>

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
<script src="js/main.js"></script>
