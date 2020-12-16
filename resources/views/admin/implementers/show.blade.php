@extends('layouts.admin')

@section('title', 'Perfil de Familia')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="">Datos Personales</h3>
					<a href="{{ route('familias.edit', ['slug' => $people->slug]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
				</div>
				<div class="text-center user-info">
					<img src="{{ image_exist('/admins/img/users/', $people->photo, true) }}" width="90" height="90" alt="Foto de perfil">
					<p class="">{{ $people->name." ".$people->lastname }}</p>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled">
							<li class="contacts-block__item">
								<a href="mailto:{{ $people->email }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{ $people->email }}</a>
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>{!! state($people->state) !!}
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-8 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos del Cuidador</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Dirección:</b> @if(!is_null($people->locality()->withTrashed()->first()) && !is_null($people->locality()->withTrashed()->first()->province()->withTrashed()->first())){{ $people->locality()->withTrashed()->first()->province()->withTrashed()->first()->name." - " }}@endif @if(!is_null($people->locality()->withTrashed()->first())){{ $people->locality()->withTrashed()->first()->name }}@else{{ "No ingresado" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Fecha de Nacimiento:</b> {{ date("d-m-Y", strtotime($people->birthday)) }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Edad:</b> {{ age($people->birthday) }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Tipo de Educación:</b> @if(!is_null($people->education()->withTrashed()->first())){{ $people->education()->withTrashed()->first()->name }}@else{{ "No ingresado" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Disponibilidad:</b> @if(!is_null($people->available()->withTrashed()->first())){{ $people->available()->withTrashed()->first()->name }}@else{{ "No ingresado" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<a href="{{ route('familias.index') }}" class="btn btn-secondary">Volver</a>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>
</div>

@endsection