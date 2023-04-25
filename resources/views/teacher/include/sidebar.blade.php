<nav id="sidebar">
	<div class="p-4 pt-5">
	<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(thumbnail/{{Session::get('pp')}});"></a>

	<ul class="list-unstyled components mb-5">
		<li class="active">
			<a href="#infoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">My Profile</a>
			<ul class="collapse list-unstyled" id="infoSubmenu">
				<li>
					<a href="{{URL::to('edit-teacher-info')}}">Edit Information</a>
				</li>
				<li>
					<a href="{{URL::to('edit-teacher-password')}}">Edit Password</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="{{URL::to('teacher-current-course')}}">Running Course's</a>
		</li>
		<li>
			<a href="{{URL::to('teacher-previous-courses')}}">Complete Course's</a>
		</li>
		<li>
			<a href="{{URL::to('get-students')}}">Assign Marks</a>
		</li>
		<!-- <li>
			<a href="#">Contact</a>
		</li> -->
	</ul>
<br><br><br><br><br><br><br><br><br>
	@include('teacher.include.footer')

	</div>
</nav>