@extends('layouts.plantilla')

@section('cuerpo')
    <div class="input-group mb-3 justify-content-end col-md-10 col-sm-12">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-print"></i></span>
        </div>
        <button type="submit" name="Enviar" value="Enviar" class="btn btn-outline-primary">Print</button>   
        <div class="input-group-prepend ml-2">
            <span class="input-group-text"><i class="fas fa-arrow-left"></i></span>
        </div>
        
        <a class="btn btn-outline-secondary" title="Regresar" role="button" href="{{ route('solicitud.index')}}">Regresar</a>   
    </div>

        <div class="card col-md-10 col-sm-12">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>Información de Solicitud</div>

                        
                    </div>
                    
                        <div class="card-body">
                            @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            @endif

                            <div>
                                <p><strong>Fecha:</strong> {{ date('Y/m/d H:i:s', strtotime($solicitud->created_at)) }}</p>
                                <p><strong>Conductor:</strong> {{ $solicitud->user->name }}</p>
                                <p><strong>Vehiculo:</strong> {{ $solicitud->vehiculo->codigodis }}</p>
                                <p><strong>Combustible:</strong> {{ $solicitud->combustible }}</p>
                                <p><strong>Gasolinera:</strong> {{ $solicitud->gasolinera->razonsocial}}</p>
                                <hr>
                                <p><strong>Status:</strong>
                                    @if ($solicitud->status == 'Solicitado')
                                    <span class="badge badge-primary">{{ $solicitud->status }}</span>
                                    @elseif ($solicitud->status == 'Confirmado')
                                    <span class="badge badge-success">{{ $solicitud->status }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ $solicitud->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    
        </div>



@endsection