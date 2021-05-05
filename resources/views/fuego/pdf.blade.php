<!doctype html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Reporte Fuego - BCBVC</title>

</head>

<body>
	<img src="images/encabezado.png" alt="encabezadopdf" width="500" height="80">
	<div id="column" class="container fluid">
		<div id="article">
			<h2 class=" shadow p-3 bg-white rounded text-danger">Consultar Información de Evento Incendio (10-70)</h2>
			<p align="right" class="text-info text">Cuenca, {{$date}}</p>
			<hr>
			<h3>Registro Nro.{{$incendio->id}}</h3>
			<hr>
			<span class="bg lightgrey font-weight-bold">Cod_Incidente:</span>
			<ul><p class="text-info">{{$incendio->incidente->nombre_incidente}}</p></ul>
			<span class="bg-gray font-weight-bold">Tipo_Escena:</span>
			<ul><p class=" text-info">{{$incendio->tipo_escena}}</p></ul>
			<span class="bg-gray font-weight-bold">Cod_{!! trans('messages.Station') !!}:</span>
			<ul><p class=" text-info">{{$incendio->station_id}}</p></ul>
			<hr>
			<span class="bg-gray font-weight-bold">Fecha:</span>
			<ul><p class="text-info">{{$incendio->fecha}}</p></ul>
			<span class="bg-gray font-weight-bold">Ficha_Ecu911:</span>
			<ul><p class="text-info">{{$incendio->ficha_ecu911}}</p></ul>
			<span class="bg-gray font-weight-bold">Hora_FichaEcu911:</span>
			<ul><p class="text-info">{{$incendio->hora_fichaecu911}}</p></ul>
			<hr>
			<span class="bg-gray font-weight-bold">{!! trans('messages.Address') !!}:</span>
			<ul><p class="text-info">{{$incendio->direccion}}</p></ul>
			<span class="bg-gray font-weight-bold">Parroquia: </span>
			<ul><p class="text-info">{{$incendio->parroquia->nombre}}</p></ul>
			
		</div>
		<hr>
		<div id="article">
			<span class="bg-gray font-weight-bold">Hora Salida a Emergencia:</span>
			<ul><p class="text-info">{{$incendio->hora_salida_a_emergencia}}</p></ul>
			<span class="bg-gray font-weight-bold">Hora Llegada A Emergencia:</span>
			<ul><p class="text-info">{{$incendio->hora_llegada_a_emergencia}}</p></ul>
			<span class="bg-gray font-weight-bold">Hora Fin Emergencia:</span>
			<ul><p class="text-info">{{$incendio->hora_fin_emergencia}}</p></ul>
			<span class="bg-gray font-weight-bold">Hora En Base:</span>
			<ul><p class="text-info">{{$incendio->hora_en_base}}</p></ul>
			<span class="bg-gray font-weight-bold">Informacion Inicial:</span>
			<ul><p class="text-info text-wrap text-break">{{$incendio->informacion_inicial}}</p></ul>
			<span class="bg-gray font-weight-bold">Detalle Emergencia:</span>
			<ul><p class="text-info text-wrap text-break">{{$incendio->detalle_emergencia}}</p></ul>
		</div>
		<hr>
		<div id="article">
			<span class="bg-gray font-weight-bold">Usuario Afectado:</span>
			<ul><p class="text-info">{{$incendio->usuario_afectado}}</p></ul>
			<span class="bg-gray font-weight-bold"> Danos Estimados:</span>
			<ul><p class="text-info text-wrap text-break">{{$incendio->danos_estimados}}</p></ul>
		</div>
		<hr>
		<div id="article">
			<span class="bg-gray font-weight-bold"> Usuario Elabora:</span>
			<ul><p class="text-info">{{$incendio->usr_creador}}</p></ul>
			<span class="bg-gray font-weight-bold"> Usuario Edición:</span>
			<ul><p class="text-info">{{$incendio->usr_editor}}</p></ul>
			<span class="bg-gray font-weight-bold"> Fechas Edición:</span>
			<ul><p class="text-info">{{$incendio->updated_at}}</p></ul>
		</div>
		<hr>
		<div id="article" class="row p-3 border-left-secondary">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center">
				<h4>Personal Asiste</h4>
				</p>
				<table class="table table-sm">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nombre</th>
							<th scope="col">Cargo</th>
						</tr>
					</thead>
					<tbody>
						@foreach($incendio->users as $user)
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
				<table class="table table-sm">
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
						@foreach($incendio->vehiculos as $vehiculo)
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
		<div>
			<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center">
				<h4>Firmas</h4>
				</p><br><br>
				<p class="text-info">{{$incendio->usr_creador}}</p>
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