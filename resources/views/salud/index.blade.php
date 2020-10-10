	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Información de Salud</h2>
		@if(Session::has('Envio Mail Correcto'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{session('Envio Mail Correcto')}}
			<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Importacion_Correcta'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{session('Importacion_Correcta')}}
			<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
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
		<div class="alert alert-success alert-dismissible fade show" role="alert">
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
		  	@can('create evento')
		  	<a class="btn btn-outline-info" data-toggle="tooltip" title="Nuevo" href="salud/create"><i class="icon-plus icon-2x"></i></a>
		  	@endcan
		    @can('allow export')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Export" href="saluds/export/"><i class="icon-download-alt icon-2x"></i></a>
		    @endcan
		    @can('allow import')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Import" href="/saluds/importar"><i class="icon-cloud-upload icon-2x"></i></a>
		    @endcan
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Estadistica" href="saluds/grafic/"><i class="icon-filter icon-2x"></i> </a>
		  </li>

		</ul>
		<hr style="border:2px;">
		@include('salud.search')
		<table class="table table-hover table-condensed">
			<thead>
				<tr class="table-primary">

					<th>Incidente</th>
					<th>Estacion</th>
					<th>Fecha</th>
					<th>Direccion</th>
					<th>Ficha_Ecu911</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($saluds as $salud)
				<tr>

					<td>{{$salud->incidente->nombre_incidente}}</td>
					<td>{{$salud->station->nombre}}</td>
					<td>{{$salud->fecha}}</td>
					<td>{{$salud->direccion}}</td>
					<td>{{$salud->ficha_ecu911}}</td>
					<td>
						@can('edit evento')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('salud.edit',$salud->id)}}"><i class="icon-edit"></i></a>
						@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('salud.show',$salud->id)}}" role="button"><i class="icon-search"></i></a>
						@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Enviar" href="{{action('MailController@SendMailsSalud', $salud->id)}}" role="button"><i class="icon-envelope"></i></a>
						@endcan
						@can('create pdf')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('SaludController@downloadPDF', $salud->id)}}" role="button"><i class="icon-file-text"></i></a>
						@endcan


				</tr>
				@endforeach

			</tbody>
			<tfoot>
				<tr class="table-primary">
					<td>Incidente</td>
					<td>Estacion</td>
					<td>Fecha</td>
					<td>Direccion</td>
					<td>Ficha_Ecu911</td>
					<td>Opciones</td>
				</tr>
			</tfoot>
		</table>
		{{ $saluds -> appends(['searchText' => $query]) -> links() }}

@endsection @section( "piepagina" ) @endsection