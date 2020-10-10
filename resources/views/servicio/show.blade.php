	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Consultar Registro Información de Clave_14</h2>
	<div class="card">
		<div class="card-header ">
		    <div class="row">
		    	<div class="col-6"><h3>Registro Nro.{{$clave->id}}</h3>
		    	</div>
		    	<div class="col-6 text-right">
		    		<a href="{{ route('clave.index')}}" class="btn btn-outline-primary ">Regresar</a>
		    	</div>
		    </div>
		</div>
  		<div class="card-body">
    	<div class="row p-3">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Estación Servicio:</span>
				<p class="text-info">{{$clave->gasolinera->razonsocial}}</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<span class="bg-gray font-weight-bold">Vehiculo:</span>
				<p class=" text-info">{{$clave->vehiculo->codigodis}}</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<span class="bg-gray font-weight-bold">Fecha:</span>
				<p class=" text-info">{{$clave->created_at}}</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Conductor:</span>
				<p class=" text-info">{{$clave->user->name}}</p>
			</div>
		</div>
		<hr>
		<div class="row p-3">
			<div class="col 4">
				<span class="bg-gray font-weight-bold">km_salida:</span>
				<p class="text-info">{{$clave->km_salida}} Km</p>
			</div>
			<div class="col-4">
				<span class="bg-gray font-weight-bold">km_gasolinera:</span>
				<p class="text-info">{{$clave->km_gasolinera}} Km</p>
			</div>
			<div class="col-4">
				<span class="bg-gray font-weight-bold">km_llegada:</span>
				<p class="text-info">{{$clave->km_llegada}} Km</p>
			</div>
		</div>
		<div class="row p-3">

			<div class="col-4">
				<span class="bg-gray font-weight-bold">Dolares:</span>
				 <p class="text-info">USD $.{{$clave->dolares}}</p>
				</div>

			<div class="col-4">
				<span class="bg-gray font-weight-bold">Galones: </span>
				<p class="text-info">{{$clave->galones}} Glns</p>
			</div>
			<div class="col-4">
				<span class="bg-gray font-weight-bold">combustible:</span>
				<p class="text-info">{{$clave->combustible}}</p>
			</div>
		</div>
		<hr>
  		</div>
	</div>
@endsection
@section( "piepagina" ) @endsection