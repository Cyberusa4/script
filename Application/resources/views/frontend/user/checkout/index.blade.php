@extends('frontend.user.layouts.single')
@section('section', lang('User', 'user'))
@section('title', lang('Checkout', 'checkout'))
@section('content')
    <div class="checkout">
        @if ($transaction->type == 3)
            <div class="alert alert-danger">
                <h5>{{ lang('Important Notice !', 'checkout') }}</h5>
                <p class="mb-0">
                    {{ lang('When you upgrade the plan before your current plan expires, you will lose all the features in your current plan and move to the new plan, and the new plan period will be calculated and the old period removed.', 'checkout') }}
                </p>
            </div>
        @endif
        <div class="row g-3">
            <div class="col-12 col-lg-7 col-xl-8 order-2 order-lg-1">
                <form id="checkoutForm" action="{{ route('user.checkout.proccess', $transaction->checkout_id) }}"
                    method="POST">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="fs-6 text-uppercase mb-0">{{ lang('Payment Methods', 'checkout') }}</h6>
                        </div>
                        <div class="card-body">
                            @if ($transaction->total_price != 0)
                                <div class="row row-cols-1 row-cols-sm-2 g-3">
                                    @forelse ($paymentGateways as $paymentGateway)
                                        @if ($transaction->total_price >= $paymentGateway->min)
                                            <div class="col">
                                                <div class="payment-method">
                                                    <div class="payment-img">
                                                        <img src="{{ asset($paymentGateway->logo) }}">
                                                    </div>
                                                    <span class="payment-title">{{ $paymentGateway->name }}</span>
                                                    <input id="{{ $paymentGateway->symbol }}" type="radio"
                                                        class="form-check-input" name="payment_method"
                                                        value="{{ hashid($paymentGateway->id) }}"
                                                        @if ($loop->first) checked @endif>
                                                    <label class="form-check-label"
                                                        for="{{ $paymentGateway->symbol }}"></label>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <div class="col-lg-12">
                                            <div class="alert alert-info mb-0">
                                                {{ lang('No payment methods available right now please try again later.', 'checkout') }}
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            @else
                                <div class="alert alert-info mb-0">
                                    {{ lang('No payment method needed.', 'checkout') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="fs-6 text-uppercase mb-0">{{ lang('Billing address', 'checkout') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-sm-2 g-3 mb-3">
                                <div class="col">
                                    <label class="form-label">{{ lang('First Name', 'forms') }} : </label>
                                    <input type="firstname" class="form-control"
                                        placeholder="{{ lang('First Name', 'forms') }}" maxlength="50"
                                        value="{{ $user->firstname }}" readonly>
                                </div>
                                <div class="col">
                                    <label class="form-label">{{ lang('Last Name', 'forms') }} : </label>
                                    <input type="lastname" class="form-control"
                                        placeholder="{{ lang('Last Name', 'forms') }}" maxlength="50"
                                        value="{{ $user->lastname }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ lang('Address line 1', 'forms') }} : <span
                                        class="red">*</span></label>
                                <input type="text" name="address_1" class="form-control"
                                    value="{{ @$user->address->address_1 }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ lang('Address line 2', 'forms') }} :</label>
                                <input type="text" name="address_2" class="form-control"
                                    placeholder="{{ lang('Apartment, suite, etc. (optional)', 'forms') }}"
                                    value="{{ @$user->address->address_2 }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">{{ lang('City', 'forms') }} : <span
                                                class="red">*</span></label>
                                        <input type="text" name="city" class="form-control"
                                            value="{{ @$user->address->city }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">{{ lang('State', 'forms') }} : <span
                                                class="red">*</span></label>
                                        <input type="text" name="state" class="form-control"
                                            value="{{ @$user->address->state }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">{{ lang('Postal code', 'forms') }} : <span
                                                class="red">*</span></label>
                                        <input type="text" name="zip" class="form-control"
                                            value="{{ @$user->address->zip }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">{{ lang('Country', 'forms') }} : <span
                                        class="red">*</span></label>
                                <select name="country" class="form-select" required>
                                    @foreach (countries() as $country)
                                        <option value="{{ $country->id }}"
                                            @if ($country->name == @$user->address->country) selected @endif>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="protect d-flex d-lg-none">
                    <i class="fas fa-shield-alt"></i>
                    <div>
                        <span class="h6 text-uppercase mb-2 d-block">{{ lang('SSL Secure Payment', 'checkout') }}</span>
                        <p class="text-muted mb-0">
                            {{ lang('Your information is protected by 256-bit SSL encryption', 'checkout') }}
                        </p>
                    </div>
                </div>
                <div class="mt-3 d-flex d-lg-none">
                    @if ($transaction->total_price != 0)
                        <button type="submit" form="checkoutForm"
                            class="btn btn-primary btn-lg hvr-radial-out w-100">{{ lang('Pay Now', 'checkout') }}</button>
                    @else
                        <button type="submit" form="checkoutForm"
                            class="btn btn-primary btn-lg hvr-radial-out w-100">{{ lang('Continue', 'checkout') }}</button>
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-4 order-1 order-lg-2">
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="fs-6 text-uppercase mb-0">{{ lang('Order Summary', 'checkout') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="plan-payment">
                            <div class="plan-payment-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span
                                        class="text-capitalize">{{ $transaction->plan->name . ' ' . lang('Plan', 'checkout') }}
                                        ({{ formatInterval($transaction->plan->interval) }})
                                    </span>
                                    <span
                                        class="h6 mb-0">{{ priceSymbol($transaction->details_before_discount->plan_price) }}</span>
                                </div>
                                @if ($transaction->tax_price != 0)
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted">{{ lang('Tax', 'checkout') }}</span>
                                        <span
                                            class="mb-0">+{{ priceSymbol($transaction->details_before_discount->tax_price) }}</span>
                                    </div>
                                @endif
                                @if (!is_null($transaction->coupon_id))
                                    <div class="total d-flex justify-content-between align-items-center my-3">
                                        <span class="h6 mb-0">{{ lang('Subtotal', 'checkout') }}</span>
                                        <span
                                            class="h6 mb-0">{{ priceSymbol($transaction->details_before_discount->total_price) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted">{{ lang('Discount', 'checkout') }}
                                            ({{ $transaction->coupon->percentage }}%)</span>
                                        <span
                                            class="mb-0 text-danger">-{{ priceSymbol($transaction->details_before_discount->total_price - $transaction->details_after_discount->total_price) }}</span>
                                    </div>
                                    <div class="total d-flex justify-content-between align-items-center mt-3">
                                        <span class="h6 mb-0"><strong>{{ lang('Total', 'checkout') }}</strong></span>
                                        <span
                                            class="h6 mb-0"><strong>{{ priceSymbol($transaction->details_after_discount->total_price) }}</strong></span>
                                    </div>
                                @else
                                    <div class="total d-flex justify-content-between align-items-center mt-3">
                                        <span class="h6 mb-0"><strong>{{ lang('Total', 'checkout') }}</strong></span>
                                        <span
                                            class="h6 mb-0"><strong>{{ priceSymbol($transaction->total_price) }}</strong></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if ($transaction->total_price != 0)
                            <div class="alert alert-warning mb-0 mt-4">
                                {{ lang('Payment gateways may charge extra fees', 'checkout') }}
                            </div>
                        @endif
                    </div>
                </div>
                @if ($transaction->total_price != 0 || !is_null($transaction->coupon_id))
                    <div class="card p-4">
                        <div class="card-header mb-3">
                            <h6 class="fs-6 text-uppercase mb-0">{{ lang('Coupon Code', 'checkout') }}</h6>
                        </div>
                        <div class="card-body">
                            @if (!is_null($transaction->coupon_id))
                                <div
                                    class="d-flex justify-content-between align-items-center alert alert-primary mb-0 py-2">
                                    <span><i class="fas fa-ticket-alt me-2"></i>{{ $transaction->coupon->code }}</span>
                                    <form action="{{ route('user.checkout.coupon.remove', $transaction->checkout_id) }}"
                                        method="POST">
                                        @csrf
                                        <button class="-form btn btn-link p-0 m-0 text-danger">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('user.checkout.coupon.apply', $transaction->checkout_id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="coupon_code" class="form-control"
                                            placeholder="{{ lang('Enter coupon code', 'checkout') }}" max="20"
                                            value="{{ old('coupon_code') }}" required>
                                        <button class="btn btn-primary btn-md">{{ lang('Apply', 'checkout') }}</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="protect d-none d-lg-flex">
                    <i class="fas fa-shield-alt"></i>
                    <div>
                        <span class="h6 text-uppercase mb-2 d-block">{{ lang('SSL Secure Payment', 'checkout') }}</span>
                        <p class="text-muted mb-0">
                            {{ lang('Your information is protected by 256-bit SSL encryption', 'checkout') }}
                        </p>
                    </div>
                </div>
                <div class="mt-3 d-none d-lg-flex">
                    @if ($transaction->total_price != 0)
                        <button type="submit" form="checkoutForm"
                            class="btn btn-primary btn-lg hvr-radial-out w-100">{{ lang('Pay Now', 'checkout') }}</button>
                    @else
                        <button type="submit" form="checkoutForm"
                            class="btn btn-primary btn-lg hvr-radial-out w-100">{{ lang('Continue', 'checkout') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
