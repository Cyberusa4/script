@extends('backend.layouts.grid')
@section('title', __('Payment gateways'))
@section('section', __('Settings'))
@section('back', route('admin.settings.index'))
@section('content')
    <div class="card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-1x">{{ __('#') }}</th>
                    <th class="tb-w-3x">{{ __('name') }}</th>
                    <th class="tb-w-15x">{{ __('Logo') }}</th>
                    <th class="tb-w-7x">{{ __('Fees') }}</th>
                    <th class="tb-w-7x">{{ __('Status') }}</th>
                    <th class="tb-w-7x">{{ __('Last Update') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gateways as $gateway)
                    <tr class="item">
                        <td>{{ $gateway->id }}</td>
                        <td>
                            <a href="{{ route('admin.settings.gateways.edit', $gateway->id) }}" class="text-dark">
                                {{ $gateway->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.settings.gateways.edit', $gateway->id) }}">
                                <img src="{{ asset($gateway->logo) }}" height="35" width="100">
                            </a>
                        </td>
                        <td><span class="badge bg-dark">{{ $gateway->fees }}%</span></td>
                        <td>
                            @if ($gateway->status)
                                <span class="badge bg-success">{{ __('Active') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('Disabled') }}</span>
                            @endif
                        </td>
                        <td>{{ vDate($gateway->updated_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.settings.gateways.edit', $gateway->id) }}"><i
                                                class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
