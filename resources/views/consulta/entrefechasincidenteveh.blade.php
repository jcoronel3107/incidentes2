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
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                <p style="text-align: center;" class="text-secondary" id="fch1">Fecha Desde: {{$fechaD}} &nbsp;&nbsp; Fecha Hasta: {{$fechaH}}</p>
                <p style="text-transform: uppercase; text-align: center;" class="text-info" id="incidente">{{$codigodis->codigodis  }} en incidentes {{$tabla}}</p>
                

            </div>

            
        </div>
        <hr>
        <div class="row" >
                 <div class="col-xl-12 col-lg-12">
                    @if (!$busquedaentrefechasincidenteveh ->isEmpty())
                        {{"Cant_Registros:". $cant = $busquedaentrefechasincidenteveh ->count()}}
                        @foreach ($busquedaentrefechasincidenteveh as $registro) 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-dark">Id</td>
                                        <th scope="col" class="table-dark">Fecha</th>
                                        <th scope="col" class="table-dark">direccion</th>
                                        <th scope="col" class="table-dark">geoposicion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row" class="table-light">{{($registro->id)}}</td>
                                        <td class="table-light">{{($registro->fecha)}}</td>
                                        <td class="table-light">{{$registro->direccion}}</td>
                                        <td class="table-light">{{$registro->geoposicion}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-dark mr-2">ficha_ecu911.</th>
                                        <th scope="col" class="table-dark mr-2">H_fichaecu911.</th>
                                        <th scope="col" class="table-dark mr-5">H_salida_emerg.</th>
                                        <th scope="col" class="table-dark">H_llegada_Emerg.</th>
                                        <th scope="col" class="table-dark">H_fin_Emerg.</th>
                                        <th scope="col" class="table-dark">H_llegada_Emerg.</th>
                                        <th scope="col" class="table-dark">H_en_base.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-light">{{($registro->ficha_ecu911)}}</td>
                                        <td class="table-light">{{$registro->hora_fichaecu911}}</td>
                                        <td class="table-light">{{$registro->hora_salida_a_emergencia}}</td>
                                        <td class="table-light">{{($registro->hora_llegada_a_emergencia)}}</td>
                                        <td class="table-light">{{$registro->hora_fin_emergencia}}</td>
                                        <td class="table-light">{{$registro->hora_llegada_a_emergencia}}</td>
                                        <td class="table-light">{{$registro->hora_en_base}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>    
                                    <tr>
                                        <th scope="col" class="table-dark mr-2">informacion_inicial</th>
                                        <th scope="col" class="table-dark">detalle_emergencia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-light">{{($registro->informacion_inicial)}}</td>
                                        <td class="table-light">{{$registro->detalle_emergencia}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#f3f4f5" fill-opacity="1" d="M0,128L60,122.7C120,117,240,107,360,96C480,85,600,75,720,96C840,117,960,171,1080,186.7C1200,203,1320,181,1380,170.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
                            <hr>
                        @endforeach  
                    
                    @else
                        <p class="text-info">No Existen Registros</p>
                    @endif
                    
                </div>
        </div>
    </div>
</div>




@endsection
@section( "piepagina" ) @endsection