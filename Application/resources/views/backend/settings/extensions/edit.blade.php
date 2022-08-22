@extends('backend.layouts.form')
@section('title', __('Edit | ') . $extension->name)
@section('section', __('Settings'))
@section('back', route('admin.settings.extensions.index'))
@section('container', 'container-max-lg')
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.settings.extensions.update', $extension->id) }}"
        method="POST">
        @csrf
        @method('PUT')
        <div class="card custom-card mb-4">
            <div class="card-body">
                <div class="vironeer-file-preview-box bg-light mb-3 p-4 text-center">
                    <div class="file-preview-box mb-3">
                        <img id="filePreview" src="{{ asset($extension->logo) }}" height="100">
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Name') }} : </label>
                        <input class="form-control" value="{{ $extension->name }}" readonly>
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Status') }} :</label>
                        <input type="checkbox" name="status" data-toggle="toggle"
                            @if ($extension->status) checked @endif>
                    </div>
                </div>
            </div>
        </div>
        @if ($extension->instructions)
            <div class="card custom-card mb-4">
                <div class="card-header">
                    <i class="far fa-question-circle me-2"></i>{{ $extension->name . __(' Instructions') }}
                </div>
                <div class="card-body">
                    {!! str_replace('[URL]', url('/'), $extension->instructions) !!}
                </div>
            </div>
        @endif
        <div class="card custom-card mb-4">
            <div class="card-header">
                <i class="fa fa-key me-2"></i> {{ $extension->name . __(' Credentials') }}
            </div>
            <div class="card-body">
                <div class="row g-3 pb-2">
                    @foreach ($extension->credentials as $key => $value)
                        <div class="col-lg-12">
                            <label class="form-label capitalize">{{ $extension->name }}
                                {{ str_replace('_', ' ', $key) }} :
                            </label>
                            <input type="text" name="credentials[{{ $key }}]"
                                value="{{ demoMode() ? '' : $value }}" class="form-control remove-spaces">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
@endsection
