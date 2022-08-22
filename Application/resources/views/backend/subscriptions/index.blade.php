@extends('backend.layouts.grid')
@section('title', __('Subscriptions'))
@section('add_modal', __('Add New'))
@section('content')
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6 col-xxl">
            <div class="vironeer-counter-box bg-c-4 h-100">
                <h3 class="vironeer-counter-box-title">{{ __('Active Subscriptions') }}</h3>
                <p class="vironeer-counter-box-number">{{ count($activeSubscriptions) }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="far fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xxl">
            <div class="vironeer-counter-box bg-c-7 h-100">
                <h3 class="vironeer-counter-box-title">{{ __('Expired Subscriptions') }}</h3>
                <p class="vironeer-counter-box-number">{{ count($expiredSubscriptions) }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="far fa-clock"></i>
                </span>
            </div>
        </div>
        @if (count($canceledSubscriptions) > 0)
            <div class="col-12 col-lg-6 col-xxl">
                <div class="vironeer-counter-box bg-c-1 h-100">
                    <h3 class="vironeer-counter-box-title">{{ __('Canceled Subscriptions') }}</h3>
                    <p class="vironeer-counter-box-number">{{ count($canceledSubscriptions) }}</p>
                    <span class="vironeer-counter-box-icon">
                        <i class="far fa-times-circle"></i>
                    </span>
                </div>
            </div>
        @endif
    </div>
    <div class="card custom-card custom-tabs mb-3">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation">
                    <button class="nav-link active me-2" id="active-tab" data-bs-toggle="tab" data-bs-target="#active"
                        type="button" role="tab" aria-controls="active" aria-selected="true"><i
                            class="far fa-check-circle me-2"></i>{{ __('Active') }}
                        ({{ count($activeSubscriptions) }})
                    </button>
                </li>
                <li role="presentation">
                    <button class="nav-link me-2" id="expired-tab" data-bs-toggle="tab" data-bs-target="#expired"
                        type="button" role="tab" aria-controls="expired" aria-selected="false"><i
                            class="far fa-clock me-2"></i>{{ __('Expired') }}
                        ({{ count($expiredSubscriptions) }})
                    </button>
                </li>
                @if (count($canceledSubscriptions) > 0)
                    <li role="presentation">
                        <button class="nav-link" id="canceled-tab" data-bs-toggle="tab" data-bs-target="#canceled"
                            type="button" role="tab" aria-controls="canceled" aria-selected="false"><i
                                class="far fa-times-circle me-2"></i>{{ __('Canceled') }}
                            ({{ count($canceledSubscriptions) }})
                        </button>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="card custom-card">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-20x">{{ __('User details') }}</th>
                            <th class="tb-w-7x">{{ __('Plan') }}</th>
                            <th class="tb-w-7x">{{ __('Subscribe at') }}</th>
                            <th class="tb-w-7x">{{ __('Expiring at') }}</th>
                            <th class="tb-w-3x">{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeSubscriptions as $activeSubscription)
                            <tr>
                                <td>{{ $activeSubscription->id }}</td>
                                <td>
                                    <div class="vironeer-user-box">
                                        <a class="vironeer-user-avatar"
                                            href="{{ route('admin.users.edit', $activeSubscription->user->id) }}">
                                            <img src="{{ asset($activeSubscription->user->avatar) }}">
                                        </a>
                                        <div>
                                            <a class="text-reset"
                                                href="{{ route('admin.users.edit', $activeSubscription->user->id) }}">
                                                {{ $activeSubscription->user->firstname . ' ' . $activeSubscription->user->lastname }}</a>
                                            <p class="text-muted mb-0">{{ $activeSubscription->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.plans.edit', $activeSubscription->plan->id) }}"
                                        style="color: {{ $activeSubscription->plan->color }}"><i
                                            class="far fa-gem me-2"></i>
                                        {{ $activeSubscription->plan->name }}
                                    </a>
                                </td>
                                <td>{{ vDate($activeSubscription->created_at) }}</td>
                                <td>
                                    @if ($activeSubscription->expiry_at)
                                        <span
                                            class="{{ isExpiry($activeSubscription->expiry_at) ? 'text-danger' : 'text-dark' }}">
                                            {{ vDate($activeSubscription->expiry_at) }}
                                        </span>
                                    @else
                                        <span>--</span>
                                    @endif
                                </td>
                                <td>
                                    @if (isExpiry($activeSubscription->expiry_at))
                                        <span class="badge bg-danger">{{ __('Expired') }}</span>
                                    @elseif($activeSubscription->status)
                                        <span class="badge bg-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-lg-4">{{ __('Canceled') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-sm-end dropdown-menu-lg"
                                            data-popper-placement="bottom-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.subscriptions.edit', $activeSubscription->id) }}"><i
                                                        class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.users.edit', $activeSubscription->user->id) }}"><i
                                                        class="fa fa-user me-2"></i>{{ __('User details') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('admin.subscriptions.destroy', $activeSubscription->id) }}"
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
            <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-20x">{{ __('User details') }}</th>
                            <th class="tb-w-7x">{{ __('Plan') }}</th>
                            <th class="tb-w-7x">{{ __('Subscribe at') }}</th>
                            <th class="tb-w-7x">{{ __('Expiring at') }}</th>
                            <th class="tb-w-3x">{{ __('Status') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expiredSubscriptions as $expiredSubscription)
                            <tr>
                                <td>{{ $expiredSubscription->id }}</td>
                                <td>
                                    <div class="vironeer-user-box">
                                        <a class="vironeer-user-avatar"
                                            href="{{ route('admin.users.edit', $expiredSubscription->user->id) }}">
                                            <img src="{{ asset($expiredSubscription->user->avatar) }}">
                                        </a>
                                        <div>
                                            <a class="text-reset"
                                                href="{{ route('admin.users.edit', $expiredSubscription->user->id) }}">
                                                {{ $expiredSubscription->user->firstname . ' ' . $expiredSubscription->user->lastname }}</a>
                                            <p class="text-muted mb-0">{{ $expiredSubscription->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.plans.edit', $expiredSubscription->plan->id) }}"
                                        style="color: {{ $expiredSubscription->plan->color }}"><i
                                            class="far fa-gem me-2"></i>
                                        {{ $expiredSubscription->plan->name }}
                                    </a>
                                </td>
                                <td>{{ vDate($expiredSubscription->created_at) }}</td>
                                <td>
                                    @if ($expiredSubscription->expiry_at)
                                        <span
                                            class="{{ isExpiry($expiredSubscription->expiry_at) ? 'text-danger' : 'text-dark' }}">
                                            {{ vDate($expiredSubscription->expiry_at) }}
                                        </span>
                                    @else
                                        <span>--</span>
                                    @endif
                                </td>
                                <td>
                                    @if (isExpiry($expiredSubscription->expiry_at))
                                        <span class="badge bg-danger">{{ __('Expired') }}</span>
                                    @elseif($expiredSubscription->status)
                                        <span class="badge bg-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-lg-4">{{ __('Canceled') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-sm-end dropdown-menu-lg"
                                            data-popper-placement="bottom-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.subscriptions.edit', $expiredSubscription->id) }}"><i
                                                        class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.users.edit', $expiredSubscription->user->id) }}"><i
                                                        class="fa fa-user me-2"></i>{{ __('User details') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('admin.subscriptions.destroy', $expiredSubscription->id) }}"
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
            @if (count($canceledSubscriptions) > 0)
                <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                    <table class="datatable-50 table w-100">
                        <thead>
                            <tr>
                                <th class="tb-w-2x">{{ __('#') }}</th>
                                <th class="tb-w-20x">{{ __('User details') }}</th>
                                <th class="tb-w-7x">{{ __('Plan') }}</th>
                                <th class="tb-w-7x">{{ __('Subscribe at') }}</th>
                                <th class="tb-w-7x">{{ __('Expiring at') }}</th>
                                <th class="tb-w-3x">{{ __('Status') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($canceledSubscriptions as $canceledSubscription)
                                <tr>
                                    <td>{{ $canceledSubscription->id }}</td>
                                    <td>
                                        <div class="vironeer-user-box">
                                            <a class="vironeer-user-avatar"
                                                href="{{ route('admin.users.edit', $canceledSubscription->user->id) }}">
                                                <img src="{{ asset($canceledSubscription->user->avatar) }}">
                                            </a>
                                            <div>
                                                <a class="text-reset"
                                                    href="{{ route('admin.users.edit', $canceledSubscription->user->id) }}">
                                                    {{ $canceledSubscription->user->firstname . ' ' . $canceledSubscription->user->lastname }}</a>
                                                <p class="text-muted mb-0">{{ $canceledSubscription->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('admin.plans.edit', $canceledSubscription->plan->id) }}"
                                            style="color: {{ $canceledSubscription->plan->color }}"><i
                                                class="far fa-gem me-2"></i>
                                            {{ $canceledSubscription->plan->name }}
                                        </a>
                                    </td>
                                    <td>{{ vDate($canceledSubscription->created_at) }}</td>
                                    <td>
                                        @if ($canceledSubscription->expiry_at)
                                            <span
                                                class="{{ isExpiry($canceledSubscription->expiry_at) ? 'text-danger' : 'text-dark' }}">
                                                {{ vDate($canceledSubscription->expiry_at) }}
                                            </span>
                                        @else
                                            <span>--</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (isExpiry($canceledSubscription->expiry_at) && $canceledSubscription->status)
                                            <span class="badge bg-danger">{{ __('Expired') }}</span>
                                        @elseif($canceledSubscription->status)
                                            <span class="badge bg-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge bg-lg-7">{{ __('Canceled') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-sm-end dropdown-menu-lg"
                                                data-popper-placement="bottom-end">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.subscriptions.edit', $canceledSubscription->id) }}"><i
                                                            class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.users.edit', $canceledSubscription->user->id) }}"><i
                                                            class="fa fa-user me-2"></i>{{ __('User details') }}</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider" />
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('admin.subscriptions.destroy', $canceledSubscription->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button
                                                            class="vironeer-able-to-delete dropdown-item text-danger"><i
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
            @endif
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h6 class="modal-title" id="addModalLabel">{{ __('New Subscription') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.subscriptions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('User') }} : <span class="red">*</span></label>
                            <select id="vironeer-select-user" name="user" class="form-select select2Modal" required>
                                <option></option>
                                @foreach ($users as $user)
                                    @if (is_null($user->subscription))
                                        <option value="{{ $user->id }}"
                                            @if (old('user') == $user->id) selected @endif>
                                            {{ $user->firstname . ' ' . $user->lastname }} ({{ $user->email }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">{{ __('Plan') }} : <span class="red">*</span></label>
                            <select name="plan" class="form-select" required>
                                <option value="" selected disabled>{{ __('Choose') }}</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}"
                                        @if (old('plan') == $plan->id) selected @endif>
                                        {{ $plan->name }}
                                        ({{ formatInterval($plan->interval) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
