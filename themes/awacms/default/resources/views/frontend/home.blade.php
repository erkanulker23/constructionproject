@extends('frontend.layouts.app')

@php
    use App\Models\Project;
    use App\Models\ServicePost;
    use App\Models\BlogPost;

    $fallbackImages = [
        'https://baynetinsaat.com.tr/uploads/2023/08/VADI-min.jpg',
        'https://baynetinsaat.com.tr/uploads/2023/09/2-2-scaled.jpg',
        'https://dapyapi.com.tr/dapyapi/cdn/uploads/000006593_dap-45yil-dap-web.webp',
    ];

    try { $featured = Project::published()->featured()->orderBy('order_column')->take(3)->get(); } catch (\Throwable $e) { $featured = collect(); }
    if ($featured->isEmpty()) { try { $featured = Project::published()->orderBy('order_column')->take(3)->get(); } catch (\Throwable $e) { $featured = collect(); } }

    try { $projects = Project::published()->orderBy('order_column')->take(6)->get(); } catch (\Throwable $e) { $projects = collect(); }
    try { $services = ServicePost::query()->published()->take(4)->get(); } catch (\Throwable $e) { $services = collect(); }
    try { $posts = BlogPost::query()->published()->latest('publish_at')->take(3)->get(); } catch (\Throwable $e) { $posts = collect(); }
    try { $references = \Modules\References\Entities\Reference::query()->orderBy('order_column')->get(); } catch (\Throwable $e) { $references = collect(); }

    $heroSlides = $featured->count() ? $featured->map(fn($p) => $p->cover_url)->all() : $fallbackImages;

    $serviceIcons = ['◰','⛭','◈','⌂'];
    $serviceFallback = [
        ['Mimari Tasarım','Konseptten uygulamaya özgün, işlevsel mimari çözümler.'],
        ['İnşaat & Mühendislik','Anahtar teslim, deprem güvenli ve denetimli üretim.'],
        ['Proje Yönetimi','Bütçe, zaman ve kalitede şeffaf raporlamayla yönetim.'],
        ['Gayrimenkul & Satış','Satış, kiralama ve yatırım danışmanlığında tam destek.'],
    ];
@endphp

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff;position:relative;overflow-x:hidden">

  {{-- ===== HERO SLIDER ===== --}}
  <section data-hero id="anasayfa" style="position:relative;height:100vh;min-height:720px;overflow:hidden;background:#2B2926">
    @foreach($heroSlides as $i => $img)
      <div data-slide style="position:absolute;inset:0;opacity:{{ $i === 0 ? 1 : 0 }};transition:opacity 1.2s ease">
        <img src="{{ $img }}" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;{{ $i === 0 ? 'animation:kenburns 8s ease-out forwards' : '' }}">
      </div>
    @endforeach
    <div style="position:absolute;inset:0;background:linear-gradient(90deg,rgba(28,26,23,.92) 0%,rgba(28,26,23,.66) 38%,rgba(28,26,23,.28) 68%,rgba(28,26,23,.5) 100%);pointer-events:none"></div>
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(28,26,23,.5) 0%,transparent 22%,transparent 60%,rgba(28,26,23,.65) 100%);pointer-events:none"></div>

    <div class="kal-hero-grid kal-pad" style="position:relative;z-index:5;height:100%;max-width:1340px;margin:0 auto;padding:0 52px;display:grid;grid-template-columns:1.08fr .92fr;gap:60px;align-items:center">
      <div style="padding-top:60px">
        <div data-reveal style="opacity:0;display:flex;align-items:center;gap:14px;margin-bottom:26px"><span style="width:42px;height:1px;background:#D97757"></span><span style="font-size:12.5px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#EAC1AC">Mühendislik · Altyapı · Yaşam</span></div>
        <h1 style="font-family:'Plus Jakarta Sans';font-weight:800;color:#fff;font-size:clamp(44px,5.6vw,98px);line-height:1.02;letter-spacing:-.03em;max-width:15ch;text-shadow:0 2px 40px rgba(0,0,0,.4)">
          <span data-reveal style="display:block;opacity:0">Geleceği bugünden</span>
          <span data-reveal style="display:block;opacity:0" data-rd="0.12"><span style="color:#E0A488">inşa</span> ediyoruz</span>
        </h1>
        <p data-reveal data-rd="0.22" style="opacity:0;margin-top:28px;max-width:48ch;font-size:clamp(15px,1.15vw,18px);line-height:1.7;color:rgba(255,255,255,.82);text-shadow:0 1px 20px rgba(0,0,0,.4)">1976'dan bu yana konut, villa ve ticari yapılarda uluslararası kalite standartlarıyla projeler geliştiriyoruz.</p>
        <div data-reveal data-rd="0.32" style="opacity:0;display:flex;gap:16px;margin-top:40px;flex-wrap:wrap">
          <a href="{{ route('projects.index') }}" style="display:inline-flex;align-items:center;gap:13px;background:#D97757;color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 32px;text-decoration:none;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="background:#C2603F;transform:translateY(-3px);box-shadow:0 16px 40px rgba(217,119,87,.4)">Projelerimizi Keşfedin <span style="font-size:16px">→</span></a>
          <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:13px;background:rgba(255,255,255,.08);color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 32px;text-decoration:none;border:1px solid rgba(255,255,255,.3);backdrop-filter:blur(6px);transition:all .35s" style-hover="background:rgba(255,255,255,.16);transform:translateY(-3px)">Ücretsiz Danışmanlık</a>
        </div>
      </div>

      <div class="kal-hero-panel" data-reveal data-rd="0.2" style="opacity:0;align-self:center">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding:0 4px">
          <span style="font-size:11.5px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#EAC1AC">Öne Çıkan Projeler</span>
          <a href="{{ route('projects.index') }}" style="font-size:12px;font-weight:700;letter-spacing:.5px;color:#fff;text-decoration:none;opacity:.85;transition:opacity .3s" style-hover="opacity:1">Tümünü Gör →</a>
        </div>
        <div style="display:flex;flex-direction:column;gap:12px">
          @forelse($featured as $i => $p)
            <a href="{{ route('projects.show', $p->slug) }}" data-fcard style="display:flex;align-items:center;gap:18px;padding:14px;background:rgba(43,41,38,{{ $i === 0 ? '.62' : '.4' }});backdrop-filter:blur(14px);border:1px solid {{ $i === 0 ? 'rgba(217,119,87,.5)' : 'rgba(255,255,255,.1)' }};border-radius:14px;cursor:pointer;text-decoration:none;transition:all .4s cubic-bezier(.16,1,.3,1)" style-hover="transform:translateX(4px);border-color:rgba(217,119,87,.5)">
              <div style="flex:none;width:92px;height:72px;border-radius:10px;overflow:hidden;background:#0c1018"><img src="{{ $p->cover_thumb }}" alt="{{ $p->title }}" style="width:100%;height:100%;object-fit:cover"></div>
              <div style="flex:1;min-width:0"><h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#fff;line-height:1.15">{{ $p->title }}</h3><div style="font-size:12.5px;color:rgba(255,255,255,.66);margin-top:4px">{{ $p->location }}</div></div>
              <span style="flex:none;color:#E0A488;font-size:18px;transition:transform .4s">→</span>
            </a>
          @empty
            @foreach(['Vadi Zekeriyaköy' => 'Sarıyer, İstanbul', 'Baynet Terrace' => 'Balıkesir', 'DAP Rezidans' => 'İstanbul'] as $t => $loc)
              <div data-fcard style="display:flex;align-items:center;gap:18px;padding:14px;background:rgba(43,41,38,.5);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,.1);border-radius:14px">
                <div style="flex:none;width:92px;height:72px;border-radius:10px;overflow:hidden;background:#0c1018"><img src="{{ $fallbackImages[$loop->index] ?? $fallbackImages[0] }}" alt="" style="width:100%;height:100%;object-fit:cover"></div>
                <div style="flex:1;min-width:0"><h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#fff;line-height:1.15">{{ $t }}</h3><div style="font-size:12.5px;color:rgba(255,255,255,.66);margin-top:4px">{{ $loc }}</div></div>
                <span style="flex:none;color:#E0A488;font-size:18px">→</span>
              </div>
            @endforeach
          @endforelse
        </div>
      </div>
    </div>

    <div style="position:absolute;left:52px;bottom:38px;z-index:6;display:flex;align-items:center;gap:12px">
      @foreach($heroSlides as $i => $img)
        <div data-hdot style="width:{{ $i === 0 ? '34px' : '14px' }};height:4px;border-radius:3px;background:{{ $i === 0 ? '#D97757' : 'rgba(255,255,255,.4)' }};cursor:pointer;transition:all .4s"></div>
      @endforeach
    </div>
    <div style="position:absolute;right:52px;bottom:36px;z-index:6;display:flex;align-items:center;gap:14px">
      <span style="font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.7)">Kaydırın</span>
      <span style="position:relative;width:40px;height:1px;background:rgba(255,255,255,.4);overflow:hidden"><span style="position:absolute;top:0;left:0;width:14px;height:1px;background:#fff;animation:scrolldot 2s ease-in-out infinite"></span></span>
    </div>
  </section>

  {{-- ===== HAKKIMIZDA ===== --}}
  <section id="hakkimizda" class="kal-section" style="position:relative;background:#fff;padding:130px 0">
    <div class="kal-pad kal-split" style="max-width:1340px;margin:0 auto;padding:0 52px;display:grid;grid-template-columns:1.05fr 1fr;gap:76px;align-items:center">
      <div>
        <div data-reveal style="opacity:0;display:flex;align-items:center;gap:13px;margin-bottom:24px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">Hakkımızda</span></div>
        <h2 data-reveal style="opacity:0;font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(32px,3.5vw,56px);line-height:1.06;letter-spacing:-.02em;color:#2B2926;max-width:17ch">Yaratıcı mimarlık, güçlü yapılar</h2>
        <p data-reveal style="opacity:0;margin-top:26px;font-size:17px;line-height:1.78;color:#5A5349;max-width:52ch">1976'dan bu yana İstanbul ve Balıkesir'de konut, villa ve ticari yapılarda uluslararası kalite standartlarıyla projeler geliştiriyoruz. Mühendislik gücümüzü dijital tasarım ve sürdürülebilir vizyonla birleştiriyoruz.</p>
        <div data-reveal class="kal-stat-grid" style="opacity:0;display:grid;grid-template-columns:1fr 1fr;gap:1px;margin-top:46px;background:#E6E0D4;border:1px solid #E6E0D4">
          <div style="background:#fff;padding:28px 26px"><div style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:44px;line-height:1;color:#2B2926"><span data-count="250">0</span><span style="color:#D97757">+</span></div><div style="margin-top:8px;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#8B8273">Tamamlanan Proje</div></div>
          <div style="background:#fff;padding:28px 26px"><div style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:44px;line-height:1;color:#2B2926"><span data-count="48">0</span></div><div style="margin-top:8px;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#8B8273">Yıllık Tecrübe</div></div>
          <div style="background:#fff;padding:28px 26px"><div style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:44px;line-height:1;color:#2B2926"><span data-count="12">0</span></div><div style="margin-top:8px;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#8B8273">Devam Eden Proje</div></div>
          <div style="background:#fff;padding:28px 26px"><div style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:44px;line-height:1;color:#2B2926"><span data-count="9000">0</span><span style="color:#D97757">+</span></div><div style="margin-top:8px;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#8B8273">Mutlu Aile</div></div>
        </div>
      </div>
      <div data-reveal style="opacity:0;position:relative">
        <div style="position:absolute;left:-12px;top:-12px;width:30px;height:30px;border-left:2px solid #D97757;border-top:2px solid #D97757;z-index:3"></div>
        <div style="position:absolute;right:-12px;bottom:-12px;width:30px;height:30px;border-right:2px solid #D97757;border-bottom:2px solid #D97757;z-index:3"></div>
        <div style="position:relative;aspect-ratio:4/5;overflow:hidden;background:#F0EAE0"><img src="{{ $fallbackImages[1] }}" alt="" style="width:100%;height:100%;object-fit:cover"><div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 55%,rgba(43,41,38,.6))"></div><div style="position:absolute;left:24px;bottom:22px"><div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#EAC1AC">Genel Merkez</div><div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:21px;color:#fff;margin-top:5px">İstanbul · 1976</div></div></div>
        <div style="position:absolute;top:-26px;right:-22px;width:132px;height:132px;background:#2B2926;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 24px 50px rgba(43,41,38,.28)"><span style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:34px;color:#fff;line-height:1">48</span><span style="font-size:9px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#EAC1AC;margin-top:6px;text-align:center">Yıllık<br>Tecrübe</span></div>
      </div>
    </div>
  </section>

  {{-- ===== HİZMETLER ÖZETİ ===== --}}
  <section class="kal-section" style="position:relative;background:#fff;padding:0 0 130px">
    <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
      <div data-reveal style="opacity:0;display:flex;align-items:flex-end;justify-content:space-between;gap:30px;flex-wrap:wrap;margin-bottom:40px">
        <div>
          <div style="display:flex;align-items:center;gap:13px;margin-bottom:18px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">Hizmetlerimiz</span></div>
          <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(30px,3.2vw,52px);line-height:1.05;letter-spacing:-.02em;color:#2B2926;max-width:16ch">Uçtan uca çözüm ortağınız</h2>
        </div>
        <a href="{{ route('services.index') }}" style="font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;border-bottom:2px solid #D97757;padding-bottom:5px">Tüm Hizmetler →</a>
      </div>
      <div class="kal-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px">
        @forelse($services as $i => $s)
          <a data-reveal data-rd="{{ $i * 0.06 }}" href="{{ route('services.show', $s->slug) }}" style="opacity:0;text-decoration:none;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:32px 28px;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s,border-color .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1);border-color:#D97757">
            <div style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;background:#2B2926;color:#fff;font-size:22px;border-radius:11px;margin-bottom:22px">{{ $serviceIcons[$i % 4] }}</div>
            <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:19px;color:#2B2926">{{ $s->title }}</h3>
            <p style="margin-top:10px;font-size:14px;line-height:1.65;color:#6A6358">{{ \Illuminate\Support\Str::limit(strip_tags($s->short_description), 90) }}</p>
          </a>
        @empty
          @foreach($serviceFallback as $i => $sf)
            <a data-reveal data-rd="{{ $i * 0.06 }}" href="{{ route('services.index') }}" style="opacity:0;text-decoration:none;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:32px 28px;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s,border-color .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1);border-color:#D97757">
              <div style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;background:#2B2926;color:#fff;font-size:22px;border-radius:11px;margin-bottom:22px">{{ $serviceIcons[$i] }}</div>
              <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:19px;color:#2B2926">{{ $sf[0] }}</h3>
              <p style="margin-top:10px;font-size:14px;line-height:1.65;color:#6A6358">{{ $sf[1] }}</p>
            </a>
          @endforeach
        @endforelse
      </div>
    </div>
  </section>

  {{-- ===== PROJELER ===== --}}
  <section id="projeler" class="kal-section" style="position:relative;background:#F4EFE7;padding:130px 0">
    <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
      <div data-reveal style="opacity:0;display:flex;align-items:flex-end;justify-content:space-between;gap:30px;flex-wrap:wrap;margin-bottom:40px">
        <div>
          <div style="display:flex;align-items:center;gap:13px;margin-bottom:18px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">Projelerimiz</span></div>
          <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(32px,3.5vw,56px);line-height:1.04;letter-spacing:-.02em;color:#2B2926;max-width:16ch">Hayata geçirdiğimiz eserler</h2>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
          <button data-filterbtn="all" style="font-family:'Manrope',sans-serif;font-size:13px;font-weight:700;letter-spacing:.3px;color:#fff;background:#2B2926;border:1px solid #2B2926;padding:11px 22px;border-radius:30px;cursor:pointer;transition:all .3s">Tümü</button>
          <button data-filterbtn="devam" style="font-family:'Manrope',sans-serif;font-size:13px;font-weight:700;letter-spacing:.3px;color:#2B2926;background:transparent;border:1px solid #C9BFAD;padding:11px 22px;border-radius:30px;cursor:pointer;transition:all .3s">Devam Eden</button>
          <button data-filterbtn="tamam" style="font-family:'Manrope',sans-serif;font-size:13px;font-weight:700;letter-spacing:.3px;color:#2B2926;background:transparent;border:1px solid #C9BFAD;padding:11px 22px;border-radius:30px;cursor:pointer;transition:all .3s">Tamamlanan</button>
        </div>
      </div>

      <div data-grid class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
        @forelse($projects as $i => $p)
          <article data-reveal data-rd="{{ ($i % 3) * 0.08 }}" data-card data-cat="{{ $p->category }} {{ $p->status }}" style="opacity:0;position:relative;aspect-ratio:4/3.4;overflow:hidden;border-radius:14px;background:#0c1018;cursor:pointer">
            <a href="{{ route('projects.show', $p->slug) }}" style="position:absolute;inset:0;z-index:6" aria-label="{{ $p->title }}"></a>
            <div style="position:absolute;inset:0;transition:transform 1s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.06)"><img src="{{ $p->cover_url }}" alt="{{ $p->title }}" style="width:100%;height:100%;object-fit:cover"></div>
            <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(5,12,22,.1) 0%,transparent 32%,rgba(5,12,22,.92))"></div>
            @if($p->category)<div style="position:absolute;top:16px;left:16px;font-size:10.5px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:#fff;background:rgba(43,41,38,.85);backdrop-filter:blur(4px);padding:7px 13px;border-radius:20px">{{ ucfirst($p->category) }}</div>@endif
            <div style="position:absolute;top:16px;right:16px;display:flex;gap:7px">
              <span style="font-size:9.5px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:#fff;background:{{ $p->status_color }};padding:7px 11px;border-radius:20px">{{ $p->status_label }}</span>
              @if($p->is_sale)<span style="font-size:9.5px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:#fff;background:#D63A3A;padding:7px 11px;border-radius:20px">Satışta</span>@endif
            </div>
            <div style="position:absolute;left:22px;right:22px;bottom:22px"><h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:24px;color:#fff;line-height:1.1">{{ $p->title }}</h3><div style="font-size:13px;color:rgba(255,255,255,.72);margin-top:6px">{{ $p->location }}</div></div>
          </article>
        @empty
          <p style="color:#6A6358">Yakında projelerimiz burada listelenecek.</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- ===== SÜRDÜRÜLEBİLİRLİK ===== --}}
  <section id="surdurulebilirlik" class="kal-section" style="position:relative;background:#fff;padding:130px 0;overflow:hidden">
    <div class="kal-pad kal-split" style="max-width:1340px;margin:0 auto;padding:0 52px;display:grid;grid-template-columns:1fr 1fr;gap:76px;align-items:center">
      <div>
        <div data-reveal style="opacity:0;display:flex;align-items:center;gap:13px;margin-bottom:22px"><span style="width:34px;height:1px;background:#1F9D6B"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#1F9D6B">Sürdürülebilirlik</span></div>
        <h2 data-reveal style="opacity:0;font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(32px,3.4vw,52px);line-height:1.06;letter-spacing:-.02em;color:#2B2926;max-width:15ch">Yeşil mühendislik, kalıcı miras</h2>
        <p data-reveal style="opacity:0;margin-top:24px;font-size:16.5px;line-height:1.78;color:#5A5349;max-width:48ch">Yenilenebilir enerji yatırımları ve düşük karbonlu inşaatla gelecek nesillere yaşanabilir bir dünya bırakıyoruz.</p>
        <div data-reveal style="opacity:0;display:flex;gap:46px;margin-top:42px">
          <div><div style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:46px;color:#2B2926;line-height:1"><span data-count="2.4" data-dec="1">0</span><span style="color:#1F9D6B"> GW</span></div><div style="margin-top:6px;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#8B8273">Yenilenebilir</div></div>
          <div><div style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:46px;color:#2B2926;line-height:1"><span data-count="1.8" data-dec="1">0</span><span style="color:#1F9D6B"> Mt</span></div><div style="margin-top:6px;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#8B8273">CO₂ Azaltımı</div></div>
        </div>
      </div>
      <div data-reveal style="opacity:0;background:#F4EFE7;border:1px solid #E6E0D4;padding:38px 36px">
        <div style="font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#1F9D6B;margin-bottom:26px">Çevresel Performans</div>
        <div style="display:flex;flex-direction:column;gap:24px">
          @foreach(['Yenilenebilir enerji oranı' => 68, 'İnşaat atığı geri dönüşümü' => 82, 'Su geri kazanımı' => 74] as $label => $val)
            <div><div style="display:flex;justify-content:space-between;margin-bottom:9px"><span style="color:#1F1C18;font-weight:600;font-size:14.5px">{{ $label }}</span><span style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:16px;color:#1F9D6B">{{ $val }}%</span></div><div style="height:6px;background:#EBE4D8;border-radius:4px;overflow:hidden"><div data-bar="{{ $val }}" style="height:100%;width:0;background:linear-gradient(90deg,#1F9D6B,#37C98C);border-radius:4px;transition:width 1.3s cubic-bezier(.16,1,.3,1)"></div></div></div>
          @endforeach
        </div>
        <div style="display:flex;gap:9px;flex-wrap:wrap;margin-top:28px;padding-top:24px;border-top:1px solid #E6E0D4">
          <span style="font-size:11px;font-weight:600;color:#2B2926;border:1px solid #CFE3D8;background:#F0F8F3;padding:7px 13px">LEED GOLD</span>
          <span style="font-size:11px;font-weight:600;color:#2B2926;border:1px solid #CFE3D8;background:#F0F8F3;padding:7px 13px">ISO 14001</span>
          <span style="font-size:11px;font-weight:600;color:#2B2926;border:1px solid #CFE3D8;background:#F0F8F3;padding:7px 13px">NET SIFIR 2050</span>
        </div>
      </div>
    </div>
  </section>

  {{-- ===== HABERLER ===== --}}
  <section id="haberler" class="kal-section" style="position:relative;background:#F4EFE7;padding:130px 0">
    <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
      <div data-reveal style="opacity:0;display:flex;align-items:flex-end;justify-content:space-between;gap:30px;flex-wrap:wrap;margin-bottom:40px">
        <div>
          <div style="display:flex;align-items:center;gap:13px;margin-bottom:18px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">Haberler</span></div>
          <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(30px,3.2vw,52px);line-height:1.05;letter-spacing:-.02em;color:#2B2926;max-width:16ch">Gündemden son gelişmeler</h2>
        </div>
        <a href="{{ route('blog.index') }}" style="font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;border-bottom:2px solid #D97757;padding-bottom:5px">Tüm Haberler →</a>
      </div>
      <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
        @forelse($posts as $i => $post)
          <a data-reveal data-rd="{{ $i * 0.08 }}" href="{{ route('blog.post.show', $post->slug) }}" style="opacity:0;text-decoration:none;background:#fff;border:1px solid #E6E0D4;border-radius:14px;overflow:hidden;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1)">
            <div style="aspect-ratio:16/10;overflow:hidden;background:#0c1018"><img src="{{ $post->getFirstMediaUrl('listing_image') ?: $post->getFirstMediaUrl('details_image') ?: $fallbackImages[$i % 3] }}" alt="{{ $post->title }}" style="width:100%;height:100%;object-fit:cover"></div>
            <div style="padding:24px 24px 28px">
              <div style="font-size:11.5px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#D97757">{{ optional($post->publish_at)->translatedFormat('d F Y') }}</div>
              <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:19px;color:#2B2926;margin-top:10px;line-height:1.25">{{ $post->title }}</h3>
              <p style="margin-top:10px;font-size:14px;line-height:1.6;color:#6A6358">{{ \Illuminate\Support\Str::limit(strip_tags($post->short_description), 100) }}</p>
            </div>
          </a>
        @empty
          <p style="color:#6A6358">Yakında haberlerimiz burada yer alacak.</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- ===== REFERANSLAR ===== --}}
  @if($references->count())
  <section class="kal-section" style="position:relative;background:#fff;padding:90px 0">
    <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
      <div data-reveal style="opacity:0;text-align:center;margin-bottom:40px"><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#8B8273">Bizimle Çalışanlar</span></div>
      <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:50px">
        @foreach($references as $ref)
          <img src="{{ $ref->logo }}" alt="{{ $ref->title }}" style="height:46px;width:auto;object-fit:contain;filter:grayscale(1);opacity:.6;transition:all .3s" style-hover="filter:grayscale(0);opacity:1">
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- ===== İLETİŞİM CTA ===== --}}
  <section id="iletisim" class="kal-section" style="position:relative;background:#2B2926;padding:110px 0;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(217,119,87,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(217,119,87,.05) 1px,transparent 1px);background-size:54px 54px;-webkit-mask-image:radial-gradient(80% 70% at 50% 40%,#000,transparent);mask-image:radial-gradient(80% 70% at 50% 40%,#000,transparent);pointer-events:none"></div>
    <div class="kal-pad" style="position:relative;max-width:900px;margin:0 auto;padding:0 52px;text-align:center">
      <h2 data-reveal style="opacity:0;font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(30px,3.6vw,56px);line-height:1.08;letter-spacing:-.02em;color:#fff">Bir sonraki projenizi birlikte inşa edelim</h2>
      <p data-reveal data-rd="0.1" style="opacity:0;margin:22px auto 0;max-width:52ch;font-size:17px;line-height:1.7;color:rgba(255,255,255,.72)">Uzman ekibimizle ücretsiz keşif ve danışmanlık için bizimle iletişime geçin.</p>
      <div data-reveal data-rd="0.2" style="opacity:0;margin-top:38px;display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
        <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:12px;background:#D97757;color:#fff;font-weight:700;font-size:14px;padding:18px 34px;text-decoration:none;transition:all .35s" style-hover="background:#C2603F;transform:translateY(-3px)">İletişime Geçin →</a>
        <a href="{{ route('catalogs.index') }}" style="display:inline-flex;align-items:center;gap:12px;background:rgba(255,255,255,.08);color:#fff;font-weight:700;font-size:14px;padding:18px 34px;text-decoration:none;border:1px solid rgba(255,255,255,.3);transition:all .35s" style-hover="background:rgba(255,255,255,.16);transform:translateY(-3px)">Katalogları İncele</a>
      </div>
    </div>
  </section>

</div>
@endsection
