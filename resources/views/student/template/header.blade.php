<nav class="navbar navbar-default navbar-fixed-top navbar-primary">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
    	    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
        	</button>
            <a class="navbar-brand" href="#">
            	<img src="/img/mini_logo.png">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
	            <li><a href="#">{!! Auth()->guard('students')->user()->name.' '.Auth()->guard('students')->user()->last_name!!}</a></li>
	            <li class="dropdown">
	            	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></a>
	                <ul class="dropdown-menu">
	                  <li><a href="{{ route('student.about') }}">Editar información</a></li>
	                  <li role="separator" class="divider"></li>
	                  <li><a href="{{ route('student.logout') }}">Cerrar Session</a></li>
	                </ul>
	            </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>