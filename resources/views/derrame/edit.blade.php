	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Eventos Derrame</h2>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('derrame.index')}}"><i class="icon-remove icon-2x"></i>
						</a>
		  </li>
		</ul>
		<hr style="border:2px;">
		<form method="post" action="/derrame/{{$derrame->id}}">
			@csrf @method('PATCH')
			<div class="form-row">
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha</span>
					</div>
					<input type="text" name="fecha" class="form-control" placeholder="AA-MM-DD" value="{{old('fecha',$derrame->fecha)}}">
				</div>
			</div><!--Div Fecha-->
			<div class="form-row ">
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Hora Ficha ECU911</span>
							</div>
							<input type="text" name="hora_fichaecu911"  class="form-control" placeholder="hh:mm:ss" value="{{old('hora_fichaecu911',$derrame->hora_fichaecu911)}}">
						</div>
					</div>
				</div>
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Nro.Ficha ECU911</span>
							</div>
							<input type="text" onkeyup="mayus(this);" name="ficha_ecu911" value="{{old('ficha_ecu911',$derrame->ficha_ecu911)}}" class="form-control">
						</div>
					</div>
				</div>
				<div class='col-md-4'>
					<div class="form-group">
						<div class="input-group date" id="datetimepicker3">
							<div class="input-group-prepend">
								<span class="input-group-text">Información Inicial</span>
							</div>
							<textarea class="form-control" name="informacion_inicial"  aria-label="With textarea" >{{old('informacion_inicial',$derrame->informacion_inicial)}}</textarea>
						</div>
					</div>
				</div>
			</div><!--Div Informacion ECU911-->
			<div class="form-row">
				<div class="form-group input-group col-md-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Incidente</span>
					</div>
					<select class="form-control" name="incidente_id" id="incidente_id">
						<option selected>{{old('incidente_id',$derrame->incidente->nombre_incidente)}}</option>
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
						<option selected>{{old('tipo_escena',$derrame->tipo_escena)}}</option>
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
						<option selected>{{old('estacion_id',$derrame->station->nombre)}}</option>
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
					<textarea class="form-control" name="address" placeholder="Ubicacion del Evento" aria-label="With textarea">{{old('direccion',$derrame->address)}}</textarea>
				</div>
				<div class="form-group input-group input-group-prepend col-md-4">
					<div >
						<span class="input-group-text">Parroquia</span>
					</div>
					<select name="parroquia_id" class="form-control">
						<option selected>{{old('parroquia_id',$derrame->parroquia->nombre)}}</option>
						@foreach($parroquias as $parroquia)
							<option>{{$parroquia->nombre}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputAddress">Geoposicion</span>
					</div>
					<textarea class="form-control" name="geoposicion" aria-label="With textarea">{{old('geoposicion',$derrame->geoposicion)}}</textarea>
				</div>
			</div><!--Div Ubicacion Evento-->
			<div class="form-row">
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Jefe Guardia</span>
					</div>
					<select class="form-control" name="jefeguardia_id">
						<option selected></option>
						@foreach($bomberos as $bombero)
						<option>{{$bombero->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Bombero</span>
					</div>
					<select class="form-control" name="bombero_id">
						<option selected>{{old('bombero_id')}}</option>
						@foreach($bomberos as $bombero)
						<option>{{$bombero->name}}</option>
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
				<div class="form-group  input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora Salida A Emergencia</span>
					</div>
					<input type="text" class="form-control" name="hora_salida_a_emergencia" id="hora_salida_a_emergencia" value="{{old('hora_salida_a_emergencia',$derrame->hora_salida_a_emergencia)}}" placeholder="hh:mm:ss">
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
					<input type="text" class="form-control" name="hora_fin_emergencia" id="hora_fin_emergencia" placeholder="hh:mm:ss" value="{{old('hora_fin_emergencia',$derrame->hora_fin_emergencia)}}"></div>
				<div class="form-group  input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Hora En Base</span>
					</div>
					<input type="text" class="form-control" name="hora_en_base" id="hora_en_base" placeholder="hh:mm:ss" value="{{old('hora_en_base',$derrame->hora_en_base)}}">
					</div>
			</div>{{--Div Horas Evento--}}
			<div class="form-row">
				<div class="col-lg-8 col-md-8 col-sm-12">
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Detalle Emergencia</span>
						</div>
						<textarea class="form-control"name="detalle_emergencia" id="detalle_emergencia"  aria-label="With textarea" placeholder="Digite a detalle lo ocurrido en Emergencia">{{old('detalle_emergencia',$derrame->detalle_emergencia)}}</textarea>
					</div>
				</div>
			</div>{{--Detalle Emergencia--}}
			<div class="form-row">
				<div class="col-8">
					<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Ciud. Afectado</span>
					</div>
					<input type="text" class="form-control" name="usuario_afectado" id="usuario_afectado" value="{{old('usuario_afectado',$derrame->usuario_afectado)}}" placeholder="Digite Nombre Completo ciudadano afectado en la Emergencia">
				</div>
				</div>
			</div>{{--Usuario Afectado --}}
			<div class="form-row">
				<div class="form-group input-group col-lg-8 col-md-8 col-sm-12">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDaños">Daños Estimados</span>
					</div>
					<input type="text" class="form-control" name="danos_estimados" id="danos_estimados" value="{{old('danos_estimados',$derrame->danos_estimados)}}" placeholder="Detalle los daños producidos por  el incidente">
				</div>
			</div>{{-- Daños Estimados --}}
			<div class="form-group py-3 " id="divguardar">
				<input type="hidden" name="token" value="{{csrf_token()}}" >
				<ul class="nav justify-content-end">
		  			<li class="nav-item">
						<button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Grabar"  class="btn btn-outline-success"><i class="icon-ok icon-2x"></i></button>
				<a class="btn btn-outline-info" data-toggle="tooltip" title="Cancel" role="button" href="{{ route('derrame.index')}}"><i class="icon-remove icon-2x"></i>
						</a>
		  			</li>
				</ul>
			</div>{{-- Botones --}}

		</form>
		<form method="post" action="/derrame/{{$derrame->id}}">
				{{csrf_field()}}
				<input type="hidden" name="_method" value="DELETE">

				<button type="button" data-toggle="tooltip" title="Eliminar" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal"><i class="icon-remove icon-2x"></i></button>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
				        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <p>El registro seleccionado será eliminado. Esta Seguro?...</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button  type="submit" name="Eliminar" value="Eliminar" class="btn btn-primary">Ok</button>
				      </div>
				    </div>
				  </div>
				</div>
		</form>
		@if(count($errors)>0)
		 	@foreach($errors->all() as $error)
		 		<div class="alert alert-danger" role="alert">
		 			{{$error}}
		 		</div>
			@endforeach @endif

	@endsection

	@section( "piepagina" )


	@endsection