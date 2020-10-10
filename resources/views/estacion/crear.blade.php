	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )

<main role="main" class="flex-shrink-0">
	<div class="container">
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Estación Bombero</h2>
		<form method="post" action="/estacion">

			<div class="form-row">


				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Nombre_Estacion</span>{{csrf_field()}}
					</div>
					<input type="text" name="nombre" placeholder="Nombre / Estació Bomberos" class="form-control"> {{csrf_field()}}
				</div>
			</div>


			<div class="form-row">
			</div>
			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
				<a class="btn btn btn-primary" role="button"
					href="{{ route('estacion.index')}}">Cancelar
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
</main>
	@endsection

	@section( "piepagina" )


	@endsection