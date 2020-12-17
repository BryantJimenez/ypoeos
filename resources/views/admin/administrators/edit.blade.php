@extends('layouts.admin')

@section('title', 'Edit Administrator')

@section('links')
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
						<h4>Edit Administrator</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Required fields (<b class="text-danger">*</b>)</p>
						<form action="{{ route('administradores.update', ['slug' => $admin->slug]) }}" method="POST" class="form" id="formAdministrator" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Photo (Optional)</label>
									<input type="file" name="photo" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/admins/', $admin->photo, true) }}" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<div class="row">
										<div class="form-group col-lg-12 col-md-12 col-12">
											<label class="col-form-label">Name<b class="text-danger">*</b></label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Enter a name" value="{{ $admin->name }}">
										</div>

										<div class="form-group col-lg-12 col-md-12 col-12">
											<label class="col-form-label">Lastname<b class="text-danger">*</b></label>
											<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Enter a lastname" value="{{ $admin->lastname }}">
										</div>
									</div> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Email</label>
									<input class="form-control" type="text" disabled value="{{ $admin->email }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Phone<b class="text-danger">*</b></label>
									<input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Enter a phone" value="{{ $admin->phone }}" id="phone">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">State<b class="text-danger">*</b></label>
									<select class="form-control @error('state') is-invalid @enderror" name="state" required>
										<option value="1" @if($admin->state=="1") selected @endif>Active</option>
										<option value="0" @if($admin->state=="0") selected @endif>Inactive</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="admin">Update</button>
										<a href="{{ route('administradores.index') }}" class="btn btn-secondary">Cancel</a>
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