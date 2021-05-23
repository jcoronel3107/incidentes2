	@extends( "layouts.plantilla" )
	@section( "cabeza" )
	<title>Movilización - Index - BCBVC</title>
	@endsection
	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Check Mobilization Information') !!}</h2>
		@include('prevencion.messages')
		<div class="row nav justify-content-end">
			<li class="nav-item">
				<div class="input-group mb-3">
							@can('create movilizacion')
							<div class="input-group-prepend">
								<span title="Nuevo" class="input-group-text"><i class="fas fa-plus"></i></span>
							</div>
								<a class="btn btn-outline-primary" href="{{ route('prevencion.create')}}">Nuevo</a>
							@endcan
							@can('allow export')
							<div class="input-group-prepend ml-2">
								<span title="Export" class="input-group-text"><i class="fas fa-file-export"></i></span>
							</div>
								<a class="btn btn-outline-secondary" href="prevencions/export/">Exporta Excel</a>
							@endcan
							@can('estadistica')
							<div class="input-group-prepend ml-2">
								<span title="Grafic" class="input-group-text"><i class="fas fa-chart-line"></i></span>
							</div>
							<a class="btn btn-outline-info" href="prevencions/grafic/">Grafica</a>
							@endcan
				</div> 
			</li>
		</div>
		<hr style="border:2px;">
		@include('prevencion.search')
		<table class="table table-sm table-hover table-condensed">
			<thead>
				<tr class="table-info">
					<td>id</td>
					<td>{!! trans('messages.departure date') !!}</td>
					<td>{!! trans('messages.return_date') !!}</td>
					<td>{!! trans('messages.Vehicle') !!}</td>
					<td>{!! trans('messages.km_output') !!}</td>
					<td>{!! trans('messages.km_return') !!}</td>
					<td>{!! trans('messages.Options') !!}</td>
			</thead>
			<tbody>
				@foreach($movilizacions as $movilizacion)
				<tr>
					<td>{{$movilizacion->id}}</td>
					<td>{{$movilizacion->fecha_salida}}</td>
					<td>{{$movilizacion->fecha_retorno}}</td>
					<td>{{$movilizacion->vehiculo->codigodis}}</td>
					<td>{{$movilizacion->km_salida}}.Km</td>
					<td>{{$movilizacion->km_retorno}}.Km</td>
					<td>
					@can('delete movilizacion')
					<button type="button" title="Eliminar" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-trash" aria-hidden="true"></i></button>
					<form method="post" action="/prevencion/{{$movilizacion->id}}">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="DELETE">

						
						<!-- Modal -->
						<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>El registro seleccionado será eliminado. Esta Seguro?...</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="Eliminar" value="Eliminar" class="btn btn-primary">Ok</button>
									</div>
								</div>
							</div>
						</div>
					</form>	
					@endcan
					@can('read movilizacion')
						<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Ver" href="{{route('prevencion.show',$movilizacion->id)}}" role="button"><i class="icon-list"></i></a>
					@endcan
					@can('send mail')
						<a class="btn btn-outline-info" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="icon-envelope"></i></a>
					@endcan
					@can('create pdf')
						<a class="btn btn-outline-info" data-toggle="tooltip" title="Pdf" href="{{action('MovilizacionController@downloadPDF', $movilizacion->id)}}" role="button"><i class="fas fa-file-pdf"></i></a>
					@endcan
					</td>
				</tr>
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
								<div class="modal-content">
								<form method="get" action="{{action('MailController@SendMailsPrevencion', $movilizacion->id  )}}" class="form-horizontal">
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
		
		{{ $movilizacions -> appends(['busq_user_id'=>$busq_user,'busq_vehiculo_id'=>$busq_vehiculo,'busq_fecha'=>$busq_fecha])-> links() }}
		
	@endsection
 @section( "piepagina" ) @endsection