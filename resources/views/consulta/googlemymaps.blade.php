@extends( "layouts.plantilla" )

@section( "cabeza" )

<title>Add Map</title>
<style type="text/css">
      /* Set the size of the div element that contains the map */
      #map { height: 600px;width: 100%;}
    </style>
   
@endsection

@section( "cuerpo" )

<h3>My Google Maps</h3>

<ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Regresar" role="button" href="{{route('googlemymapsoptions')}}"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
		</li>
</ul>
<hr>
<div class="row">
    <div class=" col-lg-8 col-md-8 col-sm-12 input-group">
        <div class="input-group-prepend">
            <input class="form-control text-capitalize font-weight-bold"  value="Incidente" readonly>
        </div>
        <input class="form-control text-capitalize text-info" type="text" id="incidente" value="{{$tabla}}" readonly>
    </div>
</div>
<div class="row">
    <div class=" col-lg-4 col-md-4 col-sm-12 input-group">
        <div class="input-group-prepend">
            <input class="form-control  text-capitalize font-weight-bold" value="Fecha-Desde" readonly>
        </div>
        <input class="form-control text-info" type="text" id="fechad" value="{{$fechaD}}" readonly>
    </div>
    <div class=" col-lg-4 col-md-4 col-sm-12 input-group">
        <div class="input-group-prepend">
            <input class="form-control text-capitalize font-weight-bold" value="Fecha-Hasta" readonly>
        </div>
        <input class="form-control text-info " type="text" id="fechah" value="{{$fechaH}}" readonly>
    </div>
   
</div>
<hr>
<select hidden>
@foreach ($busquedaentrefechas as $geo)
{
    
    <option value="{{$geo->geoposicion}}">{{$geo->geoposicion}}</option>

}
@endforeach
</select>
<!--The div element for the map -->
<div id="map"></div>

@push ('scripts')
	
    <!-- Geolocalizacion  for all pages-->
	<script src="/js/marker-incidente.js"></script>
@endpush

@endsection
@section( "piepagina" ) @endsection