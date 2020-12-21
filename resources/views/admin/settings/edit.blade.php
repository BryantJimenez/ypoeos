@extends('layouts.admin')

@section('title', 'Edit Settings')

@section('links')
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Edit Settings</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Required fields (<b class="text-danger">*</b>)</p>
						<form action="{{ route('ajustes.update') }}" method="POST" class="form" id="formSetting">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Video</label>
									<input class="form-control @error('video') is-invalid @enderror" type="text" name="video" placeholder="Enter a url of a youtube video" value="{{ $setting->video }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">First Feature Box Text</label>
									<textarea class="form-control @error('feature_one') is-invalid @enderror" name="feature_one" placeholder="Enter the text for the first feature box" rows="4">{{ $setting->feature_one }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Second Feature Box Text</label>
									<textarea class="form-control @error('feature_two') is-invalid @enderror" name="feature_two" placeholder="Enter the text for the second feature box" rows="4">{{ $setting->feature_two }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Third Feature Box Text</label>
									<textarea class="form-control @error('feature_three') is-invalid @enderror" name="feature_three" placeholder="Enter the text for the third feature box" rows="4">{{ $setting->feature_three }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Fourth Feature Box Text</label>
									<textarea class="form-control @error('feature_four') is-invalid @enderror" name="feature_four" placeholder="Enter the text for the fourth feature box" rows="4">{{ $setting->feature_four }}</textarea>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Text of Why EOS Works</label>
									<textarea class="form-control @error('why_works') is-invalid @enderror" name="why_works" placeholder="Enter a text of why EOS works" rows="4" id="why-works">{!! $setting->why_works !!}</textarea>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Phone</label>
									<input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Enter a phone" value="{{ $setting->phone }}" id="phone">
								</div>

								<div class="form-group col-12">
									<button type="submit" class="btn btn-primary" action="setting">Update</button>
								</div> 
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection