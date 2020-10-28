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
    	<div class="row p-3">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Fecha_Salida:</span>
				<p class="text-info">{{$servicio->fecha_salida}}</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Fecha_Retorno:</span>
				<p class=" text-info">{{$servicio->fecha_retorno}}</p>
			</div>
			
		</div>
		<hr>
		<div class="row p-3">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Vehiculo:</span>
				<p class=" text-info">{{$servicio->vehiculo->codigodis}}</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Conductor:</span>
				<p class=" text-info">{{$servicio->user->name}}</p>
			</div>
		</div>
		<div class="row p-3">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<span class="bg-gray font-weight-bold">km_salida:</span>
				<p class="text-info">{{$servicio->km_salida}} Km</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<span class="bg-gray font-weight-bold">km_retorno:</span>
				<p class="text-info">{{$servicio->km_retorno}} Km</p>
			</div>
			
			
		</div>
		<div class="row p-3">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<span class="bg-gray font-weight-bold">Departamento:</span>
				<p class="text-info">{{$servicio->unidad}}</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<span class="bg-gray font-weight-bold">Delegante:</span>
				 <p class="text-info">USD $.{{$servicio->delegante}}</p>
				</div>
		</div>
		<div class="row p-3">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<span class="bg-gray font-weight-bold">asunto: </span>
				<p class="text-info">{{$servicio->asunto}}</p>
			</div>
			
		</div>
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