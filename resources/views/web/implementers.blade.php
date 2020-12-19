@extends('layouts.web')

@section('title', 'Implementers List')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/clusters/MarkerCluster.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/clusters/MarkerCluster.Default.css') }}">
@endsection

@section('content')

<section class="ftco-section" id="map-implementer">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-6 col-12">
				{{-- <iframe class="w-100 rounded-3 mb-3" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> --}}
				<div class="w-100 rounded-3 mb-3" id="map" style="height: 400px;"></div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="form-group col-12">
						<input type="text" class="form-control form-control-lg" name="name" placeholder="Search by Name"/>
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
		<div class="row">
			@foreach($implementers as $implementer)
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-4">
				<div class="card card-vertical-implementer rounded-3 py-2">
					<div class="card-body py-4">
						<div class="row">
							<div class="col-lg-5 col-12 mb-4">
								<img src="{{ image_exist('/admins/img/users/', $implementer->photo, true) }}" class="w-100 rounded-3" alt="{{ $implementer->name.' '.$implementer->lastname }}">
							</div>
							<div class="col-lg-7 col-12 mb-4">
								<h4 class="card-title text-primary font-weight-bold">{{ $implementer->lastname }}, {{ $implementer->name }}</h4>
								<p class="h6 text-muted">YPO Gold - Angeleno</p>
								<p class="h6 text-muted mb-4">Certified EOS Implementer</p>
								<p class="h6 text-muted">{{ $implementer->implementer->address }}</p>
							</div>
							<div class="col-12">
								<a href="javascript:void(0);" class="btn btn-blue text-white rounded-3 py-2 px-4 mr-4 mb-2">Send Message</a>
								<a href="{{ route('implementer', ['slug' => $implementer->slug]) }}" class="btn btn-white text-blue font-weight-bold rounded-3 border py-2 px-4 mb-2">View More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach

			<div class="col-12 text-center my-4">
				<a href="javaScript:void(0);" class="font-weight-bold">View More</a>
			</div>
		</div>
	</div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/leaflet/leaflet.js') }}"></script>

<script src="{{ asset('/admins/vendor/leaflet/clusters/leaflet.markercluster.js') }}"></script>
<script type="text/javascript">
	var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}),
	latlng = new L.LatLng(50.5, 30.51);

	var map = new L.Map('map', {center: latlng, zoom: 15, layers: [tiles]});

	var markers = new L.MarkerClusterGroup();
	var markersList = [];

	function populate() {
		for (var i = 0; i < 100; i++) {
			var m = new L.Marker(getRandomLatLng(map));
			markersList.push(m);
			markers.addLayer(m);
		}
		return false;
	}
	function populateRandomVector() {
		for (var i = 0, latlngs = [], len = 20; i < len; i++) {
			latlngs.push(getRandomLatLng(map));
		}
		var path = new L.Polyline(latlngs);
		map.addLayer(path);
	}
	function getRandomLatLng(map) {
		var bounds = map.getBounds(),
		southWest = bounds.getSouthWest(),
		northEast = bounds.getNorthEast(),
		lngSpan = northEast.lng - southWest.lng,
		latSpan = northEast.lat - southWest.lat;

		return new L.LatLng(
			southWest.lat + latSpan * Math.random(),
			southWest.lng + lngSpan * Math.random());
	}

	populate();
	map.addLayer(markers);

	L.DomUtil.get('populate').onclick = function () {
		var bounds = map.getBounds(),
		southWest = bounds.getSouthWest(),
		northEast = bounds.getNorthEast(),
		lngSpan = northEast.lng - southWest.lng,
		latSpan = northEast.lat - southWest.lat;
		var m = new L.Marker(new L.LatLng(
			southWest.lat + latSpan * 0.5,
			southWest.lng + lngSpan * 0.5));
		markersList.push(m);
		markers.addLayer(m);
	};
	L.DomUtil.get('remove').onclick = function () {
		markers.removeLayer(markersList.pop());
	};
</script>
@endsection