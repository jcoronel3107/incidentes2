@extends( "layouts.plantilla" )

@section( "cabeza" )

	<title>Solicitud Clave 14</title>
@endsection

@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Solicitud de Clave_14</h2>
	
	<form method="post" action="/solicitud">
		<div class="form-row ">
			<div class="input-group mb-3 justify-content-end">
                     <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                     </div>
					 <button type="submit" name="Enviar" value="Enviar" class="btn btn-outline-primary">{!! trans('messages.to register') !!}</button>   
                     <div class="input-group-prepend ml-2">
                        <span class="input-group-text"><i class="fas fa-arrow-left"></i></span>
                     </div>
					 <a class="btn btn-outline-secondary" title="Regresar" role="button" href="{{ route('solicitud.index')}}">Cancelar</a>   
             </div>
		</div>
		@if(count($errors)>0) 
			@foreach($errors->all() as $error)
				<div class="alert alert-danger" role="alert">
					{{$error}}
				</div>
			@endforeach 
		@endif
		
		<div class="form-row">
			{{csrf_field()}}
			<div class="form-group input-group  col-md-10">
				<div class="input-group-prepend">
					<span class="input-group-text">Estaciòn Servicio</span>
				</div>
				<input name="status" value="Solicitado" hidden/>
				<select required class="form-control selectpicker" id="gasolinera_id" name="gasolinera_id" data-live-search="true">
					<option value="">Seleccione...</option>
					@foreach($gasolineras as $gasolinera)
					<option value="{{$gasolinera->id}}">{{$gasolinera->razonsocial}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-10" id="response" name="response"></div>
		</div>
		<div class="form-row">
			<div class="form-group input-group  col-md-8">
				<div class="input-group-prepend">
					<span class="input-group-text">{!! trans('messages.Vehicles') !!}</span>
				</div>
				<select required class="form-control selectpicker" name="vehiculo_id" data-live-search="true">
					<option value="">Seleccione...</option>
					@foreach($vehiculos as $vehiculo)
					<option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="form-row">
		</div>
		<div class="form-row">	
			<div class="form-group input-group col-md-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Combustible</span>
				</div>
				<select required class="form-control" name="combustible">
					<option value="" selected>Choose...</option>
					<option value="Diesel">Diesel</option>
					<option value="Eco">Eco</option>
					<option value="Super">Super</option>
				</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group input-group col-md-8 col-sm-12">
				<div class="input-group-prepend">
					<span class="input-group-text">Conductor</span>
				</div>
				<select required class="form-control" name="user_id">
					
					<option selected value="{{$user_id}}">{{$user_name}}</option>
					
				</select>
			</div>
			
		</div>
		
	</form>
	@push ('scripts')
		<script src="/js/clave.js"></script>
	@endpush
@endsection 
@section( "piepagina" )
@endsection