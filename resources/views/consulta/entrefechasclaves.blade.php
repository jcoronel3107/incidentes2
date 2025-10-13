@extends( "layouts.plantilla" )

@section( "cabeza" )


@endsection

@section( "cuerpo" )
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">Busqueda entre Fechas</a>
    </li>
   
</ul>

<div class="tab-content" id="myTabContent"><!-- Contenedor General  -->
    
    <div class="input-group mt-2 justify-content-end">
            <div class="input-group-prepend">
					<span title="Regresar" class="input-group-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
			</div>	
			<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('consultaentrefechas')}}">Regresar</a>
    </div>
    <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
        <div class="row"><!-- Vehiculos abastecidos -->
            <div class="col-xl-12 col-lg-12">
            <p style="text-align: center;" class="text-info" id="fch1">{{$gastationname->razonsocial}}</p>
                <p style="text-align: center;" class="text-info" id="fch1">Fecha Desde: {{$fechaDgas}} &nbsp;&nbsp; Fecha Hasta: {{$fechaHgas}}</p>
                
                <div class="py-2 " id="container0.1"></div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-6 col-lg-6"><!-- Abastecimientos x combustible -->
                <div class="py-2 " id="container0.2"></div>
            </div>
            <div class="col-xl-6 col-lg-6"><!-- Abastecimientos x gasolinera -->
                <div class="py-2 " id="container0.3"></div>
            </div>
        </div>
      
        <div hidden class="row">
            <div hidden class="col-xl-4 col-lg-4">
                
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
                            @foreach ($Busquedaentrefechas_xvehiculo as $registro)
                            <tr>
                                <td class="table-light">{{($registro->codigodis)}}</td>
                                <td class="table-light">{{$registro->NumCargas}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    @can('allow export')
                    <a class="btn btn-info" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="estadisticas/export4/{{$tabla}},{{$fechaDgas}},{{$fechaHgas}}">{!! trans('messages.download records') !!}</a>
                    @endcan
                </div>

            </div>
            <div  class="col-xl-4 col-lg-4">
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$tabla}}</p>
                <p class="text-info">Busqueda entre Fechas</p>
                <div class="py-2 " id="table0.2">
                    <table class="table table-sm" id="datatable0.2">
                        <thead>
                            <tr>
                                <th class="table-dark">Combustible</th>
                                <th class="table-dark">NumCargaxCombustible</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Busquedaentrefechas_xcombustible as $registro)
                            <tr>
                                <td class="table-light">{{($registro->combustible)}}</td>
                                <td class="table-light">{{$registro->NumCargaxCombustible}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>

            </div>
            <div  class="col-xl-4 col-lg-4">
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$tabla}}</p>
                <p class="text-info">Busqueda entre Fechas</p>
                <div class="py-2 " id="table0.3">
                    <table class="table table-sm" id="datatable0.3">
                        <thead>
                            <tr>
                                <th class="table-dark">Combustible</th>
                                <th class="table-dark">Abastecimientos x Gasolinera</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($busquedaentrefechas_xgasolineras as $registro)
                            <tr>
                                <td class="table-light">{{($registro->razonsocial)}}</td>
                                <td class="table-light">{{$registro->Num_cargas}}</td>
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
<script src="https://code.highcharts.com/cylinder.js"></script>

<script>/* Vehiculos abastecidos */
    Highcharts.chart('container0.1', {
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
            text: 'Vehiculos Abastecidos'
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
<script>/* Abastecimientos x combustible */
    Highcharts.chart('container0.2', {
        data: {
            table: 'datatable0.2',
            name: 'Incidentes',
        },
        chart: {
            type: 'column'
            
        },
        plotOptions: {
            series: {
            depth: 25,
            colorByPoint: true
            }
        },
        title: {
            text: 'Abastecimientos x Combustible'
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
<script>/* Abastecimientos x gasolinera */
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
            text: 'Abastecimiento por Gasolinera'
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