@extends('admin.dashboard.template.1-column')

@section('page_title', 'Ver instituciones')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.institution.create') }}">Crear Institución</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li class="active">Instituciones</li>
	</ol>
@endsection

@section('row')
	@include('complements.flash')

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Dirección</th>
				<th>Telefono</th>
				<th>Email</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($schools as $school)
				<tr>
					<td>{{ $school->name }}</td>
					<td>{{ $school->street_address }}</td>
					<td>{{ $school->phone }}</td>
					<td>{{ $school->email }}</td>
					<td>
						<a class="btn btn-info" title="Editar" href="{{ route('admin.institution.edit', $school->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-default" title="Ver" href="{{ route('admin.institution.show', $school->id) }}"><i class="fa fa-eye"></i>
						</a>
						<a class="btn btn-danger" title="Eliminar" href="{{ route('admin.institution.destroy', $school->id) }}" onclick="return confirm('Desea eliminar esta institución')"><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection