@extends('admin.dashboard.template.1-column')

@section('page_title', 'Crear Asignatura')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.asignature.index') }}">Asignaturas</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => 'admin.asignature.store', 'method'=> 'POST']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Nombre', []) !!}
			{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=> 'Geometria, Sociales, Biologia......']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('area_id', 'Area', []) !!}
			{!! Form::select('area_id', $areas, null, ['class'=>'form-control','placeholder'=>' --Seleccione una asignatura-- ']) !!}
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Registrar Asignatura', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection