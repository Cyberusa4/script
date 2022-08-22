@extends('backend.layouts.form')
@section('title', __('Edit slide') . ' #' . $slideshow->id)
@section('back', route('admin.slideshow.index'))
@section('container', 'container-max-lg')
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.slideshow.update', $slideshow->id) }}" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body mb-2">
                <div class="text-center mb-3">
                    @if ($slideshow->type == 1)
                        <img src="{{ $slideshow->source == 1 ? asset($slideshow->file) : $slideshow->file }}"
                            class="rounded" width="200" height="140">
                    @else
                        <video width="300" height="200" controls>
                            <source src="{{ $slideshow->source == 1 ? asset($slideshow->file) : $slideshow->file }}">
                            {{ __('Your browser does not support the video tag.') }}
                        </video>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Type') }} : <span class="red">*</span></label>
                    <select id="slideshowType" name="type" class="form-select" required>
                        <option value="" selected disabled>{{ __('Choose') }}</option>
                        <option value="1" {{ $slideshow->type == 1 ? 'selected' : '' }}>{{ __('Image') }}</option>
                        <option value="2" {{ $slideshow->type == 2 ? 'selected' : '' }}>{{ __('Video') }}</option>
                    </select>
                </div>
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Source') }} : <span class="red">*</span></label>
                        <select id="slideshowFileSource" name="source" class="form-select" required>
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            <option value="1" {{ $slideshow->source == 1 ? 'selected' : '' }}>{{ __('Upload') }}
                            </option>
                            <option value="2" {{ $slideshow->source == 2 ? 'selected' : '' }}>{{ __('URL') }}
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Delay duration') }} : <span
                                class="red">*</span></label>
                        <div class="input-group">
                            <input type="number" name="duration" class="form-control"
                                value="{{ $slideshow->duration }}">
                            <span class="input-group-text">{{ __('Seconds') }}</span>
                        </div>
                    </div>
                </div>
                <div class="slideshow-file-box">
                    @if ($slideshow->source == 2)
                        <div class="slideshow-url mt-3">
                            <label class="form-label">{{ __('Enter URL') }} : </label>
                            <input type="url" name="file" class="form-control" value="{{ $slideshow->file }}">
                        </div>
                    @endif
                    @if ($slideshow->source == 1)
                        <div class="slideshow-upload mt-3">
                            <label class="form-label">{{ __('Upload file') }} :</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="slideshow-types-alert alert alert-warning mt-3 mb-0">
                            <p class="mb-2">{{ __('Supported Types') }}</p>
                            <ul class="mb-0">
                                <li class="mb-1"><strong>{{ __('Image') }} :</strong> JPG, JPEG, PNG /
                                    (2560x1600px)
                                </li>
                                <li><strong>{{ __('Video') }} :</strong> MP4, WEBM</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection
