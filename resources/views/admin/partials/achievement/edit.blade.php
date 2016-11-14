@extends('admin.dashboard.template.1-column')

@section('page_title', 'Editar logro')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.achievement.index') }}">Logros</a></li>
	  <li class="active">{{ $achievement->name }}</li>
	  <li class="active">Editar</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => ['admin.achievement.update', $achievement], 'method'=> 'PUT']) !!}
		<div class="form-group">
			{!! Form::label('area_id', 'Area', []) !!}
			{!! Form::select('area_id', $areas, $achievement->competence->area_id, ['class'=>'form-control', 'placeholder'=>'-- Selecione un area --']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('competence_id', 'Competencia', []) !!}
			{!! Form::select('competence_id', $competences, $achievement->competence_id, ['class'=>'form-control']) !!}
		</div>
		<hr>
		<div id="achievements">
			<div class="form-group">
				{!! Form::label('name', 'Nombre', []) !!}
				{!! Form::text('name', $achievement->name, ['class'=>'form-control', 'placeholder'=> 'nombre del logro', 'id'=>'name_1']) !!}
			</div>
		</div>
		
		<div class="form-group text-center">
			{!! Form::submit('Actualizar Logro', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection

@section('js')
	<script src="{{ asset('js/achievement.js') }}"></script>
@endsection
