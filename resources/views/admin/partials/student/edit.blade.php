@extends('admin.dashboard.template.1-column')

@section('page_title')
	{!! 'Editar Alumno | '.$student->name.' '.$student->last_name !!}
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.institution.index') }}">Instituciones</a></li>
	  <li><a href="{{ route('admin.institution.show', $student->class_room->institution->id) }}">{!! $student->class_room->institution->name !!}</a></li>
	  <li class="active">alumno</li>
	  <li><a href="{{ route('admin.student.show', [$student->id, 'admin']) }}">{!! $student->name.' '.$student->last_name !!}</a></li>
	  <li class="active">Editar</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')

	{!! Form::open(['route' => ['admin.student.update', $student], 'method'=> 'PUT']) !!}
		{!! Form::hidden('request_rol', 'admin', []) !!}
		{!! Form::hidden('request_method', 'UpdateInfoFull', []) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('name', 'Nombre', []) !!}
					{!! Form::text('name', $student->name, ['class'=>'form-control', 'placeholder'=>'pepito']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('last_name', 'Apellido', []) !!}
					{!! Form::text('last_name', $student->last_name, ['class'=>'form-control', 'placeholder'=>'peres']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('type_document', 'Tipo de documneto', []) !!}
					{!! Form::select('type_document', ['tarjeta de identidad'=>'Tarjeta de identidad', 'cedula de ciudadania'=>'Cedula de ciudadania'], $student->type_document, ['placeholder'=>' --Seleccione un documneto de identidad-- ', 'class'=>'form-control']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('number_document', 'Número de documneto', []) !!}
					{!! Form::text('number_document', $student->number_document, ['placeholder'=> '1234567', 'class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('sex', 'Sexo', []) !!}
					{!! Form::select('sex', ['hombre'=>'Hombre', 'mujer'=>'Mujer'], $student->sex, ['placeholder'=>' --Seleccione un sexo-- ', 'class'=>'form-control']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('birthday', 'Fecha de nacimiento', []) !!}
					{!! Form::date('birthday', $student->birthday, ['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('class_room_id', 'Salón de clase', []) !!}
					{!! Form::select('class_room_id', $classrooms, $student->class_room_id, ['class'=>'form-control', 'placeholder'=>' --Seleccione un grado-- ']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('email', 'Correo electronico', []) !!}
					{!! Form::email('email', $student->email, ['class'=>'form-control', 'placeholder'=>'pepitoperez@correo.com']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('state', 'Estado', []) !!}
					{!! Form::select('state', ['activo'=>'Activo', 'inactivo'=>'Inactivo'], $student->state, ['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Actualizar Estudiante', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection