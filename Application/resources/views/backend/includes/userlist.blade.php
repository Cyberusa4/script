<div class="custom-card card mb-3">
    <div class="card-body text-center">
        <form id="changeUserAvatarForm" action="#" method="POST" enctype="multipart/form-data">
            <div class="avatar mb-3">
                <img id="filePreview" src="{{ asset($user->avatar) }}" class="rounded-circle border" width="150"
                    height="150">
                <input id="selectedFileInput" data-id="{{ $user->id }}" class="vironeer-user-avatar" type="file"
                    name="avatar" accept="image/png, image/jpg, image/jpeg" hidden>
                <span class="image-error-icon error-icon d-none"><i class="far fa-times-circle"></i></span>
            </div>
        </form>
        <div class="buttons">
            <button id="selectFileBtn" type="button" class="btn btn-secondary me-2"><i
                    class="fas fa-sync-alt me-2"></i>{{ __('Change') }}</button>
            <form class="d-inline" action="{{ route('admin.users.deleteAvatar', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="vironeer-able-to-delete btn btn-danger"><i
                        class="fas fa-times me-2"></i>{{ __('Remove') }}</button>
            </form>
        </div>
    </div>
    <ul class="custom-list-group list-group list-group-flush border-top">
        <li class="list-group-item d-flex justify-content-between"><span>{{ __('Username') }} :</span>
            <strong>{{ $user->username }}</strong>
        </li>
        <li class="list-group-item d-flex justify-content-between"><span>{{ __('Email ') }} :</span>
            <strong>{{ $user->email }}</strong>
        </li>
        <li class="list-group-item d-flex justify-content-between"><span>{{ __('Joined at') }} :</span>
            <strong>{{ vDate($user->created_at) }}</strong>
        </li>
    </ul>
</div>
<div class="custom-card card mb-3">
    <div class="custom-list-group list-group list-group-flush">
        <a href="{{ route('admin.users.edit', $user->id) }}"
            class="list-group-item list-group-item-action d-flex justify-content-between @if (request()->routeIs('admin.users.edit')) active @endif">
            <span><i class="fa fa-edit me-2"></i>{{ __('Account details') }}</span>
            <span><i class="fas fa-angle-right"></i></span>
        </a>
        <a href="{{ route('admin.users.logs', $user->id) }}"
            class="list-group-item list-group-item-action d-flex justify-content-between @if (request()->routeIs('admin.users.logs')) active @endif">
            <span><i class="fas fa-list-ul me-2"></i>{{ __('Login logs') }}</span>
            <span><i class="fas fa-angle-right"></i></span>
        </a>
        @if (licenceType(2) && $subscription)
            <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}"
                class="list-group-item list-group-item-action d-flex justify-content-between">
                <span><i class="far fa-gem me-2"></i>{{ __('Subscription') }}</span>
                <span><i class="fas fa-angle-right"></i></span>
            </a>
        @endif
        <a href="{{ route('admin.uploads.users.index') . '?user=' . hashid($user->id) }}"
            class="list-group-item list-group-item-action d-flex justify-content-between">
            <span><i class="fas fa-cloud-upload-alt me-2"></i>{{ __('Uploaded Files') }}</span>
            <span><i class="fas fa-angle-right"></i></span>
        </a>
    </div>
</div>
