@extends('frontend.layouts.app')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $post->seo_description ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta name="keywords" content="{{ $post->categories->pluck('name')->join(', ') }}">
    <meta name="author" content="{{ $generalSettings->site_name ?? 'Site Yöneticisi' }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->seo_description ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:image" content="{{ $post->listingImage ?? '/default-blog-image.jpg' }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="{{ $generalSettings->site_name ?? 'Site Adı' }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->seo_description ?? Str::limit(strip_tags($post->content), 160) }}">
    <meta name="twitter:image" content="{{ $post->listingImage ?? '/default-blog-image.jpg' }}">

    <!-- Article Specific Meta -->
    <meta property="article:published_time" content="{{ $post->publishAt ? $post->publishAt->format('c') : '' }}">
    <meta property="article:author" content="{{ $generalSettings->site_name ?? 'Site Yöneticisi' }}">
    @if($post->categories->count() > 0)
        @foreach($post->categories as $category)
            <meta property="article:section" content="{{ $category->name }}">
        @endforeach
    @endif
@endpush

@section('content')

<section class="blog-hero-new">
    <img src="{{ $post->detailHero }}"
    alt="{{ $post->title }} görseli" class="blog-hero-bg" loading="lazy">
    <div class="container">
      <div class="blog-hero-content">
        <div class="blog-hero-text">
          <p class="blog-category">{{ $post->categories?->first()?->name ?? 'Kategori Mevcut Değil' }}</p>
          <h1 class="blog-title">{{ $post->title ?? 'Başlık Mevcut Değil' }}</h1>
        </div>

        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="blog-breadcrumb">
          <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
            @if($post->categories->count() > 0)
              <li class="breadcrumb-item">
                <a href="{{ route('blog.index', ['category' => $post->categories->first()->slug]) }}">
                  {{ $post->categories->first()->name }}
                </a>
              </li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
          </ol>
        </nav>
      </div>
    </div>
  </section>


  <section class="newservice-main">
    <div class="container">
      <div class="row">
        <!-- Sidebar -->
        <aside class="col-lg-4 order-2 order-lg-1 pe-lg-4 newservice-sidebar blog-sidebar-mobile">
          <!-- Okuma Süresi ve İçindekiler -->
          <div class="card mb-3">
            <div class="card-body">
              <h2 class="card-title h5"><i class="fas fa-clock"></i> Okuma Bilgileri</h2>
              <div class="reading-info">
                <div class="reading-time mb-2">
                  <i class="fas fa-stopwatch text-primary"></i>
                  <span class="ms-2">Tahmini okuma süresi: <strong id="reading-time">Hesaplanıyor...</strong></span>
                  <button type="button" class="btn btn-xs btn-outline-secondary ms-1" onclick="calculateReadingTime()" title="Okuma süresini yeniden hesapla">
                    <i class="fas fa-sync-alt" style="font-size: 10px;"></i>
                  </button>
                </div>
                <div class="publish-date mb-2">
                  <i class="fas fa-calendar-alt text-primary"></i>
                  <span class="ms-2">Yayın tarihi: <strong>{{ $post->publishAt ? $post->publishAt->format('d.m.Y') : 'Tarih Yok' }}</strong></span>
                </div>
                <div class="comment-count">
                  <i class="fas fa-comments text-primary"></i>
                  <span class="ms-2">Yorum sayısı: <strong>{{ $post->comments_count ?? '0' }}</strong></span>
                </div>
              </div>
            </div>
          </div>

          <!-- İçindekiler -->
          <div class="card mb-3" id="sidebar-toc">
            <div class="card-body">
              <h2 class="card-title h5">
                <i class="fas fa-list"></i> İçindekiler
                <button type="button" class="btn btn-xs btn-outline-secondary ms-1" onclick="generateTableOfContents()" title="İçindekileri yeniden yükle" aria-label="İçindekileri yenile">
                  <i class="fas fa-sync-alt" style="font-size: 10px;"></i>
                </button>
              </h2>
              <ul class="blog-detail-toc" id="tableOfContents">
                <!-- JavaScript ile doldurulacak -->
              </ul>
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
              <h2 class="card-title h5">Diğer Yazılarımız</h2>
              <ul class="services-box">
              @foreach($latestPosts as $latestPost)

                <li>
                <a href="{{ $latestPost->url }}" title="{{ $latestPost->title ?? 'Son yazı' }}">
                  {{ $latestPost->title ?? 'Son yazı' }} </a>
                </li>
                @endforeach
              </ul>
              @if($post->gallery)
                            <ul class="image-gallery-style-01 mb-7 gallery-wrapper grid grid-3col xxl-grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-small">
                                <li class="grid-sizer"></li>
                                @foreach($post->gallery->entries as $entry)
                                    @foreach($entry->getMedia('image') as $media)
                                        <li class="grid-item transition-inner-all">
                                            <div class="gallery-box">
                                                <a href="{{ $media->getUrl() }}" data-group="lightbox-gallery" title="{{ $entry->title ?? $post->title }}" aria-label="Galeri resmi: {{ $entry->title ?? 'Resim' }}">
                                                    <div class="position-relative gallery-image bg-white overflow-hidden">
                                                        <img src="{{ $media->getUrl() }}" alt="{{ $entry->title ?? 'Galeri resmi' }}" />
                                                        <div class="d-flex align-items-center justify-content-center position-absolute top-0px left-0px w-100 h-100 gallery-hover move-bottom-top">
                                                            <div class="d-flex align-items-center justify-content-center w-50px h-50px rounded-circle bg-dark-gray">
                                                                <i class="feather icon-feather-search text-white icon-small"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        @endif

            </div>
          </div>
        </aside>


        <!-- Main Content -->
        <main class="col-lg-8 order-1 order-lg-2 content">



          <article id="blog-content" itemscope itemtype="https://schema.org/Article">
            <div class="blog-content-wrapper" itemprop="articleBody">
              {!! $post->content ?? 'İçerik bulunamadı.' !!}
            </div>

            <footer class="article-footer">
              <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                <meta itemprop="name" content="{{ $generalSettings->site_name ?? 'Site Adı' }}">
              </div>
            </footer>
          </article>
          <div class="share-section">
            <span><i class="fas fa-share"></i> <span id="share-count">{{ $post->share_count ?? '0' }}</span> Paylaşım</span>
            <div class="share-icons">
              <a href="https://linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" title="LinkedIn'da paylaş" class="share-link" data-platform="linkedin">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Facebook'ta paylaş" class="share-link" data-platform="facebook">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="https://x.com/intent/post?text={{ urlencode($post->title ?? '') }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" title="X'te paylaş" class="share-link" data-platform="twitter">
                <i class="fab fa-x-twitter"></i>
              </a>
              <a href="mailto:?subject={{ urlencode($post->title ?? '') }}&body={{ urlencode('Bu yazıyı okumanızı tavsiye ederim: ' . request()->fullUrl()) }}" title="E-posta ile paylaş" class="share-link" data-platform="email">
                <i class="fas fa-envelope"></i>
              </a>
            </div>
          </div>
          <!-- Yorum Formu -->
          <div class="comment-form mb-5 comment-form-mobile">
            <h2 class="h4"><i class="fas fa-comment" aria-hidden="true"></i> Yorum Yap</h2>
            <form id="comment-form" data-post-id="{{ $post->id }}">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <input type="text" name="fullname" class="form-control" placeholder="Adınız Soyadınız" required>
                </div>
                <div class="col-md-6 mb-3">
                  <input type="email" name="email" class="form-control" placeholder="E-posta Adresiniz" required>
                </div>
              </div>
              <div class="mb-3">
                <textarea name="comment" class="form-control" rows="4" placeholder="Yorumunuzu buraya yazın..." required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Yorum Gönder
              </button>
            </form>
            <div id="comment-message" class="mt-3"></div>
          </div>

          <!-- Yorumlar -->
          <div class="comments comments-mobile" id="comments-section">
            <h2 class="h4"><i class="fas fa-comments" aria-hidden="true"></i> Yorumlar (<span id="comment-count">{{ $post->comments_count ?? '0' }}</span>)</h2>
            <div id="comments-list">
              @if($post->comments && $post->comments->count() > 0)
                @foreach($post->comments as $comment)
                  @if($comment->is_approved)
                    <div class="comment mb-4" data-comment-id="{{ $comment->id }}" itemscope itemtype="https://schema.org/Comment">
                      <div class="comment-avatar">
                        <i class="fas fa-user-circle"></i>
                      </div>
                      <div class="comment-content">
                        <div class="comment-header">
                          <div class="comment-author" itemprop="author">{{ $comment->fullname }}</div>
                          <div class="comment-date" itemprop="datePublished">{{ $comment->created_at->format('d.m.Y H:i') }}</div>
                          @if($comment->rating)
                            <div class="comment-rating">
                              @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $comment->rating ? 'text-warning' : 'text-muted' }}"></i>
                              @endfor
                            </div>
                          @endif
                        </div>
                        <div class="comment-text" itemprop="text">{{ $comment->comment }}</div>
                        <div class="comment-actions">
                          <button class="btn btn-sm btn-outline-primary reply-btn" data-comment-id="{{ $comment->id }}">
                            <i class="fas fa-reply"></i> Yanıtla
                          </button>
                        </div>

                        <!-- Yanıt Formu (Gizli) -->
                        <div class="reply-form mt-3" id="reply-form-{{ $comment->id }}" style="display: none;">
                          <form class="reply-comment-form" data-parent-id="{{ $comment->id }}">
                            @csrf
                            <div class="row">
                              <div class="col-md-6 mb-2">
                                <input type="text" name="fullname" class="form-control form-control-sm" placeholder="Adınız Soyadınız" required>
                              </div>
                              <div class="col-md-6 mb-2">
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="E-posta Adresiniz" required>
                              </div>
                            </div>
                            <div class="mb-2">
                              <textarea name="comment" class="form-control form-control-sm" rows="3" placeholder="Yanıtınızı yazın..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">
                              <i class="fas fa-reply"></i> Yanıt Gönder
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary cancel-reply" data-comment-id="{{ $comment->id }}">
                              İptal
                            </button>
                          </form>
                        </div>

                        <!-- Yanıtlar -->
                        @if($comment->children && $comment->children->count() > 0)
                          <div class="comment-replies mt-3">
                            @foreach($comment->children as $reply)
                              @if($reply->is_approved)
                                <div class="comment reply-comment" data-comment-id="{{ $reply->id }}">
                                  <div class="comment-avatar">
                                    <i class="fas fa-user-circle"></i>
                                  </div>
                                  <div class="comment-content">
                                    <div class="comment-header">
                                      <div class="comment-author">{{ $reply->fullname }}</div>
                                      <div class="comment-date">{{ $reply->created_at->format('d.m.Y H:i') }}</div>
                                    </div>
                                    <div class="comment-text">{{ $reply->comment }}</div>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          </div>
                        @endif
                      </div>
                    </div>
                  @endif
                @endforeach
              @else
                <div class="no-comments text-center py-4">
                  <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                  <p class="text-muted">Henüz yorum yapılmamış. İlk yorumu siz yapın!</p>
                </div>
              @endif
            </div>
          </div>
        </main>
      </div>
    </div>
  </section>
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@graph": [
        {
          "@type": "WebSite",
          "name": "Your Company Name",
          "url": "https://yourwebsite.com",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://yourwebsite.com/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        },
        {
          "@type": "Organization",
          "name": "Your Company Name",
          "url": "https://yourwebsite.com",
          "logo": "https://yourwebsite.com/logo.png"
        },
        {
          "@type": "BlogPosting",
          "headline": "Trends shaping the logistics and transportation industry",
          "image": "https://images.unsplash.com/photo-1586528116311-aca81e9020c4",
          "datePublished": "2024-07-30",
          "description": "Discover the latest innovations driving efficiency in logistics. From AI to IoT, these trends are transforming the industry. Stay ahead with our insights.",
          "author": {
            "@type": "Person",
            "name": "Den Viliamson"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        },
        {
          "@type": "BlogPosting",
          "headline": "Technology integration in logistics processes",
          "image": "https://images.unsplash.com/photo-1516321314538-43d7b3a49f4e",
          "datePublished": "2024-07-28",
          "description": "Technology is revolutionizing logistics operations. Learn how automation and data analytics are optimizing supply chains. Explore the future of logistics tech.",
          "author": {
            "@type": "Person",
            "name": "Hugh Macleod"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        },
        {
          "@type": "BlogPosting",
          "headline": "Global trade & logistics and transport strategies",
          "image": "https://images.unsplash.com/photo-1586528116145-8b2e3b3d2b3e",
          "datePublished": "2024-07-26",
          "description": "Global trade demands robust logistics strategies. Understand how to navigate international markets effectively. Optimize your supply chain today.",
          "author": {
            "@type": "Person",
            "name": "Walton Smith"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        },
        {
          "@type": "BlogPosting",
          "headline": "Security measures in supply chain management",
          "image": "https://images.unsplash.com/photo-1600585154340-be6161a56a0c",
          "datePublished": "2024-07-30",
          "description": "Protect your supply chain with advanced security protocols. Learn best practices to safeguard your operations. Ensure reliability and trust.",
          "author": {
            "@type": "Person",
            "name": "Den Viliamson"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        },
        {
          "@type": "BlogPosting",
          "headline": "The impact of e-Commerce on logistics",
          "image": "https://images.unsplash.com/photo-1586528116292-3b3e3b3d2b3e",
          "datePublished": "2024-07-28",
          "description": "e-Commerce is reshaping logistics demands. Explore how to adapt to faster delivery expectations. Boost your logistics efficiency now.",
          "author": {
            "@type": "Person",
            "name": "Hugh Macleod"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        },
        {
          "@type": "BlogPosting",
          "headline": "The future of autonomous vehicles in logistics",
          "image": "https://images.unsplash.com/photo-1516321314538-43d7b3a49f4e",
          "datePublished": "2024-07-26",
          "description": "Autonomous vehicles are set to revolutionize logistics. Discover their potential to reduce costs and increase efficiency. Prepare for the future.",
          "author": {
            "@type": "Person",
            "name": "Walton Smith"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        },
        {
          "@type": "BlogPosting",
          "headline": "Collaborative logistics partnerships",
          "image": "https://images.unsplash.com/photo-1586528116311-aca81e9020c4",
          "datePublished": "2024-07-30",
          "description": "Strategic partnerships can enhance logistics efficiency. Learn how to build strong collaborations. Drive success through synergy.",
          "author": {
            "@type": "Person",
            "name": "Den Viliamson"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        },
        {
          "@type": "BlogPosting",
          "headline": "Innovations in warehouse management systems",
          "image": "https://images.unsplash.com/photo-1516321314538-43d7b3a49f4e",
          "datePublished": "2024-07-28",
          "description": "Modern warehouse systems boost productivity. Explore cutting-edge tools for inventory management. Optimize your warehouse operations.",
          "author": {
            "@type": "Person",
            "name": "Hugh Macleod"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        },
        {
          "@type": "BlogPosting",
          "headline": "Importance of visibility in supply chain",
          "image": "https://images.unsplash.com/photo-1600585154340-be6161a56a0c",
          "datePublished": "2024-07-26",
          "description": "Real-time visibility is critical for supply chain success. Learn tools and strategies to enhance transparency. Improve decision-making and efficiency.",
          "author": {
            "@type": "Person",
            "name": "Walton Smith"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Your Company Name",
            "logo": {
              "@type": "ImageObject",
              "url": "https://yourwebsite.com/logo.png"
            }
          },
          "url": "https://yourwebsite.com/demo-logistics-blog-single-modern.html"
        }
      ]
    }
  </script>
@endsection

@push('scripts')
    {!! $blogPostingScript ?? '' !!}

    <script>
    // jQuery yüklenene kadar bekle
    function waitForJQuery() {
        if (typeof jQuery !== 'undefined') {
            initializeBlogFeatures();
        } else {
            setTimeout(waitForJQuery, 100);
        }
    }

    function initializeBlogFeatures() {
        jQuery(document).ready(function($) {
            // Okuma süresi hesapla - anında
            setTimeout(function() {
                calculateReadingTime();
            }, 200);

            // İçindekiler (Table of Contents) oluştur - daha uzun bekle
            setTimeout(function() {
                generateTableOfContents();
            }, 2000);

        // Yorum formu gönderme
        $('#comment-form').on('submit', function(e) {
            e.preventDefault();
            submitComment($(this), null);
        });

        // Yanıt formu gönderme
        $(document).on('submit', '.reply-comment-form', function(e) {
            e.preventDefault();
            submitComment($(this), $(this).data('parent-id'));
        });

        // Yanıtla butonu
        $(document).on('click', '.reply-btn', function() {
            const commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).slideToggle();
        });

        // Yanıt iptal
        $(document).on('click', '.cancel-reply', function() {
            const commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).slideUp();
        });


            // Paylaşım sayacı
            $('.share-link').on('click', function() {
                const platform = $(this).data('platform');
                trackShare(platform);
            });
        });
    }

    function calculateReadingTime() {
        let attempts = 0;
        const maxAttempts = 10;

        function tryCalculateReadingTime() {
            attempts++;

            // Farklı selector'ları dene
            const contentSelectors = [
                '#blog-content .blog-content-wrapper',
                '#blog-content',
                '.blog-content-wrapper',
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

            // HTML etiketlerini temizle ve sadece metni al
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

            // Maksimum 60 dakika (çok uzun yazılar için)
            if (readingTime > 60) readingTime = 60;

            const readingTimeElement = document.getElementById('reading-time');
            if (readingTimeElement) {
                readingTimeElement.textContent = readingTime + ' dakika';
            }
        }

        // İlk denemeyi başlat
        tryCalculateReadingTime();
    }

    function generateTableOfContents() {
        // Birden fazla deneme yap
        let attempts = 0;
        const maxAttempts = 10;

        function tryGenerateTOC() {
            attempts++;

            // Önce tüm olası selector'ları dene
            const contentSelectors = [
                '#blog-content .blog-content-wrapper',
                '#blog-content',
                '.blog-content-wrapper',
                'article .blog-content-wrapper',
                '[itemprop="articleBody"]'
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
                    setTimeout(tryGenerateTOC, 500);
                } else {
                    showTOCError();
                }
                return;
            }

            // Tüm başlık türlerini dene
            const headingSelectors = [
                'h1, h2, h3, h4, h5, h6',
                'h2, h3, h4, h5, h6',
                'h3, h4, h5, h6'
            ];

            let headings = null;
            for (let selector of headingSelectors) {
                headings = content.querySelectorAll(selector);
                if (headings.length > 0) {
                    break;
                }
            }

            if (!headings || headings.length === 0) {
                if (attempts < maxAttempts) {
                    setTimeout(tryGenerateTOC, 500);
                } else {
                    showTOCError();
                }
                return;
            }

            let tocHtml = '';

            headings.forEach(function(heading, index) {
                const level = parseInt(heading.tagName.substring(1));
                const text = heading.textContent.trim();
                const id = 'heading-' + index;

                // Başlık metni boşsa atla
                if (!text || text.length === 0) {
                    return;
                }

                // ID ekle
                heading.id = id;

                // TOC listesine ekle - SEO uyumlu format
                tocHtml += `<li class="blog-detail-toc-item"><a href="#${id}" class="blog-detail-toc-link">${text}</a></li>`;
            });

            const tocContainer = document.getElementById('tableOfContents');
            if (tocContainer) {
                if (tocHtml.length > 0) {
                    tocContainer.innerHTML = tocHtml;

                    // Smooth scroll event listener'ları ekle
                    const tocLinks = tocContainer.querySelectorAll('.blog-detail-toc-link');
                    tocLinks.forEach(function(link) {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            const targetId = this.getAttribute('href');
                            const targetElement = document.querySelector(targetId);
                            if (targetElement) {
                                targetElement.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }
                        });
                    });
                } else {
                    showTOCError();
                }
            } else {
                showTOCError();
            }
        }

        function showTOCError() {
            const tocContainer = document.getElementById('tableOfContents');
            if (tocContainer) {
                tocContainer.innerHTML = '<p class="text-muted small">İçindekiler yüklenemedi</p>';
            }
            const tocElement = document.getElementById('sidebar-toc');
            if (tocElement) {
                tocElement.style.display = 'block'; // Hata mesajını göster
            }
        }

        // İlk denemeyi başlat
        tryGenerateTOC();
    }

    function submitComment(form, parentId) {
        if (typeof jQuery === 'undefined') {
            return;
        }

        const formData = new FormData(form[0]);
        if (parentId) {
            formData.append('parent_id', parentId);
        }

        const postId = jQuery('#comment-form').data('post-id');
        const url = `{{ url('blog') }}/${postId}/comments`;

        jQuery.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showMessage('success', 'Yorumunuz başarıyla gönderildi. Onaylandıktan sonra yayınlanacaktır.');
                    form[0].reset();

                    if (parentId) {
                        jQuery('#reply-form-' + parentId).slideUp();
                    }

                    // Sayfa yenilenmesin, sadece form temizlensin
                } else {
                    showMessage('error', response.message);
                }
            },
            error: function(xhr) {
                let message = 'Bir hata oluştu. Lütfen tekrar deneyin.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                showMessage('error', message);
            }
        });
    }

    function showMessage(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';

        $('#comment-message').html(`
            <div class="alert ${alertClass} alert-dismissible fade show">
                <i class="fas ${icon}"></i> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);

        setTimeout(function() {
            $('#comment-message').fadeOut();
        }, 5000);
    }

    function trackShare(platform) {
        if (typeof jQuery === 'undefined') {
            return;
        }

        const postId = jQuery('#comment-form').data('post-id');

        jQuery.ajax({
            url: `{{ url('blog') }}/${postId}/share`,
            type: 'POST',
            data: {
                platform: platform,
                _token: jQuery('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Paylaşım sayısını güncelle
                    const currentCount = parseInt(jQuery('#share-count').text()) || 0;
                    jQuery('#share-count').text(currentCount + 1);
                }
            },
            error: function() {
                // Hata durumunda da paylaşım sayısını artır (kullanıcı deneyimi için)
                const currentCount = parseInt(jQuery('#share-count').text()) || 0;
                jQuery('#share-count').text(currentCount + 1);
            }
        });
    }

    // jQuery yüklenene kadar bekle ve başlat
    waitForJQuery();

    // Alternatif: Sayfa tamamen yüklendiğinde de dene
    window.addEventListener('load', function() {
        setTimeout(function() {
            generateTableOfContents();
            calculateReadingTime();
        }, 1000);
    });

    // DOM tamamen hazır olduğunda da dene
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            generateTableOfContents();
            calculateReadingTime();
        }, 3000);
    });
    </script>

    <style>
    /* SEO Uyumlu İçindekiler Stilleri */
    .blog-detail-toc {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 400px;
        overflow-y: auto;
    }

    .blog-detail-toc-item {
        margin-bottom: 6px;
    }

    .blog-detail-toc-link {
        color: #495057;
        text-decoration: none;
        display: block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.9rem;
        line-height: 1.4;
        transition: all 0.3s ease;
    }

    .blog-detail-toc-link:hover {
        color: #007bff;
        background-color: rgba(0, 123, 255, 0.1);
    }

    /* Okuma Bilgileri Stilleri */
    .reading-info {
        font-size: 0.9rem;
    }

    .reading-info i {
        width: 16px;
    }

    .reading-time,
    .publish-date,
    .comment-count {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
    }

    /* Yorum Stilleri */
    .comment {
        display: flex;
        margin-bottom: 20px;
        padding: 20px;
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
    }

    .comment-avatar {
        margin-right: 15px;
        flex-shrink: 0;
    }

    .comment-avatar i {
        font-size: 2.5rem;
        color: #6c757d;
    }

    .comment-content {
        flex: 1;
    }

    .comment-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }

    .comment-author {
        font-weight: 600;
        color: #495057;
    }

    .comment-date {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .comment-rating {
        display: flex;
        gap: 2px;
    }

    .comment-text {
        color: #495057;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .comment-actions {
        margin-top: 10px;
    }

    .reply-comment {
        margin-left: 40px;
        background: #f8f9fa;
        border-left: 3px solid #007bff;
    }

    .comment-replies {
        border-top: 1px solid #e9ecef;
        padding-top: 15px;
    }


    .no-comments {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
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

    /* SEO Uyumlu Article Stilleri */
    .article-footer {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    /* Küçük butonlar */
    .btn-xs {
        padding: 0.125rem 0.25rem;
        font-size: 0.75rem;
        line-height: 1.25;
        border-radius: 0.125rem;
        min-width: auto;
        height: auto;
    }

    /* Hero başlık rengi */
    .hero-title {
        color: #fff !important;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    /* Hero padding */
    .newservice-hero {
        padding: 45px 0;
    }

    /* Blog İçerik Stilleri - Temiz ve Düzenli */
    #blog-content {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.8;
        color: #2c3e50;
        font-size: 16px;
    }

    #blog-content h1, #blog-content h2, #blog-content h3,
    #blog-content h4, #blog-content h5, #blog-content h6 {
        font-weight: 700;
        color: #1a202c;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    #blog-content h1:first-child,
    #blog-content h2:first-child,
    #blog-content h3:first-child,
    #blog-content h4:first-child,
    #blog-content h5:first-child,
    #blog-content h6:first-child {
        margin-top: 0;
    }

    #blog-content h1 {
        font-size: 2.25rem;
        border-bottom: 3px solid #007bff;
        padding-bottom: 0.5rem;
        margin-top: 0;
    }

    #blog-content h2 {
        font-size: 1.875rem;
        border-left: 4px solid #007bff;
        padding-left: 1rem;
    }

    #blog-content h3 {
        font-size: 1.5rem;
        color: #2d3748;
    }

    #blog-content h4 {
        font-size: 1.25rem;
        color: #4a5568;
    }

    #blog-content h5 {
        font-size: 1.125rem;
        color: #718096;
    }

    #blog-content h6 {
        font-size: 1rem;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    #blog-content p {
        margin-bottom: 1.5rem;
        text-align: justify;
    }

    #blog-content p:first-child {
        font-size: 1.125rem;
        color: #4a5568;
        font-weight: 400;
    }

    #blog-content a {
        color: #007bff;
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: all 0.3s ease;
    }

    #blog-content a:hover {
        border-bottom-color: #007bff;
        color: #0056b3;
    }

    #blog-content ul, #blog-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    #blog-content li {
        margin-bottom: 0.5rem;
        line-height: 1.7;
    }

    #blog-content blockquote {
        border-left: 4px solid #007bff;
        padding: 1rem 1.5rem;
        margin: 2rem 0;
        background: #f8f9fa;
        border-radius: 0 8px 8px 0;
        font-style: italic;
        color: #4a5568;
    }

    #blog-content blockquote p:last-child {
        margin-bottom: 0;
    }

    #blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 1.5rem 0;
    }

    #blog-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #blog-content th, #blog-content td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    #blog-content th {
        background: #f7fafc;
        font-weight: 600;
        color: #2d3748;
    }

    #blog-content code {
        background: #f1f5f9;
        color: #e53e3e;
        padding: 2px 6px;
        border-radius: 4px;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        font-size: 0.875em;
    }

    #blog-content pre {
        background: #1a202c;
        color: #e2e8f0;
        padding: 1.5rem;
        border-radius: 8px;
        overflow-x: auto;
        margin: 1.5rem 0;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        font-size: 0.875rem;
        line-height: 1.6;
    }

    #blog-content pre code {
        background: none;
        color: inherit;
        padding: 0;
    }

    #blog-content hr {
        border: none;
        height: 1px;
        background: linear-gradient(to right, transparent, #e2e8f0, transparent);
        margin: 1.5rem 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #blog-content {
            font-size: 15px;
        }

        #blog-content h1 {
            font-size: 1.875rem;
        }

        #blog-content h2 {
            font-size: 1.5rem;
        }

        #blog-content h3 {
            font-size: 1.25rem;
        }

        #blog-content ul, #blog-content ol {
            padding-left: 1.5rem;
        }

        #blog-content blockquote {
            margin: 1rem 0;
            padding: 0.75rem 1rem;
        }
    }
    </style>
@endpush
