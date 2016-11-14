@extends('admin.dashboard.template.1-column')

@section('page_title')
	{{ 'Editar area - '.$area->name}}
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.area.index') }}">Areas</a></li>
	  <li class="active">{!! $area->name !!}</li>
	  <li class="active">Editar</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => ['admin.area.update', $area], 'method'=> 'PUT']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Nombre', []) !!}
			{!! Form::text('name', $area->name, ['class'=>'form-control', 'placeholder'=> 'Matematica, Lectura critica, Ingles, Ciencias naturales']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('weighted_value', 'Valor ponderado', []) !!}
			{!! Form::text('weighted_value', $area->weighted_value, ['class'=>'form-control', 'placeholder'=>'3']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('grade', 'Grado', []) !!}
			{!! Form::select('grade', ['10'=>'10°', '11'=>'11°'], $area->grade, ['class'=>'form-control']) !!}
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Actualizar Area', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection