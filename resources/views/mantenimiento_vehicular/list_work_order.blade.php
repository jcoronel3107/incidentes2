
	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Ordenes_Trabajo - Index - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Lista Ordenes de Trabajo</h2>
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
		@include('mantenimiento_vehicular.searchworkorden')
		<table class="table table-hover  table-responsive">
			<thead>
				<tr class="table-info">
					<th>id</th>
					<th>Nro_Orden</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>Km_Ingreso</th>
					<th>Estado</th>
					<th>Nro_Solicitud</th>
					<th>Vehiculo</th>
					<th>Solicitante</th>
					<th>Mecanico</th>
					<th>{!! trans('messages.Options') !!}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($work_orders as $item)
				<tr>
					<td>{{$item->id}}</td>
					<td>{{$item->nro_orden}}</td>
					<td>{{$item->fecha}}</td>
					<td>{{$item->km_ingreso}}</td>
					<td>{{$item->status}}</td>
					<td>{{$item->maintenance_request_id}}</td>
					
					<td>{{$item->maintenance_request->vehiculo->codigodis}}</td>
					<td>{{$item->maintenance_request->user->name}}</td>
					<th>
						@foreach($item->mecanico as $item1)
						{{$item1->user->name}}<br>
						@endforeach
					</th>
					<td>
						@can('create event')
							<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Registrar_Labores" data-target="#exampleModal" role="button"><i class="fas fa-file-signature"></i></a>
							<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form method="get" action="#" class="form-horizontal">
											<div class="modal-header">
													<h5 class="modal-title text-primary" id="exampleModalLabel">Mantenimiento </h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
											</div>
											<div class="modal-body">
												
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Registrar_Labores</button>
												<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
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
					<th>Nro_Orden</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>Km_Ingreso</th>
					<th>Estado</th>
					<th>Nro_Solicitud</th>
					<th>Vehiculo</th>
					<th>Solicitante</th>
					<th>Mecanico</th>
					<th>{!! trans('messages.Options') !!}</th>
				</tr>
			</tfoot>
		</table>
		{{ $work_orders -> appends(['busq_orden'=>$busq_orden,'busq_status' => $busq_status ,'busq_vehiculo' => $busq_vehiculo ,'busq_fecha' => $busq_fecha])-> links() }}
		@push ('scripts')
		<!-- Funciones for all pages-->
		<script src="/js/workorders.js"></script>
		
		@endpush
@endsection 
@section( "piepagina" ) 
@endsection