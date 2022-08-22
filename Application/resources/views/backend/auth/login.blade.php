@extends('backend.layouts.auth')
@section('title', __('Login'))
@section('content')
    <h1 class="mb-0 h3">{{ __('Login') }}</h1>
    <p class="card-text text-muted">{{ __('Log in to your account to continue.') }}</p>
    <form action="{{ route('admin.login.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('Email Address') }} : <span class="red">*</span></label>
            <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required />
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Password') }} : <span class="red">*</span></label>
            <input type="password" name="password" class="form-control form-control-lg" required />
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <label class="form-check mb-0">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        class="form-check-input">
                    <span class="form-check-label">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="col-auto ms-auto">
                <a href="{{ route('admin.password.reset') }}">{{ __('Forgot password?') }}</a>
            </div>
        </div>
        {!! display_captcha() !!}
        <button class="btn btn-primary btn-lg d-block w-100">{{ __('Login') }}</button>
    </form>
@endsection
