@extends('frontend.user.layouts.auth')
@section('title', lang('Reset Password', 'user'))
@section('content')
    <div class="sign-form">
        <div class="sign-form-header">
            <h2 class="sign-form-title">{{ lang('Reset Password', 'user') }}</h2>
            <p class="sign-form-text">
                {{ lang('You will receive an email with a link to reset your password', 'user') }}.
            </p>
        </div>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ lang('Email address', 'forms') }}</label>
                <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ old('email') }}"
                    placeholder="{{ lang('Email address', 'forms') }}" required />
            </div>
            {!! display_captcha() !!}
            <button class="btn btn-primary btn-lg w-100">{{ lang('Reset', 'user') }}</button>
        </form>
    </div>
@endsection
