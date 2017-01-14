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
							<div class="row">
								<div class="col-md-4 col-xs-4">Nombre</div>
								<div class="col-md-8 col-xs-8">{{$student->name}}</div>
							</div>
						</div>
						<div class="col-md-6 col-xs-6">
							<div class="row">	
								<div class="col-md-4 col-xs-4">Apellidos</div>
								<div class="col-md-8 col-xs-8">{{$student->last_name}}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<div class="row">
								<div class="col-md-4 col-xs-6">Tipo de documento</div>
								<div class="col-md-8 col-xs-6">{{$student->type_document}}</div>	
							</div>
						</div>
						<div class="col-md-6 col-xs-6">
							<div class="row">
								<div class="col-md-4 col-xs-6">Numero de documento</div>
								<div class="col-md-8 col-xs-6">{{$student->number_document}}</div>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<div class="row">
								<div class="col-md-4 col-xs-6">Sexo</div>
								<div class="col-md-8 col-xs-6">{{$student->sex}}</div>
							</div>
						</div>
						<div class="col-md-6 col-xs-6">
							<div class="row">
								<div class="col-md-4 col-xs-6">Fecha de nacimiento</div>
								<div class="col-md-8 col-xs-6">{{$student->birthday}}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<div class="row">
								<div class="col-md-4 col-xs-6">Correo electronico</div>
								<div class="col-md-8 col-xs-6">{{$student->email}}</div>
							</div>
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