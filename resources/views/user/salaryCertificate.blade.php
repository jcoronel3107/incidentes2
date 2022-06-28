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
	<p style="font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" class="text-secondary text-reset">Cuenca,{{$date}}</p>
	<h4 class="text-secondary text-center mb-0">CERTIFICADO DE INGRESO MENSUAL</h4>
	<br>
	<div class="mt-5 ml-5 mr-3">
			<p >Que, el Sr./Sra./Srta <b> {{$Cert_employee->last_name}} {{$Cert_employee->first_name}}</b>, con número de cédula N° <b>{{$Cert_employee->passport}}</b>, labora
			en nuestra institución en el cargo <b>{{$Cert_employee->position_name}}</b>, dentro de la <b>{{$Cert_employee->dept_name}}</b> durante el periodo comprendido desde <b>{{$Cert_employee->hire_date}}</b> 
			 hasta la fecha actual, ademas su estabilidad laboral es  <b>{{$Cert_employee->cert_name}}</b>; generando un salario mensual de USD $ xxx.xx. mas beneficios de Ley</p>
			<p>Durante su tiempo en la institución  ha demostrando responsabilidad, honestidad y dedicación en las labores que le fueron encomendadas.</p>
			<p>Se expide la presente a solicitud del interesado, para los fines que crea conveniente.</p>
			<br>
			<p class="text-secondary text-center mb-0">Atentamente,</p>
			<p class="text-secondary text-center mb-0">ABNEGACIÓN Y DISCIPLINA.</p>
			<br>
			<br>
			<br>
			<p class="text-secondary text-center mb-0">Sra. Tatiana Andrade Pesántez.</p>
			<p class="text-secondary text-sm  fs-6 text-center mb-0">JEFE DE PERSONAL</p>
			<p class="text-secondary text-sm fs-6 text-center">Benemérito Cuerpo de Bomberos Voluntarios de Cuenca</p>
	</div>
	<img class="mt-5 ml-5 mr-3" src="https://incidentes2.bomberos.gob.ec/images/qr_cert_bcbvc.png"  width="100" height="100">
	<br>
	<br>
	<br>
	<!-- Copyright -->
	<div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.05);font-size: 12px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
		<a class="text-reset fw-bold" href="https://www.bomberos.gob.ec/">www.bomberos.gob.ec</a>
		<summary>Copyright {{ date('Y') }} .: B.C.B.V.C :.</summary>
	</div>
	<!-- Copyright -->
</body>
</html>