	@extends( "layouts.plantilla" )

	@section( "cabeza" )
		<title>Incendio</title>
	@endsection

	@section( "cuerpo" )
	<h2 class="mt3 shadow p-3 mb-3 bg-white rounded text-danger">Registro Información de Eventos Incendios</h2>
	<ul class="nav justify-content-end"><!-- Menu Cabecera -->
		<li class="nav-item">
			<div class="input-group mb-3">
				
				<div class="input-group-prepend">
					<span title="Notificar x Whatsapp" class="input-group-text"><i class="icon-comments-alt"></i></span>
				</div>
				<a class="btn btn-outline-info" data-toggle="tooltip" title="Notificar x Whatsapp" role="button" onclick="notificacionWhatsapp();">Whatsapp</a>
				<div class="input-group-prepend">
					<span title="Regresar" class="input-group-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
				</div>
				<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('fuego.index')}}">Regresar</a>
			</div>
		</li>
	</ul>
	<hr style="border:2px;">
	@if(count($errors)>0)
	@foreach($errors->all() as $error)
	<div class="alert alert-danger" role="alert">{{$error}}</div>
	@endforeach
	@endif
	<form id="formulario" method="post" action="{{ route('fuego.store')}}">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
			  <a class="nav-link active" id="Informacion-tab" data-toggle="tab" href="#Informacion" role="tab" aria-controls="Informacion" aria-selected="true">Informacion</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" id="Ubicacion-tab" data-toggle="tab" href="#Ubicacion" role="tab" aria-controls="Ubicacion" aria-selected="false">Ubicacion</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" id="Personal-tab" data-toggle="tab" href="#Personal" role="tab" aria-controls="Personal" aria-selected="false">Personal</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="Vehiculos-tab" data-toggle="tab" href="#Vehiculos" role="tab" aria-controls="Vehiculos" aria-selected="false">Vehiculos</a>
			</li>
		  </ul>
		  <div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="Informacion" role="tabpanel" aria-labelledby="Informacion-tab">
				<div class="card mt-4"><!-- Ingreso Incidente Detalle -->
					<div class="form-row mt-4"><!--Div Fecha-->
						{{csrf_field()}}
						<div class="form-group input-group  col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text">{!! trans('messages.Date') !!}</span>
							</div>
							<input type="datetime-local" required id="fecha" name="fecha" class="form-control" value="{{old('fecha',$now)}}">
						</div>
					</div>
					
					<div class="form-row "><!--Div Informacion ECU911-->
						<div class='col-md-6'>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Hora Ficha ECU911</span>
									</div>
									<input type="datetime-local" required name="hora_fichaecu911" onblur="CheckTime(this);" value="{{old('hora_fichaecu911',$now)}}" id="hora_fichaecu911" class="form-control">					
								</div>
							</div>
						</div>
						<div class='col-md-6'>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Nro.Ficha ECU911</span>
									</div>
									<input type="text" required onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911')}}" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="form-row"><!-- Informacion Inicial -->
						<div class='col-md-12'>
							<div class="form-group">
								<div class="input-group date">
									<div class="input-group-prepend">
										<span class="input-group-text">Información Inicial</span>
									</div>
									<textarea  spellcheck=true  class="form-control Text-uppercase" maxlength="2000" id="pinformacion_inicial" name="informacion_inicial" value="{{old('informacion_inicial')}}" aria-label="With textarea" required></textarea>
								</div>
							</div>
						</div>
					</div>
					<p class="text-sm-left" id="pcounter"></p>
					
					<div class="form-row"><!-- Informacion Incidente -->
						<div class="form-group input-group col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text">{!! trans('messages.Incident') !!}</span>
							</div>
							<select class="selectpicker form-control" data-live-search="true" name="incidente_id" id="incidente_id" required>
								<option value="{{old('incidente_id')}}" selected></option>
								@foreach($incidentes as $incidente)
								<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
								@endforeach
							</select>
						</div>
			
						<div class="form-group input-group col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text">{!! trans('messages.scene') !!}</span>
							</div>
							<select class="selectpicker form-control" data-live-search="true" name="tipo_escena" required>
								<option value="{{old('tipo_escena')}}" selected></option>
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
							<select class="selectpicker form-control" data-live-search="true" name="station_id" required>
								<option value="{{old('station_id')}}" selected></option>
								@foreach($estaciones as $estacion)
								<option value="{{$estacion->id}}">{{$estacion->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-row"> <!--Div Horas Evento-->
						<div class="form-group  input-group col-md-10">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
							</div>
							<input type="datetime-local" class="form-control" required="" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" onblur="CheckTime(this);" value="{{old('hora_salida_a_emergencia')}}" placeholder="hh:mm:ss">
							<div class="input-group-append">
								<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
							</div>
			
						</div>
						<div class="form-group  input-group col-md-10">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
							</div>
							<input type="datetime-local" class="form-control" required name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_llegada_a_emergencia')}}">
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
							<input type="datetime-local" class="form-control" required name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_fin_emergencia')}}">
							<div class="input-group-append">
								<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
							</div>
						</div>
						<div class="form-group  input-group col-md-10">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputDetalle">Hora En Base</span>
							</div>
							<input type="datetime-local" class="form-control" required name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_en_base')}}">
							<div class="input-group-append">
								<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual3" id="horactual3"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
					<div class="form-row"> <!--Detalle Emergencia-->
						<div class="form-group input-group  col-md-12">
							<div class="input-group-prepend">
								<span class="input-group-text">Detalle Emergencia</span>
							</div>
							<textarea spellcheck=true class="form-control" maxlength="3000" id="detalle_emergencia" name="detalle_emergencia" aria-label="With textarea" required>{{old('danos_estimados')}}</textarea>
						</div>
					</div>
					<p class="text-sm-left" id="pcounter1"></p>
					<div class="form-row"><!-- Usuario Afectado -->
						<div class="form-group input-group  col-md-8">
							<div class="input-group-prepend">
								<span class="input-group-text">Ciud. Afectado</span>
							</div>
							<input maxlength="191" onkeyup="mayus(this);"  type="text"  class="form-control" required name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado')}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
						</div>
					</div>
					<div class="form-row"><!--  Danos Estimados -->
						<div class="form-group input-group col-md-12">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputDaños">Daños Estimados</span>
							</div>
							<textarea spellcheck=true class="form-control" aria-multiline="true"  id="danos_estimados" name="danos_estimados" aria-label="With textarea" required>{{old('danos_estimados')}}</textarea>
			
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="Ubicacion" role="tabpanel" aria-labelledby="Ubicacion-tab">
				<div class="form-row mt-4"><!--Direcciones Ubicacion-->
					<div class="form-group input-group col-md-4">
						<div class="input-group-prepend">
							<span class="input-group-text">{!! trans('messages.Address') !!}</span>
						</div>
						<input onkeyup="mayus(this);" class="form-control" required name="direccion" id="pdireccion" placeholder="Ubicacion del Evento" >
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
						<a rel="nofollow noopener noreferrer" href="{{asset('files/MapaCuenca.pdf')}}" target="_blank" role="button" data-toggle="tooltip" title="Mapa" class="btn btn-outline-info"><i class="icon-file"></i></a>
					</div>
					<div class="form-group input-group col-md-4">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputAddress">Geoposicion</span>
						</div>
						<input class="form-control" id="pgeoposicion" name="geoposicion" placeholder="Formato:. -2.56985, -79.23658" >
					</div>
				</div>
				
				
				<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div><!--Div Mapa-->
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#f3f4f5" fill-opacity="1" d="M0,128L60,122.7C120,117,240,107,360,96C480,85,600,75,720,96C840,117,960,171,1080,186.7C1200,203,1320,181,1380,170.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
				<hr>
			</div>
			<div class="tab-pane fade" id="Personal" role="tabpanel" aria-labelledby="Personal-tab">
				<div class="card mt-4"><!-- Div Personal en Emergencia -->
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
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#f3f4f5" fill-opacity="1" d="M0,128L60,122.7C120,117,240,107,360,96C480,85,600,75,720,96C840,117,960,171,1080,186.7C1200,203,1320,181,1380,170.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
			</div>
			<div class="tab-pane fade" id="Vehiculos" role="tabpanel" aria-labelledby="Vehiculos-tab">
				<div class="card mt-4"><!-- Ingreso Vehiculos Detalle -->
					<div class="card-header">
						{!! trans('messages.Vehicles in the Emergency') !!}
					</div>
					<div class="card-body">
						<div class="row d-flex">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Km.Salida</span>
									</div>
									<input type="number" class="form-control" name="km_salida" id="pkm_salida" placeholder="Digite Valor">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Km.Llegada</span>
									</div>
									<input type="number" class="form-control" id="pkm_llegada" name="km_llegada" placeholder="Digite Valor">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2 ">
								<button type="button" id="bt_add" class="btn btn-primary btn-block">{!! trans('messages.add') !!}</button>
							</div>
						</div>
						<div class="row d-flex ">
								<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
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
			</div>
		  </div>
		
		<div class="form-group py-3 " id="divguardar">
			<input type="hidden" name="token" value="{{csrf_token()}}">
			<div class="row nav justify-content-end">
				<li class="nav-item">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span title="Grabar" class="input-group-text"><i class="fas fa-check"></i></span>
						</div>						
						<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar" class="btn btn-outline-success">{!! trans('messages.to register') !!}</button>
						<div class="input-group-prepend">
							<span title="Regresar" class="input-group-text"><i class="fas fa-arrow-left"></i></span>
						</div>
						<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('fuego.index')}}">Regresar</a>
					</div>				
				</li>
			</div>
			
		</div>


	</form>
	
	@push ('scripts')

		<!-- Funciones for all pages-->
		<script src="/js/funciones.js"></script>
		<!-- Geolocalizacion  for all pages-->
		<script src="/js/geocoder.js"></script>


	@endpush

	@endsection

	@section( "piepagina" )


	@endsection