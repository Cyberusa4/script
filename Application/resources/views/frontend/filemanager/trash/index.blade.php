@extends('frontend.filemanager.layouts.filemanager')
@section('section', lang('File Manager', 'file manager'))
@section('title', lang('Trash', 'file manager'))
@section('navbar_bg', 'danger-navbar')
@section('content')
    @if ($countTrashedEntries)
        @push('navbar_actions')
            <a href="#" class="filemanager-trash-empty nav-link d-none d-md-flex trash-nav-links"
                data-url="{{ route('filemanager.trash.empty') }}"><i
                    class="far fa-trash-alt"></i>{{ lang('Empty Trash', 'file manager') }}</a>

            <a href="#" class="filemanager-trash-restore-all nav-link d-none d-md-flex trash-nav-links"
                data-url="{{ route('filemanager.trash.restore.all') }}"><i
                    class="fas fa-redo"></i>{{ lang('Restore All', 'file manager') }}</a>
        @endpush
    @endif
    <div class="file-manager-content">
        <div class="file-manager-files w-100">
            <div class="file-manager-files-header">
                <a href="{{ route('filemanager.trash.index') }}"><i
                        class="fas fa-trash-alt"></i>{{ lang('Trash Folder', 'file manager') }}</a>
            </div>
            <div class="file-manager-files-body file-manager-trash-files-body" ps></div>
        </div>
    </div>
    <div class="file-manager-navbottom file-manager-navbottom-danger">
        @if ($countTrashedEntries)
            <a href="#" class="filemanager-trash-empty nav-link trash-nav-links"
                data-url="{{ route('filemanager.trash.empty') }}"><i
                    class="far fa-trash-alt"></i>{{ lang('Empty Trash', 'file manager') }}</a>
            <a href="#" class="filemanager-trash-restore-all nav-link trash-nav-links"
                data-url="{{ route('filemanager.trash.restore.all') }}"><i
                    class="fas fa-redo"></i>{{ lang('Restore All', 'file manager') }}</a>
        @endif
        <a class="nav-link theme-btn">
            <i class="fas fa-sun me-0"></i>
            <i class="fas fa-moon me-0"></i>
            <span>{{ lang('Theme', 'file manager') }}</span>
        </a>
    </div>
    @push('config')
        <script>
            "use strict";
            const fileManagerConfig = {
                loadFilesURL: "{{ route('filemanager.trash.load.files') }}",
                loadFilesErrorMsg: "{{ lang('Failed to load files', 'file manager') }}",
            };
            let fileManagerConfigObjects = JSON.stringify(fileManagerConfig),
                getFileManagerConfig = JSON.parse(fileManagerConfigObjects);
        </script>
    @endpush
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/progressbar/progressbar.min.js') }}"></script>
    @endpush
@endsection
