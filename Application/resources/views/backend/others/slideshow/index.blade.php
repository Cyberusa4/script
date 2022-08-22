@extends('backend.layouts.grid')
@section('title', __('Slide Show'))
@section('link', route('admin.slideshow.create'))
@section('container', 'container-max-lg')
@section('content')
    <div class="card">
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th class="tb-w-2x">{{ __('#') }}</th>
                    <th class="tb-w-2x">{{ __('Preview') }}</th>
                    <th class="tb-w-3x">{{ __('Type') }}</th>
                    <th class="tb-w-3x">{{ __('Source') }}</th>
                    <th class="tb-w-3x">{{ __('duration') }}</th>
                    <th class="tb-w-7x">{{ __('Added date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slideshows as $slideshow)
                    <tr>
                        <td>{{ $slideshow->id }}</td>
                        <td>
                            @if ($slideshow->type == 1)
                                <img src="{{ $slideshow->source == 1 ? asset($slideshow->file) : $slideshow->file }}"
                                    class="rounded" width="40" height="40">
                            @else
                                <video width="40" height="40" controls>
                                    <source
                                        src="{{ $slideshow->source == 1 ? asset($slideshow->file) : $slideshow->file }}">
                                </video>
                            @endif
                        </td>
                        <td>{{ $slideshow->type == 1 ? __('Image') : __('Video') }}</td>
                        <td>{{ $slideshow->source == 1 ? __('Uploaded') : __('URL') }}</td>
                        <td>
                            <span
                                class="badge bg-dark">{{ $slideshow->duration > 1? $slideshow->duration . ' ' . __('Seconds'): $slideshow->duration . ' ' . __('Second') }}</span>
                        </td>
                        <td>{{ vDate($slideshow->created_at) }}</td>
                        <td>
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-3" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v fa-sm text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sm-end" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.slideshow.edit', $slideshow->id) }}"><i
                                                class="fa fa-edit me-2"></i>{{ __('Edit') }}</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.slideshow.destroy', $slideshow->id) }}"
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
@endsection
