	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<div class="py-2" id="grafica"></div>
		@push ('scripts')
			<script src="{{asset('js/highcharts.src.js')}}"></script>
			<script src="{{asset('js/highcharts-3d.js')}}"></script>
			<script src="{{asset('js/cylinder.js')}}"></script>
			<script src="{{asset('js/exporting.js')}}"></script>
			<script src="{{asset('js/offline-exporting.js')}}"></script>
			<script type="text/javascript">
				var inundaciones = <?php echo json_encode($inundaciones) ?>;
				Highcharts.chart({
						chart: {
	      					  renderTo: 'grafica',
	     					   type: 'line'
	    					},
					title:{
						text: 'Inundaciones Registradas 2020'
					},
					subtitle:{
								text: 'Grafica'
					},
					shadow: {
  						  	color: 'yellow',
    						width: 10,
    						offsetX: 0,
    						offsetY: 0
					},
					xAxis:{
						categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]
					},
					yAxis:{
						title:{
							text: 'Cantidad Inundaciones'
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
							name:'Inundaciones',
							data: inundaciones
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