@extends('backend.layouts.grid')
@section('title', __('Reported files'))
@section('content')
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-7 h-100">
                <h3 class="vironeer-counter-box-title">{{ __('Waiting review') }}</h3>
                <p class="vironeer-counter-box-number">{{ formatNumber($waitingReview) }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="far fa-clock"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xxl">
            <div class="vironeer-counter-box bg-c-4 h-100">
                <h3 class="vironeer-counter-box-title">{{ __('Reviewed') }}</h3>
                <p class="vironeer-counter-box-number">{{ formatNumber($reviewed) }}</p>
                <span class="vironeer-counter-box-icon">
                    <i class="far fa-check-circle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="card custom-card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-3x">{{ __('#') }}</th>
                    <th class="tb-w-20x">{{ __('File details') }}</th>
                    <th class="tb-w-3x">{{ __('Reported by') }}</th>
                    <th class="tb-w-3x">{{ __('Report reason') }}</th>
                    <th class="tb-w-5x">{{ __('Status') }}</th>
                    <th class="tb-w-7x">{{ __('Report date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fileReports as $fileReport)
                    <tr class="item">
                        <td>{{ $fileReport->id }}</td>
                        <td>
                            <div class="vironeer-content-box">
                                <a class="vironeer-content-image text-center"
                                    href="{{ route($fileReport->fileEntry->user_id ? 'admin.uploads.users.view' : 'admin.uploads.guests.view', $fileReport->fileEntry->shared_id) }}">
                                    @if ($fileReport->fileEntry->type == 'image')
                                        <img src="{{ route('admin.uploads.secure', hashid($fileReport->fileEntry->id)) }}"
                                            alt="{{ $fileReport->fileEntry->name }}">
                                    @else
                                        {!! fileIcon($fileReport->fileEntry->extension) !!}
                                    @endif
                                </a>
                                <div>
                                    <a class="text-reset"
                                        href="{{ route($fileReport->fileEntry->user_id ? 'admin.uploads.users.view' : 'admin.uploads.guests.view', $fileReport->fileEntry->shared_id) }}">
                                        {{ shortertext($fileReport->fileEntry->name, 50) }}
                                    </a>
                                    <p class="text-muted mb-0">
                                        {{ shortertext($fileReport->fileEntry->mime, 50) ?? __('Unknown') }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="vironeer-content-box">
                                <div>
                                    <span>{{ shortertext($fileReport->name, 30) }}</span>
                                    <p class="text-muted mb-0">{{ shortertext($fileReport->email, 30) }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ shortertext(reportReasons()[$fileReport->reason], 25) }}</td>
                        <td>
                            @if ($fileReport->admin_has_viewed)
                                <span class="badge bg-success">{{ __('Reviewed') }}</span>
                            @else
                                <span class="badge bg-c-7">{{ __('Waiting review') }}</span>
                            @endif
                        </td>
                        <td>{{ vDate($fileReport->created_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end dropdown-menu-lg"
                                    data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.reports.view', $fileReport->id) }}"><i
                                                class="fa fa-desktop me-2"></i>{{ __('Report Details') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route($fileReport->fileEntry->user_id ? 'admin.uploads.users.view' : 'admin.uploads.guests.view', $fileReport->fileEntry->shared_id) }}"
                                            target="_blank"><i class="fa fa-eye me-2"></i>{{ __('Reported File') }}</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.reports.destroy', $fileReport->id) }}"
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
    @push('styles_libs')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/vironeer/vironeer-icons.min.css') }}">
    @endpush
@endsection
