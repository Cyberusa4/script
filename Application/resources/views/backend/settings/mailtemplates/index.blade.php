@extends('backend.layouts.form')
@section('title', $language->name . ' ' . __('Mail templates'))
@section('section', __('Settings'))
@section('container', 'container-max-lg')
@section('back', route('admin.settings.index'))
@section('language', true)
@section('modal', __('Settings'))
@section('content')
    <div class="dropdown mb-3">
        <button class="btn btn-secondary dropdown-toggle capitalize" type="button" id="groupsMenu" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span><i class="fa fa-envelope me-2"></i>{{ $activeGroup }}</span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="groupsMenu">
            @foreach ($groups as $group)
                <li>
                    <a class="dropdown-item capitalize {{ $activeGroup == $group->group_name ? 'active' : '' }}"
                        href="{{ route('admin.settings.mailtemplates.show.group', [$language->code,str_replace(' ', '-', $group->group_name)]) }}">
                        <span><i class="fa fa-envelope me-2"></i>{{ $group->group_name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card custom-card">
        <div class="card-body">
            <form id="vironeer-submited-form"
                action="{{ route('admin.settings.mailtemplates.update', [$language->code, str_replace(' ', '-', $activeGroup)]) }}"
                method="POST">
                @csrf
                @foreach ($mailtemplates as $mailtemplate)
                    <div class="{{ $loop->last ? '' : 'mb-3' }}">
                        <label class="form-label">{{ $mailtemplate->key }} :</label>
                        <textarea id="autosizeInput" name="values[{{ $mailtemplate->id }}]" class="translate-fields form-control" rows="1"
                            placeholder="{{ $mailtemplate->key }}">{{ $mailtemplate->value }}</textarea>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">{{ __('Mail Settings') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="mailSettingsForm" action="{{ route('admin.settings.mailtemplates.settings.update') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="vironeer-image-preview bg-light">
                                <img id="vironeer-preview-img-1" src="{{ asset($settings['website_mail_logo']) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input id="vironeer-image-targeted-input-1" type="file" name="website_mail_logo"
                                accept=".jpg, .jpeg, .png" class="form-control" hidden>
                            <button data-id="1" type="button"
                                class="vironeer-select-image-button btn btn-secondary btn-lg w-100 mb-2">{{ __('Choose Mail Logo') }}</button>
                            <small class="text-muted">{{ __('Supported (PNG, JPG, JPEG)') }}</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label">{{ __('Primary color') }} : <span
                                        class="red">*</span></label>
                                <div class="vironeer-color-picker input-group">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                    <input type="text" name="website_mail_primary_color" class="form-control"
                                        value="{{ $settings['website_mail_primary_color'] }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">{{ __('Background color') }} : <span
                                        class="red">*</span></label>
                                <div class="vironeer-color-picker input-group">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                    <input type="text" name="website_mail_background_color" class="form-control"
                                        value="{{ $settings['website_mail_background_color'] }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">{{ __('Normal text color') }} : <span
                                        class="red">*</span></label>
                                <div class="vironeer-color-picker input-group">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                    <input type="text" name="website_mail_normal_text_color" class="form-control"
                                        value="{{ $settings['website_mail_normal_text_color'] }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">{{ __('Bold text color') }} : <span
                                        class="red">*</span></label>
                                <div class="vironeer-color-picker input-group">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                    <input type="text" name="website_mail_bold_text_color" class="form-control"
                                        value="{{ $settings['website_mail_bold_text_color'] }}" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="mailSettingsForm" class="btn btn-primary">{{ __('Save changes') }}</button>
                </div>
            </div>
        </div>
    </div>
    @push('styles_libs')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}">
    @endpush
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/autosize/autosize.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    @endpush
    @push('scripts')
        <script>
            $(function() {
                autosize($('textarea'));
                $('.vironeer-color-picker').colorpicker();
            });
        </script>
    @endpush
@endsection
