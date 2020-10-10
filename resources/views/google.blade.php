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

	<input type="" name="">{{$geocoder[0]}}</input>


    @endsection

	@section( "piepagina" )


	@endsection