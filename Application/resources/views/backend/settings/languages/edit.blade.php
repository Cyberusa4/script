@extends('backend.layouts.form')
@section('title', $language->name . ' - ' . $language->native)
@section('section', __('Settings'))
@section('container', 'container-max-lg')
@section('back', route('languages.index'))
@section('content')
    <form id="vironeer-submited-form" action="{{ route('languages.update', $language->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Name') }} : <span class="red">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $language->name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Native name') }} : <span
                                    class="red">*</span></label>
                            <input type="text" name="native" class="form-control" value="{{ $language->native }}"
                                required>
                        </div>
                    </div>
                </div>
                <div class="mb-0 form-check">
                    <input class="form-check-input" type="checkbox" name="is_default" id="is_default"
                        @if (env('DEFAULT_LANGUAGE') == $language->code) checked @endif>
                    <label class="form-check-label" for="is_default">{{ __('Default language') }}</label>
                </div>
            </div>
        </div>
    </form>

@endsection
