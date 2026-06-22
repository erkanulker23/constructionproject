@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Hizmetlerimizi keşfedin. Profesyonel çözümler ve kaliteli hizmet anlayışımızla yanınızdayız.">
    <meta name="keywords" content="hizmetler, servisler, profesyonel hizmetler">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Hizmetlerimiz">
    <meta property="og:description" content="Profesyonel hizmetlerimizi keşfedin.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')

<!-- Hero Section -->
<section class="service-hero-new">
    <picture>
        <source media="(max-width: 768px)" srcset="{{ $heroImageMobile }}">
        <img src="{{ $heroImage }}"
        alt="Hizmetler görseli"
        loading="lazy"
        class="service-hero-bg">
    </picture>
    <div class="container">
      <div class="service-hero-content">
        <div class="service-hero-text">
          <p class="service-category">Çözümlerimiz</p>
          <h1 class="service-title">Hizmetlerimiz</h1>
          <p style="color: #fff; font-size: 1rem; margin-top: 10px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);">Profesyonel çözümlerimizle ihtiyaçlarınıza en uygun hizmeti sunuyoruz</p>
        </div>
      </div>
    </div>
  </section>

<!-- Modern Search Section -->
<section class="services-search-minimal">
    <div class="container">
        <div class="services-search-wrapper">
            <form method="GET" action="{{ url()->current() }}" class="services-search-form">
                <div class="services-search-input-group">
                    <input type="text"
                           name="query"
                           value="{{ request()->input('query') }}"
                           placeholder="Hizmetlerde ara..."
                           class="services-search-input"
                           aria-label="Hizmetlerde ara">
                    <button type="submit" class="services-search-button" aria-label="Ara">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                @if(request()->input('query'))
                <a href="{{ url()->current() }}" class="services-search-clear">Temizle</a>
                @endif
            </form>
        </div>
    </div>
</section>

<!-- Modern Minimal Services Grid -->
<section class="services-grid-minimal">
    <div class="container">
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-12 col-md-6 col-lg-4">
                <article class="service-card-minimal" itemscope itemtype="https://schema.org/Service">
                    <!-- Image -->
                    <a href="{{ $service->url }}" class="service-card-image" aria-label="{{ $service->title }} hizmet detayı">
                        <picture>
                            <source media="(max-width: 768px)" srcset="{{ $service->listingImageMobile ?: $service->listingImage }}">
                            <img src="{{ $service->listingImage }}" alt="{{ $service->title }} görseli" itemprop="image" loading="lazy">
                        </picture>
                        <div class="service-card-overlay">
                            <span class="service-read-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                    </a>

                    <!-- Content -->
                    <div class="service-card-content">
                        <!-- Title -->
                        <h2 class="service-card-title" itemprop="name">
                            <a href="{{ $service->url }}">{{ $service->title }}</a>
                        </h2>

                        <!-- Description -->
                        <p class="service-card-description" itemprop="description">
                            {{ Str::words($service->shortDescription, 15, '...') }}
                        </p>

                        <!-- Learn More -->
                        <a href="{{ $service->url }}" class="service-card-link">
                            Detaylı Bilgi
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="services-pagination">
            {{ $paginatedServices->links('frontend.components.pagination') }}
        </div>
    </div>
</section>

@endsection
