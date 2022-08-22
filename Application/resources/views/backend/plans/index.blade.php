@extends('backend.layouts.grid')
@section('title', __('Pricing plans'))
@section('link', route('admin.plans.create'))
@section('content')
    <div class="card custom-card custom-tabs mb-3">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation">
                    <button class="nav-link active me-2" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly"
                        type="button" role="tab" aria-controls="monthly" aria-selected="true">{{ __('Monthly plans') }}
                        ({{ count($monthlyPlans) }})</button>
                </li>
                <li role="presentation">
                    <button class="nav-link me-2" id="yearly-tab" data-bs-toggle="tab" data-bs-target="#yearly"
                        type="button" role="tab" aria-controls="yearly" aria-selected="false">{{ __('Yearly plans') }}
                        ({{ count($yearlyPlans) }})</button>
                </li>
                <li role="presentation">
                    <button class="nav-link" id="lifetime-tab" data-bs-toggle="tab" data-bs-target="#lifetime"
                        type="button" role="tab" aria-controls="Lifetime" aria-selected="false">{{ __('Lifetime plans') }}
                        ({{ count($lifetimePlans) }})</button>
                </li>
            </ul>
        </div>
    </div>
    <div class="card custom-card">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-3x">{{ __('Name') }}</th>
                            <th class="tb-w-3x">{{ __('Storage space') }}</th>
                            <th class="tb-w-3x">{{ __('File size') }}</th>
                            <th class="tb-w-3x">{{ __('Files duration') }}</th>
                            <th class="tb-w-3x">{{ __('Price') }}</th>
                            <th class="tb-w-3x">{{ __('Interval') }}</th>
                            <th class="tb-w-3x">{{ __('Created date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthlyPlans as $monthlyPlan)
                            <tr class="item">
                                <td>{{ $monthlyPlan->id }}</td>
                                <td>
                                    {{ $monthlyPlan->name }}
                                    @if ($monthlyPlan->featured_plan || $monthlyPlan->free_plan)
                                        ({{ $monthlyPlan->featured_plan ? __('Featured') : '' }}{{ $monthlyPlan->featured_plan && $monthlyPlan->free_plan ? '/' : '' }}{{ $monthlyPlan->free_plan ? __('Free') : '' }})
                                    @endif
                                </td>
                                <td>{{ is_null($monthlyPlan->storage_space) ? __('Unlimited') : formatBytes($monthlyPlan->storage_space) }}
                                </td>
                                <td>{{ is_null($monthlyPlan->file_size) ? __('Unlimited') : formatBytes($monthlyPlan->file_size) }}
                                </td>
                                <td>
                                    @if (is_null($monthlyPlan->files_duration))
                                        {{ __('Unlimited time') }}
                                    @else
                                        {{ formatDays($monthlyPlan->files_duration) }}
                                    @endif
                                </td>
                                <td>
                                    <strong>
                                        @if ($monthlyPlan->free_plan)
                                            <span class="text-success">{{ __('Free') }}</span>
                                        @else
                                            <span class="text-dark">{{ priceSymbol($monthlyPlan->price) }}</span>
                                        @endif
                                    </strong>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ formatInterval($monthlyPlan->interval) }}</span>
                                </td>
                                <td>{{ vDate($monthlyPlan->created_at) }}</td>
                                <td>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.plans.edit', $monthlyPlan->id) }}"><i
                                                        class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.plans.destroy', $monthlyPlan->id) }}"
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
            <div class="tab-pane fade" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-3x">{{ __('Name') }}</th>
                            <th class="tb-w-3x">{{ __('Storage space') }}</th>
                            <th class="tb-w-3x">{{ __('File size') }}</th>
                            <th class="tb-w-3x">{{ __('Files duration') }}</th>
                            <th class="tb-w-3x">{{ __('Price') }}</th>
                            <th class="tb-w-3x">{{ __('Interval') }}</th>
                            <th class="tb-w-3x">{{ __('Created date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($yearlyPlans as $yearlyPlan)
                            <tr class="item">
                                <td>{{ $yearlyPlan->id }}</td>
                                <td>
                                    {{ $yearlyPlan->name }}
                                    @if ($yearlyPlan->featured_plan || $yearlyPlan->free_plan)
                                        ({{ $yearlyPlan->featured_plan ? __('Featured') : '' }}{{ $yearlyPlan->featured_plan && $yearlyPlan->free_plan ? '/' : '' }}{{ $yearlyPlan->free_plan ? __('Free') : '' }})
                                    @endif
                                </td>
                                <td>{{ is_null($yearlyPlan->storage_space) ? __('Unlimited') : formatBytes($yearlyPlan->storage_space) }}
                                </td>
                                <td>{{ is_null($yearlyPlan->file_size) ? __('Unlimited') : formatBytes($yearlyPlan->file_size) }}
                                </td>
                                <td>
                                    @if (is_null($yearlyPlan->files_duration))
                                        {{ __('Unlimited time') }}
                                    @else
                                        {{ formatDays($yearlyPlan->files_duration) }}
                                    @endif
                                </td>
                                <td>
                                    <strong>
                                        @if ($yearlyPlan->free_plan)
                                            <span class="text-success">{{ __('Free') }}</span>
                                        @else
                                            <span class="text-dark">{{ priceSymbol($yearlyPlan->price) }}</span>
                                        @endif
                                    </strong>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ formatInterval($yearlyPlan->interval) }}</span>
                                </td>
                                <td>{{ vDate($yearlyPlan->created_at) }}</td>
                                <td>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.plans.edit', $yearlyPlan->id) }}"><i
                                                        class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.plans.destroy', $yearlyPlan->id) }}"
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
            <div class="tab-pane fade" id="lifetime" role="tabpanel" aria-labelledby="lifetime-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-3x">{{ __('Name') }}</th>
                            <th class="tb-w-3x">{{ __('Storage space') }}</th>
                            <th class="tb-w-3x">{{ __('File size') }}</th>
                            <th class="tb-w-3x">{{ __('Files duration') }}</th>
                            <th class="tb-w-3x">{{ __('Price') }}</th>
                            <th class="tb-w-3x">{{ __('Interval') }}</th>
                            <th class="tb-w-3x">{{ __('Created date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lifetimePlans as $lifetimePlan)
                            <tr class="item">
                                <td>{{ $lifetimePlan->id }}</td>
                                <td>
                                    {{ $lifetimePlan->name }}
                                    @if ($lifetimePlan->featured_plan || $lifetimePlan->free_plan)
                                        ({{ $lifetimePlan->featured_plan ? __('Featured') : '' }}{{ $lifetimePlan->featured_plan && $lifetimePlan->free_plan ? '/' : '' }}{{ $lifetimePlan->free_plan ? __('Free') : '' }})
                                    @endif
                                </td>
                                <td>{{ is_null($lifetimePlan->storage_space) ? __('Unlimited') : formatBytes($lifetimePlan->storage_space) }}
                                </td>
                                <td>{{ is_null($lifetimePlan->file_size) ? __('Unlimited') : formatBytes($lifetimePlan->file_size) }}
                                </td>
                                <td>
                                    @if (is_null($lifetimePlan->files_duration))
                                        {{ __('Unlimited time') }}
                                    @else
                                        {{ formatDays($lifetimePlan->files_duration) }}
                                    @endif
                                </td>
                                <td>
                                    <strong>
                                        @if ($lifetimePlan->free_plan)
                                            <span class="text-success">{{ __('Free') }}</span>
                                        @else
                                            <span class="text-dark">{{ priceSymbol($lifetimePlan->price) }}</span>
                                        @endif
                                    </strong>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ formatInterval($lifetimePlan->interval) }}</span>
                                </td>
                                <td>{{ vDate($lifetimePlan->created_at) }}</td>
                                <td>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.plans.edit', $lifetimePlan->id) }}"><i
                                                        class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.plans.destroy', $lifetimePlan->id) }}"
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
        </div>
    </div>
@endsection
