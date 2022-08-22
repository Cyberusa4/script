@extends('backend.layouts.grid')
@section('title', __('Extensions'))
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
                @foreach ($extensions as $extension)
                    <tr class="item">
                        <td>{{ $extension->id }}</td>
                        <td>
                            <a href="{{ route('admin.settings.extensions.edit', $extension->id) }}">
                                <img src="{{ asset($extension->logo) }}" height="40" width="40">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.settings.extensions.edit', $extension->id) }}" class="text-dark">
                                {{ $extension->name }}
                            </a>
                        </td>
                        <td>
                            @if ($extension->status)
                                <span class="badge bg-success">{{ __('Enabled') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('Disabled') }}</span>
                            @endif
                        </td>
                        <td>{{ vDate($extension->updated_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.settings.extensions.edit', $extension->id) }}"><i
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
