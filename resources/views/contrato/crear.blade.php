	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )

<main role="main" class="flex-shrink-0">
	<div class="container">
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Contrato</h2>
		@if(count($errors)>0)
			@foreach($errors->all() as $error)
				<div class="alert alert-danger" role="alert">
				{{$error}}
				</div>
			@endforeach

		@endif
		<form method="post" action="/contrato">
		{{csrf_field()}}
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">Denominación</span>
					</div>
					<input type="text" required name="denominacion" placeholder="Digite Denominaciòn de Contrato..ej. SIE-BCBVC-2022-0113" class="form-control">
				</div>
				<div class="form-group input-group  col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Fecha Suscripcion</span>
					</div>
					<input type="date" required name="fecha" class="form-control">
				</div>

			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
						<span class="input-group-text">{!! trans('messages.Gas Station') !!}</span>
					</div>
					<select name="gasolinera_id" required class="form-control">
						<option value="">Seleccione...</option>
						@foreach($gasolineras as $station)
						<option value="{{$station->id}}">{{$station->razonsocial}}</option>
						@endforeach
					</select>
					
				</div>
			</div>

			<div class="form-row">
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Plazo</span>
					</div>
					<input type="text" required name="plazo" placeholder="Digite plazo de ejecución" class="form-control">
				</div>
				<div class="form-group input-group  col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text">Valor</span>
					</div>
					<input type="number" required min="0" step=".01" name="valor" placeholder="Monto Contrato" class="form-control"> 
				</div>
			</div>

			<div class="form-group">
				<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">{!! trans('messages.to register') !!}</button>
				<a class="btn btn btn-primary" role="button"
					href="{{ route('contrato.index')}}">Cancelar
				</a>
				<button type="reset" name="Borrar" value="Borrar" class="btn btn-danger">Borrar Formulario</button>
			</div>

		</form>

  
</main>
	@endsection

	@section( "piepagina" )


	@endsection