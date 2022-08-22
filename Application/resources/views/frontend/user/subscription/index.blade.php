@extends('frontend.user.layouts.single')
@section('section', lang('User', 'user'))
@section('title', lang('Subscription', 'subscription'))
@section('content')
    <div class="settingsbox">
        @if (!subscription()->is_lifetime)
            @if (!subscription()->plan->free_plan && subscription()->is_expired && !subscription()->is_canceled)
                <div class="alert bg-danger text-white border-0">
                    <i class="fas fa-stopwatch me-2"></i>
                    {{ lang('Your subscription has been expired, Please renew it to continue using the service.', 'subscription') }}
                </div>
            @endif
            @if (!subscription()->plan->free_plan && subscription()->days->remining < 6 && !subscription()->is_expired && !subscription()->is_canceled)
                <div class="alert bg-warning text-dark border-0">
                    <i class="fas fa-stopwatch me-2"></i>
                    {{ lang('Your subscription is about expired, Renew it to avoid deleting your files.', 'subscription') }}
                </div>
            @endif
        @endif
        @if (subscription()->is_canceled)
            <div class="alert bg-danger text-white border-0">
                <i class="far fa-times-circle me-2"></i>
                {{ lang('Your subscription has been canceled, please contact us for more information', 'subscription') }}
            </div>
        @else
            <div class="row g-3 mb-4">
                @if (!subscription()->is_lifetime)
                    <div class="col-12 col-lg-6">
                        <div class="counter-card {{ subscription()->days->remining < 6 ? 'bg-danger' : 'color-1' }}">
                            <div class="stats">
                                <div class="stats-cont">
                                    <div class="stats-info">
                                        <p class="stats-title">
                                            {{ lang('Subscription expiration date', 'subscription') }}
                                        </p>
                                        <p class="stats-number mb-0">{{ subscription()->dates->expiration }}</p>
                                    </div>
                                    <div class="stats-icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12 {{ subscription()->is_lifetime ? 'col-lg-12' : 'col-lg-6' }}">
                    <div class="counter-card color-4">
                        <div class="stats">
                            <div class="stats-cont">
                                <div class="stats-info">
                                    <p class="stats-title">{{ lang('Your current plan', 'subscription') }}</p>
                                    <p class="stats-number mb-0">{{ subscription()->plan->name }}
                                        ({{ formatInterval(subscription()->plan->interval) }})</p>
                                </div>
                                <div class="stats-icon">
                                    <i class="far fa-gem"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($transactions->count() > 0)
                <div class="transactions-table">
                    <h5 class="fs-5 mb-4">{{ lang('Transactions', 'transactions') }}</h5>
                    <div class="table d-none d-lg-none d-xxl-block">
                        <table>
                            <thead>
                                <th>{{ lang('Transaction Number', 'transactions') }}</th>
                                <th class="text-center">{{ lang('Plan (Interval)', 'transactions') }}</th>
                                <th class="text-center">{{ lang('Plan Price', 'transactions') }}</th>
                                <th class="text-center">{{ lang('Total', 'transactions') }}</th>
                                <th class="text-center">{{ lang('Type', 'transactions') }}</th>
                                <th class="text-center">{{ lang('Status', 'transactions') }}</th>
                                <th class="text-center">{{ lang('Transaction date', 'transactions') }}</th>
                                <th class="text-center">{{ lang('Action', 'transactions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td><a href="{{ route('user.transaction', $transaction->transaction_id) }}"><i
                                                    class="fas fa-file-invoice-dollar me-2"></i>#{{ $transaction->transaction_id }}</a>
                                        </td>
                                        <td class="text-center text-capitalize">
                                            {{ $transaction->plan->name }}
                                            ({{ formatInterval($transaction->plan->interval) }})
                                        </td>
                                        <td class="text-center">
                                            {{ priceSymbol($transaction->details_before_discount->plan_price) }}
                                        </td>
                                        <td class="text-center">
                                            <strong>{{ priceSymbol($transaction->total_price) }}</strong>
                                        </td>
                                        <td class="text-center">
                                            {{ transactionAction($transaction->type) }}
                                        </td>
                                        <td class="text-center">
                                            @if ($transaction->plan_price != 0)
                                                @if ($transaction->status == 2)
                                                    <span
                                                        class="badge bg-success">{{ lang('Paid', 'transactions') }}</span>
                                                @elseif($transaction->status == 3)
                                                    <span
                                                        class="badge bg-danger">{{ lang('Canceled', 'transactions') }}</span>
                                                @endif
                                            @else
                                                @if ($transaction->status == 2)
                                                    <span
                                                        class="badge bg-green">{{ lang('Done', 'transactions') }}</span>
                                                @elseif($transaction->status == 3)
                                                    <span
                                                        class="badge bg-danger">{{ lang('Canceled', 'transactions') }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">{{ vDate($transaction->created_at) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('user.transaction', $transaction->transaction_id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="list card p-0 d-block d-lg-block d-xxl-none">
                        <div class="list-group list-group-flush">
                            @foreach ($transactions as $transaction)
                                <a href="{{ route('user.transaction', $transaction->transaction_id) }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span>

                                        <div class="mb-1">#{{ $transaction->transaction_id }}
                                        </div>
                                        <small class="text-muted d-block"><i
                                                class="far fa-calendar-alt me-1"></i>{{ vDate($transaction->created_at) }}</small>
                                    </span>
                                    <span><i class="icon fas fa-chevron-right"></i></span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {{ $transactions->links() }}
                </div>
            @else
                @include('frontend.user.includes.empty')
            @endif
        @endif
    </div>
@endsection
