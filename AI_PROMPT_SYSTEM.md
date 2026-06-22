# AI Prompt Template Sistemi

## Genel Bakış

Bu sistem, blog yazılarını yapay zeka ile oluştururken kullanılacak gelişmiş prompt şablonlarını yönetmenize olanak tanır. Artık basit bir konu girmek yerine, önceden yapılandırılmış şablonlarla kapsamlı, SEO optimize ve özelleştirilmiş içerikler oluşturabilirsiniz.

## Özellikler

### 1. Prompt Şablon Yönetimi
- `/admin/ai-prompt-templates` sayfasından şablonlarınızı yönetin
- Yeni şablonlar oluşturun veya mevcut şablonları düzenleyin
- Şablonları kopyalayarak hızlıca yeni varyasyonlar oluşturun

### 2. Gelişmiş Ayarlar

#### Yazı Ayarları
- **Dil**: Türkçe, İngilizce, Almanca, Fransızca, İspanyolca
- **Yazım Dili**: Resmi, Samimi, Standart, Profesyonel, Diplomatik, Kendinden Emin
- **Yazım Stili**: Ortaokul, Lise, Akademik, Basitleştirilmiş, Canlı, Anlayışlı, Lüks, İlgi Çekici, Direk, İkna Edici
- **Varsayılan Kelime Sayısı**: 100-5000 kelime arası

#### İçerik Yapısı
- ✅ Giriş Bölümü
- ✅ Sonuç Bölümü
- ❓ SSS (Sıkça Sorulan Sorular) - Soru sayısı belirlenebilir
- 📝 Madde İmleri Kullanımı
- 📊 İstatistik Ekleme
- 💡 Örnek Kullanımlar
- 🎯 Harekete Geçirici Mesaj (CTA)

#### SEO Ayarları
- SEO Optimizasyonu Aktif/Pasif
- Anahtar Kelime Kullanımı
- Hedef Anahtar Kelime Tanımlama

#### Format Ayarları
- **Başlık Yapısı**: Sadece H2, H2+H3, H2+H3+H4
- **Paragraf Uzunluğu**: Paragraf başına cümle sayısı

#### AI Model Ayarları
- **Model Seçimi**: GPT-3.5 Turbo, GPT-4 Turbo, GPT-4o
- **Temperature**: 0.0 (tutarlı) - 2.0 (yaratıcı)
- **Max Tokens**: Maksimum içerik uzunluğu

## Kullanım

### 1. Şablon Oluşturma

1. Admin panelinde **Settings > AI Prompt Şablonları** sayfasına gidin
2. **Yeni Oluştur** butonuna tıklayın
3. Şablon bilgilerini doldurun:
   - **Genel Bilgiler**: Şablon adı, açıklama, aktiflik durumu
   - **Prompt Ayarları**: Sistem promptu ve kullanıcı prompt şablonu
   - **Yazı Ayarları**: Dil, ton, yazım stili, kelime sayısı
   - **İçerik Yapısı**: Hangi bölümlerin ekleneceği
   - **SEO Ayarları**: SEO optimizasyonu ve anahtar kelimeler
   - **AI Model Ayarları**: Kullanılacak model ve parametreler
4. **Kaydet** butonuna tıklayın

### 2. Blog Yazısı Oluşturma

1. **Blog Posts** sayfasına gidin
2. **Yapay Zeka ile Oluştur** butonuna tıklayın
3. **Prompt Şablonu Kullan** seçeneğini işaretleyin (varsayılan olarak açık)
4. Açılır listeden bir şablon seçin
5. Şablon bilgilerini inceleyin
6. Kelime sayısını ayarlayın (şablonun varsayılan değeri otomatik gelir)
7. Konuyu/başlığı girin
8. **Oluştur** butonuna tıklayın
9. Yazı oluşturulduğunda bildirim alacaksınız

### 3. Varsayılan Şablonlar

Sistem 5 hazır şablonla gelir:

1. **SEO Optimizasyonlu Blog Yazısı** (Varsayılan)
   - 1200 kelime
   - SSS dahil (5 soru)
   - İstatistik ve örnekler içerir
   - GPT-4 Turbo

2. **Hızlı Blog Yazısı**
   - 700 kelime
   - Hızlı ve öz içerik
   - GPT-3.5 Turbo (ekonomik)

3. **Kapsamlı Rehber Yazısı**
   - 2000 kelime
   - Detaylı adım adım rehber
   - SSS dahil (8 soru)
   - GPT-4 Turbo

4. **İngilizce Blog Yazısı**
   - 1000 kelime
   - Profesyonel İngilizce içerik
   - GPT-4 Turbo

5. **Ürün İnceleme Yazısı**
   - 1500 kelime
   - Artılar/Eksiler analizi
   - Karşılaştırma içerir
   - GPT-4 Turbo

## Prompt Değişkenleri

### Sistem Promptunda Kullanılabilir:
- `{site_name}` - Site adı (GeneralSettings'den)
- `{language}` - Seçilen dil (Türkçe, English, vb.)
- `{tone}` - Seçilen ton
- `{writing_style}` - Seçilen yazım stili

### Kullanıcı Prompt Şablonunda Kullanılabilir:
- `{topic}` - Kullanıcının girdiği konu
- `{word_count}` - Hedef kelime sayısı

## Teknik Detaylar

### Veritabase
- Tablo: `ai_prompt_templates`
- Model: `App\Models\AiPromptTemplate`

### İlgili Dosyalar
- **Model**: `app/Models/AiPromptTemplate.php`
- **Resource**: `app/Filament/Resources/AiPromptTemplateResource.php`
- **Service**: `app/Services/OpenAIService.php`
- **Job**: `app/Jobs/CreateAIPost.php`
- **Action**: `app/Filament/Actions/CreatePostWithGPTAction.php`
- **Seeder**: `database/seeders/AiPromptTemplateSeeder.php`

### API Kullanımı
Sistem OpenAI API'sini kullanır. API anahtarınızı `/admin/manage-third-party` sayfasından ayarlayın.

## İpuçları

1. **Şablon Kopyalama**: Mevcut bir şablonu kopyalayarak hızlıca yeni varyasyonlar oluşturabilirsiniz
2. **Test Etme**: Yeni şablonları test ederken düşük kelime sayısı (500-700) kullanın
3. **GPT Model Seçimi**:
   - GPT-3.5 Turbo: Hızlı ve ekonomik, basit içerikler için ideal
   - GPT-4 Turbo: Yüksek kalite, detaylı ve kapsamlı içerikler için
   - GPT-4o: En yeni model, en iyi sonuçlar
4. **Temperature Ayarı**:
   - 0.3-0.5: Tutarlı, faktüel içerik için
   - 0.6-0.8: Dengeli, önerilen
   - 0.9-1.2: Yaratıcı, benzersiz içerik için
5. **Cache Sistemi**: Aynı konu ve ayarlarla tekrar içerik oluşturursanız, 5 dakika boyunca cache'den gelir

## Troubleshooting

### Şablon Görünmüyor
- Şablonun "Aktif" olduğundan emin olun
- Tarayıcı cache'ini temizleyin

### Yazı Oluşturulmuyor
- OpenAI API anahtarının doğru girildiğinden emin olun
- API kotanızı kontrol edin
- Log dosyalarını kontrol edin: `storage/logs/laravel.log`

### Beklenenden Farklı Sonuçlar
- Temperature değerini ayarlayın
- Prompt şablonunu daha spesifik hale getirin
- Farklı bir GPT modeli deneyin

## Gelecek Güncellemeler

- [ ] Şablonları içe/dışa aktarma özelliği
- [ ] Şablon önizleme özelliği
- [ ] Toplu yazı oluşturma
- [ ] Özel placeholder değişkenleri
- [ ] Şablon performans istatistikleri

---

**Not**: Bu sistem GPT-3.5 ve GPT-4 modellerini kullanır. Kullanım ücretleri OpenAI'a aittir.

