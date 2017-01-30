@extends('admin.dashboard.template.1-column')

@section('page_title')
	{{ 'Editar Institución | '. $institution->name }}
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.institution.index') }}">Instituciones</a></li>
	  <li class="active">{!! $institution->name !!}</li>
	  <li class="active">Editar contraseña</li>
	</ol>
@endsection

@section('row')
	<div class="div_center70">
		@include('complements.errors')
		{!! Form::open(['route' => ['admin.institution.updatePass', $institution], 'method'=> 'POST']) !!}
			{!! Form::hidden('request_rol', 'admin', []) !!}
			{!! Form::hidden('request_method', 'UpdatePassword', []) !!}
			<div class="form-group">
				{!! Form::label('password', 'Contraseña', []) !!}
				{!! Form::password('password', ['class'=> 'form-control', 'placeholder'=>'**************']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('password_confirmation', 'Repita la contraseña', []) !!}
				{!! Form::password('password_confirmation', ['class'=> 'form-control', 'placeholder'=>'**************']) !!}
			</div>
			<div class="form-group text-center">
			{!! Form::submit('Actualizar contraseña estudiante', ['class'=>'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div>
@endsection