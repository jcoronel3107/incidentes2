@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
    <h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Importación Eventos Fugas</h2>
         <form class="form" action="/fugas/import" method="post" enctype="multipart/form-data">
         	@csrf
         	<input type="file" name="file">
         	<button>Importar Información</button>
         </form>
    @endsection

	@section( "piepagina" )

	@endsection