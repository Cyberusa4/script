<div class="col-12 col-xl-4">
    <div class="blog-card border-0 shadow-sm">
        <form action="{{ route('blog.index') }}" method="GET">
            <div class="input-group custom-right">
                <input type="text" name="q" class="form-control form-control-lg" required
                    placeholder="{{ lang('Search..', 'blog') }}" value="{{ request()->input('q') ?? '' }}">
                <button class="btn btn-primary px-3"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="blog-card border-0 shadow-sm">
        @include('frontend.includes.shareBottons')
    </div>
    {!! ads_blog_page_sidebar_top() !!}
    @if (count($recentBlogArticles) > 0)
        <div class="blog-card border-0 shadow-sm">
            <div class="blog-card-header">
                <p class="blog-card-title h5">{{ lang('Popular articles', 'blog') }}</p>
            </div>
            <div class="blog-card-body">
                @foreach ($recentBlogArticles as $recentBlogArticle)
                    <div class="blog-card-item">
                        <div class="blog-card-img">
                            <img src="{{ asset($recentBlogArticle->image) }}" alt="{{ $recentBlogArticle->title }}"
                                title="{{ $recentBlogArticle->title }}" />
                        </div>
                        <div class="blog-card-info">
                            <a class="blog-card-info-title mb-2 d-block"
                                href="{{ route('blog.article', $recentBlogArticle->slug) }}">{{ shortertext($recentBlogArticle->title, 60) }}</a>
                            <p class="blog-card-info-text mb-0 small">
                                <i class="far fa-calendar-alt text-primary me-2 fs-6"></i>
                                {{ vDate($recentBlogArticle->created_at) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    {!! ads_blog_page_sidebar_bottom() !!}
    @if (count($blogCategories) > 0)
        <div class="blog-card border-0 shadow-sm">
            <div class="blog-card-header">
                <p class="blog-card-title h5">{{ lang('Categories', 'blog') }}</p>
            </div>
            <div class="blog-card-body">
                @foreach ($blogCategories as $blogCategory)
                    <div class="blog-card-item">
                        <a href="{{ route('blog.category', $blogCategory->slug) }}">{{ $blogCategory->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
