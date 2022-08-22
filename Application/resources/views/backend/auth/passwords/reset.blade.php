@extends('backend.layouts.auth')
@section('title', __('Reset Password'))
@section('content')
    <h1 class="mb-0 h3">{{ __('Reset Password') }}</h1>
    <p class="card-text text-muted">{{ __('Enter the email address and a new password to start using your account.') }}</p>
    <form action="{{ route('admin.password.reset.change') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}" />
        <div class="mb-3">
            <label class="form-label">{{ __('Email Address') }} : <span class="red">*</span></label>
            <input type="email" name="email" value="{{ $email ?? old('email') }}" class="form-control form-control-lg"
                required />
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Password') }} : <span class="red">*</span></label>
            <input type="password" name="password" class="form-control form-control-lg" required />
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Confirm Password') }} : <span class="red">*</span></label>
            <input type="password" name="password_confirmation" class="form-control form-control-lg" required />
        </div>
        {!! display_captcha() !!}
        <button class="btn btn-primary btn-lg d-block w-100">{{ __('Reset Password') }}</button>
    </form>
    <p class="mb-0 text-center text-muted mt-3">{{ __('Remember your password?') }} <a
            href="{{ route('admin.login') }}">{{ __('Login') }}</a></p>
@endsection
