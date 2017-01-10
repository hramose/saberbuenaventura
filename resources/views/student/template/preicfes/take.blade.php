@extends('student.template.profile.index')

@section('panel_content')
<div class="">
	<div class="panel panelBox panel-card">
		<header class="panel_header">
			<h4>
				<i class="fa fa-calendar-check-o"></i>
				Mis pruebas pendientes
			</h4>	
		</header>
		<div class="container-fluid">
			<div class="profile_info">
				@foreach($pre_icfess as $pre_icfes)
					<?php 
						$start_date_preicfes = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pre_icfes->start_date);
						$end_date_preicfes = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pre_icfes->end_date);
						$date_now = Carbon\Carbon::now();

						$range_hour = $end_date_preicfes->hour - $start_date_preicfes->hour;
						$range_hour_now = $date_now->hour - $start_date_preicfes->hour;

						$range_minute = abs($end_date_preicfes->minute - $start_date_preicfes->minute);
						$range_minute_now = abs($date_now->minute - $start_date_preicfes->minute);

						// dd($range_minute);
					?>
					<div class="preicfes_test">
						<div class="clearfix">
							<h4 class="title_preicfes pull-left">{!! $pre_icfes->name !!}</h4>
							<a class="pull-right" ><i class="fa fa-clock-o"></i>{!! ' '.$start_date_preicfes->diffForHumans() !!}</a >
						</div>
						<div class="row">
							<div class="col-md-12">
								<h4>Descripción</h4>
								<div class="preicfes_description">
									{!! $pre_icfes->description !!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-9">
								@foreach($pre_icfes->areas as $area)
									<span class="label label-success fa-{!! substr($area->name, 0,3) !!}">{!! $area->name !!}</span></td>
								@endforeach
							</div>
							<div class="col-md-3">

								@if( ($date_now->isSameDay($start_date_preicfes)) && ($range_hour_now <= $range_hour) )
								
									@if( ($range_minute_now < $range_minute))
										<a href="{{ route('preicfes.description', $pre_icfes->id) }}" class="btn btn-primary pull-right">Realizar Prueba</a>

									@elseif( ($range_minute == 0) && ($range_minute_now > $range_minute) )
										<a href="{{ route('preicfes.description', $pre_icfes->id) }}" class="btn btn-primary pull-right">Realizar Prueba2</a>

									@elseif( ($range_minute == 30) && ($range_minute_now > $range_minute) )
										<a href="{{ route('preicfes.description', $pre_icfes->id) }}" class="btn btn-primary pull-right">Realizar Prueba 3</a>
									@endif
									
								@else
									<a class="btn btn-primary disabled pull-right">Realizar Prueba</a>
								@endif
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection