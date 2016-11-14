@extends('institution.dashboard.1-colum')

@section('page_title', 'Crear Salon de clase')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('institution.classroom.create') }}">Crear salón de clase</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('institution.main') }}">Inicio</a></li>
	  <li class="active">Salones de clase</li>
	</ol>
@endsection

@section('row')
	@include('complements.flash')

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Grado</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($classrooms as $classroom)
				<tr>
					<td>{!! $classroom->name !!}</td>
					<td>{!! $classroom->grade.'°' !!}</td>
					<td>
						<a class="btn btn-info" title="Editar" href="{{ route('institution.classroom.edit', $classroom->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger" title="Eliminar" href="{{ route('institution.classroom.destroy', $classroom->id) }}" onclick="return confirm('Desea eliminar este salon de clase')"><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection