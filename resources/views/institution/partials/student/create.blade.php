@extends('institution.dashboard.1-colum')

@section('page_title', 'Crear Alumno')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('institution.main') }}">Inicio</a></li>
	  <li><a href="{{ route('institution.student.index') }}">Alumnos</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')

	{!! Form::open(['route' => 'institution.student.store', 'method'=> 'POST']) !!}
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
					{!! Form::select('class_room_id', $classrooms, null, ['class'=>'form-control', 'placeholder'=>' --Seleccione un grado-- ']) !!}
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
@endsection