@extends('frontend.layouts.pages')
@section('title', lang('Contact Us'))
@section('bg', 'bg-light')
@section('header_version', 'v2')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="page-card margin">
                    <div class="page-card-body">
                        @include('frontend.includes.contactForm')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        {!! google_captcha() !!}
    @endpush
@endsection
