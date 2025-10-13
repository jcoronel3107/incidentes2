	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Consultar Registro Información de Comisión Servicios</h2>
	<div class="card">
		<div class="card-header ">
		    <div class="row">
		    	<div class="col-6"><h3>Registro Nro.{{$servicio->id}}</h3>
		    	</div>
		    	<div class="col-6 text-right">
		    		<a href="{{ route('servicio.index')}}" class="btn btn-outline-primary ">Regresar</a>
		    	</div>
		    </div>
		</div>
  		<div class="card-body">
		  <table class="table table-striped">
				
				<tr>
					<th>Fecha_Salida</th>
					<th>Fecha_Retorno</th>
				</tr>
				<tr>
					<td>{{$servicio->fecha_salida}}</td>
					<td>{{$servicio->fecha_retorno}}</td>
				</tr>
			</table>
			<hr>
			<table class="table table-striped">
					
					<tr>
						<th>Vehiculo</th>
						<th>Conductor</th>
					</tr>
					<tr>
						<td>{{$servicio->vehiculo->codigodis}}</td>
						<td>{{$servicio->user->name}}</td>
					</tr>
			</table>
			<table class="table table-striped">
					
					<tr>
						<th>km_salida</th>
						<th>km_retorno</th>
					</tr>
					<tr>
						<td>{{$servicio->km_salida}} Km</td>
						<td>{{$servicio->km_retorno}} Km</td>
					</tr>
			</table>
			<table class="table table-striped">
					
					<tr>
						<th>Departamento</th>
						<th>Delegante</th>
					</tr>
					<tr>
						<td>{{$servicio->unidad}}</td>
						<td>{{$servicio->delegante}}</td>
					</tr>
			</table>
			<table class="table table-striped">
					
					<tr>
						<th>Asunto</th>
					
					</tr>
					<tr>
						<td>{{$servicio->asunto}}</td>
						
					</tr>
			</table>
		
			<div class="row p-3">
				<div class="col-lg-8 col-md-8 col-sm-12">
						<span class="bg-gray font-weight-bold">usr_creador:</span>
						<p class="text-info">{{$servicio->usr_creador}}</p>
					</div>
				<hr>
			</div>
  		</div>
	</div>
@endsection
@section( "piepagina" ) @endsection