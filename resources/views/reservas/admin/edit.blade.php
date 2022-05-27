@extends('layouts.plantilla')

@section('cuerpo')

            <div class="card ">
                 
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Información de Solicitud</p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('administrar.index') }}">Regresar</a>
                </div>    
                @if ($errors->any())
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                    </div>
                    @endif  
                <div class="card-body">
                    
                    <form class="form" method="post" action="{{ route('administrar.update', $solicitud) }}">
                            @method('PATCH')
                            @csrf
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><strong>Id Solicitud:</strong></span>
                                </div>
                                <input type="text" name="solicitud_id" id="solicitud_id" value="{{ $solicitud->id }}" class="form-control" aria-describedby="basic-addon1" readonly>
                            </div>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><strong>Nombre de Usuario:</strong></span>
                                </div>
                                <input type="text" value="{{ $solicitud->user->name }}" class="form-control" aria-describedby="basic-addon2" readonly>
                            </div>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><strong>Email de Usuario:</strong></span>
                                </div>
                                <input type="text" id="email" name="email" value="{{ $solicitud->user->email }}" class="form-control" aria-describedby="basic-addon2" readonly>
                            </div>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3"><strong>Color:</strong></span>
                                </div>
                                <input type="text" name="color" id="color" value="{{ $solicitud->color }}" class="form-control" aria-describedby="basic-addon3" readonly>    
                             </div>
                             <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3"><strong>Text Color:</strong></span>
                                </div>
                                <input type="text" name="textColor" id="textColor" value="{{ $solicitud->textColor }}" class="form-control" aria-describedby="basic-addon3" readonly>    
                             </div>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3"><strong>Estado Solicitud:</strong></span>
                                </div>
                                <input type="text" name="estado" id="estado" value="{{ $solicitud->status }}" class="form-control" aria-describedby="basic-addon3" readonly>    
                             </div>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4"><strong>Fecha de início:</strong></span>
                                </div>
                                <input name="start" type="text" value="{{$solicitud->start}}" class="form-control"  aria-describedby="basic-addon4" readonly>
                            </div>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><strong>Fecha fin:</strong></span>
                                </div>
                                <input name="end" type="text"  value="{{$solicitud->end}}" class="form-control"  aria-describedby="basic-addon5" readonly>
                            </div>   
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><strong>Información Solicitud:</strong></span>
                                </div>
                                <textarea readonly class="form-control" >{{ $solicitud->descripcion }}</textarea>
                            </div>   
                            <hr>
                            <label >Recurso:</label>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon6"><strong>Recurso a Asignar:</strong></span>
                                </div>
                                <select name="vehiculo_id" id="vehiculo_id" class="form-control"  aria-describedby="basic-addon6" required>
                                    <option value="">Seleccione...</option>
                                    @foreach($ListVehiculosDisponibles as $vehiculodisponible)
                                        <option value="{{$vehiculodisponible->id}}">{{$vehiculodisponible->codigodis . " --> " . $vehiculodisponible->placa}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon6"><strong>Conductor Asignado:</strong></span>
                                </div>
                                <select name="conductor_id" id="conductor_id" class="form-control"  aria-describedby="basic-addon6" required>
                                    <option value="">Seleccione...</option>
                                    @foreach($ListConductores as $conductor)
                                        <option value="{{$conductor->id}}">{{$conductor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                    <button class="btn btn-primary btn-block" id="Enviar" >Salvar</button>
                             </div>
                         </form>
                 </div>
               
            </div>
            
    @push ('scripts')
                <script>
                    $(document).ready(function(){
                        js_status=document.getElementById("estado").innerText;
                        
                        if (js_status=="Confirmado" || js_status=="Cancelado")  {
                            $("#divstatus").hide();
                            $("#Enviar").hide();
                        }else{
                            $("#divstatus").show();
                            $("#Enviar").show();
                        }
                        
                    });
                </script>
    @endpush
@endsection