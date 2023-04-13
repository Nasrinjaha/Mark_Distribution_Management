<!doctype html>
<html lang="en">
  <head>
      @include('teacher.include.header')
  </head>
  <body>
		
<div class="wrapper d-flex align-items-stretch">
    @include('teacher.include.sidebar')
    <div id="content" class="p-4 p-md-5">
        @include('teacher.include.navbar')
        @yield('content') 
        @yield('extra')
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>