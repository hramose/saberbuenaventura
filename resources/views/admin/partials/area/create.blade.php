@extends('admin.dashboard.template.1-column')

@section('page_title', 'Crear Area')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.area.index') }}">Areas</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => 'admin.area.store', 'method'=> 'POST']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Nombre', []) !!}
			{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=> 'Matematica, Lectura critica, Ingles, Ciencias naturales']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('weighted_value', 'Valor ponderado', []) !!}
			{!! Form::text('weighted_value', null, ['class'=>'form-control', 'placeholder'=>'3']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('grade', 'Grado', []) !!}
			{!! Form::select('grade', ['10'=>'10°', '11'=>'11°'], null, ['class'=>'form-control','placeholder'=>' --selecciones una grado-- ']) !!}
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Registrar Area', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection