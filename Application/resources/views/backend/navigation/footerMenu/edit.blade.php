@extends('backend.layouts.form')
@section('section', __('Navigation'))
@section('title', __('Footer link') . ' | ' . $footerMenu->name)
@section('container', 'container-max-lg')
@section('back', route('admin.footerMenu.index'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form id="vironeer-submited-form" action="{{ route('admin.footerMenu.update', $footerMenu->id) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">{{ __('Language') }} :<span class="red">*</span></label>
                    <select name="lang" class="form-select select2" required>
                        <option value="" selected disabled>{{ __('Choose') }}</option>
                        @foreach ($adminLanguages as $adminLanguage)
                            <option value="{{ $adminLanguage->code }}" @if ($footerMenu->lang == $adminLanguage->code) selected @endif>
                                {{ $adminLanguage->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }} : <span class="red">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $footerMenu->name }}" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">{{ __('Link') }} : <span class="red">*</span></label>
                    <input type="link" name="link" class="form-control" value="{{ $footerMenu->link }}" placeholder="/"
                        required>
                </div>
            </form>
        </div>
    </div>
@endsection
