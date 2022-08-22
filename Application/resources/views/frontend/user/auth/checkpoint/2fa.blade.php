@extends('frontend.user.layouts.auth')
@section('title', lang('2Fa Verification', 'user'))
@section('content')
    <div class="sign-form login-checkpoint">
        <div class="sign-form-header">
            <h2 class="sign-form-title">{{ lang('2Fa Verification', 'user') }}</h2>
            <p class="sign-form-text">{{ lang('Please enter the OTP code to continue', 'user') }}</p>
        </div>
        <form action="{{ route('2fa.verify') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="otp_code" id="otp-code" class="form-control form-control-lg" placeholder="••• •••"
                    maxlength="6" required>
            </div>
            <button class="btn btn-primary btn-lg w-100">{{ lang('Continue', 'user') }}</button>
        </form>
    </div>
@endsection
