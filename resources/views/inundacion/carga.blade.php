	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Adjunta Fichas SCI de Evento 10-20</h2>
	<div class="card">
		<div class="card-header">
			<div class="col-12 text-right">
				<a href="{{ route('inundacion.index')}}" class="btn btn-outline-primary ">Regresar</a>
			</div>
		</div>

		<div class="card-body">
			<hr>
			<div class="row">
				<div class="col-md-12 col-md-offset-1">
					<div class="panel panel-default">
						<div class="panel-heading">Agregar archivos en Registro {{$id}}</div>
						<hr>
						<div class="panel-body">
							<form method="POST" action="/inundacions/guardaform" accept-charset="UTF-8" enctype="multipart/form-data">

								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="id" value="{{$id}}">
								<p class="text-info">Formulario SCI 201</p>
								<div class="form-row">

									<div class="form-group  input-group col-lg-6 col-md-4 col-sm-12">
										<div class="input-group-prepend">
											<span class="input-group-text">Subir Archivo</span>
										</div>
										<!-- <input type="file" required="" name="fileSCI[]" id="fileSCI" multiple=""> -->
										<input type="file" required="" name="fileSCI-201">
									</div>
									<div class="form-group  input-group col-lg-3 col-md-4 col-sm-12">
										<div class="input-group-apend">
											<span class="input-group-text">Descargar Form</span>
										</div>
										<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/201.pdf"><i class="icon-file-text"></i></a>
									</div>
									<div class="form-group  input-group col-lg-3 col-md-4 col-sm-12">
										<div class="input-group-prepend">
											<span class="input-group-text">Instructivo </span>
										</div>
										<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/I201.pdf"><i class="icon-file-text"></i></a>
									</div>
								</div>
								<hr>
								<p class="text-info">Formulario SCI 207</p>
								<div class="form-row">
									<div class="form-group input-group col-lg-6 col-md-12 col-sm-12">
										<div class="input-group-prepend">
											<span class="input-group-text">Subir Archivo</span>
										</div>
										<input type="file" required="" name="fileSCI-207">
									</div>
									<div class="form-group input-group col-lg-3 col-md-12 col-sm-12">
										<div class="input-group-apend">
											<span class="input-group-text">Descargar Form</span>
										</div>
										<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/207.pdf"><i class="icon-file-text"></i></a>
									</div>
									<div class="form-group input-group col-lg-3 col-md-12 col-sm-12">
										<div class="input-group-apend">
											<span class="input-group-text">Instructivo</span>
										</div>
										<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/I207.pdf"><i class="icon-file-text"></i></a>
									</div>

								</div>
								<hr>
								<p class="text-info">Formulario SCI 211</p>
								<div class="form-row">
									<div class="form-group input-group col-lg-6 col-md-12 col-sm-12">
										<div class="input-group-prepend">
											<span class="input-group-text">Subir Archivo</span>
										</div>
										<input type="file" required="" name="fileSCI-211">
									</div>
									<div class="form-group input-group col-lg-3 col-md-12 col-sm-12">
										<div class="input-group-apend">
											<span class="input-group-text">Descargar Form</span>
										</div>
										<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/211.pdf"><i class="icon-file-text"></i></a>
									</div>
									<div class="form-group input-group col-lg-3 col-md-12 col-sm-12">
										<div class="input-group-apend">
											<span class="input-group-text">Instructivo</span>
										</div>
										<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/I211.pdf"><i class="icon-file-text"></i></a>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary">Guardar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endsection
	@section( "piepagina" ) @endsection