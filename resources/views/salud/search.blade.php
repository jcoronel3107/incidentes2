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
	  <form  method="get" action="salud" autocomplete="off" role="search" >
		<div id="search" class="row justify-content-end ">
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Direccion</span>
					</div>
					<input type="text" id="busq_direccion" name="busq_direccion" value="{{$busq_direccion}}" placeholder="Busqueda x Dirección" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				</div>
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Estacion</span>
					</div>
					<input type="text" id="busq_estacion" name="busq_estacion" value="{{$busq_estacion}}" placeholder="Busqueda x Estación" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				</div>
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Fecha</span>
					</div>
					<input type="text" id="busq_fecha" name="busq_fecha" value="{{$busq_fecha}}" placeholder="Busqueda x Fecha" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
					<button type="submit" class="btn btn-outline-primary btn-sm ml-3 mr-3"><i class="fas fa-search"></i></button>
				</div>	
				
		</div>
		
	</form>
      </div>
    </div>
  </div>
 
</div>
