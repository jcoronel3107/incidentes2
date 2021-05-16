@extends( "layouts.plantilla" )

@section( "cabeza" )

<title>Incidentes2 - BCBVC</title>

@endsection

@section( "cuerpo" )

	<div class="row">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12" id="clockdate">
				<div class="card mb-4 ">

					<div class="card-body">
						<div class="clockdate-wrapper">
							<div id="clock"></div>
							<div id="date"></div>
						</div>
					</div>
				</div>
			</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
				<div class="card mb-4 ">
					<h5 class="card-header text-white bg-secondary">
						<div id="topbar">Clima<span id="searchicon">🔍</span></div>
						<div id="searchbox">
							<input type="text" id="search" placeholder="Digite Nombre Ciudad">
							<button>Search</button>
						</div>
					</h5>
					<div class="card-body">
						<center>
							<div id="mainbody">
								<img>
								<span id="city"></span>
								<br /><br />
								<span id="temp"></span>
								<span id="cond">&nbsp;</span>
								<br />
								<center>
									<div id="more">
										<hr>
										<span id="label">Sensación Térmica: </span><span id="feel">&nbsp;</span>
									</div>

									<div id="more">
										<span id="label">Humedad: </span><span id="humidity">&nbsp;</span>
									</div>
									<div id="more">
										<span id="label">Viento: </span><span id="wind">&nbsp;</span>
									</div>
									<div id="more">
										<span id="label">Dirección Viento: </span><span id="direction">&nbsp;</span>
									</div>
								</center>
								<br />
								<span>Ultima Actualización: </span><span id="update">&nbsp;</span>
							</div>
						</center>
					</div>
				</div>
			</div>
		
			
			
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
				<div class="card mb-4 text-white bg-primary o-hidden ">
					<h5 class="card-header text-white bg-primary">
					<div id="topbar"># Atenciones</div>
					</h5>
					<div class="card-body text-white bg-primary">
						<div class="card-body-icon"><i class="fas fa-ambulance"></i> </div>
						
							<p class="card-text text-black">
							<h1>{{$EventosxIncidente}}</h1> {!! trans('messages.Current Month Events') !!}</p>
					</div>
				</div>
			
			</div>
	</div>
	<div class="row">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">

				<h5 class="card-header text-white bg-secondary"><i class="fas fa-fw fa-shower"></i> {!! trans('messages.flood') !!}</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesInundacion}}</h1> {!! trans('messages.Current Month Events') !!}</p>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">
				<h5 class="card-header text-white bg-secondary"><i class="fas fa-fw fa-life-ring"></i> {!! trans('messages.rescue') !!}</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesRescate}}</h1> {!! trans('messages.Current Month Events') !!}</p>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">
				<h5 class="card-header text-white bg-secondary"><i class="fas fa-fw fa-life-ring"></i> {!! trans('messages.Hazmat') !!}</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesDerrame}}</h1> {!! trans('messages.Current Month Events') !!}</p>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">
				<h5 class="card-header text-white bg-success"><i class="fas fa-fw fa-wrench"></i> {!! trans('messages.transit') !!}</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesTransito}}</h1> {!! trans('messages.Current Month Events') !!}</p>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">
				<h5 class="card-header text-white bg-warning"><i class="fas fa-fw fa-heartbeat"></i> {!! trans('messages.Health') !!}</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesSalud}}</h1> {!! trans('messages.Current Month Events') !!}</p>
				</div>
			</div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">
				<h5 class="card-header text-white bg-danger"><i class="fas fa-fw fa-fire"></i>{!! trans('messages.fire') !!}</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesIncendio}}</h1> Eventos Mes Actual</p>
				</div>
			</div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">
				<h5 class="card-header text-white bg-info"><i class="fas fa-fw fa-fire-extinguisher"></i> {!! trans('messages.leak') !!}</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesFuga}}</h1> {!! trans('messages.Current Month Events') !!}</p>
				</div>
			</div>
		</div>
		
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">
				<h5 class="card-header text-gray bg-light"><i class="fas fa-fw fa-wallet"></i> Claves</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesClave}}</h1> {!! trans('messages.Current Month Events') !!}</p>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card mb-4">
				<h5 class="card-header text-white bg-primary"><i class="fas fa-fw fa-wallet"></i> Comisiones</h5>
				<div class="card-body">
					<p class="card-text text-black">
					<h1>{{$mensualesServicio}}</h1> {!! trans('messages.Current Month Events') !!}</p>
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