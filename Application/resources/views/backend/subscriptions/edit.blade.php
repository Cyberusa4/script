@extends('backend.layouts.form')
@section('title', __('Edit Subscription for ' . $subscription->user->firstname . ' ' . $subscription->user->lastname))
@section('back', route('admin.subscriptions.index'))
@section('container', 'container-max-lg')
@section('content')
    @if (!$subscription->status)
        <div class="alert bg-danger text-white">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>{{ __('This subscription has been canceled') }}</strong>
        </div>
    @endif
    <div class="card text-center mb-3 p-4">
        <div class="card-body">
            <img src="{{ asset($subscription->user->avatar) }}"
                alt="{{ $subscription->user->firstname . ' ' . $subscription->user->lastname }}"
                class="rounded-circle mb-3">
            <h4 class="mb-3">{{ $subscription->user->firstname . ' ' . $subscription->user->lastname }}</h4>
            <a href="{{ route('admin.users.edit', $subscription->user->id) }}"
                class="btn btn-dark">{{ __('View details') }}</a>
        </div>
    </div>
    <form id="vironeer-submited-form" action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card p-2">
            <div class="card-body">
                <div class="mb-1">
                    <label class="form-label">{{ __('Status') }} : <span class="red">*</span></label>
                    <select name="status" class="form-select form-control-lg">
                        <option value="0" {{ $subscription->status == 0 ? 'selected' : '' }}>{{ __('Canceled') }}
                        </option>
                        <option value="1" {{ $subscription->status == 1 ? 'selected' : '' }}>{{ __('Active') }}
                        </option>
                    </select>
                </div>
                <div class="mb-1 mt-3">
                    <label class="form-label">{{ __('Plan') }} : <span class="red">*</span></label>
                    <select id="subscriptionPlan" name="plan" class="form-select form-control-lg" required>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}"
                                {{ $plan->interval == 2 ? 'data-lifetime=1' : 'data-lifetime=0' }}
                                {{ $subscription->plan->id == $plan->id ? 'selected' : '' }}>
                                {{ $plan->name }}
                                ({{ formatInterval($plan->interval) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="expirydateInput">
                    @if ($expiryAt)
                        <div class="mb-1 mt-3">
                            <label class="form-label">{{ __('Expiry at') }} : <span
                                    class="red">*</span></label>
                            <input type="datetime-local" name="expiry_at" class="form-control form-control-lg"
                                value="{{ $expiryAt }}" required>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection
