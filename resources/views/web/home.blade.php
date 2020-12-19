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
							<a href="javascript:void(0);" class="btn btn-lg btn-outline-light text-uppercase rounded-4 lh-4 py-3 px-5">{{ $carousel->button_text }}</a>
							@else
							<a href="{{ $banner->pre_url.$banner->url }}" @if($banner->target==2) target="_blank" @endif class="btn btn-lg btn-outline-light text-uppercase rounded-4 lh-4 py-3 px-5">{{ $banner->button_text }}</a>
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

<section class="ftco-section pt-5 pb-4">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-12">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-sm-3 mb-4">
						<div class="card card-features border-blue">
							<div class="card-body">
								<div class="text-center text-blue mb-2">
									<i class="fas fa-2x fa-chart-line"></i>
								</div>
								<p class="text-center mb-0">Break thru the ceiling to achieve the growth you envision</p>
							</div>
						</div>

					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-sm-3 mb-4">
						<div class="card card-features border-blue">
							<div class="card-body">
								<div class="text-center text-blue mb-2">
									<i class="fa fa-2x fa-cogs"></i>
								</div>
								<p class="text-center mb-0">A systemized business that is easier to run and more profitable</p>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-sm-3 mb-4">
						<div class="card card-features border-blue">
							<div class="card-body">
								<div class="text-center text-blue mb-2">
									<i class="fa fa-2x fa-user-tie"></i>
								</div>
								<p class="text-center mb-0">Your team solving issues and executing with personal accountability</p>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-sm-3 mb-4">
						<div class="card card-features border-blue">
							<div class="card-body">
								<div class="text-center text-blue mb-2">
									<i class="fa fa-2x fa-clock"></i>
								</div>
								<p class="text-center mb-0">Gain time and money freedom to enhance your quality of Life</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-12">
				<iframe class="w-100 mb-3" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.youtube.com/embed/-Oa3YmFkeQw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
	<div class="container">
		<div class="row">
			@foreach($implementers as $implementer)
			<div class="col-lg-4 col-md-6 col-12 mb-4">
				<div class="card card-implementer rounded-3 shadow">
					<div class="card-body text-center">
						<img src="{{ image_exist('/admins/img/users/', $implementer->photo, true) }}" class="rounded-circle mx-auto" alt="{{ $implementer->name.' '.$implementer->lastname }}">
						<h4 class="card-title text-blue font-weight-bold mt-3">{{ $implementer->lastname }}, {{ $implementer->name }}</h4>
						<p class="card-text mb-0">YPO Gold - Angeleno</p>
						<p class="card-text">Certified EOS Implementer</p>
						<a href="{{ route('implementer', ['slug' => $implementer->slug]) }}" class="text-blue font-weight-bold"><i class="fa fa-sm fa-plus text-orange border border-orange rounded-circle p-1 mr-2"></i> View More</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="container">
		<div class="col-12 text-center pt-5 pb-4">
			<a href="{{ route('implementers') }}" class="btn btn-lg btn-orange rounded-4 py-3 px-5">View Full Directory</a>
		</div>
	</div>
</section>

@endsection