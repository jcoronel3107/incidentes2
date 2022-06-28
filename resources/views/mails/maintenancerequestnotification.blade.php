<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Sistema Mantenimiento Vehicular</title>
</head>
<body>
	<div class="row justify-content-center col-lg-12 col-md-12 col-sm-12">
		<a href="http://www.bomberos.gob.ec"><img src="http://www.bomberos.gob.ec/imgs/firmas/logofirma.png" alt="Logo" width="90" height="80" hspace="5"/></a>
	</div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p>Estimado Usuario {{ $maintenance_request->user->name }}, <br/> Miembro del Benemérito Cuerpo de Bomberos Voluntarios de Cuenca</p>

            <p>Usted recibio una solicitud de Mantenimiento Vehicular en el sistema del BCBVC, revise la solicitud para asignar un mecanico para el mantenimiento solicitado.</p>
            <p></p>
            <p><b>Solicitud Mantenimiento Vehicular Recibida</b></p>
            <ul>
                <li><b>Fecha_Solicitud:</b> {{ $maintenance_request->fecha }}</li>
                <li><b>Estado:</b> {{ $maintenance_request->status }}</li>
                <li><b>Solicitante:</b> {{ $maintenance_request->user->name }}</li>
                <li><b>Detalle_solicitud:</b> {{ $maintenance_request->descripcion }}</li>
                <li><b>Vehiculo:</b>{{ $maintenance_request->vehiculo->codigodis }}</li>
            </ul>
            <p>Gracias.</p>
        </div>
    </div>
</body>
</html>