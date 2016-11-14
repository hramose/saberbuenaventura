@extends('admin.dashboard.template.1-column')

@section('page_title', 'Ver Asignaturas')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.asignature.create') }}">Crear Asignatura</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li class="active">Asignaturas</li>
	</ol>
@endsection

@section('row')
	@include('complements.flash')
	<table class="table table-striped table-hover">
		<thead>
			<th>Nombre</th>
			<th>Area</th>
			<th>Acción</th>
		</thead>
		<tbody>	
			@foreach($asignatures as $asignature)
				<tr>
					<td>{{ $asignature->name }}</td>
					<td>{{ $asignature->area->name }}</td>
					<td>
						<a class="btn btn-info" title="Editar" href="{{ route('admin.asignature.edit', $asignature->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger" title="Eliminar" href="{{ route('admin.asignature.destroy', $asignature->id) }}" onclick="return confirm('Desea eliminar esta asignatura')"><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection