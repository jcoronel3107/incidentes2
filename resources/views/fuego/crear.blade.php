	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Fuego - Crear - BCBVC</title>
	@endsection

	@section( "cuerpo" )


		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Eventos Incendios</h2>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		    
		    <a class="btn btn-outline-info"  data-toggle="tooltip" title="Whatsapp" role="button" onclick="notificacionWhatsapp();"><i class="icon-comments-alt icon-2x"></i></a>
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('fuego.index')}}"><i class="icon-remove icon-2x"></i></a>
		  </li>
		</ul>
		<form method="post" action="/fuego">
			<div class="form-row">
				{{csrf_field()}}
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha</span>
					</div>
					<input type="date" required="" id="fecha" name="fecha" class="form-control"  value="{{old('fecha')}}">
				</div>
			</div><!--Div Fecha-->
			<div class="form-row ">
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Hora Ficha ECU911</span>
							</div>
							<input type="time" required="" name="hora_fichaecu911" id="hora_fichaecu911" class="form-control" placeholder="hh:mm:ss" value="">
							<div class="input-group-append">
								<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual0" id="horactual0"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Nro.Ficha ECU911</span>
							</div>
							<input type="text" required onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911')}}" class="form-control">
						</div>
					</div>
				</div>
			</div><!--Div Informacion ECU911-->
			<div class="form-row">
				<div class='col-md-12'>
					<div class="form-group">
						<div class="input-group date">
							<div class="input-group-prepend">
								<span class="input-group-text">Informacion Inicial</span>
							</div>
							<textarea class="form-control Text-uppercase" maxlength="1000" id="pinformacion_inicial" name="informacion_inicial"  aria-label="With textarea" required="" ></textarea>
						</div>
					</div>
					
				</div>
			</div>
			<p class="text-sm-left" id="pcounter">0</p>
			<div class="form-row">
				<div class="form-group input-group col-md-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Incidente</span>
					</div>
					<select class="form-control" name="incidente_id" id="incidente_id">
						<option selected>{{old('incidente_id')}}</option>
						@foreach($incidentes as $incidente)
							<option>{{$incidente->nombre_incidente}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group input-group col-md-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Escenario</span>
					</div>
					<select class="form-control" name="tipo_escena">
						<option selected>{{old('tipo_escena')}}</option>
						<option>Tipo 1</option>
						<option>Tipo 2</option>
						<option>Tipo 3</option>
						<option>Tipo 4</option>
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Estacion</span>
					</div>
					<select name="station_id" class="form-control">
						<option selected>{{old('station_id')}}</option>
						@foreach($estaciones as $estacion)
						<option>{{$estacion->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div><!--Div Tipo Evento-->
			<div class="form-row">
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Dirección</span>
					</div>
					<textarea  class="form-control" required name="direccion" maxlength="1000" id="pdireccion" placeholder="Ubicacion del Evento" aria-label="With textarea"></textarea>
					<input type="button" value="Encode" onclick="codeAddress()">
				</div>
				<div class="form-group input-group input-group-prepend col-md-4">
					<div >
						<span class="input-group-text">Parroquia</span>
					</div>
					<select name="parroquia_id" class="form-control">
						<option selected>{{old('parroquia_id')}}</option>
						@foreach($parroquias as $parroquia)
							<option>{{$parroquia->nombre}}</option>
						@endforeach
					</select>
					<a href="{{asset('files/MapaCuenca.pdf')}}" target="_blank" role="button" data-toggle="tooltip" title="Mapa" class="btn btn-outline-info" ><i class="icon-file icon-2x"></i></a>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputAddress">Geoposicion</span>
					</div>
					<textarea class="form-control" id="pgeoposicion" name="geoposicion" placeholder="Formato:. -2.56985, -79.23658" aria-label="With textarea"></textarea>
				</div>
			</div><!--Div Ubicacion Evento-->
			
			<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
			<hr >
			<div class="form-row">
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Jefe Guardia</span>
					</div>
					<select class="form-control" name="jefeguardia_id">
						<option selected>{{old('jefeguardia_id')}}</option>
						@foreach($users as $user)
						<option>{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Bombero</span>
					</div>
					<select class="form-control" name="bombero_id">
						<option selected>{{old('bombero_id')}}</option>
						@foreach($users as $user)
						<option>{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Conductor</span>
					</div>
					<select class="form-control" name="conductor_id">
						<option selected>{{old('conductor_id')}}</option>
						@foreach($maquinistas as $maquinista)
						<option>{{$maquinista->name}}</option>
						@endforeach
					</select>
				</div>
			</div><!--Div Personal que asiste Evento-->
			<div class="form-row">
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
					</div>
					<input type="time" class="form-control" required=""  name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="" placeholder="hh:mm:ss">
					<div class="input-group-append">
						<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual" id="horactual"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					</div>
					
				</div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
					</div>
					<input type="time" class="form-control" required="" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" value="">
					<div class="input-group-append">
						<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual1" id="horactual1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					</div>
				</div>
			</div><!--Div Horas Evento-->
			<div class="form-row">
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
					</div>
					<input type="time" class="form-control" required="" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" value="">
					<div class="input-group-append">
						<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual2" id="horactual2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					</div>
				</div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora En Base</span>
					</div>
					<input type="time" class="form-control" required="" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" value="">
					<div class="input-group-append">
						<button type="button" title="Captura Hora Actual" class="btn-outline-info" name="horactual3" id="horactual3"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					</div>
				</div>
			</div><!--Div Horas Evento-->

			<div class="form-row">
				<div class="form-group input-group  col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text">Detalle Emergencia</span>
					</div>
					<textarea class="form-control Text-uppercase" maxlength="1000" id="detalle_emergencia" name="detalle_emergencia"  aria-label="With textarea" required="" >{{old('danos_estimados')}}</textarea>
					
				</div>
			</div><!--Detalle Emergencia-->
			<p class="text-sm-left" id="pcounter1">0</p>
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Ciud. Afectado</span>
					</div>
					<input type="text" maxlength="250" class="form-control" required="" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado')}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
				</div>
			</div>{{--Usuario Afectado--}}
			<div class="form-row">
				<div class="form-group input-group col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDaños">Daños Estimados</span>
					</div>
					<textarea class="form-control Text-uppercase" maxlength="1000" id="danos_estimados" name="danos_estimados"  aria-label="With textarea" required="" >{{old('danos_estimados')}}</textarea>

				</div>
			</div>{{-- Danos Estimados --}}
			<div class="card">
				<div class="card-header">Vehiculos en la Emergencia</div>
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
								<option>{{$vehiculo->codigodis}}</option>
								@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" >Km.Salida</span>
									</div>
									<input type="number" class="form-control"   name="km_salida" id="pkm_salida" placeholder="Digite Valor">
								</div>
						</div>
						<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
							<div class="form-group  input-group">
									<div class="input-group-prepend">
									<span class="input-group-text" id="inputDetalle">Km.Llegada</span>
									</div>
									<input type="number" class="form-control" id="pkm_llegada" name="km_llegada"  placeholder="Digite Valor">
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
			<div class="form-group py-3 " id="divguardar">
				<input type="hidden" name="token" value="{{csrf_token()}}" >
				<ul class="nav justify-content-end">
		  			<li class="nav-item">
		    			<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('fuego.index')}}"><i class="icon-remove icon-2x"></i>
						</a>
						<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar"  class="btn btn-outline-success"><i class="icon-ok icon-2x"></i></button>

						<a class="btn btn-outline-info" type="reset" name="Borrar" value="Borrar" data-toggle="tooltip" title="Borrar" role="button" ><i class="icon-eraser icon-2x"></i>
						</a>
		  			</li>
				</ul>
			</div>


		</form>
		@if(count($errors)>0)
			@foreach($errors->all() as $error)
				<div class="alert alert-danger" role="alert">{{$error}}</div>
			@endforeach
		@endif
		@push ('scripts')
			<script>
				$(document).ready(function(){
					var max_chars = 1000;
					$('#max').html(max_chars);
					$("#bt_add").click(function () {
								agregar();
							});
					$("#horactual0").click(function () {
								hractual(this);
							});
					$("#horactual").click(function () {
								hractual(this);
							});
					$("#horactual1").click(function () {
								hractual(this);
							});

					$("#horactual2").click(function () {
								hractual(this);
							});
					$("#horactual3").click(function () {
								hractual(this);
							});

			    	$("#pinformacion_inicial").keyup(function() {
			        var chars = $("#pinformacion_inicial").val().length;
			        var diff = max_chars - chars;
			        var leyenda = "Caracteres Permitidos 1000 Cant:";
			        var res = leyenda.concat(chars);
			        $("#pcounter").html(res);
			        if(chars >= 1000){
			           $("#pinformacion_inicial").addClass('error');
			           $("#pinformacion_inicial").addClass('error');
			          }else{
			            $("#pinformacion_inicial").removeClass('error');
			            $("#pinformacion_inicial").removeClass('error');
			          }
			      });

			    	$("#detalle_emergencia").keyup(function() {
			        var chars = $("#detalle_emergencia").val().length;
			        var diff = max_chars - chars;
			        var leyenda = "Caracteres Permitidos 1000 Cant:";
			        var res = leyenda.concat(chars);
			        $("#pcounter1").html(res);
			        if(chars >= 1000){
			           $("#detalle_emergencia").addClass('error');
			           $("#detalle_emergencia").addClass('error');
			          }else{
			            $("#detalle_emergencia").removeClass('error');
			            $("#detalle_emergencia").removeClass('error');
			          }
			      });

				});

				total=0;
				var cont=0;
				var jqkm_salida=0;
				var jqkm_llegada=0;
				subtotal=[];
				$("#Enviar").hide();

				function agregar() {
					jqkm_salida=$("#pkm_salida").val();
					jqkm_llegada=$("#pkm_llegada").val();
					jqvehiculo=$("#pvehiculo_id").val();
					jqvehiculo_id=$("#pvehiculo_id option.selected").text();
					if(jqkm_salida!="" && jqkm_salida>=0 && jqkm_llegada!="" && jqkm_llegada>=0 && jqvehiculo!="")
					{
						total = total + subtotal[cont];
						var fila = '<tr class = "selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')" type="button">X</button></td><td><input type="hidden" name="vehiculo_id[]" value="'+jqvehiculo+'">'+jqvehiculo+'</td><td><input type="number"  name="km_salida[]" value="'+jqkm_salida+'"></td><td><input type="number"  name="km_llegada[]" value="'+jqkm_llegada+'"></td></tr>';
						cont++;
						limpiar();
						evaluar();
						$('#detalles').append(fila);

					}else{
						alert("Error al ingresar el detalle de vehiculos,revise los datos!!!");
					}
				}

				function limpiar(){
					$("#pkm_salida").val("");
					$("#pkm_llegada").val("");
				}

				function evaluar(){
					//if(jqkm_llegada>jqkm_salida){
						$("#divguardar").show();
						$("#Enviar").show();
					//}
					//else{
					//	$("#divguardar").hide();
					//}
				}

				function eliminar(index){
					total = total - subtotal[index];
					$("#fila"+index).remove();
					evaluar();
				}

				function mayus( e ) {
					e.value = e.value.toUpperCase();
				}

				function hractual(e) {
					console.log(e);
					var hoy = new Date();
					var h1 = hoy.getHours();
					if(h1>=0 && h1<10) {
						h1 = "0"+ h1;
						}
					var min = hoy.getMinutes();
					if(min>=0 && min<10) {
						min = "0"+ min;
						}
					var sec = hoy.getSeconds();
					if(sec>=0 && sec<10) {
						sec = "0"+ sec;
						}
					var hora = h1  + ':' + min + ':' + sec;
					if(e.name == "horactual")
						$('#hora_salida_a_emergencia').attr('value', hora);
					else if (e.name == "horactual1")
						$('#hora_llegada_a_emergencia').attr('value', hora);
					else if (e.name == "horactual2")
						$('#hora_fin_emergencia').attr('value', hora);
					else if(e.name == "horactual3")
						$('#hora_en_base').attr('value', hora);
					else
						$('#hora_fichaecu911').attr('value', hora);

					
				}

			</script>
			<script type="text/javascript">
				$(document).ready(function(){
					var dtToday = new Date();
					var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
					var day = dtToday.getDate();
					var year = dtToday.getFullYear();
					if(month < 10)
					      month = '0' + month.toString();
					if(day < 10)
					      day = '0' + day.toString();

					
				    var maxDate = year + '-' + month + '-' + day;
					$('#fecha').attr('min', maxDate);
				    
				});
		</script>

		@endpush

	@endsection

	@section( "piepagina" )


	@endsection