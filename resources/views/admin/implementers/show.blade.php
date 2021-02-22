@extends('layouts.admin')

@section('title', 'Implementer Profile')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/leaflet.css') }}">
@endsection

@section('content')

<div class="row">
	<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="">Personal Information</h3>
					<a href="{{ route('implementadores.edit', ['slug' => $user->slug]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
				</div>
				<div class="text-center user-info">
					<img src="{{ image_exist('/admins/img/users/', $user->photo, true) }}" width="90" height="90" alt="Foto de perfil">
					<p class="">{{ $user->name." ".$user->lastname }}</p>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled">
							<li class="contacts-block__item">
								<a href="mailto:{{ $user->email }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{ $user->email }}</a>
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>{{ $user->phone }}
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>{!! state($user->state) !!}
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
					<h3 class="pb-3">Implementer Information</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Title:</b> @if($user->implementer->title==1){{ "Certified" }}@else{{ "Professional" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>YPO Chapter:</b> {{ $user->implementer->ypo_chapter }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Service Area:</b> {{ $user->implementer->service_area }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Address:</b> {{ $user->implementer->address }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Facebook:</b> @if(!is_null($user->implementer->facebook) && !empty($user->implementer->facebook)){{ $user->implementer->facebook }}@else{{ "Not entered" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Twitter:</b> @if(!is_null($user->implementer->twitter) && !empty($user->implementer->twitter)){{ $user->implementer->twitter }}@else{{ "Not entered" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Linkedin:</b> @if(!is_null($user->implementer->linkedin) && !empty($user->implementer->linkedin)){{ $user->implementer->linkedin }}@else{{ "Not entered" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>YPO Url:</b> @if(!is_null($user->implementer->ypo_link) && !empty($user->implementer->ypo_link)){{ $user->implementer->ypo_link }}@else{{ "Not entered" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>EOS Url:</b> @if(!is_null($user->implementer->eos_link) && !empty($user->implementer->eos_link)){{ $user->implementer->eos_link }}@else{{ "Not entered" }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<a href="{{ route('implementadores.index') }}" class="btn btn-secondary">Go Back</a>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 layout-top-spacing">
		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Experience</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black">{!! $user->implementer->experience !!}</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 layout-top-spacing">
		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Location</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<div id="map" class="w-100" style="height: 300px;"></div>
								<input type="hidden" value="{{ $user->implementer->lat }}" id="lat">
								<input type="hidden" value="{{ $user->implementer->lng }}" id="lng">
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/leaflet/leaflet.js') }}"></script>
@endsection