@extends('institution.dashboard.1-colum')

@section('page_title', 'Crear Salon de clase')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('institution.main') }}">Inicio</a></li>
	  <li><a href="{{ route('institution.classroom.index') }}">Salones de clase</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')

	{!! Form::open(['route' => 'institution.classroom.store', 'method'=> 'POST']) !!}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('name', 'Salon de clase', []) !!}
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
					{!! Form::hidden('institution_id', Auth()->guard('institutions')->user()->id, []) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('grade', 'grado', []) !!}
					{!! Form::select('grade', ['10' => '10°', '11' => '11°'], null, ['class'=>'form-control', 'placeholder'=>' --selecciona un grado-- ']) !!}
				</div>
			</div>
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Registrar Salon de clase', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection