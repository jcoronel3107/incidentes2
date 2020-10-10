	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Incidente</h2>
		<h2>{{$incidente->id}}</h2>
@endsection
@section( "piepagina" ) @endsection