@extends('backend.layouts.form')
@section('title', __('Edit | ') . $uploadSetting->name)
@section('section', __('Settings'))
@section('back', route('admin.settings.upload.index'))
@section('container', 'container-max-lg')
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.settings.upload.update', $uploadSetting->id) }}"
        method="POST">
        @csrf
        <div class="card custom-card mb-4">
            <div class="card-header bg-primary text-white">
                {{ __('Settings') }}
            </div>
            <ul class="custom-list-group list-group list-group-flush">
                @if ($uploadSetting->symbol == 'guests')
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-8 col-lg-8">
                                <label class="col-form-label d-block">
                                    <strong>{{ __('Upload Status') }} :</strong></label>
                                <small class="text-muted">{{ __('For disabling and activating guests uploads') }}</small>
                            </div>
                            <div class="col-4 col-lg-4">
                                <input type="checkbox" name="status" data-toggle="toggle"
                                    {{ $uploadSetting->status ? 'checked' : '' }}>
                            </div>
                        </div>
                    </li>
                @endif
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label d-block"><strong>{{ __('Storage space') }} : <span
                                        class="red">*</span></strong></label>
                            <small class="text-muted">{{ __('The space given to each person') }}</small>
                        </div>
                        <div class="col-12 col-lg-2">
                            <input type="checkbox" name="unlimited_storage_space"
                                class="form-check-input unlimited-storage-space-checkbox"
                                {{ !$uploadSetting->storage_space ? 'checked' : '' }}>
                            <label>{{ __('Unlimited') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-storage-space">
                                <input type="number" name="storage_space" class="form-control" placeholder="0"
                                    value="{{ $uploadSetting->storage_space / 1048576 }}" required
                                    {{ !$uploadSetting->storage_space ? 'disabled' : '' }}>
                                <span
                                    class="input-group-text {{ !$uploadSetting->storage_space ? 'disabled' : '' }}"><strong><i
                                            class="fas fa-hdd me-2"></i>{{ __('MB') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label d-block"><strong>{{ __('Size of each file') }} : <span
                                        class="red">*</span></strong></label>
                            <small class="text-muted">{{ __('Maximum size for each file uploaded') }}</small>
                        </div>
                        <div class="col-12 col-lg-2">
                            <input type="checkbox" name="unlimited_file_size"
                                class="form-check-input unlimited-file-size-checkbox"
                                {{ !$uploadSetting->file_size ? 'checked' : '' }}>
                            <label>{{ __('Unlimited') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-file-size">
                                <input type="number" name="file_size" class="form-control" placeholder="0"
                                    value="{{ $uploadSetting->file_size / 1048576 }}" required
                                    {{ !$uploadSetting->file_size ? 'disabled' : '' }}>
                                <span
                                    class="input-group-text {{ !$uploadSetting->file_size ? 'disabled' : '' }}"><strong><i
                                            class="fas fa-hdd me-2"></i>{{ __('MB') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label d-block"><strong>{{ __('Files duration') }} :
                                </strong><span class="red">*</span></label>
                            <small class="text-muted">{{ __('File expiration date (maximum 365 days)') }}</small>
                        </div>
                        <div class="col-12 col-lg-2">
                            <input type="checkbox" name="unlimited_files_duration"
                                class="form-check-input files-duration-checkbox"
                                {{ !$uploadSetting->files_duration ? 'checked' : '' }}>
                            <label>{{ __('Unlimited time') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-files-duration">
                                <input type="number" name="files_duration" class="form-control"
                                    value="{{ $uploadSetting->files_duration }}" placeholder="0" required
                                    {{ !$uploadSetting->files_duration ? 'disabled' : '' }} />
                                <span
                                    class="input-group-text {{ !$uploadSetting->files_duration ? 'disabled' : '' }}"><strong><i
                                            class="fas fa-calendar-alt me-2"></i>{{ __('Days') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-8">
                            <label class="col-form-label d-block"><strong>{{ __('Uploaded files at once') }} : <span
                                        class="red">*</span></strong></label>
                            <small
                                class="text-muted">{{ __('Maximum number of files allowed to be uploaded per process') }}</small>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group">
                                <input type="number" name="upload_at_once" class="form-control" placeholder="0"
                                    value="{{ $uploadSetting->upload_at_once }}" required>
                                <span class="input-group-text"><strong><i
                                            class="fas fa-file-alt me-2"></i>{{ __('Files') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-8">
                            <label class="col-form-label d-block"><strong>{{ __('Allow protect files by password') }} :
                                </strong></label>
                            <small class="text-muted">{{ __('Allow to set password to protect each file') }}</small>
                        </div>
                        <div class="col-4 col-lg-4">
                            <input type="checkbox" name="password_protection" data-toggle="toggle"
                                data-on="{{ __('Yes') }}" data-off="{{ __('No') }}"
                                {{ $uploadSetting->password_protection ? 'checked' : '' }}>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-8">
                            <label class="col-form-label d-block"><strong>{{ __('Show advertisements') }} :
                                </strong></label>
                            <small class="text-muted">{{ __('Show or hide the advertisements ') }}</small>
                        </div>
                        <div class="col-4 col-lg-4">
                            <input type="checkbox" name="advertisements" data-toggle="toggle"
                                data-on="{{ __('Yes') }}" data-off="{{ __('No') }}"
                                {{ $uploadSetting->advertisements ? 'checked' : '' }}>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </form>
@endsection
