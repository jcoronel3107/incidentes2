@extends( "layouts.plantilla" )

@section( "cabeza" )

    <title>Incidentes2 - BCBVC</title>

@endsection

@section( "cuerpo" )

    <div class="row">

        {{echo $ssd}}

    </div>

    @push ('scripts')
        <script src="/js/session.js"></script>

    @endpush
@endsection

@section( "piepagina" )


@endsection