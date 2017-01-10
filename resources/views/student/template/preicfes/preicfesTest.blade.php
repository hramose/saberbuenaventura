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
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="alert alert-warning text-center" style="width: 70%;margin:10px auto;">
						<p>
							<i class="fa fa-clock-o"></i>
							<span id="countdown"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
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
												@if($option->option_type == 'image')
													<label for="option_{{$option->id}}" class="radio_label uncheck" data-info="{{$option->id.'-'.$question->id}}" id="q{{$question->id}}">
														<img src="{{asset('img/options/'.$option->option)}}">
													</label>
												@else
													{!! Form::label('option_'.$option->id, $option->option, ['class'=>'radio_label uncheck', 'data-info'=>$option->id.'-'.$question->id, 'id'=>'q'.$question->id]) !!}
												@endif
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
										@foreach($question->question->options as $option)
											<div class="form-group content_question radio">
												@if($option->id == $question->option_id)
													{!! Form::radio("anwser[$question->id][]", null, true, ['id'=>'option_'.$option->id]) !!}
													@if($option->option_type == 'image')
														<label for="option_{{$option->id}}" class="radio_label check" data-info="{{$option->id.'-'.$question->question->id.'-'.$question->id}}" id="q{{$question->id}}">
															<img src="{{asset('img/options/'.$option->option)}}">
														</label>
													@else
														{!! Form::label('option_'.$option->id, $option->option, ['class'=>'radio_label check', 'data-info'=>$option->id.'-'.$question->question->id.'-'.$question->id, 'id'=>'q'.$question->id]) !!}
													@endif
												@else
													{!! Form::radio("anwser[$question->id][]", null, false, ['id'=>'option_'.$option->id]) !!}
													@if($option->option_type == 'image')
														<label for="option_{{$option->id}}" class="radio_label uncheck" data-info="{{$option->id.'-'.$question->question->id.'-'.$question->id}}" id="q{{$question->id}}">
															<img src="{{asset('img/options/'.$option->option)}}">
														</label>
													@else
														{!! Form::label('option_'.$option->id, $option->option, ['class'=>'radio_label uncheck', 'data-info'=>$option->id.'-'.$question->question->id.'-'.$question->id, 'id'=>'q'.$question->id]) !!}
													@endif
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
	<script>

		var id_pre = {!! $preicfes->id !!};
		var targetD = {!! strtotime($preicfes->end_date) !!}

		$('#pagination-demo').twbsPagination({
		    totalPages: 25,
		    visiblePages: 7,
		    first: 'Primero',
		    prev: 'Anetrior',
		    next: 'Siguiente',
		    last: 'Ulitmo',
		    onPageClick: function (event, page) {
		      	var questionAll 	= $('.question'),
		       		questionContent	= $('#question_'+page);

			       	questionAll.addClass('hidden');
			      	questionContent.removeClass('hidden');
			}
		});
	</script>
	<script src="{{asset('js/countdown.js')}}"></script>
@endsection