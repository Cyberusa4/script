@extends('backend.layouts.grid')
@section('title', $active . ' ' . __('Pages'))
@section('section', __('Settings'))
@section('back', route('admin.settings.index'))
@section('link', route('pages.create'))
@section('language', true)
@section('content')
    <div class="card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-3x">{{ __('#') }}</th>
                    <th class="tb-w-3x">{{ __('Language') }}</th>
                    <th class="tb-w-20x">{{ __('Page Name') }}</th>
                    <th class="tb-w-3x">{{ __('Views') }}</th>
                    <th class="tb-w-7x">{{ __('Created date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr class="item">
                        <td>{{ $page->id }}</td>
                        <td><a href="{{ route('language.translate', $page->lang) }}">{{ $page->lang }}</a></td>
                        <td>{{ $page->title }}</td>
                        <td><span class="badge bg-dark">{{ $page->views }}</span></td>
                        <td>{{ vDate($page->created_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ url($page->lang . '/page/' . $page->slug) }}"
                                            target="_blank"><i class="fa fa-eye me-2"></i>{{ __('View') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pages.edit', $page->id) }}"><i
                                                class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <form action="{{ route('pages.destroy', $page->id) }}" method="POST">
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
@endsection
