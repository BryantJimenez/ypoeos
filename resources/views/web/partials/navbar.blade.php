<header @if(request()->is('/')) class="header-absolute" @endif id="header">
	<div class="container-fluid text-center">
		<a href="{{ route('home') }}">
			<img src="@if(request()->is('/')){{ asset('/web/img/logo-white.png') }}@else{{ asset('/web/img/logo.png') }}@endif" alt="Logo" />
		</a>
	</div>
</header>