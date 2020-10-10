	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Estación Servicio</h2>
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
		     <a class="btn btn-outline-danger" href="gasolinera/create">Nuevo</a>
		      <a class="btn btn-outline-success" href="inundacions/export/">Exporta Excel</a>
		 </li>
		</ul>
		<hr style="border:2px;">
		@include('gasolinera.search')
		<table class="table table-hover ">
			<thead>
				<tr>
					<td>RazonSocial</td>
					<td>Ruc</td>
					<td>Direccion</td>
					<td>Email</td>
					<td>Opciones</td>
				<tr>
			</thead>
			<tbody>
				@foreach($gasolineras as $gasolinera)
				<tr>
					<td>{{$gasolinera->razonsocial}}</td>
					<td>{{$gasolinera->ruc}}</td>
					<td>{{$gasolinera->direccion}}</td>
					<td>{{$gasolinera->email}}</td>
					<td><a class="btn btn-outline-danger btn-sm" href="{{route('gasolinera.edit',$gasolinera->id)}}" role="button">Edit</a>
						<a class="btn btn-outline-info btn-sm" href="{{route('gasolinera.show',$gasolinera->id)}}" role="button">Ver</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $gasolineras -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection