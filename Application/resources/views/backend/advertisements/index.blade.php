@extends('backend.layouts.grid')
@section('title', __('advertisements'))
@section('content')
    <div class="card ratings custom-card">
        <table id="unsort-datatable-50" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-2x">{{ __('#') }}</th>
                    <th class="tb-w-7x">{{ __('Position') }}</th>
                    <th class="tb-w-5x">{{ __('Size') }}</th>
                    <th class="tb-w-5x">{{ __('Status') }}</th>
                    <th class="tb-w-3x">{{ __('Last update') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($advertisements as $advertisement)
                    @if ($advertisement->symbol != 'head_code')
                        <tr>
                            <td>{{ $advertisement->id }}</td>
                            <td><i class="fas fa-ad me-2"></i>{{ $advertisement->position }}</td>
                            <td>{{ $advertisement->size }}</td>
                            <td>
                                @if ($advertisement->status)
                                    <span class="badge bg-success">{{ __('Enabled') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('Disabled') }}</span>
                                @endif
                            </td>
                            <td>{{ vDate($advertisement->updated_at) }}</td>
                            <td>
                                <div class="text-end">
                                    <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.advertisements.edit', $advertisement->id) }}"><i
                                                    class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
