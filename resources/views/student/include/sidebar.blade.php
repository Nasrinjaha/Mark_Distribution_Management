<nav id="sidebar">
	<div class="p-4 pt-5">
	<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(thumbnail/{{Session::get('pp')}});"></a>

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
		<li>
			<a href="#">About</a>
		</li>
		<li>
			<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
			<ul class="collapse list-unstyled" id="pageSubmenu">
				<li>
					<a href="{{URL::to('enroll')}}">Enroll</a>
				</li>
				<li>
					<a href="#">Page 2</a>
				</li>
				<li>
					<a href="#">Page 3</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">Portfolio</a>
		</li>
		<li>
			<a href="#">Contact</a>
		</li>
	</ul>

	@include('admin.include.footer')

	</div>
</nav>