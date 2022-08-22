<aside class="vironeer-sidebar">
    <div class="overlay"></div>
    <div class="vironeer-sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="vironeer-sidebar-logo">
            <img src="{{ asset($settings['website_light_logo']) }}" alt="{{ $settings['website_name'] }}" />
        </a>
    </div>
    <div class="vironeer-sidebar-menu" data-simplebar>
        <div class="vironeer-sidebar-links">
            <p class="vironeer-sidebar-links-title mb-0">{{ __('General') }}</p>
            <div class="vironeer-sidebar-links-cont">
                <a href="{{ route('admin.dashboard') }}"
                    class="vironeer-sidebar-link @if (request()->segment(2) == 'dashboard') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-th-large"></i>{{ __('Dashboard') }}</span>
                    </p>
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="vironeer-sidebar-link @if (request()->segment(2) == 'users') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fa fa-users"></i>{{ __('Manage Users') }}</span>
                        @if ($unviewedUsersCount)
                            <span class="counter">{{ $unviewedUsersCount }}</span>
                        @endif
                    </p>
                </a>
                <div class="vironeer-sidebar-link @if (request()->segment(2) == 'uploads') active @endif" data-dropdown>
                    <p
                        class="vironeer-sidebar-link-title {{ $usersUnviewedUsersCount || $guestsUnviewedUsersCount ? 'exclamation' : '' }}">
                        <span class="me-3"><i class="fas fa-upload"></i>{{ __('Manage Uploads') }}</span>
                        @if ($usersUnviewedUsersCount || $guestsUnviewedUsersCount)
                            <span class="counter"><span class="fas fa-exclamation"></span></span>
                        @endif
                        <span class="arrow"><i class="fas fa-chevron-right fa-sm"></i></span>
                    </p>
                    <div class="vironeer-sidebar-link-menu">
                        <a href="{{ route('admin.uploads.users.index') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'users') current @endif">
                            <p class="vironeer-sidebar-link-title">
                                <span class="me-1">{{ __('Users Uploads') }}</span>
                                @if ($usersUnviewedUsersCount)
                                    <span class="counter">{{ formatNumber($usersUnviewedUsersCount) }}</span>
                                @endif
                            </p>
                        </a>
                        <a href="{{ route('admin.uploads.guests.index') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'guests') current @endif">
                            <p class="vironeer-sidebar-link-title">
                                <span class="me-1">{{ __('Guest Uploads') }}</span>
                                @if ($guestsUnviewedUsersCount)
                                    <span class="counter">{{ formatNumber($guestsUnviewedUsersCount) }}</span>
                                @endif
                            </p>
                        </a>
                    </div>
                </div>
                <a href="{{ route('admin.reports.index') }}"
                    class="vironeer-sidebar-link @if (request()->segment(2) == 'reports') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-flag"></i>{{ __('Reported Files') }}</span>
                        @if ($unviewedFileReports)
                            <span class="counter">{{ $unviewedFileReports }}</span>
                        @endif
                    </p>
                </a>
                @if (licenceType(2))
                    <a href="{{ route('admin.subscriptions.index') }}"
                        class="vironeer-sidebar-link @if (request()->segment(2) == 'subscriptions') current @endif">
                        <p class="vironeer-sidebar-link-title">
                            <span><i class="far fa-gem"></i>{{ __('Subscriptions') }}</span>
                            @if ($unviewedSubscriptions)
                                <span class="counter">{{ $unviewedSubscriptions }}</span>
                            @endif
                        </p>
                    </a>
                    <a href="{{ route('admin.transactions.index') }}"
                        class="vironeer-sidebar-link @if (request()->segment(2) == 'transactions') current @endif">
                        <p class="vironeer-sidebar-link-title">
                            <span><i class="fas fa-exchange-alt"></i>{{ __('Transactions') }}</span>
                            @if ($unviewedTransactionsCount)
                                <span class="counter">{{ $unviewedTransactionsCount }}</span>
                            @endif
                        </p>
                    </a>
                    <a href="{{ route('admin.plans.index') }}"
                        class="vironeer-sidebar-link @if (request()->segment(2) == 'plans') current @endif">
                        <p class="vironeer-sidebar-link-title">
                            <span><i class="fas fa-tags"></i>{{ __('Pricing Plans') }}</span>
                        </p>
                    </a>
                    <a href="{{ route('admin.coupons.index') }}"
                        class="vironeer-sidebar-link @if (request()->segment(2) == 'coupons') current @endif">
                        <p class="vironeer-sidebar-link-title">
                            <span><i class="fas fa-percent"></i>{{ __('Coupon Codes') }}</span>
                        </p>
                    </a>
                @endif
                <a href="{{ route('admin.advertisements.index') }}"
                    class="vironeer-sidebar-link @if (request()->segment(2) == 'advertisements') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-ad"></i>{{ __('Advertisements') }}</span>
                    </p>
                </a>
            </div>
        </div>
        <div class="vironeer-sidebar-links">
            <p class="vironeer-sidebar-links-title mb-0">{{ __('Application') }}</p>
            <div class="vironeer-sidebar-links-cont">
                <div class="vironeer-sidebar-link @if (request()->segment(2) == 'navigation') active @endif" data-dropdown>
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-bars"></i>{{ __('Navigation') }}</span>
                        <span class="arrow"><i class="fas fa-chevron-right fa-sm"></i></span>
                    </p>
                    <div class="vironeer-sidebar-link-menu">
                        <a href="{{ route('admin.navbarMenu.index') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'navbarMenu') current @endif">
                            <p class="vironeer-sidebar-link-title"><span>{{ __('Navbar Menu') }}</span></p>
                        </a>
                        <a href="{{ route('admin.footerMenu.index') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'footerMenu') current @endif">
                            <p class="vironeer-sidebar-link-title"><span>{{ __('Footer Menu') }}</span></p>
                        </a>
                    </div>
                </div>
                @if ($settings['website_blog_status'])
                    <div class="vironeer-sidebar-link  @if (request()->segment(2) == 'blog') active @endif" data-dropdown>
                        <p class="vironeer-sidebar-link-title">
                            <span><i class="fas fa-rss"></i>{{ __('Blog') }}</span>
                            <span class="arrow"><i class="fas fa-chevron-right fa-sm"></i></span>
                        </p>
                        <div class="vironeer-sidebar-link-menu">
                            <a href="{{ route('articles.index') }}"
                                class="vironeer-sidebar-link @if (request()->segment(3) == 'articles') current @endif">
                                <p class="vironeer-sidebar-link-title"><span>{{ __('Articles') }}</span></p>
                            </a>
                            <a href="{{ route('categories.index') }}"
                                class="vironeer-sidebar-link @if (request()->segment(3) == 'categories') current @endif">
                                <p class="vironeer-sidebar-link-title"><span>{{ __('Categories') }}</span></p>
                            </a>
                            <a href="{{ route('comments.index') }}"
                                class="vironeer-sidebar-link @if (request()->segment(3) == 'comments') current @endif">
                                <p class="vironeer-sidebar-link-title"><span>{{ __('Comments') }}</span>
                                    @if ($commentsNeedsAction)
                                        <span class="counter">{{ $commentsNeedsAction }}</span>
                                    @endif
                                </p>
                            </a>
                        </div>
                    </div>
                @endif
                <a href="{{ route('admin.settings.index') }}"
                    class="vironeer-sidebar-link @if (request()->segment(2) == 'settings') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fa fa-cog"></i>{{ __('Settings') }}</span>
                    </p>
                </a>
            </div>
        </div>
        <div class="vironeer-sidebar-links">
            <p class="vironeer-sidebar-links-title mb-0">{{ __('Additional') }}</p>
            <div class="vironeer-sidebar-links-cont">
                <div class="vironeer-sidebar-link @if (request()->segment(3) == 'popup-notice' || request()->segment(3) == 'custom-css') active @endif" data-dropdown>
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-plus-square"></i>{{ __('Extra Features') }}</span>
                        <span class="arrow"><i class="fas fa-chevron-right fa-sm"></i></span>
                    </p>
                    <div class="vironeer-sidebar-link-menu">
                        <a href="{{ route('admin.additional.notice') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'popup-notice') current @endif">
                            <p class="vironeer-sidebar-link-title"><span>{{ __('PopUp Notice') }}</span></p>
                        </a>
                        <a href="{{ route('admin.additional.css') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'custom-css') current @endif">
                            <p class="vironeer-sidebar-link-title"><span>{{ __('Custom CSS') }}</span></p>
                        </a>
                    </div>
                </div>
                <a href="{{ route('admin.additional.addons.index') }}"
                    class="vironeer-sidebar-link @if (request()->segment(3) == 'addons') current @endif">
                    <p class="vironeer-sidebar-link-title"><i
                            class="fas fa-puzzle-piece"></i><span>{{ __('Addons Manager') }}</span></p>
                </a>
                <a href="{{ route('admin.additional.cache') }}"
                    class="vironeer-link-confirm vironeer-sidebar-link">
                    <p class="vironeer-sidebar-link-title"><i
                            class="far fa-trash-alt"></i><span>{{ __('Clear Cache') }}</span></p>
                </a>
            </div>
        </div>
        <div class="vironeer-sidebar-links">
            <p class="vironeer-sidebar-links-title mb-0">{{ __('Others') }}</p>
            <div class="vironeer-sidebar-links-cont">
                <div class="vironeer-sidebar-link @if (request()->segment(2) == 'others') active @endif" data-dropdown>
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-layer-group"></i>{{ __('Manage sections') }}</span>
                        <span class="arrow"><i class="fas fa-chevron-right fa-sm"></i></span>
                    </p>
                    <div class="vironeer-sidebar-link-menu">
                        <a href="{{ route('admin.slideshow.index') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'slideshow') current @endif">
                            <p class="vironeer-sidebar-link-title"><span>{{ __('Slide Show') }}</span></p>
                        </a>
                        <a href="{{ route('admin.features.index') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'features') current @endif">
                            <p class="vironeer-sidebar-link-title"><span>{{ __('Home Features') }}</span></p>
                        </a>
                        <a href="{{ route('admin.faq.index') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'faq') current @endif">
                            <p class="vironeer-sidebar-link-title"><span>{{ __('Home FAQ') }}</span></p>
                        </a>
                        <a href="{{ route('admin.download.page') }}"
                            class="vironeer-sidebar-link @if (request()->segment(3) == 'download-page') current @endif">
                            <p class="vironeer-sidebar-link-title"><span>{{ __('Download Page') }}</span></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
