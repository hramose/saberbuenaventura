<div class="panel panelBox">
	<div class="user-heading round">
		<a href="#">
			<img src="/img/avatar2.jpg">
		</a>
		<h1>{{ Auth()->guard('students')->user()->name.' '. Auth()->guard('students')->user()->last_name}}</h1>
		<p>{{ Auth()->guard('students')->user()->email }}</p>
	</div>
	<ul class="nav nav-pills nav-stacked">
		<li>
			<a href="{{ route('student.main') }}">
				<i class="fa fa-home"></i>
				Inicio
			</a>
		</li>
		<li>
			<a href="{{ route('student.profile') }}">
				<i class="fa fa-user"></i>
				Perfil
			</a>
		</li>
		<li>
			<a href="{{ route('student.about') }}">
				<i class="fa fa-info-circle"></i>
				Acerca
			</a>
		</li>
		<li>
			<a href="{{ route('student.take_preicfes') }}">
				<i class="fa fa-calendar-check-o"></i>
				Realizar pre-ICFES
			</a>
		</li>
		<li>
			<a href="{{ route('student.preicfesAll') }}">
				<i class="fa fa-book"></i>
				pre-ICFES
			</a>
		</li>
	</ul>
</div>