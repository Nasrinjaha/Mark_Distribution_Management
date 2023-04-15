<nav id="sidebar">
	<div class="p-4 pt-5"> 
	<img src="{{ public_path('thumbnail/'.Session::get('pp'))}}"  alt=""> 
		
	<!-- <a href="#" class="img logo rounded-circle mb-5" style="background-image: {{ public_path('thumbnail/'.Session::get('pp'))}};" alt="admin"></a> -->

	<ul class="list-unstyled components mb-5">
		<li class="active">
			<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
			<ul class="collapse list-unstyled" id="homeSubmenu">
				<li>
					<a href="#">Home 1</a>
				</li>
				<li>
					<a href="#">Home 2</a>
				</li>
				<li>
					<a href="#">Home 3</a>
				</li>
			</ul>
		</li>
		<li class="active">
			<a href="#SessionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Manage</a>
			<ul class="collapse list-unstyled" id="SessionSubmenu">
				<li>
					<a href="{{URL::to('session')}}">Session</a>
				</li>
				<li>
					<a href="{{URL::to('get-course')}}">Course</a>
				</li>
				<li>
					<a href="{{URL::to('get-teacher')}}">Teacher</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Creation</a>
			<ul class="collapse list-unstyled" id="pageSubmenu">
				<li>
					<a href="{{URL::to('create-teacher')}}">Create Teacher</a>
				</li>
				<li>
					<a href="{{URL::to('create-student')}}">Create Student</a>
				</li>
				<li>
					<a href="{{URL::to('create-course')}}">Create Course</a>
				</li>
				<li>
					<a href="{{URL::to('start-session')}}">Create New Session</a>
				</li>
				<li>
					<a href="{{URL::to('create-section')}}">Create New Section</a>
				</li>
			</ul>
		</li>

		<li>
			<a href="#TableSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tables's</a>
			<ul class="collapse list-unstyled" id="TableSubmenu">
				<li>
					<a href="{{URL::to('all-teachers')}}">All Teacher</a>
				</li>
				<li>
					<a href="{{URL::to('all-students')}}">All Student</a>
				</li>
				<li>
					<a href="{{URL::to('all-course')}}">Available Course</a>
				</li>
			</ul>
		</li>

		<li>
			<a href="{{URL::to('enrollment')}}">Enrollment Request</a>
		</li>

		
		
		
	</ul>

	@include('admin.include.footer')

	</div>
</nav>