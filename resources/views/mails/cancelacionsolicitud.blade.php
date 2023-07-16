<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Cancelación de Solicitud</title>
</head>
<body>
	<div class="row justify-content-center col-lg-12 col-md-12 col-sm-12">
		<a href="http://www.bomberos.gob.ec"><img src="http://www.bomberos.gob.ec/imgs/firmas/logofirma.png" alt="Logo" width="90" height="80" hspace="5" align="middle"/></a>
	</div>
    <div class="row col-lg-12 col-md-12 col-sm-12 "></div>
	<p>Estimado Administrador</p>

    <p>Se CANCELó una solicitud de movilización  en el sistema del BCBVC.</p>
    
    <ul>
        <li>Estado: {{ $solicitud->id }}</li>
        <li>Fecha: {{$solicitud->created_at}}</li>
        <li>Vehiculo: {{ $solicitud->vehiculo->codigodis }}</li>
        <li>Usuario: {{ $solicitud->user->name }}</li>
        <li>Estado: {{ $solicitud->status }}</li>
    </ul> 

    <p>Gracias.</p>
    <p>No contestar a este correo electronico; este es un correo informativo...</p>
</body>
</html>