<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="System for the Control and Registration of Incidents to which a Firefighters Institution attends. Fully responsive system, that is, it works on mobiles, tablets and computers">
	<meta name="Ing. Juan Coronel" content="">
	<link rel="shortcut icon" type="image/png" href="{{ asset('/images/favicon_192x192.png') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('/images/favicon_192x192.png') }}">
	<!-- Custom styles for this template-->
	<link href="/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="/css/varios.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

	<!-- Custom styles for Calendar-->
	<link href="/vendor/fullcalendar/daygrid/main.css" rel="stylesheet">
	<link href="/vendor/fullcalendar/core/main.css" rel="stylesheet">
	<link href="/vendor/fullcalendar/list/main.css" rel="stylesheet">
	<link href="/vendor/fullcalendar/timeline/main.css" rel="stylesheet">
	<link href="/vendor/fullcalendar/timegrid/main.css" rel="stylesheet">
		
</head>

<body onload="startTime()" id="page-top">
	
	<noscript>
	<p>Bienvenido a Incidentes2</p>
	<p>La página que estás viendo requiere para su funcionamiento el uso de
	JavaScript.
	Si lo has deshabilitado intencionadamente, por favor vuelve a activarlo.</p>
	</noscript>
	<!-- Muestra Icono mientras carga pagina -->
	<div class="loader"></div>
	<!-- Page Wrapper -->
	<div class="alert alert-secondary text-center" role="alert">
			@include('cookieConsent::index')
	</div>
	<div id="wrapper">
			@yield("cabeza")
			
			@include("layouts.sidebar2")
					
			
				<div id="content-wrapper" class="d-flex flex-column">

						<!-- Main Content -->
						@include("layouts.topbar")
						<div id="content">
							
							<div  class="container-fluid fondo-blur ">
								@yield("cuerpo")		
							</div>
							<div onload="initMap()" hidden="" id="map" style="width: 100%; height: 280px;"></div>
							<hr>
						</div>
					<!-- End of Main Content -->
					@yield("piepagina")
					@include("layouts.footer")
				</div>
			
	</div>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<!-- Bootstrap core JavaScript-->
	<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

	<script defer 
		src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap">
	</script>
	
	
	<!-- Carga Loader en cada pagina-->
	<script src="/js/loader.js"></script>
	<!-- Carga Libreria Moment en cada pagina-->
	<script src="/js/moment.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<!-- Custom scripts for all pages-->
	<script src="/js/sb-admin-2.min.js"></script>
	<!-- Page level plugins -->
	<script src="/vendor/chart.js/Chart.min.js"></script>
	<script src="/vendor/fullcalendar/core/main.js" ></script> <!-- FullCalendar -->
	<script src="/vendor/fullcalendar/interaction/main.js" ></script> <!-- FullCalendar -->
	<script src="/vendor/fullcalendar/daygrid/main.js" ></script><!--  FullCalendar -->
	<script src="/vendor/fullcalendar/list/main.js" ></script> <!-- FullCalendar -->
	<script src="/vendor/fullcalendar/timegrid/main.js" ></script> <!-- FullCalendar -->
	<script src="/vendor/fullcalendar/timeline/main.js" ></script><!--  FullCalendar -->
	<script src="/js/Clima.js"></script>
	<script src="/js/clock.js"></script>
	@stack('scripts')
</body>

</html>