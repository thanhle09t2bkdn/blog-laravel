@extends('auth.layouts.app')

@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">Administrator</div>
                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

                <form action="{{ route('password.update') }}" method="post">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3 mb-1 text-center">
                    <a href="{{ route('login') }}">Click here to login</a>
                </p>
            </div>
        </div>
    </div>
@endsection
