@extends('admin.dashboard.template.1-column')

@section('page_title', 'Ver Areas')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.area.create') }}">Crear Area</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li class="active">Areas</li>
	</ol>
@endsection

@section('row')
	@include('complements.flash')
	<table class="table table-striped table-hover">
		<thead>
			<th>Nombre</th>
			<th>Valor ponderado</th>
			<th>Grado</th>
			<th>Acción</th>
		</thead>
		<tbody>	
			@foreach($areas as $area)
				<tr>
					<td>{{ $area->name }}</td>
					<td>{{ $area->weighted_value }}</td>
					<td>{{ $area->grade.'°' }}</td>
					<td>
						<a class="btn btn-info" title="Editar" href="{{ route('admin.area.edit', $area->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger" title="Eliminar" href="{{ route('admin.area.destroy', $area->id) }}" onclick="return confirm('Desea eliminar esta area')"><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection