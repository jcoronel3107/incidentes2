@extends( "layouts.plantilla" )

@section( "cabeza" )


@endsection

@section( "cuerpo" )
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="General" aria-selected="true">General</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="Claves-tab" data-toggle="tab" href="#Claves" role="tab" aria-controls="Claves" aria-selected="true">Claves14</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <!-- Contenedor General !-->
    <div class="tab-pane fade show active" id="General" role="tabpanel" aria-labelledby="General-tab">
        <form method="get" action="/busquedaentrefechas">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Incidente</label>
                <div class="col-sm-9">
                    <div class=" col-xl-8 col-lg-8">
                        <select class="selectpicker form-control" data-live-search="true" id="eventos" name="eventos" required="">
                            <option value="">Seleccione...</option>
                            <option value="derrames">Derrames</option>
                            <option value="fugas">Fugas</option>
                            <option value="incendios">Incendios</option>
                            <option value="inundacions">Inundaciones</option>
                            <option value="rescates">Rescates</option>
                            <option value="saluds">Salúd</option>
                            <option value="transitos">Tránsito</option>
                            <option value="*">Todos</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Fecha Desde</label>
                <div class="col-sm-9">
                    <div class=" col-xl-8 col-lg-8">

                        <input type="date" required="" id="fechaD" name="fechaD" min="2021-01-01" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Fecha Hasta</label>
                <div class="col-sm-9">
                    <div class=" col-xl-8 col-lg-8">
                        <input type="date" required="" id="fechaH" name="fechaH" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row " id="divguardarIncidente">
                <input type="hidden" name="token" value="{{csrf_token()}}">
                
                <div class="input-group mb-3 justify-content-end">
						<div class="input-group-prepend">
							<span title="Grabar" class="input-group-text"><i class="fas fa-check"></i></span>
						</div>						
                        <button type="submit" id="EnviarIncidente" name="EnviarIncidente" value="Enviar" data-toggle="tooltip" title="Buscar" class="btn btn-outline-success">Consultar</button>
						<div class="input-group-prepend">
							<span title="Regresar" class="input-group-text"><i class="fas fa-arrow-left"></i></span>
						</div>
						<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('consulta.index')}}">Regresar</a>
				</div>	
            </div>
        </form>
        <hr>
        <form method="GET" action="/busquedaentrefechasincidenteveh">
            <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-sm-right">Incidente</label>
                    <div class="col-sm-9">
                        <div class=" col-xl-8 col-lg-8">
                            <select class="selectpicker form-control" data-live-search="true" id="eventosveh" name="eventosveh" required="">
                                <option value="">Seleccione...</option>
                                <option value="derrames">Derrames</option>
                                <option value="fugas">Fugas</option>
                                <option value="incendios">Incendios</option>
                                <option value="inundacions">Inundaciones</option>
                                <option value="rescates">Rescates</option>
                                <option value="saluds">Salúd</option>
                                <option value="transitos">Tránsito</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="form-group row mt-2">
                <label class="col-sm-3 col-form-label text-sm-right">Vehiculo</label>
                <div class=" col-xl-9 col-lg-9 col-md-12 col-sm-12">
                        <select class="selectpicker form-control" data-live-search="true" id="vehicle" name="vehicle" required>
                            <option value="">Seleccione Vehiculo...</option>
                           
                            @foreach ($vehicle as $registro)
                                <option value="{{$registro->id}}">{{$registro->codigodis}}</option>   
                            @endforeach
                        </select>
                </div>  
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Fecha Desde</label>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <input type="date" required id="fechaDvehicle" name="fechaDvehicle" min="2021-01-01" class="form-control">
                    </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Fecha Hasta</label>
                
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <input type="date" required id="fechaHvehicle" name="fechaHvehicle" class="form-control">
                    </div>
            </div>
            <div class="form-group" id="divguardarvehicle">
                <input type="hidden" name="token" value="{{csrf_token()}}">
                
                <div class="input-group mb-3 justify-content-end">
						<div class="input-group-prepend">
							<span title="Grabar" class="input-group-text"><i class="fas fa-check"></i></span>
						</div>						
						<button type="submit" id="Enviarvehicle" name="Enviarvehicle" value="Enviar" data-toggle="tooltip" title="Buscar" class="btn btn-outline-success">Consultar</button>
						<div class="input-group-prepend">
							<span title="Regresar" class="input-group-text"><i class="fas fa-arrow-left"></i></span>
						</div>
						<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('consulta.index')}}">Regresar</a>
				 </div>	
            </div>
        </form>
    </div>

    <!-- Contenedor Clave14 !-->
    <div class="tab-pane fade" id="Claves" role="tabpanel" aria-labelledby="Claves-tab">
        <form method="get" action="/busquedaentrefechasclave">
            <div class="form-group row mt-2">
                <label class="col-sm-3 col-form-label text-sm-right">Proveedor</label>
                
                <div class=" col-xl-9 col-lg-9 col-md-12 col-sm-12">
                        <select class="selectpicker form-control" data-live-search="true" id="gastation" name="gastation" required>
                            <option value="">Seleccione Proveedor...</option>
                           
                            @foreach ($gastation as $registro)
                                <option value="{{$registro->id}}">{{$registro->razonsocial}}</option>   
                            @endforeach
                        </select>
                </div>
                
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Fecha Desde</label>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <input type="date" required id="fechaDgas" name="fechaDgas" min="2021-01-01" class="form-control">
                    </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Fecha Hasta</label>
                
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <input type="date" required id="fechaHgas" name="fechaHgas" class="form-control">
                    </div>
            </div>
            <div class="form-group" id="divguardarClave">
                <input type="hidden" name="token" value="{{csrf_token()}}">
                
                <div class="input-group mb-3 justify-content-end">
						<div class="input-group-prepend">
							<span title="Grabar" class="input-group-text"><i class="fas fa-check"></i></span>
						</div>						
						<button type="submit" id="EnviarClave" name="EnviarClave" value="Enviar" data-toggle="tooltip" title="Buscar" class="btn btn-outline-success">Consultar</button>
						<div class="input-group-prepend">
							<span title="Regresar" class="input-group-text"><i class="fas fa-arrow-left"></i></span>
						</div>
						<a class="btn btn-outline-secondary" data-toggle="tooltip" title="Regresar" role="button" href="{{ route('consulta.index')}}">Regresar</a>
				 </div>	
            </div>
        </form>
        
        
    </div>

    
    <div id='resultado' class="col-xl-12 col-lg-12""></div>
</div>




@endsection
@section( " piepagina " ) @endsection