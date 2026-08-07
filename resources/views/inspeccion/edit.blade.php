@extends('layouts.plantilla')

@section('cuerpo')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Editar Inspección</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('inspeccion.update', $inspeccion) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Código</label>
                        <input type="text" class="form-control" value="{{ $inspeccion->codigo_inspeccion }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha de Inspección <span class="text-danger">*</span></label>
                        <input type="date" name="fecha_inspeccion" class="form-control @error('fecha_inspeccion') is-invalid @enderror" value="{{ old('fecha_inspeccion', $inspeccion->fecha_inspeccion->format('Y-m-d')) }}" required>
                        @error('fecha_inspeccion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tipo de Inspección <span class="text-danger">*</span></label>
                        <select name="tipo_inspeccion" class="form-control @error('tipo_inspeccion') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
                            <option value="preventiva" {{ old('tipo_inspeccion', $inspeccion->tipo_inspeccion) == 'preventiva' ? 'selected' : '' }}>Preventiva</option>
                            <option value="correctiva" {{ old('tipo_inspeccion', $inspeccion->tipo_inspeccion) == 'correctiva' ? 'selected' : '' }}>Correctiva</option>
                            <option value="rutinaria" {{ old('tipo_inspeccion', $inspeccion->tipo_inspeccion) == 'rutinaria' ? 'selected' : '' }}>Rutinaria</option>
                            <option value="especial" {{ old('tipo_inspeccion', $inspeccion->tipo_inspeccion) == 'especial' ? 'selected' : '' }}>Especial</option>
                        </select>
                        @error('tipo_inspeccion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lugar <span class="text-danger">*</span></label>
                        <input type="text" name="lugar" class="form-control @error('lugar') is-invalid @enderror" value="{{ old('lugar', $inspeccion->lugar) }}" required>
                        @error('lugar')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', $inspeccion->direccion) }}">
                        @error('direccion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad" class="form-control @error('ciudad') is-invalid @enderror" value="{{ old('ciudad', $inspeccion->ciudad) }}">
                        @error('ciudad')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Provincia</label>
                        <input type="text" name="provincia" class="form-control @error('provincia') is-invalid @enderror" value="{{ old('provincia', $inspeccion->provincia) }}">
                        @error('provincia')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Inspector <span class="text-danger">*</span></label>
                        <select name="inspector_id" class="form-control @error('inspector_id') is-invalid @enderror" required>
                            <option value="">Seleccione Inspector...</option>
                            @foreach($inspectors as $inspector)
                                <option value="{{ $inspector->id }}" {{ old('inspector_id', $inspeccion->inspector_id) == $inspector->id ? 'selected' : '' }}>
                                    {{ $inspector->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('inspector_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cargo del Inspector</label>
                        <input type="text" name="cargo_inspector" class="form-control @error('cargo_inspector') is-invalid @enderror" value="{{ old('cargo_inspector', $inspeccion->cargo_inspector) }}">
                        @error('cargo_inspector')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Estado <span class="text-danger">*</span></label>
                        <select name="estado" class="form-control @error('estado') is-invalid @enderror" required>
                            <option value="pendiente" {{ old('estado', $inspeccion->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_progreso" {{ old('estado', $inspeccion->estado) == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                            <option value="completada" {{ old('estado', $inspeccion->estado) == 'completada' ? 'selected' : '' }}>Completada</option>
                            <option value="aprobada" {{ old('estado', $inspeccion->estado) == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                            <option value="rechazada" {{ old('estado', $inspeccion->estado) == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                        </select>
                        @error('estado')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nivel de Riesgo</label>
                        <select name="nivel_riesgo" class="form-control @error('nivel_riesgo') is-invalid @enderror">
                            <option value="">Seleccione...</option>
                            <option value="bajo" {{ old('nivel_riesgo', $inspeccion->nivel_riesgo) == 'bajo' ? 'selected' : '' }}>Bajo</option>
                            <option value="medio" {{ old('nivel_riesgo', $inspeccion->nivel_riesgo) == 'medio' ? 'selected' : '' }}>Medio</option>
                            <option value="alto" {{ old('nivel_riesgo', $inspeccion->nivel_riesgo) == 'alto' ? 'selected' : '' }}>Alto</option>
                            <option value="critico" {{ old('nivel_riesgo', $inspeccion->nivel_riesgo) == 'critico' ? 'selected' : '' }}>Crítico</option>
                        </select>
                        @error('nivel_riesgo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha Próxima Inspección</label>
                        <input type="date" name="fecha_proxima_inspeccion" class="form-control @error('fecha_proxima_inspeccion') is-invalid @enderror" value="{{ old('fecha_proxima_inspeccion', $inspeccion->fecha_proxima_inspeccion ? $inspeccion->fecha_proxima_inspeccion->format('Y-m-d') : '') }}">
                        @error('fecha_proxima_inspeccion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" name="cumple_normativas" class="custom-control-input" id="cumple_normativas" {{ old('cumple_normativas', $inspeccion->cumple_normativas) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="cumple_normativas">Cumple con Normativas</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" rows="3">{{ old('observaciones', $inspeccion->observaciones) }}</textarea>
                        @error('observaciones')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Recomendaciones</label>
                        <textarea name="recomendaciones" class="form-control @error('recomendaciones') is-invalid @enderror" rows="3">{{ old('recomendaciones', $inspeccion->recomendaciones) }}</textarea>
                        @error('recomendaciones')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar Inspección
                </button>
                <a href="{{ route('inspeccion.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection