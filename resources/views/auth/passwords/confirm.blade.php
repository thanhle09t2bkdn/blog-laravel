@extends('auth.layouts.app')

@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">Administrator</div>
                <p class="login-box-msg">Please confirm your password before continuing.</p>

                <form action="{{ route('password.confirm') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Confirm password</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3 mb-1 text-center">
                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                </p>
            </div>
        </div>
    </div>
@endsection
