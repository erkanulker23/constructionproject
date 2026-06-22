# CSS ve JS Minify Sistemi Kullanım Kılavuzu

## 📋 Genel Bakış

Bu proje, production ortamında CSS ve JS dosyalarını otomatik olarak minify edip optimize edilmiş dosyaları kullanan bir sisteme sahiptir. Bu sistem sayesinde:

- **Sayfa yükleme hızı artar** (daha küçük dosya boyutları)
- **Bandwidth tasarrufu** sağlanır
- **SEO performansı** iyileşir
- **Development ve Production** ortamları otomatik olarak ayrılır

## 🚀 Hızlı Başlangıç

### 1. Gerekli Paketleri Kurma

İlk kurulumda gerekli Node.js paketlerini yükleyin:

```bash
npm install
```

Bu komut aşağıdaki paketleri yükler:
- `terser` - JavaScript minification
- `cssnano` - CSS minification
- `postcss` ve `postcss-cli` - CSS işleme

### 2. Minify İşlemini Çalıştırma

#### Tüm Dosyaları Build Etme (Production için önerilen)

```bash
npm run build-all
```

Bu komut sırasıyla:
1. Vite ile resources dosyalarını build eder
2. Public ve tema klasörlerindeki CSS dosyalarını minify eder
3. Public ve tema klasörlerindeki JS dosyalarını minify eder

#### Sadece CSS Minify

```bash
npm run minify-theme-css
```

#### Sadece JS Minify

```bash
npm run minify-theme-js
```

#### CSS ve JS Birlikte (Vite hariç)

```bash
npm run minify-theme
```

## 📁 Minify Edilen Dosyalar

Minify scriptleri aşağıdaki dizinlerdeki dosyaları işler:

### CSS Dosyaları
- `/public/css/*.css` → `/public/css/*.min.css`
- `/themes/awacms/default/public/css/*.css` → `/themes/awacms/default/public/css/*.min.css`

### JS Dosyaları
- `/public/js/*.js` → `/public/js/*.min.js`
- `/themes/awacms/default/public/js/*.js` → `/themes/awacms/default/public/js/*.min.js`

**Not:** Zaten `.min.css` veya `.min.js` uzantılı dosyalar otomatik olarak atlanır.

## 🔧 Blade Template'lerde Kullanım

### Helper Fonksiyonlar

Projede iki yeni helper fonksiyon eklenmiştir:

#### 1. `asset_minified()` - Public assets için

```php
<!-- CSS -->
<link rel="stylesheet" href="{{ asset_minified('css/style.css', true) }}" />

<!-- JS -->
<script src="{{ asset_minified('js/script.js', true) }}"></script>
```

#### 2. `theme_asset_minified()` - Tema assets için

```php
<!-- CSS -->
<link rel="stylesheet" href="{{ theme_asset_minified('css/newstyle.css', true) }}" />

<!-- JS -->
<script src="{{ theme_asset_minified('js/newmain.js', true) }}"></script>
```

### Parametreler

1. **$path** (string, gerekli): Asset dosya yolu
   - Örnek: `'css/style.css'` veya `'js/app.js'`

2. **$addVersion** (boolean, opsiyonel): Cache busting için versiyon ekle
   - `true`: Dosya değişiklik tarihine göre `?v=timestamp` ekler
   - `false`: Sadece dosya yolunu döndürür
   - Önerilen: Production'da `true`

### Nasıl Çalışır?

**Development Ortamında (APP_ENV=local)**
```php
asset_minified('css/style.css', true)
// Sonuç: /css/style.css?v=1696843200
```

**Production Ortamında (APP_ENV=production)**
```php
asset_minified('css/style.css', true)
// Minified dosya varsa: /css/style.min.css?v=1696843200
// Yoksa: /css/style.css?v=1696843200
```

## ⚙️ Vite Konfigürasyonu

`vite.config.js` dosyası production build için optimize edilmiştir:

### Özellikler

- **Terser ile minify**: JavaScript dosyaları maksimum sıkıştırma
- **Console log temizleme**: Production'da tüm console.log çağrıları kaldırılır
- **CSS minify**: Otomatik CSS optimizasyonu
- **Yorum kaldırma**: Tüm kod yorumları temizlenir
- **Chunk optimizasyonu**: Dosya boyutları optimize edilir

### Build Komutu

```bash
npm run build
# veya
npm run production
```

## 🌍 Production'a Deployment

### Adım 1: .env Dosyasını Güncelle

Production sunucusunda `.env` dosyasını kontrol edin:

```env
APP_ENV=production
APP_DEBUG=false
```

### Adım 2: Build Komutunu Çalıştır

Projeyi production'a göndermeden önce:

```bash
# Tüm dosyaları build et
npm run build-all

# Composer bağımlılıklarını optimize et
composer install --optimize-autoloader --no-dev

# Laravel cache'leri oluştur
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Adım 3: Dosyaları Sunucuya Yükle

Build edilen minified dosyaları (`.min.css` ve `.min.js`) sunucuya yüklemeyi unutmayın.

### Adım 4: Kontrol

Production sitesinde sayfa kaynağını görüntüleyin, asset URL'lerinin `.min` uzantılı olduğundan emin olun:

```html
<link rel="stylesheet" href="/themes/awacms/default/public/css/newstyle.min.css?v=1234567890" />
<script src="/themes/awacms/default/public/js/newmain.min.js?v=1234567890"></script>
```

## 📊 Build Script Detayları

### CSS Minify Script (`build-scripts/minify-css.js`)

**Özellikler:**
- Tüm yorumları kaldırır
- Whitespace'leri normalize eder
- Renk kodlarını optimize eder
- Font değerlerini küçültür
- Gradient'leri optimize eder
- İşlem sonrası boyut raporu gösterir

**Örnek Çıktı:**
```
🎨 CSS Minification Started...

📁 Processing: /Users/erkanulker/AWA-CMS/public/css
✅ style.css → style.min.css
   245.50KB → 198.32KB (19.23% azaltma)

📁 Processing: /Users/erkanulker/AWA-CMS/themes/awacms/default/public/css
✅ newstyle.css → newstyle.min.css
   1247.80KB → 892.45KB (28.48% azaltma)
⏭️  Skipping already minified: icon.min.css

✨ CSS Minification Completed!
```

### JS Minify Script (`build-scripts/minify-js.js`)

**Özellikler:**
- Dead code elimination (kullanılmayan kod kaldırma)
- Variable mangling (değişken adlarını kısaltma)
- Expression optimization
- Conditional optimization
- Loop optimization
- Safari 10 uyumluluğu
- İşlem sonrası boyut raporu

**Örnek Çıktı:**
```
⚡ JavaScript Minification Started...

📁 Processing: /Users/erkanulker/AWA-CMS/public/js
✅ app.js → app.min.js
   523.14KB → 287.92KB (44.95% azaltma)

📁 Processing: /Users/erkanulker/AWA-CMS/themes/awacms/default/public/js
✅ newmain.js → newmain.min.js
   425.67KB → 198.23KB (53.42% azaltma)
✅ google-review.js → google-review.min.js
   28.45KB → 12.34KB (56.62% azaltma)

✨ JavaScript Minification Completed!
```

## 🔍 Sorun Giderme

### Problem: Minified dosyalar yüklenmiyor

**Çözüm:**
1. `.env` dosyasında `APP_ENV=production` olduğundan emin olun
2. Minified dosyaların oluşturulduğunu kontrol edin:
   ```bash
   ls -la themes/awacms/default/public/css/*.min.css
   ls -la themes/awacms/default/public/js/*.min.js
   ```
3. Cache'leri temizleyin:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

### Problem: Build hatası alıyorum

**Çözüm:**
1. Node modüllerini yeniden yükleyin:
   ```bash
   rm -rf node_modules package-lock.json
   npm install
   ```
2. Terser ve cssnano'nun yüklü olduğundan emin olun:
   ```bash
   npm list terser cssnano
   ```

### Problem: JS dosyalarında syntax hatası

**Çözüm:**
Minify öncesi dosyalarınızın geçerli JavaScript olduğundan emin olun:
```bash
node -c themes/awacms/default/public/js/yourfile.js
```

### Problem: CSS özellikleri kayboldu

**Çözüm:**
cssnano bazı vendor prefix'leri kaldırabilir. Önemli prefix'ler için `autoprefixer` kullanın:
```bash
npm install -D autoprefixer
```

## 📈 Performans İpuçları

### 1. Gzip Kompresyon

Nginx veya Apache'de Gzip'i etkinleştirin:

**Nginx:**
```nginx
gzip on;
gzip_types text/css application/javascript;
gzip_min_length 1000;
```

**Apache (.htaccess):**
```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/css application/javascript
</IfModule>
```

### 2. Browser Caching

Asset dosyaları için uzun süreli cache ayarlayın:

**Nginx:**
```nginx
location ~* \.(css|js)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

### 3. CDN Kullanımı

Statik dosyaları CDN'e yükleyerek global erişim hızını artırın.

### 4. Lazy Loading

Kritik olmayan JavaScript dosyalarını lazy load edin:
```html
<script defer src="{{ theme_asset_minified('js/optional.js', true) }}"></script>
```

## 🔄 Güncelleme ve Bakım

### CSS/JS Değişikliğinden Sonra

1. Kaynak dosyayı düzenleyin (`.css` veya `.js`)
2. Minify komutunu çalıştırın:
   ```bash
   npm run minify-theme
   ```
3. Değişiklikleri test edin
4. Commit edin (hem kaynak hem minified dosyaları)

### Otomatik Build (CI/CD)

GitHub Actions, GitLab CI veya benzeri sistemlerde:

```yaml
# .github/workflows/deploy.yml örneği
- name: Build Assets
  run: |
    npm install
    npm run build-all
```

## 📞 Destek

Sorun yaşarsanız:
1. Bu dokümandaki sorun giderme bölümünü kontrol edin
2. `build-scripts/*.js` dosyalarındaki hata mesajlarını inceleyin
3. Laravel log dosyalarını kontrol edin: `storage/logs/laravel.log`

## 🎯 Özet Komutlar

```bash
# Development ortamında çalışırken
npm run dev

# Production build yapmak için
npm run build-all

# Sadece tema assets'lerini minify
npm run minify-theme

# Laravel cache'leri temizle
php artisan optimize:clear

# Laravel cache'leri oluştur (production)
php artisan optimize
```

---

**Not:** Bu sistem sayesinde production ortamında sayfa yükleme hızınız önemli ölçüde artacak ve kullanıcı deneyimi iyileşecektir. Development ortamında ise normal dosyalar kullanılarak debug işlemleri kolaylaşacaktır.

