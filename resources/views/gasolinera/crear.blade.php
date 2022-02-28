	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )

<main role="main" class="flex-shrink-0">
	<div class="container">
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Estación de Servicio</h2>
		<form method="post" action="/gasolinera">
		{{csrf_field()}}
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Razon Social</span>
					</div>
					<input type="text" required name="razonsocial" placeholder="Nombre de Estación de Servicio" class="form-control">
				</div>

				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Ruc</span>
					</div>
					<input type="text" required name="ruc" placeholder="Nombre / Descripcion Incidente" class="form-control">
				</div>

			</div>

			<div class="form-row">
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">{!! trans('messages.Address') !!}</span>
					</div>
					<input type="text" required name="direccion" placeholder="Nombre / Descripcion Incidente" class="form-control">
				</div>
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Email</span>
					</div>
					<input type="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" placeholder="Dirección Correo Electronico" class="form-control"> 
				</div>
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Monto Contrato</span>
					</div>
					<input type="number" required min="0" step=".01" name="monto_contrato" placeholder="Digite Monto de Contrato" class="form-control"> 
				</div>



			</div>

			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">{!! trans('messages.to register') !!}</button>
				<a class="btn btn btn-primary" role="button"
					href="{{ route('gasolinera.index')}}">Cancelar
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