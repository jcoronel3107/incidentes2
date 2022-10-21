@extends( "layouts.plantilla" )

@section( "cabeza" )

   

@endsection

@section( "cuerpo" )
	<div class="row align-items-center mb-5">
		<h1>Recurso Humano</h1>
	</div>
	<div class="row nav justify-content-end">
		<li class="nav-item">
			<div class="input-group mb-3">
					@can('allow export')
						<div class="input-group-prepend ml-2">
							<span title="Export PDF" class="input-group-text"><i class="icon-cloud-upload"></i></span>
						</div>
						<a class="btn btn-outline-info" title="Export PDF" href="/users/export">Exportar_PDF</a>
						<div class="input-group-prepend ml-2">
							<span title="Export XLSX" class="input-group-text"><i class="icon-cloud-upload"></i></span>
						</div>
						<a class="btn btn-outline-primary" title="Export XLSX" href="/users/export-xls">Exportar_XLSX</a>
					@endcan
			</div> 
		</li>
	</div>
	<div class="row justify-content-center ml-5">
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
				<div class="card text-white bg-primary o-hidden h-100">
						<div class="card-body text-white bg-primary">
							<div class="card-body-icon"><i class="fas fa-id-badge"></i></div>
							<div class="mr-4"> <h5>Nombramiento Definitivo</h5></div>
							<div class="mr-5"> <h1>{{$Nombramiento_employee->count()}}</h1></div>
						</div>
						<a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal1" href="#">
							<span class="float-left">Ver detalles</span>
							<span class="float-right"><i class="fas fa-angle-right"></i></span>
						</a>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
				<div class="card text-white bg-info o-hidden h-100">
						<div class="card-body text-white bg-info">
							<div class="card-body-icon"><i class="fas fa-user-tie"></i></div>
							<div class="mr-4"> <h5>Contrato Codigo Trabajo</h5></div>
							<div class="mr-5"> <h1>{{$Codigo_employee->count()}}</h1></div>
						</div>
						<a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal2" href="#">
							<span class="float-left">Ver detalles</span>
							<span class="float-right"><i class="fas fa-angle-right"></i></span>
						</a>
				</div>
			</div>	
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
				<div class="card text-white bg-warning o-hidden h-100">
						<div class="card-body text-white bg-warning">
							<div class="card-body-icon"><i class="fas fa-id-badge"></i></div>
							<div class="mr-4"> <h5>Contrato Ocacional</h5></div>
							<div class="mr-5"> <h1>{{$Ocacional_employee->count()}}</h1></div>
						</div>
						<a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal3" href="#">
							<span class="float-left">Ver detalles</span>
							<span class="float-right"><i class="fas fa-angle-right"></i></span>
						</a>
				</div>
			</div>
	</div>
	<div class="row justify-content-center ml-5">
		<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
			<div class="card text-black bg-light o-hidden h-100">
					<div class="card-body text-black bg-light">
						<div class="card-body-icon"><i class="fas fa-user-tie"></i> </div>
						<div class="mr-4"> <h5>Nombramiento Provisional</h5></div>
						<div class="mr-5"> <h1>{{$NomProvisional_employee->count()}}</h1></div>
					</div>
					<a class="card-footer text-black clearfix small z-1" data-toggle="modal" data-target="#exampleModal4" href="#">
						<span class="float-left">Ver detalles</span>
						<span class="float-right"><i class="fas fa-angle-right"></i></span>
					</a>
			</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
			<div class="card text-white bg-secondary o-hidden h-100">
					<div class="card-body text-white bg-secondary">
						<div class="card-body-icon"><i class="fas fa-id-badge"></i> </div>
						<div class="mr-4"> <h5>Libre Nombramiento</h5></div>
						<div class="mr-5"> <h1>{{$LibreRemocion_employee->count()}}</h1></div>
					</div>
					<a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal5" href="#">
						<span class="float-left">Ver detalles</span>
						<span class="float-right"><i class="fas fa-angle-right"></i></span>
					</a>
			</div>
		</div>	
		<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
			<div class="card text-white bg-success o-hidden h-100">
					<div class="card-body text-white bg-success">
						<div class="card-body-icon"><i class="fas fa-file-contract"></i> </div>
						<div class="mr-4"> <h5>Total Nomina</h5></div>
						<div class="mr-5"> <h1>{{$TotalNomina_employee->count()}}</h1></div>
					</div>
					<a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal6" href="#">
						<span class="float-left">Ver detalles</span>
						<span class="float-right"><i class="fas fa-angle-right"></i></span>
					</a>
			</div>
		</div>	
		
	</div>
	<div class="row justify-content-center ml-5">
		<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
			<div class="card text-white bg-danger o-hidden h-100">
					<div class="card-body text-white bg-danger">
						<div class="card-body-icon"><i class="fas fa-user-slash"></i> </div>
						<div class="mr-4"> <h5>Desvinculado</h5></div>
						<div class="mr-5"> <h1>{{$Desvinculado_employee->count()}}</h1></div>
					</div>
					<a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal7" href="#">
						<span class="float-left">Ver detalles</span>
						<span class="float-right"><i class="fas fa-angle-right"></i></span>
					</a>
			</div>
		</div>
		
		
	</div>
	
	<div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true"><!-- Modal1 -->
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel1">Nombramiento Definitivo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-striped">
						<thead>
								<tr>
									<th scope="col">Nombre</th>
									<th scope="col">Apellido</th>
									<th scope="col">Cedula</th>
									<th scope="col">Fecha_Contratacion</th>
								</tr>
						</thead>
						<tbody>
						
								@foreach ($Nombramiento_employee as $item)
									<tr>
										<td>{{$item->first_name }}</td>
										<td>{{$item->last_name}}</td>
										<td>{{$item->passport}}</td>
										<td>{{$item->hire_date}}</td>
									</tr>
								@endforeach
								
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bd-example-modal-lg" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true"><!-- Modal2 -->
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel2">Contrato Codigo Trabajo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-striped">
						<thead>
								<tr>
									<th scope="col">Nombre</th>
									<th scope="col">Apellido</th>
									<th scope="col">Cedula</th>
									<th scope="col">Fecha_Contratacion</th>
								</tr>
						</thead>
						<tbody>
						
								@foreach ($Codigo_employee as $item)
									<tr>
										<td>{{$item->first_name }}</td>
										<td>{{$item->last_name}}</td>
										<td>{{$item->passport}}</td>
										<td>{{$item->hire_date}}</td>
									</tr>
								@endforeach
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
	</div>
	
	<div class="modal fade bd-example-modal-lg" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true"><!-- Modal3 -->
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel3">Contrato Ocacional</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped">
					<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Cedula</th>
								<th scope="col">Fecha_Contratacion</th>
							</tr>
					</thead>
					<tbody>
							@foreach ($Ocacional_employee as $item)
								<tr>
									<td>{{$item->first_name }}</td>
									<td>{{$item->last_name}}</td>
									<td>{{$item->passport}}</td>
									<td>{{$item->hire_date}}</td>
								</tr>
							@endforeach
					</tbody>
				</table>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true"><!-- Modal4 -->
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel4">Nombramiento Provisional</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Cedula</th>
							<th scope="col">Fecha_Contratacion</th>
						</tr>
					</thead>
					<tbody>
				
						@foreach ($NomProvisional_employee as $item)
							<tr>
								<td>{{$item->first_name }}</td>
								<td>{{$item->last_name}}</td>
								<td>{{$item->passport}}</td>
								<td>{{$item->hire_date}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true"><!-- Modal5 -->
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel5">Libre Nombramiento y Remocion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Cedula</th>
							<th scope="col">Fecha_Contratacion</th>
						</tr>
					</thead>
					<tbody>
				
						@foreach ($LibreRemocion_employee as $item)
							<tr>
								<td>{{$item->first_name }}</td>
								<td>{{$item->last_name}}</td>
								<td>{{$item->passport}}</td>
								<td>{{$item->hire_date}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true"><!-- Modal6 -->
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel5">Total Nomina</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Cedula</th>
						</tr>
					</thead>
					<tbody>
				
						@foreach ($TotalNomina_employee as $item)
							<tr>
								<td>{{$item->first_name }}</td>
								<td>{{$item->last_name}}</td>
								<td>{{$item->passport}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel7" aria-hidden="true"><!-- Modal7 -->
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel5">Total Nomina</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Cedula</th>
							<th scope="col">Fecha_Contratacion</th>
							<th scope="col">Fecha_Desvinculacion</th>
							<th scope="col">Motivo</th>

						</tr>
					</thead>
					<tbody>
				
						@foreach ($Desvinculado_employee as $item)
							<tr>
								<td>{{$item->first_name }}</td>
								<td>{{$item->last_name}}</td>
								<td>{{$item->passport}}</td>
								<td>{{$item->hire_date}}</td>
								<td>{{$item->resign_date}}</td>
								<td>{{$item->reason}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#f3f4f5" fill-opacity="1" d="M0,128L60,122.7C120,117,240,107,360,96C480,85,600,75,720,96C840,117,960,171,1080,186.7C1200,203,1320,181,1380,170.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
	
	<div class="row justify-content-center ml-5">
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
				<div class="py-2 " id="container0"></div>
		</div>
		<div class="col-xl-6 col-lg- col-md-12 col-sm-12">
			<div class="py-2 " id="container1"></div>
		</div>
			
		<div class="col-xl-3 col-lg-3 "  style="overflow-y: auto; width: 200px;"> <!-- table0.1 -->

				<div class="py-2" hidden id="table0.1">
					<table class="table table-sm" id="datatable0.1">
						<thead>
							<tr>
								<th class="table-dark">Geenero</th>
								<th class="table-dark">Cant</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($count_gender as $registro)
							<tr>
								<td class="table-light">{{($registro->gender)}}</td>
								<td class="table-light">{{$registro->cant}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

		</div>
		<div class="col-xl-3 col-lg-3 "  style="overflow-y: auto; width: 200px;"> <!-- table0.1 -->

			<div class="py-2" hidden id="table1.1">
				<table class="table table-sm" id="datatable1.1">
					<thead>
						<tr>
							<th class="table-dark">Emp_Type</th>
							<th class="table-dark">Cant</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($count_emptype as $registro)
						<tr>
							<td class="table-light">{{($registro->emp_type)}}</td>
							<td class="table-light">{{$registro->cant}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

	</div>
	</div>
		@push ('scripts')
			<script src="https://code.highcharts.com/highcharts.js"></script>
			<script src="https://code.highcharts.com/modules/data.js"></script>
			<script src="https://code.highcharts.com/modules/exporting.js"></script>
			<script src="https://code.highcharts.com/modules/accessibility.js"></script>
			<script src="https://code.highcharts.com/modules/export-data.js"></script>
			<script src="https://code.highcharts.com/highcharts-3d.js"></script>
			<!-- Pestaña General  -->
			<script>
				
				Highcharts.chart('container0', {
					data: {
						table: 'datatable0.1',
						name: 'Genero',
					},
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie',
						options3d: {
							enabled: true,
							alpha: 45,
							beta: 0
						}
					},
					title: {
						text: 'Distribución por Genero'
					},
					subtitle: {
						text: 'Grafica'
					},
					yAxis: {
						allowDecimals: false,
						title: {
							text: 'Cants'
						}
					},
					tooltip: {
						pointFormat: '<b>{point.percentage:.1f}%</b>'
					},
					plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						shadow: true,
						depth: 35,
						center: ['50%', '50%'],
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b></br>Cant: <b>{point.y}</b>'
						}
						}
						
					},
				});

				Highcharts.chart('container1', {
					data: {
						table: 'datatable1.1',
						name: 'Emp_Type',
					},
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie',
						options3d: {
							enabled: true,
							alpha: 45,
							beta: 0
						}
					},
					title: {
						text: 'Distribución por Tipo Empleado'
					},
					subtitle: {
						text: 'Grafica'
					},
					yAxis: {
						allowDecimals: false,
						title: {
							text: 'Cants'
						}
					},
					tooltip: {
						pointFormat: '<b>{point.percentage:.1f}%</b>'
					},
					plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						shadow: true,
						depth: 35,
						center: ['50%', '50%'],
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b></br>Cant: <b>{point.y}</b>'
						}
						}
						
					},
				});
			</script>
		@endpush
@endsection

@section( "piepagina" )


@endsection