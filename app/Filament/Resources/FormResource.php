<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormResource\Pages;
use App\Filament\Resources\FormResource\RelationManagers\FieldsRelationManager;
use App\Filament\Resources\FormResource\RelationManagers\SubmissionsRelationManager;
use App\Models\Form;
use Filament\Forms;
use Filament\Forms\Form as FilamentForm;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FormResource extends Resource
{
    protected static ?string $model = Form::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Form Oluşturucu';

    protected static ?string $modelLabel = 'Form';

    protected static ?string $pluralModelLabel = 'Formlar';

    protected static ?string $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 10;

    public static function form(FilamentForm $form): FilamentForm
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Genel Ayarlar')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Form Adı')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                        Forms\Components\TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true),

                                        Forms\Components\TextInput::make('title')
                                            ->label('Başlık')
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\Textarea::make('description')
                                            ->label('Açıklama')
                                            ->rows(3)
                                            ->columnSpanFull(),

                        Forms\Components\Select::make('settings.ui_framework')
                            ->label('UI Framework')
                            ->options([
                                'tailwind' => 'Tailwind CSS',
                                'bootstrap' => 'Bootstrap',
                            ])
                            ->default('tailwind')
                            ->live(),

                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Aktif')
                                            ->default(true),
                                    ])
                                    ->columns(2),
                            ]),

                        Forms\Components\Tabs\Tab::make('Form Ayarları')
                            ->schema([
                                Forms\Components\Section::make('Gönderim Ayarları')
                                    ->schema([
                                        Forms\Components\TextInput::make('submit_button_text')
                                            ->label('Gönder Butonu Metni')
                                            ->default('Gönder')
                                            ->maxLength(255),

                                        Forms\Components\Textarea::make('success_message')
                                            ->label('Başarı Mesajı')
                                            ->default('Formunuz başarıyla gönderildi. Teşekkür ederiz!')
                                            ->rows(2),

                                        Forms\Components\TextInput::make('redirect_url')
                                            ->label('Yönlendirme URL')
                                            ->url()
                                            ->helperText('Başarılı gönderim sonrası yönlendirilecek sayfa (opsiyonel)')
                                            ->maxLength(255),
                                    ])
                                    ->columns(1),

                                Forms\Components\Section::make('Erişim Ayarları')
                                    ->schema([
                                        Forms\Components\Toggle::make('save_submissions')
                                            ->label('Gönderimleri Kaydet')
                                            ->default(true)
                                            ->helperText('Form gönderimlerini veritabanına kaydet'),

                                        Forms\Components\Toggle::make('allow_multiple_submissions')
                                            ->label('Çoklu Gönderime İzin Ver')
                                            ->default(true)
                                            ->helperText('Aynı kullanıcının birden fazla gönderim yapmasına izin ver'),

                                        Forms\Components\Toggle::make('require_login')
                                            ->label('Giriş Gerekli')
                                            ->default(false)
                                            ->helperText('Formu doldurmak için giriş yapmayı zorunlu tut'),
                                    ])
                                    ->columns(3),
                            ]),

                        Forms\Components\Tabs\Tab::make('E-posta Bildirimleri')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Toggle::make('send_email_notification')
                                            ->label('E-posta Bildirimi Gönder')
                                            ->default(false)
                                            ->live()
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('notification_email')
                                            ->label('Bildirim E-posta Adresi')
                                            ->email()
                                            ->maxLength(255)
                                            ->visible(fn (Forms\Get $get) => $get('send_email_notification'))
                                            ->required(fn (Forms\Get $get) => $get('send_email_notification')),

                                        Forms\Components\TextInput::make('notification_subject')
                                            ->label('E-posta Konusu')
                                            ->maxLength(255)
                                            ->default('Yeni Form Gönderimi')
                                            ->visible(fn (Forms\Get $get) => $get('send_email_notification')),
                                    ])
                                    ->columns(2),
                            ]),

                        Forms\Components\Tabs\Tab::make('Özelleştirme')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Textarea::make('custom_css')
                                            ->label('Özel CSS')
                                            ->rows(6)
                                            ->helperText('Form için özel CSS kodları')
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('custom_js')
                                            ->label('Özel JavaScript')
                                            ->rows(6)
                                            ->helperText('Form için özel JavaScript kodları')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Embed Kodları')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Placeholder::make('embed_info')
                                            ->label('')
                                            ->content('Formu web sitenize eklemek için aşağıdaki kodlardan birini kullanabilirsiniz:')
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('embed_code')
                                            ->label('JavaScript Embed Kodu')
                                            ->default(fn ($record) => $record?->embed_code ?? '')
                                            ->rows(3)
                                            ->disabled()
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('iframe_code')
                                            ->label('iFrame Kodu')
                                            ->default(fn ($record) => $record?->iframe_code ?? '')
                                            ->rows(2)
                                            ->disabled()
                                            ->columnSpanFull(),

                                        Forms\Components\Placeholder::make('direct_url')
                                            ->label('Direkt URL')
                                            ->content(fn ($record) => $record ? route('forms.show', $record->slug) : 'Form kaydedildikten sonra görünecek')
                                            ->columnSpanFull(),
                                    ])
                                    ->visible(fn ($record) => $record !== null),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Form Adı')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('fields_count')
                    ->label('Alan Sayısı')
                    ->counts('fields')
                    ->sortable(),

                Tables\Columns\TextColumn::make('submissions_count')
                    ->label('Gönderim')
                    ->counts('submissions')
                    ->sortable()
                    ->badge()
                    ->color('success'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Durum')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Durum')
                    ->placeholder('Tümü')
                    ->trueLabel('Aktif')
                    ->falseLabel('Pasif'),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->label('Önizle')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Form $record) => route('forms.show', $record->slug))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('submissions')
                    ->label('Gönderimler')
                    ->icon('heroicon-o-inbox')
                    ->badge(fn (Form $record) => $record->submissions_count)
                    ->url(fn (Form $record) => FormResource::getUrl('submissions', ['record' => $record])),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            FieldsRelationManager::class,
            SubmissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
            'submissions' => Pages\FormSubmissions::route('/{record}/submissions'),
        ];
    }
}

