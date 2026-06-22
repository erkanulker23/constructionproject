@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ Str::limit(strip_tags($page->content), 155) }}">
    <meta name="keywords" content="{{ $page->title }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($page->content), 155) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')

<div class="single-page page-mobile">
<!-- Hero Section -->
<section class="service-hero-new">
    <picture>
        <source media="(max-width: 768px)" srcset="{{ $heroImageMobile }}">
        <img src="{{ $heroImage }}"
        alt="{{ $page->title }} görseli"
        loading="lazy"
        class="service-hero-bg">
    </picture>
    <div class="container">
      <div class="service-hero-content">
        <div class="service-hero-text">
          <p class="service-category">Kurumsal</p>
          <h1 class="service-title">{{ $page->title }}</h1>
        </div>
      </div>
    </div>
  </section>


    <section id="content" class="content-section page-content-mobile">
      <div class="container">
        <div class="row">
          <article class="col-12">
            <div itemprop="articleBody"> {!! $page->content !!}</div>
          </article>
        </div>
      </div>
    </section>
    </div>
@endsection
