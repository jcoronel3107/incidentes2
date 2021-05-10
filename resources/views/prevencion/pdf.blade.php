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
	<table class="table table-striped">
		<caption class="text-info text">Consulta Registro Información de Movilizacion</caption>
		<tr>
			<th>Fecha_Salida</th>
			<th>Fecha_Retorno</th>
		</tr>
		<tr>
			<td>{{$movilizacion->fecha_salida}}</td>
			<td>{{$movilizacion->fecha_retorno}}</td>
		</tr>
	</table>
	<hr>
	<table class="table table-striped">
			<tr>
				<th>Vehiculo</th>
				<th>Km_Salida</th>
				<th>km_retorno</th>
			</tr>
			<tr>
				<td>{{$movilizacion->vehiculo->codigodis}}</td>
				<td>{{$movilizacion->km_salida}}</td>
				<td>{{$movilizacion->km_retorno}}</td>
			</tr>
	</table>
	<hr>
	<table class="table table-striped">
			<tr>
				<th>Conductor</th>
			</tr>
			<tr>
				<td>{{$movilizacion->user->name}}</td>
			</tr>
	</table>
	<table class="table-condense table-striped">
			@foreach($movilizacion->actividad as $detalle)
			<tr>
				<th>Actividades</th>
				<th>Detalle</th>
			</tr>
			<tr>
				<td><p>{{$detalle->descripcion}}</p></td>
				<td><p>{{$detalle->detalle}}</p></td>
			</tr>
			@endforeach
	</table>
	<hr>
	<table class="table table-striped">
			<tr>
				<th>Observaciones</th>
			</tr>
			<tr>
				<td>{{$movilizacion->observaciones}}</td>
			</tr>
			<tr>
				<th>Usr_creador</th>
			</tr>
			<tr>
				<td>{{$movilizacion->usr_creador}}</td>
			</tr>
			@empty($movilizacion->usr_editor)
			<tr>
				<th>Usr_editor</th>
			</tr>
			<tr>
				<td>{{$movilizacion->usr_editor}}</td>
			</tr>
			@endempty
	</table>

	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		<h5><p class="text-center">
			Firma Responsabilidad</p></h5>
			<br><br>
			<p class="text-info text-center">{{$movilizacion->user->name}}</p>
			<p class="bg-gray font-weight-bold text-center"> Usuario Elaborador</p>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>