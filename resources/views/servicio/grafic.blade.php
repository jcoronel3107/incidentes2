	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )


		{{-- Contenedor Grafico --}}
  		<div class="py-2" id="container1"></div>
  		<div class="row">
  			{{-- Contenedor Claves --}}
			<div class="col-xl-6 col-lg-6 align-self-center">
				<div class="py-2" id="table1">
					<table class="table table-sm" id="datatable1">
				        <thead>
				            <tr>
				                <th class="table-dark">Mes</th>
				                <th class="table-dark">Asistencias</th>
				            </tr>
				        </thead>
				        <tbody>
				           @foreach ($claves as $registro)
				            <tr>
				                <td class="table-warning">{{$registro->Mes}}</td>
				                <td class="table-warning">{{$registro->count}}</td>
				            </tr>
 							@endforeach
				        </tbody>
				    </table>
				</div>
				<div class="py-2" id="container1"></div>
			</div>
		</div>



	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script >
		Highcharts.chart('container1', {
		    		data: {
		        table: 'datatable1',
		        name:'Incidentes',
		    },
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Claves 14 (Anual)'
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
    			    return 'Mes <b>' + this.x + '</b>, tiene <b>' + this.y + '</b> Asistencias ';
   				 }
		    }
		});
	</script>{{-- Container Rescate Mensuales--}}
@endsection
@section( "piepagina" ) @endsection