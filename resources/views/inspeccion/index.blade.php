@extends('layouts.plantilla')

@section('cuerpo')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Inspecciones</h6>
        <a href="{{ route('inspeccion.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nueva Inspección
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Lugar</th>
                        <th>Inspector</th>
                        <th>Estado</th>
                        <th>Riesgo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inspecciones as $inspeccion)
                    <tr>
                        <td>{{ $inspeccion->codigo_inspeccion }}</td>
                        <td>{{ $inspeccion->fecha_inspeccion->format('d/m/Y') }}</td>
                        <td>{{ $inspeccion->lugar }}</td>
                        <td>{{ $inspeccion->inspector->name ?? 'N/A' }}</td>
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
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('inspeccion.show', $inspeccion) }}" class="btn btn-info btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('inspeccion.pdf', $inspeccion) }}" class="btn btn-danger btn-sm" title="Exportar PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <a href="{{ route('inspeccion.edit', $inspeccion) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('inspeccion.destroy', $inspeccion) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta inspección?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $inspecciones->links() }}
    </div>
</div>
@endsection