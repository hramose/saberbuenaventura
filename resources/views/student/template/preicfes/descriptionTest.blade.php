@extends('student.template.preicfes.testTemplate')


@section('panel_content')
	<div class="panel panelBox panelActivity">
		<header class="panel_header clearfix">
			<h4 class="pull-left">
				<i class="fa fa-book"></i>
				{{ $preicfes->name }}
			</h4>
			<a class="pull-right" ><i class="fa fa-clock-o"></i>{!! ' '.Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $preicfes->start_date)->diffForHumans() !!}</a >
		</header>
		<div class="container-fluid">
			{{--  --}}
			@include('complements.flash')
			{{--  --}}
			<div class="profile_info">
				@if($preicfes_result > 0)
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-info clearfix" role="alert">
							<p class="pull-left">Heyy!! ya cuentas con resultados de esta prueba</p>
							<a href="{{route('preicfes.showResults', $preicfes->id)}}" class="btn btn-default btn-sm pull-right" style="margin:0px"><i class="fa fa-eye"></i> Ver resultados</a>
						</div>
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-warning text-center" style="width: 70%;margin:0 auto;">
							<p>
								<i class="fa fa-clock-o"></i>
								<span id="countdown"></span>
							</p>
						</div>
					</div>
					<div class="col-md-12">
						<h4>Descripción</h4>
						<div class="preicfes_description">
							{!! $preicfes->description !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="title_areas text-center">
						<h2>Areas a evaluar</h2>
						<hr>
					</div>
					<div class="areas_content">
						@foreach($preicfes->areas as $area)
							<?php
								if(strstr($area->name, 'sociales')){
									$class='col-md-3 col-xs-6';
									$icon = 'fa fa-users fa-3x';
								}
								elseif(strstr($area->name, 'ciencias')){
									$class='col-md-3 col-xs-6';
									$icon = 'fa fa-bug fa-3x';
								}
								elseif(strstr($area->name, 'ingles')){
									$class='col-md-2 col-xs-6';
									$icon = 'fa fa-comments fa-3x';
								} 
								elseif(strstr($area->name, 'lectura')){
									$class='col-md-2 col-xs-6';
									$icon = 'fa fa-language fa-3x';
								} 
								elseif(strstr($area->name, 'matematica')){
									$class='col-md-2 col-xs-6';
									$icon = 'fa fa-pie-chart fa-3x';
								} 

							?>
							<div class="text-center {{$class}}">
								<h5 class="pre_asignature">{{ $area->name }}</h5>
								<div class="pre_button btn-primary">
									<a href="{{ route('preicfes.test',[$preicfes->id, str_replace(' ','-',$area->name), $area->id]) }}">
										<i class="{{$icon}}"></i>
									</a>
								</div>
							</div>
						@endforeach
					</div>
				</div>
				<div>
					{!! Form::open(['route'=>'preicfes.saveTest', 'methos'=>'post', 'id'=>'formTest']) !!}
						{!! Form::hidden('student_id', $student_id, []) !!}
						{!! Form::hidden('pre_icfes_id', $preicfes->id, []) !!}
						<div class="form-group text-center">
							{!! Form::submit('Terminar prueba', ['class'=>'btn btn-success']) !!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script>
		var id_pre = {!! $preicfes->id !!};
		var targetD = {!! strtotime($preicfes->end_date) !!}
	</script>
	<script src="{{asset('js/countdown.js')}}"></script>
@endsection