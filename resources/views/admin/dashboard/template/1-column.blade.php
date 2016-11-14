@extends('admin.dashboard.template.index')

@section('content')

<section class="col-md-12 panelBox">
	<header class="clearfix">
		<h2 class="page_title pull-left">@yield('page_title')</h2>
		@yield('btn-create')
	</header>
	<div class="content-inner">
		@yield('row')
	</div>
</section>

@endsection