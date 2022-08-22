@extends('backend.layouts.form')
@section('section', __('Navigation'))
@section('title', __('Navbar link') . ' | ' . $navbarMenu->name)
@section('container', 'container-max-lg')
@section('back', route('admin.navbarMenu.index'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form id="vironeer-submited-form" action="{{ route('admin.navbarMenu.update', $navbarMenu->id) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3 mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Language') }} :<span class="red">*</span></label>
                        <select name="lang" class="form-select select2" required>
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            @foreach ($adminLanguages as $adminLanguage)
                                <option value="{{ $adminLanguage->code }}"
                                    @if ($navbarMenu->lang == $adminLanguage->code) selected @endif>
                                    {{ $adminLanguage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Page') }} :<span class="red">*</span></label>
                        <select name="page" class="form-select">
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            <option value="0" @if (!$navbarMenu->page) selected @endif>{{ __('Home page') }}
                            </option>
                            <option value="1" @if ($navbarMenu->page) selected @endif>
                                {{ __('Other pages') }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }} : <span class="red">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $navbarMenu->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Link type') }} :<span class="red">*</span></label>
                    <select id="menuLinkType" name="type" class="form-select">
                        <option value="" selected disabled>{{ __('Choose') }}</option>
                        <option value="0" @if (!$navbarMenu->type) selected @endif>{{ __('Direct link') }}
                        </option>
                        <option value="1" @if ($navbarMenu->type) selected @endif>
                            {{ __('Targeting section') }}
                        </option>
                    </select>
                </div>
                <div id="menuLink">
                    @if (!$navbarMenu->type)
                        <div class="mb-2">
                            <label class="form-label">{{ __('Link') }} : <span class="red">*</span></label>
                            <input type="text" name="link" class="form-control" placeholder="/"
                                value="{{ $navbarMenu->link }}" required>
                        </div>
                    @else
                        <div class="mb-2">
                            <label class="form-label">{{ __('Section') }} :<span class="red">*</span></label>
                            <select name="link" class="form-select">
                                <option value="#features" @if ($navbarMenu->link == '#features') selected @endif>
                                    {{ __('Features') }}</option>
                                @if (licenceType(2))
                                    <option value="#pricing" @if ($navbarMenu->link == '#pricing') selected @endif>
                                        {{ __('Pricing') }}</option>
                                @endif
                                <option value="#blog" @if ($navbarMenu->link == '#blog') selected @endif>
                                    {{ __('Blog') }}
                                </option>
                                <option value="#contact" @if ($navbarMenu->link == '#contact') selected @endif>
                                    {{ __('Contact Us') }}</option>
                            </select>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
