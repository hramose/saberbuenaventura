<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Descargar certificado</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('plugin/font-awesome/css/font-awesome.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('plugin/bootstrap/css/bootstrap.css')}}">
    <link href="{{ asset('css/default.css') }}" rel="stylesheet">

</head>
<body id="app-layout">
	{{-- Nav --}}
    <section class="texto-encabezado">
        <header>
            <nav class="navbar navbar-default navbar-fixed-top navbar-primary">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="#">
                            <img src="/img/mini_logo.png">
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            <li><a data-scroll href="{{ url('/#home')}}">Inicio</a></li>
                            <li><a data-scroll href="{{ url('/#about')}}">Acerca</a></li>
                            <li><a data-scroll href="{{ url('/#certificate')}}">Certificado</a></li>
                            <li><a data-scroll href="{{ url('/#services')}}">Servicios</a></li>
                            <li><a data-scroll href="{{ url('/#contact')}}">Contactanos</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </section>

	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="div_center70">
						<h3 class="text-center">Consultar Certificado</h3>
						<hr>
						{!! Form::open(['id'=>'certificate_form']) !!}
							<div class="form-group">
								<label for="type_documnet">Tipo de documento</label>
								{!! Form::select('type_documnet', ['tarjeta de identidad'=>'Tarjeta de identidad', 'cedula de ciudadania'=>'Cedula de ciudadania'], null, ['class'=>'form-control', 'placeholder'=>'-Seleccione un tipo de documneto-']) !!}
							</div>
							<div class="form-group">
								<label for="number_document">Número de documento</label>
								{!! Form::text('number_document', null, ['class'=>'form-control', 'placeholder'=>'numero de documento de identidad']) !!}
							</div>
							<div class="form-group">
								{!! Form::submit('Consultar', ['class'=>'btn btn-primary full_with']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="container" id="table_container">
                               
                </div>
			</div>
		</div>
	</section>
	
	@include('footer')

	<script src="{{ asset('plugin/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/certificate.js')}}"></script>
</body>