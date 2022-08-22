<aside class="file-manager-sidebar">
    <div class="overlay"></div>
    <div class="file-manager-sidebar-content">
        <a class="file-manager-sidebar-header" href="{{ route('user.settings') }}">
            <div class="user-avatar">
                <img src="{{ asset(userAuthInfo()->avatar) }}" alt="{{ userAuthInfo()->name }}"
                    title="{{ userAuthInfo()->name }}" />
            </div>
            <div class="user-info">
                <span class="user-title">{{ userAuthInfo()->name }}</span>
                <span class="user-text">{{ userAuthInfo()->email }}</span>
            </div>
        </a>
        <div class="file-manager-sidebar-links">
            <a href="{{ route('filemanager.index') }}"
                class="link {{ request()->routeIs('filemanager.index') || request()->routeIs('filemanager.showFolder') ? 'active' : '' }}">
                <i class="fa fa-folder"></i>{{ lang('My Files', 'file manager') }}
            </a>
            <a href="{{ route('filemanager.recent.index') }}"
                class="link {{ request()->routeIs('filemanager.recent.index') ? 'active' : '' }}">
                <i class="far fa-clock"></i>
                {{ lang('Recent files', 'file manager') }}
            </a>
            <a href="{{ route('filemanager.trash.index') }}"
                class="link {{ request()->routeIs('filemanager.trash.index') ? 'active' : '' }}"">
                <i class="far fa-trash-alt"></i>
                {{ lang('Trash', 'file manager') }} (<span
                    class="filemanager-trash-counter">{{ $trashedFileEntries }}</span>)
            </a>
        </div>
        <div class="file-manager-sidebar-links">
            @if (licenceType(2))
                <a href="{{ route('user.subscription') }}" class="link">
                    <i class="far fa-gem"></i>
                    {{ lang('Subscription', 'file manager') }}
                </a>
            @endif
            <a href="{{ route('user.settings') }}" class="link">
                <i class="fa fa-cog"></i>
                {{ lang('Settings', 'file manager') }}
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="link">
                <i class="fa fa-power-off"></i> {{ lang('Logout', 'file manager') }}
            </a>
            <form id="logout-form" class="d-inline" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
        <div class="file-manager-sidebar-footer">
            @php
                if (subscription()->storage->fullness > 80) {
                    $progressClass = 'space-danger';
                } elseif (subscription()->storage->fullness < 80 && subscription()->storage->fullness > 60) {
                    $progressClass = 'space-warning';
                } else {
                    $progressClass = '';
                }
            @endphp
            <div class="storage">
                @if (!subscription()->is_lifetime && subscription()->plan->storage_space)
                    <div class="storage-progress {{ $progressClass }}  v-{{ subscription()->storage->fullness }}">
                    </div>
                @endif
                <div class="storage-details">
                    <span>{{ subscription()->storage->used->format }} /
                        {{ subscription()->formates->storage_space }}</span>
                    @if (licenceType(2) && $countPlans > 1)
                        <a href="{{ route('user.plans') }}">{{ lang('Upgrade', 'subscription') }}</a>
                    @endif
                </div>
            </div>
            <div class="copyright">
                &copy; <span data-year></span>
                {{ $settings['website_name'] }}
            </div>
        </div>
    </div>
</aside>
