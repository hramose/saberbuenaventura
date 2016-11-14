@extends('admin.dashboard.template.1-column')

@section('page_title', 'Ver Referencias')

@section('btn-create')
	<a class="btn btn-xs btn-primary pull-right" href="{{ route('admin.author.create') }}">Crear Referencia</a>
@endsection

@section('breadcrums')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin.main') }}">Inicio</a></li>
	  <li class="active">Autores</li>
	</ol>
@endsection

@section('row')
	@include('complements.flash')
	<table class="table table-striped table-hover">
		<thead>
			<th>Origen</th>
			<th>Autor</th>
			<th>Año</th>
			<th>Acción</th>
		</thead>
		<tbody>	
			@foreach($authors as $author)
				<tr>
					<td><a href="{{ $author->link }}" target="_blank">{{ $author->source }}</a></td>
					<td>{{ $author->author }}</td>
					<td>{{ $author->year }}</td>
					<td>
						<a class="btn btn-info" title="Editar" href="{{ route('admin.author.edit', $author->id) }}"><i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger" title="Eliminar" href="{{ route('admin.author.destroy', $author->id) }}" onclick="return confirm('Desea eliminar este autor')"><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection