@extends('layouts.plantilla')

@section('cuerpo')
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Solicitudes Pendientes Aprobación</div>
                        
                            <div class="card-body">
                                @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                                @endif

                                @if ($solicituds->count() == 0)
                                    <p class="text-info"><h3>NO</h3>Existen Solicitudes <b><em>Pendientes</em></b> por Aprobar</p>
                                @else

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Usuario</th>
                                                <th>Desde</th>
                                                <th>Hasta</th>
                                                <th>Status</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($solicituds as $solicitud)
                                            <tr>
                                                <td>{{ $solicitud->id }}</td>
                                                <td>{{ $solicitud->name }}</td>
                                                <td>{{ $solicitud->start }}</td>
                                                <td>{{ $solicitud->end }}</td>
                                                <td>
                                                    <a href="#">
                                                        @if ($solicitud->status == 'Solicitado')
                                                        <span class="badge badge-primary">{{ $solicitud->status }}</span>
                                                        @elseif ($solicitud->status == 'Confirmado')
                                                        <span class="badge badge-success">{{ $solicitud->status }}</span>
                                                        @else
                                                        <span class="badge badge-danger">{{ $solicitud->status }}</span>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                                    @can('create assignment')
                                                    <a class="btn btn-outline-primary btn-sm " data-toggle="tooltip" title="Crea Asignación" href="{{ route('administrar.edit',$solicitud->id) }}"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('update reserva')
                                                    <button type="button" class="btn btn-outline-danger"  title="Cancelar Solicitud" data-toggle="modal" data-target="#exampleModal{{$solicitud->id}}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                    @endcan
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{$solicitud->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLabel">Cancelar Solicitud de {{$solicitud->name}}</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">Id</span>
                                                                                                    </div>
                                                                                                    <input type="text" id="id{{ $solicitud->id }}" name="id" class="form-control" value="{{ $solicitud->id }}">
                                                                                                </div>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">Nombre</span>
                                                                                                    </div>
                                                                                                    <input type="text" class="form-control" value="{{ $solicitud->name }}">
                                                                                                </div>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">Inicio</span>
                                                                                                    </div>
                                                                                                    <input type="text" class="form-control" value="{{ $solicitud->start }}">
                                                                                                </div>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">Hasta</span>
                                                                                                    </div>
                                                                                                    <input type="text" class="form-control" value="{{ $solicitud->end }}">
                                                                                                </div>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">Detalle</span>
                                                                                                    </div>
                                                                                                    <input type="text" class="form-control" value="{{ $solicitud->descripcion }}">
                                                                                                </div>
                                                                                                <div class="input-group">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <span class="input-group-text">Estado</span>
                                                                                                    </div>
                                                                                                    <input type="text" value="Cancelado" class="form-control"  readonly></p>
                                                                                                </div>
                                                                                                
                                                                                                
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                <button type="button" id="btnCancelar" data-id="{{ $solicitud->id }}" class="btn btn-outline-danger">Cancelar Solicitud</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @endif
                            </div>
                            
                </div>
                <div class="mt-4">
                    {{ $solicituds->links() }}
                </div>


            </div>
        </div>
        <input type="hidden" value="{{csrf_token()}}" id="_token" name="_token"> 
    </div>
    
    @push ('scripts')
      <script type="text/javascript">
              document.addEventListener('DOMContentLoaded', function() {
                var id="";
                $('#btnCancelar').click(function(){
                  id=  $('#btnCancelar').attr('data-id');
                  console.log(id);
                  objReserva = recolectardatosGUI("DELETE");
                  EnviarInfo('solicitud/'+id,objReserva);
                  
                });

                function recolectardatosGUI(method){
                  nuevaSolicitud={
                    '_token':$('#_token').val(),
                    'id':id,
                    '_method':method
                  }
                  return (nuevaSolicitud);
                }

                function EnviarInfo(accion,objReserva){
                    console.log(objReserva);
                  $.ajax(
                        {
                            type:"POST",
                            url:accion,
                            data:objReserva,
                            
                            success:function(msg){
                                console.log(msg);
                                $('#exampleModal+id').modal('toggle');
                                location.reload();
                            },
                            statusCode: {
                                404: function() {
                                    alert('web not found');
                                }
                            },
                            
                            error:function(){

                            alert("Hay un Error");
                            }
                        }
                  );
                }

             });
      </script>
     @endpush
@endsection