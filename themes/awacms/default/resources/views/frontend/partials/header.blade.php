@php
    $navLinks = [
        ['label' => 'Ana Sayfa', 'url' => route('home')],
        ['label' => 'Hakkımızda', 'url' => route('page.show', 'hakkimizda')],
        ['label' => 'Hizmetler', 'url' => route('services.index')],
        ['label' => 'Projeler', 'url' => route('projects.index')],
        ['label' => 'Kataloglar', 'url' => route('catalogs.index')],
        ['label' => 'Haberler', 'url' => route('blog.index')],
    ];
    $siteName = kalyon_setting('site_name', 'KALYON İNŞAAT');
    $logo = kalyon_setting('header_logo');
@endphp

<header class="kal-header" data-header style="z-index:100;display:flex;align-items:center;justify-content:space-between;padding:18px 52px">
    <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:12px;text-decoration:none">
        @if($logo)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="{{ $siteName }}" style="height:40px;width:auto">
        @else
            <span class="kal-logo-box" style="display:inline-flex;width:42px;height:42px;align-items:center;justify-content:center;border:1.5px solid #fff;font-family:'Plus Jakarta Sans';font-weight:800;font-size:20px">K</span>
            <span class="kal-logo-text" style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:18px;letter-spacing:2px">KALYON <span class="kal-logo-accent">İNŞAAT</span></span>
        @endif
    </a>

    <nav class="kal-desktop-nav" style="display:flex;align-items:center;gap:30px">
        @foreach($navLinks as $link)
            <a class="kal-nav-link" href="{{ $link['url'] }}" style="font-size:16.5px;font-weight:600;text-decoration:none">{{ $link['label'] }}</a>
        @endforeach
        <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:11px;font-size:15px;font-weight:700;color:#fff;background:linear-gradient(135deg,#E08366,#C2603F);padding:13px 14px 13px 26px;border-radius:40px;text-decoration:none;box-shadow:0 8px 22px rgba(217,119,87,.35);transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="transform:translateY(-2px);box-shadow:0 14px 32px rgba(217,119,87,.5)">
            İletişime Geç
            <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,.18);font-size:14px"><i class="fa-solid fa-phone-volume"></i></span>
        </a>
    </nav>

    {{-- mobil burger --}}
    <button class="kal-burger" data-menu-toggle aria-label="Menü" style="display:none;align-items:center;justify-content:center;width:46px;height:46px;background:#2B2926;border:none;cursor:pointer;flex-direction:column;gap:5px;padding:0">
        <span style="display:block;width:20px;height:2px;background:#fff"></span>
        <span style="display:block;width:20px;height:2px;background:#fff"></span>
        <span style="display:block;width:20px;height:2px;background:#fff"></span>
    </button>
</header>

{{-- mobil menü paneli --}}
<div data-mobile-menu data-open="0" style="position:fixed;top:0;right:0;bottom:0;width:min(82vw,360px);background:#2B2926;z-index:1300;transform:translateX(100%);display:flex;flex-direction:column;padding:80px 36px 40px;gap:6px;box-shadow:-20px 0 60px rgba(0,0,0,.4)">
    <button data-menu-toggle aria-label="Kapat" style="position:absolute;top:24px;right:28px;background:none;border:none;color:#fff;font-size:30px;cursor:pointer;line-height:1">×</button>
    @foreach($navLinks as $link)
        <a href="{{ $link['url'] }}" style="font-family:'Plus Jakarta Sans';font-size:19px;font-weight:700;color:#fff;text-decoration:none;padding:14px 0;border-bottom:1px solid rgba(255,255,255,.1)">{{ $link['label'] }}</a>
    @endforeach
    <a href="{{ route('contact.index') }}" style="margin-top:20px;display:inline-flex;align-items:center;justify-content:center;gap:9px;font-size:14px;font-weight:700;color:#fff;background:#D97757;padding:16px;text-decoration:none">✆ İletişime Geç</a>
</div>
