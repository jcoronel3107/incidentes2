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
	<title>Certificado de Trabajo - BCBVC</title>
</head>
<body style="text-align: justify";>
	<img class="img-fluid" src="images/encabezado.png" alt="encabezadopdf" width="550" height="70">
	<hr>
	<h4 class="text-secondary text-center mb-0">FORMULARIO DE ANTICIPO DE REMUNERACIONES</h4>
	<br>
	<table>
		<thead>
			<tr>
				<td>
					<b><p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Nro_Solicitud</p></b>
				</td>
				<td>
					<b><p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Fecha_Solicitud</p></b>
				</td>
			</tr>
			<tr>
				<td>
					Nro.
				</td>
				<td>
					Cuenca,{{$date}}
				</td>
			</tr>
			
		</thead>
		<tbody>
			<tr>
				<td colspan="2">
					<b><p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Apellidos / Nombres</p></b>
				</td>
			
			</tr>
			<tr>
				<td>
					{{$Cert_employee->last_name}} {{$Cert_employee->first_name}}		
				</td>
			</tr>
			<tr>
				<td>
					<b><p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Cargo</p></b>
				</td>
				<td>
					<b><p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Condición</p></b>
				</td>
			</tr>
			<tr>
				<td>
					{{$Cert_employee->position_name}}
				</td>
				<td>
					{{$Cert_employee->cert_name}}
				</td>
			</tr>
			<tr>
				<td>
					<b><p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Valor Solicitado</p></b>
				</td>
				<td>
					<b><p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Plazo Requerido</p></b>
				</td>
			</tr>
			<tr>
				<td>
					USD$.{{$monto}}
				</td>
				<td>
					{{$plazo}} mes(es)
				</td>
			</tr>
			<tr>
				<td colspan="2"><br></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">
				<p >Yo, <b> {{$Cert_employee->last_name}} {{$Cert_employee->first_name}}</b>, portador del documento de identidad N° <b>{{$Cert_employee->passport}}</b>, mediante el presente
				autorizo expresamente a la Unidad Administrativa de Talento Humano y Financiera a descontaren de mis haberes de forma mensual, el valor correspondiente al presente anticipo de remuneraciones y
				en caso de cesasion de mis funciones, autorizo se me descuente el valor total adeudado en mi liquidacion final.</p>
				<p class="text-secondary text-center mb-0">Atentamente,</p>
				<p class="text-secondary text-center mb-0">ABNEGACIÓN Y DISCIPLINA.</p>
				<br>
				<p class="text-secondary text-center mb-0">{{$Cert_employee->last_name}} {{$Cert_employee->first_name}}</p>
				<p style="font-size: 12px; text-aling:center; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">{{$Cert_employee->position_name}}</p>
				<p class="text-secondary text-sm fs-6 text-center">Benemérito Cuerpo de Bomberos Voluntarios de Cuenca</p>		
				</td>
			</tr>
		</tfoot>
	</table>
	
	
	
	<img class="mt-5 ml-5 mr-3" src="https://incidentes2.bomberos.gob.ec/images/qr_cert_bcbvc.png"  width="100" height="100">
	<br>
	
	<!-- Copyright -->
	<div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.05);font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
		<a class="text-reset fw-bold" href="https://www.bomberos.gob.ec/">www.bomberos.gob.ec</a>
		<summary>Copyright {{ date('Y') }} .: B.C.B.V.C :.</summary>
	</div>
	<!-- Copyright -->
</body>
</html>