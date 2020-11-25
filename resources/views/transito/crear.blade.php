	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Event Information Log 10-42') !!}</h2>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		  	<a class="btn btn-outline-info"  data-toggle="tooltip" title="Whatsapp" role="button" onclick="notificacionWhatsapp();"><i class="icon-comments-alt icon-2x"></i></a>	
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{route('transito.index')}}"><i class="icon-remove icon-2x"></i>
						</a>
		  </li>
		</ul>
		<form method="post" action="/transito">
			<div class="form-row">
			{{csrf_field()}}
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha</span>
					</div>
					<input type="date" required="" name="fecha" id="fecha" class="form-control" placeholder="AA-MM-DD">
				</div>
			</div><!--Div Fecha-->
			<div class="form-row ">
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Hora Ficha ECU911</span>
							</div>
							<input type="time" name="hora_fichaecu911" required=""  class="form-control" placeholder="hh:mm:ss" value="{{$now->format('H:i:s')}}">
						</div>
					</div>	
				</div>
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Nro.Ficha ECU911</span>
							</div>
							<input type="text" name="ficha_ecu911" required="" value="{{old('ficha_ecu911')}}" class="form-control">
						</div>
					</div>
				</div>

			</div><!--Div Informacion ECU911-->
			<div class="form-row">
				<div class='col-md-12'>
					<div class="form-group">
						<div class="input-group date" id="datetimepicker3">
							<div class="input-group-prepend">
								<span class="input-group-text">Informacion Inicial</span>
							</div>
							<textarea class="form-control" required="" maxlength="1000" id="informacion_inicial" name="informacion_inicial"  aria-label="With textarea" >{{old('informacion_inicial')}}</textarea>

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
					<select class="form-control" required="" name="incidente_id" id="incidente_id">
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
					<select class="form-control" required="" name="tipo_escena">
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
					<select name="station_id" required="" class="form-control">
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
					<textarea class="form-control" required="" id="pdireccion" name="direccion" placeholder="Ubicacion del Evento" aria-label="With textarea"></textarea>
					<input type="button" value="Encode" onclick="codeAddress()">
				</div>
				<div class="form-group input-group input-group-prepend col-md-4">
					<div >
						<span class="input-group-text">Parroquia</span>
					</div>
					<select name="parroquia_id" required="" class="form-control">
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
					<textarea class="form-control" required="" placeholder="Formato:. -2.56985, -79.23658" id="pgeoposicion" name="geoposicion" aria-label="With textarea"></textarea>
				</div>
			</div><!--Div Ubicacion Evento-->
			<div onload="initMap()" id="map" style="width: 100%; height: 280px;"></div>
			<hr >
			<div class="form-row">
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Jefe Guardia</span>
					</div>
					<select class="form-control" required="" name="jefeguardia_id">
						<option selected>{{old('jefeguardia_id')}}</option>
						@foreach($bomberos as $user)
						<option>{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Bombero</span>
					</div>
					<select class="form-control" required="" name="bombero_id">
						<option selected>{{old('bombero_id')}}</option>
						@foreach($bomberos as $user)
						<option>{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Conductor</span>
					</div>
					<select class="form-control" required="" name="conductor_id">
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
					<input type="time" class="form-control" required="" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$now->format('H:i:s'))}}" placeholder="hh:mm:ss">
				</div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Llegada A Emergencia</span>
					</div>
					<input type="time" class="form-control" required="" name="hora_llegada_a_emergencia" id="hora_llegada_a_emergencia" placeholder="hh:mm:ss" value="{{old('hora_llegada_a_emergencia',$now->format('H:i:s'))}}">
				</div>
			</div><!--Div Horas Evento-->
			<div class="form-row">
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Fin Emergencia</span>
					</div>
					<input type="time" class="form-control" required="" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" value="{{old('hora_fin_emergencia',$now->format('H:i:s'))}}">
				</div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora En Base</span>
					</div>
					<input type="time" class="form-control" required="" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" value="{{old('hora_en_base',$now->format('H:i:s'))}}">
				</div>
			</div><!--Div Horas Evento-->

			<div class="form-row">
				<div class="form-group input-group  col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text">Detalle Emergencia</span>
					</div>
					<textarea class="form-control" required="" maxlength="1000" placeholder="Digite a detalle lo ocurrido en Emergencia" id="detalle_emergencia" name="detalle_emergencia" aria-label="With textarea">{{old('detalle_emergencia')}}</textarea>
					
				</div>
			</div><!--Detalle Emergencia-->
			<div class="counter" id="pcounter1">0</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Ciud. Afectado</span>
					</div>
					<input type="text" class="form-control" required="" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado')}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
				</div>
			</div>{{--Usuario Afectado--}}
			<div class="form-row">
				<div class="form-group input-group col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDaños">Daños Estimados</span>
					</div>
					<textarea class="form-control" required="" maxlength="1000" placeholder="Detalle los daños producidos por  el incidente" id="danos_estimados" name="danos_estimados" aria-label="With textarea">{{old('danos_estimados')}}</textarea>
					
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
								<select class="form-control selectpicker"  name="vehiculo_id" id="pvehiculo_id" data-live-search="true">
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
									<input type="number" class="form-control" value="{{old('km_salida')}}"  name="km_salida" id="pkm_salida" placeholder="000000">
								</div>
						</div>
						<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
							<div class="form-group  input-group">
									<div class="input-group-prepend">
									<span class="input-group-text" id="inputDetalle">Km.Llegada</span>
									</div>
									<input type="number" class="form-control" id="pkm_llegada" name="km_llegada" value="{{old('km_llegada')}}" placeholder="000000">
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
		    			<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('transito.index')}}"><i class="icon-remove icon-2x"></i>
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
					$("#bt_add").click(function () {
						// body...
						agregar();
					});
				});

				total=0;
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
					if(jqkm_salida!="" && jqkm_salida>0 && jqkm_llegada!="" && jqkm_llegada>0 && jqvehiculo!="")
					{
						total = total + subtotal[cont];
						var fila = '<tr class = "selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')" type="button">X</button></td><td><input type="hidden" name="vehiculo_id[]" value="'+jqvehiculo+'">'+jqvehiculo+'</td><td><input type="text" readonly="true" name="km_salida[]" value="'+jqkm_salida+'"></td><td><input type="text" readonly="true" name="km_llegada[]" value="'+jqkm_llegada+'"></td></tr>';
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
					$('#pvehiculo_id').val("");
				}
				function evaluar(){
					if(jqkm_llegada>jqkm_salida){
						$("#divguardar").show();
						$("#Enviar").show();
					}
					else{
						$("#divguardar").hide();
					}
				}

				function eliminar(index){
					total = total - subtotal[index];
					$("#fila"+index).remove();
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

		
		<script>
			
			$(document).ready(function(){
				var max_chars = 1000;
				$('#max').html(max_chars);
		    	$("#informacion_inicial").keyup(function() {
		        var chars = $("#informacion_inicial").val().length;
		        var diff = max_chars - chars;
		        var leyenda = "Caracteres Permitidos 1000 Cant:";
		        var res = leyenda.concat(chars);
		        $("#pcounter").html(res);
		        if(chars > 1000){
		           $("#informacion_inicial").addClass('error');
		           $("#informacion_inicial").addClass('error');
		          }else{
		            $("#informacion_inicial").removeClass('error');
		            $("#informacion_inicial").removeClass('error');
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
					$('#fecha_salida').attr('min', maxDate);
					$('#fecha_retorno').attr('min', maxDate);
				});
		</script>

	
		@endpush
	@endsection
	@section( "piepagina" )
	@endsection