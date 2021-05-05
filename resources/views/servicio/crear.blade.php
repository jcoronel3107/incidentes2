	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Servicio - Crear - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Service Commission Information Registry') !!}</h2>

		<form method="post" class="needs-validation" id="f1" action="/servicio" novalidate >
			@if(count($errors)>0) @foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">
				{{$error}}
			</div>
			@endforeach @endif
			<div class="form-row">
				{{csrf_field()}}
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha Salida</span>
					</div>
					<input type="datetime-local" id="fecha_salida" name="fecha_salida" class="form-control" required>
					<div class="invalid-feedback">
						Please select a valid Date.
					</div>
				</div>
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha Retorno</span>
					</div>
					<input type="datetime-local" value="" id="fecha_retorno" name="fecha_retorno" class="form-control" required>
					
				</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Unidad Delegante</span>
					</div>
					<select class="form-control selectpicker" id="unidad" name="unidad" data-live-search="true" required>
						<option selected></option>
						<option>Bodega</option>
						<option>Dirección Administrativa Financiera</option>
						<option>Jefatura</option>
						<option>Mantenimiento</option>
						<option>Sala Situacional</option>
						<option>U. Operaciones</option>
						<option>U. Prevención</option>
						<option>U.Talento Humano</option>
					</select>
					<div class="invalid-feedback">
						Please select a value.
					</div>
				</div>
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Delegante</span>
					</div>
					<select class="form-control selectpicker" id="delegante" name="delegante" data-live-search="true" required>
						<option selected></option>
						<option>Ab. Cristian Martinez</option>
						<option>Cptn. S.Heras</option>
						<option>Econ. Johana Parra</option>
						<option>Econ. T.Segarra</option>
						<option>Ing. Carlos Chaca</option>
						<option>Ing. Efrain Gomez</option>
						<option>Sala Situacional</option>
						<option>Tnte.Crnl. P.Lucero</option>
					</select>
					<div class="invalid-feedback">
						Please select a value.
					</div>
				</div>
			</div>
			<div class="form-row">
				
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Km. Salida Vehìculo</span>
					</div>
					<input type="number" step=".01" id="km_salida" name="km_salida" title="km_Salida" placeholder="Km. Salida" class="form-control" required>
					<div class="invalid-feedback">
						Please provide a valid KM.
					</div>
				</div>
				
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="kmllegada">Km. Retorno Vehìculo</span>
					</div>
					<input type="number" step=".01" value="0" name="km_retorno" class="form-control" title="km_Retorno" id="km_retorno" placeholder="Km. Retorno" onblur="compruebaKM()">
					<div class="invalid-feedback">
						Please provide a valid KM.
					</div>
				</div>
			</div>
			<div class="form-row">
			</div>
			<div class="form-row">
				<div class="form-group  input-group col-lg-12 col-md-12 ">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputasunto">Asunto</span>
					</div>
					<textarea maxlength="1000" name="asunto" class="form-control" id="asunto" placeholder="Digite actividades a realizar en comision de servicio" required></textarea> 
				</div>
				<div class="counter" id="pcounter">0</div>
			</div>
			<div class="form-row">

				<div class="form-group input-group col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Conductor</span>
					</div>
					<select class="form-control selectpicker" data-live-search="true" name="user_id" required>
						<option selected></option>
						@foreach($users as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Vehiculo</span>
					</div>
					<select class="form-control selectpicker" data-live-search="true" id="vehiculo_id" name="vehiculo_id" required>
						<option selected></option>
						@foreach($vehiculos as $vehiculo)
						<option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row nav justify-content-end">
			<li class="nav-item">
				<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span title="Grabar" class="input-group-text"><i class="fas fa-check"></i></span>
							</div>
							<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">{!! trans('messages.to register') !!}</button>
							<div class="input-group-prepend">
								<span title="Regresar" class="input-group-text"><i class="fas fa-arrow-left"></i></span>
							</div>
							<a class="btn btn btn-outline-secondary" role="button" href="{{ route('servicio.index')}}">Regresar</a>
				 </div>
			</li></div>
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
						var maxDate = year + '-' + month + '-' + day+'T00:00';
						$('#fecha_salida').attr('min', maxDate);
						$('#fecha_retorno').attr('min', maxDate);
					});

					function compruebaKM(){
						kmsalida = $('#km_salida').val();
						console.log(kmsalida);
						kmretorno = $('#km_retorno').val();
						if(kmretorno<=kmsalida){
							alert("KM_Retorno tiene que ser > a KM_Salida");
							//selecciono el texto 
							$( "#km_salida" ).select(); 
							//coloco otra vez el foco 
							$( "#km_salida" ).focus();
							$( "#km_retorno" ).addClass('has-error');
						}
						else
						{
							$( "#km_retorno" ).removeClass('has-error');
						}
					}
			</script>
			<script>
				// Example starter JavaScript for disabling form submissions if there are invalid fields
				(function() {
				'use strict';
				window.addEventListener('load', function() {
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					var forms = document.getElementsByClassName('needs-validation');
					// Loop over them and prevent submission
					var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
					});
				}, false);
				})();
			</script>
		@endpush

@endsection @section( "piepagina" ) @endsection