@extends('admin.layouts.auth')

@section('content')
    <div class="card border border-success">
        <div class="card-header bg-success h5">
            {{ __('Login') }}
        </div>
        <div class="card-body login-card-body">
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="icheck-success">
                            <input type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-6 text-right">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('auth.backoffice.password.reset') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div><!-- /.col -->
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <button type="submit" class="btn btn-warning btn-block">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
        </div><!-- /.login-card-body -->
    </div>
@endsection