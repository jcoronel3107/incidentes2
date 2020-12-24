	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Salud - Crear - BCBVC</title>

	@endsection

	@section( "cuerpo" )


		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Eventos Salud</h2>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		  	<a class="btn btn-outline-info"  data-toggle="tooltip" title="Whatsapp" role="button" onclick="notificacionWhatsapp();"><i class="icon-comments-alt icon-2x"></i></a>
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('salud.index')}}"><i class="icon-remove icon-2x"></i>
						</a>
		  </li>
		</ul>
		<hr style="border:2px;">
		<form method="post" action="/salud">
			<div class="form-row">
				{{csrf_field()}}
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha</span>
					</div>
					<input type="date" required="" id="fecha" name="fecha" value="{{old('fecha')}}" class="form-control">
				</div>
			</div><!--Div Fecha-->
			<div class="form-row ">
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Hora Ficha ECU911</span>
							</div>
							<input type="time" required="" name="hora_fichaecu911"  class="form-control" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911')}}">
						</div>
					</div>
				</div>
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Nro.Ficha ECU911</span>
							</div>
							<input type="text" required="" onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911')}}" class="form-control">
						</div>
					</div>
				</div>

			</div><!--Div Informacion ECU911-->
			<div class="form-row ">
				<div class='col-md-12'>
					<div class="form-group">
						<div class="input-group date" id="datetimepicker3">
							<div class="input-group-prepend">
								<span class="input-group-text">Informacion Inicial</span>
							</div>
							<textarea class="form-control" maxlength="1000" id="pinformacion_inicial" name="informacion_inicial"  aria-label="With textarea" required="" >{{old('informacion_inicial')}}</textarea>

						</div>
					</div>
				</div>
			</div>
			<div class="counter" id="pcounter">0</div>
			<div class="form-row">
				<div class="form-group input-group col-md-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Incidente</span>
					</div>
					<select required="" class="form-control" name="incidente_id" id="incidente_id">
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
					<select required="" class="form-control" name="tipo_escena">
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
					<select required="" name="station_id" class="form-control">
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
					<textarea class="form-control" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea" required=""></textarea>
					<input type="button" value="Encode" onclick="codeAddress()">
				</div>
				<div class="form-group input-group input-group-prepend col-md-4">
					<div >
						<span class="input-group-text">Parroquia</span>
					</div>
					<select required="" name="parroquia_id" class="form-control">
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
					<textarea class="form-control" id="pgeoposicion" placeholder="Formato:. -2.56985, -79.23658" name="geoposicion" aria-label="With textarea" ></textarea>
				</div>
			</div><!--Div Ubicacion Evento-->
			<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
			<hr >
			<div class="form-row">
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">C.I.</span>
					</div>
					<select class="form-control" name="jefeguardia_id" required="">
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
					<select class="form-control" name="bombero_id" required="">
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
					<select class="form-control" name="conductor_id" required="">
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
					<input type="time" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$now->format('H:i:s'))}}" placeholder="hh:mm:ss" required="">
				</div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
					</div>
					<input type="time" class="form-control" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss"  value="{{old('hora_llegada_a_emergencia')}}">
				</div>
			</div><!--Div Horas Evento-->
			<div class="form-row">
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
					</div>
					<input type="time" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" value="{{old('hora_fin_emergencia',$now->format('H:i:s'))}}">
				</div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora En Base</span>
					</div>
					<input type="time" class="form-control" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" value="{{old('hora_en_base',$now->format('H:i:s'))}}">
				</div>
			</div><!--Div Horas Evento-->

			<div class="form-row">
				<div class="form-group input-group  col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text">Detalle Emergencia</span>
					</div>
					
					<textarea class="form-control" maxlength="1000" id="detalle_emergencia" name="detalle_emergencia" placeholder="Digite a detalle lo ocurrido en Emergencia" aria-label="With textarea" >{{old('detalle_emergencia')}}</textarea>
				</div>
			</div><!--Detalle Emergencia-->



			{{--Usuarios atendidos emergencia --}}
			<div class="card">
				<div class="card-header text-white bg-primary">Usuarios Atendidos</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
							<div class="form-group  input-group">
									<div class="input-group-prepend">
									<span class="input-group-text" id="inputDetalle">Nombres y Apellidos</span>
									</div>
									<input type="text" class="form-control" id="pnombres"  name="nombres" value="{{old('nombres')}}" placeholder="Digite Nombre Completo">
								</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Edad</span>
								</div>
								<input type="number" class="form-control" name="edad" id="pedad"  placeholder="Digite Valor" min="0" max="100">
							</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
							<div class="form-group  input-group">
								<div class="input-group-prepend">
										<span class="input-group-text" >Genero</span>
								</div>
								<select class="form-control selectpicker"  name="genero" id="pgenero" data-live-search="true">
										<option selected>Elija...</option>
										<option>Femenino</option>
										<option>Masculino</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" >Presión sistólica</span>
									</div>
									<input type="number" class="form-control" value="{{old('presionsis')}}"  name="presionsis" id="ppresionsis" max="500" min="50" placeholder="Digite Valor">
								</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" >Presión diastólica</span>
									</div>
									<input type="number" class="form-control" value="{{old('ppresiondias')}}"  name="presiondias" id="ppresiondias" min="50" max="500" placeholder="Digite Valor">
								</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" >Temperatura</span>
									</div>
									<input type="number" class="form-control" value="{{old('temperatura')}}"  name="temperatura" id="ptemperatura" min="30" max="50" step=0.1 placeholder="Digite Valor">
								</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" >Glasgow</span>
									</div>
									<input type="number" class="form-control" value="{{old('glasgow')}}"  name="glasgow" id="pglasgow" min="1" max="15" placeholder="Digite Valor">
								</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" >Saturación</span>
									</div>
									<input type="number" class="form-control" value="{{old('saturación')}}"  name="saturación" id="psaturacion" placeholder="Digite Valor">
								</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" ># Hoja Prehosp</span>
									</div>
									<input type="number" class="form-control" value="{{old('hoja')}}"  name="hoja" id="phoja" placeholder="Digite Valor">
								</div>
						</div>

						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
								<div class="form-group  input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" >Casa Salud</span>
									</div>

									<select class="form-control selectpicker" name="casasalud" id="pcasasalud" data-live-search="true" >
										<option selected>Elija...</option>
										<option>Hosp.Vicente.Corral</option>
										<option>Hosp.Jose.Carrasco</option>
										<option>Hosp.Mariano.Estrella</option>
										<option>Hosp.Carlos.Elizalde</option>
										<option>Hosp.Santa.Ines</option>
										<option>Hosp.Sinai</option>
										<option>Hosp.Del.Rio</option>
										<option>Hosp.Univ.Catolico</option>
										<option>Hosp.Militar</option>
										<option>Hosp.Snta.Ana</option>
										<option>Clínica</option>
										<option>No Amerita Traslado</option>
										<option>Rehusa Traslado</option>
									</select>
								</div>
						</div>
						<div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
							<div class="form-group  input-group">
									<div class="input-gro4up-prepend">
										<span class="input-group-text" >Cie</span>
									</div>

									<select class="form-control selectpicker" name="cie10" id="pcie10" data-live-search="true" >
										<option selected>Elija...</option>
										@foreach($cies as $cie)
										<option value="{{$cie->padres}}">{{$cie->padre}}</option>
										@endforeach
									</select>
								</div>
						</div>

						<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
							<button type="button" id="bt_addpaciente" class="btn btn-primary">Agregar</button>
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
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<hr>
			{{--Vehiculos asisten emergencia --}}
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
									<input type="number" class="form-control" value="{{old('ikm_salida')}}"  name="ikm_salida" id="pkm_salida" placeholder="Digite Valor">
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
		    			<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('salud.index')}}"><i class="icon-remove icon-2x"></i>
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
		 		<div class="alert alert-danger" role="alert">
			{{$error}}</div>
			@endforeach
		@endif
		
		@push ('scripts')
			{{-- Script para almacenar vehiculos asisten --}}
			<script>


				$(document).ready(function(){
					

					$("#bt_add").click(function () {
						agregar();
					});
					$("#bt_addpaciente").click(function () {
						agregarpaciente();
					});

					var max_chars = 1000;
					$('#max').html(max_chars);

				    $("#pinformacion_inicial").keyup(function() {
				        var chars = $("#pinformacion_inicial").val().length;
				        var diff = max_chars - chars;
				        var leyenda = "Caracteres Permitidos 1000 - Digitados: ";
				        var res = leyenda.concat(chars);
				        $("#pcounter").html(res);
				        if(chars > 1000){
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
				        var leyenda = "Caracteres Permitidos 1000 - Digitados: ";
				        var res = leyenda.concat(chars);
				        $("#pcounter1").html(res);
				        if(chars > 1000){
				           $("#detalle_emergencia").addClass('error');
				           $("#detalle_emergencia").addClass('error');
				          }else{
				            $("#detalle_emergencia").removeClass('error');
				            $("#detalle_emergencia").removeClass('error');
				          }
				      });

				});

				//total=0;
				var cont=0;
				var jqkm_salida=0;
				var jqkm_llegada=0;
				subtotal=[];
				$("#Enviar").hide();

				


				function agregar() {
				// body...
					jqkm_salida=$("#pkm_salida").val();
					jqkm_llegada=$("#pkm_llegada").val();
					jqvehiculo=$("#pvehiculo_id").val();
					jqvehiculo_id=$("#pvehiculo_id option.selected").text();
					if(jqkm_salida!="" && jqkm_salida>=0 && jqkm_llegada!="" && jqkm_llegada>=0 && jqvehiculo!="")
					{
						//total = total + subtotal[cont];
						var fila = '<tr class = "selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar1('+cont+')" type="button">X</button></td><td><input type="hidden" name="vehiculo_id[]" value="'+jqvehiculo+'">'+jqvehiculo+'</td><td><input type="number"  name="km_salida[]" value="'+jqkm_salida+'"></td><td><input type="number"  name="km_llegada[]" value="'+jqkm_llegada+'"></td></tr>';
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
					//if(jqkm_llegada>jqkm_salida && jqnombres!="" ){
						$("#divguardar").show();
						$("#Enviar").show();
					//}
					//else{
					//	$("#divguardar").hide();
					//}
				}

				function eliminar1(index){
					//total = total - subtotal[index];
					$("#fila"+index).remove();
					evaluar();
				}

				function mayus( e ) {
					e.value = e.value.toUpperCase();
				}

				{{-- Script para almacenar pacientes atendidos --}}
				//total=0;
				var contpac=0;
				var jqnombres="";
				var jqedad=0;
				var jqgenero="";
				var jqpresio1=0;
				var jqpresion2=0;
				var jqtemp=0;
				var jqglas=0;
				var jqhoja=0;
				var jqsatura=0;
				var jqcsalud="";
				var jqcie="";
				subtotal=[];
				$("#Enviar").hide();

				function agregarpaciente() {
				// body...
					jqnombres=$("#pnombres").val();
					jqedad=$("#pedad").val();
					jqgenero=$("#pgenero").val();
					jqpresio1=$("#ppresionsis").val();
					jqpresio2=$("#ppresiondias").val();
					jqtemp=$("#ptemperatura").val();
					jqglas=$("#pglasgow").val();
					jqhoja=$("#phoja").val();
					jqsatura=$("#psaturacion").val();
					jqcsalud=$("#pcasasalud ").val();
					jqcie=$("#pcie10").val();

					if((jqnombres!="") && (jqedad!="") && (jqgenero !="") && (jqpresio1!="") && (jqpresio2!="") && (jqtemp!="")&&(jqglas!="")&&(jqsatura!="")&&(jqhoja!="")&&(jqcsalud!="")&&(jqcie!=""))
					{
						var filapaciente = '<tr class ="selected" id="filapaciente'+contpac+'"><td><button type="button" class="btn btn-warning" onclick="eliminar2('+contpac+')" type="button">X</button></td><td><input type="hidden" name="frpaciente[]" value="'+jqnombres+'">'+jqnombres+'</td><td><input type="hidden" readonly="true" name="fredad[]" value="'+jqedad+'">'+jqedad+'</td><td><input type="hidden" readonly="true" name="frgenero[]" value="'+jqgenero+'">'+jqgenero+'</td><td><input type="hidden" readonly="true" name="frpresion1[]" value="'+jqpresio1+'">'+jqpresio1+'</td><td><input type="hidden" readonly="true" name="frpresion2[]" value="'+jqpresio2+'">'+jqpresio2+'</td><td><input type="hidden" readonly="true" name="frtemperatura[]" value="'+jqtemp+'">'+jqtemp+'</td><td><input type="hidden" readonly="true" name="frglasglow[]" value="'+jqglas+'">'+jqglas+'</td><td><input type="hidden" readonly="true" name="frsaturacion[]" value="'+jqsatura+'">'+jqsatura+'</td><td><input type="hidden" readonly="true" name="frhoja[]" value="'+jqhoja+'">'+jqhoja+'</td><td><input type="hidden" readonly="true" name="frcasasalud[]" value="'+jqcsalud+'">'+jqcsalud+'</td><td><input type="hidden" readonly="true" name="frcie10[]" value="'+jqcie+'">'+jqcie+'</td></tr>';
						contpac++;
						limpiarpaciente();
						evaluarpaciente();
						$('#detallespaciente').append(filapaciente);


					}else{
						alert("Error al ingresar el detalle de paciente,Llene los campos requeridos!!");
					}

				}

				function limpiarpaciente(){
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
				function evaluarpaciente(){
					if(jqnombres!=""){
						$("#divguardar").show();
						$("#Enviar").show();
					}
					else{
						$("#divguardar").hide();
					}
				}

				function eliminar2(index){
					//total = total - subtotal[index];
					$("#filapaciente"+index).remove();
					evaluar();

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