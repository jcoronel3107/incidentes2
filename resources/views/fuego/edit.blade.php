	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Fuego-Edicion-BCBVC</title>
	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Eventos Incendio</h2>
	<ul class="nav justify-content-end">
		<li class="nav-item">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span title="Regresar" class="input-group-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
				</div>
				<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('fuego.index')}}">Regresar</a>
			</div>
		</li>
	</ul>
	@if(count($errors)>0)
		@foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">
				{{$error}}
			</div>
		@endforeach
	@endif
	<hr style="border:2px;">
	<form id="formulario" method="post" action="/fuego/{{$incendio->id}}"><!-- Form Guarda Registro -->
		@csrf @method('PATCH')
		<div class="form-row"><!--Div Fecha-->
			<div class="form-group input-group  col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!}</span>
				</div>
				<input required="" type="text" name="fecha" class="form-control" placeholder="AA-MM-DD" value="{{old('fecha',$incendio->fecha)}}">
			</div>
		</div>
		
		<div class="form-row "><!--Div Informacion ECU911-->
			<div class='col-md-6'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Hora Ficha ECU911</span>
						</div>
						<input required="" type="text" name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911',$incendio->hora_fichaecu911)}}">
					</div>
				</div>
			</div>
			<div class='col-md-6'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input required="" type="text" onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911',$incendio->ficha_ecu911)}}" class="form-control">
					</div>
				</div>
			</div>

		</div>
		<div class="form-row">
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group date" id="datetimepicker3">
						<div class="input-group-prepend">
							<span class="input-group-text">{!! trans('messages.Initial information') !!}</span>
						</div>
						<textarea required="" id="pinformacion_inicial" class="form-control" maxlength="2000" name="informacion_inicial" aria-label="With textarea">{{old('informacion_inicial',$incendio->informacion_inicial)}}</textarea>
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-row">
			<div class="form-group input-group col-md-5">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Incident') !!}</span>
				</div>
				<select required class="selectpicker form-control" data-live-search="true" name="incidente_id" id="incidente_id">
					<option value="{{$incendio->incidente->id}}" selected>{{old('incidente_id',$incendio->incidente->nombre_incidente)}}</option>
					@foreach($incidentes as $incidente)
					<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group input-group col-md-3">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.scene') !!}</span>
				</div>
				<select required class="selectpicker form-control" data-live-search="true" name="tipo_escena">
					<option value="{{$incendio->tipo_escena}}" selected>{{old('tipo_escena',$incendio->tipo_escena)}}</option>
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
				<select required name="station_id" class="selectpicker form-control" data-live-search="true">
					<option value="{{$incendio->station->id}}" selected>{{old('station_id',$incendio->station->nombre)}}</option>
					@foreach($estaciones as $estacion)
					<option value="{{$estacion->id}}">{{$estacion->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<!--Div Tipo Evento-->
		<div class="form-row">
			<div class="form-group input-group col-lg-8 col-md-8 col-ms-12">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Address') !!}</span>
				</div>
				<textarea required class="form-control" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea">{{old('direccion',$incendio->direccion)}}</textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
		</div>
		<div class="form-row"><!--Div Ubicacion Evento-->
			<div class="form-group input-group input-group-prepend col-md-4">
				<div>
					<span class="input-group-text">{!! trans('messages.Parishes') !!}</span>
				</div>
				<select class="selectpicker form-control" data-live-search="true" required name="parroquia_id" >
					<option value="{{$incendio->parroquia->id}}" selected>{{old('parroquia_id',$incendio->parroquia->nombre)}}</option>
					@foreach($parroquias as $parroquia)
					<option value="{{$parroquia->id}}">{{$parroquia->nombre}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputAddress">Geoposicion</span>
				</div>
				<textarea required class="form-control" id="pgeoposicion" name="geoposicion" aria-label="With textarea">{{old('geoposicion',$incendio->geoposicion)}}</textarea>
			</div>
		</div>
		
		<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="0.1" d="M0,224L48,192C96,160,192,96,288,106.7C384,117,480,203,576,208C672,213,768,139,864,128C960,117,1056,171,1152,197.3C1248,224,1344,224,1392,224L1440,224L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z" style="--darkreader-inline-fill: #3d86b6;" data-darkreader-inline-fill=""></path></svg>
		
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
									
									
										
										@foreach($incendio->users as $users)
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
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
				</div>
				<input required type="datetime-local" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$incendio->hora_salida_a_emergencia)}}" placeholder="hh:mm:ss">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input required type="datetime-local" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" value="{{old('hora_llegada_a_emergencia',$incendio->hora_llegada_a_emergencia)}}">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual1" id="horactual1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		
		<div class="form-row"><!--Div Horas Evento-->
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
				</div>
				<input required type="datetime-local" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" value="{{old('hora_fin_emergencia',$incendio->hora_fin_emergencia)}}">
				<div class="input-group-append">
					<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input required type="datetime-local" class="form-control" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" value="{{old('hora_en_base',$incendio->hora_en_base)}}">
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
				<textarea required class="form-control" maxlength="3000" name="detalle_emergencia" id="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia">{{old('detalle_emergencia',$incendio->detalle_emergencia)}}</textarea>

			</div>
		</div>
		
		<div class="form-row"><!--Usuario Afectado-->
			<div class="form-group input-group  col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">Ciud. Afectado</span>
				</div>
				<input required onkeyup="mayus(this);" type="text" class="form-control" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado',$incendio->usuario_afectado)}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
			</div>
		</div>
		
		<div class="form-row"><!-- Daños Estimados -->
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDaños">Daños Estimados</span>
				</div>
				<textarea placeholder="Detalle los daños producidos por  el incidente" maxlength="2000" required class="form-control" name="danos_estimados" id="danos_estimados">{{old('danos_estimados',$incendio->danos_estimados)}}</textarea>
			</div>
		</div>

		<div class="card"><!-- Ingreso Vehiculos Detalle -->
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
							<select class="selectpicker form-control" data-live-search="true"  name="pvehiculo_id" id="pvehiculo_id">
								<option selected></option>
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
								<select class="form-control" name="pconductor_id" id="pconductor_id">
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
									@foreach($incendio->vehiculos as $items)
									{{$cont = $cont + 1}}
									<tr id="fila{{$cont}}">
									<td><button type="button" class="btn btn-warning" onclick="eliminar('{{$cont}}')" type="button">X</button></td>
									<td><input type="hidden" class="form-control" name="vehiculo_id[]" value="{{$items->id}}">{{$items->codigodis}}</td>
									<td><input type="number" class="form-control" name="km_salida[]" value="{{$items->pivot->km_salida}}"></td>
									<td><input type="number" class="form-control" name="km_llegada[]" value="{{$items->pivot->km_llegada}}"></td>
									<td><input type="text" class="form-control" name="driver_id[]" value="{{$items->pivot->driver_id}}"></td>
									</tr>
									
									@endforeach
								</tbody>
								
							</table>
						</div>
				 </div>
			</div>
		</div>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#f3f4f5" fill-opacity="1" d="M0,128L60,122.7C120,117,240,107,360,96C480,85,600,75,720,96C840,117,960,171,1080,186.7C1200,203,1320,181,1380,170.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
		
		<hr>
	
		<div class="form-group py-3 " id="divguardar"><!-- Botones  -->
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
						<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('fuego.index')}}">Regresar</a>
						
					</div>				
				</li>
			</div>
			
		</div>
	</form>
	<form method="post" action="/fuego/{{$incendio->id}}"><!-- Form Borra registro -->
		{{csrf_field()}}
		<input type="hidden" name="_method" value="DELETE">
		<ul class="nav justify-content-end">
			<li class="nav-item">	
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span title="Eliminar" class="input-group-text"><i class="fa fa-trash" aria-hidden="true"></i></span>
					</div>
					<button type="button" class="btn btn-outline-danger" data-toggle="modal" title="Eliminar" data-target="#exampleModal">Eliminar</button>
				</div>
			</li>
		</ul>
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
	<script src="/js/funciones.js"></script>
	<!-- Geolocalizacion  for all pages-->
	<script src="/js/geocoder.js"></script>
	<!-- Script para almacenar vehiculos asisten-->

	@endpush
	@endsection

	@section( "piepagina" )
	

	@endsection