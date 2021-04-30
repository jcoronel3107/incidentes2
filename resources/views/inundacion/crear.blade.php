	@extends( "layouts.plantilla" )

	@section( "cabeza" )

		<title>Inundacion</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Eventos 10-20</h2>
		<ul class="nav justify-content-end">
			<li class="nav-item">
				<a class="btn btn-outline-info" data-toggle="tooltip" title="Whatsapp" role="button" onclick="notificacionWhatsapp();"><i class="icon-comments-alt icon-2x"></i></a>
				<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('inundacion.index')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
			</li>
		</ul>
		<hr style="border:2px;">
		@if(count($errors)>0)
		@foreach($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{$error}}
		</div>
		@endforeach
		@endif
		<form method="post" action="/inundacion">
			<div class="form-row">
				{{csrf_field()}}
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha</span>
					</div>
					<input type="date" autocomplete="off" placeholder="Introduce una fecha" required id="fecha" name="fecha" class="form-control">
				</div>
			</div>
			<!--Div Fecha-->
			<div class="form-row ">
				<div class='col-md-6'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Hora Ficha ECU911</span>
							</div>
							<input type="text" class="form-control" id="hora_fichaecu911" name="hora_fichaecu911" value="{{old('hora_fichaecu911',$now->format('H:i:s') )}}" required>
							
						</div>
					</div>
				</div>
				<div class='col-md-6'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Nro.Ficha ECU911</span>
							</div>
							<input type="text" onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911')}}" required autocomplete="off" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<!--Div Informacion ECU911-->
			<hr>
			<div class="card">
				<div class="card-header">Vehiculos en la Emergencia</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Vehìculo</span>
								</div>
								<select class="form-control selectpicker " data-live-search="true" name="pvehiculo_id" id="pvehiculo_id">
									<option value="" selected></option>
									@foreach($vehiculos as $vehiculo)
									<option value="{{$vehiculo->id}}>{{$vehiculo->codigodis}}</option>
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
							<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
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
								<span class="input-group-text">Informacion Inicial</span>
							</div>
							<textarea class="form-control Text-uppercase" id="pinformacion_inicial" name="informacion_inicial" aria-label="With textarea" maxlength="2000" required></textarea>
						</div>
					</div>
					<p class="text-sm-left" id="pcounter">0</p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group col-md-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Incidente</span>
					</div>
					<select class="selectpicker form-control" data-live-search="true" name="incidente_id" id="incidente_id" required>
						<option value="" selected>{{old('incidente_id')}}</option>
						@foreach($incidentes as $incidente)
						<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group input-group col-md-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Escenario</span>
					</div>
					<select class="selectpicker form-control" data-live-search="true" name="tipo_escena" required>
						<option value="" selected>{{old('tipo_escena')}}</option>
						<option value="Tipo 1">Tipo 1</option>
						<option value="Tipo 1">Tipo 2</option>
						<option value="Tipo 1">Tipo 3</option>
						<option value="Tipo 1">Tipo 4</option>
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Estacion</span>
					</div>
					<select name="station_id" class="form-control" required>
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
						<span class="input-group-text">Dirección</span>
					</div>
					<textarea class="form-control Text-uppercase" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea" required></textarea>
					<input type="button" value="Encode" onclick="codeAddress()">
				</div>
				<div class="form-group input-group input-group-prepend col-md-4">
					<div>
						<span class="input-group-text">Parroquia</span>
					</div>
					<select class="selectpicker form-control" data-live-search="true" name="parroquia_id" class="form-control" required>
						<option value="" selected>{{old('parroquia_id')}}</option>
						@foreach($parroquias as $parroquia)
						<option value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
						@endforeach
					</select>
					<a rel="nofollow noopener noreferrer" href="{{asset('files/MapaCuenca.pdf')}}" target="_blank" role="button" data-toggle="tooltip" title="Mapa" class="btn btn-outline-info"><i class="icon-file icon-2x"></i></a>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Geoposicion</span>
					</div>
					<textarea class="form-control Text-uppercase" placeholder="Formato:. -2.56985, -79.23658" id="pgeoposicion" name="geoposicion" aria-label="With textarea"></textarea>
				</div>

			</div>
			<!--Div Ubicacion Evento-->

			<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
			<hr>
			<div class="form-row">
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">C.I.</span>
					</div>
					<select class="selectpicker form-control" data-live-search="true" name="jefeguardia_id" required>
						<option selected>{{old('jefeguardia_id')}}</option>
						@foreach($users as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Bombero</span>
					</div>
					<select class="selectpicker form-control" data-live-search="true" name="bombero_id" required>
						<option selected>{{old('bombero_id')}}</option>
						@foreach($users as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Conductor</span>
					</div>
					<select class="selectpicker form-control" data-live-search="true" name="conductor_id" required>
						<option selected>{{old('conductor_id')}}</option>
						@foreach($maquinistas as $maquinista)
						<option value="{{$maquinista->id}}">{{$maquinista->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<!--Div Personal que asiste Evento-->
			<div class="form-row">
				<div class="form-group input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Salida A Emerg.</span>
					</div>
					<input type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" onblur="CheckTime(this);" value="{{old('hora_salida_a_emergencia')}}" required>
					<div class="input-group-append">
						<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					</div>
				</div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Llegada A Emerg.</span>
					</div>
					<input type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" onblur="CheckTime(this);" value="{{old('hora_llegada_a_emergencia')}}" required>
					<div class="input-group-append">
						<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual1" id="horactual1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<!--Div Horas Evento-->
			<div class="form-row">
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Fin Emerg.</span>
					</div>
					<input type="text" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" onblur="CheckTime(this);" value="{{old('hora_fin_emergencia')}}" required>
					<div class="input-group-append">
						<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					</div>
				</div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora En Base</span>
					</div>
					<input type="text" class="form-control" name="hora_en_base" id="hora_en_base" onblur="CheckTime(this);" value="{{old('hora_fichaecu911')}}" required>
					<div class="input-group-append">
						<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual3" id="horactual3"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<!--Div Horas Evento-->
			<div class="form-row">
				<div class="form-group input-group col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text">Detalle Emergencia</span>
					</div>
					<textarea class="form-control Text-uppercase" id="detalle_emergencia" name="detalle_emergencia" aria-label="With textarea" maxlength="3000" required>{{old('detalle_emergencia')}}</textarea>

				</div>
			</div>
			<div class="counter col-md-3 col-sm-12" id="pcounter1">0</div>
			
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Ciud. Afectado</span>
					</div>
					<input onkeyup="mayus(this);" type="text" maxlength="255" class="form-control" autocomplete="off" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado')}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia" required>
				</div>
			</div><!-- Usuario Afectado -->
			<div class="form-row">
				<div class="form-group input-group col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDaños">Daños Estimados</span>
					</div>
					<textarea class="form-control Text-uppercase" id="danos_estimados" name="danos_estimados" aria-label="With textarea" maxlength="2000" required>{{old('danos_estimados')}}</textarea>
				</div>
			</div><!-- Danos Estimados -->


			<div class="form-group py-3 " id="divguardar">
				<input type="hidden" name="token" value="{{csrf_token()}}">
				<ul class="nav justify-content-end">
					<li class="nav-item">
						<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('inundacion.index')}}"><i class="icon-remove icon-2x"></i>
						</a>
						<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar" class="btn btn-outline-success"><i class="icon-ok icon-2x"></i></button>

						<a class="btn btn-outline-info" type="reset" name="Borrar" value="Borrar" data-toggle="tooltip" title="Borrar" role="button"><i class="icon-eraser icon-2x"></i>
						</a>
					</li>
				</ul>
			</div>
		</form>
		
		@push ('scripts')


		<script src="/js/funciones.js"></script>


		@endpush
	@endsection

	@section( "piepagina" )


	@endsection