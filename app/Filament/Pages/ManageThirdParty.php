<?php

namespace App\Filament\Pages;

use App\Settings\ThirdPartySettings;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class ManageThirdParty extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static string $settings = ThirdPartySettings::class;

    protected static ?string $navigationLabel = 'Üçüncü Parti Ayarları';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('open_ai_section')
                ->heading('OpenAI')
                ->description('API anahtarınız ChatGPT\'yi kullanmak için gereklidir.')
                ->schema([
                    TextInput::make('openai_api_key')
                        ->label('API Anahtarı')
                        ->placeholder('API Anahtarı')
                        ->hint('API anahtarınızı buraya yapıştırın.')
                        ->password()
                        ->revealable(),
                    Actions::make([
                        Action::make('go_to_openai_docs')
                            ->label('OpenAI Oluştur')
                            ->url('https://platform.openai.com/api-keys')
                            ->openUrlInNewTab(),
                    ]),
                ]),
        ];
    }
}
