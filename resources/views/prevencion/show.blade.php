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
				<table class="table table-striped">
					<tr>
						<th>Fecha_Salida</th>
						<th>Fecha_Retorno</th>
					</tr>
					<tr>
						<td>{{$movilizacion->fecha_salida}}</td>
						<td>{{$movilizacion->fecha_retorno}}</td>
					</tr>
				</table>
				
			</div>
			<hr>
			<div class="row p-3">
				<table class="table table-striped">
					<tr>
						<th>Conductor</th>
					</tr>
					<tr>
						<td>{{$movilizacion->user->name}}</td>
					</tr>
				</table>
			</div>
			<div class="row p-3">
				<table class="table table-striped">
					<tr>
						<th>Vehiculo</th>
						<th>Km_Salida</th>
						<th>km_retorno</th>
					</tr>
					<tr>
						<td>{{$movilizacion->vehiculo->codigodis}}</td>
						<td>{{$movilizacion->km_salida}}</td>
						<td>{{$movilizacion->km_retorno}}</td>
					</tr>
				</table>
				
				
			</div>
			<div class="row p-3">
				<table class="table table-striped">
					@foreach($movilizacion->actividad as $detalle)
					<tr>
						<th>Actividades</th>
						<th>Detalle</th>
					</tr>
					<tr>
						<td><p>{{$detalle->descripcion}}</p></td>
						<td><p>{{$detalle->detalle}}</p></td>
					</tr>
					@endforeach
				</table>
			</div>
			<hr>
			<div class="row p-3">
				<table class="table table-striped">
					<tr>
						<th>Observaciones</th>
					</tr>
					<tr>
						<td>{{$movilizacion->observaciones}}</td>
					</tr>
					<tr>
						<th>Usr_creador</th>
					</tr>
					<tr>
						<td>{{$movilizacion->usr_creador}}</td>
					</tr>
					@empty($movilizacion->usr_editor)
					<tr>
						<th>Usr_editor</th>
					</tr>
					<tr>
						<td>{{$movilizacion->usr_editor}}</td>
					</tr>
					@endempty
				</table>
			</div>
		</div>
	</div>
@endsection
@section( "piepagina" ) @endsection