@extends( "layouts.plantilla" )

@section( "cabeza" )


@endsection

@section( "cuerpo" )
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">Busqueda entre Fechas</a>
    </li>
   
</ul>

<div class="tab-content" id="myTabContent">
    <!-- Contenedor General  -->
    <ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('consultaentrefechas')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
		</li>
	</ul>
    <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
        <div class="row">
            <div class="col-xl-8 col-lg-8">

                <p style="text-align: center;" class="text-info" id="fch1">Fecha Desde: {{$fechaDgas}} &nbsp;&nbsp; Fecha Hasta: {{$fechaHgas}}</p>
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$tabla}}</p>
                <div class="py-2 " id="container0"></div>

            </div>

            <div class="col-xl-4 col-lg-4">
                
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$tabla}}</p>
                <p class="text-info">Busqueda entre Fechas</p>
                <div class="py-2 " id="table0.1">
                    <table class="table table-sm" id="datatable0.1">
                        <thead>
                            <tr>
                                <th class="table-dark">razonsocial</th>
                                <th class="table-dark">Asistencias</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Busquedaentrefechas_xcombustible as $registro)
                            <tr>
                                <td class="table-light">{{($registro->codigodis)}}</td>
                                <td class="table-light">{{$registro->NumCargas}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    @can('allow export')
                        @if($tabla=="saluds")
                                <a class="btn btn-info" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="estadisticas/export3/{{$tabla}},{{$fechaD}},{{$fechaH}}">{!! trans('messages.download records') !!}</a>
                        @else
                                <a class="btn btn-info" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="estadisticas/export/{{$tabla}},{{$fechaD}},{{$fechaH}}">{!! trans('messages.download records') !!}</a>
                        @endif
                    <hr>
		        	<a class="btn btn-info" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="estadisticas/export2/{{$tabla}},{{$fechaD}},{{$fechaH}}"></i>{!! trans('messages.response times') !!}</a>
                    @endcan
                </div>

            </div>
        </div>
        <hr>
        
        

        
    </div>
   
</div>



@push ('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
{{-- Pestaña General --}}
<script>
    Highcharts.chart('container0', {
        data: {
            table: 'datatable0.1',
            name: 'Incidentes',
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Incidentes'
        },
        subtitle: {
            text: 'Grafica'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',

        }
    });
</script>
<script>
    Highcharts.chart('container0.2', {
        data: {
            table: 'datatable0.2',
            name: 'Incidentes',
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'bar'
        },
        title: {
            text: 'Estaciones Asistencia'
        },
        subtitle: {
            text: 'Grafica'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}#</b>',

        }
    });
</script>
<script>
    Highcharts.chart('container0.3', {
        data: {
            table: 'datatable0.3',
            name: 'Incidentes',
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Incidentes en Parroquias'
        },
        subtitle: {
            text: 'Grafica'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',

        }
    });
</script>





@endpush
@endsection
@section( "piepagina" ) @endsection