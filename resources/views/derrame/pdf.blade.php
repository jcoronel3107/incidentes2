<!doctype html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Reporte Derrame - BCBVC</title>

</head>

<body>
	<img src="images/encabezado.png" alt="encabezadopdf" width="500" height="90">
	<div class="container">

		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Evento Derrame</h2>
		<p align="right" class="text-info text">Cuenca, {{$date}}</p>
		<h3>Registro Nro.{{$derrame->id}}</h3>
		<span class="bg-gray font-weight-bold">Cod_Incidente:</span>
		<p class="text-info">{{$derrame->incidente->nombre_incidente}}</p>
		<span class="bg-gray font-weight-bold">Tipo_Escena:</span>
		<p class=" text-info">{{$derrame->tipo_escena}}</p>
		<span class="bg-gray font-weight-bold">Cod_Estacion:</span>
		<p class=" text-info">{{$derrame->station_id}}</p>
		<hr>

		<span class="bg-gray font-weight-bold">Fecha:</span>
		<p class="text-info">{{$derrame->fecha}}</p>
		<span class="bg-gray font-weight-bold">Ficha_Ecu911:</span>
		<p class="text-info">{{$derrame->ficha_ecu911}}</p>
		<span class="bg-gray font-weight-bold">Hora_FichaEcu911:</span>
		<p class="text-info">{{$derrame->hora_fichaecu911}}</p>
		<hr>
		<span class="bg-gray font-weight-bold">Dirección:</span>
		<p class="text-info">{{$derrame->address}}</p>
		<span class="bg-gray font-weight-bold">Parroquia: </span>
		<p class="text-info">{{$derrame->parroquia->nombre}}</p><br />
		<hr>
		<span class="bg-gray font-weight-bold">Hora Salida a Emergencia:</span>
		<p class="text-info">{{$derrame->hora_salida_a_emergencia}}</p><br />
		<span class="bg-gray font-weight-bold">Hora Llegada A Emergencia:</span>
		<p class="text-info">{{$derrame->hora_llegada_a_emergencia}}</p><br />
		<hr>
		<span class="bg-gray font-weight-bold">Hora Fin Emergencia:</span>
		<p class="text-info">{{$derrame->hora_fin_emergencia}}</p>
		<span class="bg-gray font-weight-bold">Hora En Base:</span>
		<p class="text-info">{{$derrame->hora_en_base}}</p>
		<span class="bg-gray font-weight-bold">Informacion Inicial:</span>
		<p class="text-info text-wrap text-break">{{$derrame->informacion_inicial}}</p>
		<span class="bg-gray font-weight-bold">Detalle Emergencia:</span>
		<p class="text-info text-wrap text-break">{{$derrame->detalle_emergencia}}</p>

		<hr>
		<span class="bg-gray font-weight-bold">Usuario Afectado:</span>
		<p class="text-info">{{$derrame->usuario_afectado}}</p>
		<span class="bg-gray font-weight-bold"> Danos Estimados:</span>
		<p class="text-info text-wrap text-break">{{$derrame->danos_estimados}}</p>
		<hr>
		<span class="bg-gray font-weight-bold"> Usuario Elabora:</span>
		<p class="text-info">{{$derrame->usr_creador}}</p>
		<span class="bg-gray font-weight-bold"> Usuario Edición:</span>
		<p class="text-info">{{$derrame->usr_editor}}</p>
		<span class="bg-gray font-weight-bold"> Fechas Edición:</span>
		<p class="text-info">{{$derrame->updated_at}}</p>
		<hr><br /><br />
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
						@foreach($derrame->users as $user)
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
						@if($derrame->vehiculos->isNotEmpty())
						{
							@foreach($derrame->vehiculos as $vehiculo)
							<tr>
								<th scope="row">{{$vehiculo->id}}</th>
								<td>{{$vehiculo->codigodis}}</td>
								<td>{{$vehiculo->placa}}</td>
								<td>{{$vehiculo->marca}}</td>
								<td>{{$vehiculo->pivot->km_salida}}</td>
								<td>{{$vehiculo->pivot->km_llegada}}</td>
							</tr>
							@endforeach
						}else
						{
							<tr>
								<th scope="row"></th>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						
						}@endif
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div>
			<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center">
				<h4>Firmas</h4>
				</p><br><br>
				<p class="text-info">{{$derrame->usr_creador}}</p>
				<span class="bg-gray font-weight-bold"> Usuario Elaborador</span>
			</div>
		</div>
	</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>