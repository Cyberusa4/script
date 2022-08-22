@extends('frontend.layouts.previews')
@section('section', lang('Preview', 'preview'))
@section('title', $fileEntry->name)
@section('og_image', route('secure.file', hashid($fileEntry->id)))
@section('description', $fileEntry->description)
@section('body', 'overflow-hidden body-bg')
@section('content')
    <div class="fileviewer-body">
        <div class="fileviewer-file fileviewer-image">
            <img src="{{ route('secure.file', hashid($fileEntry->id)) }}" class="r-0" title="{{ $fileEntry->name }}"
                alt="{{ $fileEntry->name }}" />
        </div>
        @include('frontend.includes.preview-contextmenu')
    </div>
    <div class="fileviewer-controler">
        <div class="fileviewer-controler-item rotate-left">
            <i class="fas fa-undo"></i>
        </div>
        <div class="fileviewer-controler-item rotate-right">
            <i class="fas fa-undo"></i>
        </div>
        <div class="fileviewer-controler-item zoom-out">
            <i class="fas fa-search-minus"></i>
        </div>
        <div class="fileviewer-controler-item zoom-in">
            <i class="fas fa-search-plus"></i>
        </div>
    </div>
@endsection
