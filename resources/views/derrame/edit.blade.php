	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Hazmat - Edición - BCBVC</title>
	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Edit Hazmat Event Information') !!}</h2>
	<ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('derrame.index')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
			</a>
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
	<form method="post" action="/derrame/{{$derrame->id}}">
		@csrf @method('PATCH')
		<div class="form-row">
			<div class="form-group input-group  col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!}</span>
				</div>
				<input required="" type="date" name="fecha" class="form-control" placeholder="AA-MM-DD" value="{{old('fecha',$derrame->fecha)}}">
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
						<input type="text" name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911',$derrame->hora_fichaecu911)}}">
					</div>
				</div>
			</div>
			<div class='col-md-4'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input required="" type="text" onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911',$derrame->ficha_ecu911)}}" class="form-control">
					</div>
				</div>
			</div>
			<div class='col-md-4'>
				<div class="form-group">
					<div class="input-group date" id="datetimepicker3">
						<div class="input-group-prepend">
							<span class="input-group-text">{!! trans('messages.Initial information') !!}</span>
						</div>
						<textarea required="" id="pinformacion_inicial" onkeyup="mayus(this);" class="form-control" maxlength="2000" name="informacion_inicial" aria-label="With textarea">{{old('informacion_inicial',$derrame->informacion_inicial)}}</textarea>
					</div>
				</div>
			</div>
		</div>
		<!--Div Informacion ECU911-->
		<div class="form-row">
			<div class="form-group input-group col-md-5">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Incident') !!}</span>
				</div>
				<select required class="selectpicker form-control" data-live-search="true" name="incidente_id" id="incidente_id">
					<option value="{{$derrame->incidente->id}}" selected>{{old('incidente_id',$derrame->incidente->nombre_incidente)}}</option>
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
					<option value="{{$derrame->tipo_escena}}" selected>{{old('tipo_escena',$derrame->tipo_escena)}}</option>
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
				<select required class="selectpicker form-control" data-live-search="true" name="station_id" >
					<option value="{{$derrame->station->id}}" selected>{{old('estacion_id',$derrame->station->nombre)}}</option>
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
				<textarea required="" onkeyup="mayus(this);" class="form-control" id="pdireccion" name="address" placeholder="Ubicacion del Evento" aria-label="With textarea">{{old('direccion',$derrame->address)}}</textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group input-group-prepend col-md-4">
				<div>
					<span class="input-group-text">{!! trans('messages.Parishes') !!}</span>
				</div>
				<select required class="selectpicker form-control" data-live-search="true" name="parroquia_id">
					<option value="{{$derrame->parroquia->id}}" selected>{{old('parroquia_id',$derrame->parroquia->nombre)}}</option>
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
				<textarea required="" class="form-control" id="pgeoposicion" name="geoposicion" aria-label="With textarea">{{old('geoposicion',$derrame->geoposicion)}}</textarea>
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
				<select required class="selectpicker form-control" data-live-search="true" name="jefeguardia_id">
					@if($derrame->users->isNotEmpty()){
					<option value="{{$derrame->users[2]->id}}" selected="{{$derrame->users[2]->id}}">{{$derrame->users[2]->name}}</option>
					@else{
					<option value="">{{old('jefeguardia_id')}}</option>
					}@endif
					@foreach($bomberos as $bombero)
					<option value="{{$bombero->id}}">{{$bombero->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Bombero</span>
				</div>
				<select required class="selectpicker form-control" data-live-search="true" name="bombero_id">
					@if($derrame->users->isNotEmpty()){
					<option value="{{$derrame->users[1]->id}}" selected="{{$derrame->users[1]->id}}">{{$derrame->users[1]->name}}</option>
					@else{
					<option value="">{{old('bombero_id')}}</option>
					}@endif
					@foreach($bomberos as $bombero)
					<option value="{{$bombero->id}}">{{$bombero->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Conductor</span>
				</div>
				<select required class="selectpicker form-control" data-live-search="true" name="conductor_id">
					@if($derrame->users->isNotEmpty()){
					<option value="{{$derrame->users[0]->id}}" selected="{{$derrame->users[0]->id}}">{{$derrame->users[0]->name}}</option>
					@else{
					<option value="">{{old('conductor_id')}}</option>
					}@endif
					@foreach($maquinistas as $maquinista)
					<option value="{{$maquinista->id}}">{{$maquinista->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<!--Div Personal que asiste Evento-->
		<div class="form-row">
			<div class="form-group  input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
				</div>
				<input required="" type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$derrame->hora_salida_a_emergencia)}}" placeholder="hh:mm:ss">
			</div>
			<div class="form-group  input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" value="{{old('hora_llegada_a_emergencia',$derrame->hora_llegada_a_emergencia)}}">
			</div>
		</div>{{--Div Horas Evento--}}
		<div class="form-row">
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
				</div>
				<input required="" type="text" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" value="{{old('hora_fin_emergencia',$derrame->hora_fin_emergencia)}}">
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input type="text" class="form-control" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" value="{{old('hora_en_base',$derrame->hora_en_base)}}">
			</div>
		</div>{{--Div Horas Evento--}}
		<div class="form-row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Detalle Emergencia</span>
					</div>
					<textarea required="" onkeyup="mayus(this);" class="form-control" name="detalle_emergencia" id="detalle_emergencia" maxlength="3000" aria-label="With textarea" placeholder="Digite a detalle lo ocurrido en Emergencia">{{old('detalle_emergencia',$derrame->detalle_emergencia)}}</textarea>
				</div>
			</div>
		</div>{{--Detalle Emergencia--}}
		<div class="form-row">
			<div class="col-8">
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Ciud. Afectado</span>
					</div>
					<input required="" type="text" class="form-control" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado',$derrame->usuario_afectado)}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
				</div>
			</div>
		</div>{{--Usuario Afectado --}}
		<div class="form-row">
			<div class="form-group input-group col-lg-12 col-md-12 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDaños">Daños Estimados</span>
				</div>
				<input required="" type="text" class="form-control" name="danos_estimados" maxlength="2000" id="danos_estimados" value="{{old('danos_estimados',$derrame->danos_estimados)}}" placeholder="Detalle los daños producidos por  el incidente">
			</div>
		</div>{{-- Daños Estimados --}}

		{{--Vehiculos asisten emergencia --}}
		<hr>
		<div class="card">
			<div class="card-header text-white bg-primary">{!! trans('messages.Vehicles in the Emergency') !!}</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">{!! trans('messages.Vehicles') !!}</span>
							</div>
							<select  class="selectpicker form-control" data-live-search="true" name="pvehiculo_id" id="pvehiculo_id">
								<option selected>{{old('vehiculo_id')}}</option>
								@foreach($vehiculos as $vehiculo)
								<option  value="{{$vehiculo->id}}" >{{$vehiculo->codigodis}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
						<div class="form-group  input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Km.Salida</span>
							</div>
							<input type="number" class="form-control" value="{{old('ikm_salida')}}" name="ikm_salida" id="pkm_salida" placeholder="Digite Valor">
						</div>
					</div>
					<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
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
							@foreach($derrame->vehiculos as $vehiculo)
							<tr class="selected" id="fila{{count($derrame->vehiculos)}}">
								<td><button type="button" class="btn btn-warning" onclick="eliminar1('{{count($derrame->vehiculos)}}')" type="button">X</button></td>
								<td><input type="hidden" name="vehiculo_id[]" value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</td>
								<td><input class="form-control" type="number" name="km_salida[]" value="{{$vehiculo->pivot->km_salida}}">{{$vehiculo->pivot->km_salida}}</td>
								<td><input class="form-control" type="number" name="km_llegada[]" value="{{$vehiculo->pivot->km_llegada}}">{{$vehiculo->pivot->km_llegada}}</td>
							</tr>
							<tbody></tbody>
							@endforeach
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
					<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar" class="btn btn-outline-success"><i class="icon-ok icon-2x"></i></button>
					<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('derrame.index')}}"><i class="icon-remove icon-2x"></i>
					</a>
				</li>
			</ul>
		</div>{{-- Botones --}}

	</form>
	<form method="post" action="/derrame/{{$derrame->id}}">
		{{csrf_field()}}
		<input type="hidden" name="_method" value="DELETE">

		<button type="button" title="Eliminar" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
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
	<!-- Script para almacenar vehiculos asisten-->
	<!-- Geolocalizacion  for all pages-->
	<script src="/js/geocoder.js"></script>
	
	<script>
		$(document).ready(function() {
			$("#bt_add").click(function() {
				agregar();
			});
			$("#bt_addpaciente").click(function() {
				agregarpaciente();
			});

			var max_chars = 2000;
			var max_chars1 = 3000;
			$('#max').html(max_chars);

			$("#pinformacion_inicial").keyup(function() {
				var chars = $("#pinformacion_inicial").val().length;
				var diff = max_chars - chars;
				var leyenda = "Caracteres Permitidos 2000 - Digitados: ";
				var res = leyenda.concat(chars);
				$("#pcounter").html(res);
				if (chars > 2000) {
					$("#pinformacion_inicial").addClass('error');
					$("#pinformacion_inicial").addClass('error');
				} else {
					$("#pinformacion_inicial").removeClass('error');
					$("#pinformacion_inicial").removeClass('error');
				}
			});
			$("#detalle_emergencia").keyup(function() {
				var chars = $("#detalle_emergencia").val().length;
				var diff = max_chars1 - chars;
				var leyenda = "Caracteres Permitidos 3000 - Digitados: ";
				var res = leyenda.concat(chars);
				$("#pcounter1").html(res);
				if (chars > 3000) {
					$("#detalle_emergencia").addClass('error');
					$("#detalle_emergencia").addClass('error');
				} else {
					$("#detalle_emergencia").removeClass('error');
					$("#detalle_emergencia").removeClass('error');
				}
			});

		});

		//total=0;
		var cont = 0;
		var jqkm_salida = 0;
		var jqkm_llegada = 0;
		subtotal = [];
		


		function agregar() {
			// body...
			jqkm_salida = $("#pkm_salida").val();
			jqkm_llegada = $("#pkm_llegada").val();
			jqvehiculo = $("#pvehiculo_id").val();
			jqvehiculo_id =  $('#pvehiculo_id').find('option:selected').text();
			console.log("jqvehiculo_id");
			if (jqkm_salida != "" && jqkm_salida >= 0 && jqkm_llegada != "" && jqkm_llegada >= 0 && jqvehiculo != "") {
				//total = total + subtotal[cont];
				var fila = '<tr class = "selected" id="fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar1(' + cont + ')" type="button">X</button></td><td><input type="hidden" name="vehiculo_id[]" value="' + jqvehiculo + '">' + jqvehiculo_id + '</td><td><input class="form-control" type="number"  name="km_salida[]" value="' + jqkm_salida + '"></td><td><input class="form-control" type="number"  name="km_llegada[]" value="' + jqkm_llegada + '"></td></tr>';
				cont++;
				limpiar();
				evaluar();
				$('#detalles').append(fila);

			} else {
				alert("Error al ingresar el detalle de vehiculos,revise los datos!!!");
			}

		}

		function limpiar() {
			$("#pkm_salida").val("");
			$("#pkm_llegada").val("");
		}

		function evaluar() {

			$("#divguardar").show();
			$("#Enviar").show();
		}

		function eliminar1(index) {
			//total = total - subtotal[index];
			$("#fila" + index).remove();
			evaluar();
		}

		function mayus(e) {
			e.value = e.value.toUpperCase();
		}
	</script>
	@endpush

	@endsection

	@section( "piepagina" )
	


	@endsection