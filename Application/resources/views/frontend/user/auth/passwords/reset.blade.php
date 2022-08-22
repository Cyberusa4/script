@extends('frontend.user.layouts.auth')
@section('title', lang('Reset Password', 'user'))
@section('content')
    <div class="sign-form">
        <div class="sign-form-header">
            <h2 class="sign-form-title">{{ lang('Reset Password', 'user') }}</h2>
            <p class="sign-form-text">{{ lang('Enter a new password to continue.', 'user') }}</p>
        </div>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label class="form-label">{{ lang('Email address', 'forms') }} : <span
                        class="red">*</span></label>
                <input type="email" name="email" id="email" class="form-control form-control-lg"
                    placeholder="{{ lang('Email address', 'forms') }}" value="{{ $email }}" required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ lang('Password', 'forms') }} : <span class="red">*</span>
                </label>
                <div class="form-group input-password">
                    <input id="password" type="password" name="password" class="form-control form-control-lg"
                        placeholder="{{ lang('Password', 'forms') }}" minlength="8" required>
                    <button type="button">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ lang('Confirm password', 'forms') }} : <span
                        class="red">*</span>
                </label>
                <div class="form-group input-password">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="form-control form-control-lg" placeholder="{{ lang('Confirm password', 'forms') }}"
                        minlength="8" required>
                    <button type="button">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            {!! display_captcha() !!}
            <button class="btn btn-primary btn-lg w-100">{{ lang('Reset', 'user') }}</button>
        </form>
    </div>
@endsection
