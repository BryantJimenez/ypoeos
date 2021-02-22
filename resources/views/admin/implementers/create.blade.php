@extends('layouts.admin')

@section('title', 'New Implementer')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/leaflet/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>New Implementer</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Required fields (<b class="text-danger">*</b>)</p>
						<form action="{{ route('implementadores.store') }}" method="POST" class="form" id="formImplementer" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Photo (Optional)</label>
									<input type="file" name="photo" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<div class="row">
										<div class="form-group col-lg-12 col-md-12 col-12">
											<label class="col-form-label">Name<b class="text-danger">*</b></label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Enter a name" value="{{ old('name') }}">
										</div>

										<div class="form-group col-lg-12 col-md-12 col-12">
											<label class="col-form-label">Lastname<b class="text-danger">*</b></label>
											<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Enter a lastname" value="{{ old('lastname') }}">
										</div>
									</div> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Certified or Professional<b class="text-danger">*</b></label>
									<select class="form-control @error('title') is-invalid @enderror" name="title" required>
										<option value="">Select</option>
										<option @if(old('title')==1) selected @endif value="1">Certified</option>
										<option @if(old('title')==2) selected @endif value="2">Professional</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">YPO Chapter<b class="text-danger">*</b></label>
									<input class="form-control @error('ypo_chapter') is-invalid @enderror" type="text" name="ypo_chapter" required placeholder="Enter a YPO chapter" value="{{ old('ypo_chapter') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Service Area<b class="text-danger">*</b></label>
									<input class="form-control @error('service_area') is-invalid @enderror" type="text" name="service_area" required placeholder="Enter a service area" value="{{ old('service_area') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Phone<b class="text-danger">*</b></label>
									<input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Enter a phone" value="{{ old('phone') }}" id="phone">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Address<b class="text-danger">*</b></label>
									<input class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter an address" value="{{ old('address') }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Location<b class="text-danger">*</b></label>
									<div id="map-implementer" class="w-100" style="height: 300px;"></div>
									<input type="hidden" name="lat" value="38.81510115312363" id="lat">
									<input type="hidden" name="lng" value="-99.755859375" id="lng">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Experience<b class="text-danger">*</b></label>
									<textarea class="form-control @error('experience') is-invalid @enderror" name="experience" placeholder="Enter a experience" rows="5" id="experience">{{ old('experience') }}</textarea>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Email<b class="text-danger">*</b></label>
									<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Enter a email" value="{{ old('email') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">YPO Url (Optional)</label>
									<input class="form-control @error('ypo_link') is-invalid @enderror" name="ypo_link" placeholder="Enter a ypo url" value="{{ old('ypo_link') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">EOS Url (Optional)</label>
									<input class="form-control @error('eos_link') is-invalid @enderror" name="eos_link" placeholder="Enter a eos url" value="{{ old('eos_link') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Facebook (Optional)</label>
									<input class="form-control @error('facebook') is-invalid @enderror" name="facebook" placeholder="Enter a facebook" value="{{ old('facebook') }}">
								</div>
								
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Twitter (Optional)</label>
									<input class="form-control @error('twitter') is-invalid @enderror" name="twitter" placeholder="Enter a twitter" value="{{ old('twitter') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Linkedin (Optional)</label>
									<input class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" placeholder="Enter a linkedin" value="{{ old('linkedin') }}">
								</div>
								
								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="implementer">Save</button>
										<a href="{{ route('implementadores.index') }}" class="btn btn-secondary">Cancel</a>
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
<script src="{{ asset('/admins/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection