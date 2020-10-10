@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
    <h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Importación CIE10</h2>
         <form class="form" action="/cie10/import" method="post" enctype="multipart/form-data">
         	@csrf
         	<input type="file" name="file">
         	<button>Importar CIE10</button>
         </form>
    @endsection

	@section( "piepagina" )

	@endsection