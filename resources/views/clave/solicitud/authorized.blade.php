@extends( "layouts.plantilla" )

@section( "cabeza" )

		<title>Autorizaciones - Index - BCBVC</title>
@endsection

@section( "cuerpo" )
		<h2 class="mt-2 shadow p-3 mb-2 bg-white rounded text-danger">Consulta Autorizaciones de Solicitud_Clave_14</h2>
		@include('clave.messages')
		<div class="nav justify-content-end">
					<li class="nav-item ">
								<div class="input-group mb-3 ">
										@can('create')	
										<div class="input-group-prepend">
											<span title="Nuevo" class="input-group-text"><i class="fas fa-plus"></i></span>
										</div>
										<a class="nav-link btn btn-outline-primary focus-in-expand" href="{{route('solicitud.create')}}">{!! trans('messages.new') !!}</a>
										@endcan
								</div>
					</li>		
		</div>
		@include('clave/solicitud.search')
		<table class="table p-3 table-hover table-condensed">
			<thead>
				<tr class="table-info">
					
					<td>{!! trans('messages.Order') !!}</td>
					<td>{!! trans('messages.Date') !!}</td>
					<td>{!! trans('messages.Driver') !!}</td>
					<td>{!! trans('messages.Vehicle') !!}</td>
					<td>status</td>
					<td>{!! trans('messages.Options') !!}</td>
				</tr>

			</thead>
			<tbody>
				@foreach($solicituds as $solicitud)
				<tr>
					<td>{{$solicitud->id}}</td>
					<td>{{$solicitud->created_at}}</td>
					<td>{{$solicitud->user->name}}</td>
					<td>{{$solicitud->vehiculo->codigodis}}</td>
					<td>
						@if ($solicitud->status == 'Solicitado')
						<span class="badge badge-primary">{{ $solicitud->status }}</span>
						@elseif ($solicitud->status == 'Confirmado')
						<span class="badge badge-success">{{ $solicitud->status }}</span>
						@else
						<span class="badge badge-danger">{{ $solicitud->status }}</span>
						@endif
					</p></td>
					<td>
					@can('edit')
					@if ($solicitud->status == 'Solicitado')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('solicitud.edit',$solicitud->id)}}"><i class="icon-edit"></i></a>
					@endif
					@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('solicitud.show',$solicitud->id)}}" role="button"><i class="fas fa-binoculars"></i></a>
					
					@can('create_pdf')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('SolicitudClaveController@downloadPDF', $solicitud->id)}}" role="button"><i class="icon-file-text"></i></a>
					@endcan
					
					</td>
				</tr>
				<div class="modal fade" id="exampleModal_{{$solicitud->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<form method="post" action="{{action('SolicitudClaveController@authorize_request',$solicitud->id)}}" class="form-horizontal">
								@csrf @method('PATCH')
								{{csrf_field()}}
								<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Autorización para {{$solicitud->vehiculo->codigodis}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
								</div>
								<div class="modal-body">
										<div class="input-group mb-3">		
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">ID</span>
											</div>
											<input value="{{$solicitud->id}}" readonly name="id" type="id" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
										</div>
										<div class="input-group mb-3">	
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">Fecha_Solicitud</span>
											</div>
											<input value="{{$solicitud->created_at}}" readonly name="created_at" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
										</div>
										<div class="input-group mb-3">	
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">Estación_Servicio</span>
											</div>
											<input value="{{$solicitud->razonsocial}}" readonly name="gas_station" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
										</div>
										<div class="input-group mb-3">	
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">Conductor</span>
											</div>
											<input value="{{$solicitud->user->id}}" readonly hidden name="conductor_id" class="form-control" aria-label="conductor_id" aria-describedby="basic-addon1">
											<input value="{{$solicitud->user->name}}" readonly name="conductor" class="form-control" aria-label="conductor" aria-describedby="basic-addon1">
										</div>
										<div class="input-group mb-3">	
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">Estado</span>
											</div>
											<input value="{{ $solicitud->status }}" readonly name="status" class="form-control" aria-label="status" aria-describedby="basic-addon1">
											
										</div>
										
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									@if ($solicitud->status == 'Solicitado')
										<button type="submit" class="btn btn-primary">Autorizar</button>
									@endif
								</div>
							</form>
						</div>
					</div>
				</div>
				@endforeach
			</tbody>
		</table>
		{{ $solicituds -> appends(['busq_x_conductor' => $query_conductor],['busq_x_orden'=>$query_orden],['busq_x_vehiculo'=>$query_vehiculo]) -> links() }}
@endsection
@section( "piepagina" ) 
@endsection