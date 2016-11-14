@extends('student.template.profile.index')

@section('panel_content')
	<div class="">
		{{-- @include('complements.errors') --}}
		<div class="panel panelBox panel-card">
			<header class="panel_header">
				<h3>
					<i class="fa fa-lock"></i>
					Editar contraseña
				</h3>
			</header>
			<div class="container-fluid">
				{!! Form::open(['route' => ['student.student.update', $student], 'method'=> 'PUT']) !!}
					<div class="row">
						{!! Form::hidden('request', 'changePass', []) !!}
						<div class="col-md-8">
							<div class="form-group">
								{!! Form::label('current_password', 'Contraseña actual', []) !!}
								{!! Form::password('current_password', ['class'=>'form-control']) !!}
								@if (Session::has('message'))
									<div class="text-danger">
										{{Session::get('message')}}
									</div>
								@endif
								<div class="text-danger">{{$errors->first('current_password')}}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								{!! Form::label('password', 'Nueva contraseña', []) !!}
								{!! Form::password('password', ['class'=>'form-control']) !!}
								<div class="text-danger">{{$errors->first('password')}}</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								{!! Form::label('password_confirmation', 'Confirmar contraseña', []) !!}
								{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
								<div class="text-danger">{{$errors->first('password_confirmation')}}</div>
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						{!! Form::submit('Actualizar contraseña', ['class'=>'btn btn-primary']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection