@extends('backend.layouts.grid')
@section('title', __('Coupons'))
@section('link', route('admin.coupons.create'))
@section('content')
    <div class="card ratings custom-card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-2x">{{ __('#') }}</th>
                    <th class="tb-w-7x">{{ __('Coupon') }}</th>
                    <th class="tb-w-3x">{{ __('Percentage') }}</th>
                    <th class="tb-w-2x">{{ __('Limit') }}</th>
                    <th class="tb-w-3x">{{ __('Plan') }}</th>
                    <th class="tb-w-2x">{{ __('Action type') }}</th>
                    <th class="tb-w-3x">{{ __('expiry at') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td>
                            <button type="button" class="copy-btn bg-white btn-link p-0 m-0 border-0 me-2 text-secondary"
                                data-clipboard-target="#copy-coupon{{ $coupon->id }}"><i
                                    class="far fa-clone"></i></button>{{ $coupon->code }}
                            <input id="copy-coupon{{ $coupon->id }}" value="{{ $coupon->code }}"
                                class="offscreen">
                        </td>
                        <td><strong>{{ $coupon->percentage }}% OFF</strong></td>
                        <td>{{ $coupon->limit }}</td>
                        <td>
                            @if (!is_null($coupon->plan_id))
                                <a href="{{ route('admin.plans.edit', $coupon->plan->id) }}"
                                    style="color: {{ $coupon->plan->color }}"><i class="far fa-gem me-2"></i>
                                    {{ $coupon->plan->name }}
                                </a>
                            @else
                                <a href="{{ route('admin.plans.index') }}" class="text-dark">
                                    <i class="far fa-gem me-2"></i>{{ __('All plans') }}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($coupon->action_type == 0)
                                <span class="badge bg-lg-1">{{ __('All actions') }}</span>
                            @elseif($coupon->action_type == 1)
                                <span class="badge bg-lg-2">{{ __('Subscribing') }}</span>
                            @elseif($coupon->action_type == 2)
                                <span class="badge bg-lg-3">{{ __('Renewal') }}</span>
                            @elseif($coupon->action_type == 3)
                                <span class="badge bg-lg-4">{{ __('Upgrade') }}</span>
                            @endif
                        </td>
                        <td>
                            @if (!isExpiry($coupon->expiry_at))
                                {{ vDate($coupon->expiry_at) }}
                            @else
                                <span class="badge bg-danger">{{ __('Expired') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.coupons.edit', $coupon->id) }}"><i
                                                class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST">
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
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/clipboard/clipboard.min.js') }}"></script>
    @endpush
@endsection
