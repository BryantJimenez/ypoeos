@extends('layouts.web')

@section('title', 'Implementers List')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/clusters/MarkerCluster.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/clusters/MarkerCluster.Default.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/geosearch/geosearch.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section" id="map-implementer">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-6 col-12">
				<div class="w-100 rounded-3 mb-3" id="map"></div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="form-group col-12">
						<input type="text" class="form-control form-control-lg" placeholder="Search by Name" id="search-name" />
					</div>
					<div class="form-group col-12">
						<input type="text" class="form-control form-control-lg" name="address" placeholder="Search by City, State, or ZIP"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row" id="list-implementers">
			@foreach($implementers as $implementer)
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-4">
				<div class="card card-vertical-implementer rounded-3 py-2">
					<div class="card-body py-4">
						<div class="row">
							<div class="col-lg-5 col-12 mb-4">
								<img src="{{ image_exist('/admins/img/users/', $implementer->photo, true) }}" class="w-100 h-100 rounded-3" alt="{{ $implementer->name.' '.$implementer->lastname }}">
							</div>
							<div class="col-lg-7 col-12 mb-4">
								<h4 class="card-title text-primary font-weight-bold">{{ $implementer->lastname }}, {{ $implementer->name }}</h4>
								<p class="h6 text-muted mb-4">{{ $implementer->implementer->title }}</p>
								{{-- <p class="h6 text-muted">YPO Gold - Angeleno</p>
								<p class="h6 text-muted mb-4">Certified EOS Implementer</p> --}}
								<p class="h6 text-muted">{{ $implementer->implementer->address }}</p>
							</div>
							<div class="col-12">
								<a href="javascript:void(0);" class="btn btn-blue text-white rounded-3 py-2 px-4 mr-4 mb-2" onclick="sendMessageModal('{{ $implementer->slug }}')">Send Message</a>
								<a href="{{ route('implementer', ['slug' => $implementer->slug]) }}" class="btn btn-white text-blue font-weight-bold rounded-3 border py-2 px-4 mb-2">View More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col-12 text-center my-4">
				<a href="javaScript:void(0);" class="font-weight-bold" id="more-implementers">View More</a>
				<p class="text-center d-none" id="loader-more-implementers"><i class="fas fa-spinner fa-pulse text-primary"></i></p>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="#" method="POST" id="formSendMessage">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">Send Message</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							@include('admin.partials.errors')

							<p>Required fields (<b class="text-danger">*</b>)</p>
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Name<b class="text-danger">*</b></label>
									<input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Enter a name" value="{{ old('name') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Company<b class="text-danger">*</b></label>
									<input class="form-control form-control-lg @error('company') is-invalid @enderror" type="text" name="company" required placeholder="Enter a company name" value="{{ old('company') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Email<b class="text-danger">*</b></label>
									<input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Enter a email" value="{{ old('email') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Phone<b class="text-danger">*</b></label>
									<input class="form-control form-control-lg @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Enter a phone" value="{{ old('phone') }}" id="phone">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Message<b class="text-danger">*</b></label>
									<textarea class="form-control pl-3 pt-2 @error('message') is-invalid @enderror" name="message" placeholder="Enter a message" rows="4">{{ old('message') }}</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-blue rounded" action="send">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('/admins/vendor/leaflet/clusters/leaflet.markercluster.js') }}"></script>
<script src="{{ asset('/admins/vendor/leaflet/geosearch/bundle.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection