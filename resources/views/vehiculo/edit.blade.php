	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Edición Información de Vehículos</h2>
		
		<form method="post" action="/vehiculo/{{$vehiculo->id}}">
		<div class="input-group mb-3 justify-content-end">
				     <div class="input-group-prepend">
                            	<span class="input-group-text"><i class="fas fa-check"></i></span>
                      </div>
					 <button type="submit" name="Enviar" value="Enviar" class="btn btn-outline-primary">Editar</button>   
                     <div class="input-group-prepend ml-2">
                            	<span title="Regresar" class="input-group-text"><i class="fas fa-arrow-left"></i></span>
                     </div>
					 <a class="btn btn-outline-secondary"  role="button" href="{{ route('vehiculo.index')}}">Cancelar</a>   
		</div>
		<input type="hidden" name="_method" value="PUT">
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
									<input type="text" class="form-control" value="{{$vehiculo->codigodis}}" onkeyup="mayus(this);" name="codigodis" id="codigodis" placeholder="">
								</div>{{csrf_field()}}
								<div class='col-md-4'>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Placa</span>
											</div>
											<input type="text" name="placa" value="{{$vehiculo->placa}}" onkeyup="mayus(this);" class="form-control" placeholder="">
										</div>
									</div>
								</div>
								<div class="form-group input-group  col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Tipo</span>
									</div>
									<input type="text" name="tipo" value="{{$vehiculo->tipo}}" onkeyup="mayus(this);" class="form-control" placeholder="">
								</div>
							</div>
							<!--Div Generales-->

							<div class="form-row ">

								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Marca</span>
									</div>
									<select class="form-control">
										<option selected>{{$vehiculo->marca}}</option>
										<option>CHEVROLET</option>
										<option>HAHN</option>
										<option>HYUNDAI</option>
										<option>HINO</option>
										<option>INTERNATIONAL</option>
										<option>MAZDA</option>
										<option>MERCEDES BENZ</option>
										<option>MITSUBISHI</option>
										<option>NISSAN</option>
										<option>PIERCE</option>
										<option>ROSENBAUER</option>
										<option>RENAULT</option>
									</select>
								</div>
								<div class='col-md-4'>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Modelo</span>
											</div>
											<input type="text" value="{{$vehiculo->modelo}}" onkeyup="mayus(this);" name="modelo" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Clase</span>
									</div>
									<input type="text" value="{{$vehiculo->clase}}" onkeyup="mayus(this);" class="form-control" name="clase" placeholder="">
								</div>

							</div>
							<!--Div Generales-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Pais_Origen</span>
									</div>
									<input type="text" value="{{$vehiculo->pais_orig}}" class="form-control" onkeyup="mayus(this);" name="pais_orig" id="pais_orig" placeholder="">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Año_Fabricacion</span>
									</div>
									<input type="text" class="form-control" value="{{$vehiculo->anio_fab}}" onkeyup="mayus(this);" name="anio_fab" id="anio_fab" placeholder="">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Carroceria</span>
									</div>
									<input type="text" value="{{$vehiculo->carroceria}}" onkeyup="mayus(this);" class="form-control" name="carroceria" id="anio_fab" placeholder="">
								</div>

							</div>
							<!--Div Generales-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Color1</span>
									</div>
									<input type="text" value="{{$vehiculo->color1}}" class="form-control" name="color1" id="color1" placeholder="">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Color2</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->color2}}" class="form-control" name="color2" id="color2" placeholder="">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Tonelaje</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->tonelaje}}" class="form-control" name="tonelaje" id="tonelaje" placeholder="">
								</div>
							</div>
							<!--Div Generales-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Cilindraje</span>
									</div>
									<input type="text" onkeyup="mayus(this);" class="form-control" value="{{$vehiculo->cilindraje}}" name="cilindraje" id="cilindraje" placeholder="">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Motor</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->motor}}" class="form-control" name="motor" id="motor" placeholder="">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Chasis</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->chasis}}" class="form-control" name="chasis" id="chasis" placeholder="">
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
										<span class="input-group-text">Responsable</span>
									</div>
									<select class="form-control" name="responsab">
										<option selected>{{$vehiculo->responsab}}</option>
										<option>0</option>
									</select>
								</div>
								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Estado</span>
									</div>
									<select class="form-control" name="estado">
										<option selected>{{$vehiculo->estado}}</option>
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
										<option selected>{{$vehiculo->activo}}</option>
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
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->codigoinv}}" class="form-control" name="codigoinv" id="codigoinv" placeholder="">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Fecha_Compra</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->fechacomp}}" class="form-control" name="fechacomp" id="fechacomp" placeholder="DD-MM-AA">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Factura_Compra</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->facturacomp}}" class="form-control" name="facturacomp" id="facturacomp" placeholder="">
								</div>
							</div>
							<!--Div Contables-->

							<div class="form-row">
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Valor_Compra</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->valorcomp}}" class="form-control" name="valorcomp" id="valorcomp" placeholder="">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Fecha_Baja</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->fechabaja}}" class="form-control" name="fechabaja" id="fechabaja" placeholder="DD-MM-AA">
								</div>
								<div class="form-group  input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Concepto_Baja</span>
									</div>
									<multitext type="text" onkeyup="mayus(this);" value="{{$vehiculo->concepbaja}}" class="form-control" name="concepbaja" id="concepbaja" placeholder="">
								</div>
							</div>
							<!--Div Contables-->

							<div class="form-row">
								<div class="form-group  input-group col-md-12">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputDetalle">Observaciones</span>
									</div>
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->observacion}}" class="form-control" name="observacion" id="observacion" placeholder="">
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
									<input type="text" onkeyup="mayus(this);" value="{{$vehiculo->kmmantrut}}" class="form-control" name="kmmantrut" id="kmmantrut" placeholder="ej. 5000">
								</div>

								<div class="form-group input-group col-md-4">
									<div class="input-group-prepend">
										<span class="input-group-text">Combustible</span>
									</div>
									<select class="form-control">
										<option selected>{{$vehiculo->combustible}}</option>
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
			

		</form>
		<form method="post" action="/clave/{{$vehiculo->id}}">
			{{csrf_field()}}
			<div class="input-group mb-3 justify-content-end">
				<div class="input-group-prepend">
                            	<span title="Eliminar Registro" class="input-group-text"><i class="fas fa-trash"></i></span>
                </div>
				<input type="hidden" name="_method" value="DELETE">

				<button type="button" class="btn btn-outline-danger " data-toggle="modal" data-target="#exampleModal">Eliminar Registro</button>
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


@endsection @section( "piepagina" ) @endsection