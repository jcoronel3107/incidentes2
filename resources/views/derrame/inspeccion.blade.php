
@extends( "layouts.plantilla" )

@section( "cabeza" )
	<title>Derrame - Inspeccion - BCBVC</title>
@endsection

@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registra Información de Inspección de derrame</h2>
	<ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('derrame.index')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
			</a>
		</li>
	</ul>
	<hr style="border:2px;">
	@if(count($errors)>0) @foreach($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{$error}}
		</div>
	@endforeach
	@endif
	<form method="post" action="/registrainspeccionderrame">
		@csrf @method('PATCH')
		<div class="form-row">
			<div class="form-group input-group  col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Date') !!} Registrada Incidente</span>
				</div>
				<input required readonly type="text" name="fecha" class="form-control" placeholder="AA-MM-DD" value="{{old('fecha',$derrame->fecha)}}">
			</div>
		</div><!--Div Fecha-->
		
		<div class="form-row ">
			<div class='col-md-4'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Hora Ficha ECU911</span>
						</div>
						<input required readonly type="text" name="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911',$derrame->hora_fichaecu911)}}">
					</div>
				</div>
			</div>
			<div class='col-md-4'>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Nro.Ficha ECU911</span>
						</div>
						<input required readonly type="text" onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911',$derrame->ficha_ecu911)}}" class="form-control">
					</div>
				</div>
			</div>

		</div>
		<div class="form-row">
			<div class='col-md-12'>
				<div class="form-group">
					<div class="input-group date" id="datetimepicker3">
						<div class="input-group-prepend">
							<span class="input-group-text">Informacion Inicial</span>
						</div>
						<textarea required readonly id="pinformacion_inicial" class="form-control" maxlength="2000" name="informacion_inicial" aria-label="With textarea">{{old('informacion_inicial',$derrame->informacion_inicial)}}</textarea>
					</div>
				</div>
			</div>
		</div><!--Div Informacion ECU911-->
		
		<div class="form-row">
			<div class="form-group input-group col-md-5">
				<div class="input-group-prepend">
					<span class="input-group-text">Incidente</span>
				</div>
				<select required readonly class="selectpicker form-control" data-live-search="true" name="incidente_id" id="incidente_id">
					<option value="{{$derrame->incidente->id}}" selected>{{old('incidente_id',$derrame->incidente->nombre_incidente)}}</option>
					@foreach($incidentes as $incidente)
					<option value="{{$incidente->id}}">{{$incidente->nombre_incidente}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group input-group col-md-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Escenario</span>
				</div>
				<select aria-readonly="true" required class="selectpicker form-control" data-live-search="true" name="tipo_escena">
					<option value="{{$derrame->tipo_escena}}" selected>{{old('tipo_escena',$derrame->tipo_escena)}}</option>
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Station') !!}</span>
				</div>
				<select aria-readonly="true" required name="station_id" class="selectpicker form-control" data-live-search="true">
					<option value="{{$derrame->station->id}}" selected>{{old('station_id',$derrame->station->nombre)}}</option>
				</select>
			</div>
		</div><!--Div Tipo Evento-->
		
		<div class="form-row">
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Dirección</span>
				</div>
				<textarea readonly required class="form-control" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea">{{old('direccion',$derrame->direccion)}}</textarea>
				<input type="button" value="Encode" onclick="codeAddress()">
			</div>
			<div class="form-group input-group input-group-prepend col-md-4">
				<div>
					<span class="input-group-text">Parroquia</span>
				</div>
				<select aria-readonly="true" class="selectpicker form-control" data-live-search="true" required name="parroquia_id" >
					<option value="{{$derrame->parroquia->id}}" selected>{{old('parroquia_id',$derrame->parroquia->nombre)}}</option>
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputAddress">Geoposicion</span>
				</div>
				<textarea readonly required class="form-control" id="pgeoposicion" name="geoposicion" aria-label="With textarea">{{old('geoposicion',$derrame->geoposicion)}}</textarea>
			</div>
		</div><!--Div Ubicacion Evento-->
		
		<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
		<hr>
		<div class="form-row">
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Jefe Guardia</span>
				</div>
				<select aria-readonly="true" required class="selectpicker form-control" data-live-search="true" name="jefeguardia_id">
					@if((count($derrame->users) === 3)&&($derrame->users->isNotEmpty())){
					<option value="{{$derrame->users[2]->id}}" selected="{{$derrame->users[2]->id}}">{{$derrame->users[2]->name}}</option>
					@else{
					<option value="">{{old('jefeguardia_id')}}</option>
					}@endif
					
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Bombero</span>
				</div>
				<select aria-readonly="true" required class="selectpicker form-control" data-live-search="true" name="bombero_id">
					@if((count($derrame->users) === 3)&&($derrame->users->isNotEmpty())){
					<option value="{{$derrame->users[1]->id}}" selected="{{$derrame->users[1]->id}}">{{$derrame->users[1]->name}}</option>
					@else{
					<option value="">{{old('bombero_id')}}</option>
					}@endif
					
				</select>
			</div>
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Conductor</span>
				</div>
				<select aria-readonly="true" required class="selectpicker form-control" data-live-search="true" name="conductor_id">
					@if((count($derrame->users) === 3 )&&($derrame->users->isNotEmpty())){
					<option value="{{$derrame->users[0]->id}}" selected="{{$derrame->users[0]->id}}">{{$derrame->users[0]->name}}</option>
					@else{
					<option value="">{{old('conductor_id')}}</option>
					}@endif
					
				</select>
			</div>
		</div><!--Div Personal que asiste Evento-->
		
		<div class="form-row">
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
				</div>
				<input readonly required type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$derrame->hora_salida_a_emergencia)}}" placeholder="hh:mm:ss">
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
				</div>
				<input required type="text" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" value="{{old('hora_llegada_a_emergencia',$derrame->hora_llegada_a_emergencia)}}">
			</div>
		</div>
		<!--Div Horas Evento-->
		<div class="form-row">
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
				</div>
				<input required type="text" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" value="{{old('hora_fin_emergencia',$derrame->hora_fin_emergencia)}}">
			</div>
			<div class="form-group  input-group col-md-6">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDetalle">Hora En Base</span>
				</div>
				<input readonly required type="text" class="form-control" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" value="{{old('hora_en_base',$derrame->hora_en_base)}}">
			</div>
		</div>
		<!--Div Horas Evento-->
		
		<div class="form-row">
			<div class="form-group input-group  col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">Detalle Emergencia</span>
				</div>
				<textarea required class="form-control" maxlength="3000" name="detalle_emergencia" id="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia">{{old('detalle_emergencia',$derrame->detalle_emergencia)}}</textarea>

			</div>
		</div><!--Detalle Emergencia-->
		
		<div class="form-row">
			<div class="form-group input-group  col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text">Ciud. Afectado</span>
				</div>
				<input readonly required onkeyup="mayus(this);" type="text" class="form-control" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado',$derrame->usuario_afectado)}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
			</div>
		
			<div class="form-group input-group col-md-12">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputDaños">Daños Estimados</span>
				</div>
				<textarea readonly placeholder="Detalle los daños producidos por  el incidente" maxlength="2000" required class="form-control" name="danos_estimados" id="danos_estimados">{{old('danos_estimados',$derrame->danos_estimados)}}</textarea>
			</div>
		</div><!--Usuario Afectado-->

		
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
							<select class="form-control selectpicker" name="vehiculo_id" id="pvehiculo_id" data-live-search="true">
								<option selected>Elija...</option>
								@foreach($vehiculos as $vehiculo)
								<option>{{$vehiculo->codigodis}}</option>
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
		</div><!-- Vehiculos asisten emergencia -->
		<hr>

		<div class="form-group py-3 " id="divguardar">
			<input type="hidden" name="token" value="{{csrf_token()}}">
			<ul class="nav justify-content-end">
				<li class="nav-item">
					<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar" class="btn btn-outline-success"><i class="icon-ok icon-2x"></i></button>
					<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('fuego.index')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
					</a>
				</li>
			</ul>
		</div><!-- Botones -->
	</form>

	<form method="post" action="/fuego/{{$derrame->id}}">
		{{csrf_field()}}
		<input type="hidden" name="_method" value="DELETE">

		<button type="button" class="btn btn-outline-danger" data-toggle="modal" title="Eliminar" data-target="#exampleModal"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
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
		<script>
			$(document).ready(function() {
				

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

			function mayus(e) {
				e.value = e.value.toUpperCase();
			}
		</script>
	@endpush
@endsection

@section( "piepagina" )
	

@endsection
		<!-- <div class="title m-b-md">
					{!! QrCode::size(300)->generate("https://forms.gle/tXtdf59ovuzMR5mw7") !!}
					{!! QrCode::size(300)->backgroundColor(255, 0, 0, 25)->generate("https://forms.gle/tXtdf59ovuzMR5mw7") !!}
		</div> -->