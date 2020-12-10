	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Check Services Commission Information') !!}</h2>
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
		      <a class="btn btn-outline-danger" href="servicio/create">Nuevo</a>
		      @endcan
		      @can('allow export')
		      <a class="btn btn-outline-success" href="servicios/export/">Exporta Excel</a>
		      @endcan
		      @can('allow import')
		      <a class="btn btn-outline-success" href="servicios/import/">Importar Excel</a>
		      @endcan
		      <a class="btn btn-outline-success" href="servicios/grafic/">Grafica</a>
		    </li>
		</ul>
		<hr style="border:2px;">
		@include('servicio.search')
		<table class="table p-3 table-hover table-condensed">
			<thead>
				<tr class="table-primary">
					<td>id</td>
					<td>{!! trans('messages.departure date') !!}</td>
					<td>{!! trans('messages.return_date') !!}</td>
					<td>{!! trans('messages.office') !!}</td>
					<td>{!! trans('messages.delegative') !!}</td>
					<td>{!! trans('messages.km_output') !!}</td>
					<td>{!! trans('messages.km_return') !!}</td>
					<td>{!! trans('messages.Vehicle') !!}</td>
					<td>{!! trans('messages.Options') !!}</td>

			</thead>
			<tbody>
				@foreach($servicios as $servicio)
				<tr>
					<td>{{$servicio->id}}</td>
					<td>{{$servicio->fecha_salida}}</td>
					<td>{{$servicio->fecha_retorno}}</td>
					<td>{{$servicio->unidad}}</td>
					<td>{{$servicio->delegante}}</td>
					<td>{{$servicio->km_salida}}.Km</td>
					<td>{{$servicio->km_retorno}}.Km</td>
					<td>{{$servicio->vehiculo->codigodis}}</td>
					<td>
					@can('edit evento')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('servicio.edit',$servicio->id)}}"><i class="icon-edit"></i></a>
					@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('servicio.show',$servicio->id)}}" role="button"><i class="icon-list"></i></a>
					@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="icon-envelope"></i></a>
					@endcan
					@can('create pdf')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('ServicioController@downloadPDF', $servicio->id)}}" role="button"><i class="icon-file-text"></i></a>
					@endcan
					</td>
				</tr>
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <form method="get" action="{{action('MailController@SendMailsServicio', $servicio->id  )}}" class="form-horizontal">
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
				</tr>
			</tbody>
		</table>

		{{ $servicios -> appends(['searchText' => $query]) -> links() }}
	@endsection
 @section( "piepagina" ) @endsection