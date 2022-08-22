@extends('backend.layouts.form')
@section('title', $faq->title)
@section('container', 'container-max-lg')
@section('back', route('admin.faq.index'))
@section('content')
    <form id="vironeer-submited-form" action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card p-2 mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('Language') }} :<span class="red">*</span></label>
                    <select name="lang" class="form-select select2" required>
                        <option></option>
                        @foreach ($adminLanguages as $adminLanguage)
                            <option value="{{ $adminLanguage->code }}" @if ($faq->lang == $adminLanguage->code) selected @endif>
                                {{ $adminLanguage->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Question title') }} : <span class="red">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ $faq->title }}" required />
                </div>
                <div class="mb-2">
                    <label class="form-label">{{ __('Question answer') }} :
                        <span class="red">*</span></label>
                    <textarea name="content" id="content-small" rows="10" class="form-control"
                        required>{{ $faq->content }}</textarea>
                </div>
            </div>
        </div>
    </form>
@endsection
