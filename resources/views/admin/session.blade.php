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
                <div class="row">
                    <div class="col 5">
                        <h2 align="center">Running Session's</h2>
                        <form  align="center" action="{{ url('/active-session') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <select name = "session"  class="form-control">
                            <option value="">--Choose Session--</option>
                                @foreach($ses as $s)
                                    @if($s->Status)
                                        <ul>
                                            <option value="{{$s->id}}">{{$s->Session_name}}</option>
                                        </ul>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                            <button type="submit" name="running" class="btn btn-primary">Deactivate</button>
                        </form>
                    </div>
                    <div class="col 5">
                        <h2 align="center">Deactivated Session's</h2>
                        <form  align="center" action="{{ url('/deactive-session') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <select name = "session"  class="form-control">
                            <option value="">--Choose Session--</option>
                                @foreach($ses as $s)
                                    @if($s->Status==0)
                                        <ul>
                                            <option value="{{$s->id}}">{{$s->Session_name}}</option>
                                        </ul>
                                    @endif
                                @endforeach
                            </select>
                            <br>
                            <button type="submit" name="Inactive" class="btn btn-primary">Activated</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <body>
</html>
<script src="js/main.js"></script>
