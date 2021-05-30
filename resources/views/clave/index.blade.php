	@extends( "layouts.plantilla" )

	@section( "cabeza" )

	<title>Clave - Index - BCBVC</title>
	@endsection

	@section( "cuerpo" )
		<h2 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consultar Información de Clave_14</h2>
		@if(Session::has('Envio Mail Correcto'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{session('Envio Mail Correcto')}}
			<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif

		@if(Session::has('Registro_Borrado'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{session('Registro_Borrado')}}
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Registro_Actualizado'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('Registro_Actualizado')}}
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		@if(Session::has('Registro_Almacenado'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('Registro_Almacenado')}}
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		@endif
		<div class="row nav justify-content-end">
			<li class="nav-item">
				<div class="input-group mb-3">
									@can('create event')	
									<div class="input-group-prepend">
										<span title="Nuevo" class="input-group-text"><i class="fas fa-plus"></i></span>
									</div>
									
									<a class="btn btn-outline-primary focus-in-expand" href="{{route('clave.create')}}">{!! trans('messages.new') !!}</a>
									@endcan
									@can('allow export')
									<div class="input-group-prepend ml-2">
										<span title="Export" class="input-group-text"><i class="fas fa-file-export"></i></span>
									</div>
									
									<a class="btn btn-outline-secondary focus-in-expand" href="claves/export/">{!! trans('messages.export') !!}</a>
									@endcan
									@can('allow import')
									<div class="input-group-prepend ml-2">
										<span title="Import" class="input-group-text"><i class="fas fa-file-import"></i></span>
									</div>
									
									<a class="btn btn-outline-success focus-in-expand" href="claves/import/">{!! trans('messages.import') !!}</a>
									@endcan
									@can('estadistica')
									<div class="input-group-prepend ml-2">
										<span title="Grafic" class="input-group-text"><i class="fas fa-chart-line"></i></span>
									</div>
									
									<a class="btn btn-outline-info focus-in-expand" href="claves/grafic/">{!! trans('messages.grafic') !!}</a>
									@endcan
				
				</div>
			</li>
		</div>
		<hr style="border:2px;">
		@include('clave.search')
		<table class="table p-3 table-hover table-condensed">
			<thead>
				<tr class="table-info">
					<td>id</td>
					<td>{!! trans('messages.Order') !!}</td>
					<td>{!! trans('messages.Dollars') !!}</td>
					<td>{!! trans('messages.Gallons') !!}</td>
					<td>{!! trans('messages.Fuel') !!}</td>
					<td>{!! trans('messages.Gas Station') !!}</td>
					<td>{!! trans('messages.Driver') !!}</td>
					<td>{!! trans('messages.Vehicle') !!}</td>
					<td>{!! trans('messages.Options') !!}</td>

			</thead>
			<tbody>
				@foreach($claves as $clave)
				<tr>
					<td>{{$clave->id}}</td>
					<td>{{$clave->Orden}}</td>
					<td>USD ${{$clave->dolares}}</td>
					<td>{{$clave->galones}}</td>
					<td>{{$clave->combustible}}</td>
					<td>{{$clave->gasolinera->razonsocial}}</td>
					<td>{{$clave->user->name}}</td>
					<td>{{$clave->vehiculo->codigodis}}</td>
					<td>
					@can('edit event')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('clave.edit',$clave->id)}}"><i class="icon-edit"></i></a>
					@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('clave.show',$clave->id)}}" role="button"><i class="icon-list"></i></a>
					@can('send mail')
						<a class="btn btn-outline-info btn-sm" data-toggle="modal" title="Enviar" data-target="#exampleModal" role="button"><i class="icon-envelope"></i></a>
					@endcan
					@can('create pdf')
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="PDF" href="{{action('ClaveController@downloadPDF', $clave->id)}}" role="button"><i class="icon-file-text"></i></a>
					@endcan
					</td>
				</tr>
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <form method="get" action="{{action('MailController@SendMailsClave', $clave->id  )}}" class="form-horizontal">
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
				</tr>
			</tbody>
		</table>

		{{ $claves -> appends(['searchText' => $query]) -> links() }}
	@endsection
 @section( "piepagina" ) @endsection