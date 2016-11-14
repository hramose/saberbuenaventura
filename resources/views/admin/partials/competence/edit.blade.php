@extends('admin.dashboard.template.1-column')

@section('page_title', 'Editar Competencia')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.competence.index') }}">Competencia</a></li>
	  <li class="active">{!! $competence->name !!}</li>
	  <li class="active">Editar</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => ['admin.competence.update', $competence], 'method'=> 'PUT']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Nombre', []) !!}
			{!! Form::text('name', $competence->name, ['class'=>'form-control', 'placeholder'=> 'nombre de la competencia']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('area_id', 'Area', []) !!}
			{!! Form::select('area_id', $areas, $competence->area_id, ['class'=>'form-control', 'placeholder'=>'-- Selecione un area --']) !!}
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Actualizar Competencia', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection