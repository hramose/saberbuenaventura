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
						@if($action == 'insert')
							{{-- Part 1 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part1[0]->description !!}
								</div>
								@foreach($part1 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="question_description">
													{!! $question->description !!}
												</div>
											</div>
											<div class="col-md-6">
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
										</div>
									</div>
									<hr>
								@endforeach
							</div>

							{{-- Part 2 --}}
							<div class="question hidden">
								@foreach($part2 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="question_description">
													{!! $question->description !!}
												</div>
											</div>
											<div class="col-md-6">
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
										</div>
									</div>
								@endforeach
							</div>

							{{-- Part 3 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part3[0]->description !!}
								</div>
								@foreach($part3 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="question_description">
													{!! $question->description !!}
												</div>
											</div>
											<div class="col-md-6">
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
										</div>
									</div>
									<hr>
								@endforeach
							</div>

							{{-- Part 4 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part4[0]->description !!}
								</div>
								@foreach($part4 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-1">
												<div class="question_description form-group" style="margin-top: 15px;">
													{!! $question->description !!}
												</div>
											</div>
											@foreach($question->options as $option)
												<div class="form-group radio col-md-2">
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
									<hr>
								@endforeach
							</div>

							{{-- Part 5 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part5[0]->description !!}
								</div>
								@foreach($part5 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="question_description">
													{!! $question->description !!}
												</div>
											</div>
											<div class="col-md-6">
												<div class="question_options">
													@foreach($question->options as $option)
														<div class="form-group content_question radio">
															{!! Form::radio("anwser[$question->id][]", null, false, ['id'=>'option_'.$option->id]) !!}
															@if($option->option_type == 'image' && $option->option != null)
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
										</div>
									</div>
									<hr>
								@endforeach
							</div>

							{{-- Part 6 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part6[0]->description !!}
								</div>
								@foreach($part6 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-12">
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
										</div>
									</div>
									<hr>
								@endforeach
							</div>

							{{-- Part 7 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part7[0]->description !!}
								</div>
								@foreach($part7 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-1">
												<div class="question_description form-group" style="margin-top: 15px;">
													{!! $question->description !!}
												</div>
											</div>
											@foreach($question->options as $option)
												<div class="form-group radio col-md-2">
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
									<hr>
								@endforeach
							</div>

						@elseif($action == 'update')
							{{-- Part 1 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part1[0]->description !!}
								</div>
								@foreach($part1 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="question_description">
													{!! $question->question->description !!}
												</div>
											</div>
											<div class="col-md-6">
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
										</div>
									</div>
									<hr>
								@endforeach
							</div>

							{{-- Part 2 --}}
							<div class="question hidden">
								@foreach($part2 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="question_description">
													{!! $question->question->description !!}
												</div>
											</div>
											<div class="col-md-6">
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
										</div>
									</div>
								@endforeach
							</div>

							{{-- Part 3 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part3[0]->question->description !!}
								</div>
								@foreach($part3 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="question_description">
													{!! $question->question->description !!}
												</div>
											</div>
											<div class="col-md-6">
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
										</div>
									</div>
									<hr>
								@endforeach
							</div>

							{{-- Part 4 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part4[0]->question->description !!}
								</div>
								@foreach($part4 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-1">
												<div class="question_description form-group" style="margin-top: 15px;">
													{!! $question->question->description !!}
												</div>
											</div>
											@foreach($question->question->options as $option)
												<div class="form-group radio col-md-2">
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
									<hr>
								@endforeach
							</div>

							{{-- Part 5 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part5[0]->question->description !!}
								</div>
								@foreach($part5 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
												<div class="question_description">
													{!! $question->question->description !!}
												</div>
											</div>
											<div class="col-md-6">
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
										</div>
									</div>
									<hr>
								@endforeach
							</div>

							{{-- Part 6 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part6[0]->question->description !!}
								</div>
								@foreach($part6 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-12">
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
										</div>
									</div>
									<hr>
								@endforeach
							</div>

							{{-- Part 7 --}}
							<div class="question hidden">
								<div class="question_description_header">
									{!! $part7[0]->question->description !!}
								</div>
								@foreach($part7 as $question)
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-1">
												<div class="question_description form-group" style="margin-top: 15px;">
													{!! $question->question->description !!}
												</div>
											</div>
											@foreach($question->question->options as $option)
												<div class="form-group radio col-md-2">
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
									<hr>
								@endforeach
							</div>
						@endif
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
		    totalPages: 7,
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