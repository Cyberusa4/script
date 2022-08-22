@extends('frontend.layouts.pages')
@section('bg', 'bg-light')
@section('title', $blogCategory ?? lang('Blog', 'blog'))
@section('header_version', 'v2')
@section('content')
    <div class="container">
        <div class="blog">
            <div class="row g-3">
                <div class="col-12 col-xl-8">
                    @forelse ($blogArticles as $blogArticle)
                        <div class="blog-post">
                            <div class="card p-0 border-0 shadow-sm">
                                <div class="blog-post-img">
                                    <a href="{{ route('blog.article', $blogArticle->slug) }}">
                                        <img src="{{ asset($blogArticle->image) }}" alt="{{ $blogArticle->title }}"
                                            title="{{ $blogArticle->title }}" />
                                    </a>
                                    <a href="{{ route('blog.category', $blogArticle->blogCategory->slug) }}"
                                        class="blog-post-cate">{{ $blogArticle->blogCategory->name }}</a>
                                </div>
                                <div class="card-body p-4">
                                    <a class="card-title h5 mb-3 d-block text-dark"
                                        href="{{ route('blog.article', $blogArticle->slug) }}">{{ $blogArticle->title }}</a>
                                    <div class="small mb-3">
                                        <i class="far fa-calendar-alt text-primary me-1 fs-6"></i>
                                        <span class="me-2">{{ vDate($blogArticle->created_at) }}</span>
                                        <i class="far fa-user text-primary me-1 fs-6"></i>
                                        <span
                                            class="me-2">{{ $blogArticle->admin->firstname . ' ' . $blogArticle->admin->lastname }}</span>
                                        <i class="far fa-comments text-primary me-1 fs-6"></i>
                                        <span>{{ $blogArticle->comments_count }}</span>
                                    </div>
                                    <p class="card-text text-muted">
                                        {{ shortertext($blogArticle->short_description, 150) }}
                                    </p>
                                    <div class="d-flex">
                                        <a href="{{ route('blog.article', $blogArticle->slug) }}"
                                            class="btn btn-primary btn-md">{{ lang('Read More', 'blog') }}<i
                                                class="fas fa-arrow-right fa-sm ms-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($loop->first)
                            {!! ads_blog_page_center() !!}
                        @endif
                    @empty
                        <div class="blog-post">
                            <div class="card p-0 text-center p-5 text-muted border-0 shadow-sm">
                                <h3>{{ lang('No data found', 'blog') }}</h3>
                                <p class="mb-0">
                                    {{ lang('It looks like there is no articles or your search did not return any results', 'blog') }}
                                </p>
                            </div>
                        </div>
                    @endforelse
                    @if (!request()->input('q'))
                        {{ $blogArticles->links() }}
                    @endif
                </div>
                @include('frontend.includes.blogSidebar')
            </div>
        </div>
        {!! ads_blog_page_bottom() !!}
    </div>
@endsection
