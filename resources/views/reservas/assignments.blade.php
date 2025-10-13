@extends('layouts.plantilla')

@section('cuerpo')
    <div class="card-header d-flex justify-content-between align-items-center">
        <div><h3 class="text-danger">Registre Asignacion de Recurso</h3></div>
            <div>
               <a class="btn btn-outline-primary btn-sm" href="{{ route('reservations.index') }}">Regresar</a>
            </div>
        </div>

    <hr style="border:2px;">




@push ('scripts')

@endpush
@endsection