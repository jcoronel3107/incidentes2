@extends( "layouts.plantilla" )

@section( "cabeza" )

		<title>Clave - Edición - BCBVC</title>
@endsection

@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Clave_14</h2>
		
		
		<hr style="border:2px;">
		@if(count($errors)>0) 
			@foreach($errors->all() as $error)
				<div class="alert alert-danger" role="alert">
					{{$error}}
				</div>
			@endforeach 
		@endif
		<form method="post" action="/clave/{{$claves->id}}">
			@csrf @method('PATCH')
			<div class="form-row ">
			<div class="input-group mb-3 justify-content-end">
                     <div class="input-group-prepend">
                            	<span class="input-group-text"><i class="fa fa-check" aria-hidden="true"></i></span>
                     </div>
					 <button type="submit" title="Actualizar" name="Enviar" value="Enviar" class="btn btn-success">Actualizar</button>
					 
                     <div class="input-group-prepend ml-2">
                            	<span class="input-group-text"><i class="fa fa-arrow-left"  aria-hidden="true"></i></i></span>
                     </div>
					 <a class="btn btn-outline-secondary"  data-toggle="tooltip" title="Cancelar" role="button" href="{{ route('clave.index')}}">Cancelar</a>
             </div>
		</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Estaciòn Servicio</span>
					</div>
					<select class="form-control" name="gasolinera_id">
						<option value="{{$claves->gasolinera->id}}" selected>{{old('gasolinera_id',$claves->gasolinera->razonsocial)}}</option>
						@foreach($gasolineras as $gasolinera)
						<option value="{{$gasolinera->id}}">{{$gasolinera->razonsocial}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha</span>
					</div>
					<input type="text" maxlength="19" name="created_at" value="{{old('created_at',$claves->created_at)}}" placeholder="Km. Salida Vehìculo de Estaciòn" class="form-control"> {{csrf_field()}}

				</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">{!! trans('messages.Vehicles') !!}</span>
					</div>
					<select class="form-control" name="vehiculo_id">
						<option value="{{$claves->vehiculo->id}}" selected>{{old('vehiculo_id',$claves->vehiculo->codigodis)}}</option>
						@foreach($vehiculos as $vehiculo)
						<option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">

				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Km. Salida del Vehìculo</span>
					</div>
					<input type="text" name="km_salida" value="{{old('km_salida',$claves->km_salida)}}" placeholder="Km. Salida Vehìculo de Estaciòn" class="form-control"> {{csrf_field()}}

				</div>

				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Km. en Gasolinera</span>
					</div>
					<input type="text" name="km_gasolinera" value="{{old('km_gasolinera',$claves->km_gasolinera)}}" class="form-control" placeholder="Km. en Gasolinera">
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="kmllegada">Km. Llegada Vehìculo</span>
					</div>
					<input type="text" name="km_llegada" value="{{old('km_llegada',$claves->km_llegada)}}" class="form-control" id="kmllegada" placeholder="Km. Llegada Vehìculo a Estaciòn">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-4">

				</div>



			</div>
			<div class="form-row">
				<div class="form-group  input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDolares">Dòlares</span>
					</div>
					<input type="number" step=".01" name="dolares" value="{{old('dolares',$claves->dolares)}}" class="form-control" id="dolares" placeholder="Valor $ de Carga combustible">
				</div>
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Galones</span>
					</div>
					<input type="number" step=".01" name="galones" value="{{$claves->galones}}" class="form-control" id="galones" placeholder="Galones de Carga combustible">
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Combustible</span>
					</div>
					<select class="form-control" name="combustible">
						<option value="{{$claves->combustible}}" selected>{{$claves->combustible}}</option>
						<option value="Diesel">Diesel</option>
						<option value="Eco">Eco</option>
						<option value="Super">Super</option>
					</select>
				</div>
			</div>
			<div class="form-row">

				<div class="form-group input-group col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Conductor</span>
					</div>
					<select class="form-control" name="user_id">
						<option value="{{$claves->user->id}}" selected>{{$claves->user->name}}</option>
						@foreach($usuarios as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Orden</span>
					</div>
					<input required type="number" min="0" name="Orden" value="{{old('Orden',$claves->Orden)}}" class="form-control" id="Orden" placeholder="Nro Orden Física">
				</div>
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Nro. Factura</span>
					</div>
					<input required type="text" name="factura" value="{{old('factura',$claves->factura)}}" class="form-control" id="factura" placeholder="Digite Nro. Factura 000-000-000000">
				</div>
			</div>
			

		</form>

		<form method="post" action="/clave/{{$claves->id}}">
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