	@extends( "layouts.plantilla" )

	@section( "cabeza" )

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
	</style>

	@endsection

	@section( "cuerpo" )
	
	<div class="row">
		<h1> <i class="fa fa-university" aria-hidden="true"></i> {{$station}}</h1>
		<input type="text" hidden name="estacion_id" id="estacion_id" value="{{$estacion_id}}">
	</div>
	<div class="row mb-4">
		<div class="col-xl-12 col-md-12 sm-12 " id="clockdate">
			<div class="card mb-4 ">
				<div class="card-body">
					<div class="clockdate-wrapper">
						<div id="clock"></div>
						<div id="date"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header text-white bg-info">
					<a>
						<h5 title="Crea {!! trans('messages.flood') !!}" class=" text-white bg-info"><i class="fas fa-fw fa-shower"></i>{!! trans('messages.flood') !!}</h5>
					</a>
				</div>
				<div class="card-body">
					@can('create event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.New') !!}" class="btn btn-primary text-center" target="_blank" href="/inundacion/create"><i class="fa fa-plus" aria-hidden="true"></i></a>
					@endcan
					@can('read event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.Index') !!}" class="btn btn-info text-center" target="_blank" href="/inundacion"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
					@endcan
					<h1 class="text-center">{{"$InundacionEst"}}</h1>
					<a rel="nofollow noopener noreferrer" target="_blank">
						<p class="card-text text-center text-black"> {!! trans('messages.Current Month Events') !!}</p>
					</a>
				</div>
			</div>
		</div>	
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header text-white bg-info">
					<a>
						<h5 title="Crea {!! trans('messages.rescue') !!}" class=" text-white bg-info"><i class="fas fa-fw fa-life-ring"></i>{!! trans('messages.rescue') !!}</h5>
					</a>
				</div>
				<div class="card-body">
					@can('create event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.New') !!}" class="btn btn-primary text-center" target="_blank" href="/rescate/create"><i class="fa fa-plus" aria-hidden="true"></i></a>
					@endcan
					@can('read event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.Index') !!}" class="btn btn-info text-center" target="_blank" href="/rescate"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
					@endcan
					<h1 class="text-center">{{$RescateEst}}</h1>
					<a rel="nofollow noopener noreferrer" target="_blank">
						<p class="card-text text-center text-black"> {!! trans('messages.Current Month Events') !!}</p>
					</a>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header text-white bg-info">
					<a>
						<h5 title="Crea {!! trans('messages.rescue') !!}" class=" text-white bg-info"><i class="fas fa-fw fa-life-ring"></i>{!! trans('messages.Hazmat') !!}</h5>
					</a>
				</div>
				<div class="card-body">
					@can('create event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.New') !!}" class="btn btn-primary text-center" target="_blank" href="/derrame/create"><i class="fa fa-plus" aria-hidden="true"></i></a>
					@endcan
					@can('read event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.Index') !!}" class="btn btn-info text-center" target="_blank" href="/derrame"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
					@endcan
					<h1 class="text-center">{{$HazmatEst}}</h1>
					<a rel="nofollow noopener noreferrer" target="_blank">
						<p class="card-text text-center text-black"> {!! trans('messages.Current Month Events') !!}</p>
					</a>
				</div>

			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header text-white bg-info">
					<a>
						<h5 title="Crea {!! trans('messages.rescue') !!}" class=" text-white bg-info"><i class="fas fa-fw fa-wrench"></i>{!! trans('messages.transit') !!}</h5>
					</a>

				</div>
				<div class="card-body">
					@can('create event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.New') !!}" class="btn btn-primary text-center" target="_blank" href="/transito/create"><i class="fa fa-plus" aria-hidden="true"></i></a>
					@endcan
					@can('read event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.Index') !!}" class="btn btn-info text-center" target="_blank" href="/transito"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
					@endcan
					<h1 class="text-center">{{$TransitoEst}}</h1>
					<a rel="nofollow noopener noreferrer" target="_blank">
						<p class="card-text text-center text-black"> {!! trans('messages.Current Month Events') !!}</p>
					</a>
				</div>

			</div>

		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header text-white bg-info">
					<a>
						<h5 title="Crea {!! trans('messages.rescue') !!}" class=" text-white bg-info"><i class="fas fa-fw fa-heartbeat"></i>{!! trans('messages.Health') !!}</h5>
					</a>

				</div>
				<div class="card-body">
					@can('create event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.New') !!}" class="btn btn-primary text-center" target="_blank" href="/salud/create"><i class="fa fa-plus" aria-hidden="true"></i></a>
					@endcan
					@can('read event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.Index') !!}" class="btn btn-info text-center" target="_blank" href="/salud"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
					@endcan
					<h1 class="text-center">{{$SaludEst}}</h1>
					<a rel="nofollow noopener noreferrer" target="_blank">
						<p class="card-text text-center text-black"> {!! trans('messages.Current Month Events') !!}</p>
					</a>
				</div>

			</div>


		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header text-white bg-info">
					<a>
						<h5 title="Crea {!! trans('messages.rescue') !!}" class=" text-white bg-info"><i class="fas fa-fw fa-fire"></i>{!! trans('messages.fire') !!}</h5>
					</a>
				</div>
				<div class="card-body">
					@can('create event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.New') !!}" class="btn btn-primary text-center" target="_blank" href="/fuego/create"><i class="fa fa-plus" aria-hidden="true"></i></a>
					@endcan
					@can('read event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.Index') !!}" class="btn btn-info text-center" target="_blank" href="/fuego"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
					@endcan
					<h1 class="text-center">{{$FuegoEst}}</h1>
					<a rel="nofollow noopener noreferrer" target="_blank">
						<p class="card-text text-center text-black"> {!! trans('messages.Current Month Events') !!}</p>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header text-white bg-info">
					<a>
						<h5 title="Crea {!! trans('messages.rescue') !!}" class=" text-white bg-info"><i class="fas fa-fw fa-fire-extinguisher"></i>{!! trans('messages.leak') !!}</h5>
					</a>

				</div>
				<div class="card-body">
					@can('create event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.New') !!}" class="btn btn-primary text-center" target="_blank" href="/fuga/create"><i class="fa fa-plus" aria-hidden="true"></i></a>
					@endcan
					@can('read event')
					<a rel="nofollow noopener noreferrer" title="{!! trans('messages.Index') !!}" class="btn btn-info text-center" target="_blank" href="/fuga"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
					@endcan
					<h1 class="text-center">{{$FugaEst}}</h1>
					<a rel="nofollow noopener noreferrer" target="_blank">
						<p class="card-text text-center text-black"> {!! trans('messages.Current Month Events') !!}</p>
					</a>
				</div>

			</div>


		</div>
	</div>
	@push ('scripts')
	<script src="/js/session.js"></script>
	<script src="/js/clock.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			document.title = "<?php echo $station . ' - BCBVC'; ?>";
		});
	</script>
	@endpush
	@endsection

	@section( "piepagina" )


	@endsection