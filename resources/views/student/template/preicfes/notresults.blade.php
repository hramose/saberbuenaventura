@extends('student.template.preicfes.testTemplate')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/results.css')}}">
@endsection

	<?php

		$start_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $result->start_date);
		Carbon\Carbon::setToStringFormat('d-n-Y ');

		$date = new App\Date();
		$date->setDate($start_date);
	?>

@section('panel_content')
	<div class="panel panelBox panelActivity">
		<header class="panel_header clearfix">
			<h4 class="pull-left">
				<i class="fa fa-book"></i>
				{{ "Resultado | ".$result->name }}
			</h4>
			<a class="pull-right" ><i class="fa fa-clock-o"></i>{!! ' '.$start_date->diffForHumans() !!}</a >
		</header>
		<div class="container-fluid">
			<div class="profile_info">
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-danger">
							<p>
								Los sentimos pero estas <b>Sin resultados</b>, puede que haya sucedio algunas de las siguientes opciones:
							</p>
							<br>
							<ul>
								<li>El usuario no respondio ninguna pregunta antes del tiempo estipulado.</li>
								<li>El usuario no guardo ninguna pregunta resuelta antes de que el tiempo limite llegara a su fin.</li>
							</ul>
							<br>
							<p>
								<b>NOTA:</b> el estudiante sin resultados figura como un estudiante que no realizo la prueba, para solucionar este problema consulte con su institución.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')

@endsection