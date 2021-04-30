	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Consultar Información de Vehiculos</h2>
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
		    <a class="btn btn-outline-danger" href="vehiculo/create">Nuevo</a>
		    <a class="btn btn-outline-success" href="vehiculos/export/">Exporta Excel</a>
		    <a class="btn btn-outline-success" href="vehiculos/grafic/">Grafica</a>
		    <a class="btn btn-outline-success" href="/vehiculos/importar">Importar</a>

		  </li>
		</ul>
		<hr style="border:2px;">
		@include('vehiculo.search')
		<table class="table table-hover">
			<thead>
				<tr>
					<td>Codigodis</td>
					<td>Placa</td>
					<td>Marca</td>
					<td>Modelo</td>
					<td>Clase</td>
					<td>Motor</td>
					<td>Chasis</td>
					<td>Estado</td>
					<td>Opciones</td>
			</thead>
			<tbody>
				@foreach($vehiculos as $vehiculo)
				<tr>
					<td>{{$vehiculo->codigodis}}&nbsp;</td>
					<td>{{$vehiculo->placa}}&nbsp;</td>
					<td>{{$vehiculo->marca}}&nbsp;</td>
					<td>{{$vehiculo->modelo}}&nbsp;</td>
					<td>{{$vehiculo->clase}}&nbsp;</td>
					<td>{{$vehiculo->motor}}&nbsp;</td>
					<td>{{$vehiculo->chasis}}&nbsp;</td>
					<td>{{$vehiculo->activo}}&nbsp;</td>
					<td>
						<a class="btn btn-outline-danger btn-sm" href="{{route('vehiculo.edit',$vehiculo->id)}}" role="button">Edit</a>
						<a class="btn btn-outline-info btn-sm" href="{{route('vehiculo.show',$vehiculo->id)}}" role="button">Ver</a>
					</td>
				</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		{{ $vehiculos -> appends(['asc' => request('asc')]) -> links() }}

@endsection @section( "piepagina" ) @endsection