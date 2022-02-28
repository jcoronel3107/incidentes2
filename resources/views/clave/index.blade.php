@extends( "layouts.plantilla" )

@section( "cabeza" )

		<title>Clave - Index - BCBVC</title>
@endsection

@section( "cuerpo" )
		<h2 class="mt-2 shadow p-3 mb-2 bg-white rounded text-danger">Consultar Información de Clave_14</h2>
		@include('clave.messages')
		
		<div class="row justify-content-between focus-in-expand"><!-- div Informacion -->
			
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
				<div class="card mb-5 text-white text-lg o-hidden ">
					<div class="card-body text-white bg-info">
						<div class="card-body-icon">
							<i class="fas fa-money-check-alt"></i>
					    </div>
						<div class="card-text">
							<h5> {!! trans('messages.Monthly Fuel Consumption') !!}</h5>$. {{$SumaValClaves}} USD.
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
				<div class="card mb-5 text-white text-sm o-hidden ">
					<div class="card-body text-white bg-warning">
						<div class="card-body-icon">
							<i class="fas fa-money-check-alt"></i>
						</div>
						<div class="card-text">
							<h5>Detalle Consumo $</h5> 
							@foreach($gasaccumulatedmonthly as $item)
								{{$item->combustible}} ==> $. {{$item->accumulated_monthly}} USD.</br>
							@endforeach
						</div>
					</div>
				</div>
			</div>
					
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
					<div class="card mb-5 text-white text-sm o-hidden ">
						<div class="card-body text-white bg-secondary">
							<div class="card-body-icon"><i class="fas fa-gas-pump"></i></div>
								<div class="card-text">
									<h5>Detalle Consumo Glns</h5> 
								</div>	
								@foreach($gasstationexpenses as $item)
									{{$item->combustible}} ==> {{$item->Glns}} Glns.</br>
								@endforeach
							</div>
						</div>
					</div>
				</div>	
			</div>
			
		</div>
		
		<ul class="nav nav-pills flex-column flex-sm-row ml-4"><!-- div botones acciones -->
					<li class="nav-item">
								<div class="input-group mb-3 ">
										@can('create event')	
										<div class="input-group-prepend">
											<span title="Nuevo" class="input-group-text"><i class="fas fa-plus"></i></span>
										</div>
										
										<a class="nav-link btn btn-outline-primary focus-in-expand" href="{{route('clave.create')}}">{!! trans('messages.new') !!}</a>
										@endcan
								</div>
					</li>
					<li class="nav-item">
								<div class="input-group mb-3 ">
										@can('allow export')
										<div class="input-group-prepend ml-2">
											<span title="Export" class="input-group-text"><i class="fas fa-file-export"></i></span>
										</div>
										<a class="nav-link btn btn-outline-secondary focus-in-expand" href="claves/export/">{!! trans('messages.export') !!}</a>
										@endcan
								</div>
					</li>	
					<li class="nav-item">
						<div class="input-group mb-3 ">
										@can('allow import')
										<div class="input-group-prepend ml-2">
											<span title="Import" class="input-group-text"><i class="fas fa-file-import"></i></span>
										</div>
										
										<a class="nav-link btn btn-outline-success focus-in-expand" href="claves/import/">{!! trans('messages.import') !!}</a>
										@endcan
						</div>
					</li>
					<li class="nav-item">
						<div class="input-group mb-3 ">
										@can('estadistica')
										<div class="input-group-prepend ml-2">
											<span title="Grafic" class="input-group-text"><i class="fas fa-chart-line"></i></span>
										</div>
										
										<a class="nav-link btn btn-outline-info focus-in-expand" href="claves/grafic/">{!! trans('messages.grafic') !!}</a>
										@endcan
						</div>
					</li>
					
					
				
		</ul>
		
	
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
				</tr>

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
				
				<!-- </tr> -->
				@endforeach
			</tbody>
		</table>

		{{ $claves -> appends(['searchText' => $query]) -> links() }}
		
@endsection
@section( "piepagina" ) 
@endsection