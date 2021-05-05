@extends( "layouts.plantilla" )

@section( "cabeza" )
<title>Usuarios - Index - BCBVC</title>
@endsection

@section( "cuerpo" )
<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Consult User Information') !!}</h2>
@include('user.messages')
<ul class="nav justify-content-end">
	<li class="nav-item">
		@can('create user')
		<a class="btn btn-outline-info" data-toggle="tooltip" title="Nuevo" href="{{ route('register') }}"><i class="icon-plus icon-2x"></i></a>
		@endcan
		@can('allow export')
		<a class="btn btn-outline-info" data-toggle="tooltip" title="Export" href=""><i class="icon-download-alt icon-2x"></i></a>
		@endcan
		@can('allow import')
		<a class="btn btn-outline-info" data-toggle="tooltip" title="Import" href="/users/importar/"><i class="icon-cloud-upload icon-2x"></i></a>
		@endcan
		
	</li>
</ul>
<hr style="border:2px;">
@include('user.search')

<table id="dataTable" class="table table-hover table-condensed" role="grid" aria-describedby="dataTable_info">
	<thead>
		<tr role="row" class="table-info">
			<th>id</th>
			<th>{!! trans('messages.name') !!}</th>
			<th>{!! trans('messages.E-Mail Address') !!}</th>
			<th>{!! trans('messages.avatar') !!}</th>
			<th>{!! trans('messages.position') !!}</th>
			<th>{!! trans('messages.Rols') !!}</th>
			<th>{!! trans('messages.status') !!}</th>
			<th>{!! trans('messages.Options') !!}</th>

		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td>{{$user->id}}</td>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td><img src="{{asset('storage/avatar/'.$user->avatar)}}" alt="avatar" width="30" height="30"></td>
			<td>{{$user->cargo}}</td>
			<td>{{$user->getRoleNames()}}</td>
			<td>{{$user->status}}</td>
			<td>
				@can('edit user')
				<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="profile/edit/{{$user->id}}"><i class="icon-edit"></i></a>
				@endcan
				
			</td>
		</tr>
		@endforeach

	</tbody>
	<tfoot>
		<tr class="table-info">
			<th>id</th>
			<th>{!! trans('messages.name') !!}</th>
			<th>{!! trans('messages.E-Mail Address') !!}</th>
			<th>{!! trans('messages.avatar') !!}</th>
			<th>{!! trans('messages.position') !!}</th>
			<th>{!! trans('messages.Rols') !!}</th>
			<th>{!! trans('messages.status') !!}</th>
			<th>{!! trans('messages.Options') !!}</th>

		</tr>
	</tfoot>
</table>
{{ $users -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection