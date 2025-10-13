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
			<h4 class="mt-1 mb-1 rounded">Consultar Registro Información de Clave_14</h4>
			<h4>Registro Nro.{{$clave->id}}</h4>	
		</div>
	</div>
	<div class="row p-3 border-left-secondary">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<table class="table table-condensed">
				<tr>
					<td>
						<p class="bg-gray font-weight-bold">Estación Servicio</p>
					</td>
					<td>
						<p class="bg-gray font-weight-bold">Vehiculo</p>
					</td>
					<td>
						<p class="bg-gray font-weight-bold">Conductor</p>
					</td>
				</tr>
				<tr>
					<td>
						<p class="text-info">{{$clave->gasolinera->razonsocial}}</p>
					</td>
					<td>
						<p class=" text-info">{{$clave->vehiculo->codigodis}}</p>
					</td>
					<td>
						<p class=" text-info">{{$clave->user->name}}</p>
					</td>
				</tr>
				
				<tr>
					<td>
						<span class="bg-gray font-weight-bold">km_salida</span>
					</td>
					
					<td>
						<span class="bg-gray font-weight-bold">km_gasolinera</span>
					</td>
					<td>
						<span class="bg-gray font-weight-bold">km_llegada</span>
					</td>
				</tr>
				<tr>
					<td>
						<p class="text-info">{{$clave->km_salida}} Km</p>
					</td>
					<td>
						<p class="text-info">{{$clave->km_gasolinera}} Km</p>
					</td>
					<td>
						<p class="text-info">{{$clave->km_llegada}} Km</p>
					</td>
				</tr>
				<tr>
					<td>
						<span class="bg-gray font-weight-bold">Dolares</span>
					</td>
					<td>
						<span class="bg-gray font-weight-bold">Galones</span>
					</td>
				</tr>
				
				<tr>
					<td>
						<p class="text-info">USD $.{{$clave->dolares}}</p>
					</td>
					<td>
						<p class="text-info">{{$clave->galones}} Glns</p>
					</td>
				</tr>
				<tr>
					<td>
						<span class="bg-gray font-weight-bold">Combustible</span>
					</td>
					<td>
						<span class="bg-gray font-weight-bold">Factura</span>
					</td>
					<td>
						<span class="bg-gray font-weight-bold">Nro Orden:</span>
					</td>
				</tr>
				<tr>
					<td>
						<p class="text-info">{{$clave->combustible}}</p>
					</td>
					<td>
						<p class="text-info">{{$clave->factura}}</p>
					</td>
					<td>
						<p class="text-info">{{$clave->Orden}}</p>
					</td>
				</tr>
			</table>		
		</div>
	</div>
	<div class="row p-3 border-left-secondary">
		<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center">
				<h4>Firmas</h4>
				</p><br>
				<p class="text-info">{{$clave->usr_creador}}</p>
				<span class="bg-gray font-weight-bold"> Usuario Elaborador</span>
		</div>
	</div>
</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>