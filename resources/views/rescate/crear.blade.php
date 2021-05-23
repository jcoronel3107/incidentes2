	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Rescate</title>

	@endsection

	@section( "cuerpo" )


	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Eventos Rescate</h2>
	<ul class="nav justify-content-end">
		<li class="nav-item">

			<a class="btn btn-outline-info" data-toggle="tooltip" title="Whatsapp" role="button" onclick="notificacionWhatsapp();"><i class="icon-comments-alt icon-2x"></i></a>

			<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('rescate.index')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
		</li>
	</ul>
	<form method="post" action="{{ route('rescate.store')}}">
		<div class="form-row">
			{{csrf_field()}}
			<div class="form-group input-group  col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!}</span>
				</div>
				<input type="date" id="fecha" name="fecha" class="form-control" placeholder="AA-MM-DD" value="{{$now->format('Y-m-m')}}" required="">
			</div>
		</div>
		<!--Div Fecha-->
		<div class="form-row ">
			<div class='col-md-4'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Hora Ficha ECU911</span>
						</div>
						<input type="text" id="hora_fichaecu911" name="hora_fichaecu911" class="form-control" onblur="CheckTime(this);" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911',$now->format('H:i:s') )}}" required>
						
					</div>
				</div>
			</div>
			<div class='col-md-4'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input type="text" onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911')}}" class="form-control" required="">
					</div>
				</div>
			</div>

		</div>
		<!--Div Informacion ECU911-->
		<hr>
		<div class="card">
			<div class="card-header">{!! trans('messages.Vehicles in the Emergency') !!}</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">{!! trans('messages.Vehicles') !!}</span>
							</div>
							<select class="form-control selectpicker" name="pvehiculo_id" id="pvehiculo_id" data-live-search="true" required>
								<option selected></option>
								@foreach($vehiculos as $vehiculo)
								<option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Km.Salida</span>
							</div>
							<input type="number" class="form-control" name="km_salida" id="pkm_salida" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputDetalle">Km.Llegada</span>
							</div>
							<input type="number" class="form-control" id="pkm_llegada" name="km_llegada" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
						<button type="button" id="bt_add" class="btn btn-primary">{!! trans('messages.add') !!}</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<table id="detalles" class="table table-striped table bordered table condensed table-hover">
							<thead style="background-color: #A9D0F5 ">
								<th>Opciones</th>
								<th>Vehiculo</th>
								<th>Km.Salida</th>
								<th>Km.Llegada</th>
							</thead>
							<tfoot></tfoot>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<tbody></tbody>
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
						<textarea class="form-control" id="pinformacion_inicial" name="informacion_inicial" maxlength="2000" aria-label="With textarea" required="">{{old('informacion_inicial')}}</textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="counter" id="pcounter">0</div>
		<div class="form-row">
			<div class="form-group input-group col-md-5">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Incident') !!}</span>
				</div>
				<select class="selectpicker form-control" data-live-search="true" required name="incidente_id" id="incidente_id">
					<option value="" selected>{{old('incidente_id')}}</option>
					@foreach($incidentes as $incidente)
					<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group input-group col-md-3">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.scene') !!}</span>
				</div>
				<select class="selectpicker form-control" data-live-search="true" class="form-control" name="tipo_escena" required>
					<option value="" selected>{{old('tipo_escena')}}</option>
					<option value="Tipo 1">Tipo 1</option>
					<option value="Tipo 2">Tipo 2</option>
					<option value="Tipo 3">Tipo 3</option>
					<option value="Tipo 4">Tipo 4</option>
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Station') !!}</span>
				</div>
				<select class="selectpicker form-control" data-live-search="true" name="station_id" required >
					<option value="" selected>{{old('station_id')}}</option>
					@foreach($estaciones as $estacion)
					<option value="{{$estacion->id}}">{{$estacion->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<!--Div Tipo Evento-->
		<div class="form-row">
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Address') !!}</span>
				</div>
				<textarea class="form-control" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea">{{old('direccion')}}</textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group input-group-prepend col-md-4">
				<div>
					<span class="input-group-text">{!! trans('messages.Parishes') !!}</span>
				</div>
				<select class="selectpicker form-control" data-live-search="true" name="parroquia_id" required>
					<option value="" selected>{{old('parroquia_id')}}</option>
					@foreach($parroquias as $parroquia)
					<option value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
					@endforeach
				</select>
				<a rel="nofollow noopener noreferrer" href="{{asset('files/MapaCuenca.pdf')}}" target="_blank" role="button" data-toggle="tooltip" title="Mapa" class="btn btn-outline-info"><i class="icon-file icon-2x"></i></a>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputAddress">Geoposicion</span>
				</div>
				<textarea class="form-control" placeholder="Formato:. -2.56985, -79.23658" id="pgeoposicion" name="geoposicion" aria-label="With textarea">{{old('geoposicion')}}</textarea>
			</div>
		</div>
		<!--Div Ubicacion Evento-->

		<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
		<hr>
		<div class="form-row">
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Jefe Guardia</span>
				</div>
				<select class="selectpicker form-control" data-live-search="true"  name="jefeguardia_id" required>
					<option value="" selected>{{old('jefeguardia_id')}}</option>
					@foreach($bomberos as $user)
					<option value="{{$user->id}}">{{$user->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Bombero</span>
				</div>
				<select required class="selectpicker form-control" data-live-search="true" name="bombero_id">
					<option value="" selected>{{old('bombero_id')}}</option>
					@foreach($bomberos as $user)
					<option value="{{$user->id}}">{{$user->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Conductor</span>
				</div>
				<select required class="selectpicker form-control" data-live-search="true" name="conductor_id">
					<option value="" selected>{{old('conductor_id')}}</option>
					@foreach($maquinistas as $maquinista)
					<option value="{{$maquinista->id}}">{{$maquinista->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<!--Div Personal que asiste Evento-->
		<div class="form-row">
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia')}}" onblur="CheckTime(this);" placeholder="hh:mm:ss" required="">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" value="{{old('hora_llegada_a_emergencia')}}" placeholder="hh:mm:ss" onblur="CheckTime(this);" required="">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual1" id="horactual1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		<!--Div Horas Evento-->
		<div class="form-row">
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_fin_emergencia" value="{{old('hora_fin_emergencia')}}" id="hora_fin_emergencia" onblur="CheckTime(this);" placeholder="hh:mm:ss">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input type="text" class="form-control" name="hora_en_base" value="{{old('hora_en_base')}}" id="hora_en_base" onblur="CheckTime(this);" placeholder="hh:mm:ss">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual3" id="horactual3"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		<!--Div Horas Evento-->

		<div class="form-row">
			<div class="form-group input-group  col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">Detalle Emergencia</span>
				</div>
				<textarea class="form-control Text-uppercase" maxlength="3000" id="detalle_emergencia" name="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia" aria-label="With textarea" required="">{{old('detalle_emergencia')}}</textarea>

			</div>
		</div>
		<!--Detalle Emergencia-->
		<div class="counter" id="pcounter1">0</div>
		<div class="form-row">
			<div class="form-group input-group  col-md-8">
				<div class="input-group-prepend">
					<span class="input-group-text">Ciud. Afectado</span>
				</div>
				<input type="text" maxlength="83" class="form-control" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado')}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
			</div>
		</div>{{--Usuario Afectado--}}
		<div class="form-row">
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDaños">Daños Estimados</span>
				</div>
				<textarea class="form-control Text-uppercase" maxlength="2000" id="danos_estimados" name="danos_estimados" placeholder="Detalle los daños producidos por  el incidente" required="">{{old('danos_estimados')}}</textarea>

			</div>
		</div>{{-- Danos Estimados --}}


		<div class="form-group py-3" id="divguardar">
			<input type="hidden" name="token" value="{{csrf_token()}}">
			<button type="submit" id="Enviar" name="Enviar" value="Enviar" class="btn btn-outline-success">Registrar</button>
			<a class="btn btn-outline-primary" role="button" href="{{ route('rescate.index')}}">Cancelar
			</a>
			<button type="reset" name="Borrar" value="Borrar" class="btn btn-outline-danger">Borrar Formulario</button>
		</div>
	</form>
	@if(count($errors)>0)
	@foreach($errors->all() as $error)
	<div class="alert alert-danger" role="alert">
		{{$error}}
	</div>
	@endforeach
	@endif
	@push ('scripts')


	<script src="/js/funciones.js"></script>


	@endpush


	@endsection

	@section( "piepagina" )


	@endsection