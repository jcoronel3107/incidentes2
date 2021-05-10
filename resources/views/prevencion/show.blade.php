	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Consultar Registro Información de Movilización</h2>
	<div class="card">
		<div class="card-header ">
		    <div class="row">
		    	<div class="col-6"><h3>Registro Nro.{{$movilizacion->id}}</h3>
		    	</div>
		    	<div class="col-6 text-right">
		    		<a href="{{ route('prevencion.index')}}" class="btn btn-outline-primary ">Regresar</a>
		    	</div>
		    </div>
		</div>
  		<div class="card-body">
    	<div class="row p-3">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Fecha_Salida:</span>
				<p class="text-info">{{$movilizacion->fecha_salida}}</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Fecha_Retorno:</span>
				<p class=" text-info">{{$movilizacion->fecha_retorno}}</p>
			</div>
			
		</div>
		<hr>
		<div class="row p-3">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Vehiculo:</span>
				<p class=" text-info">{{$movilizacion->vehiculo->codigodis}}</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<span class="bg-gray font-weight-bold">Conductor:</span>
				<p class=" text-info">{{$movilizacion->user->name}}</p>
			</div>
		</div>
		<div class="row p-3">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<span class="bg-gray font-weight-bold">km_salida:</span>
				<p class="text-info">{{$movilizacion->km_salida}} Km</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<span class="bg-gray font-weight-bold">km_retorno:</span>
				<p class="text-info">{{$movilizacion->km_retorno}} Km</p>
			</div>
			
			
		</div>
		@foreach($movilizacion->actividad as $detalles)
		<div class="row p-3">
		
			<div class="col-lg-6 col-md-6 col-sm-6">
				<span class="bg-gray font-weight-bold">Tipo Actividad:</span>
				
					<p class="text-info">{{$detalles->descripcion}}</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
					<span class="bg-gray font-weight-bold">Detalles: </span>
				
					<p class="text-info">{{$detalles->detalle}}</p>
			
			</div>
			
			
		</div>
		@endforeach
		<div class="row p-3">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<span class="bg-gray font-weight-bold">Observaciones: </span>
				<p class="text-info">{{$movilizacion->observaciones}}</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12">
					<span class="bg-gray font-weight-bold">usr_creador:</span>
					<p class="text-info">{{$movilizacion->usr_creador}}</p>
				</div>
				<hr>
			</div>
  		</div>
	</div>
@endsection
@section( "piepagina" ) @endsection