@extends('admin.layouts.auth')

@section('content')
    <div class="card border border-success">
        <div class="card-header bg-success h5">
            {{ __('Reset Password') }}
        </div>
        <div class="card-body login-card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('auth.password.email') }}">
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
                <div class="row mt-2">
                    <div class="col-12">
                        <button type="submit" class="btn btn-warning btn-block">
                            {{ __('Send Password Reset Link') }}
                        </button>
                        <a href="{{ route('login') }}" type="submit" class="btn btn-default btn-block">
                            {{ __('Back To Login') }}
                        </a>
                    </div>
                </div>
            </form>
        </div><!-- /.login-card-body -->
    </div>
@endsection
