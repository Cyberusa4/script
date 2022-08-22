@extends('frontend.filemanager.layouts.filemanager')
@section('section', lang('File Manager', 'file manager'))
@section('title', lang('Recent files', 'file manager'))
@section('content')
    @push('selectbox')
        <div class="file-manager-selectbox">
            <div class="dropdown">
                <a class="dropdown-button selected-btn" data-bs-toggle="dropdown">
                    <i class="fas fa-cog"></i>
                    {{ lang('Selected', 'file manager') }} (<span class="fileLength"></span>) <i
                        class="fa fa-angle-down ms-1"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a class="dropdown-item text-danger filemanager-trash-selected" href="#"
                            data-url="{{ route('filemanager.trash.multiple') }}">
                            <i class="fa fa-trash-alt"></i> {{ lang('Move to Trash', 'file manager') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="file-manager-selectbox-actions ms-auto">
                <div class="nav-link selectbox-close">
                    <i class="fa fa-times me-0"></i>
                </div>
            </div>
        </div>
    @endpush
    <div class="file-manager-content">
        <div class="file-manager-files w-100">
            <div class="file-manager-files-header">
                <a href="{{ route('filemanager.recent.index') }}"><i
                        class="far fa-clock"></i>{{ lang('Recent files', 'file manager') }}</a>
            </div>
            <div class="file-manager-files-body file-manager-recent-files-body" ps></div>
        </div>
    </div>
    <div class="file-manager-navbottom">
        <a class="nav-link theme-btn">
            <i class="fas fa-sun me-0"></i>
            <i class="fas fa-moon me-0"></i>
            <span>{{ lang('Theme', 'file manager') }}</span>
        </a>
    </div>
    @push('bottom_actions')
        @include('frontend.filemanager.includes.modals.share')
        @include('frontend.filemanager.includes.modals.rename')
        @include('frontend.filemanager.includes.modals.protection')
    @endpush
    @push('config')
        <script>
            "use strict";
            const fileManagerConfig = {
                thisPage: "recent",
                loadFilesURL: "{{ route('filemanager.recent.load.files') }}",
                loadFilesErrorMsg: "{{ lang('Failed to load files', 'file manager') }}",
                fileNameRequired: "{{ lang('File name required', 'file manager') }}",
                noFilesSelectedError: "{{ lang('You have not selected any file', 'file manager') }}"
            };
            let fileManagerConfigObjects = JSON.stringify(fileManagerConfig),
                getFileManagerConfig = JSON.parse(fileManagerConfigObjects);
        </script>
    @endpush
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/progressbar/progressbar.min.js') }}"></script>
    @endpush
@endsection
