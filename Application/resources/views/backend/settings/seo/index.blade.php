@extends('backend.layouts.grid')
@section('title', __('SEO Configurations'))
@section('section', __('Settings'))
@section('container', 'container-max-lg')
@section('back', route('admin.settings.index'))
@section('link', route('seo.create'))
@section('content')
    <div class="custom-card card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-3x">{{ __('#') }}</th>
                    <th class="tb-w-3x">{{ __('Language') }}</th>
                    <th class="tb-w-20x">{{ __('Site title') }}</th>
                    <th class="tb-w-7x">{{ __('Created date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($configurations as $configuration)
                    <tr class="item">
                        <td>{{ $configuration->id }}</td>
                        <td><a
                                href="{{ route('language.translate', $configuration->lang) }}">{{ $configuration->lang }}</a>
                        </td>
                        <td>{{ shortertext($configuration->title, 60) }}</td>
                        <td>{{ vDate($configuration->created_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('seo.edit', $configuration->id) }}"><i
                                                class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <form action="{{ route('seo.destroy', $configuration->id) }}" method="POST">
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
