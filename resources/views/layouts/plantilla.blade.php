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

	<div class="loader"></div>
	<!-- Page Wrapper -->
	<div class="alert alert-warning text-center" role="alert">
			@include('cookieConsent::index')
		</div>
	<div id="wrapper">
		@yield("cabeza")
		
		@include("layouts.sidebar2")
		<!-- Logout Modal-->
			<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">{!! trans('messages.Ready to Leave?') !!}</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">{!! trans('messages.Select "Logout" below if you are ready to end your current session.') !!}</div>
						<div class="modal-footer">
							<button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>

							<a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
																document.getElementById('logout-form').submit();">Logout</a>
						</div>
					</div>
				</div>
			</div>


		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<div class="topbar-divider d-none d-sm-block">
						</div>
						<!--Comprobamos si el status esta a true y existe más de un lenguaje-->
						@if (config('locale.status') && count(config('locale.languages')) > 1)
						<div class="top-right links">
							@foreach (array_keys(config('locale.languages')) as $lang)
							@if ($lang != App::getLocale())
							<a href="{!! route('lang.swap', $lang) !!}" title="{!! trans('messages.language') !!}">
								<i class="fa fa-language fa-lg" aria-hidden="true">&nbsp;{{$lang}}</i>
							</a>
							@endif
							@endforeach
						</div>
						@endif

					</ul>
					<ul class="navbar-nav">
						<div class="topbar-divider d-none d-sm-block">
						</div>
						<div class="top-right links">
							<li class="nav-item dropdown no-arrow">
						
							</li>
						</div>
					</ul>
					
					<ul class="navbar-nav ml-right ">
						<div class="topbar-divider d-none d-sm-block">
						
						</div>

						<!-- Authentication Links -->

						@guest
							<li class="nav-item dropdown no-arrow">
								<a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('login') }}">{{ __('Login') }}</a>
							</li>
							@if (Route::has('register'))
							<!-- <li class="nav-item">
													<a class="nav-link dropdown-toggle" href="{{ route('register') }}">{{ __('Register') }}</a>
												</li> -->
							@endif @else
							<li class="nav-item dropdown no-arrow">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} </span><img src="{{ asset('storage/avatar/'.Auth::user()->avatar) }}" height="40px" style="max-width: 100%" /><span class="caret"> </span>
								</a>

								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<a class="dropdown-item" href="{{route('profile.index')}}">
										<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
									@can('view parametrizacion')
									<a rel="nofollow noopener noreferrer" class="dropdown-item" target="_blank" href="/activitylog">
										<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Activity Log</a>
									@endcan
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
										{{ __('Logout') }}
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
								
							</li>
						
						@endguest

					</ul>
				</nav>
				<!-- End of Topbar -->
				<div class="container-fluid fondo-blur">
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
	


	
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<!-- Bootstrap core JavaScript-->
	<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap">
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- <script src="/vendor/jquery/jquery.min.js"></script> -->
	<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Geolocalizacion  for all pages-->
	<!-- <script src="/js/geocoder.js"></script> -->
	
	<!-- Carga Loader en cada pagina-->
	<script src="/js/loader.js"></script>
	<!-- Carga Libreria Moment en cada pagina-->
	<script src="/js/moment.js" /></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<!-- Custom scripts for all pages-->
	<script src="/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="/vendor/chart.js/Chart.min.js"></script>
	<!-- Page level plugins -->
	<script src="/vendor/fullcalendar/core/main.js" ></script> <!-- FullCalendar -->
	<script src="/vendor/fullcalendar/interaction/main.js" ></script> <!-- FullCalendar -->
	<script src="/vendor/fullcalendar/daygrid/main.js" ></script><!--  FullCalendar -->
	<script src="/vendor/fullcalendar/list/main.js" ></script> <!-- FullCalendar -->
	<script src="/vendor/fullcalendar/timegrid/main.js" ></script> <!-- FullCalendar -->
	<script src="/vendor/fullcalendar/timeline/main.js" ></script><!--  FullCalendar -->


	@stack('scripts')
</body>

</html>