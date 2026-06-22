<?php

namespace App\Filament\Resources\FormResource\Pages;

use App\Filament\Resources\FormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditForm extends EditRecord
{
    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('builder')
                ->label('Form Oluşturucu')
                ->icon('heroicon-o-wrench-screwdriver')
                ->url(fn () => route('forms.builder') . '?load=' . $this->record->id)
                ->openUrlInNewTab()
                ->color('success'),

            Actions\Action::make('preview')
                ->label('Önizle')
                ->icon('heroicon-o-eye')
                ->url(fn () => route('forms.show', $this->record->slug))
                ->openUrlInNewTab(),

            Actions\Action::make('submissions')
                ->label('Gönderimler')
                ->icon('heroicon-o-inbox')
                ->badge(fn () => $this->record->submissions_count)
                ->url(fn () => FormResource::getUrl('submissions', ['record' => $this->record])),

            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Form başarıyla güncellendi';
    }
}

