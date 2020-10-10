	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Incidentes</h2>
		<form method="post" action="/incidente/{{$incidente->id}}">
			<input type="hidden" name="_method" value="PUT">
			<div class="form-row">
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Tipo_Incidente</span>
					</div>
					<input type="text" name="tipo_incidente" value="{{$incidente->tipo_incidente}}" placeholder="Tipo Incidente ej. 10_20" class="form-control">
				</div>

				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Nombre_Incidente</span>
					</div>
					<input type="text" name="nombre_incidente" value="{{$incidente->nombre_incidente}}" placeholder="Nombre / Descripcion Incidente" class="form-control"> {{csrf_field()}}
				</div>
			</div>
			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Actualizar</button>
				<a class="btn btn btn-primary" role="button"
					href="{{ route('incidente.index')}}">Cancelar
				</a>
			</div>

		</form>
		<form method="post" action="/incidente/{{$incidente->id}}">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="DELETE">

			<button type="button" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar Registro</button>
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
	@endsection

	@section( "piepagina" )


	@endsection