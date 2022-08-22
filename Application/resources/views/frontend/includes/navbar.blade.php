<nav class="nav-bar">
    <div class="container d-flex align-items-center">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset($settings['website_light_logo']) }}" alt="{{ $settings['website_name'] }}" />
            <img src="{{ asset($settings['website_dark_logo']) }}" alt="{{ $settings['website_name'] }}" />
        </a>
        <div class="nav-bar-actions ms-auto">
            <div class="nav-bar-menu">
                <div class="overlay"></div>
                <div class="nav-bar-links">
                    <div class="d-flex justify-content-between w-100 mb-3 d-lg-none">
                        <button class="btn-close"></button>
                    </div>
                    @foreach ($navbarMenuLinks as $navbarMenuLink)
                        <a class="nav-bar-link"
                            {{ !$navbarMenuLink->type ? 'href=' . $navbarMenuLink->link . '' : 'data-link=' . $navbarMenuLink->link . '' }}>
                            {{ $navbarMenuLink->name }}
                        </a>
                    @endforeach
                    <div class="dropdown language">
                        <button data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="language-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            {{ getLangName() }}
                            <div class="language-arrow">
                                <i class="fas fa-chevron-down fa-xs"></i>
                            </div>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($languages as $language)
                                <li><a class="dropdown-item {{ app()->getLocale() == $language->code ? 'active' : '' }}"
                                        href="{{ langURL($language->code) }}">{{ $language->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @guest
                        <a href="{{ route('login') }}"
                            class="nav-bar-link btn btn-outline-white btn-sm me-3">{{ lang('Sign In', 'user') }}</a>
                        @if ($settings['website_registration_status'])
                            <a href="{{ route('register') }}"
                                class="nav-bar-link btn btn-white btn-sm">{{ lang('Sign Up', 'user') }}</a>
                        @endif
                    @endguest
                </div>
            </div>
            @auth
                <div class="user-menu ms-4" data-dropdown>
                    <div class="user-avatar">
                        <img src="{{ asset(userAuthInfo()->avatar) }}" alt="{{ userAuthInfo()->name }}" />
                    </div>
                    <p class="user-name mb-0 ms-2 d-none d-sm-block">{{ userAuthInfo()->name }} </p>
                    <div class="nav-bar-user-dropdown-icon ms-2 d-none d-sm-block">
                        <i class="fas fa-chevron-down fa-xs"></i>
                    </div>
                    <div class="user-menu-dropdown">
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
            @endauth
            <div class="nav-bar-menu-icon d-lg-none">
                <i class="fa fa-bars fa-lg"></i>
            </div>
        </div>
    </div>
</nav>
