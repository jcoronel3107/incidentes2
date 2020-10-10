	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Estaciones de Bomberos</h2>
		@if(Session::has('Registro_Borrado'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			{{session('Registro_Borrado')}}
			<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Registro_Actualizado'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{session('Registro_Actualizado')}}
			<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Registro_Almacenado'))
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			{{session('Registro_Almacenado')}}
			<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif

		<ul class="nav justify-content-end">
		  <li class="nav-item">
		      <a class="btn btn-outline-danger" href="estacion/create">Nuevo</a>
		      <a class="btn btn-outline-success" href="stations/export/">Exporta Excel</a>
		    </li>
		</ul>
<hr style="border:2px;">
@include('estacion.search')
		<table class="table table-hover">
			<thead>
				<tr>
					<td>id</td>
					<td>Nombre_Estacion</td>
					<td>created_at</td>
					<td>updated_at</td>

			</thead>
			<tbody>
				@foreach($estaciones as $estacion)
				<tr>
					<td><a href="{{route('estacion.edit',$estacion->id)}}">{{$estacion->id}}</a>
					</td>
					<td>{{$estacion->nombre}}&nbsp;</td>
					<td>{{$estacion->created_at}}&nbsp;</td>
					<td>{{$estacion->updated_at}}&nbsp;</td>

				</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		{{ $estaciones -> appends(['searchText' => $query]) -> links() }}
	@endsection @section( "piepagina" )@endsection