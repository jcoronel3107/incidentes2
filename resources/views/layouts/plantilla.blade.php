<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="System for the Control and Registration of Incidents to which a Firefighters Institution attends. Fully responsive system, that is, it works on mobiles, tablets and computers">
		<meta name="Ing. Juan Coronel" content="">
		<title>B.C.B.V.C - Incidentes2</title>
		<!-- Custom styles for this template-->
		<link href="/css/sb-admin-2.min.css" rel="stylesheet">
		<!-- Custom fonts for this template-->
	  	<link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	  	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	</head>
	<body onload="startTime()"  id="page-top">
		<!-- Page Wrapper -->
		<div id="wrapper">
@yield("cabeza")
			@include("layouts.sidebar")
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
			          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			          
			          <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
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
								                            <i class="fas fa-language size:2x"></i>
								                            <a href="{!! route('lang.swap', $lang) !!}">
								                                    {!! $lang !!} 
								                            </a>
								                        @endif
								                    @endforeach
								                </div>
								@endif
								                
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
											<li class="nav-item">
												<a class="nav-link dropdown-toggle" href="{{ route('register') }}">{{ __('Register') }}</a>
											</li>
											@endif @else
											<li class="nav-item dropdown no-arrow">
												<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} </span><img src="{{ asset('storage/avatar/'.Auth::user()->avatar) }}" height="40px" style="max-width: 100%" /><span class="caret"> </span>
								                                </a>
								                                	
												<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
													<a class="dropdown-item" href="{{route('profile.index')}}">
								                  		<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
								                	
								                	<a class="dropdown-item" target="_blank" href="/activitylog">
								                  		<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Activity Log</a>
								                	<div class="dropdown-divider"></div>
													<a class="dropdown-item"  data-toggle="modal" data-target="#logoutModal"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
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
							<hr >
						</div>
		      		<!-- End of Main Content -->
@yield("piepagina")
					@include("layouts.footer")
			</div>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<!-- Bootstrap core JavaScript-->
		<script defer
 		 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQWkyaqY4K2sOinX5crayMw6oVrg6LrwE&callback=initMap">
		</script>
  		<script src="/vendor/jquery/jquery.min.js"></script>
  		<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 		 <!-- Core plugin JavaScript-->
 		 <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

 		 <!-- Geolocalizacion  for all pages-->
  		<script src="/js/geocoder.js"></script>

 		 <!-- Custom scripts for all pages-->
  		<script src="/js/sb-admin-2.min.js"></script>

  		<!-- Page level plugins -->
  		<script src="/vendor/chart.js/Chart.min.js"></script>

  		

		@stack('scripts')
	</body>
</html>