{{-- Footer --}}
<section class="section bg_primary">
    <div class="container">
        <div class="col-md-4">
            <img src="{{ asset('img/saber.png')}}" alt="" class="img-responsive">
        </div>
        <div class="col-md-2">
            <ul class="list-unstyled">
                <li><span class="uppercase bold">nosotros</span></li>
                <li><a data-scroll href="{{ url('/#home')}}">Inicio</a></li>
                <li><a data-scroll href="{{ url('/#about')}}">Acerca</a></li>
                <li><a data-scroll href="{{ url('/#certificate')}}">Certificado</a></li>
                <li><a data-scroll href="{{ url('/#services')}}">Servicios</a></li>
                <li><a data-scroll href="{{ url('/#contact')}}">Contactanos</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <address>
                <strong class="uppercase">información de contacto</strong>

                    <span><i class="fa fa-map-marker"></i> Buenaventura - Av simon Bolivar Km9 - Universidad del valle (sede pacifico)</span>
                        
                    <span><i class="fa fa-phone"></i> 24 15325 - 3206534710</span>

                    <span><i class="fa fa-envelope"></i><a href="malito:saberbuenaventura@gmail.com"> saberbuenaventura@gmail.com</a></span>
            </address>                
        </div>
        <div class="col-md-3">
                        
            <ul class="list-unstyled">
                <li class="uppercase bold"><span>Redes sociales</span></li>
                <li>
                    <a href="https://www.facebook.com/saberbuenaventura/" target="_blank">
                       <i class="fa fa-facebook-official fa-lg"></i> /saberbuenaventura
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/saberbuenaventura/" target="_blank">
                        <i class="fa fa-youtube-play fa-lg"></i> saberbuenaventura
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/saberbuenaventura/" target="_blank">
                        <i class="fa fa-twitter fa-lg"></i> @saberbuenaventura
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
    {{-- lastfooter --}}
    <section class="section bg_darkprimary text-center lastfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span>Saberbuenaventura © <?php echo date('Y');?></span>
                </div>
            </div>
        </div>
    </section>