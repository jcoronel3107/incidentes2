	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Movilización - Crear - BCBVC</title>
	<style>
		.error{ 
			color: red;
			border-color: red;
			
			font-size: 1em;
		}
	</style>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Mobilization Information Registry') !!}</h2>
		@if(count($errors)>0)
				@foreach($errors->all() as $error)
						<div class="alert alert-danger" role="alert">
								{{$error}}
						</div>
				@endforeach 
		@endif
		
		<form method="post" class="needs-validation" id="f1" action="{{ route('prevencion.store')}}"  novalidate >
		@csrf
			<input type="hidden" name="usr_creador" id="usr_creador" value="{{auth()->user()->name}}"/>
			
			<!-- Fecha del movimiento -->
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
					<div class="invalid-feedback">
						Please select a valid Date.
					</div>
				</div>
			</div> <!--Fin  Fecha del movimiento -->
			
			
			<!-- actividades a desarrollar -->
			<div id="actividades" class="form-row">
				<div class="form-group input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input type="checkbox" name="actividad[]" id="chkcomision" value="comision" aria-label="Checkbox for following text input">
							</div>
						</div>
							<input type="text" name="detalle[]" id="textcomision" class="form-control" aria-label="Text input with checkbox" readonly>
							<div class="input-group-append">
									<span class="input-group-text">Comisión</span>
							</div>
					</div>
				</div>
				<div class="form-group input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input type="checkbox" name="actividad[]" id="chkdenuncia" value="denuncia" aria-label="Checkbox for following text input">
							</div>
						</div>
						<input type="text" name="detalle[]" id="textdenuncia" class="form-control" aria-label="Text input with checkbox" readonly>
						<div class="input-group-append">
							<span class="input-group-text">Denuncias</span>
						</div>
					</div>
					
				</div>
				<div class="form-group input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input type="checkbox" name="actividad[]" id="chkgas" value="gas" aria-label="Checkbox for following text input">
							</div>
						</div>
						<input type="text" name="detalle[]" id="textgas" class="form-control" aria-label="Text input with checkbox" readonly>
						<div class="input-group-append">
							<span class="input-group-text">Gases combustibles</span>
						</div>
					</div>
					
				</div>
				<div class="form-group input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input type="checkbox" name="actividad[]" id="chkhabitabilidad" value="habitabilidad" aria-label="Checkbox for following text input">
							</div>
						</div>
						<input type="text" name="detalle[]" id="texthabitabilidad" class="form-control" aria-label="Text input with checkbox" readonly>
						<div class="input-group-append">
							<span class="input-group-text">Habitabilidad</span>
						</div>
					</div>
					
				 </div>
				<div class="form-group input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input type="checkbox" value="investigación" name="actividad[]" id="chkinvestigacion" aria-label="Checkbox for following text input">
							</div>
						</div>
						<input type="text" name="detalle[]" id="textinvestigacion" class="form-control" aria-label="Text input with checkbox" readonly>
						<div class="input-group-append">
							<span class="input-group-text">Investigación de Incendios</span>
						</div>
					</div>
					
				</div>
				<div class="form-group input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input type="checkbox" name="actividad[]" id="chklocales" value="locales" aria-label="Checkbox for following text input">
							</div>
						</div>
						<input type="text" name="detalle[]" id="textlocales" class="form-control" aria-label="Text input with checkbox" readonly>
						<div class="input-group-append">
							<span class="input-group-text">Locales</span>
						</div>
					</div>
					
				</div>
				<div class="form-group input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input type="checkbox" name="actividad[]" id="chkotros" value="otros" aria-label="Checkbox for following text input">
							</div>
						</div>
						<input type="text" name="detalle[]" id="textotros" class="form-control" aria-label="Text input with checkbox" readonly>
						<div class="input-group-append">
							<span class="input-group-text">Otros</span>
						</div>
					</div>
					
				</div>
			</div><!-- Fin actividades a desarrollar -->
			
			
			<!-- Kilometraje -->
			<div class="form-row">
				<div class="form-group input-group  col-md-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Km. Salida Vehìculo</span>
					</div>
					<input type="number" step=".01" id="km_salida" name="km_salida" title="km_salida" placeholder="Km. Salida" class="form-control" required>
					<div class="invalid-feedback">
						Please provide a valid KM.
					</div>
				</div>
				
				<div class="form-group input-group col-md-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Km. Retorno Vehìculo</span>
					</div>
					<input type="number" step=".01" name="km_retorno" class="form-control" title="km_retorno" id="km_retorno" placeholder="Km. Retorno" onblur="compruebaKM()" required>
					<div class="invalid-feedback">
						Please provide a valid KM.
					</div>
				</div>
			</div><!-- Fin Kilimetraje -->
			
			<div class="form-row">
			</div>

			<div class="form-row">
				<div class="form-group  input-group col-lg-12 col-md-12 ">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputasunto">Observaciones</span>
					</div>
					<textarea maxlength="1000"  name="observaciones" class="form-control" id="observaciones" placeholder="Digite observaciones sucitadas durante la movilizacion"></textarea> 
				</div>
				<div class="counter" id="pcounter"></div>
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
							<button type="submit" name="Enviar" value="Enviar"  class="btn btn-success">{!! trans('messages.to register') !!}</button>
							<div class="input-group-prepend">
								<span title="Regresar" class="input-group-text"><i class="fas fa-arrow-left"></i></span>
							</div>
							<a class="btn btn btn-outline-secondary" role="button" href="{{ route('prevencion.index')}}">Regresar</a>
				 </div>
			</li></div>
			<div id="consolaerror" class="consola"> </div>
		</form>
		@push ('scripts')
			<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
			<script>
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
			<script src="/js/movilizacion.js"></script>	
		@endpush

@endsection
@section( "piepagina" ) 
@endsection