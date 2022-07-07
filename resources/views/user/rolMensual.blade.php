<!doctype html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<title>Rol Mensual - BCBVC</title>
</head>
<body style="text-align: justify";>
	<img class="img-fluid" src="images/encabezado.png" alt="encabezadopdf" width="550" height="60">
	<hr>
	<p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Cuenca,{{$date}}</p>
	<h5 class="text-secondary text-center mb-0">ROL DE PAGOS DE EMPLEADO DEL MES DE {{$mesletra}} DE {{$afecha}}</h5>
	
	<table style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="table table-sm mt-1">
		<tbody>
			<tr>	
				<td>CEDULA</td>
				<td><b>{{$rol_employee->perscedula}}</b></td>
				<td>|</td>
				<td>NOMBRE</td>
				<td><b>{{$rol_employee->persnombres}}</b></td>
			</tr>
			<tr>	
				<td>VALOR HORAS EXTRA</td>
				<td>{{$rol_employee->h_extras}}</td>
				<td class="text-center">|</td>
				<td># HORAS EXTRA</td>
				<td>{{$rol_employee->ne100}}</td>
			</tr>
		</tbody>
	</table>
	<hr>
	<table style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="table table-sm">
		<tbody>
			<tr>
				<td colspan="2">INGRESOS</td>
				<td> </td>
				<td colspan="2">DESCUENTOS</td>
				
			</tr>
			<tr>
				<td>Dias</td>
				<td>{{$rol_employee->dias}}</td>
				<td class="text-center">|</td>
				<td>Aporte Personal IESS</td>
				<td>{{$rol_employee->apor_iess}}</td>
			</tr>
			<tr>
				<td>Remuneracion</td>
				<td>{{$rol_employee->sueldo}}</td>
				<td class="text-center">|</td>
				<td>Impuesto a la Renta</td>
				<td>{{$rol_employee->impto_rta}}</td>
			</tr>
			<tr>
				<td>Horas Extra</td>
				<td>{{$rol_employee->h_extras}}</td>
				<td class="text-center">|</td>
				<td>Fondos de Reserva IESS</td>
				<td>{{$rol_employee->fr_iess}}</td>
			</tr>
			<tr>
				<td>Fondos Reserva</td>
				<td>{{$rol_employee->fondo_res}}</td>
				<td class="text-center">|</td>
				<td>Anticipos/Prestamos</td>
				<td>{{$rol_employee->anticipo}}</td>
			</tr>
			<tr>
				<td>Subrogacion</td>
				<td>{{$rol_employee->subrogacio}}</td>
				<td class="text-center">|</td>
				<td>Aporte Agasajo Navidad</td>
				<td>{{$rol_employee->ap_navidad}}</td>
			</tr>
			<tr>
				<td>XIV SUELDO</td>
				<td>{{$rol_employee->dec_cuarto}}</td>
				<td class="text-center">|</td>
				<td>Pension Alimenticia</td>
				<td>{{$rol_employee->alimentos}}</td>
			</tr>
			<tr>
				<td>XIII SUELDO</td>
				<td>{{$rol_employee->dec_tercer}}</td>
				<td class="text-center">|</td>
				<td>Prestamos Hipotecarios</td>
				<td>{{$rol_employee->prest_hip}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td class="text-center">|</td>
				<td>Prestamos Quirografarios</td>
				<td>{{$rol_employee->prest_qui}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td class="text-center">|</td>
				<td>Anticipo Quincena</td>
				<td>{{$rol_employee->quincena}}</td>
			</tr>
			<tr>
				<td>TOTAL INGRESOS</td>
				<td>USD$.{{$rol_employee->total_ing}}</td>
				<td class="text-center">|</td>
				<td>TOTAL DESCUENTOS</td>
				<td>USD$.{{$rol_employee->total_desc}}</td>
			</tr>
		</tbody>
	</table>
	<table style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="table table-sm">
		<tr>
			<td>
				VALOR LIQUIDO A PAGAR:
			</td>
			<td>
				<b>{{$rol_employee->liquido}}</b>
			</td>
		</tr>
	</table>
	
	<!-- Copyright -->
	<div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.05);font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
		<a class="text-reset fw-bold" href="https://www.bomberos.gob.ec/">www.bomberos.gob.ec</a>
		<summary>Copyright {{ date('Y') }} .: B.C.B.V.C :.</summary>
	</div>
	<!-- Copyright -->
	<hr>
	<img class="mt-1 mb-1 ml-5 mr-3" src="https://incidentes2.bomberos.gob.ec/images/qr_cert_bcbvc.png"  width="100" height="100">
</body>
</html>