<!doctype html>
<html>
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Reporte Clave - BCBVC</title>
</head>
<body>
<div class="container"></div>
	<img src="images/encabezado.png" alt="encabezadopdf" width="500" height="90">
	<div class="row p-3 border-left-secondary">
		<div class="col-sm-12 col-md-12 col-lg-12">	
			<p align="right" class="h6 fs-6">Cuenca, {{$date}}</p>
			<h4 class="mt-1 mb-1 rounded">Consultar Solicitud Clave_14</h4>
			<h4>Registro Nro.{{$solicitud->id}}</h4>	
		</div>
	</div>
	
			<table class="table table-condensed table-sm">
				<tr>
					<td>
						<span>Combustible</span>
					</td>
					<td>
						<span>Estado</span>
					</td>
					<td>
						<span>Conductor</span>
					</td>
					<td>
						<span>Nro Orden:</span>
					</td>
				</tr>
				<tr>
					<td>
						<p class="fs-6">{{$solicitud->combustible}}</p>
					</td>
					<td>
						<p class="fs-6">{{$solicitud->status}}</p>
					</td>
					<td>
						<p class=" fs-6">{{$solicitud->user->name}}</p>
					</td>
					<td>
						<p class="fs-6">{{$solicitud->id}}</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Estación Servicio</p>
					</td>
					<td>
						<p>Vehiculo</p>
					</td>
					<td></td>
					
				</tr>
				<tr>
					<td>
						<p class="fs-6">{{$solicitud->gasolinera->razonsocial}}</p>
					</td>
					<td>
						<p class=" fs-6">{{$solicitud->vehiculo->codigodis}}</p>
					</td>
					<td>
						
					</td>
				</tr>
			</table>		
	
	<div class="row p-3 border-left-secondary">
		<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center">
				<h6>Firmas</h6>
				</p><br>
				<p class="h6 fs-6">{{$solicitud->usr_creador}}</p>
				<span class="bg-gray font-weight-bold"> Usuario Elaborador</span>
		</div>
	</div>
</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>