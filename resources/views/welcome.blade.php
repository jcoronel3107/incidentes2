@extends( "layouts.plantilla" )

@section( "cabeza" )

<title>Incidentes2 - BCBVC</title>
<style type="text/css">
	.clockdate-wrapper {
		background-color: #333;
		padding: 25px;
		max-width: 350px;
		width: 100%;
		text-align: center;
		border-radius: 5px;
		margin: 0 auto;

	}

	#clock {
		background-color: #333;
		font-family: sans-serif;
		font-size: 50px;
		text-shadow: 0px 0px 1px #fff;
		color: #fff;
	}

	#clock span {
		color: #888;
		text-shadow: 0px 0px 1px #333;
		font-size: 30px;
		position: relative;
		top: -27px;
		left: -10px;
	}

	#date {
		letter-spacing: 10px;
		font-size: 14px;
		font-family: arial, sans-serif;
		color: #fff;
	}

	#topbar {
		
		font-size: 30px;
		color: white;
		padding: 2px;
	}

	input,
	button {
		font-family: 'Zilla Slab', sans-serif;
		font-weight: bold;
		font-size: 16px;
		color: white;
	}

	#searchbox {
		padding: 10px;
		background-color: #373737;
		display: none;
	}


	#searchbox input {
		height: 25px;
		color: #373737;
		width: 200px;
		padding-left: 5px;
	}

	#searchbox button {
		height: 31px;
		background-color: #111;
		border: 3px solid #43d8c9;
		width: 80px;
	}

	#topbar #searchicon {
		float: right;
	}

	#city {
		font-size: 30px;
		text-align: left;
		padding-top: 40px;
		padding-left: 30px;
	}

	#mainbody img {
		float: right;
		padding-right: 20px;
		font-size: 20px;
	}

	#mainbody {
		color: white;
		background-color: cadetblue;
		margin-top: 10px;
		height: 100%;
		width: 100%;
		text-align: center;
		animation: appear 1s 1;
	}

	#temp {
		float: right;
		font-size: 25px;
		padding-right: 15px;
		font-weight: bold;
	}

	#cond {
		float: left;
		font-size: 20px;
		padding-left: 15px;
		padding-top: 8px;
	}

	#wind {
		text-align: right;
	}

	#label {
		font-size: 20px;
		font-weight: 200;
		padding: 2px;
		text-align: center;
		padding-top: 20px;
	}

	@keyframes appear {
		from {
			width: 0px;
		}

		to {

			width: 300px;
		}
	}

	@keyframes forecast {
		from {
			height: 0px;
			width: 0px;
		}

		to {
			height: 420px;
			width: 300px;
		}
	}
</style>

@endsection

@section( "cuerpo" )

<div class="row">
	<div class="col-xl-12 col-md-12 col-sm-12" id="clockdate">
		<div class="card mb-4 ">

			<div class="card-body">
				<div class="clockdate-wrapper">
					<div id="clock"></div>
					<div id="date"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
		<div class="card mb-4">

			<h5 class="card-header text-white bg-primary"><i class="fas fa-fw fa-shower"></i> {!! trans('messages.flood') !!}</h5>
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
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
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
<script type="text/javascript">
	function startTime() {
		var today = new Date();
		var hr = today.getHours();
		var min = today.getMinutes();
		var sec = today.getSeconds();
		ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
		hr = (hr == 0) ? 12 : hr;
		hr = (hr > 12) ? hr - 12 : hr;
		//Add a zero in front of numbers<10
		hr = checkTime(hr);
		min = checkTime(min);
		sec = checkTime(sec);
		document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;

		var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		var days = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
		var curWeekDay = days[today.getDay()];
		var curDay = today.getDate();
		var curMonth = months[today.getMonth()];
		var curYear = today.getFullYear();
		var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear;
		document.getElementById("date").innerHTML = date;

		var time = setTimeout(function() {
			startTime()
		}, 500);
	}

	function checkTime(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}
</script>
@endpush
@endsection

@section( "piepagina" )


@endsection