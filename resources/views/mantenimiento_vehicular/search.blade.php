<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-outline-info focus-in-expand" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          {!! trans('messages.search option') !!}
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
	  	<form  method="get" action="solicitudes" autocomplete="off" role="search">
			<div id="search" class="row justify-content-end ">
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Solicitante</span>
					</div>
					<input type="text" id="busq_user" name="busq_user" value="{{$busq_user}}" placeholder="Busqueda x Solicitante" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				</div>
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Estado</span>
					</div>
					<input type="text" id="busq_status" name="busq_status" value="{{$busq_status}}" placeholder="Busqueda x Estado Solicitud" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				</div>
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Fecha</span>
					</div>
					<input type="datetime-local" id="busq_fecha" name="busq_fecha" value="{{$busq_fecha}}" placeholder="Busqueda x Fecha" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				</div>	
			</div>
	 	</form>
      </div>
    </div>
  </div>
 
</div>
