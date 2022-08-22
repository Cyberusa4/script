<!DOCTYPE html>
<html lang="{{ getLang() }}">
<head>
    @section('section', lang('Download', 'download page'))
    @section('title', $fileEntry->name)
    @include('frontend.includes.head')
    @push('styles_libs')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/vironeer/vironeer-icons.min.css') }}">
    @endpush
    @include('frontend.includes.styles')
    {!! head_code() !!}
</head>
<body class="reset-bg px-2">
    <header class="file-header">
        <div class="contain d-flex flex-column flex-lg-row">
            <div class="file-header-left">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset($settings['website_dark_logo']) }}" alt="{{ $settings['website_name'] }}" />
                </a>
                <div class="file-header-actions">
                    @auth
                        <div class="login">
                            <a href="{{ route('filemanager.index') }}" class="login-title redius-left">
                                <i class="fas fa-folder-open fa-lg me-2"></i>{{ lang('My files', 'user') }}
                            </a>
                        </div>
                        <div class="login dropdown" data-dropdown>
                            <a class="login-title redius-right">
                                <img src="{{ asset(userAuthInfo()->avatar) }}" alt="{{ userAuthInfo()->name }}" />
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <div class="login-menu">
                                <a href="{{ route('filemanager.index') }}">
                                    <i class="fas fa-folder-open me-2"></i>{{ lang('My files', 'user') }}
                                </a>
                                @if(licenceType(2))
                                    <a href="{{ route('user.subscription') }}">
                                        <i class="fas fa-gem me-2"></i>{{ lang('My subscription', 'user') }}
                                    </a>
                                @endif
                                <a href="{{ route('user.settings') }}">
                                    <i class="fas fa-cog me-2"></i>{{ lang('Settings', 'user') }}
                                </a>
                                <a href="#" class="text-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off me-2 text-danger"></i>{{ lang('Logout', 'user') }}
                                </a>
                            </div>
                            <form id="logout-form" class="d-inline" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="login">
                            <a href="{{ route('register') }}"
                                class="login-title redius-left">{{ lang('Sign Up', 'user') }}</a>
                        </div>
                        <div class="login">
                            <a href="{{ route('login') }}"
                                class="login-title redius-right">{{ lang('Sign In', 'user') }}</a>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="ms-lg-auto">
                {!! ads_download_page_header() !!}
            </div>
        </div>
    </header>
    <div class="section-content py-3">
        <div class="contain">
            <div class="row g-3">
                <div class="col-12 col-lg-4 order-2 order-lg-1">
                    <div class="d-flex justify-content-center flex-lg-column flex-wrap">
                        {!! ads_download_page_left_sidebar_top() !!}
                        {!! ads_download_page_left_sidebar_bottom() !!}
                    </div>
                </div>
                <div class="col-12 col-lg-8 order-1 order-lg-5">
                    <div class="filebox">
                        <div class="filebox-info">
                            {!! fileIcon($fileEntry->extension) !!}
                            <div class="filebox-desc mx-3">
                                <p class="filebox-title mb-2">{{ $fileEntry->name }}</p>
                                <div class="filebox-actions">
                                    <a data-bs-toggle="modal" data-bs-target="#share" rel="tooltip"
                                        data-bs-placement="top" title="{{ lang('Share File', 'download page') }}">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                    @php
                                        $reportFileStatus = auth()->user() && $fileEntry->user_id == userAuthInfo()->id ? false : true;
                                    @endphp
                                    @if ($reportFileStatus)
                                        <a data-bs-toggle="modal" data-bs-target="#report" rel="tooltip"
                                            data-bs-placement="top"
                                            title="{{ lang('Report File', 'download page') }}">
                                            <i class="far fa-flag"></i>
                                        </a>
                                    @endif
                                    @if (isFileSupportPreview($fileEntry->type))
                                        <a href="{{ route('file.preview', $fileEntry->shared_id) }}" target="_blank"
                                            rel="tooltip" data-bs-placement="top"
                                            title="{{ lang('Preview File', 'download page') }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="filebox-download">
                                @if ($settings['website_download_waiting_time'] != 0)
                                    @php
                                        $seconds = $settings['website_download_waiting_time'] > 1 ? lang('Seconds') : lang('Second');
                                    @endphp
                                    <button class="download-counter" disabled>
                                        {!! str_replace('{seconds}', '<span class="counter-number">' . $settings['website_download_waiting_time'] . '</span>' . $seconds, lang('Please Wait {seconds}', 'download page')) !!}
                                    </button>
                                @else
                                    <button
                                        class="download-link">{{ str_replace('{fileSize}', formatBytes($fileEntry->size), lang('Download ({fileSize})', 'download page')) }}</button>
                                @endif
                            </div>
                        </div>
                        <a class="filebox-upgrade" href="{{ route('register') }}">
                            <img src="{{ asset($settings['website_light_logo']) }}"
                                alt="{{ $settings['website_name'] }}" />
                            <span>
                                {{ lang('Create an account today and get 1 TB of space', 'download page') }}
                            </span>
                            <div class="learn-more">
                                {{ lang('Get started', 'download page') }}
                            </div>
                        </a>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 col-md-8">
                            <div class="px-3">
                                <div class="d-flex align-items-center mb-3">
                                    {!! fileIcon($fileEntry->extension, 'flex-shrink-0') !!}
                                    <div class="ms-3">
                                        <p class="mb-0 text-ellipsis">{{ $fileEntry->name }}</p>
                                        @if ($fileEntry->extension)
                                            <span class="h6">
                                                <strong>{{ str_replace('{file_extension}', strtoupper($fileEntry->extension), lang('File extension (.{file_extension})', 'download page')) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <p class="mb-1 small">
                                    <strong>{{ lang('File size', 'download page') }} :</strong>
                                    {{ formatBytes($fileEntry->size) }}
                                </p>
                                <p class="mb-1 small">
                                    <strong>{{ lang('Uploaded at', 'download page') }}:</strong>
                                    {{ vDate($fileEntry->created_at) }}
                                </p>
                                <div class="small mt-3">
                                    <p class="mb-2">
                                        <strong>{{ str_replace('{filename}', $fileEntry->name, lang('About {filename}', 'download page')) }}</strong>
                                    </p>
                                    <p clas="mb-0">{{ fileDescription($fileEntry) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            {!! ads_download_page_description() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($additionals['download_page_center_section_status'])
        <section class="section-content bg py-5">
            <div class="contain">
                <div class="section-content-header left mb-4">
                    <p class="section-content-title h4 mb-0">{{ $additionals['download_page_center_section_title'] }}
                    </p>
                </div>
                {!! $additionals['download_page_center_section_content'] !!}
            </div>
        </section>
    @endif
    @if ($settings['website_download_page_blog_posts_status'] && count($blogArticles) > 0 && $settings['website_blog_status'])
        <section class="section-content bg py-5">
            <div class="contain">
                <div class="section-content-header left mb-4">
                    <p class="section-content-title h4 mb-0">{{ lang('Latest blog posts', 'download page') }}</p>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                    @foreach ($blogArticles as $blogArticle)
                        <div class="col">
                            <div class="post post-sm">
                                <div class="post-header">
                                    <a href="{{ route('blog.article', $blogArticle->slug) }}">
                                        <div class="post-img"
                                            style="background-image: url({{ asset($blogArticle->image) }});">
                                        </div>
                                    </a>
                                    <a class="post-section"
                                        href="{{ route('blog.category', $blogArticle->blogCategory->slug) }}">{{ $blogArticle->blogCategory->name }}
                                    </a>
                                </div>
                                <div class="post-body">
                                    <div class="post-meta">
                                        <p class="post-author mb-0">
                                            <i class="fa fa-user"></i>
                                            {{ $blogArticle->admin->firstname }}
                                        </p>
                                        <time class="post-date">
                                            <i class="fa fa-calendar-alt"></i>
                                            {{ vDate($blogArticle->created_at) }}
                                        </time>
                                    </div>
                                    <a href="{{ route('blog.article', $blogArticle->slug) }}"
                                        class="post-title">{{ shortertext($blogArticle->title, 60) }}</a>
                                    <p class="post-text">{{ shortertext($blogArticle->short_description, 100) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm py-2">
                        {{ lang('View more', 'download page') }}<i class="fas fa-arrow-right fa-sm ms-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif
    {!! ads_download_page_down_bottom() !!}
    @if ($additionals['download_page_bottom_section_status'])
        <section class="section-content bg py-5">
            <div class="contain">
                <div class="section-content-header left mb-4">
                    <p class="section-content-title h4 mb-0">
                        {{ $additionals['download_page_bottom_section_title'] }}
                    </p>
                </div>
                {!! $additionals['download_page_bottom_section_content'] !!}
            </div>
        </section>
    @endif
    @if ($reportFileStatus)
        <div id="report" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ lang('Report this file', 'download page') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('file.report', $fileEntry->shared_id) }}" method="POST">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-lg-6">
                                    <label class="form-label">{{ lang('Name', 'download page') }} : <span
                                            class="red">*</span></label>
                                    <input type="name" name="name" class="form-control form-control-lg"
                                        value="{{ userAuthInfo()->name ?? '' }}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">{{ lang('Email', 'download page') }} : <span
                                            class="red">*</span></label>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        value="{{ userAuthInfo()->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ lang('Reason for reporting', 'download page') }} :
                                    <span class="red">*</span></label>
                                <select name="reason" class="form-select form-select-lg" required>
                                    @foreach (reportReasons() as $reasonsKey => $reasonsValue)
                                        <option value="{{ $reasonsKey }}">{{ $reasonsValue }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ lang('Details', 'download page') }} : <span
                                        class="red">*</span></label>
                                <textarea name="details" class="form-control" rows="7"
                                    placeholder="{{ lang('Describe the reason why you reported the file to a maximum of 600 characters', 'download page') }}"
                                    required></textarea>
                            </div>
                            {!! display_captcha() !!}
                            <button type="submit"
                                class="btn btn-primary">{{ lang('Send', 'download page') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @push('top_scripts')
        @php
            $downloadBtnTxt = str_replace('{fileSize}', formatBytes($fileEntry->size), lang('Download ({fileSize})', 'download page'));
        @endphp
        <script>
            "use strict";
            const downloadWaitingTime = "{{ $settings['website_download_waiting_time'] }}";
            const downloadBtnTxt = "{{ $downloadBtnTxt }}";
            const downloadingBtnTxt = "{{ lang('Downloading...', 'download page') }}";
            const downloadId = "{{ $fileEntry->shared_id }}";
        </script>
    @endpush
    @include('frontend.includes.shareModal')
    @section('footer_bg', 'bg-white')
    @include('frontend.includes.footer')
    @include('frontend.configurations.config')
    @include('frontend.configurations.widgets')
    @include('frontend.includes.scripts')
    {!! google_captcha() !!}
</body>
</html>
