	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Consultar Información de Parroquias</h2>
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
    <a class="btn btn-outline-danger" href="parroquia/create">{!! trans('messages.new') !!}</a>


    <a class="btn btn-outline-success" href="parroquias/export/">{!! trans('messages.export') !!}</a>


  </li>

</ul>
<hr style="border:2px;">
@include('/parroquia.search')
		<table class="table table-hover">
			<thead>
				<tr>
					<td>id</td>
					<td>nombre</td>
					<td>Postalcode</td>
					<td>created_at</td>
					<td>updated_at</td>
			</thead>
			<tbody>
				@foreach($parroquias as $parroquia)
				<tr>
					<td><a href="{{route('parroquia.edit',$parroquia->id)}}">{{$parroquia->id}}</a>
					</td>
					<td>{{$parroquia->nombre}}&nbsp;</td>
					<td>{{$parroquia->Postalcode}}&nbsp;</td>
					<td>{{$parroquia->created_at}}&nbsp;</td>
					<td>{{$parroquia->updated_at}}&nbsp;</td>

				</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		{{ $parroquias -> appends(['searchText' => $query]) -> links() }}
	@endsection @section( "piepagina" )@endsection