@extends('backend.layouts.form')
@section('title', 'Translate > ' . $language->name)
@section('section', __('Settings'))
@section('back', route('languages.index'))
@section('content')
    @if ($translates_count > 0)
        <div class="note note-warning d-flex">
            <div class="icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div>
                <strong>{{ __('This language is incomplete') }}</strong><br>
                <small>{{ $translates_count }} {{ __('translations are missing. You can') }} <a
                        href="{{ request()->url() . '?filter=missing' }}">{{ __('filter this page') }}</a>
                    {{ __(' to show missing translations.') }}</small>
            </div>
        </div>
    @endif
    <div class="card translate-card">
        <div class="card-header">
            <div class="mt-3 {{ count($groups) > 13 ? 'mb-3' : 'mb-4' }}">
                <form action="{{ request()->url() }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="{{ __('Search on translations...') }}"
                            value="{{ request()->input('search') ?? '' }}" required>
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">{{ __('Filter') }}</button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item"
                                    href="{{ route('language.translate', $language->code) }}">{{ __('All translations') }}</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ request()->url() . '?filter=missing' }}">{{ __('Missing translations') }}</a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            @php
                if (request()->input('filter')) {
                    $url = request()->url() . "?filter=missing";
                } elseif (request()->input('search')) {
                    $url = request()->url() . "?search=" . request()->input('search');
                }
            @endphp
            <ul class="nav {{ count($groups) > 13 ? 'nav-pills' : 'nav-tabs' }} card-header-tabs">
                @foreach ($groups as $group)
                    <li class="nav-item">
                        <a class="nav-link @if ($active == $group->group_name) active @endif"
                            href="{{ $url ?? route('language.translate.group', [$language->code, str_replace(' ', '-', $group->group_name)]) }}">{{ $group->group_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-body my-1">
            <form id="vironeer-submited-form" action="{{ route('translates.update', $language->id) }}" method="POST">
                @csrf
                @forelse($translates as $translate)
                    <div class="vironeer-translated-item d-block d-lg-flex bd-highlight align-items-center">
                        <div class="flex-grow-1 bd-highlight">
                            <textarea id="autosizeInput" class="vironeer-translate-key translate-fields form-control" rows="1"
                                readonly>{{ $translate->key }}</textarea>
                        </div>
                        <div class="pe-3 ps-3 bd-highlight text-center text-success d-none d-lg-block"><i
                                class="fas fa-chevron-right"></i></div>
                        <div class="flex-grow-1 bd-highlight">
                            <textarea id="autosizeInput" name="values[{{ $translate->id }}]" class="translate-fields form-control" rows="1"
                                placeholder="{{ $translate->key }}">{{ $translate->value }}</textarea>
                        </div>
                    </div>
                @empty
                    <div class="alert text-center mb-0">
                        {{ __('No data found') }}
                    </div>
                @endforelse
            </form>
        </div>
    </div>
    @push('scripts_libs')
        <script src="{{ asset('assets/vendor/libs/autosize/autosize.min.js') }}"></script>
    @endpush
    @push('scripts')
        <script>
            autosize($('textarea'));
        </script>
    @endpush
@endsection
