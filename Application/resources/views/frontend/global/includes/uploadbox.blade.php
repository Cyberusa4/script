<div class="uploadbox">
    <div class="overlay"></div>
    <div class="uploadbox-content">
        <div class="uploadbox-header">
            <p class="h5 mb-0">{{ lang('Upload Files', 'upload zone') }}</p>
            <span class="ms-auto d-flex align-items-center">
                <a href="#" class="upload-more-btn d-none" data-dz-click><i class="fas fa-upload"></i><span
                        class="ms-2 d-none d-sm-inline">{{ lang('Upload more', 'upload zone') }}</span></a>
                <button type="button" class="btn-close d-inline-block ms-3"></button>
            </span>
        </div>
        <div class="uploadbox-body">
            <div class="uploadbox-body-header">
                <div class="d-flex text-muted small">
                    <span>{!! str_replace('{max_file_size}', '<strong>' . subscription()->formates->file_size . '</strong>', lang('Max File Size {max_file_size}', 'upload zone')) !!}
                        <span>/</span>
                        {!! str_replace('{files_duration}', '<strong>' . subscription()->formates->files_duration . '</strong>', lang('Files available for {files_duration}', 'upload zone')) !!}
                    </span>
                </div>
                <div class="ms-auto small">
                    <a class="reset-upload-box link d-none"><i
                            class="fas fa-redo me-1"></i>{{ lang('Reset', 'upload zone') }}</a>
                </div>
            </div>
            <div class="uploadbox-body-content">
                <div class="uploadbox-drag">
                    <div class="uploadbox-drag-inner">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h3>{{ lang('Drag and drop or click here to upload', 'upload zone') }}</h3>
                        <p class="mb-0">
                            {{ lang('You can also', 'upload zone') }} <a class="link"
                                data-dz-click>{{ lang('browse from your computer', 'upload zone') }}</a>
                        </p>
                    </div>
                </div>
                <div class="uploadbox-wrapper">
                    <div id="dropzone"
                        class="dropzone row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 justify-content-center g-3">
                    </div>
                    <div id="upload-previews">
                        <div class="dz-preview dz-file-preview col">
                            <div class="dz-preview-container">
                                <div class="dz-details">
                                    <div class="dz-actions">
                                        <div class="row justify-content-between flex-nowrap">
                                            <div class="col-auto">
                                                @if (subscription()->plan->password_protection)
                                                    <div class="d-flex align-item-center">
                                                        <a class="dz-edit me-2" data-dz-edit>
                                                            <i class="fa fa-lock-open"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-auto">
                                                <a class="dz-remove" data-dz-remove>
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mb-3">
                                        <span data-dz-extension class="vi vi-file vi-2x"></span>
                                    </div>
                                    <div class="dz-name">
                                        <span data-dz-name></span>
                                        <div class="dz-size mt-1"></div>
                                    </div>
                                    <div class="dz-details-info">
                                        <div class="dz-success-mark">
                                            <span><i class="fas fa-check"></i></span>
                                        </div>
                                        <div class="dz-error-mark">
                                            <span><i class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dz-progress">
                                    <span class="dz-upload" data-dz-uploadprogress></span>
                                    <span class="dz-upload-precent"></span>
                                </div>
                                @if (subscription()->plan->password_protection)
                                    <div class="dz-file-edit">
                                        <div class="overlay"></div>
                                        <div class="dz-file-edit-box">
                                            <div class="dz-file-edit-box-header">
                                                <div class="dz-file-edit-close ms-auto">
                                                    <i class="fa fa-times"></i>
                                                </div>
                                            </div>
                                            <div class="dz-file-edit-box-body">
                                                <div class="d-flex justify-content-center mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        width="64px" height="64px">
                                                        <path fill="{{ $settings['website_primary_color'] }}"
                                                            d="M7.9,256C7.9,119,119,7.9,256,7.9C393,7.9,504.1,119,504.1,256c0,137-111.1,248.1-248.1,248.1C119,504.1,7.9,393,7.9,256z" />
                                                        <path fill="#FFF"
                                                            d="M133.7 240.2H378.29999999999995V400H133.7z" />
                                                        <path fill="#FFF"
                                                            d="M349.7,340.1c-7.7,0-14-6.3-14-14v-136c0-44-35.8-79.8-79.8-79.8s-79.8,35.8-79.8,79.8v136c0,7.7-6.3,14-14,14s-14-6.3-14-14v-136c0-59.4,48.3-107.7,107.7-107.7s107.7,48.3,107.7,107.7v136C363.7,333.9,357.4,340.1,349.7,340.1z" />
                                                        <path fill="{{ $settings['website_primary_color'] }}"
                                                            d="M282.6,309.3c0-14.7-11.9-26.6-26.6-26.6c-14.7,0-26.6,11.9-26.6,26.6c0,9.4,4.8,17.6,12.1,22.3c0,4.2,0,9.4,0,11.5c0,8,6.5,14.5,14.5,14.5s14.5-6.5,14.5-14.5c0-2,0-7.2,0-11.5C277.8,326.9,282.6,318.6,282.6,309.3z" />
                                                    </svg>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <h5>{{ lang('Password protection', 'upload zone') }}</h5>
                                                    <p class="text-muted">
                                                        {{ lang('The password helps protect your file from public accessing', 'upload zone') }}
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="password" fill-status="false"
                                                        class="file-password form-control form-control-md"
                                                        placeholder="{{ lang('Enter password', 'upload zone') }}"
                                                        disabled />
                                                </div>
                                                <div>
                                                    <div class="text-center">
                                                        <button
                                                            class="btn btn-primary btn-md dz-file-edit-submit">{{ lang('Submit', 'upload zone') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="uploadbox-wrapper-form mt-4">
                        <div class="mb-3">
                            <label class="form-label fw-500">{{ lang('Auto delete file', 'upload zone') }}</label>
                            <select name="upload_auto_delete" class="upload-auto-delete form-select form-select-md">
                                @foreach (autoDeletePeriods() as $autoDeletePeriodKey => $autoDeletePeriodValue)
                                    <option value="{{ $autoDeletePeriodKey }}"
                                        data-action="{{ $autoDeletePeriodValue['days'] }}">
                                        {{ $autoDeletePeriodValue['title'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button
                                class="upload-files-btn btn btn-primary">{{ lang('Upload', 'upload zone') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('config')
    @php
    $exceedTheAllowedSizeError = str_replace('{maxFileSize}', subscription()->formates->file_size, lang('File is too big, Max file size {maxFileSize}', 'upload zone'));
    $subscribed = subscription()->is_subscribed ? 1 : 0;
    $subscriptionExpired = subscription()->is_expired ? 1 : 0;
    $subscriptionCanceled = subscription()->is_canceled ? 1 : 0;
    @endphp
    <script>
        "use strict";
        const uploadConfig = {
            uploadFoler: "{{ isset($folder) ? hashid($folder->id) : null }}",
            translation: {
                formatSizes: ["{{ lang('B') }}", "{{ lang('KB') }}", "{{ lang('MB') }}","{{ lang('GB') }}", "{{ lang('TB') }}"],
                downloadLink: "{{ lang('Download link', 'upload zone') }}",
                previewLink: "{{ lang('Preview link', 'upload zone') }}",
                viewFile: "{{ lang('View File', 'upload zone') }}",
            },
            unacceptableFileTypes: "{{ unacceptableFileTypes() }}",
            chunkSize: "{{ $settings['website_chunk_size'] * 1048576 }}",
            maxUploadFiles: "{{ subscription()->plan->upload_at_once }}",
            maxFileSize: "{{ subscription()->plan->file_size }}",
            exceedTheAllowedSizeError: "{{ $exceedTheAllowedSizeError }}",
            subscribed: "{{ $subscribed }}",
            subscriptionExpired: "{{ $subscriptionExpired }}",
            subscriptionCanceled: "{{ $subscriptionCanceled }}",
            filesDuration: "{{ subscription()->plan->files_duration }}",
            unsubscribedError: "{{ lang('Login or create account to start uploading files', 'alerts') }}",
            subscriptionExpiredError: "{{ lang('Your subscription has been expired, renew it to start uploading files', 'alerts') }}",
            subscriptionCanceledError: "{{ lang('Your subscription has been canceled, please contact us for more information', 'alerts') }}",
            filesDurationError: "{{ lang('Invalid file auto delete time', 'upload zone') }}",
            closeUploadBoxAlert: "{{ lang('Are you sure you want to close this window?', 'upload zone') }}",
            nofilesAttachedError: "{{ lang('No files attached', 'upload zone') }}",
            unacceptableFileTypesError: "{{ lang('You cannot upload files of this type.', 'upload zone') }}",
            clientReminingSpace: "{{ subscription()->storage->remining->number }}",
            clientReminingSpaceError: "{{ lang('insufficient storage space please ensure sufficient space', 'upload zone') }}",
            fileDuplicateError: "{{ lang('File with the same name already attached', 'upload zone') }}",
            emptyFilesError: "{{ lang('Empty files cannot be uploaded', 'upload zone') }}",
        };
        let uploadConfigObjects = JSON.stringify(uploadConfig),
            getUploadConfig = JSON.parse(uploadConfigObjects);
    </script>
    @include('frontend.global.includes.dropzone-options')
@endpush
@push('scripts_libs')
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.min.js') }}"></script>
@endpush
