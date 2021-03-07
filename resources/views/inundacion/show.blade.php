	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Evento 10-20</h2>
	<div class="card">
		<div class="card-header ">
			<div class="row">
				<div class="col-6">
					<h3>Registro Nro.{{$inundacion->id}}</h3>
				</div>
				<div class="col-6 text-right">
					<a href="{{ route('inundacion.index')}}" class="btn btn-outline-primary ">Regresar</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row p-3 border-left-primary">
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Cod_Incidente:</span>
					<p class="text-info">{{$inundacion->incidente->nombre_incidente}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Tipo_Escena:</span>
					<p class=" text-info">{{$inundacion->tipo_escena}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Cod_Estacion:</span>
					<p class=" text-info">{{$inundacion->station_id}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Fecha:</span>
					<p class="text-info">{{$inundacion->fecha}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Ficha_Ecu911:</span>
					<p class="text-info">{{$inundacion->ficha_ecu911}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Hora_FichaEcu911:</span>
					<p class="text-info">{{$inundacion->hora_fichaecu911}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-secondary">
				<div class="col-4">
					<span class="bg-gray font-weight-bold">Dirección:</span>
					<p class="text-info">{{$inundacion->direccion}}</p>

				</div>
				<div class="col-4">
					<span class="bg-gray font-weight-bold">Parroquia: </span>
					<p class="text-info">{{$inundacion->parroquia->nombre}}</p>
				</div>
				<div class="col-4">
					<span class="bg-gray font-weight-bold">Geoposición:</span>
					<p class="text-info">{{$inundacion->geoposicion}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-primary">
				<div class="col-3">
					<span class="bg-gray font-weight-bold">Hora Salida a Emergencia:</span>
					<p class="text-info">{{$inundacion->hora_salida_a_emergencia}}</p>
				</div>
				<div class="col-3">
					<span class="bg-gray font-weight-bold">Hora Llegada A Emergencia:</span>
					<p class="text-info">{{$inundacion->hora_llegada_a_emergencia}}</p>
				</div>
				<div class="col-3">
					<span class="bg-gray font-weight-bold">Hora Fin Emergencia:</span>
					<p class="text-info">{{$inundacion->hora_fin_emergencia}}</p>
				</div>
				<div class="col-3">
					<span class="bg-gray font-weight-bold">Hora En Base:</span>
					<p class="text-info">{{$inundacion->hora_en_base}}</p>
				</div>
			</div>
			<div class="row p-3 border-left-primary">
				<div class="col-6">
					<span class="bg-gray font-weight-bold">Informacion Inicial:</span>
					<p class="text-info text-wrap text-break">{{$inundacion->informacion_inicial}}</p>
				</div>
				<div class="col-6">
					<span class="bg-gray font-weight-bold">Detalle Emergencia:</span>
					<p class="text-info text-wrap text-break">{{$inundacion->detalle_emergencia}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-secondary">
				<div class="col-6">
					<span class="bg-gray font-weight-bold">Usuario Afectado:</span>
					<p class="text-info">{{$inundacion->usuario_afectado}}</p>
				</div>
				<div class="col-6">
					<span class="bg-gray font-weight-bold"> Danos Estimados:</span>
					<p class="text-info text-wrap text-break">{{$inundacion->danos_estimados}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-primary">
				<div class="col-4">
					<span class="bg-gray font-weight-bold"> Usuario Elabora:</span>
					<p class="text-info">{{$inundacion->usr_creador}}</p>
				</div>
				<div class="col-4">
					<span class="bg-gray font-weight-bold"> Usuario Edición:</span>
					<p class="text-info">{{$inundacion->usr_editor}}</p>
				</div>
				<div class="col-4">
					<span class="bg-gray font-weight-bold"> Fechas Edición:</span>
					<p class="text-info">{{$inundacion->updated_at}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-secondary">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<p class="text-center">
					<h4>Personal Asiste</h4>
					</p>
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nombre</th>
								<th scope="col">Cargo</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inundacion->users as $user)
							<tr>
								<th scope="row">{{$user->id}}</th>
								<td>{{$user->name}}</td>
								<td>{{$user->cargo}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-primary">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<p class="text-center">
					<h4>Vehiculos En Incidente</h4>
					</p>
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Codigo</th>
								<th scope="col">Placa</th>
								<th scope="col">Marca</th>
								<th scope="col">KM.Salida</th>
								<th scope="col">KM.Llegada</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inundacion->vehiculos as $vehiculo)
							<tr>
								<th scope="row">{{$vehiculo->id}}</th>
								<td>{{$vehiculo->codigodis}}</td>
								<td>{{$vehiculo->placa}}</td>
								<td>{{$vehiculo->marca}}</td>
								<td>{{$vehiculo->pivot->km_salida}}</td>
								<td>{{$vehiculo->pivot->km_llegada}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-secondary">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<p class="text-center">
					<h4>Formularios del Incidente</h4>
					</p>
					<li>
						<a rel="nofollow noopener noreferrer" target="_blank" href="{{asset('storage/1020/'.$inundacion->id.'/201.pdf')}}">Formulario 201 - PDF</a>
					</li>
					<li><a rel="nofollow noopener noreferrer" target="_blank" href="{{asset('storage/1020/'.$inundacion->id.'/202.pdf')}}">Formulario 202 - PDF</a>
					</li>
					<li><a rel="nofollow noopener noreferrer" target="_blank" href="{{asset('storage/1020/'.$inundacion->id.'/206A.pdf')}}">Formulario 206A - PDF</a></li>
					<!-- <iframe width="400" height="400" src="{{asset('storage/1020/'.$inundacion->id.'/206A.pdf')}}" frameborder="0"></iframe>	 -->

				</div>
			</div>
		</div>
	</div>


	@endsection
	@section( "piepagina" ) @endsection