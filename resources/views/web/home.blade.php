@extends('layouts.web')

@section('title', 'Home')

@section('content')

<section id="intro">
	<div class="intro-container">
		<div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

			<ol class="carousel-indicators"></ol>

			<div class="carousel-inner" role="listbox">

				@foreach($banners as $banner)
				<div class="carousel-item @if($loop->first) active @endif">
					<div class="carousel-background">
						<img src="{{ image_exist('/admins/img/banners/', $banner->image) }}" alt="Imagen de Banner">
					</div>
					<div class="carousel-container">
						<div class="carousel-content mx-lg-5">
							<h2 class="w-75 mx-auto mb-1">{{ $banner->title }}</h2>
							@if(!is_null($banner->text))
							<h4 class="w-75 text-white mx-auto mt-2 mb-3">{{ $banner->text }}</h4>
							@endif
							@if($banner->button==1)
							@empty($banner->url)
							<a href="javascript:void(0);" class="btn btn-lg btn-outline-light text-uppercase rounded-4 lh-4 py-2 px-3 py-md-3 px-md-5 mx-4 mx-sm-0">{{ $carousel->button_text }}</a>
							@else
							<a href="{{ $banner->pre_url.$banner->url }}" @if($banner->target==2) target="_blank" @endif class="btn btn-lg btn-outline-light text-uppercase rounded-4 lh-4 py-2 px-3  py-md-3 px-md-5 mx-4 mx-sm-0">{{ $banner->button_text }}</a>
							@endempty
							@endif
						</div>
					</div>
				</div>
				@endforeach

			</div>

			<a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>

			<a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>

		</div>
	</div>
</section>

<section class="ftco-section pt-3 pt-sm-4 pt-md-5 pb-4">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-7 col-12">
				<div class="row">
					<div class="col-12">
						<h3 class="text-blue text-center font-weight-bold">WHY <span class="registered mr-3">EOS</span> WORKS</h3>
					</div>
					<div class="col-12 why-work">
						{!! $setting->why_works !!}
					</div>
				</div>
			</div>
			<div class="col-xl-5 col-12 d-flex align-items-center">
				<iframe class="w-100 mb-3" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="" data-src="{{ youtubeUrl($setting->video) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="youtube-video"></iframe>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section py-0">
	<div class="container-fluid">
		<div class="col-12">
			<div class="row">
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-sm-3 mb-4">
					<div class="card card-features border-orange">
						<div class="card-body d-flex justify-content-center align-items-center">
							<div>
								<div class="text-center text-orange mb-2">
									<i class="fas fa-2x fa-chart-line"></i>
								</div>
								<p class="text-center mb-0">{{ $setting->feature_one }}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-sm-3 mb-4">
					<div class="card card-features border-orange">
						<div class="card-body d-flex justify-content-center align-items-center">
							<div>
								<div class="text-center text-orange mb-2">
									<i class="fa fa-2x fa-cogs"></i>
								</div>
								<p class="text-center mb-0">{{ $setting->feature_two }}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-sm-3 mb-4">
					<div class="card card-features border-orange">
						<div class="card-body d-flex justify-content-center align-items-center">
							<div>
								<div class="text-center text-orange mb-2">
									<i class="fa fa-2x fa-user-tie"></i>
								</div>
								<p class="text-center mb-0">{{ $setting->feature_three }}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-sm-3 mb-4">
					<div class="card card-features border-orange">
						<div class="card-body d-flex justify-content-center align-items-center">
							<div>
								<div class="text-center text-orange mb-2">
									<i class="fa fa-2x fa-clock"></i>
								</div>
								<p class="text-center mb-0">{{ $setting->feature_four }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section py-5">
	<div class="container">
		<div class="col-12 heading-section pb-4">
			<h2 class="text-blue text-center mb-5">Meet These Implementers in Your Area!</h2>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			@foreach($implementers as $implementer)
			<div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
				<div class="card card-implementer rounded-3 shadow">
					<div class="card-body text-center">
						<img src="{{ asset('/admins/img/template/usuario.png') }}" data-src="{{ image_exist('/admins/img/users/', $implementer->photo, true) }}" class="lazy rounded-circle mx-auto" alt="{{ $implementer->name.' '.$implementer->lastname }}">
						<h4 class="card-title text-blue font-weight-bold mt-3">{{ $implementer->lastname }}, {{ $implementer->name }}</h4>
						<p class="h6 card-text mb-2">@if($implementer['implementer']->title==1)<span class="badge badge-orange rounded-pill py-2 px-3">{{ "Certified" }}</span>@else<span class="badge badge-secondary rounded-pill py-2 px-3">{{ "Professional" }}</span>@endif</p>
						<p class="h6 card-text mb-0"><b>YPO Chapter:</b></p>
						<p class="h6 card-text small mb-2">{{ $implementer['implementer']->ypo_chapter }}</p>
						<p class="h6 card-text mb-0"><b>Service Area:</b></p>
						<p class="h6 card-text small mb-2">{{ $implementer['implementer']->service_area }}</p>
						<p class="h6 card-text mb-0"><b>Home Base:</b></p>
						<p class="h6 card-text small mb-3">{{ $implementer['implementer']->address }}</p>
						<a href="{{ route('implementer', ['slug' => $implementer->slug]) }}" class="text-orange font-weight-bold"><i class="fa fa-sm fa-plus border border-orange rounded-circle p-1 mr-2"></i> View More</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="container">
		<div class="col-12 text-center pt-5">
			<a href="{{ route('implementers', ['all' => 'true']) }}" class="btn btn-lg btn-orange text-white rounded-4 py-3 px-sm-5">View Full Directory</a>
		</div>
	</div>
</section>

<div class="banner-logos text-center">
	<img src="{{ asset('/web/img/logo_ypo.png') }}" class="mr-1" width="100" alt="Logo YPO">
	<img src="{{ asset('/web/img/logo_eos_white.png') }}" width="80" alt="Logo EOS">
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/touchSwipe/jquery.touchSwipe.min.js') }}"></script>
@endsection