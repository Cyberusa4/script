@extends('backend.layouts.grid')
@section('title', __('Storage Providers'))
@section('section', __('Settings'))
@section('container', 'container-max-lg')
@section('back', route('admin.settings.index'))
@section('content')
    <div class="card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-1x">{{ __('#') }}</th>
                    <th class="tb-w-3x">{{ __('Logo') }}</th>
                    <th class="tb-w-3x">{{ __('name') }}</th>
                    <th class="tb-w-7x">{{ __('Status') }}</th>
                    <th class="tb-w-7x">{{ __('Last Update') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($storageProviders as $storageProvider)
                    <tr class="item">
                        <td>{{ $storageProvider->id }}</td>
                        <td>
                            <a href="{{ route('admin.settings.storage.edit', $storageProvider->id) }}">
                                <img src="{{ asset($storageProvider->logo) }}" height="40" width="40">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.settings.storage.edit', $storageProvider->id) }}" class="text-dark">
                                {{ $storageProvider->name }}
                            </a>
                            @if (env('FILESYSTEM_DRIVER') == $storageProvider->symbol)
                                ({{ __('Default') }})
                            @endif
                        </td>
                        <td>
                            @if ($storageProvider->status)
                                <span class="badge bg-success">{{ __('Enabled') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('Disabled') }}</span>
                            @endif
                        </td>
                        <td>{{ vDate($storageProvider->updated_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    @if ($storageProvider->symbol != 'local')
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.settings.storage.edit', $storageProvider->id) }}"><i
                                                    class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                    @endif
                                    <li>
                                        <form
                                            action="{{ route('admin.settings.storage.default', $storageProvider->id) }}"
                                            method="POST">
                                            @csrf
                                            <button class="vironeer-form-confirm dropdown-item"><i
                                                    class="fas fa-thumbtack me-2"></i>{{ __('Set As Default') }}</button>
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
@endsection
