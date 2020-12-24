
	@extends( "layouts.plantilla" )

	@section( "cabeza" )
	<title>Rescate - Index - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Consult Rescue Information') !!}</h2>
		@include('rescate.messages')
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		  	@can('create evento')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Nuevo" href="rescate/create"><i class="icon-plus icon-2x"></i></a>
		    @endcan
		    @can('allow export')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Export" href="rescates/export/"><i class="icon-download-alt icon-2x"></i></a>
		    @endcan
		    @can('allow import')
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Import" href="/rescates/importar"><i class="icon-cloud-upload icon-2x"></i></a>
		    @endcan
		    <a class="btn btn-outline-info" data-toggle="tooltip" title="Estadistica" href="rescates/grafic/"><i class="icon-filter icon-2x"></i> </a>
		  </li>
		</ul>
		<hr style="border:2px;">
		@include('rescate.search')

		<table id="dataTable" class="table table-hover table-condensed" role="grid" aria-describedby="dataTable_info">
			<thead>
				<tr role="row" class="table-primary">
					<th>id</th>
					<th>{!! trans('messages.Incident') !!}</th>
					<th>{!! trans('messages.Station') !!}</th>
					<th>{!! trans('messages.Date') !!}</th>
					<th>{!! trans('messages.Address') !!}</th>
					<th>{!! trans('messages.Options') !!}</th>

				</tr>
			</thead>
			<tbody>
				@foreach($rescates as $rescate)
				<tr>
					<td>{{$rescate->id}}</td>
					<td>{{$rescate->incidente->nombre_incidente}}</td>
					<td>{{$rescate->station->nombre}}</td>
					<td>{{$rescate->fecha}}</td>
					<td align="left">{{$rescate->direccion}}</td>
					<td>
						@can('edit evento')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('rescate.edit',$rescate->id)}}"><i class="icon-edit"></i></a>
						@endcan
						@can('allow upload')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Forms SCI" href="/rescates/carga/{{$rescate->id}}"><i class="fa fa-upload" aria-hidden="true"></i></a>
						@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('rescate.show',$rescate->id)}}" role="button"><i class="icon-search"></i></a>
						@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Enviar" href="{{action('MailController@SendMailsRescate', $rescate->id)}}" role="button"><i class="icon-envelope"></i></a>
						@endcan
						@can('create pdf')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('RescateController@downloadPDF', $rescate->id)}}" role="button"><i class="icon-file-text"></i></a>
						@endcan
					</td>
				</tr>
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
		{{ $rescates -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection