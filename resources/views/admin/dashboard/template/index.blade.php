<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>@yield('title')</title>

      <!-- Bootstrap -->
      <link href="{{ asset('plugin/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
      <link href="{{ asset('plugin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/default.css')}}" rel="stylesheet">
      @yield('css')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
   <body>
      <div class="container-fluid display-table">
         <div class="row display-table-row">
            <div class="col-md-2 display-table-cell valign-top" id="sidebar">
               @include('admin.dashboard.template.sidebar')
            </div>
            <div class="col-md-10 display-table-cell valign-top">
               <div class="row">
                  @include('admin.dashboard.template.header')
               </div>
               <div class="row">
                  <div class="container">
                    @yield('breadcrums')
                    @yield('content')
                  </div>
               </div>
               <div class="row">
                  <footer id="footerAd" class="clearfix">
                     @include('admin.dashboard.template.footer')
                  </footer>
               </div>
            </div>
         </div>
      </div>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="{{ asset('plugin/jquery/jquery.min.js') }}"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="{{ asset('plugin/bootstrap/js/bootstrap.min.js') }}"></script>
      @yield('js')
   </body>
</html>