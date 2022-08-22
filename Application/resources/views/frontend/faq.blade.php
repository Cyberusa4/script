@extends('frontend.layouts.pages')
@section('title', lang('FAQ'))
@section('header_version', 'v2')
@section('content')
    <div class="container">
        <div class="section-content col-lg-7 m-auto">
            <div class="accordion" id="accordionParent">
                @foreach ($faqs as $faq)
                    <div class="accordion-item shadow-sm border-0">
                        <h2 class="accordion-header" id="heading{{ hashid($faq->id) }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ hashid($faq->id) }}" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                {{ $faq->title }}
                            </button>
                        </h2>
                        <div id="collapse{{ hashid($faq->id) }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ hashid($faq->id) }}" data-bs-parent="#accordionParent">
                            <div class="accordion-body">
                                <div class="mb-0">{!! $faq->content !!}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $faqs->links() }}
        </div>
    </div>
@endsection
