
	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Hazmat - Index - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Consult Hazmat Information') !!}</h2>
		@include('derrame.messages')
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		  	@can('create evento')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Nuevo" href="derrame/create"><i class="icon-plus icon-2x"></i></a>
		    @endcan
		    @can('allow export')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Export" href="derrames/export/"><i class="icon-download-alt icon-2x"></i></a>
		    @endcan
		    @can('allow import')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Import" href="/derrames/importar"><i class="icon-cloud-upload icon-2x"></i></a>
		    @endcan
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Estadistica" href="derrames/grafic/"><i class="icon-filter icon-2x"></i> </a>
		  </li>
		</ul>
		<hr style="border:2px;">
		@include('derrame.search')
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
				@foreach($derrames as $derrame)
				<tr>
					<td>{{$derrame->id}}</td>
					<td>{{$derrame->incidente->nombre_incidente}}</td>
					<td>{{$derrame->station->nombre}}</td>
					<td>{{$derrame->fecha}}</td>
					<td align="left">{{$derrame->address}}</td>
					<td>
						@can('edit evento')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('derrame.edit',$derrame->id)}}"><i class="icon-edit"></i></a>
						@endcan
						@can('allow upload')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Forms SCI" href="/derrames/carga/{{$derrame->id}}"><i class="fa fa-upload" aria-hidden="true"></i></a>
						@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('derrame.show',$derrame->id)}}" role="button"><i class="icon-search"></i></a>
						@can('create pdf')
						<a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" title="PDF" href="/downloadPDFderrame/{{$derrame->id}}" ><i class="icon-file-text"></i></a>
						@endcan
						@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="icon-envelope"></i></a>
						@endcan

						{{-- <a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Enviar" href="{{action('MailController@SendMailsInundacion', $inundacion->id)}}" role="button"><i class="icon-envelope"></i></a> --}}


					</td>
				</tr>
				<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						    <div class="modal-content">
		      <form method="get" action="{{action('MailController@SendMailsDerrame', $derrame->id  )}}" class="form-horizontal">
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

		{{ $derrames -> appends(['searchText' => $query]) -> links() }}

@endsection @section( "piepagina" ) @endsection