<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="theme-color" content="{{ $settings['website_primary_color'] }}">
@php
$title = $__env->yieldContent('title') ? $settings['website_name'] . ' - ' . $__env->yieldContent('title') : $settings['website_name'];
$description = $__env->yieldContent('description') ? $__env->yieldContent('description') : $SeoConfiguration->description ?? '';
$robots = $SeoConfiguration ? $SeoConfiguration->robots_index . ', ' . $SeoConfiguration->robots_follow_links : 'index, follow';
$localeAlternate = $SeoConfiguration ? $SeoConfiguration->language->code . '_' . strtoupper($SeoConfiguration->language->code) : getLang() . '_' . strtoupper(getLang());
$ogImage = $__env->yieldContent('og_image') ? $__env->yieldContent('og_image') : asset($settings['website_social_image']);
@endphp
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $SeoConfiguration->keywords ?? '' }}">
<link rel="alternate" hreflang="x-default" href="{{ url('/') }}" />
@foreach ($languages as $language)
<link rel="alternate" hreflang="{{ $language->code }}" href="{{ url($language->code) }}" />
@endforeach
<meta name="robots" content="{{ $robots }}">
<meta name="language" content="{{ $SeoConfiguration->language->name ?? getLang() }}">
<meta name="author" content="{{ $settings['website_name'] }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:site_name" content="{{ $settings['website_name'] }}">
<meta property="og:locale" content="{{ $SeoConfiguration->language->code ?? getLang() }}">
<meta property="og:locale:alternate" content="{{ $localeAlternate }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image:width" content="600">
<meta property="og:image:height" content="315">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:image:src" content="{{ $ogImage }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="application-name" content="{{ $settings['website_name'] }}"/>
<meta name="msapplication-TileImage" content="{{ asset($settings['website_favicon']) }}"/>
<meta name="msapplication-TileColor" content="{{ asset($settings['website_primary_color']) }}"/>
<meta name="msapplication-square70x70logo" content="{{ asset($settings['website_favicon']) }}"/>
<meta name="msapplication-square150x150logo" content="{{ asset($settings['website_favicon']) }}"/>
<meta name="msapplication-wide310x150logo" content="{{ asset($settings['website_favicon']) }}"/>
<meta name="msapplication-square310x310logo" content="{{ asset($settings['website_favicon']) }}"/>
