@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="login-brand">
                <img src="{{ asset('image/logo/logo_transparent.png') }}" alt="logo" width="100"
                    class="shadow bg-white p-2 rounded-circle">
            </div>

            <div class="card card-primary shadow">
                <div class="card-header">
                    <h4>Register</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
                                value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @endif
                            </div>
                            <div class="form-group col-6">
                                <label for="password2" class="d-block">Password Confirmation</label>
                                <input id="password2" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="simple-footer">
                <div class="text-center">
                    Already have an account? <a class="text-primary font-weight-bold"
                        href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection