<!doctype html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Reporte Transito - BCBVC</title>

</head>

<body>
	<img class="img-fluid" alt="Responsive image" src="images/encabezado.png" alt="encabezadopdf" width="550" height="70">
	<hr>
	<p align="right" class="text-info text">Cuenca, {{$date}}</p>
	<h3>Consulta Información de Evento Transito (10-42)</h3>
	<table class="table table-striped">
		<caption class="text-info text">Registro Nro.{{$transito->id}}</caption>
		<tr>
			<th>Fecha</th>
			<th>Hora_Ficha_Ecu911</th>
			<th>Ficha_Ecu911</th>
		</tr>
		<tr>
			<td>{{$transito->fecha}}</td>
			<td>{{$transito->hora_fichaecu911}}</td>
			<td>{{$transito->ficha_ecu911}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Cod_Incidente</th>
			<th>Tipo_Escena</th>
			<th>Cod_Estacion</th>
			
		</tr>
		<tr>
			<td>{{$transito->incidente->nombre_incidente}}</td>
			<td>{{$transito->tipo_escena}}</td>
			<td>{{$transito->station_id}}</td>
		
		</tr>
		<tr>
			<th colspan="2">{!! trans('messages.Address') !!}</th>
			<th>Parroquia</th>
		</tr>
		<tr>
			<td colspan="2">{{$transito->direccion}}</td>
			<td>{{$transito->parroquia->nombre}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Georeferencia</th>
		</tr>
		<tr>
			<td>{{$transito->geoposicion}}</td>
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
			<td>{{$transito->hora_salida_a_emergencia}}</td>
			<td>{{$transito->hora_llegada_a_emergencia}}</td>
			<td>{{$transito->hora_fin_emergencia}}</td>
			<td>{{$transito->hora_en_base}}</td>
		</tr>
	</table>
	<hr<><br /><br /><br /><br /><br /><br />
	<table class="table table-striped">
		<tr>
			<th>Informacion Inicial</th>
		</tr>
		<tr>
			<td>{{$transito->informacion_inicial}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Detalle Emergencia</th>
		</tr>
		<tr>
			<td>{{$transito->detalle_emergencia}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Usuario Afectado</th>
			<th>Danos Estimados</th>
		</tr>
		<tr>
			<td>{{$transito->usuario_afectado}}</td>
			<td>{{$transito->danos_estimados}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>Usuario Elabora</th>
			<th>Usuario Edición</th>
			<th>Fechas Edición</th>
		</tr>
		<tr>
			<td>{{$transito->usr_creador}}</td>
			<td>{{$transito->usr_editor}}</td>
			<td>{{$transito->updated_at}}</td>
		</tr>
	</table>
	<table class="table table-striped">
		<caption class="text-info text">Personal Asiste</caption>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>FCargo</th>
		</tr>
		@foreach($transito->users as $user)
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
		</tr>
		@foreach($transito->vehiculos as $vehiculo)
			<tr>
				<td>{{$vehiculo->id}}</td>
				<td>{{$vehiculo->codigodis}}</td>
				<td>{{$vehiculo->placa}}</td>
				<td>{{$vehiculo->marca}}</td>
				<td>{{$vehiculo->pivot->km_salida}}</td>
				<td>{{$vehiculo->pivot->km_llegada}}</td>
			</tr>
		@endforeach
	</table>
	<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center">
				<h5>Firmas</h5>
				</p><br><br>
				<p class="text-info">{{$transito->usr_creador}}</p>
				<span class="bg-gray font-weight-bold"> Usuario Elaborador</span>
	</div>
		
	
		
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>