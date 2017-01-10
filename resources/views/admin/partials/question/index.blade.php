@extends('admin.dashboard.template.1-column')

@section('page_title', 'Ver Preguntas')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.question.create') }}">Crear Pregunta</a>
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/question.css') }}">
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li class="active">Preguntas</li>
	</ol>
@endsection
@section('row')
	@include('complements.flash')
		@foreach($questions as $question)
			<div class="question">
				<div class="row">
					<div class="col-md-8">
						<h4>Descripción</h4>
						<div class="question_description">
							{!! $question->description !!}
						</div>
					</div>
					<div class="col-md-4">
						<h4>Opciones</h4>
						<table class="table">
							<thead>
								<tr>
									<th>Opción</th>
									<th>Valor</th>
								</tr>
							</thead>
							<tbody>
								@foreach($question->options as $option)
									<tr>
										<td>
										@if($option->option_type == 'image')
											<img src="{{asset('img/options/'.$option->option)}}" width="20%">
										@else	
											{!! $option->option !!}</td>
										@endif
										<td>
											@if($option->value)
												<span class="label label-success">Verdadero</span>
											@else
												<span class="label label-danger">Falso</span>
											@endif
										</td>
									</tr>
					            @endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="row question_footer">
					<div class="col-md-2">
						<span class="label label-success">{!! $question->asignature->area->name !!}</span>
					</div>
					<div class="col-md-6">
						<label>Competencia: </label> <small class="description">{!! $question->competence->name !!}</small>
					</div>
					<div class="col-md-4">
						<div class="article_action">
							<a class="btn btn-xs btn-default" role="button" href="{{ route('admin.question.edit', $question->id) }}">
								<i class="fa fa-edit"></i>
								Editar
							</a>
							<a class="btn btn-xs btn-default" role="button" href="{{ route('admin.question.destroy', $question->id) }}" onclick="return confirm('Desea eliminar esta pregunta')">
								<i class="fa fa-trash"></i>
								Eliminar
							</a>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		{!! $questions->render() !!}
@endsection