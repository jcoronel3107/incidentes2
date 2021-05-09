<!doctype html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<style>
		table,
		th {
			border: 0px solid blue;
		}

		th,
		td {
			padding: 5px;
		}
	</style>


</head>

<body>
	<img src="images/encabezado.png" alt="encabezadopdf" width="500" height="90">
	<p align="right" class="text-info text">Cuenca, {{$date}}</p>
	<hr>
	<table>
		<caption class="text-info text">Consulta Registro Información de Comisión Servicio</caption>
		<tr>
			<th>Fecha_Salida</th>
			<th>Fecha_Retorno</th>
		</tr>
		<tr>
			<td>{{$servicio->fecha_salida}}</td>
			<td>{{$servicio->fecha_retorno}}</td>
		</tr>
	</table>
	<hr>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<dl>
				<dt>Vehiculo</dt>
				<dd>{{$servicio->vehiculo->codigodis}}</dd>
				<dt>Km_Salida</dt>
				<dd>{{$servicio->km_salida}}</dd>
				<dt>km_retorno</dt>
				<dd>{{$servicio->km_retorno}}</dd>
			</dl>
		</div>
	</div>
	<hr>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<dl>
				<dt>Delegante</dt>
				<dd>{{$servicio->delegante}}</dd>
				<dt>Unidad</dt>
				<dd>{{$servicio->unidad}}</dd>
				<hr>
				<dt>Conductor</dt>
				<dd>{{$servicio->user->name}}</dd>
				<dt>Asunto</dt>
				<dd>{{$servicio->asunto}}</dd>
				<dt>Usr_creador</dt>
				<dd>{{$servicio->usr_creador}}</dd>
				<dt>Usr_editor</dt>
				<dd>{{$servicio->usr_editor}}</dd>
			</dl>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<p class="text-center">
			<h5>Firma</h5>
			</p><br><br>
			<p class="text-info">{{$servicio->usr_creador}}</p>
			<span class="bg-gray font-weight-bold"> Usuario Elaborador</span>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>