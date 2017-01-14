@extends('institution.dashboard.1-colum')

@section('css')
	<link href="{{ asset('css/preicfes.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('page_title')
	<i class="fa fa-book"></i> {!! $preicfes->name!!}
@endsection

@section('btn-create')
	<a class="pull-right" ><i class="fa fa-clock-o"></i>{!! ' '.Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $preicfes->start_date)->diffForHumans() !!}</a >
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('institution.main') }}">Inicio</a></li>
	  <li><a href="{{ route('institution.preicfes.index') }}">Pre-ICFES</a></li>
	  <li class="active">{!! $preicfes->name !!}</li>
	</ol>
@endsection

@section('row')
	<div class="card">
		{{-- Tabs --}}
		<ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#descriptionTest" aria-controls="descriptionTest" role="tab" data-toggle="tab">Descripcion</a></li>
            <li role="presentation"><a href="#studentTest" aria-controls="studentTest" role="tab" data-toggle="tab">Estudiantes</a></li>
            <li role="presentation"><a href="#grade" aria-controls="grade" role="tab" data-toggle="tab">Grado</a></li>
         </ul>
        {{-- Tab Panel --}}
        <div class="tab-content">
        	<div role="tabpanel" class="tab-pane active" id="descriptionTest">
        		<div class="row">
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
									<i class="{{$icon}}"></i>
								</div>
							</div>
						@endforeach
					</div>
				</div>
        	</div>
        	<div role="tabpanel" class="tab-pane" id="studentTest">
        		<div class="row">
        			<div class="col-md-12">
        				<table class="table table-hover text-center">
        					<thead>
        						<tr>
        							<th>Codigo</th>
        							<th>Estudiante</th>
									<th>Matematicas</th>
									<th>Lectura critica</th>
									<th>Sociales</th>
									<th>Ciencias naturales</th>
									<th>Ingles</th>
									<th>Puntaje global</th>
        						</tr>
        					</thead>
        					<tbody>
        						@foreach($results as $student)
									<tr>
										<td>{!! $student->codigo_registro !!}</td>
										<td>{!! $student->student->name.' '.$student->student->last_name !!}</td>
										<td>{!! $student->matematicas !!}</td>
										<td>{!! $student->lectura_critica !!}</td>
										<td>{!! $student->sociales_y_ciudadanas !!}</td>
										<td>{!! $student->ciencias_naturales !!}</td>
										<td>{!! $student->ingles !!}</td>
										<td>{!! $student->total_score !!}</td>
									</tr>
        						@endforeach
        					</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        	<div role="tabpanel" class="tab-pane" id="grade">
        		{!! $preicfes->class_room->name!!}
        	</div>
        </div>
	</div>
@endsection