# ✅ Google API Hatası Çözüldü!

## 🔧 Sorun: REQUEST_DENIED

Log'dan görülen hata:
```
"You're calling a legacy API, which is not enabled for your project.
To get newer features, switch to the Places API (New)"
```

## ✅ Çözüm: YENİ Places API Aktif Edin

Google artık **yeni API** istiyor. Sistem güncellendi, şimdi şunları yapın:

---

## 📋 Adım Adım Çözüm

### 1. Google Cloud Console'a Gidin

```
https://console.cloud.google.com/
```

### 2. Places API (New) Aktif Edin

```
1. Sol menüden "APIs & Services" → "Library"
2. Arama çubuğuna "Places API" yazın
3. ⚠️ İKİ VERSİYON VAR:
   
   ❌ "Places API" (ESKİ) - Bunu KULLANMAYIN
   ✅ "Places API (New)" (YENİ) - BUNU AKTİF EDİN!

4. "Places API (New)" tıklayın
5. [Enable] butonuna basın
6. 1-2 dakika bekleyin
```

### 3. Eski API'yi Devre Dışı Bırakın (Opsiyonel)

```
1. "APIs & Services" → "Enabled APIs"
2. "Places API" (eski) bulun
3. [Disable] tıklayın
```

### 4. Billing Kontrol Edin

```
1. Sol üst menü → "Billing"
2. Billing account bağlı olmalı
3. Yoksa "Link a billing account" → Kredi kartı ekleyin
```

### 5. API Key Kısıtlamalarını Kaldırın

```
1. "APIs & Services" → "Credentials"
2. API key'inize tıklayın
3. "API restrictions":
   → "Don't restrict key" seçin
   veya
   → "Restrict key" → "Places API (New)" seçin
4. [Save]
5. 2-3 dakika bekleyin
```

### 6. Sistemde Test Edin

```
1. Admin Panel → Settings → Genel Ayarlar
2. Google Yorumları API → API key'i kontrol edin
3. Kaydet (tekrar kaydedin)
4. Google Yorumları → İşletme seç
5. [Yorumları Çek] butonuna basın
6. ✅ Artık çalışmalı!
```

---

## 🎯 Sistem Güncellendi!

**Önceki sistem:** Eski Places API kullanıyordu  
**Yeni sistem:** Places API (New) kullanıyor ✅

**Değişiklikler:**
- ✅ YENİ API endpoint'leri
- ✅ YENİ API formatı
- ✅ Otomatik format dönüştürme
- ✅ Aynı kullanım, arka planda yeni API

**Kullanım değişmedi!** Sadece Google Cloud Console'da **Places API (New)** aktif edin.

---

## 📊 Kontrol Listesi

Şunları yapıp yapmadığınızı kontrol edin:

```
☐ Places API (New) enable edildi
☐ Billing (faturalama) aktif
☐ API key kısıtlamaları kaldırıldı
☐ 2-3 dakika beklendi
☐ Settings'te API key tekrar kaydedildi
☐ Cache temizlendi (otomatik)
☐ Test edildi
```

---

## 🎉 Artık Çalışır!

Talimatları takip ettikten sonra:

```
1. Google Yorumları → İşletme seç
2. [Yorumları Çek]
3. ✅ Google'dan yorumlar gelecek!
```

**Not:** Yeni API ile daha fazla özellik ve daha iyi performans var!

---

## 🆘 Hala Çalışmıyorsa

1. API key'i yeniden oluşturun
2. "Places API (New)" kesinlikle enabled olmalı
3. Billing mutlaka aktif olmalı
4. 5 dakika bekleyin
5. Tekrar deneyin

**En yaygın hata:** Billing (faturalama) aktif değil!

