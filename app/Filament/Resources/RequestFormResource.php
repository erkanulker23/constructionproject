<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestFormResource\Pages;
use App\Filament\Resources\RequestFormResource\RelationManagers;
use App\Models\RequestForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class RequestFormResource extends Resource
{
    protected static ?string $model = RequestForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    private const STATUS_PENDING = 'Beklemede';
    private const STATUS_CONTACTED = 'İletişime Geçildi';

    public static function getModelLabel(): string
    {
        return 'Talep Formu';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Talep Formları';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->disabled()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->disabled()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->disabled()
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('request_date')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('topic')
                    ->disabled()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => self::STATUS_PENDING,
                        'contacted' => self::STATUS_CONTACTED,
                    ])
                    ->required()
                    ->default('pending'),
                Forms\Components\TextArea::make('message')
                    ->columnSpanFull()
                    ->disabled()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('topic')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'pending' => self::STATUS_PENDING,
                            'contacted' => self::STATUS_CONTACTED,
                        };
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('request_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Görüntüle')
                    ->modalHeading('Talep Formu Detayları')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Ad Soyad'),
                        Forms\Components\TextInput::make('email')
                            ->label('E-posta'),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telefon'),
                        Forms\Components\DateTimePicker::make('request_date')
                            ->label('Talep Tarihi'),
                        Forms\Components\TextInput::make('topic')
                            ->label('Konu'),
                        Forms\Components\Placeholder::make('status')
                            ->label('Durum')
                            ->content(fn (RequestForm $record): string => match ($record->status) {
                                'pending' => self::STATUS_PENDING,
                                'contacted' => self::STATUS_CONTACTED,
                                default => $record->status,
                            }),
                        Forms\Components\Textarea::make('message')
                            ->label('Mesaj')
                            ->columnSpanFull()
                            ->rows(5),
                    ]),
                Tables\Actions\Action::make('updateStatus')
                    ->label('Durum Güncelle')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->modalHeading('Durum Güncelle')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Durum')
                            ->options([
                                'pending' => self::STATUS_PENDING,
                                'contacted' => self::STATUS_CONTACTED,
                            ])
                            ->required()
                            ->default(fn (RequestForm $record): string => $record->status),
                    ])
                    ->action(function (RequestForm $record, array $data): void {
                        $record->update([
                            'status' => $data['status'],
                        ]);
                    })
                    ->successNotificationTitle('Durum başarıyla güncellendi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequestForms::route('/'),
            'create' => Pages\CreateRequestForm::route('/create'),
            'edit' => Pages\EditRequestForm::route('/{record}/edit'),
        ];
    }
}
