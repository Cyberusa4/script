@extends('frontend.layouts.pages')
@section('title', $page->title)
@section('description', $page->short_description)
@section('header_version', 'v2')
@section('content')
    <div class="container">
        <div class="page-card margin">
            <div class="page-card-body fw-light">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
