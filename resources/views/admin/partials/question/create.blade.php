@extends('admin.dashboard.template.1-column')

@section('css')
	<link href="{{ asset('css/elements-forms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_title', 'Crear Pregunta')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.question.index') }}">Preguntas</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection
@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => 'admin.question.store', 'method'=> 'POST']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('area_id', 'Area', []) !!}
					{!! Form::select('area_id', $areas, null, ['class'=>'form-control', 'placeholder'=>'-- Selecione un Area --']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('asignature_id', 'Asignatura', []) !!}
					{!! Form::select('asignature_id', [], [null], ['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('competence_id', 'Competencia', []) !!}
					{!! Form::select('competence_id', [], null, ['class'=>'form-control']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('author_id', 'Referencia', []) !!}
					{!! Form::select('author_id', $authors, null, ['class'=>'form-control', 'placeholder'=>'-- Selecione un author --']) !!}
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('description', 'Descripción', []) !!}
			{!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'mytextarea']) !!}
		</div>
		<hr>
		<div class="form-group">
			{!! Form::label('option_type', 'Tipo de opcion', []) !!}
			{!! Form::select('option_type', ['text'=>'texto','image'=>'imagen'],null, ['class'=>'form-control', 'placeholder'=>'-- seleccione el tipo de opcion --']) !!}
		</div>
		<div id="contentqo"></div>
		<div class="form-group text-center" id="registerQ-btn">
			{!! Form::submit('Registrar Competencia', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection

@section('js')
	<script src="{{ asset('plugin/tinymce/tinymce.min.js') }}"></script>
	{{-- <script src="{{ asset('plugin/bootstrap-toggle/js/bootstrap-toggle.js') }}"></script> --}}
	<script src="{{ asset('js/question.js') }}"></script>
@endsection