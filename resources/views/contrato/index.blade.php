@extends( "layouts.plantilla" )

@section( "cabeza" )

		<title>Contratos_Clave14 - Index - BCBVC</title>
@endsection

@section( "cuerpo" )
		<h2 class="mt-2 shadow p-3 mb-2 bg-white rounded text-danger">Consultar Información de Contratos Clave_14</h2>
		@include('clave.messages')
		
		
		<ul class="nav nav-pills flex-column flex-sm-row ml-4"><!-- div botones acciones -->
					<li class="nav-item">
								<div class="input-group mb-3 ">
										@can('create event')	
										<div class="input-group-prepend">
											<span title="Nuevo" class="input-group-text"><i class="fas fa-plus"></i></span>
										</div>
										
										<a class="nav-link btn btn-outline-primary focus-in-expand" href="{{route('contrato.create')}}">{!! trans('messages.new') !!}</a>
										@endcan
								</div>
					</li>
		</ul>
		
	
		@include('contrato.search')
		<table class="table p-3 table-hover table-condensed">
			<thead>
				<tr class="table-info">
					<td>id</td>
					<td>{!! trans('messages.Gas Station') !!}</td>
					<td>{!! trans('messages.Denomination') !!}</td>
					<td>{!! trans('messages.Date') !!}</td>
					<td>{!! trans('messages.Term') !!}</td>
					<td>{!! trans('messages.Value') !!}</td>
					<td>{!! trans('messages.Options') !!}</td>
				</tr>

			</thead>
			<tbody>
				@foreach($contratos as $contrato)
				<tr>
					<td>{{$contrato->id}}</td>
					<td>{{$contrato->gasolinera->razonsocial}}</td>
					<td>{{$contrato->denominacion}}</td>
					<td>{{$contrato->fecha}}</td>
					<td>{{$contrato->plazo}} Dias</td>
					<td>USD ${{$contrato->valor}}</td>				
					<td>
					@can('edit event')
						<a class="btn btn-outline-info btn-sm " data-toggle="tooltip" title="Edit" href="{{route('contrato.edit',$contrato->id)}}"><i class="icon-edit"></i></a>
					@endcan
						<a class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Ver" href="{{route('contrato.show',$contrato->id)}}" role="button"><i class="icon-list"></i></a>
					
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{{ $contratos -> appends(['busq_denominacion' => $busq_denominacion],['busq_fecha'=>$busq_fecha]) -> links() }}
		
@endsection
@section( "piepagina" ) 
@endsection