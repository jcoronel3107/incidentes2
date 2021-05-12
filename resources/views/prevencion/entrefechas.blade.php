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
    {{-- Contenedor General --}}
    <ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('consultaentrefechasmov')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
		</li>
	</ul>
    <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
        <div class="row">
            <div class="col-xl-8 col-lg-8">

                <p style="text-align: center;" class="text-info" id="fch1">Fecha Desde: {{$fechaD}} &nbsp;&nbsp; Fecha Hasta: {{$fechaH}}</p>
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$username->name}}</p>
                <div class="py-2 " id="container1"></div>

            </div>

            <div class="col-xl-4 col-lg-4">
                
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente"></p>
                <p class="text-info">Cant.Actividades Usuario Entre Fechas</p>
                <div class="py-2 " id="table0.1">
                    <table class="table table-sm" id="datatable0.1">
                        <thead>
                            <tr>
                                <th class="table-dark">Movilizacion</th>
                                <th class="table-dark">Cant.Actividades</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cant_actividades_usuario_entre_fechas as $registro)
                            <tr>
                                <td class="table-light">{{$registro->descripcion}}</td>
                                <td class="table-light">{{$registro->Cant_actividad}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <a class="btn btn-info" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="prevencions/export1/{{$conductor}},{{$fechaD}},{{$fechaH}}">Descarga Registros</a>
                    <hr>
		        	
		
                </div>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-8 col-lg-8">

                <p style="text-align: center;" class="text-info" id="fch1">Fecha Desde: {{$fechaD}} &nbsp;&nbsp; Fecha Hasta: {{$fechaH}}</p>
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$vehiculoname->codigodis}}</p>
                <div class="py-2 " id="container2"></div>

            </div>

            <div class="col-xl-4 col-lg-4">
                
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente"></p>
                <p class="text-info">Cant.Actividades Por Vehiculo Entre Fechas</p>
                <div class="py-2 " id="table0.2">
                    <table class="table table-sm" id="datatable0.2">
                        <thead>
                            <tr>
                                <th class="table-dark">Vehiculo</th>
                                <th class="table-dark">Cant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cant_actividades_vehiculo_entre_fechas as $registro)
                            <tr>
                                <td class="table-light">{{$registro->descripcion}}</td>
                                <td class="table-light">{{$registro->Cant_actividad}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <a class="btn btn-info" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="prevencions/export2/{{$vehiculo}},{{$fechaD}},{{$fechaH}}">Descarga Registros</a>
                    <hr>
		        	
                </div>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-8 col-lg-8">

                <p style="text-align: center;" class="text-info" id="fch1">Fecha Desde: {{$fechaD}} &nbsp;&nbsp; Fecha Hasta: {{$fechaH}}</p>
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">Todos</p>
                <div class="py-2 " id="container3"></div>

            </div>

            <div class="col-xl-4 col-lg-4">
                
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente"></p>
                <p class="text-info">Cant.Actividades Inspectores Entre Fechas</p>
                <div class="py-2 " id="table0.3">
                    <table class="table table-sm" id="datatable0.3">
                        <thead>
                            <tr>
                                <th class="table-dark">Movilizacion</th>
                                <th class="table-dark">Cant.Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cant_actividades_todosusuario_entre_fechas as $registro)
                            <tr>
                                <td class="table-light">{{$registro->descripcion}}</td>
                                <td class="table-light">{{$registro->Cant_actividad}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <a class="btn btn-info" data-toggle="tooltip" title="Descarga Archivo Excel" role="button" href="prevencions/export3/{{$fechaD}},{{$fechaH}}">Descarga Registros</a>
                    <hr>
		        	
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
    Highcharts.chart('container1', {
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
            text: 'Actividades'
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
    Highcharts.chart('container2', {
        data: {
            table: 'datatable0.2',
            name: 'Incidentes',
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Actividades'
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
    Highcharts.chart('container3', {
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
            text: 'Actividades'
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