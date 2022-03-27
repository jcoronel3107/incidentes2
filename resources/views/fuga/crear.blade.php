	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Fuga</title>
	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Eventos Fugas</h2>
	<ul class="nav justify-content-end">
		<li class="nav-item">
			<div class="input-group mb-3">	
				<div class="input-group-prepend">
					<span title="Notificar x Whatsapp" class="input-group-text"><i class="icon-comments-alt"></i></span>
				</div>
				<a class="btn btn-outline-info" data-toggle="tooltip" title="Notificar x Whatsapp" role="button" onclick="notificacionWhatsapp();">Whatsapp</a>
				<div class="input-group-prepend">
					<span title="Regresar" class="input-group-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
				</div>
				<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('fuga.index')}}">Regresar</a>
			</div>
		</li>
	</ul>
	@if(count($errors)>0)
		@foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{{$error}}</div>
		@endforeach
	@endif
	<form id="formulario" method="post" action="{{ route('fuga.store')}}">
		<div class="form-row">
			{{csrf_field()}}
			<div class="form-group input-group  col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!}</span>
				</div>
				<input type="date" id="fecha" name="fecha" class="form-control" placeholder="AA-MM-DD" required="">
			</div>
		</div>
		<!--Div Fecha-->
		<div class="form-row">
			<div class='col-md-6'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Hora Ficha ECU911</span>
						</div>
						<input type="text" id="hora_fichaecu911" name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_fichaecu911',$now->format('H:i:s') )}}" required="">
						
					</div>
				</div>
			</div>
			<div class='col-md-6'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input type="text" onkeyup="mayus(this);" name="ficha_ecu911" value="" class="form-control">

					</div>
				</div>
			</div>
		</div>
		<!--Div Informacion ECU911-->
		<hr>
		<div class="card"><!-- Ingreso Vehiculos Detalle -->
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
								<select class="form-control"   name="pvehiculo_id" id="pvehiculo_id">
									<option value=""></option>
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
									<select class=" form-control"  name="pconductor_id" id="pconductor_id">
										<option value=""></option>
										@foreach($maquinistas as $maquinista)
										<option value="{{$maquinista->id}}">{{$maquinista->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 ">
							<div class="form-group  input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Km.Salida</span>
								</div>
								<input type="number" class="form-control" name="km_salida" id="pkm_salida" placeholder="Digite Valor">
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 ">
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
								<table id="detalles" class="table table-sm table-hover table-striped table-condensed">
									<thead style="background-color: #A9D0F5 ">
										<th>Opciones</th>
										<th>Vehiculo</th>
										<th>Km.Salida</th>
										<th>Km.Llegada</th>
										<th>Conductor</th>
									</thead>
									<tbody></tbody>
									<tfoot></tfoot>
								</table>
							</div>
					</div>
				</div>
		</div>
		<hr>
		<div class="form-row">
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group date">
						<div class="input-group-prepend">
							<span class="input-group-text">{!! trans('messages.Initial information') !!}</span>
						</div>
						<textarea onkeyup="mayus(this);" class="form-control" name="informacion_inicial" maxlength="2000" id="pinformacion_inicial" aria-label="With textarea" required="">{{old('informacion_inicial')}}</textarea>
					</div>
				</div>
			</div>
			<div class="counter" id="pcounter"></div>
		</div>

		<div class="form-row"><!--Div Tipo Evento-->
			<div class="form-group input-group col-md-6 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Incident') !!}</span>
				</div>
				<select class="selectpicker form-control" data-live-search="true" name="incidente_id" id="incidente_id" required>
					<option value="" selected>{{old('incidente_id')}}</option>
					@foreach($incidentes as $incidente)
					<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group input-group col-md-6 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.scene') !!}</span>
				</div>
				<select class="form-control" id="tipo_escena" name="tipo_escena" required>
					<option value="" selected>{{old('tipo_escena')}}</option>
					<option value="Tipo 1">Tipo 1</option>
					<option value="Tipo 2">Tipo 2</option>
					<option value="Tipo 3">Tipo 3</option>
					<option value="Tipo 4">Tipo 4</option>
				</select>
			</div>
			<div class="form-group input-group col-md-6 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Station') !!}</span>
				</div>
				<select class="selectpicker form-control" data-live-search="true" name="station_id">
					<option value="" selected>{{old('station_id')}}</option>
					@foreach($estaciones as $estacion)
					<option value="{{$estacion->id}}">{{$estacion->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="form-row"><!--Div Ubicacion Evento-->

			<div class="form-group input-group col-md-12 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Address') !!}</span>
				</div>
				<textarea class="form-control" name="direccion" id="pdireccion" placeholder="Ubicacion del Evento" aria-label="With textarea" required="">{{old('direccion')}}</textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group col-md-12 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Parishes') !!}</span>
				</div>
				<select class="form-control" name="parroquia_id" required>
					<option value="" selected>{{old('parroquia_id')}}</option>
					@foreach($parroquias as $parroquia)
						<option value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
					@endforeach
				</select>
				<a rel="nofollow noopener noreferrer" href="{{asset('files/MapaCuenca.pdf')}}" target="_blank" role="button" data-toggle="tooltip" title="Mapa" class="btn btn-outline-info"><i class="icon-file icon-2x"></i></a>
			</div>
			<div class="form-group input-group col-md-12 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputAddress">Geoposicion</span>
				</div>
				<textarea class="form-control" id="pgeoposicion" name="geoposicion" placeholder="Formato:. -2.56985, -79.23658" aria-label="With textarea">{{old('geoposicion')}}</textarea>
			</div>
		</div>
		<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
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
								@foreach($users as $user)
								<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
							</select>	
						</div>
						<button type="button" id="bt_addperson" class="btn btn-primary btn-block ml-4 mr-4 mb-4">{!! trans('messages.add') !!}</button>
						
					</div>
					<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<table id="persontable" class="table table-sm table-hover table-striped table-condensed">
									<thead>
										<td>Eliminar</td>
										<td>id</td>
										<td>Nombres_Completos</td>
									</thead>
									<tbody></tbody>
									<tfoot></tfoot>
								</table>
							</div>
					</div>
					
				</div>
		</div>
		<hr>
		
		<div class="form-row"><!--Div Horas Evento-->
			<div class="form-group  input-group col-md-10">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia')}}" onblur="CheckTime(this);" placeholder="hh:mm:ss" required="">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-10">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" value="{{old('hora_llegada_a_emergencia')}}" placeholder="hh:mm:ss" onblur="CheckTime(this);" required="">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual1" id="horactual1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		
		<div class="form-row"><!--Div Horas Evento-->
			<div class="form-group  input-group col-md-10">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_fin_emergencia" value="{{old('hora_fin_emergencia')}}" id="hora_fin_emergencia" onblur="CheckTime(this);" placeholder="hh:mm:ss">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-10">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input type="text" class="form-control" name="hora_en_base" value="{{old('hora_en_base')}}" id="hora_en_base" onblur="CheckTime(this);" placeholder="hh:mm:ss">
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
				<textarea class="form-control" name="detalle_emergencia" maxlength="3000" id="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia" aria-label="With textarea" required="">{{old('detalle_emergencia')}}</textarea>

			</div>
		</div>
		
		<div class="counter col-md-3 col-sm-12" id="pcounter1"></div>
		<div class="form-row">
			<div class="form-group input-group col-md-6 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputtipo_cilindro">Tipo_Cilindro</span>
				</div>
				<select class="form-control" id="tipo_cilindro" name="tipo_cilindro" required>
					<option value="" selected>Seleccione...</option>
					<option>Comercial 15Kg</option>
					<option>Comercial 45Kg</option>
					<option>Centralizado</option>
					<option>Domestico 15Kg</option>
					<option>No Aplica</option>
				</select>
			</div>
			<div class="form-group input-group col-md-6 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputcolor_cilindro">Color_Cilindro</span>
				</div>
				<select class="form-control" id="color_cilindro" name="color_cilindro" required>
					<option value="" selected>Seleccione...</option>
					<option>Amarillo</option>
					<option>Azul</option>
					<option>Blanco</option>
					<option>No Aplica</option>
					<option>Otros</option>
				</select>
			</div>
			<div class="form-group input-group col-md-6 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputtipo_fallo">Tipo_Fallo</span>
				</div>
				<select class="form-control" id="tipo_fallo" name="tipo_fallo" required>
					<option value="" selected>Seleccione...</option>
					<option>Manguera</option>
					<option>No Aplica</option>
					<option>Otro</option>
					<option>Pin/Vastago</option>
					<option>Regulador</option>
					<option>Toroide</option>
				</select>
			</div>
		</div>{{-- Fallos --}}
		<div class="form-row">
			<div class="form-group input-group  col-md-8">
				<div class="input-group-prepend">
					<span class="input-group-text">Ciud. Afectado</span>
				</div>
				<input onkeyup="mayus(this);" type="text" maxlength="200" class="form-control" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado')}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia" required="">
			</div>
		</div>{{--Usuario Afectado--}}
		<div class="form-row">
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDaños">Daños Estimados</span>
				</div>
				<input type="text" class="form-control" name="danos_estimados" maxlength="2000" id="danos_estimados" value="{{old('danos_estimados')}}" placeholder="Detalle los daños producidos por  el incidente" required="">
			</div>
		</div>{{-- Danos Estimados --}}

		<div class="form-group py-3 " id="divguardar">
			<input type="hidden" name="token" value="{{csrf_token()}}">
			<div class="row nav justify-content-end">
				<li class="nav-item">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span title="Grabar" class="input-group-text"><i class="fas fa-check"></i></span>
						</div>						
						<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar"  class="btn btn-outline-success">{!! trans('messages.to register') !!}</button>
						<div class="input-group-prepend">
							<span title="Regresar" class="input-group-text"><i class="fas fa-arrow-left"></i></span>
						</div>
						<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('fuga.index')}}">Regresar</a>
					</div>				
				</li>
			</div>
			
		</div>

	</form>



	
	@push ('scripts')

	<!-- Geolocalizacion  for all pages-->
	<script src="/js/funciones.js"></script>
	<!-- Geolocalizacion  for all pages-->
	<script src="/js/geocoder.js"></script>

	@endpush


	@endsection

	@section( "piepagina" )


	@endsection