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
        <form method="get" action="/busquedaentrefechas">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Incidente</label>
                <div class="col-sm-9">
                    <div class=" col-xl-8 col-lg-8">
                        <select class="selectpicker form-control" data-live-search="true" id="eventos" name="eventos" required="">
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
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Fecha Desde</label>
                <div class="col-sm-9">
                    <div class=" col-xl-8 col-lg-8">

                        <input type="date" required="" id="fechaD" name="fechaD" class="form-control">
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
            <div class="form-group row " id="divguardar">
                <input type="hidden" name="token" value="{{csrf_token()}}">
                <div class="col-sm-9">
                    <div class=" col-xl-8 col-lg-8">
                        <button type="submit" id="Enviar" name="Enviar" value="Enviar" data-toggle="tooltip" title="Buscar" class="btn btn-outline-success"><i class="icon-ok icon-2x"></i></button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>




@endsection
@section( "piepagina" ) @endsection