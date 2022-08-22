@extends('frontend.layouts.previews')
@section('section', lang('Preview', 'preview'))
@section('title', $fileEntry->name)
@section('description', $fileEntry->description)
@section('body', 'body-pdf body-bg')
@section('content')
    <div class="fileviewer-body">
        <div class="fileviewer-controler py-2">
            <p class="mb-0 px-2">
                <span id="page_num">0</span> / <span id="page_count">0</span>
            </p>
        </div>
        <div class="fileviewer-file fileviewer-pdf" data-pdfDoc="{{ route('secure.file', hashid($fileEntry->id)) }}">
            <div id="pdfCanvas"></div>
        </div>
        @include('frontend.includes.preview-contextmenu')
    </div>
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/pdf/pdf.min.js') }}"></script>
    @endpush
@endsection
