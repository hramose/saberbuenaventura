<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('plugin/font-awesome/css/font-awesome.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('plugin/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/animate/animate.min.css') }}">
    <link href="{{ asset('css/default.css') }}" rel="stylesheet">

</head>
<body id="app-layout">
    {{-- Nav --}}
    <section class="section bg_white texto-encabezado section_img" id="home">
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
                            <li><a data-scroll href="#home">Inicio</a></li>
                            <li><a data-scroll href="#about">Acerca</a></li>
                            <li><a data-scroll href="#certificate">Certificado</a></li>
                            <li><a data-scroll href="#services">Servicios</a></li>
                            <li><a data-scroll href="#contact">Contactanos</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-12 col-sm-5">
                        <div class="div_center70 div_form">
                            <img src="{{ asset('img/saber.png') }}" class="img-responsive">
                            <h4>Inicia session para comenzar</h4>
                            <span id="error_message"></span>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                            @endif
                            <div class="">
                                {!! Form::open(['id'=>'login_form']) !!}
                                    <div class="form-group">
                                        {{-- <label>Perfil del usuario</label> --}}
                                        {!! Form::select('profile', ['student'=>'Estudiante', 'institution'=>'Institución'], null, ['class'=>'form-control', 'placeholder'=>'-Seleccione un perfil-', 'id'=>'profile']) !!}
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        {{-- <label for="email">Correo</label> --}}
                                        <input type="text" id="email" name="email" class="form-control" placeholder="correo electronico" value="{{old('email')}}">
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        {{-- <label for="password">Contraseña</label> --}}
                                        <input type="password" id="password" name="password" class="form-control" placeholder="contraseña">
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Iniciar sesión', ['class'=>'btn btn-primary full_with']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-7" >
                        <img src="{{ asset('img/bg_cover.png')}}" class="img-responsive wow fadeInRight">
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Seccion de acerca --}}
    <section class="section bg_white" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">Acerca</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">Misión</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>  
                <div class="col-md-6">
                    <h2 class="text-center">Visión</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- Otra section --}}
    <section class="section">
        <div class="container" id="certificate">
            <div class="row">
                <div class="col-md-7">
                    <div class="text_side_img ">
                        <h3>Resultados detallados</h3>
                        <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </p>
                        <div class="text-center">
                            <a href="{{ route('home.certificate') }}" class="btn btn-primary btn-lg">Descarga tu certificado</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="shortheigt">
                        <img src="{{asset('img/avatar7.png')}}" alt="" class="img-responsive wow fadeInUp">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 pm0">
                    <img src="{{asset('img/avatar5.png')}}" alt="" class="img-responsive wow fadeInLeft">
                </div>
                <div class="col-md-6">
                    <div class="text_side_img">
                        <h3>Graficas para una mejor compresion</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-1">
                    <div class="text_side_img">
                        <h3>Gestionamos la seguridad de nuestros usuasrios</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </p>
                    </div>
                </div>
                <div class="col-md-5 pm0">
                    <img src="{{asset('img/avatar4.png')}}" alt="" class="img-responsive wow fadeInRight">
                </div>
            </div>
        </div>
    </section>
    {{-- Servicios --}}
    <section class="section section_img servicios " id="services">  
        <div class="container">
            <h2 class="text-center">Servicios</h2>
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="circle_cont bg_primary"> 
                        <i class="fa fa-gift fa-3x"></i>
                    </div>
                    <h5 class="uppercase bold">Pruebas 100% gratis</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                    </p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="circle_cont bg_primary"> 
                        <i class="fa fa-bar-chart fa-3x"></i>
                    </div>
                    <h5 class="uppercase bold">Reportes estadisticos</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                    </p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="circle_cont bg_primary"> 
                        <i class="fa fa-random fa-3x"></i>
                    </div>
                    <h5 class="uppercase bold">Preguntas aleatorias</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                    </p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="circle_cont bg_primary"> 
                        <i class="fa fa-clock-o fa-3x"></i>
                    </div>
                    <h5 class="uppercase bold">Resultados al instante</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- Contactanos --}}
    <section class="section bg_white" id="contact">
        <div class="container">
            <div class="col-md-6">
                {!! Form::open(['route' => 'mail.contact', 'method'=> 'POST', 'class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        <label for="name_contact" class="col-sm-4 control-label">Nombre</label>
                        <div class="col-sm-8">
                            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'nombre', 'id'=>'name_contact']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email_contact" class="col-sm-4 control-label">Correo electronico</label>
                        <div class="col-sm-8">
                            {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Correo electronico', 'id'=>'email_contact']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject_contact" class="col-sm-4 control-label">Asunto</label>
                        <div class="col-sm-8">
                            {!! Form::text('subject', null, ['class'=>'form-control', 'placeholder'=>'Asunto', 'id'=>'subject_contact']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message_contact" class="col-sm-4 control-label">Mensaje</label>
                        <div class="col-sm-8">
                            {!! Form::textarea('message_contact', null, ['class'=>'form-control', 'placeholder'=>'asunto', 'id'=>'message_contact']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            {!! Form::submit('Enviar mensaje', ['class'=>'btn btn-primary full_with']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-6">
                <div class="div_contact text-center">
                    <h1><i class="fa fa-envelope-o fa-5x"></i></h1>
                    <h3>Contactanos</h3>
                    <p>Estamos listo para ayudarte</p>
                </div>
            </div>
        </div>
    </section>
    {{-- Mapa --}}
    <section class="section pm0">
        <div id="map" style="height: 340px;width: 100%;">
            
        </div>
    </section>

    @include('footer')

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ asset('plugin/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('plugin/wow/wow.min.js') }}"></script>
    <script src="{{ asset('plugin/smoothscroll/smooth-scroll.min.js') }}"></script>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7PoIbodBnsle2ut8VJsh1g8qOjQ0MMy4&callback=initMap">
    </script>
    <script type="text/javascript">
        var map,
        myLatLng = {lat: 3.881519,lng: -77.010596};

        function initMap() {
              
            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 15,
                disableDefaultUI: true,
                scrollwheel: false
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Ubicanos',
            });
        }
        new WOW().init();
        smoothScroll.init();
    </script>
    <script type="text/javascript" src="{{ asset('js/index.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
