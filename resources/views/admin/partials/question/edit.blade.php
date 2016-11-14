@extends('admin.dashboard.template.1-column')

@section('css')
	<link href="{{ asset('css/elements-forms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_title')
	{{ 'Editar pregunta'}}
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.question.index') }}">Preguntas</a></li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => ['admin.question.update', $question], 'method'=> 'PUT']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('area_id', 'Area', []) !!}
					{!! Form::select('area_id', $areas, $question->asignature->area_id, ['class'=>'form-control', 'placeholder'=>'-- Selecione un Area --']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('asignature_id', 'Asignatura', []) !!}
					{!! Form::select('asignature_id', $asignatures, $question->asignature->id, ['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('competence_id', 'Competencia', []) !!}
					{!! Form::select('competence_id', $competences, $question->asignature->area_id, ['class'=>'form-control']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('author_id', 'Referencia', []) !!}
					{!! Form::select('author_id', $authors, $question->author_id, ['class'=>'form-control', 'placeholder'=>'-- Selecione un author --']) !!}
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('description', 'Descripción', []) !!}
			{!! Form::textarea('description', $question->description, ['class'=>'form-control', 'id'=>'mytextarea']) !!}
		</div>
		<hr>
		<div class="form-group">
			{!! Form::label('option_type', 'Tipo de opcion', []) !!}
			{!! Form::select('option_type', ['text'=>'texto','image'=>'imagen'], $question->option_type, ['class'=>'form-control']) !!}
		</div>
		<div id="contentqo">
			<div id="subcontentqo">
				@foreach($question->options as $key => $value) 
					<div class="form-group content_option radio" id="question{{$key}}">
						{!! Form::label(null, 'Opcion '.($key+1), ['class'=>'label_option']) !!}
						{!! Form::text('option', $value->option, ['class'=>'form-control input_option', 'name'=>'option['.$value->id.'][]']) !!}
						@if($value->value)
							{!! Form::radio('option'.($key), $key, true, ['name'=>'value[]','id'=>'option'.$key]) !!}
						@else
						{!! Form::radio('option'.($key), $key, false, ['name'=>'value[]','id'=>'option'.$key]) !!}
						@endif
						{!! Form::label('option'.($key), 'Verdadero', ['class'=>'radio_label']) !!}
					</div>
				@endforeach
			</div>
		</div>
		<div class="form-group text-center" id="registerQ-btn">
			{!! Form::submit('Registrar Competencia', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection

@section('js')
	<script src="{{ asset('plugin/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('js/question.js') }}"></script>
@endsection