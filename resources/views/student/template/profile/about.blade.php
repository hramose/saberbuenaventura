@extends('student.template.profile.index')

@section('panel_content')
	<div class="">
		<div class="panel panelBox panel-card">
			<header class="panel_header">
				<h4>
					<i class="fa fa-user"></i>
					Información personal
				</h4>
			</header>
			<div class="container-fluid">
				<div class="profile_info">
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<p>
								<span>Nombre </span> : {{$student->name}}
							</p>
						</div>
						<div class="col-md-6 col-xs-6">
							<p>
								<span>Apellidos </span> : {{$student->last_name}}
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<p>
								<span>Tipo de documento </span> : {{$student->type_document}}
							</p>
						</div>
						<div class="col-md-6 col-xs-6">
							<p>
								<span>Numero de documento </span> : {{$student->number_document}}
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<p>
								<span>Sexo </span> : {{$student->sex}}
							</p>
						</div>
						<div class="col-md-6 col-xs-6">
							<p>
								<span>Fecha de nacimiento </span> : {{$student->birthday}}
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<p>
								<span>Correo electronico </span> : {{$student->email}}
							</p>
						</div>
					</div>
				</div>
				<div class="profile_info_footer clearfix">
					<div class="pull-left">
						<p>
							<span>Ultima actualización </span>
							: {{ $student->updated_at}}
						</p>
					</div>
					<div class="pull-right">
						<a href="{{ route('student.editInfo') }}" class="btn btn-primary">Editar Información</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="">
		<div class="panel panelBox panel-card">
			<header class="panel_header">
				<h4>
					<i class="fa fa-lock"></i>
					Informacion contraseña
				</h4>	
			</header>
			<div class="container-fluid">
				<div class="profile_info">
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<p>
								<span>Contraseña </span> : **************
							</p>
						</div>
					</div>
				</div>
				<div class="profile_info_footer clearfix">
					<div class="pull-left">
						<p>
							<span>Ultima actualización </span>
							: {{ $student->updated_at}}
						</p>
					</div>
					<div class="pull-right">
						<a href="{{ route('student.editPass') }}" class="btn btn-primary">Editar Información</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="">
		<div class="panel panelBox">
			<header class="panel_header">
				<h4>
					<i class="fa fa-institution"></i>
					Informacion institucional
				</h4>	
			</header>
			<div class="container-fluid">
				<div class="profile_info">
					<div class="col-md-6 col-xs-6">
						<p>
							<span>Salon de clase </span> : {{$student->class_room->name}}
						</p>
					</div>
					<div class="col-md-6 col-xs-6">
						<p>
							<span>Colegio </span> : {{$student->class_room->institution->name}}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection