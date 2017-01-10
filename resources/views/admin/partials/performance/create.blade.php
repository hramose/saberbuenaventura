@extends('admin.dashboard.template.1-column')

@section('css')
	<link href="{{ asset('css/elements-forms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_title', 'Crear Nivel de desempeño')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.performance.index') }}">Niveles de desempeño</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection
@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => 'admin.performance.store', 'method'=> 'POST']) !!}		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('grade', 'Geado', ['class'=>'control-label']) !!}
					{!! Form::select('grade', [10=>"10°",11=>"11°"], null, ['class'=>'form-control', 'placeholder'=>'Seleccione un grado']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('area_id', 'Area', ['class'=>'control-label']) !!}
					{!! Form::select('area_id', [], null, ['class'=>'form-control', 'placeholder'=>'Seleccione un area']) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('min_score', 'Puntaje minimo', []) !!}
					{!! Form::text('min_score', null, ['class'=>'form-control']) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('max_score', 'Puntaje maximo', []) !!}
					{!! Form::text('max_score', null, ['class'=>'form-control']) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('level', 'Desempeño', []) !!}
					{!! Form::text('level', null, ['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('description', 'Descripción', []) !!}
					{!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'mytextarea']) !!}
				</div>
			</div>
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Registrar Nivel de desempeño', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection

@section('js')
	<script src="{{ asset('plugin/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('js/performance.js') }}"></script>
@endsection