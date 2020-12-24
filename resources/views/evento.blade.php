@extends( "layouts.plantilla" )

	@section( "cabeza" )

		<style type="text/css">
			.clockdate-wrapper
			{
			    background-color: #333;
			    padding:25px;
			    max-width:350px;
			    width:100%;
			    text-align:center;
			    border-radius:5px;
			    margin:0 auto;

			}
			#clock{
			    background-color:#333;
			    font-family: sans-serif;
			    font-size:50px;
			    text-shadow:0px 0px 1px #fff;
			    color:#fff;
			}
			#clock span {
			    color:#888;
			    text-shadow:0px 0px 1px #333;
			    font-size:30px;
			    position:relative;
			    top:-27px;
			    left:-10px;
			}
			#date {
			    letter-spacing:10px;
			    font-size:14px;
			    font-family:arial,sans-serif;
			    color:#fff;
			}
		</style>

	@endsection

	@section( "cuerpo" )

        <div class="row">
                <h1> - {{$station}} - </h1></div>
    	<div  class="row">

                            <div class="col-xl-3 col-lg-3 col-md-4 sm-6">
                                <div class="card mb-4">

                                    <a class="collapse-item" target="_blank" href="/inundacion/create"><h5 class="card-header text-white bg-primary" ><i class="fas fa-fw fa-shower"></i> {!! trans('messages.flood') !!}</h5></a>

                                    <div class="card-body">
                                    	<p class="card-text text-black"> <h1>{{$mensualesInundacion}}</h1> {!! trans('messages.Current Month Events') !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div  class="col-xl-6 col-md-6" id="clockdate">
  								<div class="card mb-4 ">

  									<div class="card-body">
	  										<div class="clockdate-wrapper">
	    								<div id="clock"></div>
	    								<div id="date"></div>
	  										</div>
	  									</div>
	  							</div>
							</div>
                            <div class="col-xl-3 col-lg-3 col-md-4 sm-6">
                                <div class="card mb-4">
                                    <a class="collapse-item" target="_blank" href="/rescate/create"><h5 class="card-header text-white bg-secondary"><i class="fas fa-fw fa-life-ring"></i> {!! trans('messages.rescue') !!}</h5></a>
                                    
                                    <div class="card-body">
                                    	<p class="card-text text-black"> <h1>{{$mensualesInundacion}}</h1> {!! trans('messages.Current Month Events') !!}</p>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-3 col-lg-3 col-md-4 sm-6">
                                <div class="card mb-4">
                                    <a class="collapse-item" target="_blank" href="/derrame/create"><h5 class="card-header text-white bg-secondary"><i class="fas fa-fw fa-life-ring"></i> {!! trans('messages.Hazmat') !!}</h5></a>

                                    <div class="card-body">
                                    	<p class="card-text text-black"> <h1>{{$mensualesInundacion}}</h1> {!! trans('messages.Current Month Events') !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 sm-6">
                                <div class="card mb-4">
                                    <a class="collapse-item" target="_blank" href="/transito/create"><h5 class="card-header text-white bg-success"><i class="fas fa-fw fa-wrench"></i> {!! trans('messages.transit') !!}</h5></a>

                                    <div class="card-body">
                                    	<p class="card-text text-black"> <h1>{{$mensualesInundacion}}</h1> {!! trans('messages.Current Month Events') !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 sm-6">
                                <div class="card mb-4">
                                    <a class="collapse-item" target="_blank" href="/salud/create"><h5 class="card-header text-white bg-warning"><i class="fas fa-fw fa-heartbeat"></i> {!! trans('messages.Health') !!}</h5></a>

                                    <div class="card-body">
                                    	<p class="card-text text-black"> <h1>{{$mensualesInundacion}}</h1> {!! trans('messages.Current Month Events') !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 sm-6">
                                <div class="card mb-4">
                                    <a class="collapse-item" target="_blank" href="/fuego/create"><h5 class="card-header text-white bg-danger"><i class="fas fa-fw fa-fire"></i>{!! trans('messages.fire') !!}</h5></a>

                                    <div class="card-body">
                                    	<p class="card-text text-black"> <h1>{{$mensualesInundacion}}</h1> Eventos Mes Actual</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 sm-6">
                                <div class="card mb-4">
                                    <a class="collapse-item" target="_blank" href="/fuego/create"><h5 class="card-header text-white bg-info"><i class="fas fa-fw fa-fire-extinguisher"></i> {!! trans('messages.leak') !!}</h5></a>

                                    <div class="card-body">
                                    	<p class="card-text text-black"> <h1>{{$mensualesInundacion}}</h1> {!! trans('messages.Current Month Events') !!}</p>
                                    </div>
                                </div>
                            </div>
                            
        </div>

	@push ('scripts')
      <script type="text/javascript">
       function startTime() {
				    var today = new Date();
				    var hr = today.getHours();
				    var min = today.getMinutes();
				    var sec = today.getSeconds();
				    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
				    hr = (hr == 0) ? 12 : hr;
				    hr = (hr > 12) ? hr - 12 : hr;
				    //Add a zero in front of numbers<10
				    hr = checkTime(hr);
				    min = checkTime(min);
				    sec = checkTime(sec);
				    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;

				    var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
				    var days = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
				    var curWeekDay = days[today.getDay()];
				    var curDay = today.getDate();
				    var curMonth = months[today.getMonth()];
				    var curYear = today.getFullYear();
				    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
				    document.getElementById("date").innerHTML = date;

				    var time = setTimeout(function(){ startTime() }, 500);
				}
				
				function checkTime(i) {
				    if (i < 10) {
				        i = "0" + i;
				    }
				    return i;
				}
				</script> 
	@endpush
    @endsection

	@section( "piepagina" )


	@endsection