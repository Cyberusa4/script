@extends('backend.layouts.form')
@section('title', __('SMTP'))
@section('section', __('Settings'))
@section('container', 'container-max-lg')
@section('back', route('admin.settings.index'))
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.settings.smtp.update') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                {{ __('SMTP details') }}
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('Status :') }} </label>
                    <div class="col col-lg-3">
                        <input type="checkbox" name="mail_status" data-toggle="toggle"
                            @if ($settings['mail_status']) checked @endif>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('Mail mailer :') }} </label>
                    <div class="col">
                        <select name="mail_mailer" class="form-select">
                            <option value="smtp" @if ($settings['mail_mailer'] == 'mail_mailer') selected @endif>{{ __('SMTP') }}
                            </option>
                            <option value="sendmail" @if ($settings['mail_mailer'] == 'sendmail') selected @endif>
                                {{ __('SENDMAIL') }}</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('Mail Host :') }} </label>
                    <div class="col">
                        <input type="text" name="mail_host" class="remove-spaces form-control"
                            value="{{ demoMode() ? '' : $settings['mail_host'] }}" placeholder="Enter mail host">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('Mail Port :') }} </label>
                    <div class="col">
                        <input type="text" name="mail_port" class="remove-spaces form-control"
                            value="{{ demoMode() ? '' : $settings['mail_port'] }}" placeholder="Enter mail port">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('Mail username :') }} </label>
                    <div class="col">
                        <input type="text" name="mail_username" class="form-control remove-spaces"
                            value="{{ demoMode() ? '' : $settings['mail_username'] }}" placeholder="Enter username">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('Mail password :') }} </label>
                    <div class="col">
                        <input type="password" name="mail_password" class="form-control"
                            value="{{ demoMode() ? '' : $settings['mail_password'] }}" placeholder="Enter password">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('Mail encryption :') }} </label>
                    <div class="col">
                        <select name="mail_encryption" class="form-select">
                            <option value="tls" @if ($settings['mail_encryption'] == 'tls') selected @endif>{{ __('TLS') }}
                            </option>
                            <option value="ssl" @if ($settings['mail_encryption'] == 'ssl') selected @endif>{{ __('SSL') }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('From email :') }} </label>
                    <div class="col">
                        <input type="text" name="mail_form_email" class="remove-spaces form-control"
                            value="{{ demoMode() ? '' : $settings['mail_form_email'] }}"
                            placeholder="{{ __('Enter from email') }}">
                    </div>
                </div>
                <div class="row">
                    <label class="form-label col-12 col-lg-3 col-form-label">{{ __('From name :') }} </label>
                    <div class="col">
                        <input type="text" name="mail_from_name" class="remove-spaces form-control"
                            value="{{ demoMode() ? '' : $settings['mail_from_name'] }}"
                            placeholder="{{ __('Enter from name') }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if ($settings['mail_status'])
        <div class="card mt-4">
            <div class="card-header">
                {{ __('Testing') }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.smtp.test') }}" method="POST">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-lg-auto">
                            <label class="form-label">{{ __('E-mail Address') }} : <span class="red">*</span></label>
                        </div>
                        <div class="col">
                            <input type="email" name="email" class="form-control" placeholder="john@example.com"
                                value="{{ adminAuthInfo()->email }}">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-success">{{ __('Send') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
