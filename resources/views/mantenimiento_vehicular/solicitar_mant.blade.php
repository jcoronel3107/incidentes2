	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	@if(count($errors)>0)
		@foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">
			{{$error}}
			</div>
		@endforeach
	@endif
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Solicitar Mantenimiento de Vehículo</h2>
		<form method="post" action="/storemaintenancerequest">
			<div class="form-row ">
				<div class='col-md-6'>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Fecha Registro</span>
							</div>
							<input type="datetime-local" readonly id="fecha" name="fecha"  value="{{old('fecha',$now)}}" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group col-lg-4 col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text">Seleccione Vehiculo</span>
					</div>
					<select required class="form-control" id="vehiculo" name="vehiculo">
						<option> {{old('vehiculo')}}</option>
						@foreach($Vehiculoinfo as $item)
							<option value="{{$item->id}}">{{$item->codigodis}}</option>
						@endforeach
					</select>
				</div>
				
				<div class="form-group input-group col-lg-8 col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text">Solicitante</span>
					</div>
					<input required type="text" readonly class="form-control"  name="solicitante" id="solicitante" value="{{$maquinista}}">
				</div>	
			</div>
			<div id="response" class="form-row"></div>
			
			<div class="form-row">
				<div class="form-group  input-group col-lg-4 col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Km Notificacion Daño</span>
					</div>
					<input required type="number" class="form-control"  name="km_ingreso" id="km_ingreso" placeholder="0000" value="{{old('kmmant')}}">
				</div>
				<div class="form-group  input-group col-lg-12 col-md-12">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputDetalle">Motivo Mantenimiento</span>
					</div>
					<input required type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Digite motivo por el cual solicita mantenimiento" value="{{old('descripcion')}}">
				</div>
			</div>
			
	

			<div>
				<br>{{csrf_field()}}
			</div>
			<div class="input-group mb-3 justify-content-end">
				
					<div class="input-group-prepend">
                            	<span class="input-group-text"><i class="fas fa-check"></i></span>
                      </div>
					<button type="submit" name="Enviar" value="Enviar" class="btn btn-outline-success">{!! trans('messages.to register') !!}</button>
				
			</div>
		</form>



@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
			$("#vehiculo").change(function() {
				var idvehiculo = $(this).val();
				console.log(idvehiculo);
				$.get('/consultainfovehiculo/' + idvehiculo, function(data) {
					//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
					var infovehiculo = ''
					for (var i = 0; i < data.length; i++)
					infovehiculo += '<p class="ml-3"><b>Placa Vehiculo:</b> '+ data[i].placa + '</p><p>&nbsp<b>Marca Vehiculo: </b>'+data[i].marca+'</p>';
					$("#response").html(infovehiculo);
				});
			});
		});
	</script>
@endpush('scripts')


@section( "piepagina" )
@endsection