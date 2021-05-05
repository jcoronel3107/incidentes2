@extends( "layouts.plantilla" )

@section( "cabeza" )


@endsection

@section( "cuerpo" )
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item" role="presentation">
		<a class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">General</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" id="Inundaciones-tab" data-toggle="tab" href="#Inundaciones" role="tab" aria-controls="Inundaciones" aria-selected="true">{!! trans('messages.flood') !!}</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" id="Rescates-tab" data-toggle="tab" href="#Rescates" role="tab" aria-controls="Rescates" aria-selected="false">{!! trans('messages.rescue') !!}</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" id="Transito-tab" data-toggle="tab" href="#Transito" role="tab" aria-controls="Transito" aria-selected="false">{!! trans('messages.transit') !!}</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" id="Salud-tab" data-toggle="tab" href="#Salud" role="tab" aria-controls="Salud" aria-selected="false">{!! trans('messages.Health') !!}</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" id="Fuego-tab" data-toggle="tab" href="#Fuego" role="tab" aria-controls="Fuego" aria-selected="false">{!! trans('messages.fire') !!}</a>
	</li>
	<li class="nav-item" role="presentation">
		<a class="nav-link" id="F-Gas-tab" data-toggle="tab" href="#F-Gas" role="tab" aria-controls="F-Gas" aria-selected="false">{!! trans('messages.leak') !!}</a>
	</li>
</ul>
<div class="tab-content" id="myTabContent">
	
	<div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
		<div class="row">
			<div class="col-xl-9 col-lg-9">

				<div class="py-2 " id="container0"></div>

			</div>

			<div class="col-xl-3 col-lg-3 " style="overflow-y: auto; width: 200px;">

				<div class="py-2 " id="table0.1">
					<table class="table table-sm" id="datatable0.1">
						<thead>
							<tr>
								<th class="table-dark">Incidente</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($EventosxIncidente as $registro)
							<tr>
								<td class="table-light">{{($registro->nombre_incidente)}}</td>
								<td class="table-light">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
		
	</div><!-- Contenedor General  -->
	
	<div class="tab-pane fade show " id="Inundaciones" role="tabpanel" aria-labelledby="Inundaciones-tab">
		<div class="row">
			<div class="col-xl-10 col-lg-10">

				<div class="py-2 " id="container1"></div>

			</div>

			<div class="col-xl-2 col-lg-2">

				<div class="py-2 " id="table1.1">
					<table class="table table-sm" id="datatable1.1">
						<thead>
							<tr>
								<th class="table-dark">Mes</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mensualesInundacion as $registro)
							<tr>
								<td class="table-light">{{($registro->Mes)}}</td>
								<td class="table-light">{{$registro->count}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
		<hr>
		<div class="row">
			{{-- Contenedor Inundacion x Incidente --}}
			<div class="col-xl-6 col-lg-6">
				<h3>Tipos Inundaciones</h3>
				<div class="py-2" id="table1.2">
					<table class="table table-sm" id="datatable1.2">
						<thead>
							<tr>
								<th class="table-dark">Nombre Incidente</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Inundacionxincidente as $registro)
							<tr>
								<td class="table-warning">{{$registro->nombre_incidente}}</td>
								<td class="table-warning">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="py-2" id="container1.2"></div>
			</div>
			{{-- Contenedor Inundacion x Estaciones --}}
			<div class="col-xl-6 col-lg-6">
				<h3>Asistencias x Estación</h3>
				<div class="py-2" id="table1.3">
					<table class="table table-sm" id="datatable1.3">
						<thead>
							<tr>
								<th class="table-dark">Estacion</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Inundacionxestacion as $registro)
							<tr>
								<td class="table-info">{{$registro->station_id}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="py-2" id="container1.3"></div>
			</div>
		</div>
		<hr>
		<div class="row">
			{{-- Contenedor Inundacion x Parroquias --}}
			<div class="col-xl-4 col-lg-4">
				<h3>Inundaciones por Parroquia</h3>
				<div class="py-2" id="table1.4">

					<table class="table table-sm" id="datatable1.4">
						<thead>
							<tr>
								<th class="table-dark">Parroquia</th>
								<th class="table-dark">Incidentes</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Inundacionxparroquia as $registro)
							<tr>
								<td class="table-light">{{$registro->nombre}}</td>
								<td class="table-light">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>

			</div>{{-- Contenedor Inundacion x Incidente --}}
			<div class="col-xl-8 col-lg-4 py-8" id="container1.4"></div>
		</div>
	</div><!-- Contenedor Inundaciones -->
	
	<div class="tab-pane fade" id="Rescates" role="tabpanel" aria-labelledby="Rescates-tab">
		<div class="row">{{-- Contenedor Grafico1 --}}
			<div class="col-xl-10 col-lg-10">
				<div class="py-2" id="container2"></div>
			</div>
			<div class="col-xl-2 col-lg-2">

				<div class="py-2 " id="table2.0">
					<table class="table table-sm" id="datatable2.0">
						<thead>
							<tr>
								<th class="table-dark">Mes</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mensualesRescate as $registro)
							<tr>
								<td class="table-light">{{($registro->Mes)}}</td>
								<td class="table-light">{{$registro->count}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-6">{{-- Contenedor Rescates x Incidente --}}
				<h3>Tipos Rescates</h3>
				<div class="py-2" id="table2.1">
					<table class="table table-sm" id="datatable2.1">
						<thead>
							<tr>
								<th class="table-dark">Nombre Incidente</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Rescatexincidente as $registro)
							<tr>
								<td class="table-info">{{$registro->nombre_incidente}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="py-2" id="container2.1"></div>
			</div>
			<hr>
			<div class="col-xl-6 col-lg-6">{{-- Contenedor Rescates x Estaciones --}}
				<h3>Asitencias por Estación</h3>
				<div class="py-2" id="table2.2">
					<table class="table table-sm" id="datatable2.2">
						<thead>
							<tr>
								<th class="table-dark">Estacion</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Rescatexestacion as $registro)
							<tr>
								<td class="table-info">{{$registro->station_id}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="py-2" id="container2.2"></div>
			</div>
		</div>
	</div><!-- Contenedor Rescates -->
	
	<div class="tab-pane fade" id="Transito" role="tabpanel" aria-labelledby="Transito-tab">
		<div class="row">
			<div class="col-xl-10 col-lg-10">

				<div class="py-2" id="container3"></div>

			</div>
			<hr>
			<div class="col-xl-2 col-lg-2">

				<div class="py-2 " id="table3">
					<table class="table table-sm" id="datatable3">
						<thead>
							<tr>
								<th class="table-dark">Mes</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mensualesTransito as $registro)
							<tr>
								<td class="table-warning">{{($registro->Mes)}}</td>
								<td class="table-warning">{{$registro->count}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>{{-- Contenedor Grafico2 --}}
		<div class="row">
			<div class="col-xl-6 col-lg-6">
				<div class="py-2" id="table3.1">
					<table class="table table-sm" id="datatable3.1">
						<thead>
							<tr>
								<th class="table-dark">Nombre Incidente</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Transitoxincidente as $registro)
							<tr>
								<td class="table-warning">{{$registro->nombre_incidente}}</td>
								<td class="table-warning">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="py-2" id="container3.1"></div>
			</div>{{-- Contenedor Inundacion x Incidente --}}
			<hr>
			<div class="col-xl-6 col-lg-6">
				<div class="py-2" id="table3.2">
					<table class="table table-sm" id="datatable3.2">
						<thead>
							<tr>
								<th class="table-dark">Estacion</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Transitoxestacion as $registro)
							<tr>
								<td class="table-info">{{$registro->station_id}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="py-2" id="container3.2"></div>
			</div>{{-- Contenedor Inundacion x Estaciones --}}
		</div>
	</div><!-- Contenedor Transito  -->
	
	<div class="tab-pane fade" id="Salud" role="tabpanel" aria-labelledby="Salud-tab">
		{{-- Contenedor Grafico4 --}}
		<div class="row">
			<div class="col-xl-10 col-lg-10">

				<div class="py-2" id="container4"></div>

			</div>
			<div class="col-xl-2 col-lg-2">

				<div class="py-2 " id="table4">
					<table class="table table-sm" id="datatable4">
						<thead>
							<tr>
								<th class="table-dark">Mes</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mensualesSalud as $registro)
							<tr>
								<td class="table-light">{{($registro->Mes)}}</td>
								<td class="table-light">{{$registro->count}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
		<hr>
		<div class="row">
			{{-- Contenedor Salud x Incidente --}}
			<div class="col-xl-6 col-lg-6">
				<div class="py-2" id="table4.1">
					<table class="table table-sm" id="datatable4.1">
						<thead>
							<tr>
								<th class="table-dark">Nombre Incidente</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Saludxincidente as $registro)
							<tr>
								<td class="table-info">{{$registro->nombre_incidente}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="py-2" id="container4.1"></div>
			</div>
			{{-- Contenedor Salud x Estaciones --}}
			<hr>
			<div class="col-xl-6 col-lg-6">
				<div class="py-2" id="table4.2">
					<table class="table table-sm" id="datatable4.2">
						<thead>
							<tr>
								<th class="table-dark">Estacion</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Saludxestacion as $registro)
							<tr>
								<td class="table-info">{{$registro->station_id}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="py-2" id="container4.2"></div>
			</div>
		</div>
		
	</div><!-- Contenedor Salud  -->
	
	<div class="tab-pane fade" id="Fuego" role="tabpanel" aria-labelledby="Fuego-tab">
		{{-- Contenedor Grafico5 --}}
		<div class="row">
			<div class="col-xl-9 col-lg-9">

				<div class="py-2" id="container5"></div>

			</div>
			<div class="col-xl-3 col-lg-3">

				<div class="py-2 " id="table5">
					<table class="table table-sm" id="datatable5">
						<thead>
							<tr>
								<th class="table-dark">Mes</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mensualesFuego as $registro)
							<tr>
								<td class="table-light">{{($registro->Mes)}}</td>
								<td class="table-light">{{$registro->count}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
		<hr>
		<div class="row">
			{{-- Contenedor Fuego x Incidente --}}
			<div class="col-xl-3 col-lg-3">
				<div class="py-2" id="table5.1">
					<table class="table table-sm" id="datatable5.1">
						<thead>
							<tr>
								<th class="table-dark">Nombre Incidente</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Fuegoxincidente as $registro)
							<tr>
								<td class="table-info">{{$registro->nombre_incidente}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
			<div class=" col-xl-9 col-lg-9 py-2" id="container5.1"></div>
		</div>
		{{-- Contenedor Fuego x Estaciones --}}
		<hr>
		<div class="row">
			<div class="col-xl-3 col-lg-3">
				<div class="py-2" id="table5.2">
					<table class="table table-sm" id="datatable5.2">
						<thead>
							<tr>
								<th class="table-dark">Estacion</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Fuegoxestacion as $registro)
							<tr>
								<td class="table-info">{{$registro->station_id}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
			<div class="col-xl-9 col-lg-9 py-2" id="container5.2"></div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xl-3 col-lg-3">
				<h3>Incendios por Parroquia</h3>
				<div class="py-2" id="table5.3">

					<table class="table table-sm" id="datatable5.3">
						<thead>
							<tr>
								<th class="table-dark">Parroquia</th>
								<th class="table-dark">Incidentes</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Incendiosxparroquia as $registro)
							<tr>
								<td class="table-light">{{$registro->nombre}}</td>
								<td class="table-light">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>

			</div>{{-- Contenedor Incendios x Parroquias --}}
			<div class="col-xl-9 col-lg-4 py-9" id="container5.3"></div>
		</div>
	</div><!-- Contenedor Fuego -->
	
	<div class="tab-pane fade" id="F-Gas" role="tabpanel" aria-labelledby="F-Gas-tab">
		{{-- Contenedor Grafico5 --}}
		<div class="row">
			<div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">

				<div class="py-2" id="container6"></div>

			</div>
			<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">

				<div class="py-2 " id="table6">
					<table class="table table-sm" id="datatable6">
						<thead>
							<tr>
								<th class="table-dark">Mes</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mensualesGas as $registro)
							<tr>
								<td class="table-light">{{($registro->Mes)}}</td>
								<td class="table-light">{{$registro->count}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div><!--  Contenedor Gas x mensualesGas -->
		<hr>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2" id="container6.1"></div>
			<div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2" id="table6.1">
				{{-- Contenedor Gas x Incidente --}}
				<table class="table table-sm" id="datatable6.1">
					<thead>
						<tr>
							<th class="table-dark">Nombre Incidente</th>
							<th class="table-dark">Asistencias</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($Gasxincidente as $registro)
						<tr>
							<td class="table-info">{{$registro->nombre_incidente}}</td>
							<td class="table-info">{{$registro->salidas}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div><!--  Contenedor Gas x Incidente -->
		<hr>
		<div class="row">
			<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 py-9" id="container6.2"></div>
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
				<div class="py-2" id="table6.2">
					<table class="table table-sm" id="datatable6.2">
						<thead>
							<tr>
								<th class="table-dark">Estacion</th>
								<th class="table-dark">Asistencias</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Gasxestacion as $registro)
							<tr>
								<td class="table-info">{{$registro->station_id}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

		</div><!-- Contenedor Gas x Estacion -->
		<hr>
		<div class="row">

			<div class="col-xl-3 col-lg-3">

				<div class="py-2" id="table6.3">

					<table class="table table-sm" id="datatable6.3">
						<thead>
							<tr>
								<th class="table-dark">Parroquia</th>
								<th class="table-dark">Incidentes</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($Gasxparroquia as $registro)
							<tr>
								<td class="table-light">{{$registro->nombre}}</td>
								<td class="table-light">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>

			</div>
			<div class="col-xl-9 col-lg-6 py-9" id="container6.3"></div>
		</div><!-- Contenedor Gas x Parroquias -->
		<hr>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 py-8" id="container6.4"></div>
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div class="py-2" id="table6.4">
					<table class="table table-sm" id="datatable6.4">
						<thead>
							<tr>
								<th class="table-dark">Tipo_Sistema</th>
								<th class="table-dark">Incidentes</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($GasxTipoCilindro as $registro)
							<tr>
								<td class="table-info">{{$registro->tipo_cilindro}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

		</div><!-- Contenedor Gas x Cilindro -->
		<hr>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 py-8" id="container6.5"></div>
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div class="py-2" id="table6.4">
					<table class="table table-sm" id="datatable6.5">
						<thead>
							<tr>
								<th class="table-dark">Color_Cilindro</th>
								<th class="table-dark">Incidentes</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($GasxColor as $registro)
							<tr>
								<td class="table-info">{{$registro->color_cilindro}}</td>
								<td class="table-info">{{$registro->salidas}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

		</div><!-- Contenedor Gas x Color -->
	</div> <!-- Contenedor F-Gas  -->

</div>





@push ('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- Pestaña General  -->
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
			type: 'pie'
		},
		title: {
			text: 'Incidentes Por Tipo (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
			/*formatter: function() {
    			    return 'Cant <b>' + this.y ;
   				 }*/
		}
	});
</script>
<!-- Pestaña Inundaciones  -->
<script>
	Highcharts.chart('container0.2', {

		series: [{
			type: 'areaspline',
			name: 'Inundacion',
			data: {
				table: 'datatable0.2',
				name: 'Incidentes',
			},
		}, {
			type: 'areaspline',
			name: 'Rescate',
			data: [2, 3, 5, 7, 6, 10, 8, 5, 12, 31]
		}, {
			type: 'areaspline',
			name: 'Transito',
			data: [4, 3, 3, 9, 0, 4, 3, 3, 9, 10]
		}, {
			type: 'areaspline',
			name: 'Salud',
			data: [14, 14, 13, 19, 10, 8, 5, 12, 31, 45]
		}, {
			type: 'areaspline',
			name: 'Fuego',
			data: [15, 22, 11, 33, 24, 13, 21, 11, 23, 14]
		}, {
			type: 'areaspline',
			name: 'Fuga',
			data: [13, 21, 11, 23, 14, 11, 23, 14, 13, 21]
		}, {
			type: 'areaspline',
			name: 'Derrame',
			data: [3, 21, 12, 3, 14, 21, 11, 23, 14, 11]
		}],

		title: {
			text: 'Eventos (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Cant <b>' + this.y;
			}
		},
		plotOptions: {
			areaspline: {
				fillOpacity: 0.4
			}
		}
	});
</script>
<script>
	Highcharts.chart('container1', {
		data: {
			table: 'datatable1.1',
			name: 'Incidentes',
		},
		chart: {
			type: 'line'
		},
		title: {
			text: 'Inundaciones (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Mes <b>' + this.x + '</b>, tiene <b>' + this.y + '</b> Asistencias ';
			}
		}
	});
</script><!-- Container Inundaciones Mensuales -->
<script>
	Highcharts.chart('container1.2', {
		data: {
			table: 'datatable1.2',
			name: 'Incidentes',
		},
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Tipo Inundacion (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return this.y + '</b>, Incidentes ';
			}
		}
	});
</script><!--  Container Inundaciones x Incidente  -->
<script>
	Highcharts.chart('container1.3', {
		data: {
			table: 'datatable1.3'
		},
		chart: {
			type: 'column'
		},
		title: {
			text: 'Asistencias Inundación por Estacion (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Estacion <b>' + this.x + '</b> tiene <b>' + this.y + '</b>, Asistencias ';
			}
		}
	});
</script><!-- Container Inundaciones x Estaciones  -->
<script>
	Highcharts.chart('container1.4', {
		data: {
			table: 'datatable1.4'
		},
		chart: {
			type: 'area'
		},
		title: {
			text: 'Asistencias Inundación por Parroquia (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return this.y + '</b>, Incidentes ';
			}
		}
	});
</script><!-- Container Inundaciones x Parroquia -->

{{-- Pestaña Rescates --}}
<script>
	Highcharts.chart('container2', {
		data: {
			table: 'datatable2.0',
			name: 'Incidentes',
		},
		chart: {
			type: 'line'
		},
		title: {
			text: 'Tipo Rescate (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Mes <b>' + this.x + '</b>, tiene <b>' + this.y + '</b> Asistencias ';
			}
		}
	});
</script>{{-- Container Rescate Mensuales--}}
<script>
	Highcharts.chart('container2.1', {
		data: {
			table: 'datatable2.1',
			name: 'Incidentes',
		},
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Tipo Rescate (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return this.y + '</b>, Incidentes ';
			}
		}
	});
</script>{{-- Container Rescate x Incidente --}}
<script>
	Highcharts.chart('container2.2', {
		data: {
			table: 'datatable2.2'
		},
		chart: {
			type: 'column'
		},
		title: {
			text: 'Asistencias Rescate por Estacion (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Estacion <b>' + this.x + '</b> tiene <b>' + this.y + '</b>, Asistencias ';
			}
		}
	});
</script>{{-- Container Rescate x Estaciones --}}

{{-- Pestaña Transito --}}
<script>
	Highcharts.chart('container3', {
		data: {
			table: 'datatable3',
			name: 'Incidentes',
		},
		chart: {
			type: 'line'
		},
		title: {
			text: 'Transito (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Mes <b>' + this.x + '</b>, tiene <b>' + this.y + '</b> Asistencias ';
			}
		}
	});
</script>{{-- Container Transito Mensuales--}}
<script>
	Highcharts.chart('container3.1', {
		data: {
			table: 'datatable3.1',
			name: 'Incidentes',
		},
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Tipo Transito (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return this.y + '</b>, Incidentes ';
			}
		}
	});
</script>{{-- Container Transito x Incidente --}}
<script>
	Highcharts.chart('container3.2', {
		data: {
			table: 'datatable3.2'
		},
		chart: {
			type: 'column'
		},
		title: {
			text: 'Asistencias Transito por Estacion (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Estacion <b>' + this.x + '</b> tiene <b>' + this.y + '</b>, Asistencias ';
			}
		}
	});
</script>{{-- Container Transito x Estaciones --}}

{{-- Pestaña Salud --}}
<script>
	Highcharts.chart('container4', {
		data: {
			table: 'datatable4',
			name: 'Incidentes',
		},
		chart: {
			type: 'line'
		},
		title: {
			text: 'Salud (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Mes <b>' + this.x + '</b>, tiene <b>' + this.y + '</b> Asistencias ';
			}
		}
	});
</script>{{-- Container Salud Mensuales--}}
<script>
	Highcharts.chart('container4.1', {
		data: {
			table: 'datatable4.1',
			name: 'Incidentes',
		},
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Salud (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return this.y + '</b>, Incidentes ';
			}
		}
	});
</script>{{-- Container Salud x Incidente --}}
<script>
	Highcharts.chart('container4.2', {
		data: {
			table: 'datatable4.2'
		},
		chart: {
			type: 'column'
		},
		title: {
			text: 'Asistencias Salud por Estacion (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Estacion <b>' + this.x + '</b> tiene <b>' + this.y + '</b>, Asistencias ';
			}
		}
	});
</script>{{-- Container Salud x Estaciones --}}

{{-- Pestaña Fuego --}}
<script>
	Highcharts.chart('container5', {
		data: {
			table: 'datatable5',
			name: 'Incidentes',
		},
		chart: {
			type: 'line'
		},
		title: {
			text: 'Fuego (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Mes <b>' + this.x + '</b>, tiene <b>' + this.y + '</b> Asistencias ';
			}
		}
	});
</script>{{-- Container Fuego Mensuales--}}
<script>
	Highcharts.chart('container5.1', {
		data: {
			table: 'datatable5.1',
			name: 'Incidentes',
		},
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Fuego (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return this.y + '</b>, Incidentes ';
			}
		}
	});
</script>{{-- Container Salud x Incidente --}}
<script>
	Highcharts.chart('container5.2', {
		data: {
			table: 'datatable5.2'
		},
		chart: {
			type: 'column'
		},
		title: {
			text: 'Asistencias Fuego por Estacion (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Estacion <b>' + this.x + '</b> tiene <b>' + this.y + '</b>, Asistencias ';
			}
		}
	});
</script>
<script>
	Highcharts.chart('container5.3', {
		data: {
			table: 'datatable5.3'
		},
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Asistencias Fuego por Parroquia (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Parroquia <b>' + this.x + '</b> tiene <b>' + this.y + '</b>, Asistencias ';
			}
		}
	});
</script>

{{-- Pestaña Fuga --}}
<script>
	Highcharts.chart('container6', {
		data: {
			table: 'datatable6',
			name: 'Incidentes',
		},
		chart: {
			type: 'line'
		},
		title: {
			text: 'Fuga (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Mes <b>' + this.x + '</b>, tiene <b>' + this.y + '</b> Asistencias ';
			}
		}
	});
</script><!-- Container Fuga Mensuales -->
<script>
	Highcharts.chart('container6.1', {
		data: {
			table: 'datatable6.1',
			name: 'Incidentes',
		},
		chart: {
			type: 'pie'
		},
		title: {
			text: 'Incidentes (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return this.y + '</b>, Incidentes ';
			}
		}
	});
</script><!-- Container Fuga x Incidente -->
<script>
	Highcharts.chart('container6.2', {
		data: {
			table: 'datatable6.2'
		},
		chart: {
			type: 'column'
		},
		title: {
			text: 'Asistencias Fuga por Estacion (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		},
		tooltip: {
			formatter: function() {
				return 'Estacion <b>' + this.x + '</b> tiene <b>' + this.y + '</b>, Asistencias ';
			}
		}
	});
</script><!-- Container Fuga x Estaciones -->
<script>
	Highcharts.chart('container6.3', {
		data: {
			table: 'datatable6.3'
		},
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Asistencias Fuga por Parroquia (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		}
	});
</script><!-- Container Fuga x Parroquia -->
<script>
	Highcharts.chart('container6.4', {
		data: {
			table: 'datatable6.4'
		},
		chart: {
			type: 'pie'
		},
		title: {
			text: 'Fuga por Sistema (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		}

	});
</script><!-- Container Fuga x Sistema -->
<script>
	Highcharts.chart('container6.5', {
		data: {
			table: 'datatable6.5'
		},
		chart: {
			type: 'pie'
		},
		title: {
			text: 'Fuga por Color Cilindro (Anual)'
		},
		subtitle: {
			text: 'Grafica'
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'Units'
			}
		}

	});
</script><!-- Container Fuga x Color -->
@endpush
@endsection
@section( "piepagina" ) @endsection