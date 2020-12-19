@extends('layouts.web')

@section('title', 'Implementer Profile')

@section('content')

<section class="ftco-section py-5" id="basic-profile">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-12 mx-auto">
				<div class="row">
					<div class="col-xl-5 col-lg-5 col-12 mb-4">
						<img src="{{ image_exist('/admins/img/users/', $user->photo, true) }}" class="rounded-circle mx-auto" alt="{{ $user->name.' '.$user->lastname }}">
					</div>
					<div class="col-xl-7 col-lg-7 col-12 mb-4">
						<h1 class="card-title text-primary font-weight-bold mt-3">{{ $user->lastname }}, {{ $user->name }}</h1>
						<p class="mb-0">YPO Gold - Angeleno</p>
						<p>Certified EOS Implementer</p>
						<p>{{ $user->implementer->address }}</p>
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
					<div class="col-12">
						<a href="javascript:void(0);" class="btn btn-blue text-white rounded-4 py-3 px-4 mr-4 mb-2">Send Message</a>
						<a href="javascript:void(0);" class="btn btn-white text-blue font-weight-bold rounded-4 border py-3 px-4 mr-4 mb-2">Request Call</a>
						<a href="javascript:void(0);" class="btn btn-white text-blue font-weight-bold rounded-4 border py-3 px-4 mb-2">YPO Link</a>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light">
	<div class="container">
		<div class="col-xl-8 col-lg-8 col-12 heading-section mx-auto">
			<h2 class="text-blue mb-4">Experience</h2>
		</div>
		<div class="col-xl-8 col-lg-8 col-12 mx-auto">
			<p>{{ $user->implementer->experience }}</p>
			{{-- <p>Mike began his own journey as an entrepreneur when we co-founded a training company in 1993. As CEO, he grew the business with the help of 100+ instructors and staff to be an internationally recognized company with over $20M in revenue and operations in the US and UK.</p>
			<p>Along his journey, Mike joined the Young President’s Organization (YPO) in 2000. While working closely with business leaders in YPO, Mike discovered a passion and talent for his own teaching and facilitation. As a result, Mike has been professionally delivering programs for YPO groups in the US and internationally since 2007 delivering highly regarded sessions.</p>
			<p>In 2015, Mike sold his training business to a global IT training organization and exited the business to focus on helping business leaders implement EOS. As a certified EOS implementer Mike combines his business experience and love of teaching to fulfill his dream of helping other entrepreneurs after he was finished with his own business.</p> --}}
		</div>
	</div>
</section>

<section class="ftco-section" id="testimonials">
	<div class="container">
		<div class="col-xl-6 col-lg-6 col-12 py-5 px-5 mx-auto">
			<p class="text-blue position-relative testimonial"><i>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</i></p>
			<div class="row">
				<div class="offset-lg-6 col-lg-6 col-12">
					<p class="h5 text-blue font-weight-bold owner-testimonial position-relative mb-0">Sue Hawkes</p>
					<p class="small">Title / Certified Implementer</p>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection