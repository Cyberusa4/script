@extends('backend.layouts.form')
@section('title', $article->title)
@section('back', route('articles.index'))
@section('content')
    <form id="vironeer-submited-form" action="{{ route('articles.update', $article->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card p-2 mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Article title') }} : <span
                                    class="red">*</span></label>
                            <input type="text" name="title" id="create_slug" class="form-control"
                                value="{{ $article->title }}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Slug') }} : <span class="red">*</span></label>
                            <div class="input-group vironeer-input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ url('blog/article/') }}/</span>
                                </div>
                                <input type="text" name="slug" class="form-control" value="{{ $article->slug }}"
                                    required />
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">{{ __('Article content') }} : <span
                                    class="red">*</span></label>
                            <textarea name="content" id="content" rows="10" class="form-control"
                                required>{{ $article->content }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-2 mb-3">
                    <div class="card-body">
                        <div class="vironeer-file-preview-box mb-3 bg-light p-5 text-center">
                            <div class="file-preview-box mb-3">
                                <img id="filePreview" src="{{ asset($article->image) }}" class="rounded-3 w-100"
                                    height="160px">
                            </div>
                            <button id="selectFileBtn" type="button"
                                class="btn btn-secondary mb-2">{{ __('Choose Image') }}</button>
                            <input id="selectedFileInput" type="file" name="image" accept="image/png, image/jpg, image/jpeg"
                                hidden>
                            <small class="text-muted d-block">{{ __('Allowed (PNG, JPG, JPEG)') }}</small>
                            <small class="text-muted d-block">{{ __('Image will be resized into (900x450)') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Language') }} :<span
                                    class="red">*</span></label>
                            <select id="articleLang" name="lang" class="form-select select2" required>
                                <option></option>
                                @foreach ($adminLanguages as $adminLanguage)
                                    <option value="{{ $adminLanguage->code }}" @if ($article->lang == $adminLanguage->code) selected @endif>
                                        {{ $adminLanguage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Article category') }} : <span
                                    class="red">*</span></label>
                            <select id="articleCategory" name="category" class="form-select" required>
                                <option value="" selected disabled>{{ __('Choose') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($article->category_id == $category->id) selected @endif>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">{{ __('Short description') }} : <span
                                    class="red">*</span></label>
                            <textarea name="short_description" rows="6" class="form-control"
                                placeholder="{{ __('50 to 200 character at most') }}"
                                required>{{ $article->short_description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
