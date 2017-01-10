@extends('student.template.profile.index')

@section('panel_content')
<div class="">
	<div class="panel panelBox panel-card">
		<header class="panel_header">
			<h4>
				<i class="fa fa-book"></i>
				Mis pruebas realizadas
			</h4>	
		</header>
		<div class="container-fluid">
			<div class="profile_info">
				@foreach($pre_icfess as $pre_icfes)
					<?php 
					
						$start_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pre_icfes->start_date);
						Carbon\Carbon::setToStringFormat('d-n-Y ');
					?>
					<div class="preicfes_test">
						<div class="clearfix">
							<h4 class="title_preicfes pull-left">{!! $pre_icfes->name !!}</h4>
							<a class="pull-right" ><i class="fa fa-clock-o"></i>{!! ' '.$start_date !!}</a >
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
								<a class="btn btn-default" href="{{ route('preicfes.showResults', $pre_icfes->id)}}">
									<i class="fa fa-eye"></i>
									Ver resultado
								</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection