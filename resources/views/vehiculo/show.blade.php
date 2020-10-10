	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Información de Vehículo</h2>

		<div class="card">
		  <div class="card-header ">
		    <div class="row">
		    	<div class="col-6"><h3>Registro Nro.{{$vehiculo->id}}</h3>
		    	</div>
		    	<div class="col-6 text-right">
		    		<a href="{{ route('vehiculo.index')}}" class="btn btn-outline-primary ">Regresar</a>
		    	</div>
		    </div>
		  </div>
  <div class="card-body">
    	<div class="row p-3">
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Codigo:</span>
				<p class="text-info">{{$vehiculo->codigodis}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Placa:</span>
				<p class=" text-info">{{$vehiculo->placa}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Tipo:</span>
				<p class=" text-info">{{$vehiculo->tipo}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Marca:</span>
				<p class="text-info">{{$vehiculo->marca}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">modelo:</span>
				<p class="text-info">{{$vehiculo->modelo}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">Clase:</span>
				<p class="text-info">{{$vehiculo->clase}}</p>
			</div>
		</div>
		<hr>
		<div class="row p-3">

			<div class="col-4">
				<span class="bg-gray font-weight-bold">Pais_orig:</span>
				 <p class="text-info">{{$vehiculo->pais_orig}}</p>
				</div>

			<div class="col-4">
				<span class="bg-gray font-weight-bold">Carroceria: </span>
				<p class="text-info">{{$vehiculo->carroceria}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">color1:</span>
				<p class="text-info">{{$vehiculo->color1}}</p>
			</div>
			<div class="col-2">
				<span class="bg-gray font-weight-bold">color2:</span>
				<p class="text-info">{{$vehiculo->color2}}</p>
			</div>
		</div>
		<hr>
		<div class="row p-3">

			<div class="col-3">
				<span class="bg-gray font-weight-bold">Tonelaje:</span>
				<p class="text-info">{{$vehiculo->tonelaje}}</p>
			</div>
			<div class="col-3">
				<span class="bg-gray font-weight-bold">Cilindraje:</span>
				<p class="text-info">{{$vehiculo->cilindraje}}</p>
			</div>
			<div class="col-3">
				<span class="bg-gray font-weight-bold">Motor:</span>
				<p class="text-info">{{$vehiculo->motor}}</p>
			</div>
			<div class="col-3">
				<span class="bg-gray font-weight-bold">Chasis:</span>
				<p class="text-info">{{$vehiculo->chasis}}</p>
			</div>
		</div>
		<div class="row p-3">

			<div class="col-6">
				<span class="bg-gray font-weight-bold">station:</span>
				<p class="text-info text-wrap text-break">{{$vehiculo->station->nombre}}</p>
			</div>
			<div class="col-6">
				<span class="bg-gray font-weight-bold">Estado:</span>
				<p class="text-info text-wrap text-break">{{$vehiculo->estado}}</p>
			</div>
		</div>
		<hr>
		<div class="row p-3">

			<div class="col-6">
				<span class="bg-gray font-weight-bold">Codigo Inv:</span>
				<p class="text-info">{{$vehiculo->codigoinv}}</p>
			</div>
			<div class="col-6">
				<span class="bg-gray font-weight-bold"> kmmantrut:</span>
				<p class="text-info text-wrap text-break">{{$vehiculo->kmmantrut}}</p>
			</div>
		</div>
		<hr>
		<div class="row p-3">

			<div class="col-6">
				<span class="bg-gray font-weight-bold"> Combustible:</span>
				<p class="text-info">{{$vehiculo->combustible}}</p>
			</div>
		</div>
		<hr>


  </div>
</div>
@endsection
@section( "piepagina" ) @endsection