@extends('admin.dashboard.template.1-column')

@section('page_title')
	{{ 'Editar Institución | '. $school->name }}
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.institution.index') }}">Instituciones</a></li>
	  <li class="active">{!! $school->name !!}</li>
	  <li class="active">Editar</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => ['admin.institution.update', $school], 'method'=> 'PUT']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('name', 'Nombre', []) !!}
					{!! Form::text('name', $school->name, ['class'=> 'form-control', 'placeholder'=>'nombre de la institución']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('street_address', 'Dirección', []) !!}
					{!! Form::text('street_address', $school->street_address, ['class'=> 'form-control', 'placeholder'=>'dirección de la institución']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('phone', 'Telefono', []) !!}
					{!! Form::text('phone', $school->phone, ['class'=> 'form-control', 'placeholder'=>'telefono de la institución']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('email', 'Correo electronico', []) !!}
					{!! Form::text('email', $school->email, ['class'=> 'form-control', 'placeholder'=>'institucion@correo.com']) !!}
				</div>
			</div>
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Actualizar Institución', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
