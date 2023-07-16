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
    <div class="row justify-content-right col-lg-12 col-md-12 col-sm-12 ">
        <p><strong> Estimado Usuario</strong><br> {{ $solicitud->user->name }},<br><strong> Miembro del B.C.B.V.C</strong> </p>

         <p>Usted realizo una Solicitud de Clave14 en el sistema del BCBVC, la misma ha sido <strong>Confirmada</strong> por el Administrador del sistema.</p>
        <ul>
        <li><strong>ESTADO:</strong>&nbsp; {{ $solicitud->status }}</li>
        <li><strong>FECHA:</strong>&nbsp; {{ $solicitud->created_at }}</li>
        <li><strong>VEHICULO:</strong>&nbsp; {{ $solicitud->vehiculo->codigodis}}</li>
        <li><strong>CONDUCTOR:</strong>&nbsp; {{ $solicitud->user->name}}</li>
        <li><strong>GASOLINERA:</strong>&nbsp; {{ $solicitud->gasolinera->razonsocial }} </li>
        <li><strong>COMBUSTIBLE:</strong>&nbsp; {{ $solicitud->combustible }} </li>
        </ul>

        
    </div>
    <div class="row justify-content-right col-lg-12 col-md-12 col-sm-12 ">
        <table class="table table-sm">
            <tr>
                <td>
                    SOLICITADO POR
                </td>
                <td>
                    CONFIRMADO POR
                </td>
                <td>
                    AUTORIZADO POR
                </td>
            </tr>
            <tr>
                <td>{{ $solicitud->user->name}}</td>
                <td>{{  auth()->user()->name}}</td>
                <td>Ing. Com. Fernanda Garcia<br>Administrador(a) Contrato</td>
            </tr>
        
    </div>
    <div class="row justify-content-right col-lg-12 col-md-12 col-sm-12">
        <p>Los recursos institucionales son suyos cuidelos</p>
        <p>Gracias por su ayuda</p>
    </div>

</body>
</html>