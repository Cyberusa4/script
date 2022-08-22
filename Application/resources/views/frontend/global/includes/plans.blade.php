@if (count(showPlansByInterval(2)) > 0 || count(showPlansByInterval(3)) > 0)
    <div class="d-flex justify-content-center mb-5">
        <div class="plan-switcher">
            <span class="plan-switcher-item active">{{ lang('Monthly') }}</span>
            <span class="plan-switcher-item">{{ lang('Yearly') }}</span>
            <span class="plan-switcher-item">{{ lang('Lifetime') }}</span>
        </div>
    </div>
@endif
<div class="plans">
    <div class="plans-item active">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-3 justify-content-center">
            @forelse (showPlansByInterval(1) as $plan)
                @php
                    $price = $plan->free_plan ? lang('Free') : currencySymbol() . price($plan->price) . '<span class="plan-price-text">/' . planIntervalName($plan->interval);
                    $storageSpace = $plan->storage_space ? formatBytes($plan->storage_space) : lang('Unlimited');
                    $fileSize = $plan->file_size ? formatBytes($plan->file_size) : lang('Unlimited');
                    $filesDuration = $plan->files_duration ? formatDays($plan->files_duration) : lang('Unlimited time');
                    $uploadAtOnce = str_replace('{count}', $plan->upload_at_once, $plan->upload_at_once > 1 ? lang('Upload {count} files at once', 'plans') : lang('Upload {count} file at once', 'plans'));
                @endphp
                <div class="col" data-aos="zoom-out" data-aos-duration="1000">
                    <div class="plan {{ planBadge($plan)->class }}">
                        {!! planBadge($plan)->name !!}
                        <p class="plan-title">{{ $plan->name }}</p>
                        <p class="plan-text">{{ $plan->short_description }}</p>
                        <div class="plan-price-content">
                            <div class="plan-price">
                                <div>{!! $price !!}</span></div>
                            </div>
                        </div>
                        <div class="plan-features">
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{storage_space}', '<strong>' . $storageSpace . '</strong>', lang('{storage_space} Storage space', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{file_size}', '<strong>' . $fileSize . '</strong>', lang('{file_size} Size per file', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{files_duration}', '<strong>' . $filesDuration . '</strong>', lang('Files available for {files_duration}', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{{ $uploadAtOnce }}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{{ $plan->advertisements ? lang('advertisements', 'plans') : lang('No advertisements', 'plans') }}</span>
                            </div>
                            @if ($plan->password_protection)
                                <div class="plan-feature-item">
                                    {!! featureStatus($plan->password_protection) !!}
                                    <span>{{ lang('Password protected files', 'plans') }}</span>
                                </div>
                            @endif
                            @if ($plan->custom_features)
                                @foreach ($plan->custom_features as $customFeature)
                                    @if ($customFeature->status == 1)
                                        <div class="plan-feature-item">
                                            {!! featureStatus($customFeature->status) !!}
                                            <span>{{ $customFeature->name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            @if (!$plan->password_protection)
                                <div class="plan-feature-item">
                                    {!! featureStatus($plan->password_protection) !!}
                                    <span>{{ lang('Password protected files', 'plans') }}</span>
                                </div>
                            @endif
                            @if ($plan->custom_features)
                                @foreach ($plan->custom_features as $customFeature)
                                    @if ($customFeature->status == 0)
                                        <div class="plan-feature-item">
                                            {!! featureStatus($customFeature->status) !!}
                                            <span>{{ $customFeature->name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        {!! planButton($plan) !!}
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info text-center">{{ lang('No plans available', 'plans') }}</div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="plans-item">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-3 justify-content-center">
            @forelse (showPlansByInterval(2) as $plan)
                @php
                    $price = $plan->free_plan ? lang('Free') : currencySymbol() . price($plan->price) . '<span class="plan-price-text">/' . planIntervalName($plan->interval);
                    $storageSpace = $plan->storage_space ? formatBytes($plan->storage_space) : lang('Unlimited');
                    $fileSize = $plan->file_size ? formatBytes($plan->file_size) : lang('Unlimited');
                    $filesDuration = $plan->files_duration ? formatDays($plan->files_duration) : lang('Unlimited time');
                    $uploadAtOnce = str_replace('{count}', $plan->upload_at_once, $plan->upload_at_once > 1 ? lang('Upload {count} files at once', 'plans') : lang('Upload {count} file at once', 'plans'));
                @endphp
                <div class="col" data-aos="zoom-out" data-aos-duration="1000">
                    <div class="plan {{ planBadge($plan)->class }}">
                        {!! planBadge($plan)->name !!}
                        <p class="plan-title">{{ $plan->name }}</p>
                        <p class="plan-text">{{ $plan->short_description }}</p>
                        <div class="plan-price-content">
                            <div class="plan-price">
                                <div>{!! $price !!}</span></div>
                            </div>
                        </div>
                        <div class="plan-features">
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{storage_space}', '<strong>' . $storageSpace . '</strong>', lang('{storage_space} Storage space', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{file_size}', '<strong>' . $fileSize . '</strong>', lang('{file_size} Size per file', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{files_duration}', '<strong>' . $filesDuration . '</strong>', lang('Files available for {files_duration}', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{{ $uploadAtOnce }}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{{ $plan->advertisements ? lang('advertisements', 'plans') : lang('No advertisements', 'plans') }}</span>
                            </div>
                            @if ($plan->password_protection)
                                <div class="plan-feature-item">
                                    {!! featureStatus($plan->password_protection) !!}
                                    <span>{{ lang('Password protected files', 'plans') }}</span>
                                </div>
                            @endif
                            @if ($plan->custom_features)
                                @foreach ($plan->custom_features as $customFeature)
                                    @if ($customFeature->status == 1)
                                        <div class="plan-feature-item">
                                            {!! featureStatus($customFeature->status) !!}
                                            <span>{{ $customFeature->name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            @if (!$plan->password_protection)
                                <div class="plan-feature-item">
                                    {!! featureStatus($plan->password_protection) !!}
                                    <span>{{ lang('Password protected files', 'plans') }}</span>
                                </div>
                            @endif
                            @if ($plan->custom_features)
                                @foreach ($plan->custom_features as $customFeature)
                                    @if ($customFeature->status == 0)
                                        <div class="plan-feature-item">
                                            {!! featureStatus($customFeature->status) !!}
                                            <span>{{ $customFeature->name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        {!! planButton($plan) !!}
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info text-center">{{ lang('No plans available', 'plans') }}</div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="plans-item">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-3 justify-content-center">
            @forelse (showPlansByInterval(3) as $plan)
                @php
                    $price = $plan->free_plan ? lang('Free') : currencySymbol() . price($plan->price) . '<span class="plan-price-text">/' . planIntervalName($plan->interval);
                    $storageSpace = $plan->storage_space ? formatBytes($plan->storage_space) : lang('Unlimited');
                    $fileSize = $plan->file_size ? formatBytes($plan->file_size) : lang('Unlimited');
                    $filesDuration = $plan->files_duration ? formatDays($plan->files_duration) : lang('Unlimited time');
                    $uploadAtOnce = str_replace('{count}', $plan->upload_at_once, $plan->upload_at_once > 1 ? lang('Upload {count} files at once', 'plans') : lang('Upload {count} file at once', 'plans'));
                @endphp
                <div class="col" data-aos="zoom-out" data-aos-duration="1000">
                    <div class="plan {{ planBadge($plan)->class }}">
                        {!! planBadge($plan)->name !!}
                        <p class="plan-title">{{ $plan->name }}</p>
                        <p class="plan-text">{{ $plan->short_description }}</p>
                        <div class="plan-price-content">
                            <div class="plan-price">
                                <div>{!! $price !!}</span></div>
                            </div>
                        </div>
                        <div class="plan-features">
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{storage_space}', '<strong>' . $storageSpace . '</strong>', lang('{storage_space} Storage space', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{file_size}', '<strong>' . $fileSize . '</strong>', lang('{file_size} Size per file', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{!! str_replace('{files_duration}', '<strong>' . $filesDuration . '</strong>', lang('Files available for {files_duration}', 'plans')) !!}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{{ $uploadAtOnce }}</span>
                            </div>
                            <div class="plan-feature-item">
                                <div class="plan-feature-icon">
                                    <i class="fa fa-check fa-sm"></i>
                                </div>
                                <span>{{ $plan->advertisements ? lang('advertisements', 'plans') : lang('No advertisements', 'plans') }}</span>
                            </div>
                            @if ($plan->password_protection)
                                <div class="plan-feature-item">
                                    {!! featureStatus($plan->password_protection) !!}
                                    <span>{{ lang('Password protected files', 'plans') }}</span>
                                </div>
                            @endif
                            @if ($plan->custom_features)
                                @foreach ($plan->custom_features as $customFeature)
                                    @if ($customFeature->status == 1)
                                        <div class="plan-feature-item">
                                            {!! featureStatus($customFeature->status) !!}
                                            <span>{{ $customFeature->name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            @if (!$plan->password_protection)
                                <div class="plan-feature-item">
                                    {!! featureStatus($plan->password_protection) !!}
                                    <span>{{ lang('Password protected files', 'plans') }}</span>
                                </div>
                            @endif
                            @if ($plan->custom_features)
                                @foreach ($plan->custom_features as $customFeature)
                                    @if ($customFeature->status == 0)
                                        <div class="plan-feature-item">
                                            {!! featureStatus($customFeature->status) !!}
                                            <span>{{ $customFeature->name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        {!! planButton($plan) !!}
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info text-center">{{ lang('No plans available', 'plans') }}</div>
                </div>
            @endforelse
        </div>
    </div>
</div>
