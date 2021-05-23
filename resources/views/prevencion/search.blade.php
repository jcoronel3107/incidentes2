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
	  <form  method="get" action="prevencion" autocomplete="off" role="search" >
		<div id="search" class="row justify-content-end ">
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Inspector</span>
					</div>
					<select class="form-control selectpicker" data-live-search="true" name="busq_user_id" >
						<option  ></option>
						@foreach($users as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Vehiculo</span>
					</div>
					<select class="form-control selectpicker" data-live-search="true" id="busq_vehiculo_id" name="busq_vehiculo_id">
						<option salected ></option>
						@foreach($vehiculos as $vehiculo)
						<option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
						@endforeach
					</select>
				</div>
				<div class="input-group input-group-sm mb-3 col-sm-12 col-md-4 col-lg-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Fecha</span>
					</div>
					<input type="text" id="busq_fecha" name="busq_fecha" value="{{$busq_fecha}}" placeholder="Busqueda x Fecha" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				</div>
				<button type="submit" class="btn btn-outline-primary btn-sm mr-3"><i class="fas fa-search"></i></button>	
		</div>
		

	</form>
      </div>
    </div>
  </div>
 
</div>
