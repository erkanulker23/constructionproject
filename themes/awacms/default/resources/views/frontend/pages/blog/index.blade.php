@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Makale ve blog yazılarımızı buradan inceleyebilir, sektörle ilgili güncel bilgilere ulaşabilirsiniz.">
    <meta name="keywords" content="blog, makale, yazılar, güncel haberler">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Makale & Bloglar">
    <meta property="og:description" content="Tüm makale ve blog yazılarımızı buradan inceleyebilirsiniz.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Blog",
      "name": "Makale & Bloglar",
      "description": "Tüm makale ve blog yazılarımızı buradan inceleyebilirsiniz.",
      "url": "{{ url()->current() }}"
    }
    </script>
@endpush

@section('content')

<!-- Hero Section -->
<section class="blog-hero-new">
    <picture>
        <source media="(max-width: 768px)" srcset="{{ $heroImageMobile }}">
        <img src="{{ $heroImage }}"
        alt="Blog görseli"
        loading="lazy"
        class="blog-hero-bg">
    </picture>
    <div class="container">
      <div class="blog-hero-content">
        <div class="blog-hero-text">
          <p class="blog-category">İçeriklerimiz</p>
          <h1 class="blog-title">Makale & Bloglar</h1>
          <p style="color: #fff; font-size: 1rem; margin-top: 10px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);">Sektörle ilgili güncel bilgiler, içgörüler ve uzman görüşleri</p>
        </div>
      </div>
    </div>
  </section>

<!-- Modern Search & Category Filter -->
<section class="blog-search-category-minimal">
    <div class="container">
        <!-- Search Bar -->
        <div class="blog-search-wrapper">
            <form method="GET" action="{{ url()->current() }}" class="blog-search-form">
                <div class="blog-search-input-group">
                    <input type="text"
                           name="query"
                           value="{{ request()->input('query') }}"
                           placeholder="Blog yazılarında ara..."
                           class="blog-search-input"
                           aria-label="Blog yazılarında ara">
                    <button type="submit" class="blog-search-button" aria-label="Ara">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                @if(request()->input('query'))
                <a href="{{ url()->current() }}" class="blog-search-clear">Temizle</a>
                @endif
            </form>
        </div>

        <!-- Category Filter -->
        <div class="blog-category-wrapper">
            <div class="blog-category-scroll">
                <a href="?category=all{{ request()->input('query') ? '&query=' . request()->input('query') : '' }}"
                   class="blog-category-pill {{ request()->input('category', 'all') === 'all' ? 'active' : '' }}"
                   aria-label="Tüm yazıları göster">
                    Tümü
                </a>
                @foreach($categories as $category)
                <a href="?category={{ $category->slug }}{{ request()->input('query') ? '&query=' . request()->input('query') : '' }}"
                   class="blog-category-pill {{ request()->input('category') === $category->slug ? 'active' : '' }}"
                   aria-label="{{ $category->name }} yazılarını göster">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Modern Minimal Blog Grid -->
<section class="blog-grid-minimal">
    <div class="container">
        <div class="row g-4" id="blog-grid">
            @foreach($posts as $post)
            <div class="col-12 col-md-6 col-lg-4" data-category="{{ $post->category ? $post->category->slug : 'uncategorized' }}">
                <article class="blog-card-minimal" itemscope itemtype="http://schema.org/BlogPosting">
                    <!-- Image -->
                    <a href="{{ $post->url }}" class="blog-card-image">
                        <img src="{{ $post->listingImage }}" alt="{{ $post->title }}" itemprop="image" loading="lazy">
                        <div class="blog-card-overlay">
                            <span class="blog-read-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                    </a>

                    <!-- Content -->
                    <div class="blog-card-content">
                        <!-- Date & Category -->
                        <div class="blog-card-meta">
                            <time class="blog-card-date" itemprop="datePublished" datetime="{{ $post->publishAt->format('Y-m-d') }}">
                                {{ $post->publishAt->translatedFormat('d F Y') }}
                            </time>
                        </div>

                        <!-- Title -->
                        <h2 class="blog-card-title" itemprop="headline">
                            <a href="{{ $post->url }}">{{ $post->title }}</a>
                        </h2>

                        <!-- Excerpt -->
                        <p class="blog-card-excerpt" itemprop="description">
                            {{ Str::words($post->shortDescription, 18, '...') }}
                        </p>

                        <!-- Read More -->
                        <a href="{{ $post->url }}" class="blog-card-link">
                            Devamını Oku
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
