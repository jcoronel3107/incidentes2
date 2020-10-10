	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )

		{{-- Contenedor Inundaciones --}}
  <div class="tab-pane fade show active" id="Vehiculos" role="tabpanel" aria-labelledby="Inundaciones-tab">
  		<div class="row">
  			<div class="col-xl-10 col-lg-10">

				<div class="py-2 " id="container1"></div>

			</div>

			<div class="col-xl-2 col-lg-2">

				<div class="py-2 " id="table1.1">
					<table class="table table-sm" id="datatable1.1">
				        <thead>
				            <tr>
				                <th class="table-dark">anio_fab</th>
				                <th class="table-dark">Cantidad</th>
				            </tr>
				        </thead>
				        <tbody>
				           @foreach ($vehiculosfabricacion as $registro)
				            <tr>
				                <td class="table-light">{{($registro->anio_fab)}}</td>
				                <td class="table-light">{{$registro->Cantidad}}</td>
				            </tr>
 							@endforeach
				        </tbody>
				    </table>
				</div>

			</div>
		</div>

  </div>
  		@push ('scripts')
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	{{-- Pestaña Inundaciones --}}
	<script >
		Highcharts.chart('container1', {
		    		data: {
		        table: 'datatable1.1',
		        name:'Vehiculos',
		    },
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Vehiculos Anio Fabricacion'
		    },
		    subtitle:{
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
    			    return 'Mes <b>' + this.x + '</b>, tiene <b>' + this.y + '</b> Vehiculo ';
   				 }
		    }
		});
	</script>{{-- Container Inundaciones Mensuales --}}
		@endpush
	@endsection
	@section( "piepagina" ) @endsection