@extends('backend.layouts.form')
@section('title', __('Download Page'))
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.download.page') }}" method="POST">
        @csrf
        <div class="row g-3 mb-4">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">{{ __('Download page center section') }}</div>
                    <div class="card-body">
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Status') }} :</label>
                                <input type="checkbox" name="download_page_center_section_status" data-toggle="toggle"
                                    @if ($additionals['download_page_center_section_status']) checked @endif>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Title') }} :</label>
                            <input type="text" name="download_page_center_section_title" class="form-control"
                                value="{{ $additionals['download_page_center_section_title'] }}">
                        </div>
                        <div class="mb-0">
                            <label class="form-label">{{ __('Content') }} :</label>
                            <textarea id="ckeditor1" name="download_page_center_section_content" rows="10" class="ckeditor form-control">{{ $additionals['download_page_center_section_content'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/sections/download-page-center-section.png') }}" width="100%">
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">{{ __('Download page bottom section') }}</div>
                    <div class="card-body">
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Status') }} :</label>
                                <input type="checkbox" name="download_page_bottom_section_status" data-toggle="toggle"
                                    @if ($additionals['download_page_bottom_section_status']) checked @endif>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Title') }} :</label>
                            <input type="text" name="download_page_bottom_section_title" class="form-control"
                                value="{{ $additionals['download_page_bottom_section_title'] }}">
                        </div>
                        <div class="mb-0">
                            <label class="form-label">{{ __('Content') }} :</label>
                            <textarea id="ckeditor2" name="download_page_bottom_section_content" rows="10" class="ckeditor form-control">{{ $additionals['download_page_bottom_section_content'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/sections/download-page-bottom-section.png') }}" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
