@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
         <form action="inundacions/import/" method="post" enctype="multipart/form-data">
         	@csrf
         	<input type="file" name="file">
         	<button>Importar Informacion</button>
         </form>
    @endsection

	@section( "piepagina" )

	@endsection