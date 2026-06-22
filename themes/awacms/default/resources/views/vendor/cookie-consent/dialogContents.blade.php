{{--<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-2">
    <div class="max-w-7xl mx-auto px-6">
        <div class="p-2 rounded-lg bg-yellow-100">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 items-center hidden md:inline">
                    <p class="ml-3 text-black cookie-consent__message">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                </div>
                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">
                    <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>--}}


{{-- js-cookie-consent cookie-message class kaldırılmamalı! --}}
<div class="js-cookie-consent cookie-message text-center">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Sol Kısım: Resim ve Yazı -->
        <div class="cookie-content-text align-items-center text-left ">
            <img src="https://img.icons8.com/carbon-copy/100/cookie.png" alt="Cookie Icon"
            class="img-fluid" style="width: 60px; height: auto; margin-right: 15px;">
            <span>{!! $cookieConsentText !!}</span>
        </div>

        <!-- Sağ Kısım: Butonlar -->
        <div class="cookie-btn">
            @if($cookieConsentPageUrl)
            <a href="{{ $cookieConsentPageUrl }}" class="btn btn-primary" aria-label="btn">
                <span>
                    <span class="" data-text="Çerez Politikası">
                        Çerez Politikası
                    </span>
                </span>
            </a>
            @endif
            {{-- js-cookie-consent-agree class kaldırılmamalı! --}}
            <a href="#" class="js-cookie-consent-agree btn btn-primary" data-accept-btn aria-label="text">
                <span>
                    <span class="" data-text="{{ trans('cookie-consent::texts.agree') }}">
                        {{ trans('cookie-consent::texts.agree') }}
                    </span>
                </span>
            </a>
        </div>
    </div>
</div>


