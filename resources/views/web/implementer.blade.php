@extends('layouts.web')

@section('title', 'Implementer Profile')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="ftco-section py-5" id="basic-profile">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-12 mx-auto">
				<div class="row">
					<div class="col-xl-5 col-lg-5 col-12 text-center mb-4">
						<img src="{{ image_exist('/admins/img/users/', $user->photo, true) }}" class="rounded-circle" alt="{{ $user->name.' '.$user->lastname }}">
					</div>
					<div class="col-xl-7 col-lg-7 col-12 mb-4">
						<h1 class="card-title text-primary text-center text-lg-left font-weight-bold">{{ $user->lastname }}, {{ $user->name }}</h1>
						<p class="h6 text-center text-lg-left mb-3">@if($user->implementer->title==1)<span class="badge badge-orange rounded-pill py-2 px-3">{{ "Certified" }}</span>@else<span class="badge badge badge-secondary rounded-pill py-2 px-3">{{ "Professional" }}</span>@endif</p>
						<p class="h6 text-center text-lg-left mb-1"><b>YPO Chapter:</b></p>
						<p class="h6 text-center text-lg-left mb-3">{{ $user->implementer->ypo_chapter }}</p>
						<p class="h6 text-center text-lg-left mb-1"><b>Service Area:</b></p>
						<p class="h6 text-center text-lg-left mb-3">{{ $user->implementer->service_area }}</p>
						<p class="h6 text-center text-lg-left mb-1"><b>Home Base:</b></p>
						<p class="h6 text-center text-lg-left">{{ $user->implementer->address }}</p>
						@if(is_null($user->implementer->linkedin) && is_null($user->implementer->facebook) && is_null($user->implementer->twitter))
						<div class="social-media-profile d-flex flex-wrap">
							@if(!is_null($user->implementer->linkedin))
							<a href="{{ $user->implementer->linkedin }}" class="bg-gray text-center text-white rounded-circle mr-3">
								<i class="fab fa-linkedin-in py-2"></i>
							</a>
							@endif
							@if(!is_null($user->implementer->facebook))
							<a href="{{ $user->implementer->facebook }}" class="bg-gray text-center text-white rounded-circle mr-3">
								<i class="fab fa-facebook-f py-2"></i>
							</a>
							@endif
							@if(!is_null($user->implementer->twitter))
							<a href="{{ $user->implementer->twitter }}" class="bg-gray text-center text-white rounded-circle">
								<i class="fab fa-twitter py-2"></i>
							</a>
							@endif
						</div>
						@endif
					</div>
					<div class="col-12 d-flex flex-wrap justify-content-center justify-content-lg-start">
						<a href="javascript:void(0);" class="btn btn-blue text-white rounded-4 py-3 px-4 mr-3 mb-2" data-toggle="modal" data-target="#modal-send-message">Send Message</a>
						<a href="javascript:void(0);" class="btn btn-white text-blue font-weight-bold rounded-4 border py-3 px-4 mb-2" data-toggle="modal" data-target="#modal-request-call">Request Call</a>
						@if(!is_null($user->implementer->ypo_link))
						<a href="{{ $user->implementer->ypo_link }}" target="_blank" class="btn btn-white text-blue font-weight-bold rounded-4 border py-3 px-4 ml-3 mb-2">YPO Link</a>
						@endif
						@if(!is_null($user->implementer->eos_link))
						<a href="{{ $user->implementer->eos_link }}" target="_blank" class="btn btn-white text-blue font-weight-bold rounded-4 border py-3 px-4 ml-3 mb-2">EOS Site</a>
						@endif
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light py-4 pt-md-5">
	<div class="container">
		<div class="col-xl-8 col-lg-8 col-12 heading-section mx-auto">
			<h2 class="text-blue mb-4">Experience</h2>
		</div>
		<div class="col-xl-8 col-lg-8 col-12 mx-auto">
			{!! $user->implementer->experience !!}
		</div>
	</div>
</section>

@if($user->implementer->testimonials->where('state', '1')->count()>0)
<section class="ftco-section py-4 pt-md-5" id="testimonials">
	<div class="container">
		<div class="row">
			<div class="col-xl-7 col-lg-7 col-12 py-4 pt-md-5 px-5 mx-auto">
				<div id="testimonialsCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

					<div class="carousel-inner" role="listbox">
						@foreach($user->implementer->testimonials->where('state', '1') as $testimonial)
						<div class="carousel-item @if($loop->first) active @endif">
							<div class="carousel-container">
								<div class="carousel-content position-relative testimonial pt-3 mx-lg-5">
									<i class="fa fa-quote-left"></i>
									<p class="text-blue">
										<i>{{ $testimonial->testimonial }}</i>
									</p>
									<div class="row">
										<div class="offset-lg-6 col-lg-6 col-12">
											<p class="h5 text-blue font-weight-bold owner-testimonial position-relative mb-0">{{ $testimonial->name }}</p>
											@if(!is_null($testimonial->title))
											<p class="small">{{ $testimonial->title }}</p>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<a class="carousel-control-prev" href="#testimonialsCarousel" role="button" data-slide="prev">
						<span class="fa fa-2x fa-angle-left bg-transparent text-blue p-2" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>

					<a class="carousel-control-next" href="#testimonialsCarousel" role="button" data-slide="next">
						<span class="fa fa-2x fa-angle-right bg-transparent text-blue p-2" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endif

<div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{ route('implementer.message', ['slug' => $user->slug]) }}" method="POST" id="formSendMessage">
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

<div class="modal fade" id="modal-request-call" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{ route('implementer.call', ['slug' => $user->slug]) }}" method="POST" id="formRequestCall">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">Request Call</h5>
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
								<div class="form-group col-12">
									<label class="col-form-label">Name<b class="text-danger">*</b></label>
									<input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Enter a name" value="{{ old('name') }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Phone<b class="text-danger">*</b></label>
									<input class="form-control form-control-lg @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Enter a phone" value="{{ old('phone') }}">
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
<script src="{{ asset('/admins/vendor/touchSwipe/jquery.touchSwipe.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection