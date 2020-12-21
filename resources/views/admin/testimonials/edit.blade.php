@extends('layouts.admin')

@section('title', 'Edit Testimonial')

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
						<h4>Edit Testimonial</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Required fields (<b class="text-danger">*</b>)</p>
						<form action="{{ route('testimonios.update', ['slug' => $testimonial->slug]) }}" method="POST" class="form" id="formTestimonial">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Implementer<b class="text-danger">*</b></label>
									<select class="form-control @error('implementer_id') is-invalid @enderror" name="implementer_id" required>
										<option value="">Seleccione</option>
										@foreach($implementers as $implementer)
										<option value="{{ $implementer->slug }}" @if($implementer->id==$testimonial->implementer->user_id) selected @endif>{{ $implementer->name." ".$implementer->lastname }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Author's Name<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Enter a author's name" value="{{ $testimonial->name }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Job Title (Optional)</label>
									<input class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Enter a job title" value="{{ $testimonial->title }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Testimonial<b class="text-danger">*</b></label>
									<textarea class="form-control @error('testimonial') is-invalid @enderror" name="testimonial" placeholder="Enter a testimonial" rows="5">{{ $testimonial->testimonial }}</textarea>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="testimonial">Update</button>
										<a href="{{ route('testimonios.index') }}" class="btn btn-secondary">Cancel</a>
									</div>
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
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection