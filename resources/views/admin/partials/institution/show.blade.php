@extends('admin.dashboard.template.1-column')

@section('page_title')
	{{ 'Ver Institución | '. $institution->name }}
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.institution.index') }}">Instituciones</a></li>
	  <li class="active">{!! $institution->name !!}</li>
	  <li class="active">Ver</li>
	</ol>
@endsection

@section('row')
	{{-- Tabs --}}
	<ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#descriptionInstitution" aria-controls="descriptionInstitution" role="tab" data-toggle="tab">Descripcion</a></li>
        <li role="presentation"><a href="#classroom" aria-controls="classroom" role="tab" data-toggle="tab">Salon de clase</a></li>
        <li role="presentation"><a href="#preicfes" aria-controls="preicfes" role="tab" data-toggle="tab">Pre-ICFES</a></li>
    </ul>
    {{-- Tab Panel --}}
    <div class="tab-content">
		<div role="tabpanel" class="tab-pane active div_center70" id="descriptionInstitution">
        	<table class="table table-hover">
        		<thead>
        			<tr>
        				<th colspan="2">
        					<h4 class="text-center"><i class="fa fa-institution"></i>Información de la institutión</h4>
        				</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td><h5 class="bold">Nombre</h5></td>
        				<td>{!! $institution->name!!}</td>
        			</tr>
        			<tr>
        				<td><h5 class="bold">Dirección</h5></td>
        				<td>{!! $institution->street_address!!}</td>
        			</tr>
        			<tr>
        				<td><h5 class="bold">Telefono</h5></td>
        				<td>{!! $institution->phone!!}</td>
        			</tr>
        			<tr>
        				<td><h5 class="bold">Correo electronico</h5></td>
        				<td>{!! $institution->email!!}</td>
        			</tr>
        			<tr>
        				<td class="text-right" colspan="2"><a href="{{ route('admin.institution.edit', $institution->id)}}" class="btn-block"><i class="fa fa-edit"></i>Editar</a></td>
        			</tr>
        		</tbody>
        	</table>
        	{{-- info password --}}
        	<table class="table table-hover text-center">
        		<thead>
        			<tr>
        				<th colspan="3">
        					<h4 class="text-center"><i class="fa fa-lock"></i> Información de la contraseña</h4>
        				</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td><h5 class="bold">Contraseña</h5></td>
        				<td>**********</td>
        				<td class="text-right"><a href="{{ route('admin.institution.edit', $institution->id)}}"><i class="fa fa-edit" class="btn-block"></i>Editar</a></td>
        			</tr>
        		</tbody>
        	</table>
        </div>

		<div role="tabpanel" class="tab-pane active" id="classroom">
			<ul class="nav nav-tabs" role="tablist">
				@foreach($class_rooms as $class_room)
					<li role="presentation" class=""><a href="#cr_{!!$class_room->name!!}" aria-controls="cr_{!!$class_room->name!!}" role="tab" data-toggle="tab">{!!$class_room->name!!}</a></li>
				@endforeach
			</ul>
			<div class="tab-content">
				@foreach($class_rooms as $class_room)
					<div class="tab-pane active" id="cr_{!!$class_room->name!!}">
						<table class="table">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Salón</th>
									<th>Tipo de documento</th>
									<th>Número de documento</th>
									<th>Email</th>
									<th>Ación</th>
								</tr>
							</thead>
							<tbody>
								@foreach($class_room->students as $student)
									<tr>
										<td>{!!$student->name!!}</td>
										<td>{!!$student->last_name!!}</td>
										<td>{!!$class_room->name!!}</td>
										<td>{!!$student->type_document!!}</td>
										<td>{!!$student->number_document!!}</td>
										<td>{!!$student->email!!}</td>
										<td>
											<a class="btn btn-default" title="Ver" href="{{ route('admin.student.show', [$student->id, 'admin']) }}"><i class="fa fa-eye"></i>
											</a>
											{{-- <a class="btn btn-danger" title="Eliminar" href="{{ route('student.destroy', $student->id) }}" onclick="return confirm('Desea eliminar este estudiante')"><i class="fa fa-trash"></i>
											</a> --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@endforeach
			</div>
		</div>
    </div>
@endsection