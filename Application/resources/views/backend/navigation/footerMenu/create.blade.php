@extends('backend.layouts.form')
@section('section', __('Navigation'))
@section('title', __('Create new footer link'))
@section('container', 'container-max-lg')
@section('back', route('admin.footerMenu.index'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form id="vironeer-submited-form" action="{{ route('admin.footerMenu.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Language') }} :<span class="red">*</span></label>
                    <select name="lang" class="form-select select2" required>
                        <option value="" selected disabled>{{ __('Choose') }}</option>
                        @foreach ($adminLanguages as $adminLanguage)
                            <option value="{{ $adminLanguage->code }}" @if (old('lang') == $adminLanguage->code) selected @endif>
                                {{ $adminLanguage->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }} : <span class="red">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">{{ __('Link') }} : <span class="red">*</span></label>
                    <input type="link" name="link" class="form-control" placeholder="/" required>
                </div>
            </form>
        </div>
    </div>
@endsection
