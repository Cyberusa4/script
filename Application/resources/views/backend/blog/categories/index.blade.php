@extends('backend.layouts.grid')
@section('title', $active . ' ' . __('Blog Categories'))
@section('container', 'container-max-lg')
@section('link', route('categories.create'))
@section('language', true)
@section('content')
    <div class="card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-3x">{{ __('#') }}</th>
                    <th class="tb-w-3x">{{ __('Language') }}</th>
                    <th class="tb-w-20x">{{ __('Name') }}</th>
                    <th class="tb-w-3x">{{ __('Views') }}</th>
                    <th class="tb-w-7x">{{ __('Published date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="item">
                        <td>{{ $category->id }}</td>
                        <td><a href="{{ route('language.translate', $category->lang) }}">{{ $category->lang }}</a></td>
                        <td>{{ $category->name }}</td>
                        <td><span class="badge bg-dark">{{ $category->views }}</span></td>
                        <td>{{ vDate($category->created_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ url($category->lang . '/blog/category/' . $category->slug) }}"
                                            target="_blank"><i class="fa fa-eye me-2"></i>{{ __('View') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i
                                                class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
