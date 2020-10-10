	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<div class="py-2" id="grafica">
  		</div>
  		@push ('scripts')
			<script src="{{asset('js/highcharts.src.js')}}"></script>
			<script src="{{asset('js/exporting.js')}}"></script>
			<script src="{{asset('js/offline-exporting.js')}}"></script>

			<script type="text/javascript">
		var fugas = <?php echo json_encode($fugas) ?>;
		Highcharts.chart({
			chart: {
	        renderTo: 'grafica',
	        type: 'line'
	    	},
			title:{
				text: 'Evento Fugas'
			},
			subtitle:{
						text: 'Grafica'
			},
			xAxis:{
				categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]
			},
			yAxis:{
				title:{
					text: 'Fugas'
				}
			},
			legend:{
				layout:'vertical',
				align: 'right',
				verticalAling:'middle'
			},
			plotOptions:{
				series:{
					allowPointSelect:true
				}
			},
			series:[{
					name:'Fugas',
					data: fugas
			}],
			responsive:{
				rules:[{
						condition: {
							maxWidth:500
						},
						chartOptions:{
							legend:{
								layout: 'horizontal',
								aling:'center',
								verticalAling:'bottom'
							}
						}
				}]
			}
		});
			</script>
		@endpush
	@endsection
	@section( "piepagina" ) @endsection