@extends('backend.layouts.grid')
@section('section', __('Uploads'))
@section('title', __('Users uploads'))
@section('content')
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-11 h-100">
                <h3 class="vironeer-counter-box-title">{{ __('Files And Documents') }}</h3>
                <p class="vironeer-counter-box-number">{{ formatNumber($totalFileDocuments) }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fas fa-file-alt"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-12 h-100">
                <h3 class="vironeer-counter-box-title">{{ __('Images') }}</h3>
                <p class="vironeer-counter-box-number">{{ formatNumber($totalImages) }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fas fa-images"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-7 h-100">
                <h3 class="vironeer-counter-box-title">{{ __('Used Space') }}</h3>
                <p class="vironeer-counter-box-number">{{ $usedSpace }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="fas fa-database"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="custom-card card">
        <div class="card-header p-3 border-bottom-small">
            <form class="multiple-select-search-form" action="{{ request()->url() }}" method="GET">
                <div class="input-group vironeer-custom-input-group">
                    <input type="text" name="search" class="form-control" placeholder="{{ __('Search...') }}"
                        value="{{ request()->input('search') ?? '' }}" required>
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    @if (request()->input('search'))
                        <a href="{{ request()->url() }}" class="btn btn-secondary">{{ __('View All') }}</a>
                    @endif
                </div>
            </form>
            <form class="multiple-select-delete-form d-none" action="{{ route('admin.uploads.users.destroy.selected') }}"
                method="POST">
                @csrf
                <input type="hidden" name="delete_ids" class="multiple-select-delete-ids" value="">
                <button class="vironeer-able-to-delete btn btn-danger"><i
                        class="far fa-trash-alt me-2"></i>{{ __('Delete Selected') }}</button>
            </form>
        </div>
        <div>
            @if ($fileEntries->count() > 0)
                <div class="table-responsive">
                    <table class="vironeer-normal-table table w-100">
                        <thead>
                            <tr>
                                <th class="tb-w-3x">
                                    <input class="multiple-select-check-all form-check-input" type="checkbox">
                                </th>
                                <th class="tb-w-20x">{{ __('File details') }}</th>
                                <th class="tb-w-5x">{{ __('File size') }}</th>
                                <th class="tb-w-3x text-center">{{ __('Downloads') }}</th>
                                <th class="tb-w-3x text-center">{{ __('Views') }}</th>
                                <th class="tb-w-7x text-center">{{ __('Storage') }}</th>
                                <th class="tb-w-3x text-center">{{ __('File expiration') }}</th>
                                <th class="tb-w-3x text-center">{{ __('File Upload date') }}</th>
                                <th class="text-end"><i class="fas fa-sliders-h me-1"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fileEntries as $fileEntry)
                                <tr>
                                    <td>
                                        <input class="form-check-input multiple-select-checkbox"
                                            data-id="{{ $fileEntry->id }}" type="checkbox">
                                    </td>
                                    <td>
                                        <div class="vironeer-content-box">
                                            <a class="vironeer-content-image text-center"
                                                href="{{ route('admin.uploads.users.view', $fileEntry->shared_id) }}">
                                                @if ($fileEntry->type == 'image')
                                                    <img src="{{ route('admin.uploads.secure', hashid($fileEntry->id)) }}"
                                                        alt="{{ $fileEntry->name }}">
                                                @else
                                                    {!! fileIcon($fileEntry->extension) !!}
                                                @endif
                                            </a>
                                            <div>
                                                <a class="text-reset"
                                                    href="{{ route('admin.uploads.users.view', $fileEntry->shared_id) }}">{{ shortertext($fileEntry->name, 50) }}</a>
                                                <p class="text-muted mb-0">
                                                    {{ shortertext($fileEntry->mime, 50) ?? __('Unknown') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ formatBytes($fileEntry->size) }}</td>
                                    <td class="text-center">{{ formatNumber($fileEntry->downloads) }}</td>
                                    <td class="text-center">{{ formatNumber($fileEntry->views) }}</td>
                                    <td class="text-center">
                                        @if ($fileEntry->storageProvider->symbol == 'local')
                                            <span><i
                                                    class="fas fa-server me-2"></i>{{ $fileEntry->storageProvider->symbol }}</span>
                                        @else
                                            <a class="text-dark capitalize"
                                                href="{{ route('admin.settings.storage.edit', $fileEntry->storageProvider->id) }}">
                                                <i
                                                    class="fas fa-server me-2"></i>{{ $fileEntry->storageProvider->symbol }}
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $fileEntry->expiry_at ? vDate($fileEntry->expiry_at) : __('Unlimited time') }}
                                    </td>
                                    <td class="text-center">{{ vDate($fileEntry->created_at) }}</td>
                                    <td>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-md-end dropdown-menu-lg"
                                                data-popper-placement="bottom-end">
                                                @if ($fileEntry->access_status)
                                                    <li>
                                                        <a class="dropdown-item" target="_blank"
                                                            href="{{ route('file.download', $fileEntry->shared_id) }}"><i
                                                                class="fas fa-external-link-alt me-2"></i>{{ __('Preview') }}</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.uploads.users.download', $fileEntry->shared_id) }}"><i
                                                            class="fas fa-download me-2"></i>{{ __('Download') }}</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.uploads.users.view', $fileEntry->shared_id) }}"><i
                                                            class="fas fa-desktop me-2"></i>{{ __('File details') }}</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider" />
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('admin.uploads.users.destroy', $fileEntry->shared_id) }}"
                                                        method="POST">
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
            @else
                @include('backend.includes.empty')
            @endif
        </div>
    </div>
    {{ $fileEntries->links() }}
    @push('styles_libs')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/vironeer/vironeer-icons.min.css') }}">
    @endpush
@endsection
