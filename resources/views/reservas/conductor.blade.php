@extends('layouts.plantilla')

@section('cuerpo')
  <div class="row nav justify-content-end">
                  @can('create reserva')
                      <li class="nav-item">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-plus"></i></span>
                            </div>
                            <a class="btn btn-outline-primary btn-sm mr-2" id="btnAsignar" href="#"> Asignar Vehiculo</a>
                          </div>
                      </li>
                      <li class="nav-item">
                          <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-arrow-left"></i></span>
                                  </div>
                                  <a class="btn btn-outline-primary btn-sm" href="/administrar">Regresar</a>
                          </div> 
                      </li>
                  @endcan         
    </div>
    <hr style="border:2px;">
    <div class="table-responsive" >
                  <table class="table table-striped table-bordered ">
                      <thead>
                          <tr>
                             <th>Id</th>
                             <th>User_id</th>
                             <th>Nombres</th>
                             <th>Vehiculo_id</th>
                             <th>Vehiculo_Descripcion</th>
                             <th>Activo</th>
                             <th>Created_at</th>
                             <th>Opciones</th>
                            </tr>
                       </thead>
                      <tbody>
                          @foreach ($conductores_vehiculos as $conductor)
                           <tr>
                              <td>{{ $conductor->id }}</td>
                              <td>{{ $conductor->user_id  }} </td>
                              <td>{{ $conductor->name  }} </td>
                              <td>{{ $conductor->vehiculo_id }}</td>
                              <td>{{ $conductor->codigodis  }} </td>
                              <td>{{ $conductor->activo  }} </td>
                              <td>{{ $conductor->created_at  }} </td>
                              <td>
                                             
                                  
                                  @can('create assignment')
                                      <a class="btn btn-outline-primary " data-toggle="tooltip" title="Crea Asignación" href=""><i class="fas fa-clipboard-check"></i></a>
                                 @endcan                                                    
                               </td>
                            </tr>
                          @endforeach
                        </tbody>
                  </table>
                                
    </div>
    <div class="modal fade" id="exampleModal" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!-- modal -->
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Asignación Vehiculo-Conductor</h5>
                                        <input type="text" hidden name="title" id="title" readonly>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                
                                    <div class="card">
                                        <div class="card-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                        <p>{{ $error }}</p>
                                                    @endforeach
                                                </div>
                                            @endif        
                                            <form class="needs-validation" method="post" action="/conductor/save" novalidate >
                                                    @csrf
                                                    @method('PUT')
                                                <div class="row">
                                                    <div class="col form-group">
                                                            <label for="created_at">Fecha Asociación</label>
                                                            <div class="input-group" >
                                                                <input class="form-control" readonly id="created_at" name="created_at" value="" />
                                                            </div>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                            <label for="user_id">Conductor</label>
                                                            
                                                                <select class="selectpicker form-control"  data-live-search="true" name="user_id" id="user_id" required>
                                                                    <option selected ></option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Please choose a user.
                                                                </div> 
                                                            
                                                    </div>
                                                    <div class="col-12 form-group">
                                                            <label for="vehiculo_id">Vehiculo</label>
                                                            
                                                                <select class="selectpicker form-control"  data-live-search="true" name="vehiculo_id" id="vehiculo_id" required>
                                                                    <option selected ></option>
                                                                @foreach($vehiculos as $vehiculo)
                                                                    <option value="{{$vehiculo->id}}">{{$vehiculo->codigodis}}</option>
                                                                @endforeach
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Please choose a vehicle.
                                                                </div> 
                                                           
                                                    </div>
                                                    <div class="col-12 form-group">
                                                            <label>Status</label>
                                                            <div class="input-group" >
                                                                <select aria-readonly="true" class="form-control" name="activo" id="activo">
                                                                    <option selected value="true">Activo</option>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    
                                                     <button id="btnGuardar" class="btn btn-primary btn-block"  type="submit">Asociar </button>
                                                </div>   
                                            </form>          
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                        </div>
                </div>
    </div><!-- modal -->
    
	
   
        @push ('scripts')
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
            })();
        </script>
        <script type="text/javascript">
                      document.addEventListener('DOMContentLoaded', function() {
                        
                            
                        $('#btnAsignar').click(function(){
                            $('#exampleModal').modal('toggle');
                        });

                        $('#btnGuardar').click(function(){
                            objReserva = recolectardatosGUI("POST");
                            console.log(objReserva);
                            alert(objReserva);
                            //EnviarInfo(accion,objReserva)
                        });

                       
                       fecha();
                       

                        function recolectardatosGUI(method){
                          nuevaSolicitud={
                            created_at:$('#created_at').val(),
                            user_id:$('#user_id').val(),
                            vehiculo_id:$('#vehiculo_id').val(),
                            activo:$('#activo').val(),
                            '_token':$("input[name='_token']").attr('content'),
                            '_method':method
                          }
                          return (nuevaSolicitud);
                        }

                        function fecha(){
                            var now = new Date();

                            var day = ("0" + now.getDate()).slice(-2);
                            var month = ("0" + (now.getMonth() + 1)).slice(-2);
                            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
                            var hr = now.getHours();
                            var min = now.getMinutes();
                            var sec = now.getSeconds();
                            hr = (hr == 0) ? 12 : hr;
                            hr = (hr > 12) ? hr - 12 : hr;
                            //Add a zero in front of numbers<10
                            hr = checkTime(hr);
                            min = checkTime(min);
                            sec = checkTime(sec);
                            today = today +" "+ hr + ":" + min + ":" + sec;
                            $("#created_at").val(today);


                            /* const today = moment();
                            var hoy = today.format('YYYY-MM-DD HH:MM:SS');
                            console.log(today);
                            $('#created_at').val(today); */
                        }

                        function checkTime(i) {
                            if (i < 10) {
                                i = "0" + i;
                            }
                            return i;
                        }

                        function EnviarInfo(accion,objReserva){
                          $.ajax(
                            {
                            type:"POST",
                            url:"{{url('admin.asoc_save')}}"+accion,
                            data:objReserva,
                            success:function(msg){
                                console.log(msg);
                                $('#exampleModal').modal('toggle');
                                calendar.refetchEvents();
                            },
                            error:function(){alert("Hay un Error");}
                            }
                          );
                        }
                      });
                </script>
        @endpush
@endsection