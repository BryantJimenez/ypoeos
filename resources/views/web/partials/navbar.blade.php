<header @if(request()->is('/')) class="header-absolute" @endif id="header">
	<div class="container-fluid text-center">
		<img src="@if(request()->is('/')){{ asset('/web/img/logo-white.png') }}@else{{ asset('/web/img/logo.png') }}@endif" height="115" width="155" alt="Logo" />
		<p class="text-primary text-uppercase font-weight-bold small @if(request()->is('/')) d-none @endif mb-0 mt-n-3">Find An Implementer</p>
	</div>
</header>