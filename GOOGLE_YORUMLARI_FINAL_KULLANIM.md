# ✅ Google Yorumları Modülü - Kullanıma Hazır!

## 🎯 Nasıl Çalışıyor? (Çok Basit!)

### 1️⃣ Google Maps Linkini Alın

```
Google Maps → İşletmenizi arayın → Paylaş → Linki kopyala
```

**Örnek:**
```
https://www.google.com/maps/place/Rota+Nakliyat+%26+Depolama/@40.9562253,29.1506936...
```

### 2️⃣ Admin Panele Yapıştırın

```
Admin Panel → İçerik Yönetimi → Google Yorumları
→ [Yeni İşletme Ekle]
→ Google Maps URL'sini yapıştır
→ İşletme adı otomatik çıkar: "Rota Nakliyat & Depolama"
→ Place ID otomatik oluşur
→ Adres bilgisi otomatik doldurulur
→ [Oluştur]
```

### 3️⃣ Yorumları Ekleyin

```
Oluştur'a bastığınızda → Otomatik edit sayfasına gider
→ [Yeni Yorum Ekle] butonu görünür
→ Yorumları tek tek ekleyin:
   • Yorumcu adı
   • Puan (1-5 yıldız)
   • Yorum metni
   • Tarih
   • Avatar URL (opsiyonel)
→ [Oluştur]
```

### 4️⃣ Anasayfaya Ekleyin

```
Anasayfa → Anasayfa İçeriği → + Blok Ekle
→ Google Yorumları
→ İşletme seç (veya boş bırak = tüm işletmeler)
→ Tasarım seç (Variant 1-4)
→ Ayarları yap
→ [Kaydet]
```

---

## 📋 Admin Panel Yapısı

### Tek Menü - Her Şey Burada:

```
📁 İçerik Yönetimi
  🏢 Google Yorumları  ← TEK MENÜ!
```

### Listele Sayfası (`/admin/google-businesses`):

```
┌─────────────────────────────────────────────────┐
│ Google Yorumları                  [+Yeni İşletme]│
├─────────────────────────────────────────────────┤
│ İşletme Adı          |⭐Puan|Yorumlar|Aktif|Aksiyon│
│ ─────────────────────────────────────────────── │
│ Rota Nakliyat       |⭐4.5| 12    | ✅  |Yorumları Yönet│
│ AWA Yazılım         |⭐5.0| 8     | ✅  |Yorumları Yönet│
│ XYZ Şirket          |⭐4.0| 5     | ✅  |Yorumları Yönet│
└─────────────────────────────────────────────────┘
```

### Yeni İşletme Ekle (`/admin/google-businesses/create`):

```
┌─────────────────────────────────────────────────┐
│ İşletme Bilgileri                               │
├─────────────────────────────────────────────────┤
│ Google Maps URL:                                │
│ ┌─────────────────────────────────────────────┐│
│ │ [Linki yapıştırın...]                       ││
│ └─────────────────────────────────────────────┘│
│                                                 │
│ İşletme Adı: (otomatik çıkarılır)             │
│ Place ID: (otomatik oluşur)                    │
│ Adres: (otomatik doldurulur)                   │
│                                                 │
│ ☑ Aktif mi?                                    │
│                                                 │
│ [Oluştur] ← Basınca edit sayfasına gider      │
└─────────────────────────────────────────────────┘
```

### Yorumları Yönet (`/admin/google-businesses/1/edit`):

```
┌─────────────────────────────────────────────────┐
│ Rota Nakliyat & Depolama       [Yeni Yorum Ekle]│
├─────────────────────────────────────────────────┤
│ İşletme Bilgileri                               │
│ Google Maps URL: https://...                    │
│ İşletme Adı: Rota Nakliyat & Depolama         │
│ Place ID: abc123... (otomatik)                 │
│ Adres: Koordinatlar: 40.9562, 29.1506 (otomatik)│
│                                                 │
│ İstatistikler:                                  │
│ 📊 Toplam Yorum: 12                            │
│ ✅ Yayında: 10                                 │
│ ⭐ Ortalama Puan: 4.5 / 5                      │
│                                                 │
│ [Kaydet]                                        │
├─────────────────────────────────────────────────┤
│ YORUMLAR                                        │
├─────────────────────────────────────────────────┤
│ Yorumcu  |Puan    |Yorum          |Tarih |Yayında│
│ ──────────────────────────────────────────────│
│ Ahmet K. |⭐⭐⭐⭐⭐|Çok iyi hizmet|01.10|  ✅  │
│ Mehmet Y.|⭐⭐⭐⭐  |İyi çalıştılar|28.09|  ✅  │
│                                                 │
│ Her satırda: [Yayınla/Kaldır] [Sil]           │
└─────────────────────────────────────────────────┘
```

---

## ⚡ Otomatik Doldurulan Alanlar

### URL Yapıştırdığınızda Otomatik:

```
URL: https://www.google.com/maps/place/Rota+Nakliyat+%26+Depolama/@40.9562253,29.1506936...

✅ İşletme Adı → "Rota Nakliyat & Depolama"
✅ Place ID → "f3a2b1c..." (hash)
✅ Adres → "Koordinatlar: 40.9562253, 29.1506936"
```

**Not:** API kullanılmıyor, her şey URL'den çıkarılıyor!

---

## 🎨 Yeni Yorum Ekleme Formu

```
[Yeni Yorum Ekle] butonuna tıklayınca:

┌─────────────────────────────────────┐
│ Yorumcu Adı:                        │
│ [Ahmet Yılmaz]                      │
│                                     │
│ Puan:                               │
│ [⭐⭐⭐⭐⭐ 5 Yıldız ▼]            │
│                                     │
│ Yorum Metni:                        │
│ ┌─────────────────────────────────┐│
│ │ Çok profesyonel hizmet aldık... ││
│ │                                 ││
│ └─────────────────────────────────┘│
│                                     │
│ Yorum Tarihi:                       │
│ [07.10.2025 14:30]                  │
│                                     │
│ Avatar URL (Opsiyonel):             │
│ [https://...]                       │
│                                     │
│ [Oluştur]                           │
└─────────────────────────────────────┘
```

---

## 🏠 Homepage Builder

```
Anasayfa → Anasayfa İçeriği → + Blok Ekle → Google Yorumları

Ayarlar:
├─ İşletme Seç: [Tümü ▼] veya [Rota Nakliyat ▼]
├─ Başlık: "Müşteri Yorumları"
├─ Alt Başlık: "Değerli müşterilerimizin görüşleri"
├─ Görünüm: [Variant 1 ▼]
├─ Yorum Sayısı: 10
├─ Minimum Puan: 4 Yıldız ve Üzeri
├─ Arkaplan Görseli: [Yükle]
└─ Arkaplan Rengi: #ffffff

[Kaydet]
```

---

## 💡 Özellikler

### ✅ Yapabilecekleriniz:

- **Birden Fazla İşletme:** İstediğiniz kadar ekleyin
- **URL'den Otomatik:** İsim, Place ID, Adres otomatik
- **Manuel Yorum:** Her yorumu kendiniz eklersiniz
- **Yorum Yönetimi:** Yayınla/Kaldır/Sil
- **İşletme Bazlı:** Her işletmenin kendi yorumları
- **Homepage Builder:** Blok olarak ekleyin
- **4 Tasarım:** Modern, Klasik, Minimal, Slider

### ❌ Gereksiz Olanlar (Kaldırıldı):

- ❌ API yapılandırması
- ❌ .env dosyasına ekleme
- ❌ Otomatik yorum çekme
- ❌ Google API limitleri
- ❌ Karmaşık ayarlar

---

## 📊 Kullanım Akışı

```
1. [Yeni İşletme Ekle]
   ↓
2. Google Maps URL yapıştır
   ↓  
3. Bilgiler otomatik doldu
   ↓
4. [Oluştur] bas
   ↓
5. Edit sayfasına gider
   ↓
6. [Yeni Yorum Ekle] ile yorumları ekle
   ↓
7. Anasayfaya blok olarak ekle
   ↓
8. Frontend'de görün! 🎉
```

---

## 🎨 4 Tasarım Varyantı

**Variant 1:** Modern kartlar (Grid 3 kolon)  
**Variant 2:** Klasik quote stili (Tırnak işareti)  
**Variant 3:** Minimal ve temiz (Sol mavi çizgi)  
**Variant 4:** Slider (Otomatik döner)  

---

## 💾 Veritabanı Yapısı

```
google_businesses (İşletmeler)
├─ id
├─ name (otomatik)
├─ google_maps_url
├─ place_id (otomatik)
├─ formatted_address (otomatik)
├─ rating (hesaplanan)
├─ user_ratings_total (sayılır)
└─ is_active

google_reviews (Yorumlar)
├─ id
├─ google_business_id (ilişki)
├─ reviewer_name
├─ rating (1-5)
├─ review_text
├─ review_date
├─ reviewer_avatar_url
└─ is_published
```

---

## 🎯 Örnek Senaryo

### İşletme 1: Rota Nakliyat

```
1. İşletme ekle: URL yapıştır
2. 12 yorum manuel ekle
3. Anasayfaya blok ekle (Variant 1)
4. Sadece 5 yıldızları göster
```

### İşletme 2: AWA Yazılım

```
1. İşletme ekle: URL yapıştır  
2. 8 yorum manuel ekle
3. Anasayfaya blok ekle (Variant 4 - Slider)
4. Tüm yorumları göster
```

### Anasayfa Görünümü:

```
[Rota Nakliyat Yorumları - Grid]
⭐⭐⭐⭐⭐ ⭐⭐⭐⭐⭐ ⭐⭐⭐⭐⭐

[Tüm Şirketler - Slider]
← Ahmet: "Harika!" →
```

---

## ✅ Sistem Hazır!

### API Yok - Sorun Yok:
- ✅ Google Maps URL'den isim çıkar
- ✅ Place ID otomatik oluştur
- ✅ Koordinatları al
- ✅ Manuel yorum ekle
- ✅ Tüm kontrol sizde

### Kullanıcı Dostu:
- ✅ Tek sayfa yönetimi
- ✅ Otomatik form doldurma
- ✅ Direkt yorum ekleme
- ✅ Homepage builder entegrasyonu

### Esnek:
- ✅ Birden fazla işletme
- ✅ İşletme bazlı filtreleme
- ✅ 4 farklı tasarım
- ✅ Yayın kontrolü

---

## 🚀 Hemen Başlayın!

```
1. Admin Panel → Google Yorumları
2. Yeni İşletme Ekle
3. Google Maps linkini yapıştır
4. Oluştur
5. Yorumları ekle
6. Anasayfaya blok olarak ekle
7. Bitti! 🎉
```

---

**Menü:** `İçerik Yönetimi → Google Yorumları`  
**Link:** `/admin/google-businesses`  
**Dokümantasyon:** `GOOGLE_YORUMLARI_KULLANIM.md`

