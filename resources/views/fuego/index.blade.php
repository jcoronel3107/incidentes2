	@extends( "layouts.plantilla" )

	@section( "cabeza" )

		<title>Fuego - Index - BCBVC</title>

	@endsection

	@section( "cuerpo" )
	
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Consult Fire Information') !!}</h2>
		@include('fuego.messages')
		<div class="row nav justify-content-end">
				<li class="nav-item">
					<div class="input-group mb-3">
										@can('create event')	
										<div class="input-group-prepend">
											<span title="Nuevo" class="input-group-text"><i class="fas fa-plus"></i></span>
										</div>
										<a class="btn btn-outline-primary" data-toggle="tooltip" title="Nuevo" href="fuego/create">Nuevo</i></a>
										@endcan
										@can('allow export')
										<div class="input-group-prepend ml-2">
											<span title="Export" class="input-group-text"><i class="fas fa-file-export"></i></span>
										</div>
										
										<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Export" href="incendios/export/">Exportar</i></a>
										@endcan
										@can('allow import')
										<div class="input-group-prepend ml-2">
											<span title="Import" class="input-group-text"><i class="fas fa-file-import"></i></span>
										</div>
										
										<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Import" href="/incendios/importar">Importar</a>
										@endcan
										@can('estadistica')
										<div class="input-group-prepend ml-2">
											<span title="Grafic" class="input-group-text"><i class="fas fa-chart-line"></i></span>
										</div>
										
										<a class="btn btn-outline-info" data-toggle="tooltip" title="Estadistica" href="incendios/grafic/">Grafica</a>
										@endcan
					
					</div>
				</li>
			</div>
			
		<hr style="border:2px;">
		@include('fuego.search')
		<table class="table table-sm table-hover table-condensed">
			<thead>
				<tr class="table-info">
					<th>id</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>{!! trans('messages.Incident') !!}</th>
					
					<th>{!! trans('messages.Station') !!}</th>
					<th>{!! trans('messages.Address') !!}</th>
					<th>Usuario_Afectado</th>
					<th>{!! trans('messages.Options') !!}</th>
					
				</tr>
			</thead>
			<tbody>
				@foreach($incendios as $incendio)
				<tr style="font-size: 13px;">
					<td>{{$incendio->id}}</td>
					<td>{{$incendio->fecha}}</td>
					<td>{{$incendio->incidente->nombre_incidente}}</td>
					<td>{{$incendio->station->nombre}}</td>
					<td  >{{$incendio->direccion}}</td>
					<td>{{$incendio->usuario_afectado}}</td>
					<td>
						@can('edit event')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('fuego.edit',$incendio->id)}}" role="button"><i class="icon-edit" aria-hidden="true"></i></a>
						@endcan
						@can('allow upload')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Forms SCI" href="/incendios/carga/{{$incendio->id}}"><i class="fa fa-upload" aria-hidden="true"></i></a>
						@endcan
						@can('create inspeccion')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Inspeccion" href="inspeccionfuego/{{$incendio->id}}" role="button"><i class="fas fa-notes-medical" aria-hidden="true"></i></a>
						@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('fuego.show',$incendio->id)}}" role="button"><i class="fas fa-binoculars"></i></a>
						@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="icon-envelope" aria-hidden="true"></i></a>
						@endcan
						@can('create pdf')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('IncendioController@downloadPDF', $incendio->id)}}" role="button"><i class="icon-file-text" aria-hidden="true"></i></a>
						@endcan
						
					</td>
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
		{{ $incendios -> appends(['busq_direccion' => $busq_direccion ,'busq_estacion' => $busq_estacion ,'busq_fecha'=>$busq_fecha,'busq_usuarioafectado'=>$busq_usuarioafectado])-> links() }}
	@endsection
	@section( "piepagina" ) 
	@endsection