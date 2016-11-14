@extends('admin.dashboard.template.1-column')

@section('page_title', 'Crear Logro')


@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li><a href="{{ route('admin.achievement.index') }}">Logros</a></li>
	  <li class="active">Crear</li>
	</ol>
@endsection
@section('row')
	@include('complements.errors')
	{!! Form::open(['route' => 'admin.achievement.store', 'method'=> 'POST']) !!}
		<div class="form-group">
			{!! Form::label('area_id', 'Area', []) !!}
			{!! Form::select('area_id', $areas, null, ['class'=>'form-control', 'placeholder'=>'-- Selecione un area --']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('competence_id', 'Competencia', []) !!}
			{!! Form::select('competence_id', [], null, ['class'=>'form-control']) !!}
		</div>
		<hr>
		<div id="achievements">
			<div class="form-group">
				{!! Form::label('name', 'Logro(s)', []) !!}
				<div class="input-group">
					{!! Form::text('name[]', null, ['class'=>'form-control', 'placeholder'=> 'nombre del logro', 'id'=>'name_1']) !!}
					<div class="input-group-btn">
						<button type="button" class="btn btn-success btnAchievement" id="n_1" data-action="addAchievement">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-group text-center">
			{!! Form::submit('Registrar Competencia', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection

@section('js')
	<script src="{{ asset('js/achievement.js') }}"></script>
@endsection