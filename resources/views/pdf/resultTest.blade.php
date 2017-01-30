<?php

	$start_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $result->pre_icfes->start_date);
	Carbon\Carbon::setToStringFormat('d-n-Y ');

	$date = new App\Date();
	$date->setDate($start_date);
?>
<!DOCTYPE html>
<html>
<head>
	<title>{!! $result->codigo_registro!!}</title>
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/default.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/results.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/resultpdf.css')}}">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<div class="paper1">
		<table class="table header_result">
			<tbody>
				<tr>
					<td width="40%">
						<img class="img-responsive" src="{{asset('img/logo_result.png')}}">
					</td>	
					<td width="60%">
						<p style="margin-bottom:0px;">
							<strong>INFORME INDIVIDUAL DE RESULTADOS</strong>
						</p>
						<p style="margin-top: 0px;font-size: 14px">Fecha de examne: {!! $date->getFullDate() !!}</p>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-result table_des_name">
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
		</table>
		<table class="table table-result table_des_name">
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
		</table>
		<table class="table table-result">
			<thead>
				<tr class="bg-row">
					<th>Puntaje global</th>
					<th>Maximo puntaje posible</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{!! "<b>".$result->total_score."</b>" !!}</td>
					<td>{!! (count($result->pre_icfes->areas)*100) !!}</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-responsive table-bordered table-result">
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
		<div class="text-center">
			<p>
				Extiendo este documento a solicitud del interesado(a), a los {!! $date->getActualyDay() !!} día(s) del mes de {!! $date->getActualyMonth() !!} del año {!! $date->getActualyYear() !!}
			</p>
			<p>
				Para consultar la veracidad de este documento presente ingrese a
			</p>
			<p>
				<a href="/cerfificate" target="_blank">www.saberbuenaventura.co/certificados</a>
				y digite el número de registro <b>{!! $result->codigo_registro!!}</b>
			</p>
			<p>
				Para mas información puede contactarnos en <a href="#">saberbuenaventura@gmail.com</a>
			</p>
		</div><br><br><br><br>
	</div>
	<div class="paper2">
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
</body>
</html>