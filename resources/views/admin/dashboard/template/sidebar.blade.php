<h1>Navigation</h1>
<ul id="sidebar">
	<li class="active">
		<a href="{{ route('admin.main') }}">
			<span class="glyphicon glyphicon-th"></span>
			<span>Inicio</span>
		</a>
	</li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#instituosM">
	    	<span class="fa fa-institution"></span>
    		<span>Institutos</span>	
    	</a>
        <ul id="instituosM" class="collapse collapseable">
            <li><a href="{{ route('admin.institution.create') }}">Crear</a></li>
            <li><a href="{{ route('admin.institution.index') }}">Ver</a></li>
        </ul>
    </li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#AreasM">
    		<span class="fa fa-book"></span>
    		<span>Areas</span>	
    	</a>
        <ul id="AreasM" class="collapse collapseable">
        	<li><a href="{{ route('admin.area.create') }}">Crear</a></li>
            <li><a href="{{ route('admin.area.index') }}">Ver</a></li>
        </ul>
    </li>
    <li class="link"> 
        <a data-toggle="collapse" data-parent="#sidebar" href="#Desempe">
            <span class="fa fa-level-up"></span>
            <span>Nivel de desempeño</span>  
        </a>
        <ul id="Desempe" class="collapse collapseable">
            <li><a href="{{ route('admin.performance.create') }}">Crear</a></li>
            <li><a href="{{ route('admin.performance.index') }}">Ver</a></li>
        </ul>
    </li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#AsignaturasM">
    		<span class="fa fa-bookmark"></span>
    		<span>Asignaturas</span>	
    	</a>
        <ul id="AsignaturasM" class="collapse collapseable">
            <li><a href="{{ route('admin.asignature.create') }}">Crear</a></li>
            <li><a href="{{ route('admin.asignature.index') }}">Ver</a></li>
        </ul>
    </li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#CompetenciasM">
    		<span class="fa fa-graduation-cap"></span>
    		<span>Competencias</span>	
    	</a>
        <ul id="CompetenciasM" class="collapse collapseable">
        	<li><a href="{{ route('admin.competence.create') }}">Crear</a></li>
            <li><a href="{{ route('admin.competence.index') }}">Ver</a></li>
        </ul>
    </li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#ReferenciasM">
    		<span class="fa fa-copyright"></span>
    		<span>Referencias / Citas</span>	
    	</a>
        <ul id="ReferenciasM" class="collapse collapseable">
        	<li><a href="{{ route('admin.author.create') }}">Crear</a></li>
            <li><a href="{{ route('admin.author.index') }}">Ver</a></li>
        </ul>
    </li>
    <li class="link"> 
    	<a data-toggle="collapse" data-parent="#sidebar" href="#PreguntasM">
    		<span class="fa fa-question"></span>
    		<span>Preguntas</span>	
    	</a>
        <ul id="PreguntasM" class="collapse collapseable">
        	<li><a href="{{ route('admin.question.create') }}">Crear</a></li>
            <li><a href="{{ route('admin.question.index') }}">Ver</a></li>
        </ul>
    </li>
</ul>