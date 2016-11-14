@extends('admin.dashboard.template.1-column')

@section('page_title', 'Ver Logros')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.achievement.create') }}">Crear logro	</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li class="active">Logros</li>
	</ol>
@endsection
@section('row')
	@include('complements.flash')
	<table class="table table-striped table-hover">
		<thead>
			<th>Nombre</th>
			<th>Competencia</th>
			<th>Acción</th>
		</thead>
		<tbody>	
			@foreach($achievements as $achievement)
				<tr>
					<td>{{ $achievement->name }}</td>
					<td>{{ $achievement->competence->name }}</td>
					<td>
						<a class="btn btn-info btn-sm" title="Editar" href="{{ route('admin.achievement.edit', $achievement->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger btn-sm" title="Eliminar" href="{{ route('admin.achievement.destroy', $achievement->id) }}" onclick="return confirm('Desea eliminar este logro')"><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection