@extends('frontend.user.layouts.auth')
@section('title', lang('Sign Up', 'user'))
@section('content')
    <div class="sign-form sign-form-lg">
        <div class="sign-form-header">
            <h2 class="sign-form-title">{{ lang('Create account', 'user') }}</h2>
            <p class="sign-form-text">{{ lang('Enter your details to create an account', 'user') }}.</p>
        </div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="row row-cols-1 row-cols-md-2 g-3 mb-3">
                <div class="col">
                    <label class="form-label">{{ lang('First Name', 'forms') }} : <span
                            class="red">*</span></label>
                    <input id="firstname" type="firstname" name="firstname" class="form-control form-control-lg"
                        value="{{ old('firstname') }}" placeholder="{{ lang('First Name', 'forms') }}" maxlength="50"
                        required>
                </div>
                <div class="col">
                    <label class="form-label">{{ lang('Last Name', 'forms') }} : <span
                            class="red">*</span></label>
                    <input id="lastname" type="lastname" name="lastname" class="form-control form-control-lg"
                        value="{{ old('lastname') }}" placeholder="{{ lang('Last Name', 'forms') }}" maxlength="50"
                        required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ lang('Username', 'forms') }} : <span
                        class="red">*</span></label>
                <input id="username" type="username" name="username" class="form-control form-control-lg"
                    value="{{ old('username') }}" placeholder="{{ lang('Username', 'forms') }}" minlength="6"
                    maxlength="50" required>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ lang('Country', 'forms') }} : <span
                        class="red">*</span></label>
                <select id="country" name="country" class="form-select form-select-lg" required>
                    @foreach (countries() as $country)
                        <option data-code="{{ $country->code }}" data-id="{{ $country->id }}"
                            value="{{ $country->id }}" {{ $country->id == old('country') ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ lang('Phone Number', 'forms') }} : <span
                        class="red">*</span></label>
                <div class="form-phone">
                    <select id="mobile_code" name="mobile_code" class="form-select form-select-lg">
                        @foreach (countries() as $country)
                            <option data-code="{{ $country->code }}" data-id="{{ $country->id }}"
                                value="{{ $country->id }}" @if ($country->id == old('mobile_code')) selected @endif>
                                {{ $country->code }}
                                ({{ $country->phone }})
                            </option>
                        @endforeach
                    </select>
                    <input id="mobile" type="tel" name="mobile" class="form-control form-control-lg"
                        value="{{ old('mobile') }}" placeholder="{{ lang('Phone Number', 'forms') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ lang('Email address', 'forms') }} : <span
                        class="red">*</span></label>
                <input id="email" type="email" name="email" class="form-control form-control-lg"
                    value="{{ old('email') }}" placeholder="{{ lang('Email address', 'forms') }}" required>
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
            @if ($settings['terms_of_service_link'])
                <div class="form-check mb-3">
                    <input id="terms" name="terms" class="form-check-input" type="checkbox"
                        @if (old('terms')) checked @endif required>
                    <label class="form-check-label">
                        {{ lang('I agree to the', 'user') }} <a href="{{ $settings['terms_of_service_link'] }}"
                            class="link">{{ lang('terms of service', 'user') }}</a>
                    </label>
                </div>
            @endif
            {!! display_captcha() !!}
            <button class="btn btn-primary btn-lg w-100">{{ lang('Continue', 'user') }}</button>
        </form>
        {!! facebook_login() !!}
    </div>
@endsection
