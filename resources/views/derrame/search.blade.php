<form method="get" action="/inundacion" autocomplete="off" role="search">
	<div class="form-group col-12">
		<div class="input-group ">
			<input id="estacion_id" name="estacion_id" hidden value="{{$estacion_id}}">
			<input type="text" class="form-control" value="{{$query}}" name="searchText" placeholder="Busca x Direccion...">
			<span class="input-group-append">
				<button type="submit" class="btn btn-primary">Buscar</button>
			</span>
		</div>
	</div>
</form>