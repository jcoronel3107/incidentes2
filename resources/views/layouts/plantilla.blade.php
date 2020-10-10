<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>B.C.B.V.C - </title>
		<!-- Custom styles for this template-->
		<link href="/css/sb-admin-2.min.css" rel="stylesheet">
		<!-- Custom fonts for this template-->
	  	<link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	  	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	</head>
	<body onload="startTime()" id="page-top">
		<!-- Page Wrapper -->
		<div id="wrapper">
@yield("cabeza")
			@include("layouts.sidebar")
			<!-- Logout Modal-->
			 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    <div class="modal-dialog" role="document">
			      <div class="modal-content">
			        <div class="modal-header">
			          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
			          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">×</span>
			          </button>
			        </div>
			        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			        <div class="modal-footer">
			          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			          <a class="btn btn-primary" href="login.html">Logout</a>
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
						    <img  src="/images/encabezado.png" alt="encabezadopdf" width="auto" height="70">
						    <ul class="navbar-nav ml-auto">
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
												<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} </span><img src="{{ Auth::user()->avatar }}" style="max-width: 100%" /><span class="caret"> </span>
								                                </a>
												<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
													<a class="dropdown-item" href="{{route('profile.index')}}">
								                  		<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
								                	
								                	<a class="dropdown-item" href="#">
								                  		<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Activity Log</a>
								                	<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
								                             document.getElementById('logout-form').submit();"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
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
						<div class="container-fluid">
@yield("cuerpo")
						</div>
					</div>
		      		<!-- End of Main Content -->
@yield("piepagina")
					@include("layouts.footer")
			</div>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<!-- Bootstrap core JavaScript-->
  		<script src="/vendor/jquery/jquery.min.js"></script>
  		<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 		 <!-- Core plugin JavaScript-->
 		 <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

 		 <!-- Custom scripts for all pages-->
  		<script src="/js/sb-admin-2.min.js"></script>

  		<!-- Page level plugins -->
  		<script src="/vendor/chart.js/Chart.min.js"></script>

  		<!-- Page level custom scripts -->

  		{{--
  		<script src="/js/demo/chart-pie-demo.js"></script> --}}
		@stack('scripts')
	</body>
</html>