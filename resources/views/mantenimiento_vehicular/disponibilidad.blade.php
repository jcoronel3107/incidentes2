@extends( "layouts.plantilla" )

@section( "cabeza" )

   

@endsection

@section( "cuerpo" )
	<div class="row align-items-center mb-5">
		<h1>Disponibilidad Vehicular Operativa</h1>
	</div>
	<div class="row align-items-center">
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
				<div class="card text-white bg-primary o-hidden h-100">
						<div class="card-body text-white bg-primary">
							<div class="card-body-icon"><i class="fas fa-car-alt"></i> </div>
							<div class="mr-4"> <h5>Vehiculos Operativos</h5></div>
							<div class="mr-5"> <h1>{{$CantVehiculosOperativos}}</h1></div>
						</div>
						<a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal1" href="#">
							<span class="float-left">Ver detalles</span>
							<span class="float-right"><i class="fas fa-angle-right"></i></span>
						</a>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mb-4">
				<div class="card text-white bg-danger o-hidden h-100">
						<div class="card-body text-white bg-danger">
							<div class="card-body-icon"><i class="fas fa-car-alt"></i> </div>
							<div class="mr-4"> <h5>Vehiculos Mantenimiento</h5></div>
							<div class="mr-5"> <h1>{{$CantVehiculosReparacion}}</h1></div>
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
							<div class="card-body-icon"><i class="fas fa-car-alt"></i></div>
							<div class="mr-4"> <h5>Vehiculos en Reparacion</h5></div>
							<div class="mr-5"> <h1>{{$CantVehiculosEnMantenimiento}}</h1></div>
						</div>
						<a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal3" href="#">
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
					<h5 class="modal-title" id="exampleModalLabel1">Vehiculos Operativos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-striped">
						<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Codigo</th>
									<th scope="col">Placa</th>
									<th scope="col">Marca</th>
									<th scope="col">Modelo</th>
								</tr>
						</thead>
						<tbody>
						
								@foreach ($ListVehiculosOperativos as $vehiculo)
									<tr>
										<th scope="row">{{ $vehiculo->id }}</th>
										<td>{{ $vehiculo->codigodis }}</td>
										<td>{{$vehiculo->placa}}</td>
										<td>{{$vehiculo->marca}}</td>
										<td>{{$vehiculo->modelo}}</td>
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
					<h5 class="modal-title" id="exampleModalLabel2">Vehiculos Mantenimiento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-striped">
						<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Codigo</th>
									<th scope="col">Placa</th>
									<th scope="col">Marca</th>
									<th scope="col">Modelo</th>
								</tr>
						</thead>
						<tbody>
						
								@foreach ($ListVehiculosReparacion as $vehiculo)
									<tr>
										<th scope="row">{{ $vehiculo->id }}</th>
										<td>{{ $vehiculo->codigodis }}</td>
										<td>{{$vehiculo->placa}}</td>
										<td>{{$vehiculo->marca}}</td>
										<td>{{$vehiculo->modelo}}</td>
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
				<h5 class="modal-title" id="exampleModalLabel3">Vehiculos En Reparacion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped">
					<thead>
							<tr>
								<th scope="col">id</th>
								<th scope="col">Codigo</th>
								<th scope="col">Placa</th>
								<th scope="col">Marca</th>
								<th scope="col">Modelo</th>
							</tr>
					</thead>
					<tbody>
					
							@foreach ($ListVehiculosEnMantenimiento as $vehiculo1)
								<tr>
									<th scope="row">{{ $vehiculo1->id }}</th>
									<td>{{ $vehiculo1->codigodis }}</td>
									<td>{{$vehiculo1->placa}}</td>
									<td>{{$vehiculo1->marca}}</td>
									<td>{{$vehiculo1->modelo}}</td>
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