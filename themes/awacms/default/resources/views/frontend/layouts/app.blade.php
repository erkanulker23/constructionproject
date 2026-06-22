@php
    use Illuminate\Support\Facades\Storage;
    use Spatie\LaravelSettings\Exceptions\MissingSettings;

    try {
        $generalSettings = app(\App\Settings\GeneralSettings::class);
        $selectedFont = $generalSettings->google_font_family ?? 'Inter';
        $fontUrl = $generalSettings->google_font_url ?? null;
        $favicon = $generalSettings->favicon ?? null;
        $appleTouchIcon = $generalSettings->apple_touch_icon ?? null;
    } catch (MissingSettings $e) {
        // Settings not configured yet, use defaults
        $generalSettings = null;
        $selectedFont = 'Inter';
        $fontUrl = null;
        $favicon = null;
        $appleTouchIcon = null;
    }

    // Fallback URL if not set
    if (!$fontUrl) {
        $fontUrl = 'https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $selectedFont) . ':wght@300;400;500;600;700;800&display=swap';
    }
@endphp
@extends('layouts.master')
@section('head')
<!-- Console Override - Disable console messages -->
<script>
(function() {
    // Simple console override - disable common console methods
    if (window.console) {
        console.log = function() {};
        console.warn = function() {};
        console.error = function() {};
        console.info = function() {};
        console.debug = function() {};
        console.trace = function() {};
        console.group = function() {};
        console.groupEnd = function() {};
        console.groupCollapsed = function() {};
        console.clear = function() {};
        console.table = function() {};
        console.time = function() {};
        console.timeEnd = function() {};
        console.timeLog = function() {};
        console.dir = function() {};
        console.dirxml = function() {};
    }
})();
</script>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <!-- favicon icon -->
@if($favicon)
<link rel="shortcut icon" href="{{ Storage::url($favicon) }}">
@else
<link rel="shortcut icon" href="/favicon.ico">
@endif

@if($appleTouchIcon)
<link rel="apple-touch-icon" href="{{ Storage::url($appleTouchIcon) }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ Storage::url($appleTouchIcon) }}">
@endif

<!-- google fonts preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Load selected Google Font from admin settings -->
<link href="{{ $fontUrl }}" rel="stylesheet">

    @php
    // TODO: add versions for css and js files
    @endphp


    <!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

@if(config('app.env') === 'production')
<link rel="stylesheet" href="{{ asset('themes/awacms/default/public/css/newstyle.min.css') }}?v={{ config('app.version', '1.0') }}" />
<link rel="stylesheet" href="{{ asset('themes/awacms/default/public/css/icon.min.css') }}?v={{ config('app.version', '1.0') }}" />
<link rel="stylesheet" href="{{ asset('themes/awacms/default/public/css/google-review.min.css') }}?v={{ config('app.version', '1.0') }}" />
@else
<link rel="stylesheet" href="{{ asset('themes/awacms/default/public/css/newstyle.css') }}" />
<link rel="stylesheet" href="{{ asset('themes/awacms/default/public/css/icon.css') }}" />
<link rel="stylesheet" href="{{ asset('themes/awacms/default/public/css/google-review.css') }}" />
@endif

<style>
    /* Apply selected Google Font to body */
    body, html {
        font-family: "{{ $selectedFont }}", sans-serif;
    }

    /* Apply to text elements only - EXCLUDE all icon-related elements */
    p:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    h1:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    h2:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    h3:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    h4:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    h5:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    h6:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    a:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    span:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    div:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    button:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    input, textarea, select,
    label:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    li:not([class*="icon"]):not([class*="fa"]):not([class*="bi"]):not([class*="ti"]):not([class*="feather"]),
    .text, .content, .description, .title, .subtitle {
        font-family: "{{ $selectedFont }}", sans-serif;
    }

    /* DO NOT touch icon elements AT ALL - let them use their original font-family from CSS files */
    /* This section is intentionally empty - we simply DON'T apply any font to icons */

    /* Preserve specific font classes */
    .alt-font, .primary-font {
        font-family: "{{ $selectedFont }}", sans-serif;
    }
</style>



<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Global JavaScript Error Prevention - Load Early -->
<script>
// Override appendChild to prevent null reference errors
(function() {
    const originalAppendChild = Element.prototype.appendChild;

    Element.prototype.appendChild = function(child) {
        if (!this || this === null) {
            // Silent mode - no console warnings
            return child;
        }
        return originalAppendChild.call(this, child);
    };

    // Also override for document fragments
    const originalFragmentAppendChild = DocumentFragment.prototype.appendChild;
    DocumentFragment.prototype.appendChild = function(child) {
        if (!this || this === null) {
            // Silent mode - no console warnings
            return child;
        }
        return originalFragmentAppendChild.call(this, child);
    };

    // Override getElementById to return a safe object when element not found
    const originalGetElementById = document.getElementById;
    document.getElementById = function(id) {
        const element = originalGetElementById.call(document, id);
        if (!element) {
            // Silent mode - no console warnings in production
            // Return a safe object that won't cause errors
            return {
                appendChild: function() {
                    // Silent - no console output
                    return null;
                },
                innerHTML: '',
                style: {},
                classList: {
                    add: function() {},
                    remove: function() {},
                    contains: function() { return false; }
                },
                addEventListener: function() {},
                querySelector: function() { return null; },
                querySelectorAll: function() { return []; },
                getAttribute: function() { return null; },
                setAttribute: function() {},
                removeAttribute: function() {}
            };
        }
        return element;
    };

    // Override querySelector to return a safe object when element not found
    const originalQuerySelector = document.querySelector;
    document.querySelector = function(selector) {
        const element = originalQuerySelector.call(document, selector);
        if (!element) {
            return {
                appendChild: function() { return null; },
                innerHTML: '',
                style: {},
                classList: {
                    add: function() {},
                    remove: function() {},
                    contains: function() { return false; }
                },
                addEventListener: function() {},
                querySelector: function() { return null; },
                querySelectorAll: function() { return []; },
                getAttribute: function() { return null; },
                setAttribute: function() {},
                removeAttribute: function() {}
            };
        }
        return element;
    };

    // Override querySelectorAll to always return a safe array
    const originalQuerySelectorAll = document.querySelectorAll;
    document.querySelectorAll = function(selector) {
        try {
            return originalQuerySelectorAll.call(document, selector) || [];
        } catch(e) {
            return [];
        }
    };

    // Global error handler for uncaught errors
    window.addEventListener('error', function(event) {
        if (event.message && event.message.includes('appendChild')) {
            // Silent mode - prevent error but don't log
            event.preventDefault();
            return false;
        }
    });
})();
</script>



@endsection
@section('body')
    @include('frontend.partials.header')
    @yield('content')
    @include('frontend.partials.footer')
    @include('frontend.components.mobile_contact_bar')
    <div class="scroll-progress d-none d-xxl-block">
        <div class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Yukarı</span><span class="scroll-line"><span class="scroll-point"></span></span>
    </div>
@endsection
@prepend('scripts')

@if(config('app.env') === 'production')
<script defer="defer" type="text/javascript" src="{{ asset('themes/awacms/default/public/js/newmain.min.js') }}?v={{ config('app.version', '1.0') }}"></script>
<script defer="defer" type="text/javascript" src="{{ asset('themes/awacms/default/public/js/google-review.min.js') }}?v={{ config('app.version', '1.0') }}"></script>
@else
<script defer="defer" type="text/javascript" src="{{ asset('themes/awacms/default/public/js/newmain.js') }}"></script>
<script defer="defer" type="text/javascript" src="{{ asset('themes/awacms/default/public/js/google-review.js') }}"></script>
@endif

@endprepend
