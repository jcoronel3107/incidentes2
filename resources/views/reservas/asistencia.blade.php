@extends('layouts.plantilla')

@section('cuerpo')
<div class="card-header d-flex justify-content-between align-items-center">
                        <div><h3 class="text-danger">Registre su Asistencia</h3></div>

                        <div>
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('reservations.index') }}">Regresar</a>
                        </div>
                    </div>

<hr style="border:2px;">
<button id="btnInit" >Find my location</button>
@push ('scripts')
<script src="/js/geoposicion.js" /></script> {{-- Geoposicion --}}
@endpush
@endsection