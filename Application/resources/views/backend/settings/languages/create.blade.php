@extends('backend.layouts.form')
@section('title', __('Add language'))
@section('section', __('Settings'))
@section('container', 'container-max-lg')
@section('back', route('languages.index'))
@section('content')
    <form id="vironeer-submited-form" action="{{ route('languages.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Name') }} : <span class="red">*</span></label>
                            <input type="text" name="name" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Native name') }} : <span
                                    class="red">*</span></label>
                            <input type="text" name="native" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Code') }} : <span class="red">*</span></label>
                    <select name="code" class="form-select select2" required>
                        <option></option>
                        @foreach (languages() as $code => $name)
                            <option value="{{ $code }}">{{ $name }} ({{ $code }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-0 form-check">
                    <input class="form-check-input" type="checkbox" name="is_default" id="is_default">
                    <label class="form-check-label" for="is_default">{{ __('Default language') }}</label>
                </div>
            </div>
        </div>
    </form>

@endsection
