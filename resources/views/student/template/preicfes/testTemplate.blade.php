@extends('student.template.index')

@section('content')
	<div class="col-md-3 profile-nav">
		@include('student.template.home.sidebar')
	</div>
	<div class="col-md-9">
		@yield('panel_content')
	</div>
@endsection