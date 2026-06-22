# Google Yorumları Modülü - Kullanım Kılavuzu (v2)

## 🎉 Modül Başarıyla Güncellendi!

Google Yorumları modülü şimdi **WordPress eklentisi gibi** çalışıyor! Artık Google Places API ile işletmenizi bağlayıp otomatik olarak yorumları çekebilirsiniz. Ayrıca homepage builder sistemine entegre edildi.

---

## 📋 Yeni Özellikler

✅ Google Places API entegrasyonu  
✅ İşletme arama ve bağlama  
✅ Otomatik yorum çekme  
✅ Homepage Builder entegrasyonu  
✅ Widget sistemi kaldırıldı (homepage builder kullanılıyor)  
✅ Daha basit ve kullanıcı dostu arayüz  

---

## 🚀 Hızlı Başlangıç

### 1. Google Places API Anahtarı Alın

1. [Google Cloud Console](https://console.cloud.google.com/)'a gidin
2. Yeni bir proje oluşturun veya mevcut projeyi seçin
3. **"APIs & Services" > "Credentials"** menüsüne gidin
4. **"Create Credentials" > "API Key"** seçeneğini tıklayın
5. API anahtarınızı kopyalayın
6. **"APIs & Services" > "Library"** menüsünden **"Places API"** aktif edin

### 2. API Anahtarını Yapılandırın

1. Admin paneline giriş yapın
2. **"İçerik Yönetimi" > "Google Hesabı Bağla"** menüsüne gidin
3. API anahtarınızı yapıştırın
4. **"Test Et"** butonuna tıklayın
5. Geçerli ise otomatik olarak kaydedilecek

### 3. İşletmenizi Bulun ve Bağlayın

1. "İşletme Arama" bölümünde işletme adınızı veya adresinizi girin
2. **"Ara"** butonuna tıklayın
3. Sonuçlardan işletmenizi bulun
4. **"Bağlan"** butonuna tıklayın

### 4. Yorumları İçe Aktarın

1. İşletme bağlandıktan sonra **"Yorumları İçe Aktar"** bölümü görünür
2. **"Yorumları İçe Aktar"** butonuna tıklayın
3. Google'dan maksimum 5 yorum çekilecek (Google API sınırlaması)

### 5. Anasayfaya Ekleyin

1. **"Anasayfa > Anasayfa İçeriği"** menüsüne gidin
2. **"+ Blok Ekle"** butonuna tıklayın
3. **"Google Yorumları"** seçeneğini seçin
4. Ayarları yapılandırın:
   - Başlık ve alt başlık
   - Görünüm varyantı (4 farklı tasarım)
   - Gösterilecek yorum sayısı
   - Minimum puan filtresi
   - Arkaplan görseli/rengi
5. **"Kaydet"** butonuna tıklayın

---

## 📊 Admin Panel Menüleri

### 1. Google Yorumları

**Yol:** `İçerik Yönetimi > Google Yorumları`

Tüm yorumları listeler ve yönetmenizi sağlar:
- Yorumları görüntüleme/düzenleme/silme
- Manuel yorum ekleme
- Yorum puanını değiştirme
- Yorumları yayından kaldırma
- Öne çıkan yorumları işaretleme

### 2. Google Hesabı Bağla

**Yol:** `İçerik Yönetimi > Google Hesabı Bağla`

Google Places API yapılandırması:
- API anahtarı ekleme ve test etme
- İşletme arama
- İşletme bağlama
- Yorumları otomatik içe aktarma

---

## 🎨 Görünüm Varyantları

### Variant 1 - Modern Card
Современный kartlar halinde, avatar ve isimle birlikte

### Variant 2 - Classic Quote
Klasik alıntı stili, büyük tırnak işaretiyle

### Variant 3 - Minimal
Minimalist ve temiz tasarım

### Variant 4 - Slider
Kaydırmalı (slider) görünüm, otomatik oynatma ile

---

## ⚙️ .env Yapılandırması

`.env` dosyanıza şu satırları ekleyin:

```env
# Google Places API
GOOGLE_PLACES_API_KEY=your_api_key_here
GOOGLE_PLACE_ID=                    # Otomatik doldurulacak
GOOGLE_REVIEW_AUTO_SYNC=false      # Otomatik senkronizasyon (yakında)
```

---

## 💡 Önemli Notlar

### Google API Sınırlamaları

⚠️ **Google Places API, işletme başına maksimum 5 yorum döndürür**

Bu Google'ın API sınırlamasıdır. Tüm yorumlarınızı göstermek için:
1. API'den gelen 5 yorumu içe aktarın
2. Diğer yorumları manuel olarak ekleyin (`Google Yorumları > Oluştur`)

### Manuel Yorum Ekleme

Manuel yorum eklerken:
- Gerçek müşteri bilgilerini kullanın
- Yorum tarihini doğru girin
- Avatar görseli yükleyin veya URL ekleyin
- "Öne Çıkan" özelliğini kullanarak önemli yorumları işaretleyin

### Performans

- Yorumlar cache'lenir (1 saat)
- Cache'i temizlemek için: `php artisan cache:clear`
- Homepage builder kullanıldığı için sayfa yüklemeleri hızlıdır

---

## 📱 Frontend Kullanımı

### Homepage Builder

Yorumlar artık otomatik olarak anasayfanızda gösterilir. Sadece homepage builder'dan ekleyin.

### Manuel Ekleme (Blade Template)

Eğer başka bir sayfada göstermek isterseniz:

```blade
<x-google-reviews-section :data="[
    'section_title' => 'Müşteri Yorumları',
    'section_subtitle' => 'Değerli müşterilerimizin görüşleri',
    'view_variant' => 'variant_1',
    'limit' => 10,
    'min_rating' => 4,
]" />
```

### CSS ve JS

Layout dosyanıza ekleyin:

```blade
<!-- Head -->
<link rel="stylesheet" href="{{ asset('themes/awacms/default/public/css/google-review.css') }}">

<!-- Body sonuna -->
<script src="{{ asset('themes/awacms/default/public/js/google-review.js') }}"></script>
```

---

## 🔧 Sorun Giderme

### "API anahtarı geçersiz" Hatası

1. API anahtarınızın doğru olduğundan emin olun
2. Google Cloud Console'da Places API'nin aktif olduğunu kontrol edin
3. API kotanızı kontrol edin (ücretsiz plan: günde 5000 istek)

### "İşletme bulunamadı" Hatası

1. İşletme adını tam olarak yazın
2. Adres bilgisini de ekleyin (örn: "AWA Yazılım Istanbul")
3. Google Maps'te işletmenizin kayıtlı olduğundan emin olun

### Yorumlar Görünmüyor

1. Yorumların "Yayında" olduğunu kontrol edin
2. Minimum puan filtresini kontrol edin
3. Cache'i temizleyin: `php artisan cache:clear`
4. CSS dosyasının yüklendiğinden emin olun

### Homepage Builder'da Görünmüyor

1. Tarayıcı cache'ini temizleyin (Ctrl+Shift+Delete)
2. `php artisan optimize:clear` komutunu çalıştırın
3. Admin panelinden çıkış yapıp tekrar girin

---

## 📈 İpuçları

### Daha Fazla Yorum Almak İçin

1. Müşterilerinize e-posta gönderin
2. SMS ile yorum linki paylaşın
3. İşletme kartlarınıza QR kod ekleyin
4. Sosyal medyada paylaşın

### SEO İçin

1. Yorumları düzenli güncelleyin
2. Gerçek tarih kullanın
3. Uzun ve detaylı yorumlar ekleyin
4. 4-5 yıldızlı yorumları öne çıkarın

### Tasarım

1. Sitenize uygun varyantı seçin
2. Arkaplan rengi/görseli kullanarak özelleştirin
3. Minimum 6-10 yorum gösterin
4. Slider için öne çıkan yorumları kullanın

---

## 🆘 Destek

Sorun yaşarsanız:

1. Laravel loglarını kontrol edin: `storage/logs/laravel.log`
2. Tarayıcı console'unu kontrol edin
3. API anahtarınızın geçerli olduğundan emin olun
4. Google Places API'nin aktif olduğunu kontrol edin

---

## 🎯 Sonraki Adımlar

- ✅ API yapılandırması
- ✅ İşletme bağlama
- ✅ Yorumları içe aktarma
- ✅ Anasayfaya ekleme
- ⏳ Otomatik senkronizasyon (gelecek güncellemede)
- ⏳ Çoklu işletme desteği (gelecek güncellemede)

---

**Güncelleme:** {{ date('d.m.Y H:i') }}  
**Versiyon:** 2.0.0  
**Uyumluluk:** Laravel 10.x, Filament 3.x

---

## 🎉 Tebrikler!

Google Yorumları modülü WordPress eklentisi gibi çalışmaya hazır! İyi çalışmalar! 🚀

