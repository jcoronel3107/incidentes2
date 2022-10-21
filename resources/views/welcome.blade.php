@extends( "layouts.plantilla" )

@section( "cabeza" )

<title>Incidentes2 - BCBVC</title>

@endsection

@section( "cuerpo" )
	<div class="d-flex flex-wrap">
				<div class="col-lg-2 col-md-6 col-sm-12">
					<div class="card border-left-warning shadow ">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col">
									<h5 class="h5 mb-0 text-gray-800"> {!! trans('messages.Health') !!}</h5>
									<div class="text-xs text-warning text-uppercase mb-1">
										<h1>{{$mensualesSalud}}</h1> {!! trans('messages.Current Month Events') !!}
									</div>
								</div>
								<div class="col-auto">
									<i class="fas fa-fw fa-heartbeat fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-12">
					<div class="card border-left-danger shadow">
						<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col">
										<h5 class="h5 mb-0 text-gray-800"> {!! trans('messages.fire') !!}</h5>
										<div class="text-xs text-danger text-uppercase mb-1">
											<h1>{{$mensualesIncendio}}</h1> {!! trans('messages.Current Month Events') !!}
										</div>
									</div>
									<div class="col-auto">
										<i class="fas fa-fw fa-fire fa-2x text-gray-300"></i>
									</div>
								</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-2 col-md-6 col-sm-12">
					<div class="card border-left-info shadow">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col">
									<h5 class="h5 mb-0 text-gray-800"> {!! trans('messages.flood') !!}</h5>
									<div class="text-xs text-info text-uppercase mb-1">
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
				
				<div class="col-lg-2 col-md-6 col-sm-12">
					<div class="card border-left-secondary shadow">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col">
									<h5 class="h5 mb-0 text-gray-800"> {!! trans('messages.rescue') !!}</h5>
									<div class="text-xs text-secondary text-uppercase mb-1">
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
				
				<div class="col-lg-2 col-md-6 col-sm-12">
					<div class="card border-left-info shadow">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col">
									<h5 class="h5 mb-0 text-gray-800"> {!! trans('messages.transit') !!}</h5>
									<div class="text-xs text-info text-uppercase mb-1">
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
				<div class="col-lg-2 col-md-6 col-sm-12">	
					<div class="card border-left-success shadow">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class=" col">
									<h5 class="h5 mb-0 text-gray-800"> {!! trans('messages.leak') !!}</h5>
									<div class="text-xs text-success text-uppercase mb-1">
											<h1>{{$mensualesFuga}}</h1> {!! trans('messages.Current Month Events') !!}
									</div>
								</div>
								<div class="col-auto">
									<i class="fas fa-fw fa-fire-extinguisher fa-2x"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				
	</div>
	
		<div class="row d-flex mr-4 mt-4">
			<div class="col-lg-9 col-md-12 col-sm-12">
				<div class="card border-left-primary shadow ">
					<div class="card-body">						
							<div class="py-2 " id="container0"></div>
							<div class="col-xl-8 col-lg-8 " hidden style="overflow-y: auto; width: 200px;"> <!-- table0.1 -->
				
								<div class="py-2"  id="table0.1">
									<table class="table " id="datatable0.1">
										<thead>
											<tr>
												<th class="table-dark">Mes</th>
												<th class="table-dark">Inundaciones</th>
												<th class="table-dark">Rescates</th>
												<th class="table-dark">Transitos</th>
												<th class="table-dark">Salud</th>
												<th class="table-dark">Incendios</th>
												<th class="table-dark">Fuga</th>
												<th class="table-dark">Derrame</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($EventosMensuales as $registro)
											<tr>
												@if($registro->Incidentes=="inundaciones")
												<td class="table-light">{{$registro->Mes}}</td>
													<td class="table-light">{{$registro->cant}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>	
													@continue		
												@endif
												@if($registro->Incidentes=="rescates")
												<td class="table-light">{{$registro->Mes}}</td>
													<td class="table-light"></td>
													<td class="table-light">{{$registro->cant}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>	
													@continue				
												@endif										
												@if($registro->Incidentes=="transitos")
												<td class="table-light">{{$registro->Mes}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light">{{$registro->cant}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													@continue	
												@endif
												@if($registro->Incidentes=="saluds")
												<td class="table-light">{{$registro->Mes}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light">{{$registro->cant}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													@continue	
												@endif
												@if($registro->Incidentes=="incendios")
												<td class="table-light">{{$registro->Mes}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light">{{$registro->cant}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													@continue	
												@endif
												@if($registro->Incidentes=="fugas")
												<td class="table-light">{{$registro->Mes}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light">{{$registro->cant}}</td>
													<td class="table-light"></td>
													@continue	
												@endif
												@if($registro->Incidentes=="derrames")
												<td class="table-light">{{$registro->Mes}}</td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light"></td>
													<td class="table-light">{{$registro->cant}}</td>
													
													@continue	
												@endif
												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
				
							</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-12 col-sm-12">
				<div class="card mb-2 border-left-primary shadow ">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col">
								<h5 class="h5 mb-0 text-gray-800"> {!! trans('messages.Hazmat') !!}</h5>
								<div class="text-xs text-primary text-uppercase">
									<h1>{{$mensualesDerrame}}</h1> {!! trans('messages.Current Month Events') !!}
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-fw fa-life-ring fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-2 text-white text-sm o-hidden ">
					<div class="card-body text-white bg-secondary"> 
						<div class="card-body-icon">
							<i class="fas fa-gas-pump"></i>
						</div>
						<p class="card-text">
							<h3>{{$mensualesClave}}</h3> {!! trans('messages.Current Month Events') !!}
						</p>
						<p>
							<h4 class="text-white">
								# Claves
							</h4>
						</p>
					</div>	
				</div>
				<div class="card mb-1 text-white text-sm o-hidden ">
					<div class="card-body text-white bg-primary">
						<div class="card-body-icon"><i class="fas fa-ambulance"></i> 
						</div>
						<p class="card-text ">
							<h3>{{$EventosxIncidente}}</h3> {!! trans('messages.Current Month Events') !!}
						</p>
						<p>
							<h4 class="text-white">
								# Atenciones
							</h4>
						</p>
					</div>
				</div>
			</div>
		</div>
		{{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#f3f4f5" fill-opacity="1" d="M0,128L60,122.7C120,117,240,107,360,96C480,85,600,75,720,96C840,117,960,171,1080,186.7C1200,203,1320,181,1380,170.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg> --}}
		<!--Waves Container-->  
			<div class="flex">  
				<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  
				viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">  
				<defs>  
				<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />  
				</defs>  
				<g class="parallax">  
				<use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />  
				<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />  
				<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />  
				<use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />  
				</g>  
				</svg>  
			</div>  
	 	<!--Waves end--> 
	

	
	
@push ('scripts')

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>
	
	Highcharts.chart('container0', {
		data: {
			table: 'datatable0.1',
			name: 'Incidentes',
		},
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'line'
		},
		title: {
			text: 'Incidentes Por Tipo (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			crosshair: true,
		},
		xAxis: {
            
			allowDecimals: false,
			crosshair: true,
			categories: ['','Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		tooltip: {
			pointFormat: '{series.name}:<b>{point.y}</b>',
		},
		plotOptions: {
            line: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.y}</b>'
            }
        }
    },
		
		
	});
</script>

@endpush
@endsection

@section( "piepagina" )


@endsection