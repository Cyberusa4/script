@extends('frontend.filemanager.layouts.filemanager')
@section('section', lang('Filemanager', 'file manager'))
@section('title', $folder->name)
@section('section', lang('My Files', 'file manager'))
@section('search', true)
@section('selectbox', true)
@section('content')
    @push('navbar_actions')
        <a class="nav-link d-none d-md-flex" data-upload-btn>
            <i class="fas fa-upload"></i>
            <span>{{ lang('Upload', 'file manager') }}</span>
        </a>
        <a class="nav-link search-btn">
            <i class="fas fa-search me-0"></i>
        </a>
        <a href="#" class="nav-link d-none d-md-flex" data-bs-toggle="modal"
            data-bs-target="#filemanager-create-folder-modal">
            <i class="fas fa-folder-plus fa-lg me-0"></i>
        </a>
    @endpush
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
        <div class="file-manager-folders">
            <div class="file-manager-folders-header">
                <a href="{{ route('filemanager.index') }}">
                    <i class="fa fa-folder"></i> {{ lang('My Folders', 'file manager') }}
                </a>
            </div>
            <div class="file-manager-folders-body file-manager-myfiles-folders-body" ps></div>
        </div>
        <div class="file-manager-files">
            <div class="file-manager-files-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('filemanager.index') }}">
                                <i class="fa fa-home"></i>{{ lang('My Files', 'file manager') }}
                            </a>
                        </li>
                        @if (request()->routeIs('filemanager.showFolder'))
                            @foreach ($breadcrumbs as $breadcrumb)
                                <li class="breadcrumb-item {{ $folder->id == $breadcrumb->id ? 'active' : '' }}">
                                    <a
                                        href="{{ route('filemanager.showFolder', hashid($breadcrumb->id)) }}">{{ $breadcrumb->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ol>
                </nav>
            </div>
            <div class="file-manager-files-body file-manager-myfiles-body" ps></div>
            <div class="contextmenu">
                <a class="contextmenu-item" data-upload-btn>
                    <i class="fa fa-cloud-upload-alt"></i>
                    {{ lang('Upload', 'file manager') }}
                </a>
                <a class="contextmenu-item" data-bs-toggle="modal" data-bs-target="#filemanager-create-folder-modal">
                    <i class="fa fa-folder-plus"></i>
                    {{ lang('Create Folder', 'file manager') }}
                </a>
            </div>
        </div>
    </div>
    <div class="file-manager-navbottom">
        <a class="nav-link" data-upload-btn>
            <i class="fas fa-upload"></i>
            <span>{{ lang('Upload', 'file manager') }}</span>
        </a>
        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#filemanager-create-folder-modal">
            <i class="fas fa-folder-plus fa-lg me-0"></i>
            <span>{{ lang('Create Folder', 'file manager') }}</span>
        </a>
        <a class="nav-link theme-btn">
            <i class="fas fa-sun me-0"></i>
            <i class="fas fa-moon me-0"></i>
            <span>{{ lang('Theme', 'file manager') }}</span>
        </a>
    </div>
    @push('bottom_actions')
        @include('frontend.filemanager.includes.modals.createFolder')
        @include('frontend.filemanager.includes.modals.share')
        @include('frontend.filemanager.includes.modals.rename')
        @include('frontend.filemanager.includes.modals.protection')
        @include('frontend.global.includes.uploadbox')
    @endpush
    @push('config')
        <script>
            "use strict";
            const fileManagerConfig = {
                thisPage: "index",
                searchURL: "{{ route('filemanager.searchOnFolder', hashid($folder->id)) }}",
                loadFilesURL: "{{ route('filemanager.showFolder.load', hashid($folder->id)) }}",
                loadFoldersURL: "{{ route('filemanager.index.load.folders') }}",
                folderNameRequired: "{{ lang('Folder name required', 'file manager') }}",
                createFolderUrl: "{{ route('filemanager.createFolder') }}",
                loadFilesErrorMsg: "{{ lang('Failed to load files', 'file manager') }}",
                loadFoldersErrorMsg: "{{ lang('Failed to load folders', 'file manager') }}",
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
