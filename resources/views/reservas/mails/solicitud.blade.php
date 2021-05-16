<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Sistema Reservas</title>
</head>
<body>
	<div class="row justify-content-center col-lg-12 col-md-12 col-sm-12">
		<a href="http://www.bomberos.gob.ec"><img src="http://www.bomberos.gob.ec/imgs/firmas/logofirma.png" alt="Logo" width="90" height="80" hspace="5" align="middle"/></a>
	</div>
    <div class="row col-lg-12 col-md-12 col-sm-12 "></div>
	<p>Estimado Usuari@ {{ $solicitud->user->name }}, <br/> Miembro del Benemérito Cuerpo de Bomberos Voluntarios de Cuenca</p>

    <p>Usted realizo una solicitud de movilización  en el sistema del BCBVC, espere la confirmación del Administrador del sistema para acceder al uso del recurso.</p>
    <p>Solicite con al menos 24 horas de antelación</p>
    <p>La confirmaciòn o cancelación toma al rededor de 2 horas a partir de su registro.</p>
    <ul>
        <li>Estado: {{ $solicitud->status }}</li>
        <li>Inicia: {{ $solicitud->start }}</li>
        <li>Fin: {{ $solicitud->end }}</li>
    </ul>

    <p>Gracias.</p>
</body>
</html>