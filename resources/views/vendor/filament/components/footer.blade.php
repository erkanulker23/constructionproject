

{{ \Filament\Facades\Filament::renderHook('footer.before') }}

<div class="filament-footer flex items-center justify-center">
    {{ \Filament\Facades\Filament::renderHook('footer.start') }}

    @if (config('filament.layout.footer.should_show_logo'))
        <a
            href="https://awapanel.com"
            target="_blank"
            rel="noopener noreferrer"
            class="hover:text-primary-500 transition"
        >
                Awa Panel
        </a>&nbsp;Tüm Hakları Saklıdır! Copyright © {{ date('Y') }}
    @endif

    {{ \Filament\Facades\Filament::renderHook('footer.end') }}
</div>

{{ \Filament\Facades\Filament::renderHook('footer.after') }}

