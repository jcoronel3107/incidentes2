@extends('layouts.plantilla')

@section('cuerpo')
  <div class="row nav justify-content-end">
                
                    <li class="nav-item">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-plus"></i></span>
                          </div>
                          <a class="btn btn-primary btn-sm mr-2" href="{{ route('solicitud.create') }}"> Realizar Solicitud</a>
                        </div>
                    </li>
                        
  </div>
  <hr style="border:2px;">
      @csrf
        <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab" aria-controls="calendar" aria-selected="true">Calendar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">{{Auth::user()->name}}</a>
          </li>
        </ul>  
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show" id="home" role="tabpanel" aria-labelledby="home-tab">
             @if ($solicitud->count() == 0)
                  <p padding="mt-5" class="text-justify text-md text-uppercase font-italic">No Registra Reservas</p>
             @else
               <div class="table-responsive" >
                  <table class="table table-striped">
                      <thead>
                          <tr>
                             <th>Id</th>
                             <th>Fecha Solicitud</th>
                             <th>Hora Salida</th>
                             <th>Estado</th>
                             <th>Opciones</th>
                            </tr>
                       </thead>
                      <tbody>
                          @foreach ($solicitud as $solicitud)
                           <tr>
                              <td>{{ $solicitud->id }}</td>
                              <td>{{ date('d/m/Y H:i:s', strtotime($solicitud->start)) }}</td>
                              <td>{{ date('d/m/Y H:i:s', strtotime($solicitud->end))  }} </td>
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
                                                    <a class="btn btn-outline-secondary btn-sm " data-toggle="tooltip" title="Edit Solicitud" href="{{ route('solicitud.show', $solicitud->id) }}"><i class="fas fa-edit"></i></a>
                                                    
                                                      <button type="button" id="btnCancelar" data-id="{{ $solicitud->id }}" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#exampleModal{{ $solicitud->id }}"><i class="fas fa-trash-alt"></i></button>                                                                  
                                                      
                                                      <div class="modal fade" id="exampleModal{{ $solicitud->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <p>El registro seleccionado será eliminado. Esta Seguro?...</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <button type="submit" name="Eliminar" value="Eliminar" class="btn btn-primary">Ok</button>
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
          <div id="calendar"class="tab-pane fade show active" role="tabpanel" aria-labelledby="calendar-tab"></div>
        </div> 
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Información Solicitud</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                              <input type="hidden" id="ids" name="ids">
                              <p><b>Titulo:</b> </p>
                              <input class="form-control" type="text" name="title" id="title" readonly="true">
                              <p><b>Fecha Início:</b> </p>
                              <input class="form-control" type="text" name="start" id="start" readonly="true">
                              <p><b>Fecha Salida:</b> </p>
                              <input class="form-control" type="text" name="end" id="end" readonly="true">
                              <p><b>Detalle Actividad:</b> </p>
                              <textarea class="form-control" name="descrip" id="descrip" readonly="true"> </textarea>    
                  </div>
                  <div class="modal-footer">
                    
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
        </div>

        
  @push ('scripts')
      <script type="text/javascript">

              document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {

                    plugins:['dayGrid','interaction','timeGrid','list'],
                    header:{
                        left:'prev,next,today,Miboton',
                        center:'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    defaultView: 'dayGridMonth',
                    eventClick:function(info){
                        console.log(info);
                        $('#ids').val(info.event.id);
                        $('#title').val(info.event.title);
                        $('#start').val(info.event.start);
                        $('#end').val(info.event.end);
                        $('#descrip').val(info.event.extendedProps.descripcion);
                        $('#staticBackdrop').modal();

                    },

                    events:"{{ url('/solicitud/calendar') }}"

                });
                calendar.setOption('locale','Es');
                calendar.render();

                function recolectardatosGUI(method){
                  $end_date = $('#end').val()
                  $start_date = $('#start').val()

                  nuevaSolicitud={
                    id:$('#ids').val(),
                    title:$('#title').val(),
                    user_id:$('#user_id').val(),
                    descripcion:$('#descripcion').val(),
                    start:$('#start').val(),
                    end:$('#end').val(),
                    color:$('#Color').val(),
                    textColor:"#FFFFFF",
                    '_token':$("input[name='_token']").attr('content'),
                    '_method':method

                  }
                  return (nuevaSolicitud);
                }

               

               

                function EnviarInfo(accion,objReserva){
                  $.ajax(
                    {
                    type:"POST",
                    url:"{{url('/solicitud')}}"+accion,
                    data:objReserva,
                    success:function(msg){

                        $('#exampleModal').modal('toggle');
                        calendar.refetchEvents();
                        location.reload();
                    },
                    error:function(){

                      alert("Hay un Error");
                    }

                    }
                  );
                }

                function ConsultaInfo(accion,sql){
                  $.ajax(
                    {
                    type:"POST",
                    url:"{{url('user.solicitud.store')}}"+accion,
                    data:objReserva,
                    success:function(msg){console.log(msg);},
                    error:function(){alert("Hay un Error");}
                    }
                  );
                }
                });
      </script><!-- Calendar -->
      <script type = "text/javascript">
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
         function consulta(){
            //we will send data and recive data fom our AjaxController
            id = $('#Instalacion').val()
            $.ajax({
               url:'miJqueryAjax/id',
               data:{
                      "_token": "{{ csrf_token() }}",
                      "id": id},
               type:'post',
               success:  function (response) {
                  alert(response);
               },
               statusCode: {
                  404: function() {
                     alert('web not found');
                  }
               },
               error:function(x,xs,xt){
                  window.open(JSON.stringify(x));
                  alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
               }
            });
          };
       </script>
  @endpush

@endsection