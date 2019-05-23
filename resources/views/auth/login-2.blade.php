@extends('layout.main')

<section class="section">
    <div class="container mt-5">
        <div class="row">
          	<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            	<div class="card card-primary">
              		<div class="card-header"><h4>Login</h4></div>

	              <div class="card-body">
	                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
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
	                      <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" tabindex="3" id="remember-me">
	                      <label class="custom-control-label" for="remember-me">Remember Me</label>
	                    </div>
	                  </div>

	                  <div class="form-group">
	                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
	                      Login
	                    </button>
	                  </div>
	                </form>
	                <div class="text-center mt-4 mb-3">
	                  <div class="text-job text-muted">Login With Social</div>
	                </div>
	                <div class="row sm-gutters">
	                  <div class="col-6">
	                    <a class="btn btn-block btn-social btn-google">
	                      <span class="fab fa-google-g"></span> Google
	                    </a>
	                  </div>
	                </div>

	              </div>
	            </div>
	            <div class="mt-5 text-muted text-center">
	              Don't have an account? <a href="auth-register.html">Create One</a>
	            </div>
	            <div class="simple-footer">
	              Copyright © Stisla 2018
	            </div>
	          </div>
	        </div>
	      </div>
    </section>

@section('content')

@endsection