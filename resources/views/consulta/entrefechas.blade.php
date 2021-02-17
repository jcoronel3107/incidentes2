@extends( "layouts.plantilla" )

@section( "cabeza" )


@endsection

@section( "cuerpo" )
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">General</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    {{-- Contenedor General --}}
    <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
        <div class="row">
            <div class="col-xl-8 col-lg-8">

                <div class="py-2 " id="container0"></div>

            </div>

            <div class="col-xl-4 col-lg-4">

                <div class="py-2 " id="table0.1">
                    <table class="table table-sm" id="datatable0.1">
                        <thead>
                            <tr>
                                <th class="table-dark">Incidente</th>
                                <th class="table-dark">Asistencias</th>
                            </tr>
                        </thead>
                        <tbody>
                           
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
            text: 'Incidentes Por Tipo (Anual)'
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