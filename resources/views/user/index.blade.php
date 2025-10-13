@extends( "layouts.plantilla" )

@section( "cabeza" )
<title>Usuarios - Index - BCBVC</title>
@endsection

@section( "cuerpo" )
<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">{!! trans('messages.Consult User Information') !!}</h2>
@include('user.messages')
<div class="row nav justify-content-end">
			<li class="nav-item">
				<div class="input-group mb-3">
							@can('create movilizacion')
							<div class="input-group-prepend">
								<span title="Nuevo" class="input-group-text"><i class="fas fa-plus"></i></span>
							</div>
								<a class="btn btn-outline-primary" href="{{ route('register') }}">{!! trans('messages.new') !!}</a>
							@endcan
							
							@can('allow import')
							<div class="input-group-prepend ml-2">
								<span title="Grafic" class="input-group-text"><i class="icon-cloud-upload"></i></span>
							</div>
							<a class="btn btn-outline-info" href="/users/importar/">{!! trans('messages.import') !!}</a>
							@endcan
				</div> 
			</li>
		</div>

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