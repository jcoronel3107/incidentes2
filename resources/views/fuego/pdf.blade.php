<!doctype html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Reporte Incendios - BCBVC</title>

</head>

<body>
	<img class="img-fluid" alt="Responsive image" src="images/encabezado.png" alt="encabezadopdf" width="550" height="70">
	<hr>
	<p align="right" class="text-info text">Cuenca, {{$date}}</p>
	<h3>Consulta Información de Evento Incendios (10-70)</h3>
	<table class="table table-striped">
		<caption class="text-info text">Registro Nro.{{$incendio->id}}</caption>
		<tr>
			<th>Fecha</th>
			<th>Hora_Ficha_Ecu911</th>
			<th>Ficha_Ecu911</th>
		</tr>
		<tr>
			<td>{{$incendio->fecha}}</td>
			<td>{{$incendio->hora_fichaecu911}}</td>
			<td>{{$incendio->ficha_ecu911}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Cod_Incidente</th>
			<th>Tipo_Escena</th>
			<th>Cod_Estacion</th>
			
		</tr>
		<tr>
			<td>{{$incendio->incidente->nombre_incidente}}</td>
			<td>{{$incendio->tipo_escena}}</td>
			<td>{{$incendio->station_id}}</td>
		
		</tr>
		<tr>
			<th colspan="2">{!! trans('messages.Address') !!}</th>
			<th>Parroquia</th>
		</tr>
		<tr>
			<td colspan="2">{{$incendio->direccion}}</td>
			<td>{{$incendio->parroquia->nombre}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Georeferencia</th>
		</tr>
		<tr>
			<td>{{$incendio->geoposicion}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Hora Salida a Emergencia</th>
			<th>Hora Llegada A Emergencia</th>
			<th>Hora Fin Emergencia</th>
			<th>Hora En Base</th>
		</tr>
		<tr>
			<td>{{$incendio->hora_salida_a_emergencia}}</td>
			<td>{{$incendio->hora_llegada_a_emergencia}}</td>
			<td>{{$incendio->hora_fin_emergencia}}</td>
			<td>{{$incendio->hora_en_base}}</td>
		</tr>
	</table>
	<hr>
	<table class="table table-striped">
		<tr>
			<th>Informacion Inicial</th>
		</tr>
		<tr>
			<td>{{$incendio->informacion_inicial}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Detalle Emergencia</th>
		</tr>
		<tr>
			<td>{{$incendio->detalle_emergencia}}</td>
		</tr>
	</table>
	<br>
	<table class="table table-striped">
		<tr>
			<th>Usuario Afectado</th>
			<th>Danos Estimados</th>
		</tr>
		<tr>
			<td>{{$incendio->usuario_afectado}}</td>
			<td>{{$incendio->danos_estimados}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Usuario Elabora</th>
			<th>Usuario Edición</th>
			<th>Fechas Edición</th>
		</tr>
		<tr>
			<td>{{$incendio->usr_creador}}</td>
			<td>{{$incendio->usr_editor}}</td>
			<td>{{$incendio->updated_at}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<caption class="text-info text">Personal Asiste</caption>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>FCargo</th>
		</tr>
		@foreach($incendio->users as $user)
		<tr>
			<td>{{$user->id}}</td>
			<td>{{$user->name}}</td>
			<td>{{$user->cargo}}</td>
		</tr>
		@endforeach
	</table>
	<table class="table table-striped">
		<caption class="text-info text">Vehiculos En Incidente</caption>
		<tr>
			<th>#</th>
			<th>Codigo</th>
			<th>Placa</th>
			<th>Marca</th>
			<th>KM.Salida</th>
			<th>KM.Llegada</th>
			<th>Conductor</th>
		</tr>
		@foreach($incendio->vehiculos as $vehiculo)
			<tr>
				<td>{{$vehiculo->id}}</td>
				<td>{{$vehiculo->codigodis}}</td>
				<td>{{$vehiculo->placa}}</td>
				<td>{{$vehiculo->marca}}</td>
				<td>{{$vehiculo->pivot->km_salida}}</td>
				<td>{{$vehiculo->pivot->km_llegada}}</td>
				<td>{{$vehiculo->pivot->driver_id}}</td>
			</tr>
		@endforeach
	</table>
	<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center">
				<h5>Firmas</h5>
				</p><br><br>
				<p class="bg-gray font-weight-bold">{{$incendio->usr_creador}}<br/>
				<span >Usuario Elaborador</span></p>
	</div>
	
	

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>