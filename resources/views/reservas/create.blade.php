@extends('layouts.plantilla')

@section('cuerpo')

{{-- Div Calendario --}}
 
 <div class="row justify-content-center">
      <div class="col-10 d-flex justify-content-between align-items-center">
        <h3 class="text-danger">Registre Su Solicitud de Vehiculo</h3>
        <a class="btn btn-outline-primary btn-sm" href="{{ route('solicitud.index') }}">Regresar</a>
      </div>
      <div id="calendar" class="col-md-10 col-lg-10"></div>
 </div>
<!-- modal -->
  <div class="row justify-content-center">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Solicitud de {{$user_name}}</h5>
                                
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
                              <form method="post" action="{{ route('solicitud.store') }}" >
                                    @csrf
                                    <div hidden class="input-group mb-3">
                                      <input type="text" readonly name="user_id" value="{{$user_id}}">
                                      <input type="text" value="{{$user_name}}" readonly name="title" id="title" >
                                    </div>
                                    
                                                                                      
                                    <div class="form-group">
                                          <label for="start" class="col-md-4 control-label">Fecha Reserva</label>
                                          <div class="col-md-12">
                                                <input id="start" type="text"  class="form-control start"  name="start"  value="{{ old('start') }}" required >
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label for="uso">Tiempo Uso</label>
                                          <div class="input-group mb-3" >
                                              
                                                <input class="form-control" type="range" min="0" max="480" value="0" step="5" id="uso" name="uso" required>
                                          </div>
                                          <p>Tiempo en Minutos: <span id="demo"></span></p>  
                                    </div>
                                    <div class="form-group">
                                            <label for="end">Fin</label>
                                            <div class="input-group" >
                                              <input class="form-control" type="text" id="end" name="end" readonly="true">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="descripcion">Detalle Actividades</label>
                                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>                      
                                    </div>
                                    <div class="form-group">
                                          <label for="Color">Color</label>
                                          <div class="input-group" >
                                              <input class="form-control Color" type="color" value="#021ef2" id="Color" name="color" required>
                                              <input type="text" hidden="true" value="#ffffff" id="textColor" name="textColor">
                                          </div>
                                    </div>

                                    <div class="form-group">
                                        <button id="btnSolicitar" class="btn btn-success btn-block"  type="submit">Solicitar </button>
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
    </div>
      
  </div>

  @push ('scripts')
        <script type="text/javascript">
            var slider = document.getElementById("uso");
            var output = document.getElementById("demo");
            var duration;
            var hours;
            output.innerHTML = slider.value; // Display the default slider value
            // Update the current slider value (each time you drag the slider handle)

            slider.oninput = function() {

                var start_date = $('#start').val();
                var end_date = moment(start_date).add(this.value,'minute');
                document.getElementById("end").value = moment(end_date).format();
                output.innerHTML = this.value;
            };
        </script>
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
                    defaultView: 'timeGridDay',
                    customButtons:{
                        Miboton:{
                            text:"Boton",
                            click:function(){
                            }
                        }
                    },
                    dateClick:function(info){
                        $('#start').val(info.dateStr);
                        $('#exampleModal').modal('toggle');
                    },
                    eventClick:function(info){
                        console.log(info.event.title);
                        console.log(info.event.start);
                        console.log(info.event.end);
                        console.log(info.event.textColor);
                        console.log(info.event.backgroundColor);
                        console.log(info.event.extendedProps.Usuario);
                        console.log(info.event.extendedProps.Comentarios);
                    },
                    events:"{{ url('/solicitud/calendar') }}"
                });
                calendar.setOption('locale','Es');
                calendar.render();
                $('#btnSolicitar').click(function(){
                  objReserva = recolectardatosGUI("POST");
                  console.log(objReserva);
                  EnviarInfo(accion,objReserva)
                });

                function recolectardatosGUI(method){
                  nuevaSolicitud={
                    title:$('#title').val(),
                    user_id:$('#user_id').val(),
                    descripcion:$('#descripcion').val(),
                    start:$('#start').val(),
                    end:$('#end').val(),
                    color:$('#Color').val(),
                    textColor:'#FFFFFF',
                    '_token':$("input[name='_token']").attr('content'),
                    '_method':method
                  }
                  return (nuevaSolicitud);
                }

                function EnviarInfo(accion,objReserva){
                  $.ajax(
                    {
                    type:"POST",
                    url:"{{url('user.solicitud.store')}}"+accion,
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