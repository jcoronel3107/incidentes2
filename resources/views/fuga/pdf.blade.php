<!doctype html>
<html>
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Reporte Fuga - BCBVC</title>

</head>

<body>
	<img src="images/encabezado.png" alt="encabezadopdf" width="500" height="90">
	<div class="container-fluid">

		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Evento 10-20</h2>
		<div class="card">
			<div class="card-header ">
		    	<div class="col-6"><h3>Registro Nro.{{$fuga->id}}</h3>			    </div>
			</div>
  			<div class="card-body">
    		<div class="row p-3 border-left-primary">
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Cod_Incidente:</span>
					<p class="text-info">{{$fuga->incidente->nombre_incidente}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Tipo_Escena:</span>
					<p class=" text-info">{{$fuga->tipo_escena}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Cod_Estacion:</span>
					<p class=" text-info">{{$fuga->station_id}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Fecha:</span>
					<p class="text-info">{{$fuga->fecha}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Ficha_Ecu911:</span>
					<p class="text-info">{{$fuga->ficha_ecu911}}</p>
				</div>
				<div class="col-2">
					<span class="bg-gray font-weight-bold">Hora_FichaEcu911:</span>
					<p class="text-info">{{$fuga->hora_fichaecu911}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-secondary">
				<div class="col-4">
					<span class="bg-gray font-weight-bold">Dirección:</span>
					 <p class="text-info">{{$fuga->address}}</p>

				</div>
				<div class="col-4">
					<span class="bg-gray font-weight-bold">Parroquia: </span>
					<p class="text-info">{{$fuga->parroquia->nombre}}</p>
				</div>
				<div class="col-4">
					<span class="bg-gray font-weight-bold">Geoposición:</span>
					<p class="text-info"></p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-primary">
				<div class="col-3">
					<span class="bg-gray font-weight-bold">Hora Salida a Emergencia:</span>
					<p class="text-info">{{$fuga->hora_salida_a_emergencia}}</p>
				</div>
				<div class="col-3">
					<span class="bg-gray font-weight-bold">Hora Llegada A Emergencia:</span>
					<p class="text-info">{{$fuga->hora_llegada_a_emergencia}}</p>
				</div>
				<div class="col-3">
					<span class="bg-gray font-weight-bold">Hora Fin Emergencia:</span>
					<p class="text-info">{{$fuga->hora_fin_emergencia}}</p>
				</div>
				<div class="col-3">
					<span class="bg-gray font-weight-bold">Hora En Base:</span>
					<p class="text-info">{{$fuga->hora_en_base}}</p>
				</div>
			</div>
			<div class="row p-3 border-left-primary">
				<div class="col-6">
					<span class="bg-gray font-weight-bold">Informacion Inicial:</span>
					<p class="text-info text-wrap text-break">{{$fuga->informacion_inicial}}</p>
				</div>
				<div class="col-6">
					<span class="bg-gray font-weight-bold">Detalle Emergencia:</span>
					<p class="text-info text-wrap text-break">{{$fuga->detalle_emergencia}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-primary">
				<div class="col-md-4 ol-sm-12">

						<span class="input-group-text" id="inputtipo_cilindro">Tipo_Cilindro</span>
						<p class="text-info text-wrap text-break">{{$fuga->tipo_cilindro}}</p>

				</div>
				<div class="col-md-4 col-sm-12">

						<span class="input-group-text" id="inputtipo_fallo">Tipo_Fallo</span>
						<p class="text-info text-wrap text-break">{{$fuga->tipo_fallo}}</p>

				</div>
			</div>{{-- Fallos --}}
			<div class="row p-3 border-left-secondary">
				<div class="col-6">
					<span class="bg-gray font-weight-bold">Usuario Afectado:</span>
					<p class="text-info">{{$fuga->usuario_afectado}}</p>
				</div>
				<div class="col-6">
					<span class="bg-gray font-weight-bold"> Danos Estimados:</span>
					<p class="text-info text-wrap text-break">{{$fuga->danos_estimados}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-primary">
				<div class="col-4">
					<span class="bg-gray font-weight-bold"> Usuario Elabora:</span>
					<p class="text-info">{{$fuga->usr_creador}}</p>
				</div>
				<div class="col-4">
					<span class="bg-gray font-weight-bold"> Usuario Edición:</span>
					<p class="text-info">{{$fuga->usr_editor}}</p>
				</div>
				<div class="col-4">
					<span class="bg-gray font-weight-bold"> Fechas Edición:</span>
					<p class="text-info">{{$fuga->updated_at}}</p>
				</div>
			</div>
			<hr>
			<div class="row p-3 border-left-secondary">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<p class="text-center"><h4>Personal Asiste</h4></p>
					<table class="table table-sm table-hover">
					 	<thead>
					    	<tr>
					    		<th scope="col">#</th>
					     		<th scope="col">Nombre</th>
					     		<th scope="col">Cargo</th>
					    	</tr>
					  	</thead>
					  	<tbody>
					  		@foreach($fuga->users as $user)
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
					<p class="text-center"><h4>Vehiculos En Incidente</h4></p>
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
				  			@foreach($fuga->vehiculos as $vehiculo)
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
			</div>
		</div>
	</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>