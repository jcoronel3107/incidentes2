<!doctype html>
<html>
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Reporte Incendio - BCBVC</title>

</head>

<body>
<img src="images/encabezado.png" alt="encabezadopdf" width="500" height="90">
<div class="container">

		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Consultar Registro Información de Clave_14</h2>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Estación Servicio:</span>
				<p class="text-info">{{$clave->gasolinera->razonsocial}}</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<span class="bg-gray font-weight-bold">Vehiculo:</span>
				<p class=" text-info">{{$clave->vehiculo->codigodis}}</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<span class="bg-gray font-weight-bold">{!! trans('messages.Date') !!}:</span>
				<p class=" text-info">{{$clave->created_at}}</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Conductor:</span>
				<p class=" text-info">{{$clave->user->name}}</p>
			</div>

		<hr>

			<div class="col 4">
				<span class="bg-gray font-weight-bold">km_salida:</span>
				<p class="text-info">{{$clave->km_salida}} Km</p>
			</div>
			<div class="col-4">
				<span class="bg-gray font-weight-bold">km_gasolinera:</span>
				<p class="text-info">{{$clave->km_gasolinera}} Km</p>
			</div>
			<div class="col-4">
				<span class="bg-gray font-weight-bold">km_llegada:</span>
				<p class="text-info">{{$clave->km_llegada}} Km</p>
			</div>
			<hr>

			<div class="col-4">
				<span class="bg-gray font-weight-bold">Dolares:</span>
				 <p class="text-info">USD $.{{$clave->dolares}}</p>
				</div>

			<div class="col-4">
				<span class="bg-gray font-weight-bold">Galones: </span>
				<p class="text-info">{{$clave->galones}} Glns</p>
			</div>
			<div class="col-4">
				<span class="bg-gray font-weight-bold">combustible:</span>
				<p class="text-info">{{$clave->combustible}}</p>
			</div>
		</div>
		<hr>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>