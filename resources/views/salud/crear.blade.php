	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Salud</title>

	@endsection

	@section( "cuerpo" )


	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Eventos Salud</h2>

	<ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Whatsapp" role="button" onclick="notificacionWhatsapp();"><i class="icon-comments-alt icon-2x"></i></a>
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('salud.index')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
			</a>
		</li>
	</ul>
	<hr style="border:2px;">
	<form method="post" action="{{ route('salud.store')}}">
		<div class="form-row">
			{{csrf_field()}}
			<div class="form-group input-group  col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!}</span>
				</div>
				<input type="date" required id="fecha" name="fecha" value="{{old('fecha')}}" class="form-control">
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
						<input type="text" required id="hora_fichaecu911" name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_fichaecu911',$now->format('H:i:s') )}}"">
						
					</div>
				</div>
			</div>
			<div class='col-md-4'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input type="text" required onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911')}}" class="form-control @error('ficha_ecu911') is-invalid @enderror">
						@error('ficha_ecu911')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</div>

		</div>
		<!--Div Informacion ECU911-->
		<hr>
		<div class="card">
			<div class="card-header text-white bg-primary">{!! trans('messages.Vehicles in the Emergency') !!}</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Vehìculo</span>
							</div>
							<select class="form-control selectpicker" name="pvehiculo_id" id="pvehiculo_id" data-live-search="true">
								<option  selected></option>
								@foreach($vehiculos as $vehiculo)
								<option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-md-6 col-xs-6">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Km.Salida</span>
							</div>
							<input type="number" class="form-control" value="{{old('ikm_salida')}}" name="ikm_salida" id="pkm_salida" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-md-6 col-xs-6">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputDetalle">Km.Llegada</span>
							</div>
							<input type="number" class="form-control" id="pkm_llegada" name="ikm_llegada" value="{{old('ikm_llegada')}}" placeholder="Digite Valor">
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
		<!--Vehiculos asisten emergencia -->
		<hr>
		<div class="form-row ">
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group date" id="datetimepicker3">
						<div class="input-group-prepend">
							<span class="input-group-text ">{!! trans('messages.Initial information') !!}</span>
						</div>
						<textarea class="form-control @error('informacion_inicial') is-invalid @enderror" maxlength="2000" id="pinformacion_inicial" name="informacion_inicial" aria-label="With textarea" required>{{old('informacion_inicial')}}</textarea>
						@error('informacion_inicial')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
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
				<select required data-live-search="true" class="form-control selectpicker @error('incidente_id') is-invalid @enderror" name="incidente_id" id="incidente_id">
					<option value="">Seleccione...</option>
					@foreach($incidentes as $incidente)
					<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
					@endforeach
				</select>
				@error('incidente_id')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group input-group col-md-3">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.scene') !!}</span>
				</div>
				<select required  class="form-control selectpicker @error('informacion_inicial') is-invalid @enderror" data-live-search="true" name="tipo_escena">

					<option selected="" value="Tipo 1">Tipo 1</option>
					<option value="Tipo 2">Tipo 2</option>
					<option value="Tipo 3">Tipo 3</option>
					<option value="Tipo 4">Tipo 4</option>
				</select>
				@error('tipo_escena')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Station') !!}</span>
				</div>
				<select class="form-control selectpicker" data-live-search="true"  required name="station_id">
					<option value="Seleccione..." selected="">Seleccione...</option>
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
				<textarea class="form-control" id="pdireccion" onkeypress="mayus(this)" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea" required></textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group input-group-prepend col-md-4">
				<div>
					<span class="input-group-text">{!! trans('messages.Parishes') !!}</span>
				</div>
				<select class="form-control selectpicker" data-live-search="true" required name="parroquia_id">
					<option value="" selected>Selecciones...</option>
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
				<textarea class="form-control" id="pgeoposicion" placeholder="Formato:. -2.56985, -79.23658" name="geoposicion" aria-label="With textarea" required></textarea>
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
				<select class="form-control selectpicker" data-live-search="true" name="jefeguardia_id" required>
					<option>{{old('jefeguardia_id')}}</option>
					@foreach($users as $user)
					<option value="{{$user->id}}">{{$user->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Bombero</span>
				</div>
				<select class="form-control selectpicker" data-live-search="true" name="bombero_id" required>
					<option>{{old('bombero_id')}}</option>
					@foreach($users as $user)
					<option value="{{$user->id}}">{{$user->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Conductor</span>
				</div>
				<select class="form-control selectpicker" data-live-search="true" name="conductor_id" required>
					<option>{{old('conductor_id')}}</option>
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
				<input type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" onblur="CheckTime(this);" value="{{old('hora_salida_a_emergencia')}}" placeholder="hh:mm:ss" required>
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" required onblur="CheckTime(this);" value="{{old('hora_llegada_a_emergencia')}}">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual1" id="horactual1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		<!--Div Horas Evento-->
		<div class="form-row">
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Arribo C.Salud</span>
				</div>
				<input type="text" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_fin_emergencia')}}">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input type="text" class="form-control" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_en_base')}}">
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
				<textarea class="form-control"  maxlength="3000" id="detalle_emergencia" name="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia" aria-label="With textarea">{{old('detalle_emergencia')}}</textarea>
			</div>
		</div>
		<!--Detalle Emergencia-->



		{{--Usuarios atendidos emergencia --}}
		<div class="card">
			<div class="card-header text-white bg-primary">Usuarios Atendidos</div>
			<div class="card-body">

				<div class="row">
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"># Hoja Prehosp</span>
							</div>
							<input type="number" class="form-control" value="{{old('hoja')}}" name="hoja" id="phoja" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputDetalle">Nombres y Apellidos</span>
							</div>
							<input onkeyup="mayus(this);" type="text" class="form-control" id="pnombres" name="nombres" value="{{old('nombres')}}" placeholder="Digite Nombre Completo">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Edad</span>
							</div>
							<input type="number" class="form-control" name="edad" id="pedad" placeholder="Digite Valor" min="0" max="100">
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Genero</span>
							</div>
							<select class="form-control selectpicker" name="genero" id="pgenero" data-live-search="true">
								<option selected>Elija...</option>
								<option>Femenino</option>
								<option>Masculino</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Casa Salud</span>
							</div>

							<select class="form-control selectpicker" name="casasalud" id="pcasasalud" data-live-search="true">
								<option selected>Elija...</option>
								<option>Atención en Sitio</option>
								<option>Clínica Albán</option>
								<option>Clínica Cisneros</option>
								<option>Clínica España</option>
								<option>Clínica Fracturas</option>
								<option>Clínica Humanitaria</option>
								<option>Clinica La Paz</option>
								<option>Clinica Latino-Americana</option>
								<option>Clinica Paucarbamba</option>
								<option>Clinica Praxel</option>
								<option>Clinica Santa Ana</option>
								<option>Hosp.Del Niño y Familia</option>
								<option>Hosp.Del.Rio</option>
								<option>Hosp.Jose.Carrasco</option>
								<option>Hosp.Mariano.Estrella</option>
								<option>Hosp.Materno Infantil</option>
								<option>Hosp.Carlos.Elizalde</option>
								<option>Hosp.Militar</option>
								<option>Hosp.Snta.Ana</option>
								<option>Hosp.Santa.Ines</option>
								<option>Hosp.San Juan de Dios</option>
								<option>Hosp.Sinai</option>
								<option>Hosp.Univ.Catolico</option>
								<option>Hosp.Vicente.Corral</option>
								<option>Medimagen</option>
								<option>Solca</option>
								<option>No Amerita Traslado</option>
								<option>Rehusa Traslado</option>
							</select>
						</div>
					</div>
				</div>

				<hr>
				<div class="row">

					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Presión sistólica</span>
							</div>
							<input type="number" class="form-control" value="{{old('presionsis')}}" name="presionsis" id="ppresionsis" max="500" min="0" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Presión diastólica</span>
							</div>
							<input type="number" class="form-control" value="{{old('ppresiondias')}}" name="presiondias" id="ppresiondias" min="0" max="500" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Temperatura</span>
							</div>
							<input type="number" class="form-control" value="{{old('temperatura')}}" name="temperatura" id="ptemperatura" min="0" max="50" step=0.1 placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Glasgow</span>
							</div>
							<input type="number" class="form-control" value="{{old('glasgow')}}" name="glasgow" id="pglasgow" min="0" max="15" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Saturación</span>
							</div>
							<input type="number" class="form-control" value="{{old('saturación')}}" name="saturación" id="psaturacion" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Frecuencia_Cardiaca</span>
							</div>
							<input type="number" class="form-control" value="{{old('Frecuencia_Cardiaca')}}" name="Frecuencia_Cardiaca" id="Frecuencia_Cardiaca" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Frecuencia_Respiratoria</span>
							</div>
							<input type="number" class="form-control" value="{{old('Frecuencia_Respiratoria')}}" name="Frecuencia_Respiratoria" id="Frecuencia_Respiratoria" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Glicemia</span>
							</div>
							<input type="number" class="form-control" value="{{old('Glicemia')}}" name="Glicemia" id="Glicemia" placeholder="Digite Valor">
						</div>
					</div>


					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-gro4up-prepend">
								<span class="input-group-text">Cie</span>
							</div>

							<select class="form-control selectpicker" name="cie10" id="pcie10" data-live-search="true">
								<option>Elija...</option>
								@foreach($cies as $cie)
								<option value="{{$cie->padre}}">{{$cie->padre}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
						<button type="button" id="bt_addpaciente" class="btn btn-primary">{!! trans('messages.add') !!}</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<table id="detallespaciente" class="table table-responsive table-hover">
							<thead style="background-color: #A9D0F5 ">
								<th>Opciones</th>
								<th>Nombres</th>
								<th>Edad</th>
								<th>Genero</th>
								<th>Presion Sistolica</th>
								<th>Presion Diastolica</th>
								<th>Temperatura</th>
								<th>Glasgow</th>
								<th>Saturación</th>
								<th>Frecuencia Cardiaca</th>
								<th>Frecuencia Respiratoria</th>
								<th>Glicemia</th>
								<th>#Hoja Prehosp</th>
								<th>Casa Salud</th>
								<th>Cie10</th>
							</thead>
							<tfoot></tfoot>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
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

		<div class="form-group py-3 " id="divguardar">
			<input type="hidden" name="token" value="{{csrf_token()}}">
			<ul class="nav justify-content-end">
				<li class="nav-item">
					<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('salud.index')}}"><i class="icon-remove icon-2x"></i>
					</a>
					<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar" class="btn btn-outline-success"><i class="icon-ok icon-2x"></i></button>

					<a class="btn btn-outline-info" type="reset" name="Borrar" value="Borrar" data-toggle="tooltip" title="Borrar" role="button"><i class="icon-eraser icon-2x"></i>
					</a>
				</li>
			</ul>
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
	<!-- Geolocalizacion  for all pages-->
	<script src="/js/geocoder.js"></script>

	@endpush
	@endsection
	@section( "piepagina" )
	@endsection