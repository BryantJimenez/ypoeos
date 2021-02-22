<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>

	<meta name="robots" content="index,follow" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:type" content="@yield('ogtype', 'website')" />
	<meta property="og:title" content="@yield('title')" />
	<meta property="og:description" content="@yield('ogdescription', 'Texto descriptivo de la página.')" />
	<meta property="og:image" content="@yield('ogimage', asset('/web/img/logo.png'))" />
	<meta name="description" content="@yield('ogdescription', 'Texto descriptivo de la página.')">
	<meta name="twitter:card" content="summary" />
	{{-- <meta name="twitter:site" content="" />
	<meta name="twitter:creator" content="" /> --}}

	<link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon" />

	@if(config('app.env')!="production")
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('/web/css/fontawesome/all.min.css') }}">
	<!-- Monserrat -->
	{{-- <link rel="stylesheet" href="{{ asset('/web/css/monserrat.css') }}"> --}}
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('/web/css/bootstrap.min.css') }}" rel="stylesheet">
	
	@yield('links')
	@else
	<link rel="stylesheet" href="{{ asset('/web/assets/main.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/web/assets/plugins.min.css') }}">
	@endif

	<!-- Style CSS -->
	<link href="{{ asset('/web/css/style.css') }}" rel="stylesheet">
	<!-- Style CSS -->
</head>
<body class="goto-here bg-white">

	@include('web.partials.navbar')

	@yield('content')

	@include('web.partials.footer')
	
	@include('web.partials.loader')

	@if(config('app.env')!="production")
	<!-- JQuery -->
	<script type="text/javascript" src="{{ asset('/web/js/jquery-3.4.1.min.js') }}"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="{{ asset('/web/js/popper.min.js') }}"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="{{ asset('/web/js/bootstrap.min.js') }}"></script>

	@yield('scripts')
	@else
	<script type="text/javascript" src="{{ asset('/web/assets/main.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/web/assets/plugins.min.js') }}"></script>
	@endif

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('/web/js/script.js') }}"></script>
	@include('admin.partials.notifications')
</body>
</html>