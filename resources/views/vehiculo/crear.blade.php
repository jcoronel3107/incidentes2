	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Registro Información de Vehículos</h2>
		<form method="post" action="/vehiculo">

			<div class="accordion" id="accordionExample">

				<div class="card">
					<div class="card-header" id="headingOne">
						<h2 class="mb-0">
         		        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Generales</button>
         		        </h2>

					</div>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
							<div class="form-row">

								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Codigo_Institucional</span>
									</div>
									<input type="text" class="form-control" onkeyup="mayus(this);" name="codigodis" id="codigodis" value="{{old('codigodis')}}" placeholder="">
								</div>
								<div class='col-md-4'>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Placa</span>
											</div>
											<input type="text" name="placa" onkeyup="mayus(this);" class="form-control" placeholder="" value="{{old('placa')}}">
										</div>
									</div>
								</div>
								<div class="form-group input-group  col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Tipo</span>
									</div>
									<input type="text" name="tipo" onkeyup="mayus(this);" class="form-control" placeholder="" value="{{old('tipo')}}">
								</div>
							</div>
							<!--Div Generales-->

							<div class="form-row ">

								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Marca</span>
									</div>
									<select class="form-control" name="marca">
										<option selected>{{old('marca')}}</option>
										<option>CHEVROLET</option>
										<option>HAHN</option>
										<option>E-ONE</option>
										<option>FORD</option>
										<option>HYUNDAI</option>
										<option>HINO</option>
										<option>INTERNATIONAL</option>
										<option>MAZDA</option>
										<option>MERCEDES BENZ</option>
										<option>MITSUBISHI</option>
										<option>NISSAN</option>
										<option>PIERCE</option>
										<option>ROSENBAUER</option>

									</select>
								</div>
								<div class='col-md-4'>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Modelo</span>
											</div>
											<input type="text" onkeyup="mayus(this);" name="modelo" class="form-control" value="{{old('modelo')}}">
										</div>
									</div>
								</div>
								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Clase</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="clase" placeholder="" value="{{old('clase')}}">
								</div>

							</div>
							<!--Div Generales-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Pais_Origen</span>
									</div>
									<input type="text" class="form-control" onkeyup="mayus(this);" name="pais_orig" id="pais_orig" placeholder="" value="{{old('pais_orig')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Año_Fabricacion</span>
									</div>
									<input type="text" class="form-control" onkeyup="mayus(this);" name="anio_fab" id="anio_fab" placeholder="" value="{{old('anio_fab')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Carroceria</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="carroceria" id="carroceria" placeholder="" value="{{old('carroceria')}}">
								</div>

							</div>
							<!--Div Generales-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Color1</span>
									</div>
									<input type="text" class="form-control" name="color1" id="color1" placeholder="" value="{{old('color1')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Color2</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="color2" id="color2" placeholder="" value="{{old('color2')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Tonelaje</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="tonelaje" id="tonelaje" placeholder="" value="{{old('tonelaje')}}">
								</div>
							</div>
							<!--Div Generales-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Cilindraje</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="cilindraje" id="cilindraje" placeholder="" value="{{old('cilindraje')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Motor</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="motor" id="motor" placeholder="" value="{{old('motor')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Chasis</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="chasis" id="chasis" placeholder="" value="{{old('chasis')}}">
								</div>
							</div>
							<!--Div Generales-->

						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
         		        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Contables</button>
         		        </h2>

					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						<div class="card-body">
							<div class="form-row">
								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Estacion</span>
									</div>
									<select class="form-control" name="station_id">
										<option selected>{{old('estacion')}}</option>
										<option value="1">Estación1</option>
										<option value="2">Estación2</option>
										<option value="3">Estación3</option>
										<option value="4">Estación4</option>
										<option value="5">Estación5</option>
										<option value="6">Estación6</option>
										<option value="7">Estación7</option>
										<option value="8">Estación8</option>
										<option value="9">Estación9</option>
										<option value="10">Estación10</option>
									</select>
								</div>
							</div>
							<!--Div Contables-->

							<div class="form-row">
								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Responsable</span>
									</div>
									<select class="form-control" name="responsab">
										<option selected>Elija...</option>
										<option>0</option>
									</select>
								</div>
								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Estado</span>
									</div>
									<select class="form-control" name="estado">
										<option selected>{{old('estado')}}</option>
										<option>Bueno</option>
										<option>Regular</option>
										<option>Malo</option>
									</select>
								</div>
								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Activo</span>
									</div>
									<select class="form-control" name="activo">
										<option selected>{{old('activo')}}</option>
										<option>0</option>
										<option>1</option>
									</select>
								</div>


							</div>
							<!--Div Contables-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Codigo_Inventario</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="codigoinv" id="codigoinv" placeholder="" value="{{old('codigoinv')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Fecha_Compra</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="fechacomp" id="fechacomp" placeholder="DD-MM-AA" value="{{old('fechacomp')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Factura_Compra</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="facturacomp" id="facturacomp" placeholder=""  value="{{old('facturacomp')}}">
								</div>
							</div>
							<!--Div Contables-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Valor_Compra</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="valorcomp" id="valorcomp" placeholder="" value="{{old('valorcomp')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Fecha_Baja</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="fechabaja" id="fechabaja" placeholder="DD-MM-AA" value="{{old('fechabaja')}}">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Concepto_Baja</span>
									</div>
									<multitext type="text" onkeyup="mayus(this);" class="form-control" name="concepbaja" id="concepbaja" placeholder="" value="{{old('concepbaja')}}">
								</div>
							</div>
							<!--Div Contables-->

							<div class="form-row">
								<div class="form-group  input-group col-md-12">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Observaciones</span>
									</div>
									<input type="text" class="form-control" name="observacion" id="observacion" placeholder="" value="{{old('observacion')}}">
								</div>

							</div>
							<!--Div Contables-->
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header" id="headingThree">
						<h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Varios
        </button>
      </h2>


					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						<div class="card-body">
							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">KM_Mantenimiento_Rutina</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" name="kmmantrut" id="kmmantrut" placeholder="ej. 5000" value="{{old('kmmantrut')}}">
								</div>

								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Combustible</span>
									</div>
									<select class="form-control" name="combustible">
										<option selected> {{old('combustible')}}</option>
										<option>Eco</option>
										<option>Diesel</option>
										<option>Super</option>

									</select>
								</div>
							</div>
							<!--Div Generales-->
						</div>
					</div>
				</div>
			</div>

			<div>
				<br>{{csrf_field()}}
			</div>
			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
				<button type="reset" name="Borrar" value="Borrar" class="btn btn-danger">Borrar Formulario</button>
			</div>

		</form>

	@if(count($errors)>0)
		@foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">
			{{$error}}
			</div>
		@endforeach
	@endif

@endsection
@section( "piepagina" )
@endsection