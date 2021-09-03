@extends('auth.layouts.app')

@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">Administrator</div>
                <p class="login-box-msg">Login to start your session</p>

                @include('components.alert')
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" style="font-weight: 400">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    @include('auth.layouts.social-networks')
                </div>

                @if (Route::has('password.request'))
                <p class="mb-1 text-center">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p>
                @endif
            </div>
        </div>
    </div>
@endsection
