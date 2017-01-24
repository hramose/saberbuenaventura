@extends('student.template.index')

@section('content')
	<div class="text-center cover-container">
		<a href="#">
			<img src="/img/avatar2.jpg">
		</a>
		<h1 class="profile-name">{{	Auth()->guard('students')->user()->name.' '.Auth()->guard('students')->user()->last_name}}</h1>
		<p class="user-text">{{	Auth()->guard('students')->user()->email 	}}</p>
	</div>
	<div class="">
		<div class="row">
			<div class="col-md-3 profile-nav sidebar_profile">
				@include('student.template.sidebar')
			</div>
			<div class="col-md-9">
				@yield('panel_content')
			</div>
		</div>
	</div>
@endsection