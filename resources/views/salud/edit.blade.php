	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Salud - Edición - BCBVC</title>
	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Eventos Salud</h2>
	<ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('salud.index')}}"><i class="fa fa-arrow-left icon-2x" aria-hidden="true"></i>
			</a>
		</li>
	</ul>
	<hr style="border:2px;">
	<form method="post" action="/salud/{{$salud->id}}">
		@csrf @method('PATCH')
		<div class="form-row">
			<div class="form-group input-group  col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Fecha</span>
				</div>
				<input required="" type="text" name="fecha" class="form-control" placeholder="AA-MM-DD" value="{{old('fecha',$salud->fecha)}}">
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
						<input type="text" required="" name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911',$salud->hora_fichaecu911)}}">
					</div>
				</div>
			</div>
			<div class='col-md-4'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input required="" onkeyup="mayus(this);" type="text" name="ficha_ecu911" value="{{old('ficha_ecu911',$salud->ficha_ecu911)}}" class="form-control">
					</div>
				</div>
			</div>
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group date" id="datetimepicker3">
						<div class="input-group-prepend">
							<span class="input-group-text">Informacion Inicial</span>
						</div>
						<textarea required="" onkeyup="mayus(this);" class="form-control" maxlength="2000" id="pinformacion_inicial" name="informacion_inicial" aria-label="With textarea">{{old('informacion_inicial',$salud->informacion_inicial)}}</textarea>

					</div>
				</div>
			</div>
		</div>
		<!--Div Informacion ECU911-->
		<div class="form-row">
			<div class="form-group input-group col-md-5">
				<div class="input-group-prepend">
					<span class="input-group-text">Incidente</span>
				</div>
				<select required="" class="form-control" name="incidente_id" id="incidente_id">
					<option value="{{$salud->incidente_id}}">{{old('incidente_id',$salud->incidente->nombre_incidente)}}</option>
					@foreach($incidentes as $incidente)
					<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group input-group col-md-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Escenario</span>
				</div>
				<select required="" class="form-control" name="tipo_escena">
					<option value="{{$salud->tipo_escena}}">{{old('tipo_escena',$salud->tipo_escena)}}</option>
					<option value="Tipo 1">Tipo 1</option>
					<option value="Tipo 2">Tipo 2</option>
					<option value="Tipo 3">Tipo 3</option>
					<option value="Tipo 4">Tipo 4</option>
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Estacion</span>
				</div>
				<select required="" name="station_id" class="form-control">
					<option value="{{$salud->station_id}}">{{old('station_id',$salud->station->nombre)}}</option>
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
				<textarea required="" class="form-control" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea">{{old('direccion',$salud->direccion)}}</textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group input-group-prepend col-md-4">
				<div>
					<span class="input-group-text">Parroquia</span>
				</div>
				<select required="" name="parroquia_id" class="form-control">
					<option value="{{$salud->parroquia_id}}" selected="">{{old('parroquia_id',$salud->parroquia->nombre)}}</option>
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
				<textarea required="" class="form-control" id="pgeoposicion" name="geoposicion" aria-label="With textarea">{{old('geoposicion',$salud->geoposicion)}}</textarea>
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
				<select required="" class="form-control" name="jefeguardia_id">
					@if ((count($salud->users) === 3) && ($salud->users->isNotEmpty()))
					<option value="{{$salud->users[2]->id}}" selected="{{$salud->users[2]->id}}">{{old('jefeguardia_id',$salud->users[2]->name)}}</option>
					@else
					<option value="">{{old('jefeguardia_id')}}</option>
					@endif
					@foreach($bomberos as $bombero)
					<option value="{{$bombero->id}}">{{$bombero->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Bombero</span>
				</div>
				<select required="" class="form-control" name="bombero_id">
					@if ((count($salud->users) === 3) && ($salud->users->isNotEmpty()))
					<option value="{{$salud->users[1]->id}}" selected="{{$salud->users[1]->id}}">{{old('bombero_id',$salud->users[1]->name)}}</option>
					@else
					<option value="">{{old('bombero_id')}}</option>
					@endif
					@foreach($bomberos as $bombero)
					<option value="{{$bombero->id}}">{{$bombero->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Conductor</span>
				</div>
				<select required="" class="form-control" name="conductor_id">
					@if ((count($salud->users) === 3) && ($salud->users->isNotEmpty()))
					<option value="{{$salud->users[0]->id}}" selected="{{$salud->users[0]->id}}">{{old('conductor_id',$salud->users[0]->name)}}</option>

					@else
					<option value="">{{old('conductor_id')}}</option>
					@endif

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
				<input required="" type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$salud->hora_salida_a_emergencia)}}" placeholder="hh:mm:ss">
			</div>
			<div class="form-group  input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input required="" type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" value="{{old('hora_llegada_a_emergencia',$salud->hora_llegada_a_emergencia)}}">
			</div>
			<!--Div Horas Evento-->
		</div>
		<div class="form-row">
			<div class="form-group  input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
				</div>
				<input type="text" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" value="{{old('hora_fin_emergencia',$salud->hora_fin_emergencia)}}">
			</div>
			<div class="form-group  input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input required="" type="text" class="form-control" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" value="{{old('hora_en_base',$salud->hora_en_base)}}">
			</div>
		</div>
		<!--Div Horas Evento-->

		<div class="form-row">
			<div class="form-group input-group  col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">Detalle Emergencia</span>
				</div>

				<textarea required="" onkeyup="mayus(this);" class="form-control" id="detalle_emergencia" name="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia" aria-label="With textarea">{{old('detalle_emergencia',$salud->detalle_emergencia)}}</textarea>
			</div>
		</div>
		<!--Detalle Emergencia-->

		{{--Vehiculos asisten emergencia --}}
		<hr>
		<div class="card">
			<div class="card-header text-white bg-primary">Vehiculos en la Emergencia</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Vehìculo</span>
							</div>
							<select class="form-control selectpicker" name="vehiculo_id" id="pvehiculo_id" data-live-search="true">
								<option selected>Elija...</option>
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
							@foreach($salud->vehiculos as $vehiculo)
							<tr class="selected" id="fila{{count($salud->vehiculos)}}">
								<td><button type="button" class="btn btn-warning" onclick="eliminar1('{{count($salud->vehiculos)}}')" type="button">X</button></td>
								<td><input type="hidden" name="vehiculo_id[]" value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</td>
								<td><input type="number" name="km_salida[]" value="{{$vehiculo->pivot->km_salida}}">{{$vehiculo->pivot->km_salida}}</td>
								<td><input type="number" name="km_llegada[]" value="{{$vehiculo->pivot->km_llegada}}">{{$vehiculo->pivot->km_llegada}}</td>
							</tr>
							<tbody></tbody>
							@endforeach
						</table>
					</div>
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
	{{-- Script para almacenar vehiculos asisten --}}
	<script>
		$(document).ready(function() {

			$("#divguardar").show();
			$("#Enviar").show();
			$("#bt_add").click(function() {
				agregar();
			});
			$("#bt_addpaciente").click(function() {
				agregarpaciente();
			});

			var max_chars = 2000;
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
				var diff = max_chars - chars;
				var leyenda = "Caracteres Permitidos 2000 - Digitados: ";
				var res = leyenda.concat(chars);
				$("#pcounter1").html(res);
				if (chars > 2000) {
					$("#detalle_emergencia").addClass('error');
					$("#detalle_emergencia").addClass('error');
				} else {
					$("#detalle_emergencia").removeClass('error');
					$("#detalle_emergencia").removeClass('error');
				}
			});

		});
		var cont = 0;
		var jqkm_salida = 0;
		var jqkm_llegada = 0;
		subtotal = [];

		function agregar() {

			jqkm_salida = $("#pkm_salida").val();
			jqkm_llegada = $("#pkm_llegada").val();
			jqvehiculo = $("#pvehiculo_id").val();
			jqvehiculo_id = $("#pvehiculo_id option.selected").text();
			if (jqkm_salida != "" && jqkm_salida >= 0 && jqkm_llegada != "" && jqkm_llegada >= 0 && jqvehiculo != "") {
				//total = total + subtotal[cont];
				var fila = '<tr class = "selected" id="fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar1(' + cont + ')" type="button">X</button></td><td><input type="hidden" name="vehiculo_id[]" value="' + jqvehiculo + '">' + jqvehiculo + '</td><td><input type="number"  name="km_salida[]" value="' + jqkm_salida + '"></td><td><input type="number"  name="km_llegada[]" value="' + jqkm_llegada + '"></td></tr>';
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

		{
			{
				--Script para almacenar pacientes atendidos--
			}
		}
		//total=0;
		var contpac = 0;
		var jqnombres = "";
		var jqedad = 0;
		var jqgenero = "";
		var jqpresio1 = 0;
		var jqpresion2 = 0;
		var jqtemp = 0;
		var jqglas = 0;
		var jqhoja = 0;
		var jqsatura = 0;
		var jqcsalud = "";
		var jqcie = "";
		subtotal = [];
		$("#Enviar").hide();

		function agregarpaciente() {
			// body...
			jqnombres = $("#pnombres").val();
			jqedad = $("#pedad").val();
			jqgenero = $("#pgenero").val();
			jqpresio1 = $("#ppresionsis").val();
			jqpresio2 = $("#ppresiondias").val();
			jqtemp = $("#ptemperatura").val();
			jqglas = $("#pglasgow").val();
			jqhoja = $("#phoja").val();
			jqsatura = $("#psaturacion").val();
			jqcsalud = $("#pcasasalud ").val();
			jqcie = $("#pcie10").val();

			if ((jqnombres != "") && (jqedad != "") && (jqgenero != "") && (jqpresio1 != "") && (jqpresio2 != "") && (jqtemp != "") && (jqglas != "") && (jqsatura != "") && (jqhoja != "") && (jqcsalud != "") && (jqcie != "")) {
				var filapaciente = '<tr class ="selected" id="filapaciente' + contpac + '"><td><button type="button" class="btn btn-warning" onclick="eliminar2(' + contpac + ')" type="button">X</button></td><td><input type="hidden" name="frpaciente[]" value="' + jqnombres + '">' + jqnombres + '</td><td><input type="hidden" readonly="true" name="fredad[]" value="' + jqedad + '">' + jqedad + '</td><td><input type="hidden" readonly="true" name="frgenero[]" value="' + jqgenero + '">' + jqgenero + '</td><td><input type="hidden" readonly="true" name="frpresion1[]" value="' + jqpresio1 + '">' + jqpresio1 + '</td><td><input type="hidden" readonly="true" name="frpresion2[]" value="' + jqpresio2 + '">' + jqpresio2 + '</td><td><input type="hidden" readonly="true" name="frtemperatura[]" value="' + jqtemp + '">' + jqtemp + '</td><td><input type="hidden" readonly="true" name="frglasglow[]" value="' + jqglas + '">' + jqglas + '</td><td><input type="hidden" readonly="true" name="frsaturacion[]" value="' + jqsatura + '">' + jqsatura + '</td><td><input type="hidden" readonly="true" name="frhoja[]" value="' + jqhoja + '">' + jqhoja + '</td><td><input type="hidden" readonly="true" name="frcasasalud[]" value="' + jqcsalud + '">' + jqcsalud + '</td><td><input type="hidden" readonly="true" name="frcie10[]" value="' + jqcie + '">' + jqcie + '</td></tr>';
				contpac++;
				limpiarpaciente();
				evaluarpaciente();
				$('#detallespaciente').append(filapaciente);


			} else {
				alert("Error al ingresar el detalle de paciente,Llene los campos requeridos!!");
			}

		}

		function limpiarpaciente() {
			$("#pnombres").val("");
			$("#pedad").val("");
			$("#pgenero").val("");
			$("#ppresionsis").val("");
			$("#ppresiondias").val("");
			$("#ptemperatura").val("");
			$("#pglasgow").val("");
			$("#psaturacion").val("");
			$("#pcasasalud").val("");
			$("#pcie10").val("");


		}

		function evaluarpaciente() {
			if (jqnombres != "") {
				$("#divguardar").show();
				$("#Enviar").show();
			} else {
				$("#divguardar").hide();
			}
		}

		function eliminar2(index) {
			//total = total - subtotal[index];
			$("#filapaciente" + index).remove();
			evaluar();

		}
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			var dtToday = new Date();
			var month = dtToday.getMonth() + 1; // getMonth() is zero-based
			var day = dtToday.getDate();
			var year = dtToday.getFullYear();
			if (month < 10)
				month = '0' + month.toString();
			if (day < 10)
				day = '0' + day.toString();


			var maxDate = year + '-' + month + '-' + day;
			$('#fecha').attr('min', maxDate);

		});
	</script>

	@endpush
	@endsection

	@section( "piepagina" )
	@if(count($errors)>0) @foreach($errors->all() as $error)
	<div class="alert alert-danger" role="alert">
		{{$error}}
	</div>
	@endforeach @endif

	@endsection