@extends('admin.dashboard.template.1-column')

@section('page_title', 'Crear institución')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.institution.index') }}">Instituciones</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => 'admin.institution.store', 'method'=> 'POST']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('name', 'Nombre', []) !!}
					{!! Form::text('name', null, ['class'=> 'form-control', 'placeholder'=>'nombre de la institución']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('street_address', 'Dirección', []) !!}
					{!! Form::text('street_address', null, ['class'=> 'form-control', 'placeholder'=>'dirección de la institución']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('phone', 'Telefono', []) !!}
					{!! Form::text('phone', null, ['class'=> 'form-control', 'placeholder'=>'telefono de la institución']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('email', 'Correo electronico', []) !!}
					{!! Form::text('email', null, ['class'=> 'form-control', 'placeholder'=>'institucion@correo.com']) !!}
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
			{!! Form::submit('Registrar Institución', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
