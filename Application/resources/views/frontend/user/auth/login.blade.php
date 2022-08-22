@extends('frontend.user.layouts.auth')
@section('title', lang('Sign In', 'user'))
@section('content')
    <div class="sign-form">
        <div class="sign-form-header">
            <h2 class="sign-form-title">{{ lang('Sign in page title', 'user') }}</h2>
            <p class="sign-form-text">{{ lang('Sign in to your account to continue', 'user') }}</p>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ lang('Email address', 'forms') }}</label>
                <input type="email" name="email" id="email" class="form-control form-control-lg"
                    value="{{ old('email') }}" placeholder="{{ lang('Email address', 'forms') }}" required />
            </div>
            <div class="mb-3">
                <div class="row row-cols-auto justify-content-between">
                    <div class="col">
                        <label class="form-label">{{ lang('Password', 'forms') }}</label>
                    </div>
                    <div class="col">
                        <a href="{{ route('password.request') }}" class="link">
                            {{ lang('Forgot Your Password?', 'user') }}</a>
                    </div>
                </div>
                <div class="form-group input-password">
                    <input type="password" name="password" id="password" class="form-control form-control-lg"
                        placeholder="{{ lang('Password', 'forms') }}" required />
                    <button type="button">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ lang('Remember Me', 'user') }}</label>
                </div>
            </div>
            {!! display_captcha() !!}
            <button class="btn btn-primary btn-lg w-100">{{ lang('Sign In', 'user') }}</button>
        </form>
        {!! facebook_login() !!}
    </div>
@endsection
