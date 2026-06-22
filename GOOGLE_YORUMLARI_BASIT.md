# ✅ Google Yorumları Modülü - Basit Kullanım

## 🎯 Çok Basit - API Gerekmez!

**Hiçbir teknik ayar yok, sadece:**
1. İşletme ekle (Google Maps URL)
2. Yorumları manuel ekle
3. Anasayfada göster

---

## 📋 Kullanım (3 Adım)

### 1️⃣ İşletme Ekle

```
Admin Panel → Google Yorumları → [Yeni İşletme Ekle]
```

**Form:**
```
Google Maps URL:
[https://www.google.com/maps/place/Rota+Nakliyat...]
↓ (URL yapıştırdığınızda otomatik doldurulur)

İşletme Adı: Rota Nakliyat & Depolama  ✅ Otomatik
Place ID: f3a2b1c...                    ✅ Otomatik  
Adres: Koordinatlar: 40.95, 29.15      ✅ Otomatik

☑ Aktif mi?

[Oluştur] → Otomatik edit sayfasına gider
```

### 2️⃣ Yorumları Ekle

İşletme oluşturduktan sonra **edit sayfasında:**

```
[Yeni Yorum Ekle] butonuna tıkla
```

**Yorum Formu:**
```
Yorumcu Adı: Ahmet Yılmaz
Puan: ⭐⭐⭐⭐⭐ 5 Yıldız
Yorum Metni: Çok profesyonel hizmet aldık...
Tarih: 07.10.2025
Avatar URL: (opsiyonel)

[Oluştur]
```

**Google'daki yorumlarınızı buraya kopyalayıp ekleyin!**

### 3️⃣ Anasayfaya Ekle

```
Anasayfa → Anasayfa İçeriği → + Blok Ekle
→ Google Yorumları
→ İşletme seç: Rota Nakliyat
→ Görünüm: Variant 1 (Modern)
→ Yorum Sayısı: 10
→ Minimum Puan: 4 Yıldız
→ [Kaydet]
```

---

## 💡 Yorumları Nasıl Eklerim?

### Yöntem 1: Google'dan Kopyala-Yapıştır

```
1. Google'da işletmenizi açın
2. Yorumlar bölümüne gidin
3. Her yorumu okuyun
4. Admin panele manuel ekleyin:
   - İsim kopyala
   - Yıldız sayısını gir
   - Yorum metnini kopyala
   - Tarihi gir
```

### Yöntem 2: Müşterilerinizden Toplayın

```
1. Müşterilerinize e-posta gönderin
2. Google'a yorum bırakmalarını isteyin
3. Yorumları kendiniz admin panelden ekleyin
```

### Yöntem 3: Demo Yorumlar

İlk aşamada test için:
```
1. Birkaç örnek yorum ekleyin
2. Tasarımı test edin
3. Sonra gerçek yorumları ekleyin
```

---

## 📊 İşletme Listesi

```
┌─────────────────────────────────────────────┐
│ Google Yorumları        [+ Yeni İşletme]    │
├─────────────────────────────────────────────┤
│ İşletme Adı    |Puan|Yorumlar|Aktif|Aksiyon │
│ ──────────────────────────────────────────  │
│ Rota Nakliyat  |⭐4.5|   12   | ✅ |        │
│                |    |        |    |[Yorumları Yönet]│
│                |    |        |    |   [Sil]  │
│ ──────────────────────────────────────────  │
│ AWA Yazılım    |⭐5.0|    8   | ✅ |        │
│                |    |        |    |[Yorumları Yönet]│
│                |    |        |    |   [Sil]  │
└─────────────────────────────────────────────┘
```

---

## 🏢 Edit Sayfası (Yorumları Yönet)

```
┌─────────────────────────────────────────────┐
│ Rota Nakliyat & Depolama [Yeni Yorum Ekle] │
├─────────────────────────────────────────────┤
│ İşletme Bilgileri                           │
│ URL: https://...                            │
│ Ad: Rota Nakliyat & Depolama               │
│ Place ID: f3a2b1c...                       │
│ Adres: Koordinatlar: 40.95, 29.15          │
│                                             │
│ İstatistikler:                              │
│ 📊 Toplam: 12                               │
│ ✅ Yayında: 10                              │
│ ⭐ Ortalama: 4.5 / 5                        │
│                                             │
│ [Kaydet]                                    │
├─────────────────────────────────────────────┤
│ İŞLETME YORUMLARI                           │
├─────────────────────────────────────────────┤
│ Yorumcu |Puan    |Yorum        |Tarih|Yayın│
│ ─────────────────────────────────────────  │
│ Ahmet   |⭐⭐⭐⭐⭐|Harika!      |01.10| ✅  │
│ Mehmet  |⭐⭐⭐⭐  |İyi hizmet   |28.09| ✅  │
│                                             │
│ [Yayınla/Kaldır] [Sil]                     │
└─────────────────────────────────────────────┘
```

---

## ✨ Özellikler

### Otomatik:
- ✅ İşletme adı (URL'den)
- ✅ Place ID (otomatik hash)
- ✅ Koordinatlar (URL'den)
- ✅ İstatistikler (hesaplanan)

### Manuel:
- ✅ Yorum ekleme
- ✅ Yayınlama kontrolü
- ✅ Silme
- ✅ Toplu işlemler

### Frontend:
- ✅ 4 tasarım varyantı
- ✅ Responsive
- ✅ Modern & minimal
- ✅ Homepage Builder

---

## 🎯 Örnek: 12 Yorum Eklemek

```
1. İşletme oluştur → Edit sayfasına git
2. [Yeni Yorum Ekle] × 12 kez
3. Her yorum için:
   - İsim gir
   - Puan seç
   - Metni yaz
   - Tarih seç
   - [Oluştur]
4. 12 yorum eklendi!
5. Anasayfaya ekle
```

**Süre:** ~5-10 dakika

---

## 💪 Avantajlar

**Karmaşık API Yok:**
- ❌ Google Cloud Console
- ❌ API key oluşturma
- ❌ Faturalama ayarları
- ❌ API limitleri
- ❌ Teknik bilgi

**Tam Kontrol:**
- ✅ Hangi yorumları göstereceğinize karar verin
- ✅ Yorumları düzenleyebilirsiniz
- ✅ Dilediğiniz zaman ekleyin/silin
- ✅ Sınırsız yorum
- ✅ Hiçbir maliyet yok

---

## 🏠 Homepage Builder

```
Google Yorumları Bloğu:
├─ İşletme Seç: [Rota Nakliyat ▼]
├─ Başlık: "Müşteri Yorumları"
├─ Görünüm: Variant 1-4
├─ Yorum Sayısı: 10
├─ Min Puan: 4 ⭐
└─ [Kaydet]

Frontend'de:
→ Modern kartlar
→ Yıldızlarla gösterim
→ Avatar + isim + tarih
→ Responsive
```

---

## 🎨 4 Tasarım

1. **Variant 1:** Modern kartlar (3 kolon grid)
2. **Variant 2:** Klasik quote (tırnak işareti)
3. **Variant 3:** Minimal (sol mavi çizgi)
4. **Variant 4:** Slider (otomatik kayan)

---

## ✅ HAZIR!

**Hiçbir API, ayar veya teknik bilgi gerekmez!**

Sadece:
1. Google Maps URL'si
2. Yorumları manuel ekleyin
3. Anasayfada gösterin

**Basit ve etkili!** 🚀

---

**Admin Link:** `/admin/google-businesses`  
**Menü:** `İçerik Yönetimi → Google Yorumları`

