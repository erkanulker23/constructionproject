# Google Yorumları Modülü - Kullanım Kılavuzu

## 🎉 Modül Başarıyla Kuruldu!

Google Yorumları modülü başarıyla sisteminize entegre edildi. Bu modül ile Google yorumlarınızı admin panelinde yönetebilir ve frontend'de farklı widget tipleri ile gösterebilirsiniz.

---

## 📋 Kurulum Tamamlandı

✅ Modül klasörü oluşturuldu  
✅ Veritabanı tabloları oluşturuldu  
✅ Filament Resources hazırlandı  
✅ Frontend View'ları oluşturuldu  
✅ CSS ve JavaScript dosyaları eklendi  
✅ Modül aktif edildi  

---

## 🎯 Özellikler

### Admin Panel

- **Google Yorumları Yönetimi**
  - Yorum ekleme/düzenleme/silme
  - Yorum puanlama (1-5 yıldız)
  - Yorumcu bilgileri (isim, e-posta, avatar)
  - Yorum tarihi
  - Yayın durumu kontrolü
  - Öne çıkan yorumlar
  - Anonim yorum seçeneği
  - Sıralama desteği

- **Widget Yönetimi**
  - 4 farklı layout tipi (Grid, List, Slider, Masonry)
  - Her layout için 3-4 stil varyantı
  - Detaylı widget ayarları
  - Filtreleme seçenekleri
  - Slider için otomatik oynatma
  - Responsive kolon sayısı ayarı

### Frontend

- **4 Farklı Layout**
  - Grid Layout (Izgara düzeni)
  - List Layout (Liste düzeni)
  - Slider Layout (Kaydırıcı)
  - Masonry Layout (Tuğla duvar düzeni)

- **Modern & Minimalist Tasarım**
  - Responsive (mobil uyumlu)
  - Dark mode desteği
  - Smooth animasyonlar
  - Touch/swipe desteği (slider için)

---

## 🚀 Kullanım

### 1. Admin Panelinde Yorum Ekleme

1. Admin paneline giriş yapın
2. Sol menüden **"Google Yorumları"** > **"Google Yorumları"** seçin
3. Sağ üstteki **"Oluştur"** butonuna tıklayın
4. Yorum bilgilerini girin:
   - Yorumcu Adı
   - E-posta (opsiyonel)
   - Avatar URL veya dosya yükleyin
   - Puan seçin (1-5 yıldız)
   - Yorum metnini yazın
   - Yorum tarihini seçin
   - Yayınlansın mı? (açık/kapalı)
   - Öne çıkan mı? (açık/kapalı)
   - Anonim mi? (açık/kapalı)
5. **"Oluştur"** butonuna tıklayın

### 2. Widget Oluşturma

1. Sol menüden **"Google Yorumları"** > **"Yorum Widget'ları"** seçin
2. **"Oluştur"** butonuna tıklayın
3. Widget ayarlarını yapın:
   - **Widget Adı:** Tanımlayıcı bir isim
   - **Layout Tipi:** Grid, List, Slider veya Masonry
   - **Stil Varyantı:** Variant 1, 2, 3 veya 4
   - **Gösterilecek Yorum Sayısı:** 1-50 arası
   - **Kolon Sayısı:** Grid ve Masonry için
   - **Minimum Puan:** Sadece belirlediğiniz puan ve üzeri yorumları göster
   - **Görünüm Seçenekleri:** Puanı göster, tarihi göster, avatar göster, ismi göster
   - **Filtreleme:** Sadece öne çıkanları göster, puana göre filtrele
   - **Slider Ayarları:** Otomatik oynat, hız, navigasyon, sayfalama
4. **"Oluştur"** butonuna tıklayın

### 3. Frontend'de Widget Gösterme

#### Blade Template'de Kullanım

**Yöntem 1: Blade Component (Önerilen)**

```blade
<x-googlereview-widget :widget-id="1" />
```

**Yöntem 2: Route Üzerinden**

Widget'ı ayrı bir sayfada göstermek için:

```
https://siteniz.com/google-reviews/widget/1
```

**Yöntem 3: AJAX ile Yükleme**

```html
<div id="google-reviews-container" class="google-review-widget"></div>

<script>
// Widget ID'sini değiştirin
GoogleReviewWidgetLoader.load(1, document.getElementById('google-reviews-container'));
</script>
```

### 4. CSS ve JavaScript Dahil Etme

Layout dosyanızda (örn: `app.blade.php`) şu dosyaları ekleyin:

```blade
<!-- Head kısmına -->
<link rel="stylesheet" href="{{ asset('css/google-review.css') }}">

<!-- Body sonuna -->
<script src="{{ asset('js/google-review.js') }}"></script>
```

---

## 📁 Dosya Yapısı

```
Modules/GoogleReview/
├── Config/
│   └── config.php
├── Database/
│   ├── Factories/
│   ├── Migrations/
│   └── Seeders/
├── DTOs/
│   ├── GoogleReviewData.php
│   └── GoogleReviewWidgetData.php
├── Entities/
│   ├── GoogleReview.php
│   └── GoogleReviewWidget.php
├── Filament/
│   └── Resources/
│       ├── GoogleReviewResource.php
│       └── GoogleReviewWidgetResource.php
├── Http/
│   └── Controllers/
│       └── GoogleReviewController.php
├── Providers/
│   ├── GoogleReviewServiceProvider.php
│   ├── GoogleReviewPlugin.php
│   └── RouteServiceProvider.php
├── Resources/
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   ├── lang/
│   └── views/
│       └── frontend/
│           └── widgets/
└── Routes/
    ├── api.php
    └── web.php
```

---

## 🎨 Widget Varyantları

### Grid Layout

- **Variant 1:** Modern kart tasarımı
- **Variant 2:** Klasik alıntı stili
- **Variant 3:** Minimal ve temiz

### List Layout

- **Variant 1:** Geniş liste görünümü

### Slider Layout

- **Variant 1:** Merkezi, büyük yorumlar

### Masonry Layout

- **Variant 1:** Pinterest tarzı düzen

---

## ⚙️ Yapılandırma

Modül ayarlarını `Modules/GoogleReview/Config/config.php` dosyasından değiştirebilirsiniz:

```php
'default_widget_settings' => [
    'reviews_per_page' => 10,
    'show_rating' => true,
    'show_date' => true,
    'show_avatar' => true,
    'show_reviewer_name' => true,
    'min_rating' => 1,
    'layout' => 'grid',
],
```

---

## 🔧 Gelişmiş Kullanım

### Özel Blade View Oluşturma

Kendi özel widget view'ınızı oluşturmak için:

```blade
<!-- Modules/GoogleReview/Resources/views/frontend/widgets/grid/variant_4.blade.php -->
<div class="google-review-widget grid-layout variant-4">
    <!-- Özel tasarımınız -->
</div>
```

### Programatik Kullanım

```php
use Modules\GoogleReview\Entities\GoogleReview;
use Modules\GoogleReview\Entities\GoogleReviewWidget;

// Tüm yayında olan yorumları al
$reviews = GoogleReview::published()->get();

// 5 yıldızlı yorumları al
$fiveStarReviews = GoogleReview::published()->minRating(5)->get();

// Widget ve yorumlarını al
$widget = GoogleReviewWidget::active()->first();
$reviews = $widget->getReviews();
```

---

## 📊 Demo Veri Oluşturma (Opsiyonel)

Demo yorumlar ve widget'lar oluşturmak için:

```bash
php artisan module:seed GoogleReview
```

Bu komut:
- 20 adet rastgele yorum
- 5 adet öne çıkan yorum
- 2 adet hazır widget oluşturur

---

## 🎯 Örnek Kullanım Senaryoları

### Senaryo 1: Ana Sayfada Grid Widget

```blade
<!-- Ana sayfa -->
<section class="reviews-section">
    <div class="container">
        <h2>Müşterilerimiz Ne Diyor?</h2>
        <x-googlereview-widget :widget-id="1" />
    </div>
</section>
```

### Senaryo 2: Hakkımızda Sayfasında Slider

```blade
<!-- Hakkımızda sayfası -->
<section class="testimonials">
    <x-googlereview-widget :widget-id="2" />
</section>
```

### Senaryo 3: Özel Sayfa

```blade
<!-- Yorumlar sayfası -->
@extends('layouts.app')

@section('content')
    <div class="reviews-page">
        <h1>Müşteri Yorumları</h1>
        <x-googlereview-widget :widget-id="3" />
    </div>
@endsection
```

---

## 📱 Responsive Tasarım

Widget'lar otomatik olarak responsive'dir:

- **Desktop:** 3 kolon (grid/masonry)
- **Tablet:** 2 kolon
- **Mobile:** 1 kolon

Kolon sayısını widget ayarlarından değiştirebilirsiniz.

---

## 🎨 Stil Özelleştirme

CSS'i özelleştirmek için `public/css/google-review.css` dosyasını düzenleyin veya kendi CSS'inizi ekleyin:

```css
/* Özel renkler */
.google-review-widget .review-card {
    background: #your-color;
    border-color: #your-color;
}

/* Özel yıldız rengi */
.review-rating .fas.fa-star {
    color: #your-star-color;
}
```

---

## 🔍 SEO İpuçları

1. **Yorum Tarihleri:** Her yoruma tarih ekleyin (Google için önemli)
2. **Gerçek İsimler:** Mümkünse gerçek müşteri isimlerini kullanın
3. **Detaylı Yorumlar:** Uzun ve detaylı yorumlar SEO için daha iyidir
4. **Schema Markup:** İleride schema.org işaretlemesi eklenebilir

---

## 🐛 Sorun Giderme

### Widget Görünmüyor

1. CSS ve JS dosyalarının yüklendiğinden emin olun
2. Widget'ın "Aktif" olduğunu kontrol edin
3. Yayında yorumlar olduğundan emin olun
4. Tarayıcı console'unda hata var mı kontrol edin

### Slider Çalışmıyor

1. JavaScript dosyasının yüklendiğinden emin olun
2. jQuery yüklü değilse vanilla JS kullanıldığından emin olun
3. Tarayıcı console'unda hata kontrol edin

### Stil Bozuk Görünüyor

1. CSS dosyasının doğru yüklendiğini kontrol edin
2. Tema CSS'i ile çakışma olabilir, !important kullanın
3. Tarayıcı cache'ini temizleyin

---

## 📞 Destek

Herhangi bir sorun yaşarsanız:

1. Tarayıcı console'unu kontrol edin
2. Laravel log dosyalarını kontrol edin (`storage/logs/laravel.log`)
3. Modül README.md dosyasını okuyun

---

## 🎉 Tebrikler!

Google Yorumları modülü başarıyla kuruldu ve kullanıma hazır. İyi çalışmalar!

---

**Son Güncelleme:** {{ date('d.m.Y H:i') }}  
**Versiyon:** 1.0.0  
**Uyumluluk:** Laravel 10.x, Filament 3.x

