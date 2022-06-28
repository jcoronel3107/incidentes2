@extends( "layouts.plantilla" )

@section( "cabeza" )

   

@endsection

@section( "cuerpo" )
	<div class="row align-items-center mb-5">
		<h1>Recurso Humano</h1>
	</div>
	<div class="row align-items-center ml-5">
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
	<div class="row align-items-center ml-5">
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
								</tr>
						</thead>
						<tbody>
						
								@foreach ($Nombramiento_employee as $item)
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
					<button type="button" class="btn btn-info" >Exportar</button>
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
								</tr>
						</thead>
						<tbody>
						
								@foreach ($Codigo_employee as $item)
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
					<button type="button" class="btn btn-info" >Exportar</button>
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
							</tr>
					</thead>
					<tbody>
							@foreach ($Ocacional_employee as $item)
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
				<button type="button" class="btn btn-info" >Exportar</button>
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
						</tr>
					</thead>
					<tbody>
				
						@foreach ($NomProvisional_employee as $item)
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
				<button type="button" class="btn btn-info" >Exportar</button>
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
						</tr>
					</thead>
					<tbody>
				
						@foreach ($LibreRemocion_employee as $item)
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
				<button type="button" class="btn btn-info" >Exportar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				
			</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true"><!-- Modal5 -->
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
				<button type="button" class="btn btn-info" >Exportar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				
			</div>
			</div>
		</div>
	</div>
@endsection

@section( "piepagina" )


@endsection