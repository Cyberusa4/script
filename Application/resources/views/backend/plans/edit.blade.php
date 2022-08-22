@extends('backend.layouts.form')
@section('title', __('Edit plan | ') . $plan->name)
@section('container', 'container-max-lg')
@section('back', route('admin.plans.index'))
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
        @csrf
        @method('PUT')
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
                            <input type="checkbox" name="featured_plan" class="form-check-input"
                                {{ $plan->featured_plan ? 'checked' : '' }}>
                            <label>{{ __('Featured plan') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <input type="text" name="name" class="form-control" required value="{{ $plan->name }}"
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
                                <input type="text" name="color" class="form-control" value="{{ $plan->color }}"
                                    required>
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
                            <textarea name="short_description" class="form-control" required placeholder="{{ __('Max 150 character') }}">{{ $plan->short_description }}</textarea>
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
                            <select class="form-select" disabled>
                                <option value="1" {{ $plan->interval == 1 ? 'selected' : '' }}>
                                    {{ __('Monthly') }}
                                </option>
                                <option value="2" {{ $plan->interval == 2 ? 'selected' : '' }}>{{ __('Yearly') }}
                                </option>
                                <option value="3" {{ $plan->interval == 3 ? 'selected' : '' }}>
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
                            <input type="checkbox" name="free_plan" class="free-plan-checkbox form-check-input"
                                {{ $plan->free_plan ? 'checked' : '' }}>
                            <label>{{ __('Free') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-price">
                                <input type="text" name="price" class="form-control input-price"
                                    value="{{ price($plan->price) }}" placeholder="0.00" required
                                    {{ $plan->free_plan ? 'disabled' : '' }} />
                                <span
                                    class="input-group-text {{ $plan->free_plan ? 'disabled' : '' }}"><strong>{{ currencySymbolAndCode() }}</strong></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item require-login {{ $plan->free_plan ? '' : 'd-none' }}">
                    <div class="row align-items-center">
                        <div class="col-8 col-lg-8">
                            <label class="col-form-label"><strong>{{ __('Require Login') }} :</strong></label>
                        </div>
                        <div class="col-4 col-lg-4">
                            <input type="checkbox" name="require_login" class="plan-require-login" data-toggle="toggle"
                                data-off="{{ __('No') }}" data-on="{{ __('Yes') }}"
                                {{ $plan->require_login ? 'checked' : '' }}>
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
                                class="form-check-input unlimited-storage-space-checkbox"
                                {{ !$plan->storage_space ? 'checked' : '' }}>
                            <label>{{ __('Unlimited') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-storage-space">
                                <input type="number" name="storage_space" class="form-control" placeholder="0"
                                    value="{{ $plan->storage_space / 1048576 }}" required
                                    {{ !$plan->storage_space ? 'disabled' : '' }}>
                                <span class="input-group-text {{ !$plan->storage_space ? 'disabled' : '' }}"><strong><i
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
                                class="form-check-input unlimited-file-size-checkbox"
                                {{ !$plan->file_size ? 'checked' : '' }}>
                            <label>{{ __('Unlimited') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-file-size">
                                <input type="number" name="file_size" class="form-control" placeholder="0"
                                    value="{{ $plan->file_size / 1048576 }}" required
                                    {{ !$plan->file_size ? 'disabled' : '' }}>
                                <span class="input-group-text {{ !$plan->file_size ? 'disabled' : '' }}"><strong><i
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
                                class="form-check-input files-duration-checkbox"
                                {{ !$plan->files_duration ? 'checked' : '' }}>
                            <label>{{ __('Unlimited time') }}</label>
                        </div>
                        <div class="col col-lg-4">
                            <div class="custom-input-group input-group plan-files-duration">
                                <input type="number" name="files_duration" class="form-control"
                                    value="{{ $plan->files_duration }}" placeholder="0" required
                                    {{ !$plan->files_duration ? 'disabled' : '' }} />
                                <span class="input-group-text {{ !$plan->files_duration ? 'disabled' : '' }}"><strong><i
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
                                    value="{{ $plan->upload_at_once }}" required>
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
                                {{ $plan->password_protection ? 'checked' : '' }}>
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
                                {{ $plan->advertisements ? 'checked' : '' }}>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div id="customFeaturesCard" class="card custom-card mb-3 {{ !$plan->custom_features ? 'd-none' : '' }}">
            <div class="card-header bg-secondary text-white">
                {{ __('Custom features') }}
            </div>
            <ul id="customFeatures" class="custom-list-group list-group list-group-flush plans-list-group">
                @if ($plan->custom_features)
                    @foreach ($plan->custom_features as $key => $value)
                        <li id="customFeature{{ $key }}" class="list-group-item">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <select name="custom_features[{{ $key }}][status]" class="form-select">
                                        <option value="0" {{ $value->status == 0 ? 'selected' : '' }}>
                                            {{ __('Not Included') }}
                                        </option>
                                        <option value="1" {{ $value->status == 1 ? 'selected' : '' }}>
                                            {{ __('Included') }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" name="custom_features[{{ $key }}][name]"
                                        placeholder="{{ __('Enter name') }}" class="form-control"
                                        value="{{ $value->name }}" required>
                                </div>
                                <div class="col-auto">
                                    <button type="button" data-id="{{ $key }}"
                                        class="removeFeature btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
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
            var customFeatureI = {{ $plan->custom_features ? count($plan->custom_features) - 1 : -1 }};
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
