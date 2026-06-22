{{-- Kalyon İnşaat — Hero Slider (variant_3) --}}
@php
    $kalSlides = ($slider && isset($slider->slides)) ? $slider->slides : collect();
@endphp
@if($kalSlides && count($kalSlides))
<section data-hero id="anasayfa" class="{{ $wrapperClass }}" style="position:relative;height:100vh;min-height:680px;overflow:hidden;background:#2B2926;font-family:'Manrope',system-ui,sans-serif">
  @foreach($kalSlides as $i => $slide)
    @php $kalImg = $slide->imageUrl ?: $slide->mobileImageUrl; @endphp
    <div data-slide style="position:absolute;inset:0;opacity:{{ $i === 0 ? 1 : 0 }};transition:opacity 1.2s ease">
      @if($kalImg)
        <img src="{{ $kalImg }}" alt="{{ $slide->title }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;{{ $i === 0 ? 'animation:kenburns 8s ease-out forwards' : '' }}">
      @endif
    </div>
  @endforeach

  <div style="position:absolute;inset:0;background:linear-gradient(90deg,rgba(28,26,23,.92) 0%,rgba(28,26,23,.66) 38%,rgba(28,26,23,.28) 68%,rgba(28,26,23,.5) 100%);pointer-events:none"></div>
  <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(28,26,23,.5) 0%,transparent 22%,transparent 60%,rgba(28,26,23,.65) 100%);pointer-events:none"></div>

  <div class="kal-pad" style="position:relative;z-index:5;height:100%;max-width:1340px;margin:0 auto;padding:0 52px;display:flex;flex-direction:column;justify-content:center">
    @php $kalFirst = $kalSlides[0]; @endphp
    <div style="max-width:60ch">
      <div data-reveal style="opacity:0;display:flex;align-items:center;gap:14px;margin-bottom:26px"><span style="width:42px;height:1px;background:#D97757"></span><span style="font-size:12.5px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#EAC1AC">{{ $kalFirst->subtitle ?: 'Mühendislik · Altyapı · Yaşam' }}</span></div>
      @if($kalFirst->title)
        <h1 data-reveal style="opacity:0;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;color:{{ $kalFirst->titleColor ?: '#fff' }};font-size:clamp(44px,5.6vw,98px);line-height:1.02;letter-spacing:-.03em;max-width:15ch;text-shadow:0 2px 40px rgba(0,0,0,.4)">{!! $kalFirst->title !!}</h1>
      @endif
      @if($kalFirst->content)
        <p data-reveal data-rd="0.18" style="opacity:0;margin-top:28px;max-width:48ch;font-size:clamp(15px,1.15vw,18px);line-height:1.7;color:{{ $kalFirst->contentColor ?: 'rgba(255,255,255,.82)' }};text-shadow:0 1px 20px rgba(0,0,0,.4)">{!! $kalFirst->content !!}</p>
      @endif
      @if($kalFirst->ctaText && $kalFirst->linkUrl)
        <div data-reveal data-rd="0.3" style="opacity:0;margin-top:40px">
          <a href="{{ $kalFirst->linkUrl }}" style="display:inline-flex;align-items:center;gap:13px;background:#D97757;color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 32px;text-decoration:none;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="background:#C2603F;transform:translateY(-3px);box-shadow:0 16px 40px rgba(217,119,87,.4)">{{ $kalFirst->ctaText }} <span style="font-size:16px">→</span></a>
        </div>
      @endif
    </div>
  </div>

  @if(count($kalSlides) > 1)
    <div style="position:absolute;left:52px;bottom:38px;z-index:6;display:flex;align-items:center;gap:12px">
      @foreach($kalSlides as $i => $slide)
        <div data-hdot style="width:{{ $i === 0 ? '34px' : '14px' }};height:4px;border-radius:3px;background:{{ $i === 0 ? '#D97757' : 'rgba(255,255,255,.4)' }};cursor:pointer;transition:all .4s"></div>
      @endforeach
    </div>
  @endif
  <div style="position:absolute;right:52px;bottom:36px;z-index:6;display:flex;align-items:center;gap:14px">
    <span style="font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.7)">Kaydırın</span>
    <span style="position:relative;width:40px;height:1px;background:rgba(255,255,255,.4);overflow:hidden"><span style="position:absolute;top:0;left:0;width:14px;height:1px;background:#fff;animation:scrolldot 2s ease-in-out infinite"></span></span>
  </div>
</section>
@endif
