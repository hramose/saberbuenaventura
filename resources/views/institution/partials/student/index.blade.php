@extends('institution.dashboard.1-colum')

@section('page_title', 'Ver Estudiantes')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('institution.student.create') }}">Crear alumno</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('institution.main') }}">Inicio</a></li>
	  <li class="active">Estudiantes</li>
	</ol>
@endsection

@section('row')
	@include('complements.flash')

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Salon</th>
				<th>Email</th>
				<th>Estado</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach($students as $student)
				<tr>
					<td>{!! $student->name !!}</td>
					<td>{!! $student->last_name!!}</td>
					<td>{!! $student->class_room->name !!}</td>
					<td>{!! $student->email !!}</td>
					<td>
						@if($student->state == 'activo') 
							<span class="label label-success">{!! $student->state !!}</span>
						@elseif($student->state == 'inactivo')
							<span class="label label-danger">{!! $student->state !!}</span>
						@endif
					</td>
					<td>
						<a class="btn btn-info" title="Editar" href="{{ route('institution.student.edit', $student->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger" title="Eliminar" href="{{ route('institution.student.destroy', $student->id) }}" onclick="return confirm('Desea eliminar este estudiante')"><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $students->render() !!}
@endsection