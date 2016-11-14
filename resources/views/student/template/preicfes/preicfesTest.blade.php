@extends('student.template.preicfes.testTemplate')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/elements-forms.css')}}">
@endsection

@section('panel_content')
	<div class="panelBox panelActivity">
		<header class="panel_header clearfix">
			<h4 class="pull-left">
				Prueba de 
				{{ $area }}
			</h4>
			<a href="{{ route('preicfes.description', $pre_icfes_id) }}" class="pull-right btn btn-primary btn-xs">Ver Prueba</a>
		</header>
		<div class="paginator text-center">
			<ul class="pagination" id="pagination-demo">

			</ul>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div id="page-content" class="col-md-12 page-content">
					{!! Form::open(['id'=>'formtest']) !!}
					{{-- {{ dd($questions) }} --}}
						@foreach($questions as $question)
							{{-- start quiz --}}
							@if($action == 'insert')
								<div class="question hidden">
									<div class="question_description">
										{!! $question->description !!}
									</div>
									<div class="question_options">
										@foreach($question->options as $option)
											<div class="form-group content_question radio">
												{!! Form::radio("anwser[$question->id][]", null, false, ['id'=>'option_'.$option->id]) !!}
												{!! Form::label('option_'.$option->id, $option->option, ['class'=>'radio_label uncheck', 'data-info'=>$option->id.'-'.$question->id, 'id'=>'q'.$question->id]) !!}
											</div>
										@endforeach
									</div>
							</div>
							@elseif($action == 'update')
								@if($question->question->asignature->area_id == $area_id)
								<div class="question hidden">
									<div class="question_description">
										{!! $question->question->description !!}
									</div>
									<div class="question_options">
										{{-- {{ dd($question) }} --}}
										@foreach($question->question->options as $option)
												{{-- {{$option->option}} --}}
											<div class="form-group content_question radio">
												@if($option->id == $question->option_id)
													{!! Form::radio("anwser[$question->id][]", null, true, ['id'=>'option_'.$option->id]) !!}
													{!! Form::label('option_'.$option->id, $option->option, ['class'=>'radio_label check', 'data-info'=>$option->id.'-'.$question->question->id.'-'.$question->id, 'id'=>'q'.$question->id]) !!}
												@else
													{!! Form::radio("anwser[$question->id][]", null, false, ['id'=>'option_'.$option->id]) !!}
													{!! Form::label('option_'.$option->id, $option->option, ['class'=>'radio_label uncheck', 'data-info'=>$option->id.'-'.$question->question->id.'-'.$question->id, 'id'=>'q'.$question->id]) !!}
												@endif
											</div>
										@endforeach
									</div>
								</div>
								@endif
							@endif
							{{-- end quiz --}}
						@endforeach
					{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 page-content text-center">
					<button class="btn btn-success" id="sendtest">Terminar prueba</button>
				</div>
			</div>
		</div>
	</div>
	@if($action == 'insert')
	{!! Form::open(['route' => 'preicfes.saveAnwser', 'method'=> 'POST', 'id'=>'formTest']) !!}
	@else
	{!! Form::open(['route' => 'preicfes.updateAnwser', 'method'=> 'POST', 'id'=>'formTest']) !!}
	@endif
		{!! Form::hidden('anwser', null, ['id'=>'anwser']) !!}
		{!! Form::hidden('pre_icfes_id', $pre_icfes_id, []) !!}
		{!! Form::hidden('asignature', $area, []) !!}
		{!! Form::hidden('area_id', $area_id, []) !!}
		{!! Form::hidden('action', $action, []) !!}
	{!! Form::close() !!}
@endsection

@section('js')
	<script src="{{asset('plugin/paginator/jquery.twbsPagination.js')}}"></script>
	<script src="{{asset('js/testPreicfes.js')}}"></script>
@endsection