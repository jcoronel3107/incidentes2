<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-outline-info" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Opciones Busqueda
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
	  <form  method="get" action="derrame" autocomplete="off" role="search" >
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
				</div>	
		</div>
		<div id="search1" class="row justify-content-end">
				
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-5 col-lg-5">
				<button type="submit" class="btn btn-outline-primary btn-sm mr-3"><i class="fas fa-search"></i></button>
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Usuario_Afectado</span>
					</div>
					<input type="text" id="busq_usuarioafectado" name="busq_usuarioafectado" value="{{$busq_usuarioafectado}}" placeholder="Busqueda x Usuario Afectado" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				</div>
				
		</div>

	</form>
      </div>
    </div>
  </div>
 
</div>
