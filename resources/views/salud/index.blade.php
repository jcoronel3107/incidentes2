	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Salud - Index - BCBVC</title>
	@endsection

	@section( "cuerpo" )
	<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Información de Salud</h2>
	@include('salud.messages')
	<ul class="nav justify-content-end">
		<li class="nav-item">
			@can('create evento')
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Nuevo" href="salud/create"><i class="icon-plus icon-2x"></i></a>
			@endcan
			@can('allow export')
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Export" href="saluds/export/"><i class="icon-download-alt icon-2x"></i></a>
			@endcan
			@can('allow import')
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Import" href="/saluds/importar"><i class="icon-cloud-upload icon-2x"></i></a>
			@endcan
			<a class="btn btn-outline-info" data-toggle="tooltip" title="Estadistica" href="saluds/grafic/"><i class="icon-filter icon-2x"></i> </a>
		</li>

	</ul>
	<hr style="border:2px;">
	@include('salud.search')
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
			@foreach($saluds as $salud)
			<tr>
				<td>{{$salud->id}}</td>
				<td>{{$salud->incidente->nombre_incidente}}</td>
				<td>{{$salud->station->nombre}}</td>
				<td>{{$salud->fecha}}</td>
				<td>{{$salud->direccion}}</td>
				<td>
					@can('edit evento')
					<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('salud.edit',$salud->id)}}"><i class="icon-edit"></i></a>
					@endcan
					@can('allow upload')
					<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Forms SCI" href="/saluds/carga/{{$salud->id}}"><i class="fa fa-upload" aria-hidden="true"></i></a>
					@endcan
					<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('salud.show',$salud->id)}}" role="button"><i class="icon-search"></i></a>
					@can('send mail')
					<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Enviar" href="{{action('MailController@SendMailsSalud', $salud->id)}}" role="button"><i class="icon-envelope"></i></a>
					@endcan
					@can('create pdf')
					<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('SaludController@downloadPDF', $salud->id)}}" role="button"><i class="icon-file-text"></i></a>
					@endcan


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
	{{ $saluds -> appends(['searchText' => $query]) -> links() }}

	@endsection @section( "piepagina" ) @endsection