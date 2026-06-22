<?php

namespace App\Filament\Resources\FormResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\FormSubmission;
use Illuminate\Database\Eloquent\Builder;

class SubmissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissions';

    protected static ?string $title = 'Gönderimler';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Placeholder::make('id')
                    ->label('ID')
                    ->content(fn ($record) => $record->id),

                Forms\Components\Placeholder::make('created_at')
                    ->label('Gönderim Tarihi')
                    ->content(fn ($record) => $record->created_at->format('d.m.Y H:i')),

                Forms\Components\Placeholder::make('ip_address')
                    ->label('IP Adresi')
                    ->content(fn ($record) => $record->ip_address),

                Forms\Components\Toggle::make('is_read')
                    ->label('Okundu'),

                Forms\Components\Textarea::make('notes')
                    ->label('Notlar')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('gray')
                    ->falseColor('primary')
                    ->sortable(),

                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarih')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Durum')
                    ->placeholder('Tümü')
                    ->trueLabel('Okundu')
                    ->falseLabel('Okunmadı'),
            ])
            ->headerActions([
                // Gönderimler sadece frontend'den oluşturulabilir
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading('Gönderim Detayı')
                    ->modalContent(fn (FormSubmission $record) => view('filament.resources.form-resource.pages.view-submission', ['submission' => $record]))
                    ->modalWidth('2xl'),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}

