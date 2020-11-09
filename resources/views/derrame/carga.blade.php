	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Adjunta Fichas SCI de Evento Hazmat</h2>
		<div class="card">
			<div class="card-header">
		    	<div class="col-12 text-right">
		    		<a href="{{ route('derrame.index')}}" class="btn btn-outline-primary ">Regresar</a>
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
				          <form method="POST" action="http://incidentes2.test/derrames/guardaform" accept-charset="UTF-8" enctype="multipart/form-data">
				            
				            <input type="hidden" name="_token" value="{{ csrf_token() }}">
				            <input type="hidden" name="id" value="{{$id}}">
				             <div class="form-group input-group col-lg-12 col-md-12 col-sm-12">
								<div class="input-group-prepend">
									<span class="input-group-text">SCI-201, Informe De Incidente</span>
								</div>
								<!-- <input type="file" required="" name="fileSCI[]" id="fileSCI" multiple=""> -->
								<input type="file" required="" name="fileSCI-201">
								<div class="input-group-apend">
									<span class="input-group-text">Descargar Form SCI-201</span>
								</div>
								<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/201.pdf" ><i class="icon-file-text"></i></a>
							</div>
				            
				            <div class="form-group input-group col-lg-12 col-md-12 col-sm-12">
								<div class="input-group-prepend">
									<span class="input-group-text">SCI-202, Objetivos Del Incidente</span>
								</div>
								<input type="file" required="" name="fileSCI-202">
								<div class="input-group-apend">
									<span class="input-group-text">Descargar Form SCI-202</span>
								</div>
								<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/202.pdf" ><i class="icon-file-text"></i></a>
							</div>

				            
				            <div class="form-group input-group col-lg-12 col-md-12 col-sm-12">
								<div class="input-group-prepend">
									<span class="input-group-text">SCI-206A, Plan Médico</span>
								</div>
								<input type="file" required="" name="fileSCI-206">
								<div class="input-group-apend">
									<span class="input-group-text">Descargar Form SCI-206A</span>
								</div>
								<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/download/206A.pdf" ><i class="icon-file-text"></i></a>
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