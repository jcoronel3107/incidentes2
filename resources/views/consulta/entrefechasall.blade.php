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
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">Todos</p>
                <div class="py-2 " id="container0"></div>

            </div>

            
        </div>
        
        <div class="row mb-2 mt-2 justify-content-center ">
            @can('allow export')
            <hr>
                <a class="btn btn-info mr-2" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="estadisticas/export/{{$tabla}},{{$fechaD}},{{$fechaH}}">{!! trans('messages.download records') !!}</a>                           
            @endcan
        </div>
      
      
       
        <div class="row" hidden> <!-- Tabla de datos -->
                
                 <div class="col-xl-4 col-lg-4">
                    <p class="text-info">Registros</p>
                    <div class="py-2 " id="table0">
                        <table class="table table-sm" id="datatable0">
                            <thead>
                                <tr>
                                    <th class="table-dark">nombre_incidente</th>
                                    <th class="table-dark">Cant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($EventosMensuales as $registro)
                                <tr>
                                    <td class="table-light">{{($registro->nombre_incidente)}}</td>
                                    <td class="table-light">{{$registro->salidas}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
            table: 'datatable0',
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
            pointFormat: '%: <b>{point.percentage:.1f}</b></br>#: <b>{point.y}</b>',

        },
        plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b></br>Porcentaje:<b> {point.percentage:.1f} %</b></br>Cantidad: <b>{point.y}</b>'
            }
        }
    },
    });
</script>


@endpush
@endsection
@section( "piepagina" ) @endsection