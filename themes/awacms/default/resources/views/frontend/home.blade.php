@php
    use Spatie\LaravelSettings\Exceptions\MissingSettings;

    try {
        $generalSettings = app(\App\Settings\GeneralSettings::class);
    } catch (MissingSettings $e) {
        // Settings not configured yet, use defaults
        $generalSettings = null;
    }
@endphp

@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $generalSettings->site_description ?? 'Profesyonel hizmetlerimiz ve çözümlerimizle yanınızdayız. Kalite, güven ve mükemmellik için bizi tercih edin.' }}">
    <meta name="keywords" content="{{ $generalSettings->site_keywords ?? 'anasayfa, hizmetler, çözümler' }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $generalSettings->site_name ?? 'Ana Sayfa' }}">
    <meta property="og:description" content="{{ $generalSettings->site_description ?? 'Profesyonel hizmetlerimiz ve çözümlerimizle yanınızdayız.' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    @if($generalSettings->site_logo ?? false)
    <meta property="og:image" content="{{ $generalSettings->site_logo }}">
    @endif

    <!-- Critical Resource Preloading -->
    <link rel="preload" href="{{ asset('themes/awacms/default/public/css/newstyle.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('themes/awacms/default/public/css/icon.min.css') }}" as="style">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $generalSettings->site_name ?? 'Ana Sayfa' }}">
    <meta name="twitter:description" content="{{ $generalSettings->site_description ?? 'Profesyonel hizmetlerimiz ve çözümlerimizle yanınızdayız.' }}">
    @if($generalSettings->site_logo ?? false)
    <meta name="twitter:image" content="{{ $generalSettings->site_logo }}">
    @endif
@endpush

@section('content')
    @include('components.blocks_renderer', ['blocks' => $content])
@endsection

@push('scripts')
    @include('frontend.components.schema.organization')
    @include('frontend.components.schema.website')
@endpush
