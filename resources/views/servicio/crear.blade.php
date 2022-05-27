	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Servicio</title>
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
						<option>Psic. Santiago Zamora</option>
						<option>Cptn. S.Heras</option>
						<option>Econ. Johana Parra</option>
						<option>Ing. Carlos Chaca</option>
						<option>Ing. Efrain Gomez</option>
						<option>Sala Situacional</option>
						<option>Supervisor Operativo</option>
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
			<!-- Funciones for all pages-->
			<script src="/js/funciones_servicio.js"></script>
		@endpush

@endsection @section( "piepagina" ) @endsection