

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
		<div class="card-body"> {{csrf_field()}}
		<form  method="get" action="solicitud" autocomplete="off" role="search" >
		  <div id="search" class="row justify-content-end ">
				  <div class="input-group input-group-sm mb-3 col-sm-12 col-md-6 col-lg-6">
					  <div class="input-group-prepend">
						  <span class="input-group-text" id="inputGroup-sizing-sm">Nro_Orden</span>
					  </div>
					  <input type="text" id="busq_x_orden" name="busq_x_orden" value="{{$query_orden}}" placeholder="Busqueda x Nro_Orden" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				  </div>
				  <div class="input-group input-group-sm mb-3 col-sm-12 col-md-6 col-lg-6">
					  <div class="input-group-prepend">
						  <span class="input-group-text" id="inputGroup-sizing-sm">Conductor</span>
					  </div>
					  <input type="text" id="busq_x_conductor" name="busq_x_conductor" value="{{$query_conductor}}" placeholder="Busqueda x Conductor" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				  </div>
				  <div class="input-group input-group-sm mb-3 col-sm-12 col-md-6 col-lg-12">
					  <div class="input-group-prepend">
						  <span class="input-group-text" id="inputGroup-sizing-sm">Vehiculo</span>
					  </div>
					  <input type="text" id="busq_x_vehiculo" name="busq_x_vehiculo" value="{{$query_vehiculo}}" placeholder="Busqueda x Vehiculo" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				  </div>	
		  </div>
		  <div id="search1" class="row justify-content-end">
				  <div class="input-group input-group-sm mb-3 col-sm-12 col-md-12 col-lg-12">
				  <button type="submit" title="Buscar" class="btn btn-outline-primary btn-sm mr-3"><i class="fas fa-search"></i></button>
					  <div class="input-group-prepend">
						  <span class="input-group-text" id="inputGroup-sizing-sm">Fecha</span>
					  </div>
					  <input type="text"  id="busq_x_fecha" name="busq_x_fecha" value="{{$query_fecha}}" placeholder="Busqueda x Fecha" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				  </div>  
		  </div>
	  </form>
		</div>
	  </div>
	</div>
   
  </div>
  
