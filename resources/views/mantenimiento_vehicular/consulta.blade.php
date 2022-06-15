@extends( "layouts.plantilla" )

@section( "cabeza" )

@endsection

@section( "cuerpo" )

    <div class="tab-content" id="myTabContent"><!-- Contenedor General !-->
        <form method="get" action="/search_bitacora">
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-sm-right">Fecha Desde</label>
                    <div class="col-sm-9">
                        <div class=" col-xl-8 col-lg-8">

                            <input type="datetime-local" required id="fechaD" name="fechaD" min="2014-01-01" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-sm-right">Fecha Hasta</label>
                    <div class="col-sm-9">
                        <div class=" col-xl-8 col-lg-8">
                            <input type="datetime-local" required id="fechaH" min="2014-01-01" name="fechaH" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-sm-right">Vehiculo</label>
                    <div class="col-sm-9">
                        <div class=" col-xl-8 col-lg-8">
                            <select class="selectpicker form-control" data-live-search="true" id="Vehiculo" name="Vehiculo" required>
                                
                                <option value="">Seleccione...</option>
                                @foreach($Listvehiculos as $vehiculo)
                                <option value={{$vehiculo->codigo}}>{{$vehiculo->codigodis}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-sm-right">Aprobado</label>
                    <div class="col-sm-9">
                        <div class=" col-xl-8 col-lg-8">
                            <select class="selectpicker form-control" data-live-search="true" id="aprobado" name="aprobado" required>
                                <option value="">Seleccione...</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-sm-right">Liquidado</label>
                    <div class="col-sm-9">
                        <div class=" col-xl-8 col-lg-8">
                            <select class="selectpicker form-control" data-live-search="true" id="liquidado" name="liquidado" required>
                                <option value="">Seleccione...</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
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
    </div>

@endsection

@section( " piepagina " ) 
@endsection