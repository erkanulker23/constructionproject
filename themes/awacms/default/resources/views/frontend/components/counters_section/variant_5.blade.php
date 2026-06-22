{{-- Kalyon İnşaat — İstatistik / Sayaç (variant_5) --}}
@php
    $kalDark = $bgColor && in_array(strtolower($bgColor), ['#2b2926','#1f1c18','#000','#000000']);
    $kalBg = $bgColor ?: '#F4EFE7';
    $kalTitleColor = $kalDark ? '#fff' : '#2B2926';
    $kalNumColor = $kalDark ? '#fff' : '#2B2926';
    $kalLabelColor = $kalDark ? 'rgba(255,255,255,.6)' : '#8B8273';
    $kalCardBg = $kalDark ? 'rgba(255,255,255,.04)' : '#fff';
    $kalBorder = $kalDark ? 'rgba(255,255,255,.1)' : '#E6E0D4';
@endphp
@if($counters && count($counters))
<section class="kal-section" style="position:relative;background:{{ $kalBg }};padding:110px 0;font-family:'Manrope',system-ui,sans-serif;@if($bgImage) background-image:url('{{ $bgImage }}');background-size:cover;background-position:center;@endif">
  <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
    @if($title || $subtitle)
      <div data-reveal style="opacity:0;text-align:center;margin-bottom:56px">
        @if($subtitle)
          <div style="display:inline-flex;align-items:center;gap:13px;margin-bottom:16px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">{{ $subtitle }}</span><span style="width:34px;height:1px;background:#D97757"></span></div>
        @endif
        @if($title)
          <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(30px,3.2vw,52px);line-height:1.06;letter-spacing:-.02em;color:{{ $kalTitleColor }};margin:0 auto;max-width:18ch">{{ $title }}</h2>
        @endif
      </div>
    @endif

    <div class="kal-stat-grid" style="display:grid;grid-template-columns:repeat({{ min(count($counters), 4) }},1fr);gap:1px;background:{{ $kalBorder }};border:1px solid {{ $kalBorder }}">
      @foreach($counters as $i => $counter)
        <div data-reveal data-rd="{{ ($i % 4) * 0.08 }}" style="opacity:0;background:{{ $kalCardBg }};padding:42px 30px;text-align:center">
          @if($counter->icon)
            <div style="width:50px;height:50px;margin:0 auto 18px;display:flex;align-items:center;justify-content:center;background:#2B2926;color:#fff;font-size:22px;border-radius:11px"><i class="{{ $counter->icon }}"></i></div>
          @endif
          <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(38px,4vw,52px);line-height:1;color:{{ $kalNumColor }}"><span data-count="{{ $counter->value }}">0</span><span style="color:#D97757">+</span></div>
          <div style="margin-top:12px;font-size:12px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:{{ $kalLabelColor }}">{{ $counter->title }}</div>
          @if($counter->description)
            <div style="margin-top:8px;font-size:13.5px;line-height:1.6;color:{{ $kalDark ? 'rgba(255,255,255,.5)' : '#6A6358' }}">{{ $counter->description }}</div>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
