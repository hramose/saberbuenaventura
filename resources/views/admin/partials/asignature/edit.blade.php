@extends('admin.dashboard.template.1-column')

@section('page_title')
	{{ 'Editar asignatura | '.$asignature->name}}
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.asignature.index') }}">Asignaturas</a></li>
	  <li class="active">{!! $asignature->name !!}</li>
	  <li class="active">Editar</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => ['admin.asignature.update', $asignature], 'method'=> 'PUT']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Nombre', []) !!}
			{!! Form::text('name', $asignature->name, ['class'=>'form-control', 'placeholder'=> 'Geometria, Sociales, Biologia......']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('area_id', 'Area', []) !!}
			{!! Form::select('area_id', $areas, $asignature->area_id, ['class'=>'form-control']) !!}
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Actualizar Asignatura', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection