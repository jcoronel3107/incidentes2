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
					<span title="Regresar" class="input-group-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
			</div>	
			<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('consultaentrefechas')}}">Regresar</i></a>
    </div> 
    <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="py-2 " id="container0"></div>
            </div>
        </div>
    </div>
    <div hidden  class="row">
        <div  class="col-xl-4 col-lg-4">
            
            <p class="text-info">Busqueda entre Fechas</p>
            <div class="py-2 " id="table0.1">
                    <table class="table table-sm" id="datatable0.1">
                        <thead>
                            <tr>
                            <th class="table-dark">vehiculo</th>
                                <th class="table-dark">fecha_carga</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($busquedaentrefechasclaveveh as $registro)
                            <tr>
                                <td class="table-light">{{$registro->codigodis}}</td>
                                <td class="table-light">{{strtotime($registro->created_at)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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

<script>
    Highcharts.chart('container0', {
        title: {
            text: 'Registros de cargas por vehiculo'
        },
        subtitle: {
            text: 'Fecha Desde: Fecha Hasta: '
        },
        yAxis: {
            gridLineWidth: 1,
            title: null,
            labels: {
            enabled: true
            }
        },
        xAxis: {
            type: 'datetime',
            visible: true
        },
        legend: {
            
            align: 'right',
            verticalAlign: 'middle'
        },
        data: {
            table: 'datatable0.1'
        },
        chart: {
            
            type: 'line'
        },
       
    });
</script>







@endpush
@endsection
@section( "piepagina" ) @endsection