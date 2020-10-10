	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded">Registro Información de Parroquias</h2>
	<form method="post" action="/parroquia">

			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Nombre_Parroquia</span>
					</div>
					<input type="text" name="nombre" placeholder="Nombre Parroquia" class="form-control"> {{csrf_field()}}
				</div>
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Postalcode</span>
					</div>
					<input type="text" name="Postalcode" placeholder="Postalcode" class="form-control"> {{csrf_field()}}
				</div>
			</div>


			<div class="form-row">
			</div>
			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
				<a class="btn btn btn-primary" role="button"
					href="{{ route('parroquia.index')}}">Cancelar
				</a>
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