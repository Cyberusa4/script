@extends('frontend.user.layouts.single')
@section('section', lang('User', 'user'))
@section('title', lang('2FA Authentication', 'user'))
@section('content')
    <div class="settingsbox">
        <div class="row g-3">
            <div class="col-xl-3">
                @include('frontend.user.includes.list')
            </div>
            <div class="col-xl-9">
                <div class="card">
                    <div class="settings-form">
                        <div class="settings-form-header border-bottom">
                            <h5 class="mb-0">{{ lang('2FA Authentication', 'user') }}</h5>
                        </div>
                        <div class="settings-form-body">
                            <div class="towfactor-text">
                                <p class="text-muted">
                                    {{ lang('Two-factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two-factor authentication protects against phishing, social engineering, and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.', 'user') }}
                                </p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-5 m-auto">
                                    @if (!$user->google2fa_status)
                                        <div class="towfactor-image text-center mb-3">
                                            {!! $QR_Image !!}
                                        </div>
                                        <div class="input-group mb-3">
                                            <input id="input-link" type="text" class="form-control form-control-lg"
                                                value="{{ $user->google2fa_secret }}" readonly>
                                            <button id="copy-btn" class="btn btn-gradient"
                                                data-clipboard-target="#input-link"><i class="far fa-clone"></i></button>
                                        </div>
                                        <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#towfactorModal">{{ lang('Enable 2FA Authentication', 'user') }}</a>
                                    @else
                                        <a href="#" class="btn btn-danger btn-lg w-100" data-bs-toggle="modal"
                                            data-bs-target="#towfactorDisableModal">{{ lang('Disable 2FA Authentication', 'user') }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="towfactor-text">
                                <p class="text-muted">
                                    {{ lang('To use the two factor authentication, you have to install a Google Authenticator compatible app. Here are some that are currently available', 'user') }}:
                                </p>
                                <li><a target="_blank"
                                        href="https://apps.apple.com/us/app/google-authenticator/id388497605">{{ lang('Google Authenticator for iOS', 'user') }}</a>
                                </li>
                                <li><a target="_blank"
                                        href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en&gl=US">{{ lang('Google Authenticator for Android', 'user') }}</a>
                                </li>
                                <li><a target="_blank"
                                        href="https://apps.apple.com/us/app/microsoft-authenticator/id983156458">{{ lang('Microsoft Authenticator for iOS', 'user') }}</a>
                                </li>
                                <li><a target="_blank"
                                        href="https://play.google.com/store/apps/details?id=com.azure.authenticator&hl=en_US&gl=US">{{ lang('Microsoft Authenticator for Android', 'user') }}</a>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!$user->google2fa_status)
        <div class="modal fade" id="towfactorModal" tabindex="-1" aria-labelledby="towfactorModalLabel"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('user.settings.2fa.enable') }}" method="POST">
                        @csrf
                        <div class="modal-body login-checkpoint">
                            <div class="mb-3">
                                <label class="form-label">{{ lang('OTP Code', 'forms') }} : <span
                                        class="red">*</span></label>
                                <input id="otp-code" type="text" name="otp_code" class="form-control"
                                    placeholder="••• •••" maxlength="6" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit"
                                    class="btn btn-primary w-100 me-2">{{ lang('Enable', 'user') }}</button>
                                <button type="button" class="btn btn-gradient w-100 ms-2"
                                    data-bs-dismiss="modal">{{ lang('Close') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="modal fade" id="towfactorDisableModal" tabindex="-1" aria-labelledby="towfactorDisableModalLabel"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('user.settings.2fa.disable') }}" method="POST">
                        @csrf
                        <div class="modal-body login-checkpoint">
                            <div class="mb-3">
                                <label class="form-label">{{ lang('OTP Code', 'forms') }} : <span
                                        class="red">*</span></label>
                                <input id="otp-code" type="text" name="otp_code" class="form-control"
                                    placeholder="••• •••" maxlength="6" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit"
                                    class="btn btn-danger w-100 me-2">{{ lang('Disable', 'user') }}</button>
                                <button type="button" class="btn btn-gradient w-100 ms-2"
                                    data-bs-dismiss="modal">{{ lang('Close') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
