	<div class="infostudent">
		<address>
			<span>{!! $student->type_document.' : '.$student->number_document !!}</span>
			<span>Nombre : {!! $student->name.' '.$student->last_name !!}</span>
		</address>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Institución</th>
				<th>PreICFES</th>
				<th>Fecha</th>
				<th>Accion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($student->results->sortByDesc('id') as $resul)
				<?php

					$start_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $resul->pre_icfes->start_date);
					Carbon\Carbon::setToStringFormat('d-n-Y ');

					$date = new App\Date();
					$date->setDate($start_date);
				?>
				<tr>
					<td>{!! $resul->codigo_registro !!}</td>
					<td>{!! $student->class_room->institution->name!!}</td>
					<td>{!! $resul->pre_icfes->name!!}</td>
					<td>{!! $date->getFullDate()!!}</td>
					<td><a href="{{ route('preicfes.showResultsPDF', $resul->codigo_registro)}}" class="btn btn-primary" target="_blank">Descargar</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>