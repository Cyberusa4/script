@extends('backend.layouts.form')
@section('section', __('Navigation'))
@section('title', $active . ' ' . __('Navbar Menu'))
@section('container', 'container-max-lg')
@section('link', route('admin.navbarMenu.create'))
@if ($navbarMenuLinks->count() == 0)
    @section('btn_action', 'disabled')
@endif
@section('language', true)
@section('content')
    @if ($navbarMenuLinks->count() > 0)
        <form id="vironeer-submited-form" action="{{ route('admin.navbarMenu.sort') }}" method="POST">
            @csrf
            <input name="ids" id="ids" value="{{ $idsArray }}" hidden>
        </form>
        <div class="card mb-3">
            <ul class="vironeer-sort-menu custom-list-group list-group list-group-flush">
                @foreach ($navbarMenuLinks as $navbarMenuLink)
                    <li data-id="{{ $navbarMenuLink->id }}"
                        class="list-group-item d-flex justify-content-between align-items-center">
                        <h5 class="m-0">
                            <span class="vironeer-navigation-handle me-2 text-muted"><i class="fas fa-arrows-alt"></i></span>
                            @if ($navbarMenuLink->page == 0)
                                {{ __('Home Page') }}
                            @else
                                {{ __('Other Pages') }}
                            @endif
                            <i class="fas fa-chevron-right me-1 ms-1"></i> <span
                                class="text-secondary">{{ $navbarMenuLink->name }}</span>
                        </h5>
                        <div class="buttons">
                            <a class="btn btn-blue btn-sm me-2"
                                href="{{ route('admin.navbarMenu.edit', $navbarMenuLink->id) }}"><i
                                    class="fa fa-edit"></i></a>
                            <form class="d-inline"
                                action="{{ route('admin.navbarMenu.destroy', $navbarMenuLink->id) }}" method="POST">
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
    @if ($navbarMenuLinks->count() > 0)
        @push('styles_libs')
            <link href="{{ asset('assets/vendor/libs/jquery/jquery-ui.min.css') }}" />
        @endpush
        @push('scripts_libs')
            <script src="{{ asset('assets/vendor/libs/jquery/jquery-ui.min.js') }}"></script>
        @endpush
    @endif
@endsection
