	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Clave_14</h2>

		<form method="post" action="/clave">

			<div class="form-row">
				{{csrf_field()}}
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Estaciòn Servicio</span>
					</div>
					<select class="form-control selectpicker" name="gasolinera_id" data-live-search="true">
						<option selected>Elija...</option>
						@foreach($gasolineras as $gasolinera)
						<option>{{$gasolinera->razonsocial}}</option>
						@endforeach
					</select>
				</div>


			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Vehìculo</span>
					</div>
					<select class="form-control selectpicker" name="vehiculo_id" data-live-search="true">
						<option selected>Elija...</option>
						@foreach($vehiculos as $vehiculo)
						<option>{{$vehiculo->codigodis}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Km. Salida del Vehìculo</span>
					</div>
					<input type="number" name="km_salida" placeholder="Km. Salida" class="form-control">
				</div>
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Km. en Gasolinera</span>
					</div>
					<input type="number" required name="km_gasolinera" class="form-control" placeholder="Km. en Gasolinera">
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="kmllegada">Km. Llegada Vehìculo</span>
					</div>
					<input type="number" required name="km_llegada" class="form-control" id="kmllegada" placeholder="Km. Retorno">
				</div>
			</div>
			<div class="form-row">




			</div>
			<div class="form-row">
				<div class="form-group  input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDolares">Dòlares</span>
					</div>
					<input type="number" required name="dolares" class="form-control" id="dolares" placeholder="Valor $ de Carga combustible">
				</div>
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Galones</span>
					</div>
					<input type="number" name="galones" class="form-control" id="galones" placeholder="Galones de Carga combustible">
				</div>
				<div class="form-group input-group col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Combustible</span>
					</div>
					<select class="form-control" name="combustible">
						<option selected>Choose...</option>
						<option>Diesel</option>
						<option>Eco</option>
						<option>Super</option>
					</select>
				</div>
			</div>
			<div class="form-row">

				<div class="form-group input-group col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Conductor</span>
					</div>
					<select class="form-control" name="user_id">
						<option selected>Choose...</option>
						@foreach($users as $user)
						<option>{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Orden</span>
					</div>
					<input type="number" min="0" name="Orden" class="form-control" id="Orden" placeholder="#Orden Fisica">
				</div>

			</div>

			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
				<a class="btn btn btn-primary" role="button"
					href="{{ route('clave.index')}}">Cancelar
				</a>
				<button type="reset" name="Borrar" value="Borrar" class="btn btn-danger">Borrar Formulario</button>
			</div>
		</form>

		@if(count($errors)>0) @foreach($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{$error}}
		</div>
		@endforeach @endif


@endsection @section( "piepagina" ) @endsection