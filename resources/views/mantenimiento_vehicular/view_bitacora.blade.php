@extends( "layouts.plantilla" )

@section( "cabeza" )

@endsection

@section( "cuerpo" )
		<h2 class="mt-2 shadow p-3 mb-2 bg-white rounded">Bitacoras Mantenimiento</h2>

		<div class="input-group mt-2 mb-2 justify-content-end">  
			@can('allow export')
				<div class="input-group-prepend">
					<span title="Exportar" class="input-group-text"><i class="fas fa-file-export"></i></span>
				</div>	
				<a class="btn btn-outline-secondary focus-in-expand" data-toggle="tooltip" title="Export" href="/export_bitacora/{{$fechaD}},{{$fechaH}},{{$VehiculoId}},{{$aprobado}},{{$liquidado}}">{!! trans('messages.export') !!}</i></a>
			@endcan
			<div class="input-group-prepend ml-1">
				<span title="Regresar" class="input-group-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
			</div>	
			<a class="btn btn-outline-primary focus-in-expand" data-toggle="tooltip" title="Regresar" role="button" href="/show">Regresar</i></a>
    	</div>

		<div class="row mt-2 mb-1">
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right"><b>Desde</b></label>
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right shadow bg-white rounded">{{$fechaD}}</label>
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right"><b>Hasta</b></label>
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right shadow bg-white rounded">{{$fechaH}}</label>		
		
			
		</div>
		<div class="row mt-2 mb-1">
			<label class="col-lg-2 col-md-6 text-sm-right"><b>Nro Registros</b></label>
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right shadow bg-white rounded">{{$ListMantenimientosEntreFechas->count()}}</label>
			<label class="col-lg-2 col-md-6 text-sm-right"><b>Vehiculo</b></label>
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right shadow bg-white rounded">{{$Vehiculo->codigodis}}</label>
		</div>
		<div class="row mt-2 mb-2">
			
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right"><b>Motor</b></label>
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right shadow bg-white rounded">{{$Vehiculo->motor}}</label>
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right"><b>Chasis</b></label>
			<label class="col-lg-2 col-md-6 col-form-label text-sm-right shadow bg-white rounded">{{$Vehiculo->chasis}}</label>
			<label class="col-lg-1 col-md-6 col-form-label text-sm-right"><b>Año</b></label>
			<label class="col-lg-1 col-md-6 col-form-label text-sm-right shadow bg-white rounded">{{$Vehiculo->anio_fab}}</label>
				
		</div>
		

		<table class="table table-hover table-responsive">
			<thead>
				<tr class="table-secondary">
					<td>Numero</td>
					<td>Referencia</td>
					<td>Taller</td>
					<td>Estacion</td>
					<td>Vehiculo</td>
					<td>Kilometraje</td>
					<td>Descripcion</td>
					<td>Fechaemite</td>
					<td>Total</td>
					<td>UsuaAprueba</td>
					<td>Opciones</td>
			</thead>
			<tbody>
				@foreach($ListMantenimientosEntreFechas as $item)
					<tr>
						<td>{{$item->numero}}</td>
						<td>{{$item->referencia}}&nbsp;</td>
						<td>{{$item->taller}}&nbsp;</td>
						<td>{{$item->estacion}}&nbsp;</td>
						<td>{{$item->codigodis}}&nbsp;</td>
						<td>{{$item->kilometraje}}&nbsp;</td>
						<td>{{$item->descripcion}}&nbsp;</td>
						<td>{{$item->fechaemite}}&nbsp;</td>
						<td>$.{{$item->total}}&nbsp;</td>
						<td>{{$item->usuaaprueba}}&nbsp;</td>
						<td>
							<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="" role="button"><i class="fas fa-binoculars"></i></a>
							@can('send mail')
							<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="icon-envelope" aria-hidden="true"></i></a>
							@endcan
							@can('create pdf')
							<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="" role="button"><i class="icon-file-text" aria-hidden="true"></i></a>
							@endcan
						</td>
					</tr>
					
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"><!-- Modal -->
						<div class="modal-dialog">
						    <div class="modal-content">
								<form method="get" action="" class="form-horizontal">
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
		{{ $ListMantenimientosEntreFechas -> appends(['fechaD'=>$fechaD,'fechaH'=>$fechaH,'aprobado'=>$aprobado,'Vehiculo'=>$VehiculoId,'liquidado'=>$liquidado])-> links() }}
@endsection @section( "piepagina" )
@endsection