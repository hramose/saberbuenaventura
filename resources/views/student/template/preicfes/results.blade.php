@extends('student.template.preicfes.testTemplate')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/results.css')}}">
@endsection

	<?php

		$start_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $result->pre_icfes->start_date);
		Carbon\Carbon::setToStringFormat('d-n-Y ');

		$date = new App\Date();
		$date->setDate($start_date);
	?>

@section('panel_content')
	<div class="panel panelBox panelActivity">
		<header class="panel_header clearfix">
			<h4 class="pull-left">
				<i class="fa fa-book"></i>
				{{ "Resultado | ".$result->pre_icfes->name }}
			</h4>
			<a class="pull-right" ><i class="fa fa-clock-o"></i>{!! ' '.$start_date->diffForHumans() !!}</a >
		</header>
		<div class="container-fluid">
			<div class="profile_info">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h5>Informe individual de resultados</h5>
							</div>
							<div class="panel-body">
								<table class="table header_result">
									<tr>
										<td class="no_border">
											<img src="/img/logo_result.png">
										</td>
										<td class="no_border">
											<p>
											<strong>INFORME INDIVIDUAL DE RESULTADOS</strong></p>
											<p>Fecha de examne: {!! $date->getFullDate() !!}</p>
										</td>
									</tr>
								</table>
								<table class="table table-result table_des_name">
									<tr>
										<thead>
											<tr class="bg-row">
												<th>Número de registro</th>
												<th>Apellidos y nombres</th>
												<th>Tipo de documento</th>
												<th>Número de documento</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{!! $result->codigo_registro!!}</td>
												<td>{!! $student->last_name." ".$student->name !!}</td>
												<td>{!! $student->type_document!!}</td>
												<td>{!! $student->number_document!!}</td>
											</tr>
										</tbody>
									</tr>
									<tr>
										<thead>
											<tr class="bg-row">
												<th colspan="4">Institución</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="4">{!! $student->class_room->institution->name;!!}</td>
											</tr>
										</tbody>
									</tr>
								</table>
								<table class="table table-result">
									<thead>
										<tr class="bg-row">
											<th>Puntaje global</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{!! "<b>".$result->total_score." Puntos </b> de ".(count($result->pre_icfes->areas)*100)." posibles" !!}</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-bordered table-result">
									<thead>
										<tr class="bg-row">
											<th>Prueba</th>
											<th>Puntaje</th>
											<th>Nivel</th>
											<th>Desempeño</th>
										</tr>
									</thead>
									<tbody>
										@foreach($result->pre_icfes->areas as $area)
											@foreach($result['attributes'] as $key=> $value)
												<?php
													$area_result = str_replace('_', ' ', $key);
												?>
												@if($area_result == $area->name)
												<tr>
													<td>{!! $area_result !!}</td>
													<td>{!! $value !!}</td>
													<td></td>
													<td>
														@if($value >= 0 && $value < 36)
															{!! "insuficiente" !!}
														@elseif($value >= 36 && $value < 50)
															{!! "minimo" !!}
														@elseif($value >= 50 && $value < 65)
															{!! "sastifactorio" !!}
														@elseif($value >= 65 && $value <= 100)
															{!! "avanzado" !!}
														@endif
													</td>
												</tr>
												@endif
											@endforeach
										@endforeach
									</tbody>
								</table>
								<table class="table">
									<tr>
										<td>
											<div class="alert alert-info">
										    	<b>Observacion</b>    
    										</div>
										</td>
									</tr>
								</table>

								<div class="text-center">
									<a class="btn btn-primary" href="{{route('preicfes.showResultsPDF', $result->codigo_registro)}}" target="_blank">
										<i class="fa fa-eye"></i>
										 Descargar pdf
									</a>
									<a class="btn btn-primary" href="{{route('preicfes.showResultsPDF', $result->pre_icfes->id)}}">
										<i class="fa fa-download"></i>
										 Descargar pdf
									</a>
								</div>								
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Graficas
							</div>
							<div class="panel-body">
								<div id="contGraph">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Nivel de desempeño
							</div>
							<div class="panel-body">
								<div class="container-fluid">
									<table class="table table-performan text-center">
										<thead>
											<tr class="bg-row">
												<th class="text-center">Prueba</th>
												<th colspan="2" class="text-center">Nivel de desempeño</th>
											</tr>
										</thead>
										<tbody>
											@foreach($result->pre_icfes->areas as $area)
											<tr>
												<td width="20%">{!! ucfirst($area->name) !!}</td>
												@foreach($result['attributes'] as $key=> $value)
													<?php
														$area_result = str_replace('_', ' ', $key);
													?>
													@if($area_result == $area->name)
														@foreach($area->performance_level as $performance)
															@if($value >= $performance->min_score && $value <= $performance->max_score)

															<td width="10%" class="bg-gray">
																{!! "<b>".strtoupper($performance->level)."</b>" !!}
															</td>
															<td width="70%" class="description">
																{!! $performance->description !!}
															</td>
															@endif
														@endforeach
													@endif
												@endforeach
											</tr>	
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script>
		$(function(){
			Highcharts.chart('contGraph',{
				chart: {
	            type: 'column'
		        },
		        title: {
		            text: 'Interpretación de resultados mediante graficas'
		        },
		        subtitle: {
		            text: ''
		        },
		        xAxis: {
		            type: 'category'
		        },
		        yAxis: {
		            title: {
		                text: 'Total porcentaje de puntos posibles'
		            }
		        },
		        legend: {
		            enabled: false
		        },
		        plotOptions: {
		            series: {
		                borderWidth: 0,
		                dataLabels: {
		                    enabled: true,
		                    format: '{point.y} puntos'
		                }
		            }
		        },

		        tooltip: {
		            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
		            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> puntos<br/>'
		        },
		        series: [{
		        	name: 'Prueba',
            		colorByPoint: true,
            		data: [
            			@foreach($result->pre_icfes->areas as $area)
							@foreach($result['attributes'] as $key=> $value)
								<?php
									$area_result = str_replace('_', ' ', $key);
								?>
								@if($area_result == $area->name)
									{
										name: {!! "'".$area->name."'" !!},
										y: @if($value == null || $value == 0) 0 @else {!! $value !!} @endif,
										drilldown: {!! "'".$area->name."'" !!}
									},
								@endif
							@endforeach
						@endforeach
            		]
		        }]
			});
		});
	</script>
	<script src="{{asset('plugin/highcharts/highcharts.js')}}"></script>
	<script src="{{asset('plugin/highcharts/modules/data.js')}}"></script>
	<script src="{{asset('plugin/highcharts/modules/drilldown.js')}}"></script>
@endsection