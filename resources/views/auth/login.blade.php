@extends('layouts.app')
@section('content')
{{-- @include('navs.main') --}}
<header class="masthead text-white vh-100">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="text-center mb-5">2019 Leavers Party</h1>
        @guest
        {{-- <a class="btn btn-outline-light btn-lg font-weight-bold" href="{{ route('login') }}" role="button">Parent Login</a> --}}

<div class="container text-dark">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3>{{ __('Login') }}</h3>
        </div>
        
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
              <label for="email" class="bmd-label-floating left-0">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group">
              <label for="password" class="bmd-label-floating left-0">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group text-dark">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                  </label>
                </div>
            </div>
            
            <div class="form-group row mb-0">
              <div class="col-md-8">
                <button type="submit" class="btn btn-raised btn-primary">
                  {{ __('Login') }}
                </button>
                
                <a class="btn btn-raised btn-link hidden" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endguest
</div>
</div>
</div>
</header>
@endsection
