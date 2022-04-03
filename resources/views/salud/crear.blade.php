	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Salud</title>

	@endsection

	@section( "cuerpo" )


	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Eventos Salud</h2>
	<div class="form-row ">
		<div class="input-group mb-3 justify-content-end">
				 <div class="input-group-prepend">
					<span title="Envia ubicaciòn a WhastApp" class="input-group-text"><i class="icon-comments-alt"></i></span>
				 </div>
				 <a class="btn btn-outline-info" data-toggle="tooltip" title="Whatsapp" role="button" onclick="notificacionWhatsapp();">WhatsApp</a>
				 <div class="input-group-prepend ml-2">
					<span class="input-group-text"><i class="fas fa-arrow-left"></i></span>
				 </div>
				 <a class="btn btn-outline-secondary" title="Regresar" role="button" href="{{ route('salud.index')}}">Regresar</a>   
		 </div>
	</div>
	
	<hr style="border:2px;">
	@if(count($errors)>0)
		@foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">
				{{$error}}
			</div>
		@endforeach
	@endif
	<form id="formulario" method="post" action="{{ route('salud.store')}}">
		<div class="form-row"><!--Div Fecha-->
			{{csrf_field()}}
			<div class="form-group input-group  col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!}</span>
				</div>
				<input type="date" required id="fecha" name="fecha" value="{{old('fecha')}}" class="form-control">
			</div>
		</div>
		
		<div class="form-row "><!--Div Informacion ECU911-->
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Hora Ficha ECU911</span>
						</div>
						<input type="text" required id="hora_fichaecu911" name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_fichaecu911',$now->format('H:i:s') )}}"">
						
					</div>
				</div>
			</div>
			<div class='col-md-12'>
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
								<table id="detalles" class="table table-sm table-hover table-striped table-condensed">
									<thead class="table-info">
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
		<div class="counter" id="pcounter"></div>
		<div class="form-row"><!--Div Tipo Evento-->
			<div class="form-group input-group col-md-12">
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

			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.scene') !!}</span>
				</div>
				<select required  class="form-control @error('informacion_inicial') is-invalid @enderror" name="tipo_escena">

					<option selected="" value="Tipo 1">Tipo 1</option>
					<option value="Tipo 2">Tipo 2</option>
					<option value="Tipo 3">Tipo 3</option>
					<option value="Tipo 4">Tipo 4</option>
				</select>
				@error('tipo_escena')
				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Station') !!}</span>
				</div>
				<select class="form-control"  required name="station_id">
					<option value="Seleccione..." selected="">Seleccione...</option>
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
				<textarea class="form-control" id="pdireccion" onkeypress="mayus(this)" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea" required></textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group input-group-prepend col-md-12">
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
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputAddress">Geoposicion</span>
				</div>
				<textarea class="form-control" id="pgeoposicion" placeholder="Formato:. -2.56985, -79.23658" name="geoposicion" aria-label="With textarea" required></textarea>
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
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" onblur="CheckTime(this);" value="{{old('hora_salida_a_emergencia')}}" placeholder="hh:mm:ss" required>
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" required onblur="CheckTime(this);" value="{{old('hora_llegada_a_emergencia')}}">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual1" id="horactual1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		
		<div class="form-row"><!--Div Horas Evento-->
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Arribo C.Salud</span>
				</div>
				<input type="text" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_fin_emergencia')}}">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input type="text" class="form-control" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" onblur="CheckTime(this);" value="{{old('hora_en_base')}}">
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
				<textarea class="form-control"  maxlength="3000" id="detalle_emergencia" name="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia" aria-label="With textarea">{{old('detalle_emergencia')}}</textarea>
			</div>
		</div>
		

		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#f3f4f5" fill-opacity="1" d="M0,128L60,122.7C120,117,240,107,360,96C480,85,600,75,720,96C840,117,960,171,1080,186.7C1200,203,1320,181,1380,170.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>

		
		<div class="card">{{--Usuarios atendidos emergencia --}}
			<div class="card-header">
				Usuario Atendidos
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"># Hoja Prehosp</span>
							</div>
							<input type="number" class="form-control" value="{{old('hoja')}}" name="hoja" id="phoja" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
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
					<div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
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

					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Presión sistólica</span>
							</div>
							<input type="number" class="form-control" value="{{old('presionsis')}}" name="presionsis" id="ppresionsis" max="500" min="0" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Presión diastólica</span>
							</div>
							<input type="number" class="form-control" value="{{old('ppresiondias')}}" name="presiondias" id="ppresiondias" min="0" max="500" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Temperatura</span>
							</div>
							<input type="number" class="form-control" value="{{old('temperatura')}}" name="temperatura" id="ptemperatura" min="0" max="50" step=0.1 placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Glasgow</span>
							</div>
							<input type="number" class="form-control" value="{{old('glasgow')}}" name="glasgow" id="pglasgow" min="0" max="15" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Saturación</span>
							</div>
							<input type="number" class="form-control" value="{{old('saturación')}}" name="saturación" id="psaturacion" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Frecuencia_Cardiaca</span>
							</div>
							<input type="number" class="form-control" value="{{old('Frecuencia_Cardiaca')}}" name="Frecuencia_Cardiaca" id="Frecuencia_Cardiaca" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Frecuencia_Respiratoria</span>
							</div>
							<input type="number" class="form-control" value="{{old('Frecuencia_Respiratoria')}}" name="Frecuencia_Respiratoria" id="Frecuencia_Respiratoria" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Glicemia</span>
							</div>
							<input type="number" class="form-control" value="{{old('Glicemia')}}" name="Glicemia" id="Glicemia" placeholder="Digite Valor">
						</div>
					</div>


					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group  input-group">
							<div class="input-gro4up-prepend">
								<span class="input-group-text">Cie</span>
							</div>

							<select class="form-control selectpicker" name="cie10" id="pcie10" data-live-search="true">
								<option>Elija...</option>
								@foreach($cies as $cie)
								<option value="{{$cie->id}}">{{$cie->codigo}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-6">
						<button type="button" id="bt_addpaciente" class="btn btn-primary">{!! trans('messages.add') !!}</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<table id="detallespaciente" class="table table-sm table-responsive table-hover">
							<thead class="table-info">
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
							<tbody></tbody>
							<tfoot class="table-info">
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
							</tfoot>
						</table >
					</div>
				</div>
			</div>
		</div>
		<hr>

		<div class="form-group py-3 " id="divguardar">
			<input type="hidden" name="token" value="{{csrf_token()}}">
				<div class="input-group mb-3 justify-content-end">
					<div class="input-group-prepend ml-2">
						<span class="input-group-text"><i class="fas fa-arrow-left"></i></span>
					 </div>
					<a class="btn btn-outline-secondary" title="Regresar" role="button" href="{{ route('salud.index')}}">Regresar</a>   
					
					<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar" class="btn btn-outline-success"><i class="icon-ok icon-2x"></i></button>
					</a>
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