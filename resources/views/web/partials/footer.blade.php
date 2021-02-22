<footer class="py-4">
	@if(!request()->is('/'))
	<div class="text-center">
		<img src="{{ asset('/web/img/logo_ypo.png') }}" class="mr-3" width="100" alt="Logo YPO">
		<img src="{{ asset('/web/img/logo_eos.png') }}" width="80" alt="Logo EOS">
	</div>
	@endif
	<p class="text-center text-muted">2020 - YPO + EOS Implementers</p>
</footer>