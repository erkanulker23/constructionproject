# ✅ Google Yorumları Modülü - Kullanım Kılavuzu

## 🎯 Sistem Şimdi Nasıl Çalışıyor?

### ✨ Özellikler

✅ **Birden Fazla İşletme:** İstediğiniz kadar işletme ekleyebilirsiniz  
✅ **Gerçek Veriler:** Google Places API ile gerçek yorumlar çekilir  
✅ **Otomatik Çekme:** URL yapıştırınca işletme bilgileri otomatik doldurulur  
✅ **Homepage Builder:** Her işletme için ayrı blok ekleyebilirsiniz  
✅ **Kolay Yönetim:** Tek sayfadan tüm işletmeler ve yorumlar  

---

## 🚀 Hızlı Başlangıç (3 Adım)

### 1️⃣ API Key Alın (Zorunlu)

```
1. https://console.cloud.google.com/ adresine gidin
2. Yeni proje oluşturun veya mevcut projeyi seçin
3. "APIs & Services" > "Library" > "Places API" aktif edin
4. "Credentials" > "Create API Key" 
5. API anahtarını kopyalayın
6. .env dosyanıza ekleyin:
   GOOGLE_PLACES_API_KEY=your_api_key_here
```

### 2️⃣ İşletme Ekleyin

```
Admin Panel → İçerik Yönetimi → Google Yorumları
→ [Yeni İşletme Ekle] butonuna tıklayın
→ Google Maps URL'sini yapıştırın
→ İşletme adı otomatik çıkarılır
→ [Oluştur] tıklayın
→ Yorumlar otomatik çekilir! (API key varsa)
```

### 3️⃣ Anasayfaya Ekleyin

```
Anasayfa → Anasayfa İçeriği → + Blok Ekle
→ Google Yorumları seç
→ İşletme seçin (veya boş bırakın = tüm işletmeler)
→ Tasarım ve ayarları yapın
→ Kaydet
```

---

## 📍 Admin Panel Menüsü

Sadece **1 menü** var:

```
📁 İçerik Yönetimi
  ⭐ Google Yorumları  ← Buradan her şeyi yaparsınız
```

---

## 📋 Google Yorumları Sayfası

```
┌──────────────────────────────────────────────┐
│ Google Yorumları                             │
├──────────────────────────────────────────────┤
│ [+ Yeni İşletme Ekle]                        │
│                                              │
│ İŞLETME LİSTESİ                             │
│ ─────────────────────────────────────────── │
│ İşletme Adı         | Puan | Yorumlar | Aksiyon│
│ ─────────────────────────────────────────── │
│ Rota Nakliyat       | ⭐ 4.5| 12      | [Yorumları Çek]│
│ AWA Yazılım         | ⭐ 5.0| 8       | [Yorumları Çek]│
│                                              │
│ ─────────────────────────────────────────── │
│ Her işletme için:                           │
│ • Düzenle                                    │
│ • Yorumları Çek (Google'dan)                │
│ • Sil                                        │
└──────────────────────────────────────────────┘
```

---

## 🏢 İşletme Ekleme Süreci

### Yeni İşletme Formunda:

```
┌──────────────────────────────────────────────┐
│ İşletme Bilgileri                            │
├──────────────────────────────────────────────┤
│                                              │
│ Google Maps URL:                             │
│ ┌──────────────────────────────────────────┐│
│ │ https://www.google.com/maps/place/...   ││
│ └──────────────────────────────────────────┘│
│ 🔗 Linki yapıştırdığınızda işletme adı      │
│    otomatik doldurulur!                      │
│                                              │
│ İşletme Adı: (otomatik)                     │
│ ┌──────────────────────────────────────────┐│
│ │ Rota Nakliyat & Depolama                ││
│ └──────────────────────────────────────────┘│
│                                              │
│ Place ID: (API ile otomatik)                │
│ Adres: (API ile otomatik)                   │
│                                              │
│ ☑ Aktif mi?                                 │
│                                              │
│ [Oluştur]                                   │
└──────────────────────────────────────────────┘

Oluştur'a basınca:
✅ İşletme kaydedilir
✅ API key varsa otomatik yorumlar çekilir
✅ İşletme istatistikleri güncellenir
```

---

## 🔄 Yorumları Çekme

### Otomatik (İşletme oluştururken):
- İşletme eklerken API key varsa yorumlar otomatik çekilir

### Manuel (Sonradan):
```
İşletme listesinde:
→ İşletme satırında [Yorumları Çek] butonuna tıklayın
→ Google'dan en fazla 5 yorum çekilir
→ Yorumlar tabloya eklenir
```

### Toplu İşlem:
```
→ Birden fazla işletme seçin
→ Toplu Aksiyonlar → [Tümünden Yorumları Çek]
→ Tüm işletmelerin yorumları çekilir
```

---

## 🏠 Homepage Builder Kullanımı

```
Anasayfa → Anasayfa İçeriği → + Blok Ekle
→ Google Yorumları

Ayarlar:
┌──────────────────────────────────────────────┐
│ İşletme Seç: [Seçiniz ▼]                    │
│   • Tüm İşletmeler (boş bırak)               │
│   • Rota Nakliyat & Depolama                │
│   • AWA Yazılım                              │
│                                              │
│ Başlık: Müşteri Yorumları                   │
│ Alt Başlık: Değerli müşterilerimizin görüşleri│
│                                              │
│ Görünüm: [Variant 1 ▼]                      │
│   • Variant 1 - Modern Kartlar              │
│   • Variant 2 - Klasik Quote                │
│   • Variant 3 - Minimal                     │
│   • Variant 4 - Slider                      │
│                                              │
│ Yorum Sayısı: 10                            │
│ Minimum Puan: 4 Yıldız ve Üzeri            │
│                                              │
│ Arkaplan Görseli: [Yükle]                   │
│ Arkaplan Rengi: [#fff]                      │
│                                              │
│ [Kaydet]                                     │
└──────────────────────────────────────────────┘
```

---

## 📊 Çekilen Veriler

### Google Places API'den Gelen Bilgiler:

**İşletme:**
- ✅ İşletme adı
- ✅ Tam adres
- ✅ Telefon numarası
- ✅ Website
- ✅ Ortalama puan (0-5)
- ✅ Toplam yorum sayısı

**Yorumlar (Maksimum 5):**
- ✅ Yorumcu adı
- ✅ Yorumcu avatarı
- ✅ Puan (1-5 yıldız)
- ✅ Yorum metni
- ✅ Yorum tarihi
- ✅ Dil bilgisi

---

## ⚡ Örnek Kullanım

### Örnek 1: Tek İşletme

```
1. İşletme Ekle:
   URL: https://www.google.com/maps/place/Rota+Nakliyat...
   → Otomatik: "Rota Nakliyat & Depolama" çıkarılır
   → Oluştur
   → 5 yorum otomatik çekilir

2. Anasayfaya Ekle:
   → Google Yorumları bloğu ekle
   → İşletme: "Rota Nakliyat & Depolama"
   → Görünüm: Variant 1
   → Kaydet

3. Frontend'de Görün:
   → "Rota Nakliyat & Depolama" yorumları gösterilir
```

### Örnek 2: Birden Fazla İşletme

```
1. İşletme 1: Rota Nakliyat → 5 yorum
2. İşletme 2: AWA Yazılım → 5 yorum
3. İşletme 3: XYZ Şirket → 5 yorum

Anasayfada:
→ Blok 1: Sadece "Rota Nakliyat" yorumları
→ Blok 2: Tüm işletmelerin yorumları karışık
→ Blok 3: Sadece "AWA Yazılım" yorumları
```

---

## 🎨 4 Farklı Tasarım

**Variant 1 - Modern Kartlar:**
- Grid düzen (3 kolon)
- Avatar + İsim + Tarih üstte
- Yıldızlar ortada
- Yorum altında

**Variant 2 - Klasik Quote:**
- Tırnak işareti
- Merkezi yıldızlar
- Yorum ortada
- Avatar + İsim altta

**Variant 3 - Minimal:**
- Soldaki mavi çizgi
- Yıldızlar üstte
- Yorum ortada
- Avatar + İsim + Tarih altta (tek satır)

**Variant 4 - Slider:**
- Otomatik kayan
- Büyük görünüm
- Merkezi hizalama
- Navigasyon okları

---

## ⚙️ .env Yapılandırması

`.env` dosyanıza ekleyin:

```env
# Google Places API
GOOGLE_PLACES_API_KEY=AIzaSy...  # Sizin API key'iniz
```

**API Key olmadan:**
- ✅ İşletme ekleyebilirsiniz (URL'den isim çıkar)
- ❌ Yorumları çekemezsiniz
- ✅ Manuel yorum ekleyebilirsiniz (gelecek güncelleme)

**API Key ile:**
- ✅ İşletme bilgileri otomatik doldurulur
- ✅ Yorumlar otomatik çekilir
- ✅ Adres, telefon, website bilgileri gelir
- ✅ Ortalama puan ve yorum sayısı güncellenir

---

## 📱 Gerçek Veriler Örneği

### URL Yapıştırdığınızda:

```
URL: https://www.google.com/maps/place/Rota+Nakliyat+%26+Depolama/@40.9562253,29.1506936...

Otomatik Çıkarılır:
├─ İşletme Adı: "Rota Nakliyat & Depolama"
├─ Koordinatlar: 40.9562253, 29.1506936
└─ Bu bilgilerle API'den detaylar çekilir
```

### API'den Gelen Veriler:

```
İşletme Bilgileri:
├─ Adres: "Sultançiftliği Mah. Örnek Sok. No:1 Pendik/İstanbul"
├─ Telefon: "+90 216 XXX XX XX"
├─ Website: "https://rotanakliyat.com"
├─ Ortalama Puan: 4.5 / 5
└─ Toplam Yorum: 127

Yorumlar (Max 5):
├─ Ahmet Y. - ⭐⭐⭐⭐⭐ - "Çok profesyonel hizmet..."
├─ Mehmet K. - ⭐⭐⭐⭐⭐ - "Harika ekip..."
├─ Ayşe M. - ⭐⭐⭐⭐ - "Memnun kaldım..."
├─ Fatma S. - ⭐⭐⭐⭐⭐ - "Kesinlikle tavsiye ederim..."
└─ Ali D. - ⭐⭐⭐⭐⭐ - "Güvenilir firma..."
```

---

## 🔧 Sorun Giderme

### "API anahtarı geçersiz" Hatası

✅ **Çözüm:**
1. `.env` dosyasını açın
2. `GOOGLE_PLACES_API_KEY=` satırını bulun
3. API anahtarınızı ekleyin
4. `php artisan config:clear` çalıştırın

### "Place ID bulunamadı" Hatası

✅ **Çözüm:**
1. Google Maps'te işletmenizin var olduğundan emin olun
2. Tam Google Maps linkini yapıştırın
3. İşletme adının URL'de doğru görüntülendiğini kontrol edin

### Yorumlar Gösterilmiyor

✅ **Çözüm:**
1. İşletmenin "Aktif" olduğunu kontrol edin
2. Yorumların "Yayında" olduğunu kontrol edin
3. Minimum puan filtresini kontrol edin
4. Cache temizleyin: `php artisan cache:clear`

---

## 💡 İpuçları

### Daha İyi Sonuçlar İçin:

1. **Tam Link Kullanın:** Kısa link değil, paylaş butonundan aldığınız tam linki kullanın
2. **Düzenli Çekin:** Yeni yorumlar için haftada bir "Yorumları Çek" yapın
3. **Cache Temizleyin:** Yorumlar 1 saat cache'lenir, yeni çekmek için cache temizleyin
4. **Öne Çıkanları Seçin:** Homepage builder'da minimum 4 veya 5 yıldız filtreleyin

### Performans:

- ✅ Yorumlar 1 saat cache'lenir
- ✅ API limiti: Günde 5000 istek (yeterli)
- ✅ İşletme başına maksimum 5 yorum (Google sınırlaması)

---

## 📂 Dosya Yapısı

```
Modules/GoogleReview/
├── Entities/
│   ├── GoogleBusiness.php        ← İşletme modeli
│   ├── GoogleReview.php          ← Yorum modeli
│   └── GoogleReviewWidget.php
├── Filament/
│   └── Resources/
│       └── GoogleBusinessResource.php  ← Ana yönetim sayfası
├── Services/
│   └── GooglePlacesService.php   ← Google API servisi
└── Database/
    └── Migrations/
        ├── ...create_google_businesses_table
        ├── ...create_google_reviews_table
        └── ...add_google_business_id...
```

---

## 🎯 Kullanım Senaryoları

### Senaryo 1: Tek İşletme Sahibi

```
1. Tek işletmenizi ekleyin
2. Yorumları çekin
3. Anasayfaya 1 Google Yorumları bloğu ekleyin
4. Variant 2 veya 4'ü kullanın (daha büyük gösterim)
```

### Senaryo 2: Çoklu Şube

```
1. Her şubeyi ayrı işletme olarak ekleyin
   • İstanbul Şubesi
   • Ankara Şubesi
   • İzmir Şubesi

2. Her şubeden yorumları çekin

3. Anasayfaya ekleyin:
   • Blok 1: Tüm şubelerin yorumları (business_id boş)
   • Blok 2: Sadece İstanbul şubesi (business_id = 1)
```

### Senaryo 3: Farklı İşletmeler

```
1. Farklı işletmelerinizi ekleyin
   • Şirket A
   • Şirket B  
   • Şirket C

2. Her işletmeden yorumları çekin

3. Her işletmenin sitesinde kendi yorumlarını gösterin
```

---

## 🔐 Güvenlik

### API Key Güvenliği:

- ✅ API key `.env` dosyasında tutulur
- ✅ Git'e commit edilmez
- ✅ Frontend'e gönderilmez
- ✅ Sadece backend'de kullanılır

### Yorum Yönetimi:

- ✅ Yorumları yayından kaldırabilirsiniz
- ✅ Yorumları silebilirsiniz
- ✅ İşletmeyi pasif yapabilirsiniz
- ✅ Minimum puan filtresi uygulayabilirsiniz

---

## 📞 Google Cloud Console Kurulumu

### Detaylı Adımlar:

1. **Proje Oluştur:**
   ```
   console.cloud.google.com → Select a project → New Project
   → Proje adı: "AWA CMS Google Reviews"
   → Create
   ```

2. **Places API Aktif Et:**
   ```
   → APIs & Services → Library
   → Ara: "Places API"
   → Places API'yi seç
   → Enable
   ```

3. **API Key Oluştur:**
   ```
   → APIs & Services → Credentials
   → Create Credentials → API Key
   → Key oluşturuldu!
   → Copy
   ```

4. **API Key'i Güvenli Yap (Opsiyonel):**
   ```
   → API key'e tıkla
   → API restrictions → Restrict key
   → Places API seç
   → Save
   ```

5. **Faturalama Aktif Et:**
   ```
   → Billing → Link a billing account
   → Kredi kartı bilgilerini girin
   → Not: Aylık $200 ücretsiz kredi var
   ```

---

## 💰 Maliyet

### Google Places API Fiyatları:

- **Ücretsiz:** Aylık $200 kredi
- **Place Details:** $17 / 1000 istek
- **Find Place:** $17 / 1000 istek

### Kullanım Hesabı:

```
10 işletme x günde 1 çekme = 10 istek/gün
300 istek/ay = ~$5/ay

Ücretsiz kredi ile: İlk 11,700 istek ücretsiz
→ 1 yıl boyunca ücretsiz kullanım!
```

---

## 🎉 Özet

### Sistem Hazır!

✅ Birden fazla işletme eklenebilir  
✅ Google Maps URL'den otomatik bilgi çıkarır  
✅ API ile gerçek yorumlar çeker  
✅ İşletme başına 5 yorum (Google limiti)  
✅ Homepage builder entegrasyonu  
✅ 4 farklı tasarım varyantı  
✅ Yorum yönetimi (yayınla/kaldır/sil)  
✅ İşletme bazlı filtreleme  

### Artık Yapabilecekleriniz:

1. ✨ İstediğiniz kadar işletme ekleyin
2. 🔄 Her işletmeden yorumları otomatik çekin
3. 🎨 Farklı tasarımlarla gösterin
4. 📊 İşletme istatistiklerini görün
5. 🎯 İşletme bazlı yorumları filtreleyin

---

**Başarıyla kuruldu! Artık Google yorumlarınızı profesyonelce gösterebilirsiniz.** 🚀

**Admin Panel Linki:** `/admin/google-businesses`

