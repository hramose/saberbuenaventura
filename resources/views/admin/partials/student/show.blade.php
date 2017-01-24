@extends('admin.dashboard.template.1-column')

@section('page_title')
	{!! 'Ver Alumno | '.$student->name.' '.$student->last_name !!}
@endsection

@section('css')
	<link href="{{ asset('css/student.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/preicfes.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('institution.main') }}">Inicio</a></li>
      <li><a href="{{ route('admin.institution.show', $student->class_room->institution->id) }}">{!! $student->class_room->institution->name !!}</a></li>
	  <li class="active">alumno</li>
	  <li class="active">{!! $student->name.' '.$student->last_name !!}</li>
	  <li class="active">Ver</li>
	</ol>
@endsection

@section('row')
	{{-- Tabs --}}
	<ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> Informacion</a></li>
        <li role="presentation"><a href="#preicfesStudent" aria-controls="preicfesStudent" role="tab" data-toggle="tab"><i class="fa fa-book"></i> Mis Pre-ICFES</a></li>
    </ul>
    {{-- Notifications --}}
    @include('complements.flash')
    {{-- Tab Panel --}}
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active div_center70" id="info">
        	<table class="table table-hover">
        		<thead>
        			<tr>
        				<th colspan="2" class="text-center"><h4><i class="fa fa-user"></i> Informacion de contacto</h4></th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td><h5 class="text_bold">Nombre</h5></td>
        				<td>{{$student->name}}</td>
        			</tr>
        			<tr>
        				<td><h5 class="text_bold">Apellido</h5></td>
        				<td>{{$student->last_name}}</td>
        			</tr>
        			<tr>
        				<td><h5 class="text_bold">Tipo de documento</h5></td>
        				<td>{{$student->type_document}}</td>
        			</tr>
        			<tr>
        				<td><h5 class="text_bold">Número de documento</h5></td>
        				<td>{{$student->number_document}}</td>
        			</tr>
        			<tr>
        				<td><h5 class="text_bold">Sexo</h5></td>
        				<td>{{$student->sex}}</td>
        			</tr>
        			<tr>
        				<td><h5 class="text_bold">Fecha de nacimiento</h5></td>
        				<td>{{$student->birthday}}</td>
        			</tr>
        			<tr>
        				<td><h5 class="text_bold">Correo electronico</h5></td>
        				<td>{{$student->email}}</td>
        			</tr>
                    <tr>
                        <td><h5 class="text_bold">Estado</h5></td>
                        <td>
                            @if($student->state == 'activo') 
                                <span class="label label-success">{!! $student->state !!}</span>
                            @elseif($student->state == 'inactivo')
                                <span class="label label-danger">{!! $student->state !!}</span>
                            @endif
                        </td>
                    </tr>
        			<tr>
        				<td class="text-right" colspan="2"><a class="btn-block" href="{{ route('admin.student.edit', [$student->id,'admin']) }}"><i class="fa fa-edit"></i> Editar</a></td>
        			</tr>
        		</tbody>
        	</table>
        	<table class="table table-hover text-center">
        		<thead>
        			<tr>
        				<th colspan="3"  class="text-center"><h4><i class="fa fa-lock"></i> Informacion contraseña</h4></th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td><h5 class="text_bold">Contraseña</h5></td>
        				<td>**********</td>
        				<td class="text-right"><a href="{{ route('admin.student.editPass', [$student->id, 'admin'])}}"><i class="fa fa-edit"></i> Editar</a></td>
        			</tr>
        		</tbody>
        	</table>
        	<table class="table table-hover text-center">
        		<thead>
        			<tr>
        				<th colspan="3"  class="text-center"><h4><i class="fa fa-institution"></i> Informacion Institucional</h4></th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td><h5 class="text_bold">Institución</h5></td>
        				<td>{{$student->class_room->institution->name}}</td>
        			</tr>
        			<tr>
        				<td><h5 class="text_bold">Salón de clase</h5></td>
        				<td>{{$student->class_room->name}}</td>
        			</tr>
        		</tbody>
        	</table>
        	<div class="profile_info_footer">
        		<p>
        			<i class="fa fa-calendar"></i>
					<span>Ultima actualización </span>
					: {{ $student->updated_at}}
				</p>
        	</div>
        </div>
        <div role="tabpanel" class="tab-pane" id="preicfesStudent">
        	@foreach($pre_icfes_result as $result)
        		<?php 
					
					$start_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $result->pre_icfes->start_date);
					Carbon\Carbon::setToStringFormat('d-n-Y ');

					$date = new App\Date();
					$date->setDate($start_date);
				?>
        		<div class="preicfes_test">
        			<div class="clearfix">
        				<h4 class="pull-left title_preicfes">{!! $result->pre_icfes->name!!}</h4>
        				<a href="" class="pull-right">
        					<i class="fa fa-clock-o"></i>
							{!! ' '. $date->getFullDate() !!}
        				</a>
        			</div>
        			<div class="row">
        				<div class="col-md-12">
        					<h4>Descripción</h4>
        					<div class="preicfes_description">
        						{!! $result->pre_icfes->description !!}
        					</div>
        				</div>
        			</div>
        			<div class="div_center70">
        				
        				@foreach($result['attributes'] as $field => $value)
							
							@foreach($result->pre_icfes->areas as $area)
								<?php $field_tmp = str_replace('_', ' ', $field);?>

								@if($field_tmp == $area->name && $value != null)
									<div class="row">
										<div class="col-md-3">
											<p class="text_bold">{!! $area->name!!}</p>
										</div>
										<div class="col-md-9">
											<div class="progress">
											
											@foreach($area->performance_level as $performance)
												
												@if($value >= $performance->min_score && $value <= $performance->max_score)
													<div class="progress-bar-striped active progress-bar progress-bar-@if(strstr($performance->level, "+")){!!str_replace('+','2',strtolower($performance->level))!!}@elseif(strstr($performance->level, "nimo", true)){!!'minimo'!!}@else{!!strtolower($performance->level)!!} @endif" role="progressbar" 	aria-valuenow="{!!$value!!}" aria-valuemin="0" 	aria-valuemax="100" style="width: {!! $value!!}%;">
												    	{!! $value.' puntos ' !!}
													</div>
												@endif
	
											 @endforeach
							
											</div>
										</div>
									</div>
								@endif
							@endforeach
        				@endforeach
        				<hr>
        				<div class="row">
								<div class="col-md-3">
									<p class="text_bold">Puntaje global</p>
								</div>
								<div class="col-md-9">
									<span class="text_bold">
                                        {!! $result->total_score !!}
                                    </span>
                                    <span>{!! ' Puntos de '.(count($result->pre_icfes->areas)*100) !!}</span>
								</div>
							</div>
        			</div>
        		</div>
        	@endforeach
        </div>
    </div>
@endsection