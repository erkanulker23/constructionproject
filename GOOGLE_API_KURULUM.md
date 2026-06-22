# 🔧 Google Places API Kurulum Rehberi

## ❌ "REQUEST_DENIED" Hatası Çözümü

Bu hata genellikle aşağıdaki sebeplerden oluşur:

### 1️⃣ Places API Aktif Değil

**Çözüm:**
```
1. https://console.cloud.google.com/ adresine gidin
2. Projenizi seçin
3. Sol menüden "APIs & Services" → "Library" tıklayın
4. Arama çubuğuna "Places API" yazın
5. "Places API" seçin (yeni versiyonu da olabilir: "Places API (New)")
6. "Enable" butonuna tıklayın
7. Aktif olması 1-2 dakika sürebilir
```

### 2️⃣ Billing (Faturalama) Aktif Değil

**Çözüm:**
```
1. Google Cloud Console'da
2. Sol üst menü → "Billing" tıklayın
3. "Link a billing account" tıklayın
4. Kredi kartı bilgilerinizi girin
5. Kaydet

Not: Aylık $200 ücretsiz kredi var!
Places API kullanımı çok ucuz (ayda ~$5)
```

### 3️⃣ API Key Kısıtlamaları

**Çözüm:**
```
1. APIs & Services → Credentials
2. API key'inize tıklayın
3. "API restrictions" bölümünde:
   
   Seçenek A: "Don't restrict key" (En Kolay)
   ✅ Tüm API'ler için çalışır
   
   Seçenek B: "Restrict key"
   → "Places API" seçin
   → "Places API (New)" de seçin (varsa)
   
4. "Save" tıklayın
5. 2-3 dakika bekleyin (aktif olması için)
```

### 4️⃣ API Key Doğru Kopyalanmadı

**Kontrol:**
```
1. Settings → Genel Ayarlar → Google Yorumları API
2. API key'i göster (👁️ ikonu)
3. Boşluk veya yanlış karakter var mı kontrol edin
4. Yeniden kopyala-yapıştır yapın
```

---

## ✅ Doğru Kurulum Adımları

### Adım 1: Proje Oluştur

```
1. https://console.cloud.google.com/
2. Üstte "Select a project" → "New Project"
3. Proje adı: "AWA CMS Google Reviews"
4. [Create]
```

### Adım 2: Places API Aktif Et

```
1. Sol menü → "APIs & Services" → "Library"
2. Ara: "Places API"
3. "Places API" seçin
4. [Enable] tıklayın
5. "Places API (New)" varsa onu da enable edin
```

### Adım 3: Billing Aktif Et (ZORUNLU!)

```
1. Sol menü → "Billing"
2. "Link a billing account"
3. Kredi kartı bilgilerini girin
4. Kaydet

⚠️ Faturalama olmadan API çalışmaz!
💰 Aylık $200 ücretsiz kredi var
💵 Places API çok ucuz (~$0.017 per request)
```

### Adım 4: API Key Oluştur

```
1. "APIs & Services" → "Credentials"
2. [Create Credentials] → "API Key"
3. API key oluşturuldu!
4. "Edit API key" (kalem ikonuna tıkla)
5. "API restrictions":
   → "Don't restrict key" seç (en kolay)
   veya
   → "Restrict key" seç
   → "Places API" işaretle
6. [Save]
7. 2-3 dakika bekle
```

### Adım 5: API Key'i Sisteme Ekle

```
1. Admin Panel → Settings → Genel Ayarlar
2. Scroll down → "Google Yorumları API"
3. API key'i yapıştır
4. [Kaydet]
```

### Adım 6: Test Et

```
1. Google Yorumları → İşletme listesi
2. Bir işletme seç → [Yorumları Çek]
3. "Evet, Çek"
4. ✅ Yorumlar gelmeli!
```

---

## 🔍 Hata Giderme

### Hala REQUEST_DENIED Alıyorsanız:

**Checklist:**
```
☐ Places API enable edildi mi?
☐ Places API (New) da enable edildi mi?
☐ Billing (faturalama) aktif mi?
☐ API key kısıtlamaları doğru mu?
☐ API key doğru kopyalandı mı?
☐ 2-3 dakika beklendi mi? (aktif olması için)
```

### Diğer Hatalar:

**OVER_QUERY_LIMIT:**
```
→ Günlük limitinizi aştınız
→ Faturalama hesabınızı kontrol edin
→ Yarın tekrar deneyin
```

**ZERO_RESULTS:**
```
→ İşletme Google'da bulunamadı
→ Google Maps URL'sini kontrol edin
→ İşletmenin Google'da kayıtlı olduğundan emin olun
```

**INVALID_REQUEST:**
```
→ Place ID geçersiz
→ İşletmeyi yeniden ekleyin
→ Farklı bir Google Maps URL'si deneyin
```

---

## 💰 Maliyet Hesabı

### Google Places API Fiyatları:

```
Place Details (yorumları çekmek): $17 / 1000 istek
Find Place (işletme aramak): $17 / 1000 istek
```

### Örnek Kullanım:

```
10 işletme x günde 1 çekme = 10 istek/gün
Ayda: ~300 istek
Maliyet: ~$5-10/ay

Ücretsiz kredi: Aylık $200
→ İlk aylar tamamen ücretsiz!
```

---

## ✅ Başarılı Kurulum Örneği

```
1. ✅ Proje: "AWA CMS"
2. ✅ Places API: Enabled
3. ✅ Billing: Aktif (kredi kartı bağlı)
4. ✅ API Key: Kısıtlama yok
5. ✅ Settings'e eklendi
6. ✅ Test: Yorumlar geldi!
```

---

## 📞 Destek

Hala sorun yaşıyorsanız:

1. Google Cloud Console → Support
2. Laravel log: `storage/logs/laravel.log`
3. API key'i yeniden oluşturun
4. Farklı bir proje deneyin

---

**En önemli:** Billing (faturalama) MUTLAKA aktif olmalı! Yoksa REQUEST_DENIED hatası alırsınız.

