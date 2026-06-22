# 📝 Form Oluşturucu Sistemi - Kullanım Kılavuzu

## 🎯 Genel Bakış

AWA CMS için geliştirilmiş JotForm benzeri kapsamlı form oluşturucu sistemi. Admin panelinden kolayca özel formlar oluşturabilir, gönderimleri yönetebilir ve analiz edebilirsiniz.

## ✨ Özellikler

### 📋 Form Yönetimi
- ✅ Sürükle-bırak ile alan sıralaması
- ✅ 23+ farklı alan tipi
- ✅ Çoklu dil desteği (Translatable)
- ✅ Koşullu mantık (Conditional Logic)
- ✅ Özel CSS ve JavaScript
- ✅ Form şablonları

### 🎨 Alan Tipleri

#### Metin Alanları
- **Tek Satır Metin**: Kısa metin girişi
- **Çok Satır Metin**: Uzun metin girişi
- **E-posta**: E-posta doğrulamalı
- **Telefon**: Telefon numarası
- **URL**: Web adresi
- **Sayı**: Sayısal değer

#### Tarih/Saat
- **Tarih**: Tarih seçici
- **Saat**: Saat seçici
- **Tarih ve Saat**: Kombine seçici

#### Seçim Alanları
- **Açılır Liste**: Dropdown select
- **Radyo Buton**: Tek seçim
- **Çoklu Seçim**: Multiple checkbox
- **Tek Checkbox**: On/off switch

#### Dosya Yükleme
- **Dosya Yükleme**: Genel dosyalar
- **Resim Yükleme**: Sadece resimler
- Dosya tipi ve boyut kısıtlaması

#### Puan/Değerlendirme
- **Puan Verme**: Yıldız/sayı rating
- **Ölçek**: Linear scale
- **Kaydırıcı**: Slider input

#### İçerik Elemanları
- **Başlık**: H1-H6 başlıklar
- **Paragraf**: Açıklayıcı metin
- **Ayırıcı**: Görsel bölücü
- **HTML İçerik**: Özel HTML

#### Özel Alanlar
- **Gizli Alan**: Hidden input
- **Ad Soyad**: Ayrı ad/soyad alanları
- **Adres**: Detaylı adres formu

## 🚀 Kullanım

### 1️⃣ Form Oluşturma

1. Admin paneline giriş yapın
2. **Form Oluşturucu** menüsüne gidin
3. **Yeni Form Oluştur** butonuna tıklayın
4. **Genel Ayarlar** sekmesinde:
   - Form adı
   - Başlık ve açıklama (çoklu dil)
   - Slug (otomatik oluşur)
   - Durum (Aktif/Pasif)

### 2️⃣ Alan Ekleme

1. Formu düzenle sayfasına gidin
2. **Form Alanları** sekmesine tıklayın
3. **Yeni Alan Ekle** butonuna tıklayın
4. Alan özelliklerini doldurun:
   - **Alan Tipi**: Yukarıdaki listeden seçin
   - **Alan Adı**: İngilizce, alt çizgili (örn: first_name)
   - **Etiket**: Kullanıcıya gösterilecek metin
   - **Genişlik**: Tam/Yarım/Üçte Bir
   - **Sıra**: Gösterim sırası
   - **Zorunlu**: Gerekli alan mı?

### 3️⃣ Form Ayarları

#### Gönderim Ayarları
- **Gönder Butonu Metni**: Buton üzerindeki yazı
- **Başarı Mesajı**: Gönderim sonrası mesaj
- **Yönlendirme URL**: Başarı sonrası yönlendirme (opsiyonel)

#### Erişim Ayarları
- **Gönderimleri Kaydet**: Veritabanına kayıt
- **Çoklu Gönderime İzin Ver**: Aynı kullanıcı tekrar gönderebilir
- **Giriş Gerekli**: Sadece üyeler doldurabilir

#### E-posta Bildirimleri
- **E-posta Bildirimi Gönder**: Aktif/Pasif
- **Bildirim E-posta Adresi**: Bildirimin gideceği adres
- **E-posta Konusu**: Bildirim başlığı

### 4️⃣ Gelişmiş Özellikler

#### Özel CSS
```css
.form-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.submit-button {
    background: #10b981;
}
```

#### Özel JavaScript
```javascript
// Form submit öncesi ek kontrol
console.log('Form hazır!');

// Özel event listener
document.querySelector('#phone').addEventListener('input', function(e) {
    // Telefon formatla
    e.target.value = e.target.value.replace(/\D/g, '');
});
```

#### Koşullu Mantık
Alan adı ve değer bazlı görünürlük kontrolü:
```
alan_adi: "beklenen_deger"
```

#### Validation Rules
Laravel validation kuralları:
```
min:3
max:255
regex:/[A-Z]/
alpha_dash
```

### 5️⃣ Form Paylaşma

#### Direkt Link
```
https://yourdomain.com/forms/form-slug
```

#### iFrame Embed
```html
<iframe src="https://yourdomain.com/forms/form-slug" 
        width="100%" 
        height="600" 
        frameborder="0">
</iframe>
```

#### JavaScript Embed
```html
<div id="awacms-form-1"></div>
<script src="https://yourdomain.com/js/form-embed.js" 
        data-form-id="1">
</script>
```

### 6️⃣ Gönderim Yönetimi

1. Form listesinde ilgili forma tıklayın
2. **Gönderimler** butonuna tıklayın
3. Gönderim listesinde:
   - 📧 Okundu/Okunmadı durumu
   - 📊 Tüm form verileri
   - 🔍 Detaylı görünüm
   - ✏️ Not ekleme
   - 🗑️ Silme

#### Toplu İşlemler
- Okundu/Okunmadı olarak işaretle
- Toplu silme
- Excel'e aktarma

#### Excel Export
- **Excel'e Aktar** butonu ile tüm gönderimleri indir
- Tüm form alanları sütunlarda
- IP adresi ve tarih bilgisi
- Otomatik dosya adı: `form-slug_submissions_2025-10-07.xlsx`

## 📊 Örnek Kullanım Senaryoları

### İletişim Formu
```
Alanlar:
- Ad Soyad (text, required)
- E-posta (email, required)
- Telefon (phone)
- Konu (select, required)
- Mesaj (textarea, required)
```

### Başvuru Formu
```
Alanlar:
- Kişisel Bilgiler (heading)
- Ad (text, required)
- Soyad (text, required)
- E-posta (email, required)
- CV Yükle (file, required, max: 5MB)
- Deneyim (select, required)
- Neden başvuruyorsunuz? (textarea)
- KVKK Onayı (checkbox_single, required)
```

### Anket Formu
```
Alanlar:
- Memnuniyet (rating, 1-5)
- Hizmet Kalitesi (scale, 1-10)
- Öneri Puanı (slider, 0-100)
- Yorumlar (textarea)
- Tekrar tercih eder misiniz? (radio: Evet/Hayır)
```

### Etkinlik Kayıt
```
Alanlar:
- Katılımcı Bilgileri (heading)
- Ad Soyad (name, required)
- E-posta (email, required)
- Telefon (phone, required)
- Etkinlik Günü (date, required)
- Etkinlik Saati (time, required)
- Yemek Tercihi (select)
- Özel İhtiyaç (textarea)
- Onay (checkbox_single, required)
```

## 🔒 Güvenlik

- ✅ CSRF koruması
- ✅ XSS koruması
- ✅ SQL Injection koruması
- ✅ Dosya tipi doğrulama
- ✅ Dosya boyutu kısıtlaması
- ✅ Rate limiting
- ✅ Honeypot koruması (opsiyonel)
- ✅ IP adresi loglama

## 🎨 Özelleştirme

### Tema Entegrasyonu
Form görünümü mevcut tema ile entegre edilebilir. `resources/views/forms/show.blade.php` dosyasını tema layoutunuzu kullanacak şekilde düzenleyebilirsiniz:

```php
@extends('frontend.layouts.app')

@section('content')
    // Form içeriği
@endsection
```

### Stil Özelleştirme
Her form için ayrı CSS tanımlanabilir veya global stil dosyası oluşturulabilir:

```css
/* public/css/custom-forms.css */
.form-container {
    max-width: 900px;
    /* Özel stiller */
}
```

## 📈 İstatistikler ve Raporlama

- Toplam gönderim sayısı
- Okunma oranları
- Tarih bazlı filtreleme
- Excel export
- Form başına alan sayısı
- Alan bazlı istatistikler

## 🛠️ Teknik Detaylar

### Database Tables
- `forms` - Form bilgileri
- `form_fields` - Form alanları
- `form_submissions` - Gönderimler

### Models
- `App\Models\Form`
- `App\Models\FormField`
- `App\Models\FormSubmission`

### Controller
- `App\Http\Controllers\FormController`

### Routes
- `GET /forms/{slug}` - Form görüntüle
- `POST /forms/{slug}` - Form gönder
- `GET /forms/embed/{id}` - Embed versiyonu

### Notifications
- `App\Notifications\FormSubmissionNotification`

### Filament Resources
- `App\Filament\Resources\FormResource`
- `App\Filament\Resources\FormResource\RelationManagers\FieldsRelationManager`
- `App\Filament\Resources\FormResource\RelationManagers\SubmissionsRelationManager`

## 🐛 Sorun Giderme

### Form görünmüyor
- Form aktif mi kontrol edin
- Slug doğru mu kontrol edin
- Cache temizleyin: `php artisan optimize:clear`

### E-posta bildirimi gelmiyor
- SMTP ayarları doğru mu?
- Queue çalışıyor mu? `php artisan queue:work`
- Mail log dosyalarını kontrol edin

### Dosya yüklenmiyor
- `storage/app/public` klasörü symlink mi?
- `php artisan storage:link`
- Dosya boyutu limiti kontrolü
- PHP upload_max_filesize ayarı

### Excel export hata veriyor
- Maatwebsite/Excel paketi yüklü mü?
- `composer require maatwebsite/excel`
- Yazma izinleri kontrolü

## 📞 Destek

Herhangi bir sorun veya öneriniz için:
- GitHub Issues
- Dökümantasyon
- Teknik Destek

## 🎉 Başarıyla Kuruldu!

Form oluşturucu sisteminiz kullanıma hazır. Admin paneline giriş yaparak ilk formunuzu oluşturabilirsiniz.

**Admin Panel URL:** `/admin/forms`

İyi çalışmalar! 🚀

