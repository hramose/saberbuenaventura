@extends('admin.dashboard.template.1-column')

@section('page_title', 'Ver Niveles de desempeño')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.performance.create') }}">Crear Nivel de desempeño</a>
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/question.css') }}">
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li class="active">Niveles de desempeño</li>
	</ol>
@endsection
@section('row')
	@include('complements.flash')
		@foreach($performances as $performance)
			<div class="question">
				<div class="row">
					<div class="col-md-8">
						<h4>Descripción</h4>
						<div class="question_description">
							{!! $performance->description !!}
						</div>
					</div>
					<div class="col-md-4">
						<table class="table">
							<thead>
								<tr>
									<th>Puntaje min</th>
									<th>Puntaje max</th>
									<th>Nivel de des.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{!! $performance->min_score!!}</td>
									<td>{!! $performance->max_score!!}</td>
									<td>{!! $performance->level !!}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row question_footer">
					<div class="col-md-8">
						<span class="label label-success">{!! $performance->area->name !!}</span>
					</div>
					<div class="col-md-4">
						<div class="article_action">
							<a class="btn btn-xs btn-default" role="button" href="{{ route('admin.performance.edit', $performance->id) }}">
								<i class="fa fa-edit"></i>
								Editar
							</a>
							<a class="btn btn-xs btn-default" role="button" href="{{ route('admin.performance.destroy', $performance->id) }}" onclick="return confirm('Desea eliminar este nivel de desempeño')">
								<i class="fa fa-trash"></i>
								Eliminar
							</a>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		{!! $performances->render() !!}
@endsection