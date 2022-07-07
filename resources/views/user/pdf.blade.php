<!doctype html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Consulta Recurso Humano - BCBVC</title>
	<style>
		.page-break {
			page-break-after: always;
		}
		</style>
</head>

<body>
	<img class="img-fluid" alt="Responsive image" src="images/encabezado.png" alt="encabezadopdf" width="550" height="70">
	<hr>
	<p class="text-info text">Cuenca, {{$date}}</p>
	<h3>Consulta Recurso Humano </h3>
	<caption class="text-info text">Desvinculaciones - Cant.{{$Desvinculado_employee->count()}} Usuarios</caption>
	<table class="table-sm  table-striped table-condensed wrap ">
		
			<thead>
				<tr style="white-space: nowrap; overflow-x: auto;font-size:11px" >
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Cedula</th>
					<th scope="col">Fecha_Contratacion</th>
					<th scope="col">Fecha_Desvinculacion</th>
					<th scope="col">Motivo</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($Desvinculado_employee as $item)
					<tr style="white-space: nowrap; overflow-x: auto;font-size:8px" >
						<td>{{$item->first_name }}</td>
						<td>{{$item->last_name}}</td>
						<td>{{$item->passport}}</td>
						<td>{{$item->hire_date}}</td>
						<td>{{$item->resign_date}}</td>
						<td>{{$item->reason}}</td>
					</tr>
				@endforeach
			</tbody>
	</table>
	<hr>
	<hr class="page-break" >
	<caption class="text-info text ">Libre Remoción - Cant.{{$LibreRemocion_employee->count()}} Usuarios</caption>
	<table class="table table-striped">
		<thead>
			<tr style="white-space: nowrap; overflow-x: auto;font-size:11px" >
				<th scope="col">Nombre</th>
				<th scope="col">Apellido</th>
				<th scope="col">Cedula</th>
				<th scope="col">Fecha_Contratacion</th>
			</tr>
		</thead>
		<tbody>
	
			@foreach ($LibreRemocion_employee as $item2)
				<tr style="white-space: nowrap; overflow-x: auto;font-size:8px" >
					<td>{{$item2->first_name }}</td>
					<td>{{$item2->last_name}}</td>
					<td>{{$item2->passport}}</td>
					<td>{{$item2->hire_date}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<hr>
	<hr class="page-break" >
	<caption class="text-info text">Nombramiento Provisional - Cant.{{$NomProvisional_employee->count()}} Usuarios</caption>
	<table class="table table-striped">
		<thead>
			<tr style="white-space: nowrap; overflow-x: auto;font-size:11px" >
				<th scope="col">Nombre</th>
				<th scope="col">Apellido</th>
				<th scope="col">Cedula</th>
				<th scope="col">Fecha_Contratacion</th>
			</tr>
		</thead>
		<tbody>
	
			@foreach ($NomProvisional_employee as $item3)
				<tr style="white-space: nowrap; overflow-x: auto;font-size:8px" >
					<td>{{$item3->first_name }}</td>
					<td>{{$item3->last_name}}</td>
					<td>{{$item3->passport}}</td>
					<td>{{$item3->hire_date}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<hr>
	<hr class="page-break" >
	<caption class="text-info text">Contrato Ocacional - Cant.{{$Ocacional_employee->count()}} Usuarios</caption>
	<table class="table table-striped">
		<thead>
				<tr style="white-space: nowrap; overflow-x: auto;font-size:11px" >
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Cedula</th>
					<th scope="col">Fecha_Contratacion</th>
				</tr>
		</thead>
		<tbody>
				@foreach ($Ocacional_employee as $item4)
					<tr style="white-space: nowrap; overflow-x: auto;font-size:8px" >
						<td>{{$item4->first_name }}</td>
						<td>{{$item4->last_name}}</td>
						<td>{{$item4->passport}}</td>
						<td>{{$item4->hire_date}}</td>
					</tr>
				@endforeach
		</tbody>
	</table>
	<hr>
	<hr class="page-break" >
	<caption class="text-info text">Codigo de Trabajo - Cant.{{$Codigo_employee->count()}} Usuarios</caption>
	<table class="table table-striped">
		<thead>
				<tr style="white-space: nowrap; overflow-x: auto;font-size:11px" >
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Cedula</th>
					<th scope="col">Fecha_Contratacion</th>
				</tr>
		</thead>
		<tbody>
		
				@foreach ($Codigo_employee as $item5)
					<tr style="white-space: nowrap; overflow-x: auto;font-size:8px" >
						<td>{{$item5->first_name }}</td>
						<td>{{$item5->last_name}}</td>
						<td>{{$item5->passport}}</td>
						<td>{{$item5->hire_date}}</td>
					</tr>
				@endforeach
		</tbody>
	</table>
	<hr>
	<hr class="page-break" >
	<caption class="text-info text">Nombramiento Definitivo - Cant.{{$Nombramiento_employee->count()}} Usuarios</caption>
	<table class="table table-striped">
		<thead>
				<tr style="white-space: nowrap; overflow-x: auto;font-size:11px" >
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Cedula</th>
					<th scope="col">Fecha_Contratacion</th>
				</tr>
		</thead>
		<tbody>
		
				@foreach ($Nombramiento_employee as $item6)
					<tr style="white-space: nowrap; overflow-x: auto;font-size:8px" >
						<td>{{$item6->first_name }}</td>
						<td>{{$item6->last_name}}</td>
						<td>{{$item6->passport}}</td>
						<td>{{$item6->hire_date}}</td>
					</tr>
				@endforeach
				
		</tbody>
	</table>
	<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="text-center">
				<h5>Firmas</h5>
				</p><br><br>
				<p class="text-info">{{Auth::user()->name}}</p>
				<span class="bg-gray font-weight-bold"> Usuario Elaborador</span>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>