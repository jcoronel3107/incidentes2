	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Fuga - Index - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Consult Leak Information') !!}</h2>
		@include('fuga.messages')
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		  	@can('create evento')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Nuevo" href="fuga/create"><i class="icon-plus icon-2x"></i></a>
		    @endcan
			@can('allow export')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Export" href="fugas/export/"><i class="icon-download-alt icon-2x"></i></a>
		    @endcan
		    @can('allow import')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Import" href="/fugas/importar"><i class="icon-cloud-upload icon-2x"></i></a>
		    @endcan
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Estadistica" href="fugas/grafic/"><i class="icon-filter icon-2x"></i> </a>
		  </li>
		</ul>
		<hr style="border:2px;">

		@include('fuga.search')
		<table class="table table-hover table-condensed">
			<thead>
				<tr class="table-primary">
					<th>id</th>
					<th>{!! trans('messages.Incident') !!}</th>
					<th>{!! trans('messages.Station') !!}</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>{!! trans('messages.Address') !!}</th>					
					
					<th>{!! trans('messages.Options') !!}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($fugas as $fuga)
				<tr>
					<td>{{$fuga->id}}</td>
					<td>{{$fuga->incidente->nombre_incidente}}</td>
					<td>{{$fuga->station->nombre}}</td>
					<td>{{$fuga->fecha}}</td>
					<td>{{$fuga->direccion}}</td>
					
					<td>
						@can('edit evento')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('fuga.edit',$fuga->id)}}"><i class="icon-edit"></i></a>
						@endcan
						@can('allow upload')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Forms SCI" href="/fugas/carga/{{$fuga->id}}"><i class="fa fa-upload" aria-hidden="true"></i></a>
					@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('fuga.show',$fuga->id)}}" role="button"><i class="icon-search"></i></a>
						@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="icon-envelope"></i></a>
						@endcan
						@can('create pdf')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('FugaController@downloadPDF', $fuga->id)}}" role="button"><i class="icon-file-text"></i></a>
						@endcan

				</tr>
					<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <form method="get" action="{{action('MailController@SendMailsFuga', $fuga->id  )}}" class="form-horizontal">
				      <div class="modal-header">
				      		<h5 class="modal-title" id="exampleModalLabel">Destinatario</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      </div>
				      <div class="modal-body">
				      		<div class="input-group mb-3">
				  			<div class="input-group-prepend">
				    				<span class="input-group-text" id="basic-addon1">@</span>
				  			</div>
				  				<input name="email" type="email" class="form-control" placeholder="example@bomberos.gob.ec" aria-label="Username" aria-describedby="basic-addon1">
							</div>
				      </div>
				      <div class="modal-footer">
				       	 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				       	 <button type="submit" class="btn btn-primary">Enviar</button>
				      </div>
			      </form>
			    </div>
			  </div>
			</div>
				@endforeach
			</tbody>
			<tfoot>
				<tr class="table-primary">
					<th>id</th>
					<th>{!! trans('messages.Incident') !!}</th>
					<th>{!! trans('messages.Station') !!}</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>{!! trans('messages.Address') !!}</th>					
					
					<th>{!! trans('messages.Options') !!}</th>

					
					
					
					
				</tr>
			</tfoot>
		</table>

		{{ $fugas -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection