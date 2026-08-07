@extends('layouts.plantilla')

@section('cuerpo')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Detalle de Inspección</h6>
        <div>
            <a href="{{ route('inspeccion.edit', $inspeccion) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('inspeccion.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Código</th>
                        <td><strong>{{ $inspeccion->codigo_inspeccion }}</strong></td>
                    </tr>
                    <tr>
                        <th>Fecha de Inspección</th>
                        <td>{{ $inspeccion->fecha_inspeccion->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tipo de Inspección</th>
                        <td>{{ ucfirst($inspeccion->tipo_inspeccion) }}</td>
                    </tr>
                    <tr>
                        <th>Lugar</th>
                        <td>{{ $inspeccion->lugar }}</td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td>{{ $inspeccion->direccion ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Ciudad</th>
                        <td>{{ $inspeccion->ciudad ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Provincia</th>
                        <td>{{ $inspeccion->provincia ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Inspector</th>
                        <td>{{ $inspeccion->inspector->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Cargo del Inspector</th>
                        <td>{{ $inspeccion->cargo_inspector ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td>
                            @php
                                $estados = [
                                    'pendiente' => 'warning',
                                    'en_progreso' => 'info',
                                    'completada' => 'primary',
                                    'aprobada' => 'success',
                                    'rechazada' => 'danger'
                                ];
                            @endphp
                            <span class="badge badge-{{ $estados[$inspeccion->estado] ?? 'secondary' }}">
                                {{ ucfirst($inspeccion->estado) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Nivel de Riesgo</th>
                        <td>
                            @php
                                $riesgos = [
                                    'bajo' => 'success',
                                    'medio' => 'warning',
                                    'alto' => 'danger',
                                    'critico' => 'danger'
                                ];
                            @endphp
                            @if($inspeccion->nivel_riesgo)
                                <span class="badge badge-{{ $riesgos[$inspeccion->nivel_riesgo] ?? 'secondary' }}">
                                    {{ ucfirst($inspeccion->nivel_riesgo) }}
                                </span>
                            @else
                                <span class="badge badge-secondary">N/A</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha Próxima Inspección</th>
                        <td>{{ $inspeccion->fecha_proxima_inspeccion ? $inspeccion->fecha_proxima_inspeccion->format('d/m/Y') : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Cumple Normativas</th>
                        <td>
                            @if($inspeccion->cumple_normativas)
                                <span class="badge badge-success">Sí</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha de Creación</th>
                        <td>{{ $inspeccion->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-comment"></i> Observaciones
                    </div>
                    <div class="card-body">
                        {{ $inspeccion->observaciones ?? 'Sin observaciones' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <i class="fas fa-lightbulb"></i> Recomendaciones
                    </div>
                    <div class="card-body">
                        {{ $inspeccion->recomendaciones ?? 'Sin recomendaciones' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection