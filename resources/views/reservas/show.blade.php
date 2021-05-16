@extends('layouts.plantilla')

@section('cuerpo')


        <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>Información de Solicitud</div>

                        <div>
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('solicitud.index') }}">Regresar</a>
                        </div>
                    </div>
                    
                        <div class="card-body">
                            @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            @endif

                            <div>
                                <p><strong>Fecha Início:</strong> {{ date('d/m/Y H:i:s', strtotime($solicitud->start)) }}</p>
                                <p><strong>Fecha Retorno:</strong> {{ date('d/m/Y H:i:s', strtotime($solicitud->end)) }}</p>

                                <p><strong>Comentario de Usuario:</strong> {{ $solicitud->descripcion }}</p>
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