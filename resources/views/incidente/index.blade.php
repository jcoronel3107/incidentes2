	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Incidentes</h2>
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
  <li class="nav-item"  >
  	<a class="btn btn-outline-danger" href="{{route('incidente.create')}}">Nuevo</a>
    <a class="btn btn-outline-success" href="incidentes/export/">Exporta Excel</a>
  </li>

</ul>
<hr style="border:2px;">
@include('/incidente.search')
		<table class="table table-hover">
			<thead>
				<tr>
					<td>Tipo_Incidente</td>
					<td>Nombre_Incidente</td>
					<td>created_at</td>
					<td>updated_at</td>
					<td>Opciones</td>
				</tr>
			</thead>
			<tbody>
				@foreach($incidentes as $incidente)
				<tr>
					<td>{{$incidente->tipo_incidente}}&nbsp;</td>
					<td>{{$incidente->nombre_incidente}}&nbsp;</td>
					<td>{{$incidente->created_at}}&nbsp;</td>
					<td>{{$incidente->updated_at}}&nbsp;</td>
					<td>
						<a class="btn btn-outline-danger btn-sm" href="{{route('incidente.edit',$incidente->id)}}" role="button">Edit</a>
						{{-- <a class="btn btn-outline-info btn-sm" href="{{route('incidente.show',$incidente->id)}}" role="button">Ver</a> --}}
					</td>

				</tr>
				@endforeach

			</tbody>
		</table>
		{{ $incidentes -> appends(['searchText' => $query]) -> links() }}
	@endsection @section( "piepagina" )@endsection