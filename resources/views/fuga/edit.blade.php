	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Fuga - Edición - BCBVC</title>
	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Eventos Fugas</h2>
	<ul class="nav justify-content-end">
		<li class="nav-item">
			<div class="input-group mb-3">	
				
				<div class="input-group-prepend">
					<span title="Regresar" class="input-group-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
				</div>
				<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('fuga.index')}}">Regresar</a>
			</div>
		</li>
	</ul>
	<ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('fuga.index')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
			</a>
		</li>
	</ul>
	@if(count($errors)>0) @foreach($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{$error}}
		</div>
	@endforeach @endif

	<hr style="border:2px;">
	<form method="post" action="/fuga/{{$fuga->id}}">
		@csrf @method('PATCH')
		<div class="form-row"><!--Div Fecha-->
			<div class="form-group input-group  col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!}</span>
				</div>
				<input required="" type="text" name="fecha" class="form-control" placeholder="AA-MM-DD" value="{{old('fecha',$fuga->fecha)}}">
			</div>
		</div>
		
		<div class="form-row "><!--Div Informacion ECU911-->
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Hora Ficha ECU911</span>
						</div>
						<input required="" type="text" name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911',$fuga->hora_fichaecu911)}}">
					</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input required="" type="text" onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911',$fuga->ficha_ecu911)}}" class="form-control">
					</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group date" id="datetimepicker3">
						<div class="input-group-prepend">
							<span class="input-group-text">{!! trans('messages.Initial information') !!}</span>
						</div>
						<textarea required="" id="pinformacion_inicial" class="form-control" maxlength="2000" name="informacion_inicial" aria-label="With textarea">{{old('informacion_inicial',$fuga->informacion_inicial)}}</textarea>

					</div>
				</div>
			</div>
		</div>
		
		<div class="form-row"><!--Div Tipo Evento-->
			<div class="form-group input-group col-md-10">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Incident') !!}</span>
				</div>
				<select required class="form-control" name="incidente_id" id="incidente_id">
					<option value="{{$fuga->incidente->id}}" selected>{{old('incidente_id',$fuga->incidente->nombre_incidente)}}</option>
					@foreach($incidentes as $incidente)
					<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.scene') !!}</span>
				</div>
				<select required class="form-control" name="tipo_escena">
					<option value="{{$fuga->tipo_escena}}" selected>{{old('tipo_escena',$fuga->tipo_escena)}}</option>
					<option value="Tipo 1">Tipo 1</option>
					<option value="Tipo 2">Tipo 2</option>
					<option value="Tipo 3">Tipo 3</option>
					<option value="Tipo 4">Tipo 4</option>
				</select>
			</div>
			<div class="form-group input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Station') !!}</span>
				</div>
				<select required name="station_id" class=" form-control">
					<option value="{{$fuga->station->id}}" selected>{{old('station_id',$fuga->station->nombre)}}</option>
					@foreach($estaciones as $estacion)
					<option value="{{$estacion->id}}">{{$estacion->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="form-row"><!--Div Ubicacion Evento-->
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Address') !!}</span>
				</div>
				<textarea required="" class="form-control" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea">{{old('direccion',$fuga->direccion)}}</textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group input-group-prepend col-md-8">
				<div>
					<span class="input-group-text">{!! trans('messages.Parishes') !!}</span>
				</div>
				<select name="parroquia_id" class="selectpicker form-control" data-live-search="true">
					<option value="{{$fuga->parroquia->id}}" selected>{{old('parroquia_id',$fuga->parroquia->nombre)}}</option>
					@foreach($parroquias as $parroquia)
					<option value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
					@endforeach
				</select>
				<a rel="nofollow noopener noreferrer" href="{{asset('files/MapaCuenca.pdf')}}" target="_blank" role="button" data-toggle="tooltip" title="Mapa" class="btn btn-outline-info"><i class="icon-file icon-2x"></i></a>
			</div>
			<div class="form-group input-group col-md-8">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputAddress">Geoposicion</span>
				</div>
				<textarea class="form-control" id="pgeoposicion" name="geoposicion" aria-label="With textarea">{{old('geoposicion',$fuga->geoposicion)}}</textarea>
			</div>
		</div>
		
		<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
		<hr>
		<hr>

		<div class="card"><!-- Div Personal en Emergencia -->
				<div class="card-header">
					{!! trans('messages.staff in the emergency') !!}
				</div>
				<div class="card-body">
					
					<div class="form-row">
						<div class="form-group input-group col-lg-12 col-md-12 col-sm-12 col.xs-12 mr-4">
							<div class="input-group-prepend">
								<span class="input-group-text">Bombero</span>
							</div>
							<select class="selectpicker form-control" data-live-search="true" id="pbombero_id" name="bombero_id">
								<option selected >{{old('bombero_id')}}</option>
								@foreach($usuarios as $user)
								
								<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
							</select>	
						</div>
						<button type="button" id="bt_addpersonedit" class="btn btn-primary btn-block ml-4 mr-4 mb-4">{!! trans('messages.add') !!}</button>
					</div>
					<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input id="nropersonas" type="hidden" value="{{$nropersonas}}"># Pers{{$cont = 0}}nas:. {{$nropersonas}}
							<table id="persontable" class="table table-hover">
							
								<thead>
										<td>Eliminar</td>
										<td>id</td>
										<td>Nombres_Completos</td>
								</thead>
										@foreach($fuga->users as $users)
										<tr id="filabomber{{$cont = $cont + 1}}">
											
											<td><button type="button" class="btn btn-warning" onclick="eliminarbomberman('{{$cont}}')" type="button">X</button></td>
											<td for="id"><input type="hidden" class="form-control" id="bomberman_id[]" name="bomberman_id[]" value="{{$users->id}}">{{$users->id}}</td>
											<td><input type="hidden" class="form-control" id="bomberman_name[]" name="bomberman_name[]" value="{{$users->name}}">{{$users->name}}</td>
										</tr>
										
										@endforeach
								</table>
							</div>
					</div>
					
				</div>
		</div>
		<hr>
		<div class="card  mb-2"><!-- Ingreso Vehiculos Detalle -->
				<div class="card-header">
					{!! trans('messages.Vehicles in the Emergency') !!}
				</div>
				<div class="card-body">
					<div class="row d-flex">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">{!! trans('messages.Vehicles') !!}</span>
								</div>
								<select class="selectpicker form-control" data-live-search="true"  name="pvehiculo_id" id="pvehiculo_id">
									<option selected></option>
									@foreach($vehiculos as $vehiculo)
									<option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Conductor</span>
									</div>
									<select class="form-control" name="pconductor_id" id="pconductor_id">
										<option selected></option>
										@foreach($maquinistas as $maquinista)
										<option value="{{$maquinista->id}}">{{$maquinista->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
							<div class="form-group  input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Km.Salida</span>
								</div>
								<input type="number" class="form-control" name="km_salida" id="pkm_salida" placeholder="Digite Valor">
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
							<div class="form-group  input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputDetalle">Km.Llegada</span>
								</div>
								<input type="number" class="form-control" id="pkm_llegada" name="km_llegada" placeholder="Digite Valor">
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 mb-2 ">
							<button type="button" id="bt_add" class="btn btn-primary btn-block">{!! trans('messages.add') !!}</button>
						</div>
					</div>
					<div class="row d-flex ">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
								<table id="detalles" class="table table-hover">
									<thead style="background-color: #A9D0F5 ">
										<th>Opciones</th>
										<th>Vehiculo</th>
										<th>Km.Salida</th>
										<th>Km.Llegada</th>
										<th>Conductor</th>
									</thead>
									<tbody>
										{{$cont = 0}}
										@foreach($fuga->vehiculos as $items)
										{{$cont = $cont + 1}}
										<tr id="fila{{$cont}}">
										<td><button type="button" class="btn btn-warning" onclick="eliminar('{{$cont}}')" type="button">X</button></td>
										<td><input type="hidden" readonly class="form-control" name="vehiculo_id[]" value="{{$items->id}}">{{$items->codigodis}}</td>
										<td><input type="text" readonly class="form-control" name="km_salida[]" value="{{$items->pivot->km_salida}}"></td>
										<td><input type="text" readonly class="form-control" name="km_llegada[]" value="{{$items->pivot->km_llegada}}"></td>
										<td><input type="hidden" readonly class="form-control" name="driver_id[]" value="{{$items->pivot->driver_id}}">{{$items->pivot->driver_id}}</td>
										
										</tr>
										
										@endforeach
									</tbody>
									
								</table>
							</div>
					</div>
				</div>
		</div>
		
		
		<div class="form-row"><!--Div Horas Evento-->
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
				</div>
				<input type="datetime-local" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$fuga->hora_salida_a_emergencia)}}" onblur="CheckTime(this);" placeholder="hh:mm:ss" required="">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input type="datetime-local" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" value="{{old('hora_llegada_a_emergencia',$fuga->hora_llegada_a_emergencia)}}" placeholder="hh:mm:ss" onblur="CheckTime(this);" required="">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual1" id="horactual1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		
		<div class="form-row"><!--Div Horas Evento-->
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
				</div>
				<input type="datetime-local" class="form-control" name="hora_fin_emergencia" value="{{old('hora_fin_emergencia',$fuga->hora_fin_emergencia)}}" id="hora_fin_emergencia" onblur="CheckTime(this);" placeholder="hh:mm:ss">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input type="datetime-local" class="form-control" name="hora_en_base" value="{{old('hora_en_base',$fuga->hora_en_base)}}" id="hora_en_base" onblur="CheckTime(this);" placeholder="hh:mm:ss">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual3" id="horactual3"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		
		<div class="form-row"><!--Detalle Emergencia-->

			<div class="form-group input-group  col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">Detalle Emergencia</span>
				</div>
				<textarea class="form-control" name="detalle_emergencia" id="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia">{{old('detalle_emergencia',$fuga->detalle_emergencia)}}</textarea>
			</div>
		</div>
		
		<div class="form-row">{{-- Fallos --}}
			<div class="form-group input-group col-md-12 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputtipo_cilindro">Tipo_Cilindro</span>
				</div>
				<select class="form-control" id="tipo_cilindro" name="tipo_cilindro" required>
					<option value="{{$fuga->tipo_cilindro}}" selected>{{old('tipo_cilindro',$fuga->tipo_cilindro)}}</option>
					<option value="Centralizado">Centralizado</option>
					<option value="Comercial 15Kg">Comercial 15Kg</option>
					<option value="Comercial 45Kg">Comercial 45Kg</option>
					<option value="Domestico 15Kg">Domestico 15Kg</option>
					<option value="No Aplica">No Aplica</option>
				</select>
			</div>
			<div class="form-group input-group col-md-12 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputcolor_cilindro">Color_Cilindro</span>
				</div>
				<select class="form-control" id="color_cilindro" name="color_cilindro" required>
					<option value="{{$fuga->color_cilindro}}" selected="">{{old('color_cilindro',$fuga->color_cilindro)}}</option>
					<option value="Amarillo">Amarillo</option>
					<option value="Azul">Azul</option>
					<option value="Blanco">Blanco</option>
					<option value="No Aplica">No Aplica</option>
					<option value="Otros">Otros</option>
				</select>
			</div>
			<div class="form-group input-group col-md-12 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputtipo_fallo">Tipo_Fallo</span>
				</div>
				<select class="form-control" id="tipo_fallo" name="tipo_fallo" required>
					<option value="{{$fuga->tipo_fallo}}" selected>{{old('tipo_fallo',$fuga->tipo_fallo)}}</option>
					<option value="Manguera">Manguera</option>
					<option value="No Aplica">No Aplica</option>
					<option value="Otro">Otro</option>
					<option value="Pin/Vastago">Pin/Vastago</option>
					<option value="Regulador">Regulador</option>
					<option value="Toroide">Toroide</option>
				</select>
			</div>
		</div>
		<div class="form-row"><!--Usuario Afectado-->
			<div class="form-group input-group  col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">Ciud. Afectado</span>
				</div>
				<input type="text" class="form-control" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado',$fuga->usuario_afectado)}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
			</div>
		</div>
		
		<div class="form-row"><!--Daños-->
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDaños">Daños Estimados</span>
				</div>
				<textarea class="form-control" name="danos_estimados" id="danos_estimados" placeholder="Detalle los daños producidos por  el incidente">{{old('danos_estimados',$fuga->danos_estimados)}}</textarea>
			</div>
		</div>

		

		<div class="form-group">
			<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Actualizar</button>
			<a class="btn btn btn-primary" role="button" href="{{ route('fuga.index')}}">Cancelar
			</a>
		</div>
	</form>
	<form method="post" action="/fuga/{{$fuga->id}}">
		{{csrf_field()}}
		<input type="hidden" name="_method" value="DELETE">

		<button type="button" title="Eliminar" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>El registro seleccionado será eliminado. Esta Seguro?...</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="Eliminar" value="Eliminar" class="btn btn-primary">Ok</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	@push ('scripts')
		<!-- Geolocalizacion  for all pages-->
		<script src="/js/geocoder.js"></script>
		<!-- Script para almacenar vehiculos asisten -->
		<script src="/js/funciones.js"></script>
	@endpush

	@endsection

	@section( "piepagina" )
	
	@endsection