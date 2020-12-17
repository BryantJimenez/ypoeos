@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="form-container bg-primary outer">
  <div class="form-form">
    <div class="form-form-wrap">
      <div class="form-container">
        <div class="form-content">

          <h1 class="">Login</h1>

          <form class="text-left" action="{{ route('login') }}" method="POST" id="formLogin">
            {{ csrf_field() }}

            @include('admin.partials.errors')
            
            <div class="form">

              <div id="username-field" class="field-wrapper input">
                <label for="email">EMAIL</label>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" required placeholder="{{ 'correo@gmail.com' }}" value="{{ old('email') }}">
              </div>

              <div id="password-field" class="field-wrapper input mb-2">
                <div class="d-flex justify-content-between">
                  <label for="password">PASSWORD</label>
                  <a href="{{ route('password.request') }}" class="forgot-pass-link">Forgot my password</a>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <input id="password" name="password" type="password" class="form-control @error('email') is-invalid @enderror" required placeholder="********">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
              </div>
              <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                  <button type="submit" class="btn btn-primary font-weight-bold" action="login">Login</button>
                </div>
              </div>
            </div>
          </form>

        </div>                    
      </div>
    </div>
  </div>
</div>

@endsection