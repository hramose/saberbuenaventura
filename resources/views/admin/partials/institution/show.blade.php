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
    {{-- Notifications --}}
    @include('complements.flash')
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
        				<td class="text-right"><a href="{{ route('admin.institution.editPass', $institution->id)}}"><i class="fa fa-edit" class="btn-block"></i>Editar</a></td>
        			</tr>
        		</tbody>
        	</table>
            <div class="profile_info_footer">
                <p>
                    <i class="fa fa-calendar"></i>
                    <span>Ultima actualización </span>
                    : {{ $institution->updated_at}}
                </p>
            </div>
        </div>

		<div role="tabpanel" class="tab-pane" id="classroom">
			<ul class="nav nav-tabs" role="tablist">
				@foreach($class_rooms as $class_room)
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{!!$class_room->name!!} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#cr_{!!$class_room->name!!}_create" role="tab" data-toggle="tab">Crear estudiantes</a></li>
                            <li><a href="#cr_{!!$class_room->name!!}" role="tab" data-toggle="tab">Ver estudiantes</a></li>
                            <li><a href="#cr_{!!$class_room->name!!}_edit" role="tab" data-toggle="tab">Editar</a></li>
                            <li><a href="#html" role="tab" data-toggle="tab">Eliminar</a></li>
                        </ul>
                    </li>
					{{-- <li role="presentation" class=""><a href="#cr_{!!$class_room->name!!}" aria-controls="cr_{!!$class_room->name!!}" role="tab" data-toggle="tab">{!!$class_room->name!!}</a></li> --}}
				@endforeach
                <a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.classroom.create') }}">Crear Salón de clase</a>
			</ul>
			<div class="tab-content">
				@foreach($class_rooms as $class_room)
					<div class="tab-pane" id="cr_{!!$class_room->name!!}">
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
                    <div class="tab-pane div_center70" id="cr_{!!$class_room->name!!}_create">
                        @include('complements.errors')
                        {!! Form::open(['route' => 'admin.student.store', 'method'=> 'POST']) !!}
                            {!! Form::hidden('request_rol', 'admin', []) !!}
                            {!! Form::hidden('institution_id', $institution->id, []) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nombre', []) !!}
                                        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'pepito']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('last_name', 'Apellido', []) !!}
                                        {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'peres']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('type_document', 'Tipo de documneto', []) !!}
                                        {!! Form::select('type_document', ['tarjeta de identidad'=>'Tarjeta de identidad', 'cedula de ciudadania'=>'Cedula de ciudadania'], null, ['placeholder'=>' --Seleccione un documneto de identidad-- ', 'class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('number_document', 'Número de documneto', []) !!}
                                        {!! Form::text('number_document', null, ['placeholder'=> '1234567', 'class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('sex', 'Sexo', []) !!}
                                        {!! Form::select('sex', ['hombre'=>'Hombre', 'mujer'=>'Mujer'], null, ['placeholder'=>' --Seleccione un sexo-- ', 'class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('birthday', 'Fecha de nacimiento', []) !!}
                                        {!! Form::date('birthday', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('class_room_id', 'Salón de clase', []) !!}
                                        {!! Form::text('grade', $class_room->name, ['disabled', 'class'=>'form-control']) !!}
                                         {!! Form::hidden('class_room_id', $class_room->id, []) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('email', 'Correo electronico', []) !!}
                                        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'pepitoperez@correo.com']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('password', 'Contraseña', []) !!}
                                        {!! Form::password('password', ['class'=> 'form-control', 'placeholder'=>'**************']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('password_confirmation', 'Repita la contraseña', []) !!}
                                        {!! Form::password('password_confirmation', ['class'=> 'form-control', 'placeholder'=>'**************']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                {!! Form::submit('Registrar Estudiante', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane div_center70" id="cr_{!!$class_room->name!!}_edit">
                        {!! Form::open(['route' => ['admin.classroom.update', $class_room], 'method'=> 'PUT', 'class'=>'form-horizontal']) !!}
                            {!! Form::hidden('request_rol', 'admin', []) !!}
                            {!! Form::hidden('institution_id', $institution->id, []) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Salon de clase', ['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('name', $class_room->name, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('grade', 'grado', ['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('grade', ['10' => '10°', '11' => '11°'], $class_room->grade, ['class'=>'form-control', 'placeholder'=>' --selecciona un grado-- ']) !!}
                                </div>
                            </div>
                            <div class="form-group text-center">
                                {!! Form::submit('Actualizar Salon de clase', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
				@endforeach
			</div>
		</div>

        <div role="tabpanel" class="tab-pane" id="preicfes">
            <div class="clearfix" style="margin-bottom: 2rem;">
                <a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.preicfes.create', $institution->id) }}">Crear pre-ICFES</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Grado</th>
                        <th>Ación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($class_rooms as $class_room)

                        @foreach($class_room->pre_icfes->sortByDesc('id') as $pre_icfes)
                            <tr>
                                <td>{!! $pre_icfes->name!!}</td>
                                <td>
                                    @if($pre_icfes->state == 'en curso') 
                                        <span class="label label-warning">{!! $pre_icfes->state !!}</span>
                                    @elseif($pre_icfes->state == 'finalizado')
                                        <span class="label label-success">{!! $pre_icfes->state !!}</span>
                                    @elseif($pre_icfes->state == 'pendiente')
                                        <span class="label label-danger">{!! $pre_icfes->state !!}</span>
                                    @endif
                                </td>
                                <td>{!! $pre_icfes->start_date!!}</td>
                                <td>{!! $class_room->name!!}</td>
                                <td>
                                    <a class="btn btn-info" title="Editar" href="{{ route('admin.preicfes.edit', $pre_icfes->id) }}"><i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-default" title="Ver" href="{{ route('admin.preicfes.show', $pre_icfes->id) }}"><i class="fa fa-eye"></i>
                                    </a>
                                    @if(count($pre_icfes->students()->get()) == 0)
                                    <a class="btn btn-danger" title="Eliminar" href="{{ route('institution.preicfes.destroy', $pre_icfes->id) }}" onclick="return confirm('Desea eliminar este pre-ICFES')"><i class="fa fa-trash"></i>
                                    </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    @endforeach
               </tbody>
            </table>
        </div>
    </div>
@endsection