<form method="get" action="/clave" autocomplete="off" role="search" >
<div class="form-group col-12">
	<div class="input-group "> {{csrf_field()}}
		<input type="text" class="form-control" value="{{$query}}" name="searchText" placeholder="Buscar x Fecha ...  AAAA-MM-DD" >
		<span class="input-group-append">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>
</form>
