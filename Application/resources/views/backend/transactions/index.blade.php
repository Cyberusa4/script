@extends('backend.layouts.grid')
@section('title', __('Transactions'))
@section('content')
    <div class="row g-3 mb-3 transactions">
        <div class="col-12 col-lg-6 col-xxl-6">
            <div class="vironeer-counter-box bg-c-4">
                <h3 class="vironeer-counter-box-title">{{ __('Total Paid Amount') }}</h3>
                <p class="vironeer-counter-box-number">{{ priceSymbol($paidAmount['total']) }}</p>
                <hr>
                <div class="details">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span>{{ __('Subscriptions') }}</span>
                        <span>+ {{ priceSymbol($paidAmount['subscriptions']) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span>{{ __('Taxes') }}</span>
                        <span>+ {{ priceSymbol($paidAmount['taxes']) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <span>{{ __('Fees') }}</span>
                        <span>+ {{ priceSymbol($paidAmount['fees']) }}</span>
                    </div>
                </div>
                <span class="vironeer-counter-box-icon">
                    <i class="fas fa-receipt"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xxl-6">
            <div class="vironeer-counter-box bg-c-7">
                <h3 class="vironeer-counter-box-title">{{ __('Total Canceled Amount') }}</h3>
                <p class="vironeer-counter-box-number">{{ priceSymbol($canceledAmount['total']) }}</p>
                <hr>
                <div class="details">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span>{{ __('Subscriptions') }}</span>
                        <span>- {{ priceSymbol($canceledAmount['subscriptions']) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span>{{ __('Taxes') }}</span>
                        <span>- {{ priceSymbol($canceledAmount['taxes']) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <span>{{ __('Fees') }}</span>
                        <span>- {{ priceSymbol($canceledAmount['fees']) }}</span>
                    </div>
                </div>
                <span class="vironeer-counter-box-icon">
                    <i class="far fa-times-circle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="card custom-card custom-tabs mb-3">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation">
                    <button class="nav-link active me-2" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid"
                        type="button" role="tab" aria-controls="paid" aria-selected="true">{{ __('Paid') }}
                        ({{ count($paidTransactions) }})</button>
                </li>
                @if (count($freeTransactions) > 0)
                    <li role="presentation">
                        <button class="nav-link me-2" id="free-tab" data-bs-toggle="tab" data-bs-target="#free"
                            type="button" role="tab" aria-controls="free" aria-selected="false">{{ __('Free') }}
                            ({{ count($freeTransactions) }})</button>
                    </li>
                @endif
                @if (count($usesCouponTransactions) > 0)
                    <li role="presentation">
                        <button class="nav-link me-2" id="usescoupon-tab" data-bs-toggle="tab" data-bs-target="#usescoupon"
                            type="button" role="tab" aria-controls="usescoupon"
                            aria-selected="false">{{ __('With coupons') }}
                            ({{ count($usesCouponTransactions) }})</button>
                    </li>
                @endif
                <li role="presentation">
                    <button class="nav-link" id="canceled-tab" data-bs-toggle="tab" data-bs-target="#canceled"
                        type="button" role="tab" aria-controls="canceled" aria-selected="false">{{ __('Canceled') }}
                        ({{ count($canceledTransactions) }})</button>
                </li>
            </ul>
        </div>
    </div>
    <div class="card custom-card">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-3x">{{ __('Transaction number') }}</th>
                            <th class="tb-w-7x">{{ __('User') }}</th>
                            <th class="tb-w-3x">{{ __('Plan') }}</th>
                            <th class="tb-w-3x">{{ __('Total') }}</th>
                            <th class="tb-w-3x">{{ __('Gateway') }}</th>
                            <th class="tb-w-3x">{{ __('Type') }}</th>
                            <th class="tb-w-7x">{{ __('Created at') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paidTransactions as $paidTransaction)
                            <tr>
                                <td>{{ $paidTransaction->id }}</td>
                                <td><a
                                        href="{{ route('admin.transactions.edit', $paidTransaction->id) }}">#{{ $paidTransaction->transaction_id }}</a>
                                </td>
                                <td><a href="{{ route('admin.users.edit', $paidTransaction->user->id) }}"
                                        class="text-dark"><i class="fa fa-user me-2"></i>
                                        {{ $paidTransaction->user->firstname . ' ' . $paidTransaction->user->lastname }}
                                    </a>
                                </td>
                                <td><a href="{{ route('admin.plans.edit', $paidTransaction->plan->id) }}"
                                        style="color: {{ $paidTransaction->plan->color }}"><i
                                            class="far fa-gem me-2"></i>
                                        {{ $paidTransaction->plan->name }}
                                    </a>
                                </td>
                                <td><strong>{{ priceSymbol($paidTransaction->total_price) }}</strong></td>
                                <td>
                                    {!! $paidTransaction->gateway ? '<a href="' . route('admin.settings.gateways.edit', $paidTransaction->gateway->id) . '" class="text-dark"><i class="fas fa-external-link-alt me-2"></i>' . $paidTransaction->gateway->name . '</a>' : '--' !!}
                                </td>
                                <td>
                                    @if ($paidTransaction->type == 1)
                                        <span class="badge bg-lg-1">{{ __('Subscribe') }}</span>
                                    @elseif($paidTransaction->type == 2)
                                        <span class="badge bg-lg-2">{{ __('Renew') }}</span>
                                    @elseif($paidTransaction->type == 3)
                                        <span class="badge bg-lg-9">{{ __('Upgrade') }}</span>
                                    @endif
                                </td>
                                <td>{{ vDate($paidTransaction->created_at) }}</td>
                                <td>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.transactions.edit', $paidTransaction->id) }}"><i
                                                        class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('admin.transactions.destroy', $paidTransaction->id) }}"
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
            @if (count($freeTransactions) > 0)
                <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
                    <table class="datatable-50 table w-100">
                        <thead>
                            <tr>
                                <th class="tb-w-2x">{{ __('#') }}</th>
                                <th class="tb-w-3x">{{ __('Transaction number') }}</th>
                                <th class="tb-w-7x">{{ __('User') }}</th>
                                <th class="tb-w-7x">{{ __('Plan') }}</th>
                                <th class="tb-w-7x">{{ __('Total') }}</th>
                                <th class="tb-w-7x">{{ __('Type') }}</th>
                                <th class="tb-w-7x">{{ __('Created at') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($freeTransactions as $freeTransaction)
                                <tr>
                                    <td>{{ $freeTransaction->id }}</td>
                                    <td><a
                                            href="{{ route('admin.transactions.edit', $freeTransaction->id) }}">#{{ $freeTransaction->transaction_id }}</a>
                                    </td>
                                    <td><a href="{{ route('admin.users.edit', $freeTransaction->user->id) }}"
                                            class="text-dark"><i class="fa fa-user me-2"></i>
                                            {{ $freeTransaction->user->firstname . ' ' . $freeTransaction->user->lastname }}
                                        </a>
                                    </td>
                                    <td><a href="{{ route('admin.plans.edit', $freeTransaction->plan->id) }}"
                                            style="color: {{ $freeTransaction->plan->color }}"><i
                                                class="far fa-gem me-2"></i>
                                            {{ $freeTransaction->plan->name }}
                                        </a>
                                    </td>
                                    <td><strong>{{ priceSymbol($freeTransaction->total_price) }}</strong></td>
                                    <td>
                                        @if ($freeTransaction->type == 1)
                                            <span class="badge bg-lg-1">{{ __('Subscribe') }}</span>
                                        @elseif($freeTransaction->type == 2)
                                            <span class="badge bg-lg-2">{{ __('Renew') }}</span>
                                        @elseif($freeTransaction->type == 3)
                                            <span class="badge bg-lg-9">{{ __('Upgrade') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ vDate($freeTransaction->created_at) }}</td>
                                    <td>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-sm-end"
                                                data-popper-placement="bottom-end">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.transactions.edit', $freeTransaction->id) }}"><i
                                                            class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider" />
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('admin.transactions.destroy', $freeTransaction->id) }}"
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
            @if (count($usesCouponTransactions) > 0)
                <div class="tab-pane fade" id="usescoupon" role="tabpanel" aria-labelledby="usescoupon-tab">
                    <table class="datatable-50 table w-100">
                        <thead>
                            <tr>
                                <th class="tb-w-2x">{{ __('#') }}</th>
                                <th class="tb-w-3x">{{ __('Transaction number') }}</th>
                                <th class="tb-w-7x">{{ __('User') }}</th>
                                <th class="tb-w-3x">{{ __('Plan') }}</th>
                                <th class="tb-w-3x">{{ __('Total') }}</th>
                                <th class="tb-w-3x">{{ __('Coupon') }}</th>
                                <th class="tb-w-3x">{{ __('Gateway') }}</th>
                                <th class="tb-w-3x">{{ __('Type') }}</th>
                                <th class="tb-w-7x">{{ __('Created at') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usesCouponTransactions as $usesCouponTransaction)
                                <tr>
                                    <td>{{ $usesCouponTransaction->id }}</td>
                                    <td><a
                                            href="{{ route('admin.transactions.edit', $usesCouponTransaction->id) }}">#{{ $usesCouponTransaction->transaction_id }}</a>
                                    </td>
                                    <td><a href="{{ route('admin.users.edit', $usesCouponTransaction->user->id) }}"
                                            class="text-dark"><i class="fa fa-user me-2"></i>
                                            {{ $usesCouponTransaction->user->firstname . ' ' . $usesCouponTransaction->user->lastname }}
                                        </a>
                                    </td>
                                    <td><a href="{{ route('admin.plans.edit', $usesCouponTransaction->plan->id) }}"
                                            style="color: {{ $usesCouponTransaction->plan->color }}"><i
                                                class="far fa-gem me-2"></i>
                                            {{ $usesCouponTransaction->plan->name }}
                                        </a>
                                    </td>
                                    <td><strong>{{ priceSymbol($usesCouponTransaction->total_price) }}</strong></td>
                                    <td>
                                        @if (!$usesCouponTransaction->coupon->deleted_at)
                                            <a href="{{ route('admin.coupons.edit', $usesCouponTransaction->coupon->id) }}"
                                                class="text-dark">
                                                <i
                                                    class="fas fa-ticket-alt me-2"></i>{{ $usesCouponTransaction->coupon->code }}
                                            </a>
                                        @else
                                            <span><i
                                                    class="fas fa-ticket-alt me-2"></i>{{ $usesCouponTransaction->coupon->code }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! $usesCouponTransaction->gateway ? '<a href="' . route('admin.settings.gateways.edit', $usesCouponTransaction->gateway->id) . '" class="text-dark"><i class="fas fa-external-link-alt me-2"></i>' . $usesCouponTransaction->gateway->name . '</a>' : '--' !!}
                                    </td>
                                    <td>
                                        @if ($usesCouponTransaction->type == 1)
                                            <span class="badge bg-lg-1">{{ __('Subscribe') }}</span>
                                        @elseif($usesCouponTransaction->type == 2)
                                            <span class="badge bg-lg-2">{{ __('Renew') }}</span>
                                        @elseif($usesCouponTransaction->type == 3)
                                            <span class="badge bg-lg-9">{{ __('Upgrade') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ vDate($usesCouponTransaction->created_at) }}</td>
                                    <td>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-sm-end"
                                                data-popper-placement="bottom-end">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.transactions.edit', $usesCouponTransaction->id) }}"><i
                                                            class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider" />
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('admin.transactions.destroy', $usesCouponTransaction->id) }}"
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
            <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                <table class="datatable-50 table w-100">
                    <thead>
                        <tr>
                            <th class="tb-w-2x">{{ __('#') }}</th>
                            <th class="tb-w-3x">{{ __('Transaction number') }}</th>
                            <th class="tb-w-7x">{{ __('User') }}</th>
                            <th class="tb-w-3x">{{ __('Plan') }}</th>
                            <th class="tb-w-3x">{{ __('Total') }}</th>
                            <th class="tb-w-3x">{{ __('Gateway') }}</th>
                            <th class="tb-w-3x">{{ __('Type') }}</th>
                            <th class="tb-w-7x">{{ __('Created at') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($canceledTransactions as $canceledTransaction)
                            <tr>
                                <td>{{ $canceledTransaction->id }}</td>
                                <td><a
                                        href="{{ route('admin.transactions.edit', $canceledTransaction->id) }}">#{{ $canceledTransaction->transaction_id }}</a>
                                </td>
                                <td><a href="{{ route('admin.users.edit', $canceledTransaction->user->id) }}"
                                        class="text-dark"><i class="fa fa-user me-2"></i>
                                        {{ $canceledTransaction->user->firstname . ' ' . $canceledTransaction->user->lastname }}
                                    </a>
                                </td>
                                <td><a href="{{ route('admin.plans.edit', $canceledTransaction->plan->id) }}"
                                        style="color: {{ $canceledTransaction->plan->color }}"><i
                                            class="far fa-gem me-2"></i>
                                        {{ $canceledTransaction->plan->name }}
                                    </a>
                                </td>
                                <td><strong>{{ priceSymbol($canceledTransaction->total_price) }}</strong>
                                </td>
                                <td>
                                    {!! $canceledTransaction->gateway ? '<a href="' . route('admin.settings.gateways.edit', $canceledTransaction->gateway->id) . '" class="text-dark"><i class="fas fa-external-link-alt me-2"></i>' . $canceledTransaction->gateway->name . '</a>' : '--' !!}
                                </td>
                                <td>
                                    @if ($canceledTransaction->type == 1)
                                        <span class="badge bg-lg-1">{{ __('Subscribe') }}</span>
                                    @elseif($canceledTransaction->type == 2)
                                        <span class="badge bg-lg-2">{{ __('Renew') }}</span>
                                    @elseif($canceledTransaction->type == 3)
                                        <span class="badge bg-lg-9">{{ __('Upgrade') }}</span>
                                    @endif
                                </td>
                                <td>{{ vDate($canceledTransaction->created_at) }}</td>
                                <td>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.transactions.edit', $canceledTransaction->id) }}"><i
                                                        class="fa fa-eye me-2"></i>{{ __('View') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('admin.transactions.destroy', $canceledTransaction->id) }}"
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
