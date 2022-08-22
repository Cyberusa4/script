<!DOCTYPE html>
<html lang="{{ getLang() }}">

<head>
    @include('frontend.global.includes.head')
    @include('frontend.global.includes.styles')
</head>

<body class="settings">
    <div class="file-manager settings">
        <div class="file-manager-container">
            <nav class="file-manager-navbar position-static">
                <div class="container-lg d-flex align-items-center">
                    <a href="{{ route('filemanager.index') }}" class="logo">
                        <img src="{{ asset($settings['website_light_logo']) }}" alt="{{ $settings['website_name'] }}"
                            title="{{ $settings['website_name'] }}" />
                    </a>
                    <div class="file-manager-navbar-actions">
                        @include('frontend.global.includes.language-menu')
                        @if (subscription()->is_subscribed)
                            @include('frontend.global.includes.notification-menu')
                        @endif
                        <a class="nav-link theme-btn">
                            <i class="fas fa-sun me-0"></i>
                            <i class="fas fa-moon me-0"></i>
                        </a>
                        <div class="user-menu mx-0" data-dropdown>
                            <div class="nav-link">
                                <div class="user-avatar">
                                    <img src="{{ asset(userAuthInfo()->avatar) }}"
                                        alt="{{ userAuthInfo()->name }}" />
                                </div>
                                <p class="user-name mb-0 ms-2 d-none d-sm-block">{{ userAuthInfo()->name }}</p>
                                <div class="nav-bar-user-dropdown-icon ms-2 d-none d-sm-block">
                                    <i class="fas fa-chevron-down fa-xs me-0"></i>
                                </div>
                            </div>
                            <div class="user-menu-dropdown">
                                @if (subscription()->is_subscribed)
                                    <a class="user-menu-link" href="{{ route('filemanager.index') }}">
                                        <i class="fas fa-folder-open"></i>
                                        {{ lang('My files', 'user') }}
                                    </a>
                                    @if (licenceType(2))
                                        <a class="user-menu-link" href="{{ route('user.subscription') }}">
                                            <i class="fas fa-gem"></i>
                                            {{ lang('My subscription', 'user') }}
                                        </a>
                                    @endif
                                    <a class="user-menu-link" href="{{ route('user.settings') }}">
                                        <i class="fa fa-cog"></i>
                                        {{ lang('Settings', 'user') }}
                                    </a>
                                @endif
                                <a class="user-menu-link text-danger" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i>
                                    {{ lang('Logout', 'user') }}
                                </a>
                            </div>
                            <form id="logout-form" class="d-inline" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="file-manager-content position-static h-100">
                <div class="container-lg">
                    <div class="row justify-content-between align-items-center mb-4 g-3">
                        <div class="col-auto">
                            <h5 class="fs-5 mb-2">@yield('title')</h5>
                            @include('frontend.user.includes.breadcrumb')
                        </div>
                        <div class="col-auto">
                            @hasSection('back')
                                <a href="@yield('back')" class="btn btn-gradient btn-md me-2"><i
                                        class="fas fa-arrow-left me-2"></i>{{ lang('Back', 'user') }}</a>
                            @endif
                            @hasSection('link')
                                <a href="@yield('link')" class="btn btn-primary btn-md me-2"><i
                                        class="fa fa-plus"></i></a>
                            @endif
                            @if (request()->routeIs('user.subscription'))
                                @if (!subscription()->is_canceled)
                                    @if (!subscription()->plan->free_plan && !subscription()->is_lifetime)
                                        <form class="d-inline me-2"
                                            action="{{ route('subscribe', [hashid(subscription()->plan->id), 'renew']) }}"
                                            method="POST">
                                            @csrf
                                            <button class="confirm-action-form btn btn-green"><i
                                                    class="fas fa-sync-alt"></i>
                                                <span
                                                    class="ms-2 d-none d-lg-inline">{{ lang('Renew Subscription', 'subscription') }}</span>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ $countPlans > 1 ? route('user.plans') : '#' }}"
                                        class="btn btn-primary {{ $countPlans > 1 ? '' : 'disabled' }}"><i
                                            class="far fa-gem"></i>
                                        <span
                                            class="ms-2 d-none d-lg-inline">{{ lang('Upgrade', 'subscription') }}</span>
                                    </a>
                                @endif
                            @endif
                            @if (request()->routeIs('user.notifications'))
                                @if ($unreadUserNotifications)
                                    <a class="confirm-action btn btn-gradient"
                                        href="{{ route('user.notifications.readall') }}">{{ lang('Make All as Read', 'user') }}</a>
                                @else
                                    <button class="btn btn-gradient"
                                        disabled>{{ lang('Make All as Read', 'user') }}</button>
                                @endif
                            @endif
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
            <footer class="footer mt-auto">
                <div class="container">
                    <div class="d-flex align-items-center flex-column flex-md-row">
                        <p class="text-muted mb-3 mb-md-0">&copy; <span data-year></span>
                            {{ $settings['website_name'] }} -
                            {{ lang('All rights reserved') }}.</p>
                        @if (count($footerMenuLinks) > 0)
                            <div class="footer-links ms-md-auto">
                                @foreach ($footerMenuLinks as $footerMenuLink)
                                    <div class="footer-link">
                                        <a href="{{ $footerMenuLink->link }}"
                                            class="link">{{ $footerMenuLink->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('frontend.configurations.config')
    @include('frontend.configurations.widgets')
    @include('frontend.global.includes.scripts')
</body>

</html>
