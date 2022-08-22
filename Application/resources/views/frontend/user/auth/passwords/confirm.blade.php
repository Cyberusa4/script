@extends('frontend.user.layouts.auth')
@section('title', lang('Confirm Password', 'user'))
@section('content')
    <div class="sign-form">
        <div class="sign-form-header">
            <h2 class="sign-form-title">{{ lang('Confirm Password', 'user') }}</h2>
            <p class="sign-form-text">{{ lang('Please confirm your password before continuing.', 'user') }}</p>
        </div>
        <form action="{{ route('password.confirm') }}" method="POST">
            @csrf
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
            <div class="d-flex justify-content-between mb-3">
                <a class="link" href="{{ route('password.request') }}">
                    {{ lang('Forgot Your Password?', 'user') }}
                </a>
            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-primary btn-lg w-100">{{ lang('Confirm Password', 'user') }}</button>
            </div>
        </form>
    </div>
@endsection
