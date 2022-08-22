@extends('backend.layouts.grid')
@section('section', __('Settings'))
@section('title', __('Upload settings'))
@section('back', route('admin.settings.index'))
@section('content')
    <div class="card custom-card">
        <table class="datatable-50 table w-100">
            <thead>
                <tr>
                    <th class="tb-w-2x">{{ __('#') }}</th>
                    <th class="tb-w-3x">{{ __('Icon') }}</th>
                    <th class="tb-w-3x">{{ __('Name') }}</th>
                    <th class="tb-w-3x">{{ __('Storage space') }}</th>
                    <th class="tb-w-3x">{{ __('File size') }}</th>
                    <th class="tb-w-3x">{{ __('Files duration') }}</th>
                    <th class="tb-w-3x">{{ __('status') }}</th>
                    <th class="tb-w-3x">{{ __('Last Update') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($uploadSettings as $uploadSetting)
                    <tr>
                        <td>{{ $uploadSetting->id }}</td>
                        <td>
                            <a href="{{ route('admin.settings.upload.edit', $uploadSetting->id) }}">
                                <img src="{{ asset($uploadSetting->icon) }}" height="40" width="40">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.settings.upload.edit', $uploadSetting->id) }}" class="text-dark">
                                {{ $uploadSetting->name }}
                            </a>
                        </td>
                        <td>{{ is_null($uploadSetting->storage_space) ? __('Unlimited') : formatBytes($uploadSetting->storage_space) }}
                        </td>
                        <td>{{ is_null($uploadSetting->file_size) ? __('Unlimited') : formatBytes($uploadSetting->file_size) }}
                        </td>
                        <td>
                            @if (is_null($uploadSetting->files_duration))
                                {{ __('Unlimited time') }}
                            @else
                                {{ formatDays($uploadSetting->files_duration) }}
                            @endif
                        </td>
                        <td>
                            @if ($uploadSetting->status)
                                <span class="badge bg-success">{{ __('Active') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('Disabled') }}</span>
                            @endif
                        </td>
                        <td>{{ vDate($uploadSetting->updated_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.settings.upload.edit', $uploadSetting->id) }}"><i
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
