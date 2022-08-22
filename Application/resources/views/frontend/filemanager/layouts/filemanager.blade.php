<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('frontend.filemanager.includes.head')
</head>

<body>
    <div class="file-manager">
        @include('frontend.filemanager.includes.sidebar')
        <div class="file-manager-container">
            <nav class="file-manager-navbar @yield('navbar_bg')">
                <a href="{{ route('filemanager.index') }}" class="logo">
                    <img src="{{ asset($settings['website_light_logo']) }}" alt="{{ $settings['website_name'] }}"
                        title="{{ $settings['website_name'] }}" />
                </a>
                <div class="file-manager-navbar-actions">
                    @stack('navbar_actions')
                    @include('frontend.global.includes.language-menu')
                    @include('frontend.global.includes.notification-menu')
                    <a class="nav-link theme-btn d-none d-md-flex">
                        <i class="fas fa-sun me-0"></i>
                        <i class="fas fa-moon me-0"></i>
                    </a>
                    <a class="nav-link filters-btn">
                        <i class="fas fa-th me-0"></i>
                        <i class="fas fa-list me-0"></i>
                    </a>
                    <a class="nav-link sidebar-btn d-lg-none">
                        <i class="fas fa-bars me-0"></i>
                    </a>
                </div>
            </nav>
            @hasSection('search')
                <div class="file-manager-search">
                    <div class="icon">
                        <i class="fa fa-search"></i>
                    </div>
                    <input id="filemanager-search-input" type="text"
                        placeholder="{{ lang('Search on your files & folders', 'file manager') }}" />
                    <div class="close">
                        <div class="nav-link">
                            <i class="fa fa-times me-0"></i>
                        </div>
                    </div>
                </div>
            @endif
            @stack('selectbox')
            @yield('content')
        </div>
    </div>
    @stack('bottom_actions')
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    @endpush
    @include('frontend.configurations.config')
    @include('frontend.configurations.widgets')
    @include('frontend.global.includes.scripts')
</body>

</html>
