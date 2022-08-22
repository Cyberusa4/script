@extends('backend.layouts.form')
@section('title', __('Create slide'))
@section('back', route('admin.slideshow.index'))
@section('container', 'container-max-lg')
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.slideshow.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body mb-2">
                <div class="mb-3">
                    <label class="form-label">{{ __('Type') }} : <span class="red">*</span></label>
                    <select id="slideshowType" name="type" class="form-select" required>
                        <option value="" selected disabled>{{ __('Choose') }}</option>
                        <option value="1">{{ __('Image') }}</option>
                        <option value="2">{{ __('Video') }}</option>
                    </select>
                </div>
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Source') }} : <span class="red">*</span></label>
                        <select id="slideshowFileSource" name="source" class="form-select" required>
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            <option value="1">{{ __('Upload') }}</option>
                            <option value="2">{{ __('URL') }}</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Delay duration') }} : <span
                                class="red">*</span></label>
                        <div class="input-group">
                            <input type="number" name="duration" class="form-control" value="1">
                            <span class="input-group-text">{{ __('Seconds') }}</span>
                        </div>
                    </div>
                </div>
                <div class="slideshow-file-box"></div>
            </div>
        </div>
    </form>
@endsection
