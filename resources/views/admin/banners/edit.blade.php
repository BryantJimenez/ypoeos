@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/css/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/css/forms/theme-checkbox-radio.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
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
						<h4>Edit Banner</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Required fields (<b class="text-danger">*</b>)</p>
						<form action="{{ route('banners.update', ['slug' => $banner->slug]) }}" method="POST" class="form" id="formBannerEdit" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Title (Optional)</label>
									<input class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Enter a title" value="{{ $banner->title }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Text (Optional)</label>
									<input class="form-control @error('text') is-invalid @enderror" type="text" name="text" placeholder="Enter a text" value="{{ $banner->text }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Image<b class="text-danger">*</b></label>
									<input type="file" name="image" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/banners/', $banner->image) }}" />
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Deactivate/Activate Button<b class="text-danger">*</b></label>
									<div>
										<label class="switch s-icons s-outline s-outline-primary mr-2">
											<input type="checkbox" @if($banner->button==1) checked @endif required value="1" id="buttonCheckbox">
											<span class="slider round"></span>
											<input type="hidden" name="button" required value="@if($banner->button==1){{ "1" }}@else{{ "0" }}@endif" id="buttonHidden">
										</label>
									</div>
								</div>

								<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Deactivate/Activate Banner<b class="text-danger">*</b></label>
									<div>
										<label class="switch s-icons s-outline s-outline-primary mr-2">
											<input type="checkbox" @if($banner->state==1) checked @endif required value="1" id="stateCheckbox">
											<span class="slider round"></span>
											<input type="hidden" name="state" required value="@if($banner->state==1){{ "1" }}@else{{ "0" }}@endif" id="stateHidden">
										</label>
									</div>
								</div>

								<div class="col-12 @if($banner->button==0) d-none @endif" id="buttonInputs">
									<div class="row">
										<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
											<label class="col-form-label">Button Text (Optional)</label>
											<input class="form-control @error('button_text') is-invalid @enderror" type="text" name="button_text" placeholder="Enter the button text" value="{{ $banner->button_text }}">
										</div>

										<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
											<label class="col-form-label">You want to add a destination url? (Optional)</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<select class="form-control @error('pre_url') is-invalid @enderror" name="pre_url">
														<option @if($banner->pre_url=="http://") selected @endif>http://</option>
														<option @if($banner->pre_url=="https://") selected @endif>https://</option>
													</select>
												</div>
												<input class="form-control @error('url') is-invalid @enderror" type="text" name="url" placeholder="www.example.com/page" value="{{ $banner->url }}">
											</div>
										</div>

										<div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
											<label class="col-form-label">Where do you want the url to be seen? (Optional)</label>
											<div class="n-chk">
												<label class="new-control new-radio new-radio-text radio-primary">
													<input type="radio" class="new-control-input" name="target" @if($banner->target==2) checked @endif value="2">
													<span class="new-control-indicator"></span><span class="new-radio-content">New Tab</span>
												</label>
											</div>
											<div class="n-chk">
												<label class="new-control new-radio new-radio-text radio-primary">
													<input type="radio" class="new-control-input" name="target" @if($banner->target==1) checked @endif value="1">
													<span class="new-control-indicator"></span><span class="new-radio-content">Same Tab</span>
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="banner">Update</button>
										<a href="{{ route('banners.index') }}" class="btn btn-secondary">Cancel</a>
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
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection