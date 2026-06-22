@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $servicePost->seoDescription ?? Str::limit(strip_tags($servicePost->content), 155) }}">
    <meta name="keywords" content="{{ $servicePost->title }}">
    <meta name="author" content="{{ config('app.name') }}">
    <link rel="canonical" href="{{ $servicePost->url }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $servicePost->title }}">
    <meta property="og:description" content="{{ $servicePost->seoDescription ?? Str::limit(strip_tags($servicePost->content), 155) }}">
    <meta property="og:image" content="{{ $servicePost->detailHero }}">
    <meta property="og:url" content="{{ $servicePost->url }}">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="tr_TR">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $servicePost->title }}">
    <meta name="twitter:description" content="{{ $servicePost->seoDescription ?? Str::limit(strip_tags($servicePost->content), 155) }}">
    <meta name="twitter:image" content="{{ $servicePost->detailHero }}">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "{{ $servicePost->title }}",
      "name": "{{ $servicePost->title }}",
      "description": "{{ Str::limit(strip_tags($servicePost->content), 200) }}",
      "provider": {
        "@type": "Organization",
        "name": "{{ config('app.name') }}",
        "url": "{{ url('/') }}"
      },
      "areaServed": "TR",
      "image": "{{ $servicePost->detailHero }}",
      "url": "{{ $servicePost->url }}"
    }
    </script>

    <!-- Breadcrumb Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Ana Sayfa",
          "item": "{{ url('/') }}"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Hizmetler",
          "item": "{{ url('/hizmetler') }}"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "{{ $servicePost->title }}",
          "item": "{{ $servicePost->url }}"
        }
      ]
    }
    </script>
@endpush

@section('content')

 <!-- Hero Section -->
 <section class="service-hero-new">
    <img src="{{ $servicePost->detailHero }}"
    alt="{{ $servicePost->title }} görseli"
    loading="lazy"
    class="service-hero-bg">
    <div class="container">
      <div class="service-hero-content">
        <div class="service-hero-text">
          <p class="service-category">{{ $servicePost->categories?->first()?->name ?? 'Hizmet Kategorisi Yok' }}</p>
          <h1 class="service-title">{{ $servicePost->title }}</h1>
        </div>

        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="service-breadcrumb">
          <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" title="Ana Sayfa">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/hizmetler') }}" title="Hizmetler">Hizmetler</a></li>
            @if($servicePost->categories?->first())
            <li class="breadcrumb-item"><a href="{{ $servicePost->categories->first()->url ?? '#' }}" title="{{ $servicePost->categories->first()->name }}">{{ $servicePost->categories->first()->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $servicePost->title }}</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>

  <section class="newservice-main">
    <div class="container">
      <div class="row">
        <!-- Sidebar -->
        <aside class="col-lg-4 order-2 order-lg-1 pe-lg-4 newservice-sidebar service-sidebar-mobile">
          <!-- Okuma Süresi ve Görüntülenme Bilgileri -->
          <div class="card mb-3">
            <div class="card-body">
              <h2 class="card-title h5"><i class="fas fa-info-circle" aria-hidden="true"></i> Hizmet Bilgileri</h2>
              <div class="reading-info">
                <div class="reading-time mb-2">
                  <i class="fas fa-stopwatch text-primary"></i>
                  <span class="ms-2">Tahmini okuma süresi: <strong id="reading-time">Hesaplanıyor...</strong></span>
                </div>

                <div class="view-count">
                  <i class="fas fa-eye text-primary"></i>
                  <span class="ms-2">Görüntülenme: <strong>{{ $servicePost->viewCount ?? '0' }}</strong></span>
                </div>
              </div>
            </div>
          </div>

          <div class="contact-box phone contact-box-mobile">
            <i class="fas fa-phone" aria-hidden="true"></i>
            <div class="content">
              <span>7/24 İletişim</span>
              <a href="tel:{{ $generalSettings->phone}}" title="Bizi arayın" aria-label="Telefon ile iletişime geç">{{ $generalSettings->phone}}</a>
              <div class="btn-container">
                <a href="tel:{{ $generalSettings->phone}}" class="btn btn-primary">İletişime Geç</a>
              </div>
            </div>
          </div>
          <div class="contact-box whatsapp contact-box-mobile">
            <i class="fab fa-whatsapp" aria-hidden="true"></i>
            <div class="content">
              <span>WhatsApp Destek</span>
              <a href="https://wa.me/{{ $generalSettings->whatsapp }}" title="WhatsApp ile iletişime geç" aria-label="WhatsApp ile mesaj gönder">{{ $generalSettings->whatsapp }}</a>
              <div class="btn-container">
                <a href="https://wa.me/{{ $generalSettings->whatsapp }}" class="btn btn-primary">İletişime Geç</a>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h2 class="card-title h5"> {{ $servicePost->categories?->first()?->name ?? 'HİZMETLERİMİZ' }}</h2>

              <ul class="services-box">
              @foreach($relevantServices as $relevantService)

                <li><a href="{{ $relevantService->url }}" class="pb-15px mb-5px border-color-extra-medium-gray"
                title=" {{ $relevantService->title ?? 'Varsayılan Hizmet Başlığı' }}">
                {{ $relevantService->title ?? 'Varsayılan Hizmet Başlığı' }}  <i class="feather icon-feather-arrow-right ms-auto"></i></a>
               </li>

                @endforeach

              </ul>

            </div>
          </div>
        </aside>

        <!-- Main Content -->
        <main class="col-lg-8 order-1 order-lg-2 content" role="main">

          <article id="service-content" itemscope itemtype="https://schema.org/Article">
            <header class="article-header visually-hidden">
              <h2 itemprop="headline">{{ $servicePost->title }}</h2>
              <meta itemprop="datePublished" content="{{ $servicePost->publishAt?->toIso8601String() }}">
              <meta itemprop="dateModified" content="{{ $servicePost->updatedAt?->toIso8601String() }}">
              @if($servicePost->detailHero)
              <meta itemprop="image" content="{{ $servicePost->detailHero }}">
              @endif
            </header>
            <div itemprop="articleBody">
              {!! $servicePost->content ?? 'Varsayılan İçerik' !!}
            </div>
            @if($servicePost->jotformId)
             <div id="jotform-container-{{ $servicePost->jotformId }}"></div>
             @endif
          </article>

        </main>
      </div>
    </div>
  </section>

@endsection

@push('scripts')
    {!! $servicePostingScript ?? '' !!}

    @if($servicePost->jotformId)
    <script>
    // Jotform script'ini güvenli bir şekilde yükle
    (function() {
        // DOM tamamen yüklenene kadar bekle
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadJotformScript);
        } else {
            loadJotformScript();
        }

        function loadJotformScript() {
            // Container'ın var olduğundan emin ol
            const container = document.getElementById('jotform-container-{{ $servicePost->jotformId }}');
            if (!container) {
                return;
            }

            // Script'i dinamik olarak oluştur ve yükle
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://form.jotform.com/jsform/{{ $servicePost->jotformId }}';
            script.async = true;

            // Hata durumunda sessizce devam et
            script.onerror = function() {
                // Silent - hata gösterme
            };

            // Script yüklendikten sonra container'a ekle
            document.body.appendChild(script);
        }
    })();
    </script>
    @endif

    <script>
    // Okuma süresi hesaplama fonksiyonu
    function calculateReadingTime() {
        let attempts = 0;
        const maxAttempts = 5;

        function tryCalculateReadingTime() {
            attempts++;

            // İçerik selector'ları
            const contentSelectors = [
                '#service-content [itemprop="articleBody"]',
                '#service-content',
                '[itemprop="articleBody"]',
                'article div'
            ];

            let content = null;
            for (let selector of contentSelectors) {
                content = document.querySelector(selector);
                if (content) {
                    break;
                }
            }

            if (!content) {
                if (attempts < maxAttempts) {
                    setTimeout(tryCalculateReadingTime, 500);
                } else {
                    const readingTimeElement = document.getElementById('reading-time');
                    if (readingTimeElement) {
                        readingTimeElement.textContent = 'Hesaplanamadı';
                    }
                }
                return;
            }

            // İçeriği al
            const text = content.textContent || content.innerText || '';

            if (!text || text.trim().length === 0) {
                if (attempts < maxAttempts) {
                    setTimeout(tryCalculateReadingTime, 500);
                } else {
                    const readingTimeElement = document.getElementById('reading-time');
                    if (readingTimeElement) {
                        readingTimeElement.textContent = 'İçerik yok';
                    }
                }
                return;
            }

            // HTML etiketlerini temizle
            const cleanText = text.replace(/<[^>]*>/g, ' ')
                                 .replace(/\s+/g, ' ')
                                 .replace(/[^\w\sçğıöşüÇĞIİÖŞÜ]/g, ' ')
                                 .trim();

            // Kelimeleri say
            const words = cleanText.split(/\s+/).filter(word => word.length > 0);
            const wordCount = words.length;

            if (wordCount === 0) {
                if (attempts < maxAttempts) {
                    setTimeout(tryCalculateReadingTime, 500);
                } else {
                    const readingTimeElement = document.getElementById('reading-time');
                    if (readingTimeElement) {
                        readingTimeElement.textContent = 'Kelime yok';
                    }
                }
                return;
            }

            // Ortalama okuma hızı: 200 kelime/dakika (Türkçe için)
            let readingTime = Math.ceil(wordCount / 200);

            // Minimum 1 dakika
            if (readingTime < 1) readingTime = 1;

            // Maksimum 60 dakika
            if (readingTime > 60) readingTime = 60;

            const readingTimeElement = document.getElementById('reading-time');
            if (readingTimeElement) {
                readingTimeElement.textContent = readingTime + ' dakika';
            }
        }

        // İlk denemeyi başlat
        tryCalculateReadingTime();
    }

    // Sayfa yüklendiğinde çalıştır
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(calculateReadingTime, 500);
        });
    } else {
        setTimeout(calculateReadingTime, 500);
    }

    // Sayfa tamamen yüklendiğinde de dene
    window.addEventListener('load', function() {
        setTimeout(calculateReadingTime, 1000);
    });
    </script>

    <style>
    /* Okuma Bilgileri Stilleri */
    .reading-info {
        font-size: 0.9rem;
    }

    .reading-info i {
        width: 16px;
    }

    .reading-time,
    .publish-date,
    .view-count {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
    }

    .meta span {
        margin-right: 20px;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .meta span i {
        margin-right: 5px;
        color: #007bff;
    }
    </style>
@endpush
