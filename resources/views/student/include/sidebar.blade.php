<nav id="sidebar">
	<div class="p-4 pt-5">
	<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(thumbnail/{{Session::get('pp')}});"></a>

	<ul class="list-unstyled components mb-5">
		<li class="active">
			<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Profile</a>
			<ul class="collapse list-unstyled" id="homeSubmenu">
				<li>
					<a href="{{URL::to('edit-student-profile-info')}}">Update profile info</a>
				</li>
				<li>
					<a href="{{URL::to('edit-student-password')}}">Update Password</a>
				</li>
				<li>
					<a href="{{URL::to('edit-student-image')}}">update Profile Image</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="{{URL::to('enroll')}}">Result</a>
		</li>

		<li>
			<a href="{{URL::to('enroll')}}">Enrollment</a>
		</li>
		
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	@include('admin.include.footer')

	</div>
</nav>