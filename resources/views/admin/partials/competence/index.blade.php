@extends('admin.dashboard.template.1-column')

@section('page_title', 'Ver Competencias')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.competence.create') }}">Crear Competencia</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li class="active">Competencias</li>
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
			@foreach($competences as $competence)
				<tr>
					<td>{{ $competence->name }}</td>
					<td>{{ $competence->area->name }}</td>
					<td>
						<a class="btn btn-info" title="Editar" href="{{ route('admin.competence.edit', $competence->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger" title="Eliminar" href="{{ route('admin.competence.destroy', $competence->id) }}" onclick="return confirm('Desea eliminar esta competencia')"><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $competences->render() !!}
@endsection