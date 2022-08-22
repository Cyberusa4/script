<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('title', $SeoConfiguration->title ?? '')
    @include('frontend.includes.head')
    @push('styles_libs')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/aos/aos.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper-bundle.min.css') }}">
        @if (subscription()->is_subscribed)
            <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendor/libs/vironeer/vironeer-icons.min.css') }}">
        @endif
    @endpush
    @include('frontend.includes.styles')
    {!! head_code() !!}
</head>
<body>
    <div class="page-slider">
        <div class="swiper">
            <div class="swiper-wrapper">
                @forelse ($slideshows as $slideshow)
                    @if ($slideshow->type == 1)
                        <div class="swiper-slide" data-swiper-autoplay="{{ $slideshow->duration * 1000 }}">
                            <div class="swiper-bg"
                                style="background-image: url({{ $slideshow->source == 1 ? asset($slideshow->file) : $slideshow->file }})">
                            </div>
                        </div>
                    @elseif ($slideshow->type == 2)
                        <div class="swiper-slide swiper-video"
                            data-swiper-autoplay="{{ $slideshow->duration * 1000 }}">
                            <div class="swiper-video-container">
                                <video loop muted>
                                    <source
                                        src="{{ $slideshow->source == 1 ? asset($slideshow->file) : $slideshow->file }}">
                                </video>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="swiper-slide">
                        <div class="swiper-bg" style="background-image: url(https://via.placeholder.com/2250x1600)">
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <header class="header">
            @include('frontend.includes.navbar')
            <div class="header-content text-center">
                <div class="container">
                    <div class="header-content-img" data-aos="fade" data-aos-duration="1000" data-upload-btn>
                        <svg xmlns="http://www.w3.org/2000/svg" class="faa-bounce animated icon" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1"></path>
                            <polyline points="9 15 12 12 15 15"></polyline>
                            <line x1="12" y1="12" x2="12" y2="21"></line>
                        </svg>
                    </div>
                    <p class="h2 mt-5 mb-4 text-white" data-aos="fade-right" data-aos-duration="1000"
                        data-aos-delay="250">
                        {{ lang('Upload and Share Your Files', 'home page') }}
                    </p>
                    <div class="col-lg-7 mx-auto mb-5" data-aos="fade-left" data-aos-duration="1000"
                        data-aos-delay="500">
                        <p class="text-white lead mb-0">
                            {{ lang('Upload your Images, documents, music, and video in a single place and access them anywhere and share them everywhere.', 'home page') }}
                        </p>
                    </div>
                    <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="750">
                        @if (subscription()->is_subscribed)
                            <button class="btn btn-primary btn-lg px-5" data-dz-click>
                                <i class="fa fa-cloud-upload-alt fa-sm me-1"></i>
                                {{ lang('Upload', 'home page') }}
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">
                                <i class="fa fa-user-plus fa-sm me-1"></i>
                                {{ lang('Get Started', 'home page') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </header>
    </div>
    {!! ads_home_page_top() !!}
    @if (count($features) > 0)
        <section id="features" class="section-content">
            <div class="container">
                <div class="section-content-header text-center">
                    <p class="section-content-title h2 mb-3">{{ lang('Features', 'home page') }}</p>
                    <div class="col-lg-8 col-xl-6 mx-auto">
                        <p class="text-muted">{{ lang('Features description', 'home page') }}</p>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                    @foreach ($features as $feature)
                        <div class="col">
                            <div class="card shadow-sm feat-card h-100" data-aos="zoom-in" data-aos-duration="1000">
                                <div class="feature">
                                    <div class="feature-img">
                                        <img src="{{ asset($feature->image) }}" alt="{{ $feature->title }}"
                                            title="{{ $feature->title }}">
                                    </div>
                                    <div>
                                        <p class="feature-title h4">{{ $feature->title }}</p>
                                        <p class="feature-text text-muted mb-0">{{ $feature->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (licenceType(2))
        @if (count(showPlansByInterval(1)) > 0 || count(showPlansByInterval(2)) > 0 || count(showPlansByInterval(3)) > 0)
            <section id="pricing" class="section-content bg">
                <div class="container">
                    <div class="section-content-header text-center mb-4">
                        <p class="section-content-title h2 mb-3">{{ lang('Pricing', 'home page') }}</p>
                        <div class="col-lg-8 col-xl-6 mx-auto">
                            <p class="text-muted">{{ lang('Pricing description', 'home page') }}</p>
                        </div>
                    </div>
                    @include('frontend.global.includes.plans')
                </div>
            </section>
        @endif
    @endif
    @if (count($blogArticles) > 0 && $settings['website_blog_status'])
        <section id="blog" class="section-content">
            <div class="container">
                <div class="section-content-header text-center">
                    <p class="section-content-title h2 mb-3">{{ lang('Latest blog posts', 'home page') }}</p>
                    <div class="col-lg-8 col-xl-6 mx-auto">
                        <p class="text-muted">{{ lang('Latest blog posts description', 'home page') }}</p>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                    @foreach ($blogArticles as $blogArticle)
                        <div class="col">
                            <div class="post" data-aos="fade-zoom-in" data-aos-duration="1000">
                                <div class="post-header">
                                    <div class="post-img"
                                        style="background-image: url({{ asset($blogArticle->image) }});">
                                    </div>
                                    <a class="post-section"
                                        href="{{ route('blog.category', $blogArticle->blogCategory->slug) }}">
                                        {{ $blogArticle->blogCategory->name }}
                                    </a>
                                </div>
                                <div class="post-body">
                                    <div class="post-meta">
                                        <p class="post-author mb-0">
                                            <i class="fa fa-user"></i>
                                            {{ $blogArticle->admin->firstname . ' ' . $blogArticle->admin->lastname }}
                                        </p>
                                        <time class="post-date">
                                            <i class="fa fa-calendar-alt"></i>
                                            {{ vDate($blogArticle->created_at) }}
                                        </time>
                                    </div>
                                    <a href="{{ route('blog.article', $blogArticle->slug) }}"
                                        class="post-title">{{ shortertext($blogArticle->title, 60) }}</a>
                                    <p class="post-text">
                                        {{ shortertext($blogArticle->short_description, 120) }}</p>
                                    <div class="post-action">
                                        <a href="{{ route('blog.article', $blogArticle->slug) }}"
                                            class="btn btn-primary btn-md">
                                            {{ lang('Read More', 'blog') }} <i
                                                class="fas fa-arrow-right fa-sm ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('blog.index') }}" class="link fs-6">{{ lang('View more', 'home page') }}<i
                            class="fa fa-arrow-right fa-sm ms-1"></i></a>
                </div>
            </div>
        </section>
    @endif
    {!! ads_home_page_bottom() !!}
    @if (count($faqs) > 0 && $settings['website_faq_status'])
        <section id="faq" class="section-content bg-primary">
            <div class="container">
                <div class="section-content-header text-center">
                    <p class="section-content-title h2 mb-3">{{ lang('FAQ', 'home page') }}</p>
                    <div class="col-lg-8 col-xl-6 mx-auto">
                        <p class="section-content-text">{{ lang('FAQ description', 'home page') }}</p>
                    </div>
                </div>
                <div class="accordion" id="accordionParent" data-aos="fade-up" data-aos-duration="1000">
                    @foreach ($faqs as $faq)
                        <div class="accordion-item shadow-sm border-0">
                            <h2 class="accordion-header" id="heading{{ hashid($faq->id) }}">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ hashid($faq->id) }}" aria-expanded="false"
                                    aria-controls="collapse{{ hashid($faq->id) }}">
                                    {{ $faq->title }}
                                </button>
                            </h2>
                            <div id="collapse{{ hashid($faq->id) }}"
                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                aria-labelledby="heading{{ hashid($faq->id) }}" data-bs-parent="#accordionParent">
                                <div class="accordion-body">
                                    <div class="mb-0">{!! $faq->content !!}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('faq') }}" class="link-white fs-6">
                            {{ lang('Find out more answers on our FAQ', 'home page') }}<i
                                class="fa fa-arrow-right fa-sm ms-1"></i></a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($settings['website_contact_form_status'])
        <section id="contact" class="section-content">
            <div class="container">
                <div class="section-content-header text-center">
                    <p class="section-content-title h2 mb-3">{{ lang('Contact Us', 'home page') }}</p>
                    <div class="col-lg-8 col-xl-6 mx-auto">
                        <p class="text-muted">{{ lang('Contact Us description', 'home page') }}</p>
                    </div>
                </div>
                <div class="col-xl-8 mx-auto" data-aos="fade-zoom-in" data-aos-duration="1000">
                    @include('frontend.includes.contactForm')
                </div>
            </div>
        </section>
    @endif
    @if (subscription()->is_subscribed)
        @include('frontend.global.includes.uploadbox')
    @endif
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/aos/aos.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/sweetalert/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    @endpush
    @include('frontend.includes.footer')
    @include('frontend.configurations.config')
    @include('frontend.configurations.widgets')
    @include('frontend.includes.scripts')
    {!! google_captcha() !!}
</body>
</html>
