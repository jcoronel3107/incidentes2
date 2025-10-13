
	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Solicitudes - Index - BCBVC</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Solicitudes Mantenimiento</h2>
		@include('inundacion.messages')
		<div class="row nav justify-content-end">
			<li class="nav-item">
				<div class="input-group mb-3">
					@can('allow export')
						<div class="input-group-prepend ml-2">
								<span title="Export" class="input-group-text"><i class="fas fa-file-export"></i></span>
						</div>
			
						<a class="btn btn-outline-secondary focus-in-expand" data-toggle="tooltip" title="Export" href="">Exportar</i></a>
					@endcan
				</div>
			</li>
		</div>
		
		<hr style="border:2px;">
		@include('mantenimiento_vehicular.search')
		<table class="table table-hover  table-responsive">
			<thead>
				<tr class="table-info">
					<th>id</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>Descipcion</th>
					<th>Solicitante</th>
					<th>Vehiculo</th>
					<th>Placa</th>
					<th>Km_Ingreso</th>
					<th>Estado</th>
					<th>{!! trans('messages.Options') !!}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($maintenance_requests as $solicitud)
				<tr >
					<td><input hidden value="{{$solicitud->id}}" id="maintenance_request_id"  name="maintenance_request_id">{{$solicitud->id}}</td>
					<td><input hidden value="{{$solicitud->fecha}}" id="fecha"  name="fecha"> {{$solicitud->fecha}}</td>
					<td>{{$solicitud->descripcion}}</td>
					<td>{{$solicitud->user->name}}</td>
					<td>{{$solicitud->vehiculo->codigodis}}</td>
					<td>{{$solicitud->vehiculo->placa}}</td>
					<td><input hidden value="{{$solicitud->km_ingreso}}" id="km_ingreso"  name="km_ingreso">{{$solicitud->km_ingreso}}</td>
					<td><input hidden type="text" value="{{$solicitud->status}}" id="status"  name="status">{{$solicitud->status}}</td>
					<td>
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="#" role="button"><i class="fas fa-binoculars"></i></a>
						@can('create pdf')
						<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="#" ><i class="icon-file-text"></i></a>
						@endcan
						@can('create event')
						<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Asigna_Mecanico" data-target="#exampleModal{{$solicitud->id}}" role="button"><i class="fas fa-car-crash"></i></a>
						<!-- Modal -->
						<div class="modal fade" id="exampleModal{{$solicitud->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="post" action="validar_checkbox(this);" class="form-horizontal">
										<div class="modal-header">
												<h5 class="modal-title text-primary" id="exampleModalLabel">Mantenimiento {{$solicitud->vehiculo->codigodis}} <br> {{$solicitud->vehiculo->placa}}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
										</div>
										<div class="modal-body">
											<p class="text-info">Seleccione Personal que trabajará en el vehículo.</p>
											<input value="{{$solicitud->id}}" id="maintenance_request_id" name="maintenance_request_id" hidden>
											<table class="table">
												<thead>
													<tr>
														<th scope="col">Asignar</th>
														
														<th scope="col">Nombre</th>
														<th scope="col">Actividad</th>
														
													</tr>
												</thead>
												<tbody > 
													@foreach ($mecanicos as $user)
													<tr>
														<td>
															<div id="mecanicos" class="form-check">
																<input class="form-check-input" type="checkbox" id="flexCheckIndeterminate">
																<label class="form-check-label" for="flexCheckIndeterminate">
																	{{$user->id}}
																</label>
															</div>
														</td>

														<td>{{$user->user->name }}</td>
														<td>{{ $user->actividad }}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										<div class="modal-footer">
											<button id="btnsend" type="submit" value="Submit" class="btn btn-outline-secondary" data-dismiss="modal">Crear Orden Trabajo</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						@endcan
					</td>
				</tr>
				
		
				@endforeach
				
			</tbody>
			<tfoot>
				<tr class="table-info">
					<th>id</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>Descipcion</th>
					<th>Solicitante</th>
					<th>Vehiculo</th>
					<th>Placa</th>
					<th>Km_Ingreso</th>
					<th>Estado</th>
					<th>{!! trans('messages.Options') !!}</th>
				</tr>
			</tfoot>
		</table>
		{{ $maintenance_requests -> appends(['busq_status' => $busq_status ,'busq_user' => $busq_user ,'busq_fecha' => $busq_fecha])-> links() }}
		
		@push ('scripts')
		<!-- Funciones for all pages-->
		<script src="/js/taller.js"></script>
		
		@endpush
@endsection
@section( "piepagina" ) 
@endsection