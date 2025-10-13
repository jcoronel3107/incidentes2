	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Incidentes</h2>
		@include('incidente.messages')

		<ul class="nav justify-content-end">
			<li class="nav-item"  >
				<a class="btn btn-outline-danger" href="{{route('incidente.create')}}">{!! trans('messages.new') !!}</a>
				<a class="btn btn-outline-success" href="incidentes/export/">{!! trans('messages.export') !!}</a>
			</li>

		</ul>
		<hr>
		@include('incidente.search')
		<table class="table table-hover table-responsive">
			<thead>
				<tr class="table-info">
					<td>Id</td>
					<td>Tipo_Incidente</td>
					<td>Nombre_Incidente</td>
					<td>created_at</td>
					<td>Opciones</td>
				</tr>
			</thead>
			<tbody>
				@foreach($incidentes as $incidente)
					<tr>
						<td>{{$incidente->id}}</td>
						<td>{{$incidente->tipo_incidente}}</td>
						<td>{{$incidente->nombre_incidente}}</td>
						<td>{{$incidente->created_at}}</td>
						<td>
							<a class="btn btn-outline-danger btn-sm" href="{{route('incidente.edit',$incidente->id)}}" role="button">Edit</a>
						</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr class="table-info">
					<td>Id</td>
					<td>Tipo_Incidente</td>
					<td>Nombre_Incidente</td>
					<td>created_at</td>
					<td>Opciones</td>
				</tr>
			</tfoot>
		</table>
		<div class="row">
			{{ $incidentes -> appends(['searchText' => $query]) -> links() }}
		</div>	
		
		
	@endsection 
	@section( "piepagina" )
	@endsection