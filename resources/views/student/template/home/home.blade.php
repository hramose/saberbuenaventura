@extends('student.template.index')

@section('content')
	<div class="col-md-3 profile-nav">
		@include('student.template.home.sidebar')
	</div>
	<div class="col-md-7 panelBox panelActivity">
		<header class="clearfix">
			<h2 class="page_title pull-left">Actividad reciente</h2>
		</header>

		<div class="row">
			<ul>
				<li><a href="">actividad 1</a></li>
				<li><a href="">actividad 1</a></li>
				<li><a href="">actividad 1</a></li>
			</ul>
		</div>
	</div>
	<div class="col-md-2">
		
	</div>
@endsection