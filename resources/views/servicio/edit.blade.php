	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Servicio - Edición - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Edit Service Commission Information') !!}</h2>

		<form method="post" action="/servicio/{{$servicio->id}}">
			@csrf @method('PATCH')
			
			<div class="form-row">
				{{csrf_field()}}
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha Salida</span>
					</div>
					<input type="input" id="fecha_salida" name="fecha_salida" class="form-control" value="{{old('fecha_salida',$servicio->fecha_salida)}}">
				</div>
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha Retorno</span>
					</div>
					<input type="input" id="fecha_retorno" name="fecha_retorno" class="form-control" value="{{old('fecha_retorno',$servicio->fecha_retorno)}}">
				</div>



			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Unidad Delegante</span>
					</div>
					<select class="form-control selectpicker" id="unidad" name="unidad" data-live-search="true">
						<option selected>{{old('unidad',$servicio->unidad)}}</option>
						<option>Jefatura</option>
						<option>U. Operaciones</option>
						<option>U.Talento Humano</option>
						<option>Dirección Administrativa Financiera</option>
						<option>Mantenimiento</option>
						<option>Bodega</option>
						<option>Sala Situacional</option>
						
					</select>
				</div>
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Delegante</span>
					</div>
					<select class="form-control selectpicker" id="delegante" name="delegante" data-live-search="true">
						<option selected>{{old('delegante',$servicio->delegante)}}</option>
						
						<option>Tnte.Crnl. P.Lucero</option>
						<option>Cptn. S.Heras</option>
						<option>Econ. R.Castro</option>
						<option>Econ. T.Segarra</option>
						<option>Ing. Efrain Gomez</option>
						<option>Econ. Johana Parra</option>
						<option>Sala Situacional</option>
						
					</select>
				</div>
			</div>
			<div class="form-row">
				
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Km. Salida del Vehìculo</span>
					</div>
					<input type="number" step=".01" required="" id="km_salida" name="km_salida" placeholder="Km. Salida" class="form-control" value="{{old('km_salida',$servicio->km_salida)}}">
				</div>
				
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="kmllegada">Km. Retorno Vehìculo</span>
					</div>
					<input type="number" step=".01" required="" name="km_retorno" class="form-control" id="km_retorno" placeholder="Km. Retorno" value="{{old('km_retorno',$servicio->km_retorno)}}">
				</div>
			</div>
			<div class="form-row">




			</div>
			<div class="form-row">
				<div class="form-group  input-group col-lg-12 col-md-12 ">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDolares">Asunto</span>
					</div>
					<textarea required="" maxlength="1000" name="asunto" class="form-control" id="asunto" placeholder="Digite actividades a realizar en comision de servicio">{{old('asunto',$servicio->asunto)}}</textarea> 
				</div>
				<div class="counter" id="pcounter">0</div>
			</div>
			<div class="form-row">

				<div class="form-group input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Conductor</span>
					</div>
					<select class="form-control" id="user_id" name="user_id">
						<option value="{{$servicio->user->id}}" selected>{{$servicio->user->name}}</option>
						@foreach($maquinistas as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Vehiculo</span>
					</div>
					<select class="form-control" id="vehiculo_id" name="vehiculo_id">
						<option value="{{$servicio->vehiculo->id}}" selected>{{$servicio->vehiculo->codigodis}}</option>
						@foreach($vehiculos as $vehiculo)
							<option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
				<a class="btn btn btn-primary" role="button"
					href="{{ route('servicio.index')}}">Cancelar
				</a>
				
			</div>
		</form>

		@if(count($errors)>0) @foreach($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{$error}}
		</div>
		@endforeach @endif
		



			
		</form>

		<form method="post" action="/servicio/{{$servicio->id}}">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="DELETE">

			<button type="button" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar Registro</button>
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
		
		@push ('scripts')
			<script>	
				$(document).ready(function(){
					var max_chars = 1000;
					$('#max').html(max_chars);
			    	$("#asunto").keyup(function() {
			        var chars = $("#asunto").val().length;
			        var diff = max_chars - chars;
			        var leyenda = "Caracteres Permitidos 1000 Cant:";
			        var res = leyenda.concat(chars);
			        $("#pcounter").html(res);
			        if(chars > 1000){
			           $("#asunto").addClass('error');
			           $("#asunto").addClass('error');
			          }else{
			            $("#asunto").removeClass('error');
			            $("#asunto").removeClass('error');
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