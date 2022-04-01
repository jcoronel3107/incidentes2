@extends( "layouts.plantilla" )

@section( "cabeza" )

	<title>Salud - Edición - BCBVC</title>
@endsection

@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Eventos Salud</h2>
	
	<div class="form-row ">
		<div class="input-group mb-3 justify-content-end">				 
				 <div class="input-group-prepend ml-2">
					<span class="input-group-text"><i class="fas fa-arrow-left"></i></span>
				 </div>
				 <a class="btn btn-outline-secondary" title="Regresar" role="button" href="{{ route('salud.index')}}">Regresar</a>   
		 </div>
	</div>
	<hr style="border:2px;">
	<form id="formulario" method="post" action="/salud/{{$salud->id}}">
		@csrf @method('PATCH')
		<div class="form-row"><!--Div Fecha-->
			<div class="form-group input-group  col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!}</span>
				</div>
				<input required type="text" name="fecha" class="form-control" placeholder="AA-MM-DD" value="{{old('fecha',$salud->fecha)}}">
			</div>
		</div>
		
		<div class="form-row "><!--Div Informacion ECU911-->
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Hora Ficha ECU911</span>
						</div>
						<input type="text" required name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911',$salud->hora_fichaecu911)}}">
					</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input required onkeyup="mayus(this);" type="text" name="ficha_ecu911" value="{{old('ficha_ecu911',$salud->ficha_ecu911)}}" class="form-control">
					</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group date" id="datetimepicker3">
						<div class="input-group-prepend">
							<span class="input-group-text">{!! trans('messages.Initial information') !!}</span>
						</div>
						<textarea required class="form-control" maxlength="2000" id="pinformacion_inicial" name="informacion_inicial" aria-label="With textarea">{{old('informacion_inicial',$salud->informacion_inicial)}}</textarea>

					</div>
				</div>
			</div>
		</div>
		
		<div class="form-row"><!--Div Tipo Evento-->
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Incident') !!}</span>
				</div>
				<select required class="form-control" name="incidente_id" id="incidente_id">
					<option value="{{$salud->incidente_id}}">{{old('incidente_id',$salud->incidente->nombre_incidente)}}</option>
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
					<option value="{{$salud->tipo_escena}}">{{old('tipo_escena',$salud->tipo_escena)}}</option>
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
				<select class="form-control" required name="station_id">
					<option value="{{$salud->station_id}}">{{old('station_id',$salud->station->nombre)}}</option>
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
				<textarea required class="form-control" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea">{{old('direccion',$salud->direccion)}}</textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group input-group-prepend col-md-6">
				<div>
					<span class="input-group-text">{!! trans('messages.Parishes') !!}</span>
				</div>
				<select class="form-control" required name="parroquia_id" >
					<option value="{{$salud->parroquia_id}}" selected="">{{old('parroquia_id',$salud->parroquia->nombre)}}</option>
					@foreach($parroquias as $parroquia)
					<option value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
					@endforeach
				</select>
				<a rel="nofollow noopener noreferrer" href="{{asset('files/MapaCuenca.pdf')}}" target="_blank" role="button" data-toggle="tooltip" title="Mapa" class="btn btn-outline-info"><i class="icon-file icon-2x"></i></a>
			</div>
			<div class="form-group input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputAddress">Geoposicion</span>
				</div>
				<textarea required class="form-control" id="pgeoposicion" name="geoposicion" aria-label="With textarea">{{old('geoposicion',$salud->geoposicion)}}</textarea>
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
							<table id="persontable" class="table table-hover ">
							
								<thead>
										<td>Eliminar</td>
										<td>id</td>
										<td>Nombres_Completos</td>
									</thead>
										@foreach($salud->users as $users)
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
		
		<div class="form-row"><!--Div Horas Evento-->
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$salud->hora_salida_a_emergencia)}}" onblur="CheckTime(this);" placeholder="hh:mm:ss" required="">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" value="{{old('hora_llegada_a_emergencia',$salud->hora_llegada_a_emergencia)}}" placeholder="hh:mm:ss" onblur="CheckTime(this);" required="">
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
				<input type="text" class="form-control" name="hora_fin_emergencia" value="{{old('hora_fin_emergencia',$salud->hora_fin_emergencia)}}" id="hora_fin_emergencia" onblur="CheckTime(this);" placeholder="hh:mm:ss">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input type="text" class="form-control" name="hora_en_base" value="{{old('hora_en_base',$salud->hora_en_base)}}" id="hora_en_base" onblur="CheckTime(this);" placeholder="hh:mm:ss">
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

				<textarea required class="form-control" id="detalle_emergencia" maxlength="3000" name="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia" aria-label="With textarea">{{old('detalle_emergencia',$salud->detalle_emergencia)}}</textarea>
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
								<table id="detalles" class="table table-hover table-condensed">
									<thead class="table-info">
										<th>Opciones</th>
										<th>Vehiculo</th>
										<th>Km.Salida</th>
										<th>Km.Llegada</th>
										<th>Conductor</th>
									</thead>
									<tbody>
										{{$cont = 0}}
										@foreach($salud->vehiculos as $items)
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
		<hr>

		<div class="card mb-2">{{--Usuarios atendidos emergencia --}}
			<div class="card-header">
				Edite Usuario Atendidos
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">{{-- # Hoja Prehosp --}}
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"># Hoja Prehosp</span>
							</div>
							<input type="number" class="form-control" value="{{old('hoja')}}" name="hoja" id="phoja" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">{{-- Nombres y Apellidos --}}
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
				<hr>
				
			</div>
		</div>
		<div class="card mb-2">{{--Usuarios atendidos emergencia --}}
			<div class="card-header">
				Usuario Atendidos
			</div>
			<div class="card-body"></div>
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<table id="detallespaciente" class="table table-responsive table-hover">
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
							<tbody>
								@foreach($salud->pacientes as $pacient)
								<tr id="filapaciente{{$cont = $cont + 1}}">
									<td ><button type="button" class="btn btn-warning" onclick="eliminar2('+contpac+')" type="button">X</button></td>
									
									<td><input type="text" name="frpaciente[]" maxlength="50" required value="{{$pacient->paciente}}"></td>
									<td><input type="number" name="fredad[]" required value="{{$pacient->edad}}"></td>
									<td>
										<select name="frgenero[]" required>
										<option value="{{$pacient->genero}}" selected>{{$pacient->genero}}</option>
										<option>Femenino</option>
										<option>Masculino</option>
										</select>
									</td>
									<td><input type="number" name="frpresion1[]" required value="{{$pacient->presion1}}"></td>
									<td><input type="number" name="frpresion2[]"required value="{{$pacient->presion2}}"></td>
									<td><input type="number" name="frtemperatura[]" required value="{{$pacient->temperatura}}"></td>
									<td><input type="number" name="frglasglow[]" required value="{{$pacient->glasglow}}"></td>
									<td><input type="number" name="frsaturacion[]" required value="{{$pacient->saturacion}}"></td>
									<td><input type="number" name="frcardiaca[]" required value="{{$pacient->Frecuencia_Cardiaca}}"></td>
									<td><input type="number" name="frrespiratoria[]" required value="{{$pacient->Frecuencia_Respiratoria}}"></td>
									<td><input type="number" name="frglicemia[]" required value="{{$pacient->Glicemia}}"></td>
									<td><input type="number" name="frhoja[]" required  value="{{$pacient->hojapre}}"></td>
									<td>
										<select required name="frcasasalud[]">
											<option value="{{$pacient->casasalud}}">{{$pacient->casasalud}}</option>
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
									</td>
									<td>
										<input type="text" name="frcie10[]" required value="{{$pacient->cie_id}}">
									</td>
								</tr>
								@endforeach
							</tbody>
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
			<hr>
		<div class="form-group col-md-12">
			<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Actualizar</button>
			<a class="btn btn btn-primary" role="button" href="{{ route('salud.index')}}">Cancelar
			</a>
		</div>
		
	</form>
	<form method="post" action="/salud/{{$salud->id}}">
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
	@if(count($errors)>0) @foreach($errors->all() as $error)
	<div class="alert alert-danger" role="alert">
		{{$error}}
	</div>
	@endforeach @endif
@endsection