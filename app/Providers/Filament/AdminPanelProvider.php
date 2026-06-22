<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Pages\Dashboard;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Comment\Providers\CommentPlugin;
use Modules\Faq\Providers\FaqPlugin;
use Modules\Features\Providers\FeaturesPlugin;
use Modules\Gallery\Providers\GalleryPlugin;
use Modules\GoogleReview\Providers\GoogleReviewPlugin;
use Modules\Group\Providers\GroupPlugin;
use Modules\Members\Providers\MemberPlugin;
use Modules\Menu\Providers\MenuPlugin;
use Modules\Newsletter\Providers\NewsletterPlugin;
use Modules\Plan\Providers\PlanPlugin;
use Modules\References\Providers\ReferencePlugin;
use Modules\Slide\Providers\SlidePlugin;
use Modules\Tag\Providers\TagPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Spatie\LaravelSettings\Exceptions\MissingSettings;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('300s')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(config('filament-spatie-laravel-translatable-plugin.default_locales')),
                FilamentSpatieRolesPermissionsPlugin::make(),
                SlidePlugin::make(),
                GroupPlugin::make(),
                TagPlugin::make(),
                CommentPlugin::make(),
                MenuPlugin::make(),
                NewsletterPlugin::make(),
                ReferencePlugin::make(),
                FaqPlugin::make(),
                MemberPlugin::make(),
                FeaturesPlugin::make(),
                PlanPlugin::make(),
                GalleryPlugin::make(),
                GoogleReviewPlugin::make(),
                SpotlightPlugin::make(),
            ])
            // ->middleware([
            //     \Shipu\WebInstaller\Middleware\RedirectIfNotInstalled::class,
            // ])
            ->authMiddleware([
                Authenticate::class,
            ])->userMenuItems([
                MenuItem::make()
                    ->label('Siteye Git')
                    ->url(fn (): string => url('/'))
                    ->icon('heroicon-o-globe-alt'),
                // ...
            ])
            ->defaultThemeMode(ThemeMode::Light);

        if (file_exists(storage_path('installed')) && Schema::hasTable('settings')) {
            try {
                $panel->brandName(app(\App\Settings\GeneralSettings::class)->site_name);
            } catch (MissingSettings $e) {
                // do nothing
            }

        }

        return $panel;
    }
}
