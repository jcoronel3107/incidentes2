@extends('layouts.plantilla')

@section('cuerpo')

            <div class="card ">
                 
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Información de Solicitud</p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('administrar.index') }}">Regresar</a>
                </div>    
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                    </div>
                    @endif  
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
                                    <span class="input-group-text" id="basic-addon3"><strong>Estado Solicitud:</strong></span>
                                </div>
                                <input type="text" name="estado" id="estado" value="{{ $solicitud->status }}" class="form-control" aria-describedby="basic-addon3" readonly>    
                             </div>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4"><strong>Fecha de início:</strong></span>
                                </div>
                                <input name="start" type="text" value="{{ date('d/m/Y H:i:s', strtotime($solicitud->start)) }}" class="form-control"  aria-describedby="basic-addon4" readonly>
                            </div>
                            <div class="input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5"><strong>Fecha fin:</strong></span>
                                </div>
                                <input name="end" type="text"  value=" {{ date('d/m/Y H:i:s', strtotime($solicitud->end)) }}" class="form-control"  aria-describedby="basic-addon5" readonly>
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
                                    <option></option>
                                    @foreach($ListVehiculosDisponibles as $vehiculodisponible)
                                        <option value="{{$vehiculodisponible->id}}">{{$vehiculodisponible->codigodis . " --> " . $vehiculodisponible->placa}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                    <button class="btn btn-primary btn-block" id="Enviar" data-toggle="modal" data-target="#exampleModal">Salvar</button>
                             </div>
                         </form>
                 </div>
               
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
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