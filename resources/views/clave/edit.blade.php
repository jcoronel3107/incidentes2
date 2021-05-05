	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Clave - Edición - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Clave_14</h2>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		    <a class="btn btn-outline-info"  data-toggle="tooltip" title="Regresar" role="button" href="{{ route('clave.index')}}"><i class="fa fa-arrow-left fa-2x"  aria-hidden="true"></i>
						</a>
		  </li>
		</ul>
		<hr style="border:2px;">

		<form method="post" action="/clave/{{$claves->id}}">
			@csrf @method('PATCH')
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

				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Orden</span>
					</div>
					<input type="text" name="Orden" class="form-control" id="Orden" value="{{old('Orden',$claves->Orden)}}" placeholder="#Orden Fisica">
				</div>

			</div>

			<div class="form-group">
				<button type="submit" title="Actualizar" name="Enviar" value="Enviar" class="btn btn-success"><i class="fa fa-check-square fa-2x" aria-hidden="true"></i></button>

				<a class="btn btn btn-primary" title="Cancel" role="button"
					href="{{ route('clave.index')}}"><i class="fa fa-ban fa-2x" aria-hidden="true"></i></a>
			</div>

		</form>

		<form method="post" action="/clave/{{$claves->id}}">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="DELETE">

			<button type="button" title="Eliminar" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
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
		@if(count($errors)>0) @foreach($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{$error}}
		</div>
		@endforeach @endif
	@endsection

	@section( "piepagina" )


	@endsection