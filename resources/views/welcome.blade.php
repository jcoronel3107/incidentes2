@extends( "layouts.plantilla" )

@section( "cabeza" )

<title>Incidentes2 - BCBVC</title>

@endsection

@section( "cuerpo" )
	<!-- Div Reloj y Clima -->
	<div class="row justify-content-center">
		
		
		<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 " id="clockdate">
					
				<div class="card mb-2 ">
					<div class="card-body">
						<div class="clockdate-wrapper">
							<div id="clock"></div>
							<div id="date"></div>
						</div>
					</div>
				 </div>
		 </div>
		<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
			<div class="card mb-2 ">
				<h6 class="card-header text-white bg-secondary">
					<div id="topbar">Clima<span id="searchicon">🔍</span></div>
					<div id="searchbox">
						<input type="text" id="search" placeholder="Digite Nombre Ciudad">
						<button>Search</button>
					</div>
				</h6>
				<div class="card-body">
					<center>
						<div id="mainbody">
							<img>
							<span id="city"></span>
							<span id="temp"></span>
							<span id="cond"></span>
							<hr>
								<div id="more">
									<span id="label">Humedad: </span><span id="humidity"></span>
									<span id="label">|| Viento: </span><span id="wind">&nbsp;</span>
								</div>
								<div id="more">
									<span id="label">Dirección Viento: </span><span id="direction"></span>
								
									<span id="label">|| Sensación Térmica: </span><span id="feel"></span>
								</div>
							
							<span style="font-size: 8px;">Ultima Actualización: </span><span style="font-size: 8px;" id="update"></span>
						</div>
					</center>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-2">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class=" col mr-2">
							<h5 class="h5 mb-0 font-weight-bold text-gray-800"> {!! trans('messages.flood') !!}</h5>
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
								<h1>{{$mensualesInundacion}}</h1> {!! trans('messages.Current Month Events') !!}
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-fw fa-shower fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-md-6 mb-2">
			<div class="card border-left-secondary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class=" col mr-2">
							<h5 class="h5 mb-0 font-weight-bold text-gray-800"> {!! trans('messages.rescue') !!}</h5>
							<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
								<h1>{{$mensualesRescate}}</h1> {!! trans('messages.Current Month Events') !!}
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-fw fa-wrench fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		 </div>

		<div class="col-xl-3 col-md-6 mb-2">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class=" col mr-2">
							<h5 class="h5 mb-0 font-weight-bold text-gray-800"> {!! trans('messages.Hazmat') !!}</h5>
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								<h1>{{$mensualesDerrame}}</h1> {!! trans('messages.Current Month Events') !!}
							</div>
						</div>
					<div class="col-auto">
						<i class="fas fa-fw fa-life-ring fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-xl-3 col-md-6 mb-2">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class=" col mr-2">
							<h5 class="h5 mb-0 font-weight-bold text-gray-800"> {!! trans('messages.transit') !!}</h5>
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								<h1>{{$mensualesTransito}}</h1> {!! trans('messages.Current Month Events') !!}
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-car-crash fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
				
		<div class="row justify-content-center">
			<div class="col-xl-3 col-lg-3 col-md-6 mb-2">
				<div class="card mb-2">
					<h5 class="card-header text-white bg-warning"><i class="fas fa-fw fa-heartbeat"></i> {!! trans('messages.Health') !!}</h5>
					<div class="card-body">
						<p class="card-text text-black">
						<h1>{{$mensualesSalud}}</h1> {!! trans('messages.Current Month Events') !!}</p>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-6 mb-2">
				<div class="card mb-2">
					<h5 class="card-header text-white bg-danger"><i class="fas fa-fw fa-fire"></i>{!! trans('messages.fire') !!}</h5>
					<div class="card-body">
						<p class="card-text text-black">
						<h1>{{$mensualesIncendio}}</h1> Eventos Mes Actual</p>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-6 mb-2">
				<div class="card mb-2">
					<h5 class="card-header text-white bg-info"><i class="fas fa-fw fa-fire-extinguisher"></i> {!! trans('messages.leak') !!}</h5>
					<div class="card-body">
						<p class="card-text text-black">
						<h1>{{$mensualesFuga}}</h1> {!! trans('messages.Current Month Events') !!}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">	
			<div class="col-xl-3 col-lg-3 col-md-6 mb-2">
				<div class="card mb-4 text-white text-sm o-hidden ">
					<div class="card-body text-white bg-secondary"> 
						<div class="card-body-icon">
							<i class="fas fa-gas-pump"></i>
						</div>
						<p class="card-text">
							<h1>{{$mensualesClave}}</h1> {!! trans('messages.Current Month Events') !!}
						</p>
						<p>
							<h5 class="text-white">
								#Claves
							</h5>
						</p>
					</div>	
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 mb-2">
				<div class="card mb-4 text-white text-sm o-hidden ">
					<div class="card-body text-white bg-info"> 
						<div class="card-body-icon"><i class="fas fa-handshake"></i>
						</div>
						<p class="card-text ">
							<h1>{{$mensualesServicio}}</h1> {!! trans('messages.Current Month Events') !!}
						</p>
						<p>
							<h5 class="text-white">
								# Comisiones
							</h5>
						</p>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 mb-2">
				<div class="card mb-4 text-white text-sm o-hidden ">
					<div class="card-body text-white bg-primary">
						<div class="card-body-icon"><i class="fas fa-ambulance"></i> 
						</div>
							<p class="card-text ">
								<h1>{{$EventosxIncidente}}</h1> {!! trans('messages.Current Month Events') !!}
							</p>
							<p>
								<h5 class="text-white">
									# Atenciones
								</h5>
							</p>
					</div>
				</div>
			</div>
		</div>
			
		<div class="row">
			
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
					<div class="card mb-4 text-white text-sm o-hidden ">
						<div class="card-body text-white bg-info">
							<div class="card-body-icon">
								<i class="fas fa-money-check-alt"></i>
						    </div>
							<p class="card-text">
								<h1>USD.$ {{$SumaValClaves}}</h1> {!! trans('messages.Monthly Fuel Consumption') !!}
							</p>
							<p>
								<h5 class="text-white">
									$ Claves	
								</h5>
							</p>
						</div>
					</div>
				 </div>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
					<div class="card mb-4 text-white text-sm o-hidden ">
						<div class="card-body text-white bg-warning">
							<div class="card-body-icon"><i class="fas fa-money-check-alt"></i></div>
								<p class="card-text">
									<h1>USD.$ {{$CountClaves}}</h1> {!! trans('messages.Monthly Fuel Consumption') !!}
								</p>
								<h5 class="text-white">
									# Claves
								</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@push ('scripts')
<script src="/js/Clima.js"></script>
<script src="/js/clock.js"></script>

@endpush
@endsection

@section( "piepagina" )


@endsection