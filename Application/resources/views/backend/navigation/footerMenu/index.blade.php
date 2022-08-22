@extends('backend.layouts.form')
@section('section', __('Navigation'))
@section('title', $active . ' ' . __('Footer Menu'))
@section('container', 'container-max-lg')
@section('link', route('admin.footerMenu.create'))
@if ($footerMenuLinks->count() == 0)
    @section('btn_action', 'disabled')
@endif
@section('language', true)
@section('content')
    @if ($footerMenuLinks->count() > 0)
        <form id="vironeer-submited-form" action="{{ route('admin.footerMenu.sort') }}" method="POST">
            @csrf
            <input name="ids" id="ids" value="{{ $idsArray }}" hidden>
        </form>
        <div class="card mb-3">
            <ul class="vironeer-sort-menu custom-list-group list-group list-group-flush">
                @foreach ($footerMenuLinks as $footerMenuLink)
                    <li data-id="{{ $footerMenuLink->id }}"
                        class="list-group-item d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            <span class="vironeer-navigation-handle me-2 text-muted"><i class="fas fa-arrows-alt"></i></span>
                            {{ $footerMenuLink->name }}
                        </h5>
                        <div class="buttons">
                            <a href="{{ route('admin.footerMenu.edit', $footerMenuLink->id) }}"
                                class="vironeer-edit-footer-menu btn btn-blue btn-sm me-2"><i class="fa fa-edit"></i></a>
                            <form class="d-inline"
                                action="{{ route('admin.footerMenu.destroy', $footerMenuLink->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="vironeer-able-to-delete btn btn-danger btn-sm"><i
                                        class="far fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                @include('backend.includes.empty')
            </div>
        </div>
    @endif
    @if ($footerMenuLinks->count() > 0)
        @push('styles_libs')
            <link href="{{ asset('assets/vendor/libs/jquery/jquery-ui.min.css') }}" />
        @endpush
        @push('scripts_libs')
            <script src="{{ asset('assets/vendor/libs/jquery/jquery-ui.min.js') }}"></script>
        @endpush
    @endif
@endsection
