@extends('student.template.profile.index')

@section('panel_content')
	<div class="">
		<div class="panel panelBox panel-card">
			<header class="panel_header">
				<h4 class="text-center"><i class="fa fa-user"></i> Información personal</h4>
			</header>
			<div class="container-fluid">
				@include('complements.flash')
				<div class="profile_info div_center70">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>
									<h5 class="text_bold">Nombre</h5>
									<td>{{$student->name}}</td>
								</td>
							</tr>
							<tr>
								<td>
									<h5 class="text_bold">Apellidos</h5>
									<td>{{$student->last_name}}</td>
								</td>
							</tr>
							<tr>
								<td>
									<h5 class="text_bold">Tipo de documento</h5>
									<td>{{$student->type_document}}</td>
								</td>
							</tr>
							<tr>
								<td>
									<h5 class="text_bold">Numero de documento</h5>
									<td>{{$student->number_document}}</td>
								</td>
							</tr>
							<tr>
								<td>
									<h5 class="text_bold">Sexo</h5>
									<td>{{$student->sex}}</td>
								</td>
							</tr>
							<tr>
								<td>
									<h5 class="text_bold">Fecha de nacimiento</h5>
									<td>{{$student->birthday}}</td>
								</td>
							</tr>
							<tr>
								<td>
									<h5 class="text_bold">Correo electronico</h5>
									<td>{{$student->email}}</td>
								</td>
							</tr>
							<tr>
								<td class="profile_info_footer"><p>Ultima actualización: {{ $student->updated_at}}</p></td>
								<td>
									<a href="{{route('student.edit', [$student->id,'student'])}}" class="btn-block"><i class="fa fa-edit"></i> Editar</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="">
		<div class="panel panelBox panel-card">
			<header class="panel_header">
				<h4 class="text-center">
					<i class="fa fa-lock"></i>
					Informacion contraseña
				</h4>	
			</header>
			<div class="container-fluid">
				<div class="profile_info div_center70">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>Contraseña</td>
								<td>**************</td>
							</tr>
							<tr>
								<td class="profile_info_footer"><p>Ultima actualización: {{ $student->updated_at}}</p></td>
								<td>
									<a href="{{ route('student.changeMyPass') }}" class="btn-block"><i class="fa fa-edit"></i> Editar</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="">
		<div class="panel panelBox">
			<header class="panel_header">
				<h4 class="text-center">
					<i class="fa fa-institution"></i>
					Informacion institucional
				</h4>	
			</header>
			<div class="container-fluid">
				<div class="profile_info div_center70">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>Salon de clase</td>
								<td>{{$student->class_room->name}}</td>
							</tr>
							<tr>
								<td>Colegio</td>
								<td>{{$student->class_room->institution->name}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection