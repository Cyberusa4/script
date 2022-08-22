@extends('backend.layouts.form')
@section('title', __('Create feature'))
@section('back', route('admin.features.index'))
@section('container', 'container-max-lg')
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.features.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="card mb-3">
            <div class="card-body">
                <div class="vironeer-file-preview-box mb-3 bg-light p-4 text-center">
                    <div class="file-preview-box mb-3 d-none">
                        <img id="filePreview" src="#" class="rounded-3" height="100" width="100">
                    </div>
                    <button id="selectFileBtn" type="button"
                        class="btn btn-secondary mb-2">{{ __('Choose Image') }}</button>
                    <input id="selectedFileInput" type="file" name="image" accept="image/png, image/jpg, image/jpeg"
                        hidden required>
                    <small class="text-muted d-block">{{ __('Allowed (PNG, JPG, JPEG)') }}</small>
                    <small class="text-muted d-block">{{ __('Image will be resized into (120x120)') }}</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Language') }} :<span class="red">*</span></label>
                    <select name="lang" class="form-select select2" required>
                        <option></option>
                        @foreach ($adminLanguages as $adminLanguage)
                            <option value="{{ $adminLanguage->code }}" @if (old('lang') == $adminLanguage->code) selected @endif>
                                {{ $adminLanguage->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card p-2">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('Feature title') }} : <span class="red">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required
                        autofocus />
                </div>
                <div class="mb-0">
                    <label class="form-label">{{ __('Feature content') }} :
                        <small class="text-muted">({{ __('Max 600 characters, spaces allowed') }})</small><span
                            class="red">*</span></label>
                    <textarea name="content" rows="8" class="form-control" required>{{ old('content') }}</textarea>
                </div>
            </div>
        </div>
    </form>
@endsection
