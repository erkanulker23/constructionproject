# AWACMS

## Installation

Windows/Laragon: enable sqlite3 and pdo_sqlite extensions and restart Apache.
Linux/Ubuntu: sudo apt install php8.2-sqlite3 and restart Apache
Enable: GMP Extension in PHP

```bash
git clone ...
cd awacms
cp .env.example .env
composer i
```

## Forge Deploy Script
1. Open OPCache settings and enable OPCache
2. Open PHP settings and enable GMP extension
3. Open Nginx settings and enable HTTP/2
4. 
```bash
git checkout package-lock.json
git pull origin $FORGE_SITE_BRANCH

$FORGE_COMPOSER install --no-interaction --prefer-dist --optimize-autoloader

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

if [ -f artisan ]; then
    $FORGE_PHP artisan migrate --force
    npm install
    npm run build-all
    $FORGE_PHP artisan cache:clear
    $FORGE_PHP artisan view:clear
    $FORGE_PHP artisan queue:restart
    $FORGE_PHP artisan icons:cache
    $FORGE_PHP artisan optimize
    $FORGE_PHP artisan filament:cache-components
fi
```

## Development 

You can use these commands to start the project.

```bash
npm i
npm run dev
composer i
php artisan migrate:fresh --seed
```

## CSS & JS Minification

Proje production ortamında otomatik CSS ve JS minify sistemi kullanır. Detaylı bilgi için `MINIFY_KULLANIM.md` dosyasına bakın.

### Hızlı Komutlar

```bash
# Development ortamında
npm run dev

# Production build (Vite + Minify)
npm run build-all

# Sadece tema assets minify
npm run minify-theme

# Sadece CSS minify
npm run minify-theme-css

# Sadece JS minify
npm run minify-theme-js
```

### Blade Template Kullanımı

```blade
{{-- CSS --}}
<link rel="stylesheet" href="{{ theme_asset_minified('css/style.css', true) }}" />

{{-- JS --}}
<script src="{{ theme_asset_minified('js/app.js', true) }}"></script>
```

Production ortamında (APP_ENV=production) otomatik olarak `.min.css` ve `.min.js` dosyaları yüklenir.

## Menu

If you want to make a menu, you can do it in the admin panel. Also you can add properties to menu items for make item as mega menu.

## S3 Bucket

There is documentation of AWS in the Notion.

You have to add these lines to your bucket policy and cors.
Policy:
```
{
    "Version": "2008-10-17",
    "Id": "Policy1380877762691",
    "Statement": [
        {
            "Sid": "Stmt1380877761162",
            "Effect": "Allow",
            "Principal": {
                "AWS": "*"
            },
            "Action": "s3:GetObject",
            "Resource": "arn:aws:s3:::awa-local/*"
        }
    ]
}
```

CORS:
```
[
    {
        "AllowedHeaders": [
            "*"
        ],
        "AllowedMethods": [
            "GET",
            "HEAD",
            "PUT"
        ],
        "AllowedOrigins": [
            "http://awapanel.dev",
            "https://awapanel.dev",
            "https://www.awapanel.dev",
            "https://test.awapanel.com",
            "https://www.test.awapanel.com"
        ],
        "ExposeHeaders": [
            "Access-Control-Allow-Origin"
        ]
    }
]
```

## HSTS Header

add this line to add hsts support to your website.

```diff
add_header X-Frame-Options "SAMEORIGIN";
add_header X-XSS-Protection "1; mode=block";
add_header X-Content-Type-Options "nosniff";
+ add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;
```
