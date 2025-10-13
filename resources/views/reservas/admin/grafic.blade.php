	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
	@can('view estadistica')
		<div class="row ">
			<div class="py-2 col-lg-6 col-md-6 col-sm-12 " id="grafica">
	  		</div>
	  		<div class="py-2 col-lg-6 col-md-6 col-sm-12" id="grafica2">
	  		</div>
	  		<div class="py-2 col-lg-6 col-md-6 col-sm-12" id="grafica3">
	  		</div>
	  		<div class="py-2 col-lg-6 col-md-6 col-sm-12" id="grafica4">
	  		</div>
		</div>
	@else
       <p>Lo sentimos, No Tienes Permisos de Revision.</p>
    @endcan
  		@push ('scripts')
			<script src="{{asset('js/highcharts.src.js')}}"></script>
			<script src="{{asset('js/exporting.js')}}"></script>
			<script src="{{asset('js/offline-exporting.js')}}"></script>

			<script type="text/javascript">
				var reservas = <?php echo json_encode($reservas) ?>;
				Highcharts.chart({
					chart: {
			        renderTo: 'grafica',
			        type: 'line'
			    	},
					title:{
						text: 'Reservas Confirmadas'
					},
					subtitle:{
								text: 'Grafica'
					},
					xAxis:{
						/*categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]*/
						categories:['Ago','Sep','Oct','Nov','Dic',]
					},
					yAxis:{
						title:{
							text: 'Reservaciones Confirmadas'
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
							name:'Reservas',
							data: reservas
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
			<script type="text/javascript">
				var reservasCanceladas = <?php echo json_encode($reservasCanceladas) ?>;
				Highcharts.chart({
					chart: {
			        renderTo: 'grafica2',
			        type: 'line'
			    	},
					title:{
						text: 'Reservas Canceladas'
					},
					subtitle:{
								text: 'Grafica'
					},
					xAxis:{
						/*categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]*/
						categories:['Ago','Sep','Oct','Nov','Dic',]
					},
					yAxis:{
						title:{
							text: 'Reservaciones Canceladas'
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
							name:'Reservas',
							data: reservasCanceladas
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
			<script type="text/javascript">
				var reservasregistradas = <?php echo json_encode($reservasregistradas) ?>;
				Highcharts.chart({
					chart: {
			        renderTo: 'grafica3',
			        type: 'line'
			    	},
					title:{
						text: 'Reservas Registradas'
					},
					subtitle:{
								text: 'Grafica'
					},
					xAxis:{
						/*categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]*/
						categories:['Ago','Sep','Oct','Nov','Dic',]
					},
					yAxis:{
						title:{
							text: 'Reservaciones Registradas'
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
							name:'Reservas',
							data: reservasregistradas
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
			<script type="text/javascript">
				var reservasasistidas = <?php echo json_encode($reservasasistidas) ?>;
				Highcharts.chart({
					chart: {
			        renderTo: 'grafica4',
			        type: 'line'
			    	},
					title:{
						text: 'Reservas Asistidas'
					},
					subtitle:{
								text: 'Grafica'
					},
					xAxis:{
						/*categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]*/
						categories:['Ago','Sep','Oct','Nov','Dic',]
					},
					yAxis:{
						title:{
							text: 'Reservaciones Asistidas'
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
							name:'Reservas',
							data: reservasasistidas
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