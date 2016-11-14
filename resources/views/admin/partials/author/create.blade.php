@extends('admin.dashboard.template.1-column')

@section('page_title', 'Crear referencia o cita')

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.author.index') }}">Autores</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection

@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => 'admin.author.store', 'method'=> 'POST']) !!}		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('source', 'Origen', []) !!}
					{!! Form::text('source', null, ['class'=> 'form-control', 'placeholder'=>'origen....']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('author', 'Autor', []) !!}
					{!! Form::text('author', null, ['class'=> 'form-control', 'placeholder'=>'autor de la obra']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('year', 'Año de publicacion', []) !!}
					{!! Form::text('year', null, ['class'=> 'form-control datepicker', 'placeholder'=>'2009']) !!}
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					{!! Form::label('link', 'Vinculo', []) !!}
					{!! Form::text('link', null, ['class'=> 'form-control datepicker', 'placeholder'=>'http://vinculoalauthor.com']) !!}
				</div>
			</div>
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Registrar Author', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection

@section('js')

@endsection
