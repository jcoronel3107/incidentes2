	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Evento 10-38</h2>
		<div class="card">
			<div class="card-header ">
			    <div class="row">
		    	<div class="col-6"><h3>Registro Nro.{{$salud->id}}</h3>
		    	</div>
		    	<div class="col-6 text-right">
		    		<a href="{{ route('salud.index')}}" class="btn btn-outline-primary ">Regresar</a>
		    	</div>
			    </div>
			</div>
	<div class="card-body">
    	<div class="row p-3 border-left-primary">
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Cod_Incidente:</span>
				<p class="text-info">{{$salud->incidente->nombre_incidente}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Tipo_Escena:</span>
				<p class=" text-info">{{$salud->tipo_escena}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Cod_Estacion:</span>
				<p class=" text-info">{{$salud->station_id}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Fecha:</span>
				<p class="text-info">{{$salud->fecha}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Ficha_Ecu911:</span>
				<p class="text-info">{{$salud->ficha_ecu911}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Hora_FichaEcu911:</span>
				<p class="text-info">{{$salud->hora_fichaecu911}}</p>
			</div>
		</div>
		<hr>
		<div class="row p-3 border-left-primary">

			<div class="col-4">
				<span class="bg-gray font-weight-bold">Dirección:</span>
				 <p class="text-info">{{$salud->direccion}}</p>
				</div>

			<div class="col-4">
				<span class="bg-gray font-weight-bold">Parroquia: </span>
				<p class="text-info">{{$salud->parroquia->nombre}}</p>
			</div>
			<div class="col-4">
				<span class="bg-gray font-weight-bold">Geoposición:</span>
				<p class="text-info">{{$salud->geoposicion}}</p>
			</div>
		</div>
		<hr>
		<div class="row p-3 border-left-primary">

			<div class="col-3">
				<span class="bg-gray font-weight-bold">Hora Salida a Emergencia:</span>
				<p class="text-info">{{$salud->hora_salida_a_emergencia}}</p>
			</div>
			<div class="col-3">
				<span class="bg-gray font-weight-bold">Hora Llegada A Emergencia:</span>
				<p class="text-info">{{$salud->hora_llegada_a_emergencia}}</p>
			</div>
			<div class="col-3">
				<span class="bg-gray font-weight-bold">Hora Fin Emergencia:</span>
				<p class="text-info">{{$salud->hora_fin_emergencia}}</p>
			</div>
			<div class="col-3">
				<span class="bg-gray font-weight-bold">Hora En Base:</span>
				<p class="text-info">{{$salud->hora_en_base}}</p>
			</div>
		</div>
		<div class="row p-3 border-left-primary">

			<div class="col-6">
				<span class="bg-gray font-weight-bold">Informacion Inicial:</span>
				<p class="text-info text-wrap text-break">{{$salud->informacion_inicial}}</p>
			</div>
			<div class="col-6">
				<span class="bg-gray font-weight-bold">Detalle Emergencia:</span>
				<p class="text-info text-wrap text-break">{{$salud->detalle_emergencia}}</p>
			</div>
		</div>
		<hr>
		
		<hr>
		<div class="row p-3 border-left-primary">

			<div class="col-6">
				<span class="bg-gray font-weight-bold"> Usuario Elabora:</span>
				<p class="text-info">{{$salud->usr_creador}}</p>
			</div>
		</div>
		<hr>
		<div class="row p-3 border-left-primary">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center"><h4>Personal Asiste</h4></p>
				<table class="table table-sm table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Cargo</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($salud->users as $user)
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
				<p class="text-center"><h4>Usuarios Asistidos en Emergencia</h4></p>
				<table class="table table-sm table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">cie_id</th>
				      <th scope="col">Paciente</th>
				      <th scope="col">Edad</th>
				      <th scope="col">Genero</th>
				      <th scope="col">Presion1</th>
				      <th scope="col">Presion2</th>
				      <th scope="col">Temper</th>
				      <th scope="col">Glasglow</th>
				      <th scope="col">Satur</th>
				      <th scope="col">Hoja Prehosp</th>
				      <th scope="col">CasaSalud</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($salud->pacientes as $paciente)
				    <tr>
				      <th scope="row">{{$paciente->id}}</th>
				      <td>{{$paciente->cie_id}}</td>
				      <td>{{$paciente->paciente}}</td>
				      <td>{{$paciente->edad}}</td>
				      <td>{{$paciente->genero}}</td>
				    
				      <td>{{$paciente->presion1}}</td>
				      <td>{{$paciente->presion2}}</td>
				      <td>{{$paciente->temperatura}}</td>
				      <td>{{$paciente->glasglow}}</td>
				      <td>{{$paciente->saturacion}}</td>
				      <td>{{$paciente->hojapre}}</td>
				      <td>{{$paciente->casasalud}}</td>


				    </tr>
					@endforeach
				  </tbody>
				</table>
			</div>
		</div>
		<hr>
		<div class="row p-3 border-left-primary">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center"><h4>Vehiculos En Incidente</h4></p>
				<table class="table table-sm table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Codigo</th>
				      <th scope="col">Placa</th>
				      <th scope="col">Marca</th>
				      <th scope="col">Km_Salida</th>
				      <th scope="col">Km_Llegada</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($salud->vehiculos as $vehiculo)
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
  		</div>
	</div>


	@endsection
	@section( "piepagina" ) @endsection