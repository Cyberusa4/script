<div class="card">
    <div class="settings-side">
        <div class="settings-user">
            <div class="settings-user-img mb-3">
                <img id="avatar_preview" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" />
                @if (request()->routeIs('user.settings'))
                    <div class="settings-user-img-change">
                        <input id="change_avatar" type="file" name="avatar" form="deatilsForm"
                            accept="image/jpg, image/jpeg, image/png" hidden />
                        <label for="change_avatar">
                            <i class="fa fa-camera"></i>
                        </label>
                    </div>
                @endif
            </div>
            <div class="settings-user-title">
                <p class="mb-0 h5">{{ $user->name }}</p>
            </div>
        </div>
        <div class="settings-links">
            <a href="{{ route('user.settings') }}"
                class="settings-link @if (request()->routeIs('user.settings')) active @endif">
                <i class="fa fa-edit"></i> {{ lang('Account details', 'user') }}
            </a>
            <a href="{{ route('user.settings.password') }}"
                class="settings-link @if (request()->routeIs('user.settings.password')) active @endif">
                <i class="fas fa-sync-alt"></i> {{ lang('Change Password', 'user') }}
            </a>
            <a href="{{ route('user.settings.2fa') }}"
                class="settings-link @if (request()->routeIs('user.settings.2fa')) active @endif">
                <i class="fas fa-fingerprint"></i> {{ lang('2FA Authentication', 'user') }}
            </a>
        </div>
    </div>
</div>
