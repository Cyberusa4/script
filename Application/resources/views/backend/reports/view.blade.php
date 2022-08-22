@extends('backend.layouts.grid')
@section('section', __('Reported files'))
@section('title', __('Report | #') . $fileReport->id)
@section('back', route('admin.reports.index'))
@section('container', 'container-max-lg')
@section('content')
    <div class="card custom-card mb-2">
        <div class="card-header bg-c-7 text-white">
            {{ __('Report details') }}
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route($fileReport->fileEntry->user_id ? 'admin.uploads.users.view' : 'admin.uploads.guests.view', $fileReport->fileEntry->shared_id) }}"
                        target="_blank">
                        @if ($fileReport->fileEntry->type == 'image')
                            <img class="rounded-2"
                                src="{{ route('admin.uploads.secure', hashid($fileReport->fileEntry->id)) }}"
                                alt="{{ $fileReport->fileEntry->name }}" width="60" height="60">
                        @else
                            {!! fileIcon($fileReport->fileEntry->extension) !!}
                        @endif
                    </a>
                </div>
                <div class="flex-grow-1 ms-3">
                    <a href="{{ route($fileReport->fileEntry->user_id ? 'admin.uploads.users.view' : 'admin.uploads.guests.view', $fileReport->fileEntry->shared_id) }}"
                        target="_blank" class="text-dark">
                        <h5 class="mb-1">{{ shortertext($fileReport->fileEntry->name, 100) }}</h5>
                        <p class="mb-0 text-muted">{{ shortertext($fileReport->fileEntry->mime, 50) ?? __('Unknown') }}
                        </p>
                    </a>
                </div>
                <div class="flex-grow-3 ms-3">
                    <a href="{{ route($fileReport->fileEntry->user_id ? 'admin.uploads.users.view' : 'admin.uploads.guests.view', $fileReport->fileEntry->shared_id) }}"
                        target="_blank" class="btn btn-dark" target="_blank"><i
                            class="fa fa-eye me-2"></i>{{ __('View file details') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card custom-card mb-3">
        <div class="card-body">
            <div class="row g-3 mb-3">
                <div class="col-lg-6">
                    <label class="form-label">{{ __('Name') }} :</label>
                    <input type="name" class="form-control form-control-lg" value="{{ $fileReport->name }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">{{ __('Email') }} :</label>
                    <input type="email" class="form-control form-control-lg" value="{{ $fileReport->email }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Reason for reporting') }} :</label>
                <input type="email" class="form-control form-control-lg"
                    value="{{ reportReasons()[$fileReport->reason] }}" readonly>
            </div>
            <div class="mb-2">
                <label class="form-label">{{ __('Details') }} :</label>
                <textarea class="form-control" rows="8" readonly>{{ $fileReport->details }}</textarea>
            </div>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-body">
            <div class="row g-3">
                <div class="{{ $fileReport->admin_has_viewed ? 'col-lg-12' : 'col-lg-6' }}">
                    <form action="{{ route('admin.reports.destroy', $fileReport->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="vironeer-able-to-delete btn btn-danger btn-lg w-100"><i
                                class="far fa-trash-alt me-2"></i>{{ __('Delete') }}</button>
                    </form>
                </div>
                @if (!$fileReport->admin_has_viewed)
                    <div class="col-lg-6">
                        <form action="{{ route('admin.reports.markAsReviewed', $fileReport->id) }}" method="POST">
                            @csrf
                            <button class="vironeer-form-confirm btn btn-success btn-lg w-100"><i
                                    class="far fa-check-circle me-2"></i>{{ __('Mark as reviewed') }}</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @push('styles_libs')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/vironeer/vironeer-icons.min.css') }}">
    @endpush
@endsection
