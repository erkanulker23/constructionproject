# ✅ Google Yorumları Modülü - Kullanım Kılavuzu

## 🎯 Sistem Tam Olarak Şöyle Çalışıyor

### **Hiçbir Ayar Gerekmez!**

- ❌ .env dosyasına ekleme YOK
- ❌ Settings'te yapılandırma YOK  
- ❌ API key saklaması YOK
- ✅ Sadece Google Maps URL'si YETERLİ

---

## 🚀 Kullanım (3 Basit Adım)

### 1️⃣ İşletme Ekle

```
Admin Panel → İçerik Yönetimi → Google Yorumları
→ [Yeni İşletme Ekle]
→ Google Maps URL'sini yapıştır
→ İşletme adı OTOMATIK çıkar
→ Place ID OTOMATIK oluşur
→ [Oluştur]
→ OTOMATIK edit sayfasına gider
```

**Örnek URL:**
```
https://www.google.com/maps/place/Rota+Nakliyat+%26+Depolama/@40.9562253,29.1506936...

Otomatik Çıkar:
✅ İşletme Adı: "Rota Nakliyat & Depolama"
✅ Place ID: "f3a2b1c..." (hash)
✅ Adres: "Koordinatlar: 40.95, 29.15"
```

### 2️⃣ Yorumları Çek

İşletme oluşturduktan sonra, **Liste sayfasında** her işletme için:

```
┌──────────────────────────────────────────┐
│ Rota Nakliyat | ⭐4.5 | 0 | ✅          │
│                                          │
│ Aksiyonlar:                             │
│ [Yorumları Çek] [Yorumları Yönet] [Sil]│
└──────────────────────────────────────────┘
```

**[Yorumları Çek]** butonuna tıklayınca:

```
┌──────────────────────────────────────────┐
│ Rota Nakliyat & Depolama - Yorumları Çek│
├──────────────────────────────────────────┤
│ Google Places API Key:                   │
│ [AIzaSy...]  👁️                          │
│                                          │
│ 🔑 Google Cloud Console'dan              │
│    API anahtarınızı girin                │
│                                          │
│ [İptal] [Evet, Çek]                      │
└──────────────────────────────────────────┘
```

**Evet, Çek'e basınca:**
- ✅ Google'dan yorumlar çekilir (max 5)
- ✅ İşletme bilgileri güncellenir
- ✅ Adres, telefon, website gelir
- ✅ Ortalama puan ve toplam yorum sayısı güncellenir

### 3️⃣ Manuel Yorum Ekle (İsteğe Bağlı)

Google'dan gelen 5 yorum yetmezse:

```
İşletme satırında [Yorumları Yönet] 
→ [Yeni Yorum Ekle] butonu
→ Formu doldur
→ [Oluştur]
```

---

## 📊 Tam İş Akışı

### Senaryo: Rota Nakliyat Yorumları

**1. İşletme Ekle:**
```
Google Maps URL: https://www.google.com/maps/place/Rota+Nakliyat...
→ Oluştur
→ Otomatik: "Rota Nakliyat & Depolama" çıkar
→ Edit sayfasına gider
```

**2. Liste Sayfasında - Yorumları Çek:**
```
Liste'de → Rota Nakliyat satırı
→ [Yorumları Çek] butonuna tıkla
→ API key gir (tek seferlik)
→ [Evet, Çek]
→ Google'dan 5 yorum gelir
→ İşletme bilgileri güncellenir
```

**3. İstersen Daha Fazla Ekle:**
```
[Yorumları Yönet] → [Yeni Yorum Ekle]
→ 7 tane daha manuel ekle
→ Toplam: 12 yorum
```

**4. Anasayfaya Ekle:**
```
Anasayfa → Anasayfa İçeriği
→ + Google Yorumları Bloğu
→ İşletme: Rota Nakliyat
→ Görünüm: Variant 1
→ Kaydet
```

**5. Frontend'de Gör:**
```
Anasayfa → Google Yorumları Bölümü
→ 12 yorum gösterilir
→ Modern kart tasarımı
→ Responsive
```

---

## 🎨 Liste Sayfası Görünümü

```
┌───────────────────────────────────────────────────────────┐
│ Google Yorumları                      [+ Yeni İşletme Ekle]│
├───────────────────────────────────────────────────────────┤
│ İşletme         |Puan  |Yorumlar|Son Senkr.|Aktif|Aksiyonlar│
│ ───────────────────────────────────────────────────────── │
│ Rota Nakliyat   |⭐4.5| 12     |5 dk önce| ✅  |           │
│                 |     |        |         |     | [Yorumları Çek]│
│                 |     |        |         |     | [Yorumları Yönet]│
│                 |     |        |         |     | [Sil]     │
│ ───────────────────────────────────────────────────────── │
│ AWA Yazılım     |⭐5.0| 8      |-        | ✅  |           │
│                 |     |        |         |     | [Yorumları Çek]│
│                 |     |        |         |     | [Yorumları Yönet]│
│                 |     |        |         |     | [Sil]     │
└───────────────────────────────────────────────────────────┘
```

---

## 🔑 API Key Kullanımı

### Ne Zaman Gerekir?

**Sadece "Yorumları Çek" Butonunda!**

- ❌ İşletme eklerken GEREKMEZ
- ❌ Ayarlarda GEREKMEZ
- ❌ .env'de GEREKMEZ
- ✅ "Yorumları Çek" bastığınızda modal'da sorulur
- ✅ Sadece o işlem için kullanılır
- ✅ Saklanmaz

### API Key Nereden Alınır?

```
1. https://console.cloud.google.com/
2. Proje oluştur
3. "Places API" aktif et
4. "Create API Key"
5. Kopyala
6. "Yorumları Çek" modal'ına yapıştır
```

---

## ⚡ Özellikler

### Otomatik:
- ✅ İşletme adı (URL'den)
- ✅ Place ID (hash)
- ✅ Koordinatlar (URL'den)
- ✅ İstatistikler (hesaplanan)
- ✅ Edit sayfasına yönlendirme

### Manuel:
- ✅ Yorum ekleme (tam kontrol)
- ✅ Yorum düzenleme (yayınla/kaldır)
- ✅ Toplu işlemler

### Google'dan (İsteğe Bağlı):
- ✅ Yorumları çek (API ile)
- ✅ İşletme bilgilerini güncelle
- ✅ Max 5 yorum (Google sınırı)
- ✅ Gerisi manuel eklenebilir

---

## 💡 İpuçları

### En İyi Kullanım:

**1. İlk Kurulum:**
```
- 3-5 işletme ekleyin
- Her birinden yorumları çekin (API ile)
- Eksik yorumları manuel ekleyin
- Anasayfaya blok olarak ekleyin
```

**2. Düzenli Bakım:**
```
- Haftada bir "Yorumları Çek" yapın
- Yeni yorumlar otomatik gelir
- Eski yorumlar korunur
```

**3. Performans:**
```
- Yorumlar 1 saat cache'lenir
- Cache temizle: php artisan cache:clear
- Yeniden yüklemek için cache temizleyin
```

---

## 🎉 Sistem Hazır!

### ✅ Tamamlanan Özellikler:

1. ✨ Google Maps URL'den otomatik bilgi çıkarma
2. 🏢 Birden fazla işletme yönetimi
3. ⬇️ "Yorumları Çek" butonu (API ile)
4. ➕ Manuel yorum ekleme
5. 📊 Otomatik istatistikler
6. 🎨 4 farklı tasarım
7. 🏠 Homepage Builder entegrasyonu
8. 📱 Responsive tasarım

### 🎯 Kullanıma Hazır:

**Admin Panel:**
```
/admin/google-businesses
```

**Menü:**
```
İçerik Yönetimi → Google Yorumları
```

---

**Artık Google yorumlarınızı kolayca yönetebilirsiniz!** 🚀

**Not:** Google'dan yorum çekmek isterseniz sadece o işlem için API key girin. İstemezseniz yorumları manuel ekleyin. Her iki şekilde de mükemmel çalışır!

