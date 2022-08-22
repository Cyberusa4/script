<header class="vironeer-page-header">
    <div class="vironeer-sibebar-icon me-auto">
        <i class="fa fa-bars fa-lg"></i>
    </div>
    <div class="button">
        <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-dark rounded-50"><i
                class="fa fa-eye me-2"></i>{{ __('Preview') }}</a>
    </div>
    <div class="vironeer-notifications ms-2" data-dropdown-v2>
        <div class="vironeer-notifications-title">
            <i class="far fa-bell"></i>
            <div class="counter">{{ $unreadAdminNotifications }}</div>
        </div>

        <div class="vironeer-notifications-menu">
            <div class="vironeer-notifications-header">
                <p class="vironeer-notifications-header-title mb-0">
                    {{ __('Notifications') }} ({{ $unreadAdminNotificationsAll }})</p>
                @if ($unreadAdminNotifications)
                    <a href="{{ route('admin.notifications.readall') }}"
                        class="ms-auto vironeer-link-confirm">{{ __('Mark All as Read') }}</a>
                @else
                    <span class="ms-auto text-muted">{{ __('Mark All as Read') }}</span>
                @endif
            </div>
            <div class="vironeer-notifications-body">
                @forelse ($adminNotifications as $adminNotification)
                    @if ($adminNotification->link)
                        <a class="vironeer-notification"
                            href="{{ route('admin.notifications.view', hashid($adminNotification->id)) }}">
                        @else
                            <div class="vironeer-notification">
                    @endif
                    <div class="vironeer-notification-image">
                        <img src="{{ $adminNotification->image }}" alt="{{ $adminNotification->title }}">
                    </div>
                    <div class="vironeer-notification-info">
                        <p class="vironeer-notification-title mb-0 d-flex justify-content-between align-items-center">
                            <span>{{ shortertext($adminNotification->title, 30) }}</span>
                            @if (!$adminNotification->status)
                                <span class="unread flashit"><i class="fas fa-circle"></i></span>
                            @endif
                        </p>
                        <p class="vironeer-notification-text mb-0">
                            {{ $adminNotification->created_at->diffforhumans() }}
                        </p>
                    </div>
                    @if ($adminNotification->link)
                        </a>
                    @else
            </div>
            @endif
        @empty
            <div class="empty">
                <small class="text-muted mb-0">{{ __('No notifications found') }}</small>
            </div>
            @endforelse
        </div>
        <a class="vironeer-notifications-footer" href="{{ route('admin.notifications.index') }}">
            {{ __('View All') }}
        </a>
    </div>
    </div>

    <div class="vironeer-user-menu">
        <div class="vironeer-user" id="dropdownMenuButton" data-bs-toggle="dropdown">
            <div class="vironeer-user-avatar">
                <img src="{{ asset(adminAuthInfo()->avatar) }}" alt="{{ adminAuthInfo()->name }}" />
            </div>
            <div class="vironeer-user-info d-none d-md-block">
                <p class="vironeer-user-title mb-0">{{ adminAuthInfo()->name }}</p>
                <p class="vironeer-user-text mb-0">{{ adminAuthInfo()->email }}</p>
            </div>
        </div>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="{{ route('admin.account.details') }}"><i
                        class="fa fa-edit me-2"></i>{{ __('Details') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.account.security') }}"><i
                        class="fa fa-lock me-2"></i>{{ __('Security') }}</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger"><i
                            class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}</button>
                </form>
            </li>
        </ul>
    </div>
</header>
