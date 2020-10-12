	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Consult Fire Information') !!}</h2>
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
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Nuevo" href="fuego/create"><i class="icon-plus icon-2x"></i></a>
		    @endcan
		    @can('allow export')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Export" href="incendios/export/"><i class="icon-download-alt icon-2x"></i></a>
		    @endcan
		    @can('allow import')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Import" href="/incendios/importar"><i class="icon-cloud-upload icon-2x"></i></a>
		    @endcan
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Estadistica" href="incendios/grafic/"><i class="icon-filter icon-2x"></i> </a>
		  </li>
		</ul>
		<hr style="border:2px;">
		@include('fuego.search')
		<table class="table table-hover table-condensed">
			<thead>
				<tr class="table-primary">
					<th>Incidente</th>
					<th>Estacion</th>
					<td>Fecha</td>
					<th>Direccion</th>
					<th>Ficha_Ecu911</th>
					<th>Created_at</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($incendios as $incendio)
				<tr>
					<td>{{$incendio->incidente->nombre_incidente}}</td>
					<td>{{$incendio->station->nombre}}</td>
					<td>{{$incendio->fecha}}</td>
					<td>{{$incendio->direccion}}</td>
					<td>{{$incendio->ficha_ecu911}}</td>
					<td>{{$incendio->created_at}}</td>
					<td>
					@can('edit evento')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('fuego.edit',$incendio->id)}}"><i class="icon-edit"></i></a>
					@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('fuego.show',$incendio->id)}}" role="button"><i class="icon-search"></i></a>
					@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="icon-envelope"></i></a>
					@endcan
					@can('create pdf')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('IncendioController@downloadPDF', $incendio->id)}}" role="button"><i class="icon-file-text"></i></a>
					@endcan
				</tr>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  		<div class="modal-dialog">
		   		<div class="modal-content">
		     		<form method="get" action="{{action('MailController@SendMailsIncendio', $incendio->id  )}}" class="form-horizontal">
			   	    <div class="modal-header">
			      		<h5 class="modal-title" id="exampleModalLabel">Destinatario</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			     	 <div class="modal-body">
			      		<div class="input-group mb-3">
			  			<div class="input-group-prepend">
			    				<span class="input-group-text" id="basic-addon1">@</span>
			  			</div>
			  				<input name="email" type="email" class="form-control" placeholder="example@bomberos.gob.ec" aria-label="Username" aria-describedby="basic-addon1">
						</div>
			      </div>
			      <div class="modal-footer">
			       	 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			       	 <button type="submit" class="btn btn-primary">Enviar</button>
			      </div>
		      </form>
		    </div>
		  </div>
			</div>
				@endforeach
			</tbody>
			<tfoot>
				<tr class="table-primary">
					<td>Incidente</td>
					<td>Estacion</td>
					<td>Fecha</td>
					<td>Direccion</td>
					<td>Ficha_Ecu911</td>
					<td>Created_at</td>
					<td>Opciones</td>
				</tr>
			</tfoot>
		</table>

		{{ $incendios -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection