@extends( "layouts.plantilla" )

@section( "cabeza" )

		<title>Clave - Edición - BCBVC</title>
@endsection

@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Solicitud_Clave_14</h2>
		
		
		<hr style="border:2px;">
		@if(count($errors)>0) 
			@foreach($errors->all() as $error)
				<div class="alert alert-danger" role="alert">
					{{$error}}
				</div>
			@endforeach 
		@endif
	
		<form method="post" action="/solicitud/{{$solicituds->id}}">
			@csrf @method('PATCH')
			<div class="form-row ">
				<div class="input-group mb-3 justify-content-end">
						 <div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-check"></i></span>
						 </div>
						 <button type="submit" name="Enviar" value="Enviar" class="btn btn-outline-primary">Actualizar</button>   
						 <div class="input-group-prepend ml-2">
							<span class="input-group-text"><i class="fas fa-arrow-left"></i></span>
						 </div>
						 <a class="btn btn-outline-secondary" title="Regresar" role="button" href="{{ route('solicitud.index')}}">Regresar</a>   
				 </div>
			</div>
			
			
			<div class="form-row">
				{{csrf_field()}}
				<div class="form-group input-group  col-md-10">
					<div class="input-group-prepend">
						<span class="input-group-text">Estaciòn Servicio</span>
					</div>
					<input name="status" value="Solicitado" hidden/>
					<select required class="form-control" id="gasolinera_id" name="gasolinera_id" data-live-search="true">
						<option selected value="{{$solicituds->gasolinera_id}}">{{$solicituds->gasolinera->razonsocial}}</option>
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
					<select required class="form-control" name="vehiculo_id" data-live-search="true">
						<option selected value="{{$solicituds->vehiculo_id}}">{{$solicituds->vehiculo->codigodis}}</option>
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
						<option value="{{$solicituds->combustible}}" selected>{{$solicituds->combustible}}</option>
						<option value="Diesel">Diesel</option>
						<option value="Eco">Eco</option>
						<option value="Super">Super</option>
					</select>
				</div>
			</div>	
		</form>




		<form method="post" action="/solicitud/{{$solicituds->id}}">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="DELETE">
			<div class="form-group input-group  col justify-content-end">
				<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-trash" aria-hidden="true"></i></span>
				</div>
				<button type="button" title="Eliminar" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar</button>
			</div>
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
			        <button  type="submit" name="Eliminar" value="Eliminar" class="btn btn-danger">Ok</button>
			      </div>
			    </div>
			  </div>
			</div>
		</form>
		
@endsection

@section( "piepagina" )

@endsection