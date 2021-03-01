	@if(Session::has('Envio Mail Correcto'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('Envio Mail Correcto')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	@endif

	@if(Session::has('Importacion_Correcta'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('Importacion_Correcta')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	@endif
	@if(Session::has('Registro_Borrado'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{session('Registro_Borrado')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	@endif
	@if(Session::has('Registro_Actualizado'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('Registro_Actualizado')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	@endif
	@if(Session::has('Registro_Almacenado'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('Registro_Almacenado')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	@endif
	@if(Session::has('Carga_Correcta'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('Carga_Correcta')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	@endif
	@if(Session::has('Carga_Incorrecta'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{session('Carga_Incorrecta')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	@endif
	@if(Session::has('Tamaño_Excedido'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{session('Tamaño_Excedido')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	@endif

	@if (session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ session('status') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
	</div>
	@endif


	@if (session('Rol Asignado'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ session('status') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
	</div>
	@endif