@extends('layouts.app')

@section('content')
    <div class="w-100 bg-primary" style="height: 100vh; position: fixed;">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-3">

                <div class="login-brand mt-4 mb-4">
                    <img src="{{ asset('image/logo/logo_transparent.png') }}" alt="logo" width="100" class="shadow bg-white p-2 rounded-circle">
                </div>

                <div class="card card-primary shadow">
                    <div class="card-header"><h4>Login</h4></div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation">
                        @csrf
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                          <div class="float-right">
                            <a href="{{ route('password.request') }}" class="text-small">
                              Forgot Password?
                            </a>
                          </div>
                        </div>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                      </div>

                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} checked class="custom-control-input" tabindex="3" id="remember">
                          <label class="custom-control-label" for="remember">Remember Me</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                          Login
                        </button>
                      </div>
                    </form>

                  </div>
                </div>
                <div class="text-white text-center">
                  Don't have an account? <a class="text-white font-weight-bold" href="{{ route('register') }}">Create One</a>
                </div>
              </div>
            </div>
          </div>

@endsection