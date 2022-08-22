@extends('frontend.user.layouts.single')
@section('section', lang('User', 'user'))
@section('title', lang('Transaction details', 'transactions') . ' #' . $transaction->transaction_id)
@section('back', route('user.subscription'))
@section('content')
    <div class="settingsbox">
        @if ($transaction->status == 3)
            <div class="alert bg-danger text-white">
                <p class="mb-0"><strong>{{ lang('Transaction has been canceled', 'transactions') }}</strong></p>
                @if ($transaction->cancellation_reason)
                    <p class="mb-0 mt-1"><i
                            class="fas fa-quote-left me-2"></i><i>{{ $transaction->cancellation_reason }}</i></p>
                @endif
            </div>
        @endif
        <div class="list card mb-3">
            <div class="card-header bg-primary text-white p-3 border-bottom-0">
                {{ lang('Transaction details', 'transactions') }}
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span><strong>{{ lang('Transaction Number', 'transactions') }}</strong></span>
                    <span>#{{ $transaction->transaction_id }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span><strong>{{ lang('Plan (Interval)', 'transactions') }}</strong></span>
                    <span class="text-capitalize">{{ $transaction->plan->name }}
                        {{ formatInterval($transaction->plan->interval) }}
                    </span>
                </li>
                @if ($transaction->coupon_id)
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span><strong>{{ lang('Coupon Code', 'transactions') }}</strong></span>
                        <span><i class="fas fa-ticket-alt me-2"></i>{{ $transaction->coupon->code }}</span>
                    </li>
                @endif
                @if ($transaction->gateway)
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span><strong>{{ lang('Payment method', 'transactions') }}</strong></span>
                        <span>{{ $transaction->gateway->name }}</span>
                    </li>
                @endif
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span><strong>{{ lang('Transaction Type', 'transactions') }}</strong></span>
                    <span>
                        {{ transactionAction($transaction->type) }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span><strong>{{ lang('Transaction Status', 'transactions') }}</strong></span>
                    <span>
                        @if ($transaction->plan_price != 0)
                            @if ($transaction->status == 2)
                                <span class="badge bg-success">{{ lang('Paid', 'transactions') }}</span>
                            @elseif($transaction->status == 3)
                                <span class="badge bg-danger">{{ lang('Canceled', 'transactions') }}</span>
                            @endif
                        @else
                            @if ($transaction->status == 2)
                                <span class="badge bg-green">{{ lang('Done', 'transactions') }}</span>
                            @elseif($transaction->status == 3)
                                <span class="badge bg-danger">{{ lang('Canceled', 'transactions') }}</span>
                            @endif
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span><strong>{{ lang('Transaction date', 'transactions') }}</strong></span>
                    <span><strong>{{ vDate($transaction->created_at) }}</strong></span>
                </li>
            </ul>
        </div>
        <div class="list card mb-3">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span><strong>{{ lang('Plan Price', 'transactions') }}</strong></span>
                    <span><strong>{{ priceSymbol($transaction->details_before_discount->plan_price) }}</strong></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span><strong>{{ lang('Taxes', 'transactions') }}</strong></span>
                    <span><strong>+{{ priceSymbol($transaction->details_before_discount->tax_price) }}</strong></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span><strong>{{ lang('Subtotal', 'transactions') }}</strong></span>
                    <span><strong>{{ priceSymbol($transaction->details_before_discount->total_price) }}</strong></span>
                </li>
                @if ($transaction->coupon_id)
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span><strong>{{ lang('Discount', 'transactions') }}</strong>
                            <span class="text-muted">({{ $transaction->coupon->percentage }}%)</span></span>
                        <span
                            class="text-danger"><strong>-{{ priceSymbol($transaction->details_before_discount->total_price - $transaction->details_after_discount->total_price) }}</strong></span>
                    </li>
                @endif
                @if ($transaction->gateway)
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span><strong>{{ lang('Gateway Fees', 'transactions') }}</strong></span>
                        <span><strong>+{{ priceSymbol($transaction->fees_price) }}</strong></span>
                    </li>
                @endif
            </ul>
        </div>
        <div class="list card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <span>
                        <h5 class="mb-0"><strong>{{ lang('Total', 'transactions') }}</strong></h5>
                    </span>
                    <span>
                        <h5 class="mb-0"><strong>{{ priceSymbol($transaction->total_price) }}</strong></h5>
                    </span>
                </li>
            </ul>
        </div>
    </div>
@endsection
