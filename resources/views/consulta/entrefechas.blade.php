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
    <div class="input-group mt-2 justify-content-end">  
            <div class="input-group-prepend">
					<span title="Grabar" class="input-group-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
			</div>	
			<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('consultaentrefechas')}}">Regresar</i></a>
    </div>
    
    <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">

                    <p style="text-align: center;" class="text-secondary" id="fch1">Fecha Desde: {{$fechaD}} &nbsp;&nbsp; Fecha Hasta: {{$fechaH}}</p>
                    <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$tabla}}</p>
                    <div class="py-2 " id="container0"></div>

            </div>
        </div>
        <hr>
        <div class="row mb-2 mt-2 justify-content-center "> <!-- Botones descarga -->
            @can('allow export')
                            @if($tabla=="saluds")
                                    <a class="btn btn-info mr-2" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="estadisticas/export3/{{$tabla}},{{$fechaD}},{{$fechaH}}">{!! trans('messages.download records') !!}</a>
                            @else
                                    <a class="btn btn-info mr-2" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="estadisticas/export/{{$tabla}},{{$fechaD}},{{$fechaH}}">{!! trans('messages.download records') !!}</a>
                            @endif
                            <a class="btn btn-info mr-2" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="estadisticas/export2/{{$tabla}},{{$fechaD}},{{$fechaH}}"></i>{!! trans('messages.response times') !!}</a>
            @endcan
        </div>
        <hr>
        <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <p style="text-align: center;" class="text-secondary" id="fch1">Fecha Desde: {{$fechaD}} &nbsp;&nbsp; Fecha Hasta: {{$fechaH}}</p>
                    <div class="py-2 " id="container0.2"></div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <p style="text-align: center;" class="text-secondary" id="fch1">Fecha Desde: {{$fechaD}} &nbsp;&nbsp; Fecha Hasta: {{$fechaH}}</p>
                    <div class="py-2 " id="container0.3"></div>
                </div>
        </div>
        <div class="row" hidden>
                
                 <div class="col-xl-4 col-lg-4">
                    <p class="text-info">Asistencia por Estaciones</p>
                    <div class="py-2 " id="table0.2">
                        <table class="table table-sm" id="datatable0.2">
                            <thead>
                                <tr>
                                    <th class="table-dark">Estación</th>
                                    <th class="table-dark">Asistencias</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Busquedaentrefechas_Estaciones as $registro)
                                <tr>
                                    <td class="table-light">{{($registro->nombre)}}</td>
                                    <td class="table-light">{{$registro->salidas}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-4">
                    <p class="text-info">Incidentes en Parroquias</p>
                    <div class="py-2 " id="table0.3">
                        <table class="table table-sm" id="datatable0.3">
                            <thead>
                                <tr>
                                    <th class="table-dark">Parroquia</th>
                                    <th class="table-dark">incidentes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Busquedaentrefechas_Parroquias as $registro)
                                <tr>
                                    <td class="table-light">{{($registro->nombre)}}</td>
                                    <td class="table-light">{{$registro->salidas}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-4">
                
                    <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$tabla}}</p>
                    <p class="text-info"> Busqueda entre Fechas</p>
                    <div class="py-2 " id="table0.1">
                        <table class="table table-sm" id="datatable0.1">
                            <thead>
                                <tr>
                                    <th class="table-dark">Incidente</th>
                                    <th class="table-dark">Asistencias</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($busquedaentrefechas as $registro)
                                <tr>
                                    <td class="table-light">{{($registro->nombre_incidente)}}</td>
                                    <td class="table-light">{{$registro->salidas}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                       
                    </div>

                </div>
        </div>
    </div>
   
</div>



@push ('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

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
            type: 'pie',
            style: {
            fontFamily: 'serif'
            }
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
            pointFormat: 'Porcentaje: <b>{point.percentage:.1f}%</b></br>Cant: <b>{point.y}</b>',

        },
        plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b></br>Porcentaje:<b> {point.percentage:.1f} %</b></br>Cant: <b>{point.y}</b>'
            }
        }
    },
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
            type: 'areaspline',
            style: {
            fontFamily: 'serif'
            }
        },
        title: {
            text: 'Estaciones Asistencia'
        },
        subtitle: {
            text: 'Grafica'
        },
        // Enable for x-axis
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            },
            crosshair: true
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>',

        },
        plotOptions: {
            areaspline: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.y}</b>'
            }
        }
    },
        // Enable for x-axis
        xAxis: {
            crosshair: true
        }
        
    });
</script>
<script>
    Highcharts.chart('container0.3', {
        data: {
            table: 'datatable0.3',
            name: 'Incidentes'
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'areaspline'
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
            pointFormat: '{point.name}:</br> <b>{point.y}</b>',

        },
        plotOptions: {
            areaspline: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.y}</b>'
            }
        }
    },
        // Enable for x-axis
        xAxis: {
            crosshair: true
        }
    });
</script>





@endpush
@endsection
@section( "piepagina" ) @endsection