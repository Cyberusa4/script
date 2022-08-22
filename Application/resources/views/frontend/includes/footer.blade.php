<footer class="footer mt-auto @yield('footer_bg')">
    <div class="container">
        <div class="d-flex align-items-center flex-column flex-md-row">
            <p class="mb-0 text-muted mb-3 mb-md-0">&copy; <span data-year></span> {{ $settings['website_name'] }} -
                {{ lang('All rights reserved') }}.</p>
            @if (count($footerMenuLinks) > 0)
                <div class="footer-links ms-md-auto">
                    @foreach ($footerMenuLinks as $footerMenuLink)
                        <div class="footer-link">
                            <a href="{{ $footerMenuLink->link }}">{{ $footerMenuLink->name }}</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</footer>
