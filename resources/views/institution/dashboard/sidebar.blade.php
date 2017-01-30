<h1>Navigation</h1>
<ul id="sidebar">
	<li class="active">
		<a href="{{ route('institution.main') }}">
			<span class="glyphicon glyphicon-th"></span>
			<span>Inicio</span>
		</a>
	</li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#instituosM">
	    	<span class="fa fa-institution"></span>
    		<span>Salones de clases</span>	
    	</a>
        <ul id="instituosM" class="collapse collapseable">
            <li><a href="{{ route('institution.classroom.create') }}">Crear</a></li>
            <li><a href="{{ route('institution.classroom.index') }}">Ver</a></li>
        </ul>
    </li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#AreasM">
    		<span class="fa fa-users"></span>
    		<span>Alumnos</span>	
    	</a>
        <ul id="AreasM" class="collapse collapseable">
        	<li><a href="{{ route('institution.student.create') }}">Crear</a></li>
            <li><a href="{{ route('institution.student.index') }}">Ver</a></li>
        </ul>
    </li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#AsignaturasM">
    		<span class="fa fa-book"></span>
    		<span>Pre-ICFES</span>	
    	</a>
        <ul id="AsignaturasM" class="collapse collapseable">
            <li><a href="{{ route('institution.preicfes.create') }}">Crear</a></li>
            <li><a href="{{ route('institution.preicfes.index') }}">Ver</a></li>
        </ul>
    </li>   
</ul>