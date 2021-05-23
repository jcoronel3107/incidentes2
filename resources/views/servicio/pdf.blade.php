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
	<img src="images/encabezado.png" alt="encabezadopdf" width="550" height="70">
	<p align="right" class="text-info text">Cuenca, {{$date}}</p>
	<hr>
	<table class="table table-striped">
				
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
			<table class="table table-striped">
					
					<tr>
						<th>Vehiculo</th>
						<th>Conductor</th>
					</tr>
					<tr>
						<td>{{$servicio->vehiculo->codigodis}}</td>
						<td>{{$servicio->user->name}}</td>
					</tr>
			</table>
			<table class="table table-striped">
					
					<tr>
						<th>km_salida</th>
						<th>km_retorno</th>
					</tr>
					<tr>
						<td>{{$servicio->km_salida}} Km</td>
						<td>{{$servicio->km_retorno}} Km</td>
					</tr>
			</table>
			<table class="table table-striped">
					
					<tr>
						<th>Departamento</th>
						<th>Delegante</th>
					</tr>
					<tr>
						<td>{{$servicio->unidad}}</td>
						<td>{{$servicio->delegante}}</td>
					</tr>
			</table>
			<table class="table table-striped">
					
					<tr>
						<th>Asunto</th>
					
					</tr>
					<tr>
						<td>{{$servicio->asunto}}</td>
						
					</tr>
			</table>
		
			<div class="row p-3">
				<div class="col-lg-8 col-md-8 col-sm-12">
						<span class="bg-gray font-weight-bold">usr_creador:</span>
						<p class="text-info">{{$servicio->usr_creador}}</p>
					</div>
				<hr>
			</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>