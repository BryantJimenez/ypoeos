<header @if(request()->is('/')) class="header-absolute" @endif id="header">
	<div class="container-fluid text-center">
		<img src="@if(request()->is('/')){{ asset('/web/img/logo-white.png') }}@else{{ asset('/web/img/logo.png') }}@endif" height="115" width="155" alt="Logo" />
	</div>
</header>