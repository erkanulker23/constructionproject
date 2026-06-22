@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Bizimle iletişime geçin. Sorularınız, önerileriniz ve talepleriniz için 7/24 hizmetinizdeyiz.">
    <meta name="keywords" content="iletişim, contact, adres, telefon, e-posta">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="İletişim">
    <meta property="og:description" content="Bizimle iletişime geçin. 7/24 hizmetinizdeyiz.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')

<!-- Hero Section -->
<section class="service-hero-new">
    <picture>
        <source media="(max-width: 768px)" srcset="{{ $heroImageMobile }}">
        <img src="{{ $heroImage }}"
        alt="İletişim görseli"
        loading="lazy"
        class="service-hero-bg">
    </picture>
    <div class="container">
      <div class="service-hero-content">
        <div class="service-hero-text">
          <h1 class="service-title">Bizimle İletişime Geçin</h1>
          <p style="color: #fff; font-size: 1.1rem; margin-top: 10px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);">Sorularınızı yanıtlamak veya destek sağlamak için hemen bize ulaşın!</p>
        </div>
      </div>
    </div>
  </section>



  <section class="newcontact-main contact-main-mobile">
    <div class="container">
      <div class="row">
        <!-- Contact Info and Map -->
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="newcontact-info-container">
            <div class="newcontact-info">
              <h2 class="mb-4" style="font-size: 1.5rem; font-weight: 600;">İletişim Bilgilerimiz</h2>
              <div class="newcontact-info-item">
                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                <div>
                  <strong>Adres:</strong>
                  <p>{{ $generalSettings->address }}</p>
                </div>
              </div>
              <div class="newcontact-info-item">
                <i class="fas fa-envelope" aria-hidden="true"></i>
                <div>
                  <strong>E-posta:</strong>
                  <p><a href="mailto:{{ $generalSettings->email }}" aria-label="E-posta gönder">{{ $generalSettings->email }}</a></p>
                </div>
              </div>
              <div class="newcontact-info-item">
                <i class="fas fa-phone" aria-hidden="true"></i>
                <div>
                  <strong>Telefon:</strong>
                  <p><a href="tel:{{ $generalSettings->phone }}" aria-label="Telefon ile ara">{{ $generalSettings->phone }}</a></p>
                </div>
              </div>
              <div class="newcontact-info-item">
                <i class="fab fa-whatsapp" aria-hidden="true"></i>
                <div>
                  <strong>WhatsApp:</strong>
                  <p><a href="https://wa.me/{{ $generalSettings->whatsapp }}" aria-label="WhatsApp ile mesaj gönder">{{ $generalSettings->whatsapp }}</a></p>
                </div>
              </div>
              @if(isset($generalSettings->address_google_maps_url) && $generalSettings->address_google_maps_url)
              <div class="newcontact-info-item">
                <i class="fas fa-map-marked-alt" aria-hidden="true"></i>
                <div>
                  <strong>Haritada Görüntüle:</strong>
                  <p><a href="{{ $generalSettings->address_google_maps_url }}" target="_blank" rel="noopener noreferrer" aria-label="Google Maps'te konumumuzu görüntüle">Google Maps'te Aç</a></p>
                </div>
              </div>
              @endif
            </div>
            <div class="newcontact-map">
              @if(isset($generalSettings->address_google_maps_embed) && $generalSettings->address_google_maps_embed)
                {!! $generalSettings->address_google_maps_embed !!}
              @else
                @php
                  $latitude = $generalSettings->address_latitude ?? '41.008237979299';
                  $longitude = $generalSettings->address_longitude ?? '28.978358315209';
                  $mapEmbedUrl = "https://maps.google.com/maps?q={$latitude},{$longitude}&hl=tr&z=15&output=embed";
                @endphp
                <iframe src="{{ $mapEmbedUrl }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Konum haritası"></iframe>
              @endif
            </div>
          </div>
        </div>
        <!-- Contact Form -->
        <div class="col-lg-6">
          <div class="newcontact-form-container">
            <div class="newcontact-form">
              <p>Yardıma mı ihtiyacınız var? Aşağıdaki formu doldurarak bize ulaşabilirsiniz.</p>
              @if(session('flash_notification'))
                        <div class="alert alert-{{ session('flash_notification.level') }} alert-dismissible fade show" role="alert">
                            <strong>{{ session('flash_notification.title') }}</strong><br>
                            {{ session('flash_notification.message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
                        </div>
                    @endif
            <form action="{{ route('contact.store') }}" method="post" class="contact-form-style-03">
            @honeypot
            @csrf
                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}"  id="name" placeholder="" required>
                  <label for="name" class="form-label">Adınız Soyadınız</label>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" id="email"  name="email" value="{{ old('email') }}" placeholder=" " required>
                  <label for="email" class="form-label">E-posta Adresiniz</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder=" " required>
                  <label for="phone" class="form-label">Telefon Numaranız</label>
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="message"  name="message" rows="4"  placeholder=" " required>{{ old('message') }}</textarea>
                  <label for="message" class="form-label" >Mesajınız</label>

                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-submit">Mesaj Gönder</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@if(count($branches) > 0)
<section class="pt-3 sm-pt-50px branches-section-mobile">
    <div class="container">
        <h2 class="text-dark-gray fs-25px fw-700">Şubelerimiz</h2>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-8 col-md-10">
                <div class="row row-cols-1"
                data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <!-- start services box item -->
                    @foreach($branches as $branch)
                    <div class="col-lg-4 col-md-6 col-sm-12 services-box-style-02 mb-30px">
                        <div class="bg-white box-shadow-extra-large p-40px xl-p-30px">
                            <div class="services-box-content last-paragraph-no-margin">
                                <span class="d-block text-dark-gray primary-font fw-700 fs-19 mb-10px">{{ $branch->name }}</span>
                                <p style="margin: 0px"><i class="feather icon-feather-map-pin align-middle icon-small p-10px text-base-color"></i>{{ $branch->address }}</p>
                                <p style="margin: 0px"><i class="ti-map-alt align-middle icon-small p-10px text-base-color"></i>{{ $branch->country }} / {{ $branch->city }} </p>
                                <i class="ti-mobile align-middle icon-small p-10px text-base-color"></i>{{ $branch->whatsapp }}<br>
                                <i class="feather icon-feather-phone-call align-middle icon-small p-10px text-base-color"></i> {{ $branch->fax }} <br>
                                <i class="feather icon-feather-send align-middle icon-small p-10px  text-base-color"></i> {{ $branch->email }}
                            </div>
                            <a href="{{ $branch->link }}" class="fs-16 lh-20 primary-font fw-500
                                text-dark-gray text-decoration-line-bottom d-inline-block mb-25px">Haritada Görüntüle</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
    @include('frontend.components.schema.organization')
@endpush
