@extends('backend.layouts.form')
@section('title', __('Create a new plan'))
@section('container', 'container-max-lg')
@section('back', route('admin.plans.index'))
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.plans.store') }}" method="POST">
        @csrf
        <div class="card custom-card mb-4">
            <div class="card-header bg-primary text-white">
                {{ __('Plan details') }}
            </div>
            <ul class="custom-list-group list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label"><strong>{{ __('Plan Name') }} : <span
                                        class="red">*</span></strong></label>
                        </div>
                        <div class="col-12 col-lg-2">
                            <input type="checkbox" name="featured_plan" class="form-check-input">
                            <label>{{ __('Featured plan') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}"
                                placeholder="{{ __('Enter plan name') }}" autofocus>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-8">
                            <label class="col-form-label"><strong>{{ __('Plan badge color') }}
                                    : </strong><span class="red">*</span></strong></label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="vironeer-color-picker input-group">
                                <span class="input-group-text colorpicker-input-addon">
                                    <i></i>
                                </span>
                                <input type="text" name="color" class="form-control"
                                    value="{{ old('color') ?? '#000000' }}" required>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-8">
                            <label class="col-form-label d-block"><strong>{{ __('Short description') }} : <span
                                        class="red">*</span></strong></label>
                        </div>
                        <div class="col-12 col-lg-4">
                            <textarea name="short_description" class="form-control" required placeholder="{{ __('Max 150 character') }}">{{ old('short_description') }}</textarea>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-8">
                            <label class="col-form-label"><strong>{{ __('Plan Interval') }} : <span
                                        class="red">*</span></strong></strong></label>
                        </div>
                        <div class="col col-lg-4">
                            <select name="interval" class="form-select" required>
                                <option value="1" {{ old('interval') == 1 ? 'selected' : '' }}>
                                    {{ __('Monthly') }}
                                </option>
                                <option value="2" {{ old('interval') == 2 ? 'selected' : '' }}>{{ __('Yearly') }}
                                </option>
                                <option value="3" {{ old('interval') == 3 ? 'selected' : '' }}>
                                    {{ __('Lifetime') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label"><strong>{{ __('Plan Price') }} : <span
                                        class="red">*</span></strong></strong></label>
                        </div>
                        <div class="col-12 col-lg-2">
                            <input type="checkbox" name="free_plan" class="free-plan-checkbox form-check-input">
                            <label>{{ __('Free') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-price">
                                <input type="text" name="price" class="form-control input-price"
                                    value="{{ old('price') }}" placeholder="0.00" required />
                                <span class="input-group-text"><strong>{{ currencySymbolAndCode() }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item require-login d-none">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-8">
                            <label class="col-form-label"><strong>{{ __('Require Login') }} :</strong></label>
                        </div>
                        <div class="col-4 col-lg-4">
                            <input type="checkbox" name="require_login" class="plan-require-login" data-toggle="toggle"
                                data-off="{{ __('No') }}" data-on="{{ __('Yes') }}"
                                {{ old('require_login') ? 'checked' : '' }}>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label"><strong>{{ __('Storage space') }} : <span
                                        class="red">*</span></strong></label>
                        </div>
                        <div class="col-12 col-lg-2">
                            <input type="checkbox" name="unlimited_storage_space"
                                class="form-check-input unlimited-storage-space-checkbox">
                            <label>{{ __('Unlimited') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-storage-space">
                                <input type="number" name="storage_space" class="form-control" placeholder="0"
                                    value="{{ old('storage_space') }}" required>
                                <span class="input-group-text"><strong><i
                                            class="fas fa-hdd me-2"></i>{{ __('MB') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label"><strong>{{ __('Size of each file') }} : <span
                                        class="red">*</span></strong></label>
                        </div>
                        <div class="col-12 col-lg-2">
                            <input type="checkbox" name="unlimited_file_size"
                                class="form-check-input unlimited-file-size-checkbox">
                            <label>{{ __('Unlimited') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-file-size">
                                <input type="number" name="file_size" class="form-control" placeholder="0"
                                    value="{{ old('file_size') }}" required>
                                <span class="input-group-text"><strong><i
                                            class="fas fa-hdd me-2"></i>{{ __('MB') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <label class="col-form-label"><strong>{{ __('Files duration') }} :
                                </strong><span class="red">*</span></label>
                        </div>
                        <div class="col-12 col-lg-2">
                            <input type="checkbox" name="unlimited_files_duration"
                                class="form-check-input files-duration-checkbox">
                            <label>{{ __('Unlimited time') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-files-duration">
                                <input type="number" name="files_duration" class="form-control"
                                    value="{{ old('files_duration') }}" placeholder="0" required />
                                <span class="input-group-text"><strong><i
                                            class="fas fa-calendar-alt me-2"></i>{{ __('Days') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-8">
                            <label class="col-form-label"><strong>{{ __('Uploaded files at once') }} : <span
                                        class="red">*</span></strong></label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group">
                                <input type="number" name="upload_at_once" class="form-control" placeholder="0"
                                    value="{{ old('upload_at_once') }}" required>
                                <span class="input-group-text"><strong><i
                                            class="fas fa-file-alt me-2"></i>{{ __('Files') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-8">
                            <label class="col-form-label"><strong>{{ __('Allow protect files by password') }} :
                                </strong></label>
                        </div>
                        <div class="col-4 col-lg-4">
                            <input type="checkbox" name="password_protection" data-toggle="toggle"
                                data-on="{{ __('Yes') }}" data-off="{{ __('No') }}"
                                {{ old('password_protection') ? 'checked' : '' }}>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-8">
                            <label class="col-form-label"><strong>{{ __('Show advertisements') }} :
                                </strong></label>
                        </div>
                        <div class="col-4 col-lg-4">
                            <input type="checkbox" name="advertisements" data-toggle="toggle"
                                data-on="{{ __('Yes') }}" data-off="{{ __('No') }}"
                                {{ old('advertisements') ? 'checked' : '' }}>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div id="customFeaturesCard" class="card custom-card mb-3 d-none">
            <div class="card-header bg-secondary text-white">
                {{ __('Custom features') }}
            </div>
            <ul id="customFeatures" class="custom-list-group list-group list-group-flush plans-list-group"></ul>
        </div>
        <button type="button" id="addCustomFeature" class="btn btn-primary"><i
                class="fa fa-plus me-2"></i>{{ __('Add custom feature') }}</button>
    </form>
    @push('styles_libs')
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}">
    @endpush
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.priceformat.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    @endpush
    @push('top_scripts')
        <script>
            "use strict";
            var customFeatureI = -1;
        </script>
    @endpush
    @push('scripts')
        <script>
            "use strict";
            $(function() {
                $('.vironeer-color-picker').colorpicker();
            });
        </script>
    @endpush
@endsection
