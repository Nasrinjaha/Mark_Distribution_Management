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
                <div style="margin-top: 50px">
                        <table id="example" class="table table-striped table-bordered " style="width:100%;">
                                <h3 align="center">Running Session</h3>
                        <thead>
                            <tr>
                                <th>Session Name</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ses as $s)
                                @if($s->Status==1)
                                        <tr>
                                            <td>{{ $s->Session_name }}</td>
                                            <td>{{ $s->Year }}</td>
                                            <td>Edit Option</td>
                                        </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="container mt-3" align="center">
                        <a href="{{ URL::to('start-session') }}" class="btn btn-success" >START NEW SESSION</a>
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
