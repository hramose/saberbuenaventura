@extends('student.template.profile.index')

@section('panel_content')
	<div class="row">
		@include('complements.errors')
		<div class="panel panelBox panel-card">
			<header class="panel_header">
				<h3>
					<i class="fa fa-edit"></i>
					Editar información personal
				</h3>
			</header>
			<div class="container-fluid">
				{!! Form::open(['route' => ['student.student.update', $student], 'method'=> 'PUT']) !!}
					<div class="row">
						{!! Form::hidden('request_rol', 'student', []) !!}
						{!! Form::hidden('request_method', 'UpdateInfo', []) !!}
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label('name', 'Nombre', []) !!}
								{!! Form::text('name', $student->name, ['class'=>'form-control']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label('last_name', 'Apellido', []) !!}
								{!! Form::text('last_name', $student->last_name, ['class'=>'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label('type_document', 'Tipo de documneto', []) !!}
								{!! Form::select('type_document', ['tarjeta de identidad'=>'Tarjeta de identidad', 'cedula de ciudadania'=>'Cedula de ciudadania'], $student->type_document, ['class'=>'form-control', 'disabled']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label('number_document', 'Número de documneto', []) !!}
								{!! Form::text('number_document', $student->number_document, ['class'=>'form-control', 'disabled']) !!}
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
								{!! Form::label('email_di', 'Correo electronico', []) !!}
								{!! Form::email('email_di', $student->email, ['class'=>'form-control', 'placeholder'=>'pepitoperez@correo.com', 'disabled']) !!}
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						{!! Form::submit('Actualizar información', ['class'=>'btn btn-primary']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection