@extends('layouts.admin')

@section('title', 'Implementers List')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Implementers List</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						<div class="text-right">
							<a href="{{ route('implementadores.create') }}" class="btn btn-primary">New</a>
						</div>

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Email</th>
										<th>Disponibilidad</th>
										<th>State</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($implementers as $implementer)
									<tr>
										<td>{{ $num++ }}</td>
										<td class="d-flex">
											<img src="{{ image_exist('/admins/img/users/', $implementer->photo, true) }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $implementer->name." ".$implementer->lastname }}"> {{ $implementer->name." ".$implementer->lastname }}
										</td>
										<td>{{ $implementer->email }}</td>
										<td>@if(!is_null($implementer->available()->withTrashed()->first())){{ $implementer->available()->withTrashed()->first()->name }}@else{{ "No ingresado" }}@endif</td>
										<td>{!! state($implementer->state) !!}</td>
										<td>
											<div class="btn-group" role="group">
												<a href="{{ route('familias.show', ['slug' => $implementer->slug]) }}" class="btn btn-primary btn-sm bs-tooltip" title="Perfil"><i class="fa fa-user"></i></a>
												<a href="{{ route('familias.edit', ['slug' => $implementer->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="Editar"><i class="fa fa-edit"></i></a>
												{{-- @if($implementer->state==1)
												<button type="button" class="btn btn-warning btn-sm bs-tooltip" title="Desactivar" onclick="deactiveImplementer('{{ $implementer->slug }}')"><i class="fa fa-power-off"></i></button>
												@else
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="Activar" onclick="activeImplementer('{{ $implementer->slug }}')"><i class="fa fa-check"></i></button>
												@endif
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Eliminar" onclick="deleteImplementer('{{ $implementer->slug }}')"><i class="fa fa-trash"></i></button> --}}
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

<div class="modal fade" id="deactiveImplementer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres desactivar esta implementador?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="formDeactiveImplementer">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Desactivar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="activeImplementer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres activar este implementador?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="formActiveImplementer">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Activar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteImplementer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar este implementador?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="formDeleteImplementer">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-primary">Eliminar</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/jszip.min.js') }}"></script>    
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection