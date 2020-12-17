@section('title', 'Error 400')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">400</h1>
		<p class="mini-text">Error loading the page!</p>
		<p class="error-text mb-4 mt-1">Please tried later!</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">Back to Home</a>
	</div>
</div>

@endsection