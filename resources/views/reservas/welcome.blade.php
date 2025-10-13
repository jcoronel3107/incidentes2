@extends( "layouts.plantilla" )

@section( "cabeza" )

   

@endsection

@section( "cuerpo" )
     <div class="row align-items-center">
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-4">
               <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body text-white bg-primary">
                         <div class="card-body-icon"><i class="fas fa-car-alt"></i> </div>
                         <div class="mr-4"> <h5>Vehiculos Servicio</h5></div>
                         <div class="mr-5"> <h1>{{$CantVehiculosServicio}}</h1></div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal1" href="#">
                         <span class="float-left">Ver detalles</span>
                         <span class="float-right"><i class="fas fa-angle-right"></i></span>
                    </a>
               </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-4">
               <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body text-white bg-primary">
                         <div class="card-body-icon"><i class="fas fa-car-alt"></i> </div>
                         <div class="mr-4"> <h5>Vehiculos Disponibles</h5></div>
                         <div class="mr-5"> <h1>{{$CantVehiculosDisponibles}}</h1></div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal2" href="#">
                         <span class="float-left">Ver detalles</span>
                         <span class="float-right"><i class="fas fa-angle-right"></i></span>
                    </a>
               </div>
          </div>	
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-4">
               <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body text-white bg-primary">
                         <div class="card-body-icon"><i class="fas fa-car-alt"></i></div>
                         <div class="mr-4"> <h5>Vehiculos en Uso</h5></div>
                         <div class="mr-5"> <h1>{{$CantVehiculosEnUso}}</h1></div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" data-toggle="modal" data-target="#exampleModal3" href="#">
                         <span class="float-left">Ver detalles</span>
                         <span class="float-right"><i class="fas fa-angle-right"></i></span>
                    </a>
               </div>
          </div>
     </div>

   <!-- Modal1 -->
<div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Vehiculos Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-striped">
               <thead>
                    <tr>
                         <th scope="col">id</th>
                         <th scope="col">Codigo</th>
                         <th scope="col">Placa</th>
                         <th scope="col">Marca</th>
                         <th scope="col">Modelo</th>
                    </tr>
               </thead>
               <tbody>
               
                    @foreach ($ListVehiculosServicio as $vehiculo)
                         <tr>
                              <th scope="row">{{ $vehiculo->id }}</th>
                              <td>{{ $vehiculo->codigodis }}</td>
                              <td>{{$vehiculo->placa}}</td>
                              <td>{{$vehiculo->marca}}</td>
                              <td>{{$vehiculo->modelo}}</td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><!-- End Modal1 -->
   <!-- Modal2 -->
   <div class="modal fade bd-example-modal-lg" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Vehiculos Disponibles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-striped">
               <thead>
                    <tr>
                         <th scope="col">id</th>
                         <th scope="col">Codigo</th>
                         <th scope="col">Placa</th>
                         <th scope="col">Marca</th>
                         <th scope="col">Modelo</th>
                    </tr>
               </thead>
               <tbody>
               
                    @foreach ($ListVehiculosDisponibles as $vehiculo)
                         <tr>
                              <th scope="row">{{ $vehiculo->id }}</th>
                              <td>{{ $vehiculo->codigodis }}</td>
                              <td>{{$vehiculo->placa}}</td>
                              <td>{{$vehiculo->marca}}</td>
                              <td>{{$vehiculo->modelo}}</td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><!-- End Modal2 -->
   <!-- Modal3 -->
   <div class="modal fade bd-example-modal-lg" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Vehiculos En Uso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-striped">
               <thead>
                    <tr>
                         <th scope="col">id</th>
                         <th scope="col">Codigo</th>
                         <th scope="col">Placa</th>
                         <th scope="col">Marca</th>
                         <th scope="col">Modelo</th>
                    </tr>
               </thead>
               <tbody>
               
                    @foreach ($ListVehiculosEnUso as $vehiculo)
                         <tr>
                              <th scope="row">{{ $vehiculo->id }}</th>
                              <td>{{ $vehiculo->codigodis }}</td>
                              <td>{{$vehiculo->placa}}</td>
                              <td>{{$vehiculo->marca}}</td>
                              <td>{{$vehiculo->modelo}}</td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><!-- End Modal3 -->
@endsection

@section( "piepagina" )


@endsection