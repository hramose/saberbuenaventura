@extends('admin.dashboard.template.1-column')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/preicfes.css') }}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugin/chosen/chosen.css')}}">
@endsection

@section('page_title')
	Crear PreICFES
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.institution.index') }}">Instituciones</a></li>
	  <li><a href="{{ route('admin.institution.show', $institution->name)}}">{!! $institution->name !!}</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	
	{!! Form::open(['route' => 'admin.preicfes.store', 'method'=> 'POST']) !!}
		{!! Form::hidden('request_rol', 'admin', []) !!}
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					{!! Form::label('name', 'Nombre de la prueba', ['class'=>'control-label']) !!}
					{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'nombre de la prueba']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('class_room_id', 'Salón de clase', ['class'=>'control-label']) !!}
					{!! Form::select('class_room_id', $classrooms, null, ['class'=>'form-control', 'placeholder'=>'--seleccione un salón de clase-- ']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('start_date', 'Fecha de inicio', ['class'=>'control-label']) !!}
					<input type="date" name="start_date" class="form-control" placeholder="seleccione la fecha y hora">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('hour_start', 'Hora de inicio', ['class'=>'control-label']) !!}
					{!! Form::select('hour_start', [
						'07:00:00'=>'07:00 am',
						'07:30:00'=>'07:30 am',
						'08:00:00'=>'08:00 am',
						'08:30:00'=>'08:30 am',
						'09:00:00'=>'09:00 am',
						'09:30:00'=>'09:30 am',
						'10:00:00'=>'10:00 am',
						'10:30:00'=>'10:30 am',
						'11:00:00'=>'11:00 am',
						'11:30:00'=>'11:30 am',
						'13:00:00'=>'01:00 pm',
						'13:30:00'=>'01:30 pm',
						'14:00:00'=>'02:00 pm',
						'14:30:00'=>'02:30 pm',
						'15:00:00'=>'03:00 pm',
						'15:30:00'=>'03:30 pm',
						'16:00:00'=>'04:00 pm',
						'16:30:00'=>'04:30 pm',
						'17:00:00'=>'05:00 pm',
						'17:30:00'=>'05:30 pm',
						'22:00:00'=>'10:00 pm',
						'22:30:00'=>'10:30 pm',
						'23:00:00'=>'11:00 pm',
						'23:30:00'=>'11:30 pm',
						'00:30:00'=>'00:30 am',
						'01:00:00'=>'01:00 am',
						'01:30:00'=>'01:30 am',
						'02:00:00'=>'02:00 am',
						'02:30:00'=>'02:30 am',
						'03:00:00'=>'03:00 am',
						'03:30:00'=>'03:30 am'
					], null, ['class'=>'form-control', 'placeholder'=> ' --Hora-- ']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('end_date', 'Fecha de finalización', ['class'=>'control-label']) !!}
					<input type="date" name="end_date" class="form-control" placeholder="seleccione la fecha y hora">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('hour_end', 'Hora de finalización', ['class'=>'control-label']) !!}
					{!! Form::select('hour_end', [
						'07:00:00'=>'07:00 am',
						'07:30:00'=>'07:30 am',
						'08:00:00'=>'08:00 am',
						'08:30:00'=>'08:30 am',
						'09:00:00'=>'09:00 am',
						'09:30:00'=>'09:30 am',
						'10:00:00'=>'10:00 am',
						'10:30:00'=>'10:30 am',
						'11:00:00'=>'11:00 am',
						'11:30:00'=>'11:30 am',
						'13:00:00'=>'01:00 pm',
						'13:30:00'=>'01:30 pm',
						'14:00:00'=>'02:00 pm',
						'14:30:00'=>'02:30 pm',
						'15:00:00'=>'03:00 pm',
						'15:30:00'=>'03:30 pm',
						'16:00:00'=>'04:00 pm',
						'16:30:00'=>'04:30 pm',
						'17:00:00'=>'05:00 pm',
						'17:30:00'=>'05:30 pm',
						'22:00:00'=>'10:00 pm',
						'22:30:00'=>'10:30 pm',
						'23:00:00'=>'11:00 pm',
						'23:30:00'=>'11:30 pm',
						'00:30:00'=>'00:30 am',
						'01:00:00'=>'01:00 am',
						'01:30:00'=>'01:30 am',
						'02:00:00'=>'02:00 am',
						'02:30:00'=>'02:30 am',
						'03:00:00'=>'03:00 am',
						'03:30:00'=>'03:30 am'
					], null, ['class'=>'form-control', 'placeholder'=> ' --Hora-- ']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('area_id', 'Areas', ['class'=>'control-label']) !!}
					{!! Form::select('area_id[]', $areas, null, ['class'=>'form-control area_id', 'multiple'=>true]) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('description', 'Descripción', []) !!}
					{!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'mytextarea']) !!}
				</div>
			</div>
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Registrar pre-ICFES', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection

@section('js')
	<script src="{{ asset('plugin/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('plugin/chosen/chosen.jquery.js') }}"></script>
	<script src="{{ asset('js/preicfes.js') }}"></script>
@endsection