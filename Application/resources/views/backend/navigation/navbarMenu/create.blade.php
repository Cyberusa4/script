@extends('backend.layouts.form')
@section('section', __('Navigation'))
@section('title', __('Create new navbar link'))
@section('container', 'container-max-lg')
@section('back', route('admin.navbarMenu.index'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form id="vironeer-submited-form" action="{{ route('admin.navbarMenu.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Language') }} :<span class="red">*</span></label>
                        <select name="lang" class="form-select select2" required>
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            @foreach ($adminLanguages as $adminLanguage)
                                <option value="{{ $adminLanguage->code }}"
                                    @if (old('lang') == $adminLanguage->code) selected @endif>
                                    {{ $adminLanguage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Page') }} :<span class="red">*</span></label>
                        <select name="page" class="form-select">
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            <option value="0">{{ __('Home page') }}</option>
                            <option value="1">{{ __('Other pages') }}</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }} : <span class="red">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Link type') }} :<span class="red">*</span></label>
                    <select id="menuLinkType" name="type" class="form-select">
                        <option value="" selected disabled>{{ __('Choose') }}</option>
                        <option value="0">{{ __('Direct link') }}</option>
                        <option value="1">{{ __('Targeting section') }}</option>
                    </select>
                </div>
                <div id="menuLink"></div>
            </form>
        </div>
    </div>
@endsection
