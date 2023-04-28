<nav id="sidebar">
	<div class="p-4 pt-5">
	<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(thumbnail/{{Session::get('pp')}});"></a>

	<ul class="list-unstyled components mb-5">
		<li class="active">
			<a href="#infoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">My Profile</a>
			<ul class="collapse list-unstyled" id="infoSubmenu">
				<li>
					<a href="{{URL::to('edit-teacher-info')}}">Update Profile Info</a>
				</li>
				<li>
					<a href="{{URL::to('edit-teacher-password')}}">Update Password</a>
				</li>
				<li>
					<a href="{{URL::to('edit-teacher-image')}}">Update Image</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="{{URL::to('teacher-current-course')}}">Running Course's</a>
		</li>
		<li>
			<a href="{{URL::to('teacher-previous-coursess')}}">Complete Course's</a>
		</li>
		<li>
			<a href="{{URL::to('get-students')}}">Assign Marks</a>
		</li>
		<li>
			<a href="{{URL::to('result')}}">Result Publish</a>
		</li>
	</ul>
<br><br><br><br><br><br><br><br><br><br><br><br>
	@include('teacher.include.footer')

	</div>
</nav>