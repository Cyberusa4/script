@extends('backend.layouts.application')
@section('title', __('Dashboard'))
@section('access', 'Quick Access')
@section('content')
    @if (!$settings['mail_status'])
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ __('SMTP is not enabled, set it now to be able to recover the password and use all the features that needs to send an email.') }}
            <a href="{{ route('admin.settings.smtp') }}">{{ __('Take Action') }}</a>
        </div>
    @endif
    @if (licenceType(1))
        @include('backend.includes.counterboxes')
    @endif
    @if (licenceType(2))
        <div class="row g-3 mb-4">
            <div class="col-12 col-lg-6 col-xxl">
                <div class="vironeer-counter-box bg-c-4 h-100">
                    <h3 class="vironeer-counter-box-title">{{ __('Total Earnings') }}</h3>
                    <p class="vironeer-counter-box-number">{{ priceSymbol($totalEarnings) }}</p>
                    <small>{{ __('Taxes and fees included') }}</small>
                    <span class="vironeer-counter-box-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </span>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xxl">
                <div class="vironeer-counter-box bg-c-10 h-100">
                    <h3 class="vironeer-counter-box-title">{{ __('Today Earnings') }}</h3>
                    <p class="vironeer-counter-box-number">{{ priceSymbol($todayEarnings) }}</p>
                    <small>{{ __('Taxes and fees included') }}</small>
                    <span class="vironeer-counter-box-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </span>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xxl">
                <div class="vironeer-counter-box bg-c-9 h-100">
                    <h3 class="vironeer-counter-box-title">{{ __('Total Uploads') }}</h3>
                    <p class="vironeer-counter-box-number">{{ $totalUploads }}</p>
                    <small>{{ __('Folders not included') }}</small>
                    <span class="vironeer-counter-box-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-12 col-lg-4 col-xxl-4">
                <div class="card vhp-460">
                    <div class="vironeer-box v2">
                        <div class="vironeer-box-header mb-3">
                            <p class="vironeer-box-header-title large mb-0">{{ __('Recently transactions') }}</p>
                            <div class="vironeer-box-header-action ms-auto">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end">
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.transactions.index') }}">{{ __('View All') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="vironeer-box-body">
                            <div class="vironeer-random-lists">
                                @forelse ($transactions as $transaction)
                                    <div class="vironeer-random-list">
                                        <div class="vironeer-random-list-cont">
                                            <div class="vironeer-random-list-info">
                                                <div>
                                                    <a class="vironeer-random-list-title fs-exact-14"
                                                        href="{{ route('admin.transactions.edit', $transaction->id) }}">
                                                        #{{ $transaction->transaction_id }}
                                                    </a>
                                                    <p class="vironeer-random-list-text mb-0">
                                                        {{ $transaction->created_at->diffforhumans() }}
                                                    </p>
                                                </div>
                                                <div class="vironeer-random-list-action d-none d-lg-block">
                                                    <span class="text-success">+
                                                        <strong>{{ priceSymbol($transaction->total_price) }}</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    @include('backend.includes.emptysmall')
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xxl-8">
                <div class="card">
                    <div class="vironeer-box chart-bar">
                        <div class="vironeer-box-header">
                            <p class="vironeer-box-header-title large mb-0">{{ __('Earnings Statistics For This Week') }}
                            </p>
                            <div class="vironeer-box-header-action ms-auto">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end">
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.transactions.index') }}">{{ __('View Transactions') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="vironeer-box-body">
                            <div class="chart-bar">
                                <canvas height="380" id="vironeer-earnings-charts"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8 col-xxl-8">
            <div class="card">
                <div class="vironeer-box chart-bar">
                    <div class="vironeer-box-header">
                        <p class="vironeer-box-header-title large mb-0">{{ __('Users Statistics For This Week') }}</p>
                        <div class="vironeer-box-header-action ms-auto">
                            <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-sm-end">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.users.index') }}">{{ __('View All') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="vironeer-box-body">
                        <div class="chart-bar">
                            <canvas height="380" id="vironeer-users-charts"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xxl-4">
            <div class="card vhp-460">
                <div class="vironeer-box v2">
                    <div class="vironeer-box-header mb-3">
                        <p class="vironeer-box-header-title large mb-0">{{ __('Recently registered') }}</p>
                        <div class="vironeer-box-header-action ms-auto">
                            <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-sm-end">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.users.index') }}">{{ __('View All') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="vironeer-box-body">
                        <div class="vironeer-random-lists">
                            @forelse ($users as $user)
                                <div class="vironeer-random-list">
                                    <div class="vironeer-random-list-cont">
                                        <a class="vironeer-random-list-img" href="#">
                                            <img src="{{ asset($user->avatar) }}" />
                                        </a>
                                        <div class="vironeer-random-list-info">
                                            <div>
                                                <a class="vironeer-random-list-title fs-exact-14"
                                                    href="{{ route('admin.users.edit', $user->id) }}">
                                                    {{ $user->firstname . ' ' . $user->lastname }}
                                                </a>
                                                <p class="vironeer-random-list-text mb-0">
                                                    {{ $user->created_at->diffforhumans() }}
                                                </p>
                                            </div>
                                            <div class="vironeer-random-list-action d-none d-lg-block">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                @include('backend.includes.emptysmall')
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (licenceType(2))
        @include('backend.includes.counterboxes')
    @endif
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card pb-3">
                <div class="vironeer-box chart-bar">
                    <div class="vironeer-box-header">
                        <p class="vironeer-box-header-title large mb-0">
                            {{ __('Uploads Statistics For Current Month') }}
                        </p>
                        <div class="vironeer-box-header-action ms-auto">
                            <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-sm-end">
                                <li><a class="dropdown-item" href="">{{ __('View All') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="vironeer-box-body">
                        <div class="chart-bar">
                            <canvas height="400" id="vironeer-uploads-charts"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/chartjs/chart.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/admin/js/charts.js') }}"></script>
    @endpush
    @if (licenceType(2))
        @push('top_scripts')
            <script type="text/javascript">
                "use strict";
                const WEBSITE_CURRENCY = "{{ currencySymbol() }}";
            </script>
        @endpush
    @endif
@endsection
