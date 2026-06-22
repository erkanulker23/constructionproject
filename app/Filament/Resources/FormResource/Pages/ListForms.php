<?php

namespace App\Filament\Resources\FormResource\Pages;

use App\Filament\Resources\FormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForms extends ListRecords
{
    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('builder')
                ->label('Form Oluşturucu')
                ->icon('heroicon-o-wrench-screwdriver')
                ->url(route('forms.builder'))
                ->openUrlInNewTab()
                ->color('success'),

            Actions\CreateAction::make()
                ->label('Yeni Form Oluştur'),
        ];
    }
}

