<!DOCTYPE html>
<html lang="{{ getLang() }}">
<head>
    @include('frontend.includes.head')
    @include('frontend.includes.styles')
    {!! head_code() !!}
</head>
<body class="@yield('body')">
    <div class="fileviewer">
        <nav class="fileviewer-nav">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset($settings['website_light_logo']) }}" alt="{{ $settings['website_name'] }}" />
            </a>
            <div class="fileviewer-title">
                <span>{{ $fileEntry->name }}</span>
            </div>
            @if ($fileEntry->user_id)
                <div class="fileviewer-text">
                    <span>{{ str_replace('{username}', $fileEntry->user->username, lang('shared by "{username}"', 'preview')) }}</span>
                </div>
            @endif
            <div class="fileviewer-actions">
                <a class="fileviewer-action" data-bs-toggle="modal" data-bs-target="#share">
                    <i class="fas fa-share-alt"></i>
                    <span class="fileviewer-action-text">{{ lang('Share', 'preview') }}</span>
                </a>
                <a href="{{ route('file.download', $fileEntry->shared_id) }}" target="_blank"
                    class="fileviewer-action">
                    <i class="fas fa-download"></i>
                    <span class="fileviewer-action-text">{{ lang('Download', 'preview') }}</span>
                </a>
            </div>
        </nav>
        @yield('content')
    </div>
    @include('frontend.includes.shareModal')
    @include('frontend.configurations.config')
    @include('frontend.configurations.widgets')
    @include('frontend.includes.scripts')
</body>
</html>
