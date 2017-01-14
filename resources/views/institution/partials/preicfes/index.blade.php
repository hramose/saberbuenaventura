@extends('institution.dashboard.1-colum')

@section('page_title', 'Ver preicfes')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('institution.preicfes.create') }}">Crear pre-ICFES</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('institution.main') }}">Inicio</a></li>
	  <li class="active">pre-ICFES</li>
	</ol>
@endsection

@section('row')
	@include('complements.flash')

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>name</th>
				<th>estado</th>
				<th>Fecha</th>
				<th>Grado</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($preicfess as $preicfes)
				<?php 
				
					$start_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $preicfes->start_date);
					Carbon\Carbon::setToStringFormat('d-n-Y ');

					$date = new App\Date();
					$date->setDate($start_date);
				?>
				<tr>
					<td>{!! $preicfes->name !!}</td>
					<td>{!! $preicfes->state !!}</td>
					<td>{!! $date->getFullDate() !!}</td>
					<td>{!! $preicfes->class_room->name!!}</td>
					<td>
						<a class="btn btn-info" title="Editar" href="{{ route('institution.preicfes.edit', $preicfes->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-default" title="Ver" href="{{ route('institution.preicfes.description', $preicfes->id) }}"><i class="fa fa-eye"></i>
						</a>
						@if(count($preicfes->students()->get()) == 0)
						<a class="btn btn-danger" title="Eliminar" href="{{ route('institution.preicfes.destroy', $preicfes->id) }}" onclick="return confirm('Desea eliminar este pre-ICFES')"><i class="fa fa-trash"></i>
						</a>
						@endif

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection