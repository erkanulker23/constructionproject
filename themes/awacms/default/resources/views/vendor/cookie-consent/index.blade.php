{{--   ###############################################################################################################   --}}
{{--   Eğer bu dosya resource/vendor altında ise lütfen kopyalayıp tema klasörünüzün altına taşıyarak düzenleme yapın!   --}}
{{--   ###############################################################################################################   --}}
@if($cookieConsentConfig['enabled'] && ! $alreadyConsentedWithCookies)

    @include('cookie-consent::dialogContents')

    <script>

        window.laravelCookieConsent = (function () {

            const COOKIE_VALUE = 1;
            const COOKIE_DOMAIN = '{{ config('session.domain') ?? request()->getHost() }}';

            function consentWithCookies() {
                setCookie('{{ $cookieConsentConfig['cookie_name'] }}', COOKIE_VALUE, {{ $cookieConsentConfig['cookie_lifetime'] }});
                hideCookieDialog();
            }

            function cookieExists(name) {
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
            }

            function hideCookieDialog() {
                const dialogs = document.getElementsByClassName('js-cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }

            function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value
                    + ';expires=' + date.toUTCString()
                    + ';domain=' + COOKIE_DOMAIN
                    + ';path=/{{ config('session.secure') ? ';secure' : null }}'
                    + '{{ config('session.same_site') ? ';samesite='.config('session.same_site') : null }}';
            }

            if (cookieExists('{{ $cookieConsentConfig['cookie_name'] }}')) {
                hideCookieDialog();
            }

            const buttons = document.getElementsByClassName('js-cookie-consent-agree');

            for (let i = 0; i < buttons.length; ++i) {
                buttons[i].addEventListener('click', consentWithCookies);
            }

            return {
                consentWithCookies: consentWithCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();
    </script>
    <style>
/* Çerez bildirimini varsayılan olarak gizleme */

/* Minimalist Cookie Consent */
.js-cookie-consent {
  display: none;
  position: fixed;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  max-width: 95%;
  width: 500px;
  background: rgb(0, 0, 0);
  color: #ffffff;
  padding: 12px 16px;
  border-radius: 8px;
  z-index: 10000;
  font-size: 13px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(10px);
}

.js-cookie-consent.cookie-message {
  display: block;
}

.cookie-content-text {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 8px;
}

.cookie-content-text img {
  width: 20px;
  height: 20px;
  filter: brightness(0) invert(1);
}

.cookie-content-text span {
  flex: 1;
  font-size: 12px;
  line-height: 1.4;
  color: #ffffff;
}

.cookie-btn {
  display: flex;
  gap: 8px;
  justify-content: flex-end;
}

.cookie-btn .btn-primary {
  background-color: #0d6efd;
  color: #ffffff;
  border: none;
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.cookie-btn .btn-primary:hover {
  background-color: #0b5ed7;
}

/* Mobil responsive */
@media (max-width: 768px) {
  .js-cookie-consent {
    bottom: 10px;
    left: 10px;
    right: 10px;
    transform: none;
    width: auto;
    max-width: none;
    padding: 10px 12px;
  }

  .cookie-content-text {
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
  }

  .cookie-content-text span {
    font-size: 11px;
  }

  .cookie-btn {
    justify-content: center;
    margin-top: 8px;
  }

  .cookie-btn .btn-primary {
    padding: 8px 16px;
    font-size: 12px;
  }
}

/* Küçük ekranlarda (mobil) düzenleme */
@media (max-width: 768px) {
  .js-cookie-consent {
    width: 100%; /* Ekran boyutuna göre genişlik */
    padding: 10px;
  }

  /* Mobilde resim ve yazıyı üstte, butonları altta hizala */
  .js-cookie-consent .d-flex {
    flex-direction: column; /* Mobilde flex yönünü dikey yap */
    align-items: center; /* Ortalamayı sağla */
  }

  .cookie-content-text {
    margin-bottom: 20px; /* Resim ve yazı ile butonlar arasında boşluk */
  }

  .cookie-btn {
    width: 100%; /* Butonlar için tam genişlik */
    justify-content: center; /* Butonları ortala */
  }

  .cookie-btn .btn-primary {
    width: 100%; /* Butonları %100 genişlikte yap */
  }
}



    </style>
@endif
