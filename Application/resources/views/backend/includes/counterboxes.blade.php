<div class="row g-3 mb-4">
    <div class="col-12 col-lg col-xxl">
        <div class="vironeer-counter-box bg-primary">
            <h3 class="vironeer-counter-box-title">{{ __('Users Uploads') }}</h3>
            <p class="vironeer-counter-box-number">{{ $totalUsersUploads }}</p>
            <span class="vironeer-counter-box-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </span>
        </div>
    </div>
    <div class="col-12 col-lg col-xxl">
        <div class="vironeer-counter-box bg-lg-5">
            <h3 class="vironeer-counter-box-title">{{ __('Guests Uploads') }}</h3>
            <p class="vironeer-counter-box-number">{{ $totalGuestsUploads }}</p>
            <span class="vironeer-counter-box-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </span>
        </div>
    </div>
    <div class="col-12 col-lg col-xxl">
        <div class="vironeer-counter-box bg-c-10">
            <h3 class="vironeer-counter-box-title">{{ __('Total Used Space') }}</h3>
            <p class="vironeer-counter-box-number">{{ $totalUsedSpace }}</p>
            <span class="vironeer-counter-box-icon">
                <i class="fas fa-database"></i>
            </span>
        </div>
    </div>
</div>
@if (licenceType(2))
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-1">
                <h3 class="vironeer-counter-box-title">{{ __('Pricing Plans') }}</h3>
                <p class="vironeer-counter-box-number">{{ $totalPlans }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fas fa-tags"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-3">
                <h3 class="vironeer-counter-box-title">{{ __('Subscriptions') }}</h3>
                <p class="vironeer-counter-box-number">{{ $totalSubscriptions }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="far fa-gem"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-5">
                <h3 class="vironeer-counter-box-title">{{ __('Transactions') }}</h3>
                <p class="vironeer-counter-box-number">{{ $totalTransactions }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fas fa-exchange-alt"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-7">
                <h3 class="vironeer-counter-box-title">{{ __('Coupons') }}</h3>
                <p class="vironeer-counter-box-number">{{ $totalCoupons }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fas fa-percent"></i>
                </span>
            </div>
        </div>
    </div>
@endif
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6 col-xxl">
        <div class="vironeer-counter-box bg-c-6">
            <h3 class="vironeer-counter-box-title">{{ __('Users') }}</h3>
            <p class="vironeer-counter-box-number">{{ $totalUsers }}</p>
            <span class="vironeer-counter-box-icon">
                <i class="fa fa-users"></i>
            </span>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xxl">
        <div class="vironeer-counter-box bg-c-12">
            <h3 class="vironeer-counter-box-title">{{ __('Reports') }}</h3>
            <p class="vironeer-counter-box-number">{{ $totalReportedFiles }}</p>
            <span class="vironeer-counter-box-icon">
                <i class="far fa-flag"></i>
            </span>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xxl">
        <div class="vironeer-counter-box bg-c-8">
            <h3 class="vironeer-counter-box-title">{{ __('Pages') }}</h3>
            <p class="vironeer-counter-box-number">{{ $totalPages }}</p>
            <span class="vironeer-counter-box-icon">
                <i class="far fa-file-alt"></i>
            </span>
        </div>
    </div>
    @if ($settings['website_blog_status'])
        <div class="col-12 col-lg-6 col-xxl">
            <div class="vironeer-counter-box bg-c-9">
                <h3 class="vironeer-counter-box-title">{{ __('Blog Articles') }}</h3>
                <p class="vironeer-counter-box-number">{{ $totalArticles }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fas fa-rss"></i>
                </span>
            </div>
        </div>
    @endif
</div>
