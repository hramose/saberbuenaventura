@extends('institution.dashboard.1-colum')

@section('page_title')
	{!! 'Cambiar contraseña Alumno | '.$student->name.' '.$student->last_name !!}
@endsection

@section('css')
	<link href="{{ asset('css/student.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/preicfes.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('institution.main') }}">Inicio</a></li>
	  <li><a href="{{ route('institution.student.index') }}">Alumnos</a></li>
	  <li><a href="{{ route('institution.student.show', [$student->id, 'institution']) }}">{!! $student->name.' '.$student->last_name !!}</a></li>
	  <li class="active">Cambiar contraseña</li>
	</ol>
@endsection

@section('row')
	<div class="div_center70">
		@include('complements.errors')
		{!! Form::open(['route' => ['institution.student.updatePass', $student], 'method'=> 'POST']) !!}
			{!! Form::hidden('request_rol', 'institution', []) !!}
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