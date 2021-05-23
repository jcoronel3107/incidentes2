
	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Inundación - Index - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Consult Flood Information') !!}</h2>
		@include('inundacion.messages')
		<div class="row nav justify-content-end">
			<li class="nav-item">
				<div class="input-group mb-3">
									@can('create event')	
									<div class="input-group-prepend">
										<span title="Nuevo" class="input-group-text"><i class="fas fa-plus"></i></span>
									</div>
									<a class="btn btn-outline-primary" data-toggle="tooltip" title="Nuevo" href="{{ route('inundacion.create')}}">Nuevo</i></a>
									@endcan
									@can('allow export')
									<div class="input-group-prepend ml-2">
										<span title="Export" class="input-group-text"><i class="fas fa-file-export"></i></span>
									</div>
									
									<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Export" href="inundacions/export/">Exportar</i></a>
									@endcan
									@can('allow import')
									<div class="input-group-prepend ml-2">
										<span title="Import" class="input-group-text"><i class="fas fa-file-import"></i></span>
									</div>
									
									<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Import" href="/inundacions/importar">Importar</a>
									@endcan
									@can('estadistica')
									<div class="input-group-prepend ml-2">
										<span title="Grafic" class="input-group-text"><i class="fas fa-chart-line"></i></span>
									</div>
									
									<a class="btn btn-outline-info" data-toggle="tooltip" title="Estadistica" href="inundacions/grafic/">Grafica</a>
									@endcan
				
				</div>
			</li>
		</div>
		
		<hr style="border:2px;">
		@include('inundacion.search')
		<table class="table table-hover table-condensed">
			<thead>
				<tr class="table-info">
					<th>id</th>
					<th>{!! trans('messages.Incident') !!}</th>
					<th>{!! trans('messages.Station') !!}</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>{!! trans('messages.Address') !!}</th>
					<th>Usuario_Afectado</th>
					<th>{!! trans('messages.Options') !!}</th>
					
				</tr>
			</thead>
			<tbody>
				@foreach($inundaciones as $inundacion)
				<tr>
					<td>{{$inundacion->id}}</td>
					<td>{{$inundacion->incidente->nombre_incidente}}</td>
					<td>{{$inundacion->station->nombre}}</td>
					<td>{{$inundacion->fecha}}</td>
					<td>{{$inundacion->direccion}}</td>
					<td>{{$inundacion->usuario_afectado}}</td>
					<td>
						@can('edit event')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('inundacion.edit',$inundacion->id)}}"><i class="icon-edit"></i></a>
						@endcan
						@can('allow upload')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Forms SCI" href="/inundacions/carga/{{$inundacion->id}}"><i class="fa fa-upload" aria-hidden="true"></i></a>
						@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('inundacion.show',$inundacion->id)}}" role="button"><i class="fas fa-binoculars"></i></a>
						@can('create pdf')
						<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/downloadPDFinundacion/{{$inundacion->id}}" ><i class="icon-file-text"></i></a>
						@endcan
						@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="fas fa-envelope-open"></i></a>
						@endcan
						
					</td>
				</tr>
				<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						    <div class="modal-content">
		      <form method="get" action="{{action('MailController@SendMailsInundacion', $inundacion->id  )}}" class="form-horizontal">
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
				<tr class="table-info">
					<th>id</th>
					<th>{!! trans('messages.Incident') !!}</th>
					<th>{!! trans('messages.Station') !!}</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>{!! trans('messages.Address') !!}</th>
					<th>Usuario_Afectado</th>
					<th>{!! trans('messages.Options') !!}</th>
				</tr>
			</tfoot>
		</table>
		{{ $inundaciones -> appends(['busq_direccion' => $busq_direccion ,'busq_estacion' => $busq_estacion ,'busq_fecha'=>$busq_fecha,'busq_usuarioafectado'=>$busq_usuarioafectado])-> links() }}
		

@endsection @section( "piepagina" ) @endsection