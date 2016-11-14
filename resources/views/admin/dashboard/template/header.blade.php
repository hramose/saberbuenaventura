<header id="nav-header" class="clearfix">
    <div class="col-md-5">
        {!! Form::open() !!}
            {!! Form::text('header-search', null, ['id'=>'header-search' ,'placeholder'=>'Busca algo...']) !!}
        {!! Form::close() !!}
    </div>
    <div class="col-md-7">
        <ul class="pull-right">
            <li class="welcome">Bienvenido {{ Auth()->guard('admins')->user()->name.' '.Auth()->guard('admins')->user()->last_name}}</li>
            <li class="fixed-width">
                <a href="#">
                    <span class="glyphicon glyphicon-bell" arial-hidden="true"></span>
                    <span class="label label-warning">3</span>
                </a>
            </li>
            <li class="fixed-width">
                <a href="#">
                    <span class="glyphicon glyphicon-envelope" arial-hidden="true"></span>
                    <span class="label label-message">3</span>
    	        </a>
            </li>
            <li>
                <a href="{{ route('admin.logout') }}">
                    <span class="glyphicon glyphicon-log-out" arial-hidden="true"></span>
                    Cerrar Session
                </a>
            </li>
        </ul>
    </div>
</header>