@extends('backend.layouts.grid')
@section('title', __('Users'))
@section('link', route('admin.users.create'))
@section('content')
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6 col-xxl">
            <div class="vironeer-counter-box bg-c-4">
                <h3 class="vironeer-counter-box-title">{{ __('Active') }}</h3>
                <p class="vironeer-counter-box-number">{{ formatNumber($activeUsersCount) }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fa fa-users"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xxl">
            <div class="vironeer-counter-box bg-c-7">
                <h3 class="vironeer-counter-box-title">{{ __('Banned') }}</h3>
                <p class="vironeer-counter-box-number">{{ formatNumber($bannedUserscount) }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fa fa-ban"></i>
                </span>
            </div>
        </div>
        @if (licenceType(2))
            <div class="col-12 col-lg-6 col-xxl">
                <div class="vironeer-counter-box bg-lg-1">
                    <h3 class="vironeer-counter-box-title">{{ __('Subscribed') }}</h3>
                    <p class="vironeer-counter-box-number">{{ formatNumber($subscribedUsersCount) }}</p>
                    <span class="vironeer-counter-box-icon">
                        <i class="far fa-gem"></i>
                    </span>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xxl">
                <div class="vironeer-counter-box bg-secondary">
                    <h3 class="vironeer-counter-box-title">{{ __('Unsubscribed') }}</h3>
                    <p class="vironeer-counter-box-number">{{ formatNumber($unSubscribedUsersCount) }}</p>
                    <span class="vironeer-counter-box-icon">
                        <i class="fas fa-user-slash"></i>
                    </span>
                </div>
            </div>
        @endif
    </div>
    <div class="custom-card card">
        <div class="card-header p-3 border-bottom-small">
            <form action="{{ request()->url() }}" method="GET">
                <div class="input-group vironeer-custom-input-group">
                    <input type="text" name="search" class="form-control" placeholder="{{ __('Search on users...') }}"
                        value="{{ request()->input('search') ?? '' }}" required>
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">{{ __('Filter') }}</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item"
                                href="{{ request()->url() . '?filter=active' }}">{{ __('Active') }}</a></li>
                        <li><a class="dropdown-item"
                                href="{{ request()->url() . '?filter=banned' }}">{{ __('Banned') }}</a></li>
                    </ul>
                </div>
            </form>
        </div>
        <div>
            @if ($users->count() > 0)
                <div class="table-responsive">
                    <table class="vironeer-normal-table table w-100">
                        <thead>
                            <tr>
                                <th class="tb-w-3x">#</th>
                                <th class="tb-w-20x">{{ __('User details') }}</th>
                                <th class="tb-w-7x">{{ __('Phone number') }}</th>
                                @if (licenceType(2))
                                    <th class="tb-w-3x text-center">{{ __('Subscription') }}</th>
                                @endif
                                <th class="tb-w-3x text-center">{{ __('Email status') }}</th>
                                <th class="tb-w-3x text-center">{{ __('Account status') }}</th>
                                <th class="tb-w-3x text-center">{{ __('Registred date') }}</th>
                                <th class="text-end"><i class="fas fa-sliders-h me-1"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <div class="vironeer-user-box">
                                            <a class="vironeer-user-avatar"
                                                href="{{ route('admin.users.edit', $user->id) }}">
                                                <img src="{{ asset($user->avatar) }}" alt="User" />
                                            </a>
                                            <div>
                                                <a class="text-reset"
                                                    href="{{ route('admin.users.edit', $user->id) }}">{{ shortertext($user->firstname . ' ' . $user->lastname, 50) }}</a>
                                                <p class="text-muted mb-0">{{ shortertext($user->email, 50) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ shortertext($user->mobile, 20) }}</td>
                                    @if (licenceType(2))
                                        <td class="text-center">
                                            @if ($user->subscription)
                                                @if (!$user->subscription->status)
                                                    <div class="badge bg-lg-7">{{ __('Canceled') }}</div>
                                                @elseif (isExpiry($user->subscription->expiry_at))
                                                    <div class="badge bg-danger">{{ __('Expired') }}</div>
                                                @else
                                                    <span class="badge bg-lg-1">{{ __('Subscribed') }}</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary">{{ __('Unsubscribed') }}</span>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        @if ($user->email_verified_at)
                                            <span class="badge bg-girl">{{ __('Verified') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('Unverified') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($user->status)
                                            <span class="badge bg-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('Banned') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ vDate($user->created_at) }}</td>
                                    <td>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-sm-end dropdown-menu-lg"
                                                data-popper-placement="bottom-end">
                                                @if (licenceType(2) && $user->subscription)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.subscriptions.edit', $user->subscription->id) }}"><i
                                                                class="far fa-gem me-2"></i>{{ __('Subscription') }}</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.uploads.users.index') . '?user=' . hashid($user->id) }}"><i
                                                            class="fas fa-cloud-upload-alt me-2"></i>{{ __('Uploaded Files') }}</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.users.edit', $user->id) }}"><i
                                                            class="fas fa-edit me-2"></i>{{ __('Account Details') }}</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider" />
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button class="vironeer-able-to-delete dropdown-item text-danger"><i
                                                                class="far fa-trash-alt me-2"></i>{{ __('Delete') }}</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                @include('backend.includes.empty')
            @endif
        </div>
    </div>
    {{ $users->links() }}
@endsection
