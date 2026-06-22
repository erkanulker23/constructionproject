<?php

namespace App\Filament\Resources\FormResource\RelationManagers;

use App\Models\FormField;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FieldsRelationManager extends RelationManager
{
    protected static string $relationship = 'fields';

    protected static ?string $title = 'Form Alanları';

    protected static ?string $recordTitleAttribute = 'label';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Alan Tipi')
                            ->options(FormField::FIELD_TYPES)
                            ->required()
                            ->live()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('name')
                            ->label('Alan Adı (İngilizce, alt çizgi ile)')
                            ->required()
                            ->regex('/^[a-z_]+$/')
                            ->helperText('Örnek: first_name, email_address')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('label')
                            ->label('Etiket')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('width')
                            ->label('Genişlik')
                            ->options(function (Forms\Get $get) {
                                $framework = data_get($get('../settings'), 'ui_framework', 'tailwind');
                                if ($framework === 'bootstrap') {
                                    return [
                                        'col-12' => '12 / 12 (col-12)',
                                        'col-6' => '6 / 12 (col-6)',
                                        'col-4' => '4 / 12 (col-4)',
                                        'col-3' => '3 / 12 (col-3)',
                                    ];
                                }
                                return [
                                    'full' => 'Tam Genişlik',
                                    'half' => 'Yarım Genişlik',
                                    'third' => 'Üçte Bir',
                                ];
                            })
                            ->live()
                            ->default('full')
                            ->required(),

                        Forms\Components\TextInput::make('order')
                            ->label('Sıra')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('placeholder')
                            ->label('Placeholder')
                            ->maxLength(255)
                            ->visible(fn (Forms\Get $get) => in_array($get('type'), ['text', 'textarea', 'email', 'number', 'phone', 'url'])),

                        Forms\Components\Textarea::make('help_text')
                            ->label('Yardım Metni')
                            ->rows(2)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('default_value')
                            ->label('Varsayılan Değer')
                            ->maxLength(255),

                        Forms\Components\Toggle::make('required')
                            ->label('Zorunlu')
                            ->default(false),

                        // Seçim alanları için seçenekler
                        Forms\Components\Repeater::make('options')
                            ->label('Seçenekler')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Etiket')
                                    ->required(),
                                Forms\Components\TextInput::make('value')
                                    ->label('Değer')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->visible(fn (Forms\Get $get) => in_array($get('type'), ['select', 'radio', 'checkbox']))
                            ->columnSpanFull()
                            ->defaultItems(0),

                        // Rating için min/max
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('settings.min')
                                    ->label('Minimum Değer')
                                    ->numeric()
                                    ->default(1),
                                Forms\Components\TextInput::make('settings.max')
                                    ->label('Maximum Değer')
                                    ->numeric()
                                    ->default(5),
                            ])
                            ->columns(2)
                            ->visible(fn (Forms\Get $get) => in_array($get('type'), ['rating', 'scale', 'slider'])),

                        // Dosya yükleme ayarları
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Select::make('settings.accept')
                                    ->label('Kabul Edilen Dosya Tipleri')
                                    ->multiple()
                                    ->options([
                                        'image/*' => 'Resimler',
                                        'application/pdf' => 'PDF',
                                        'application/msword' => 'Word',
                                        'application/vnd.ms-excel' => 'Excel',
                                        '.zip,.rar' => 'Arşiv',
                                    ]),
                                Forms\Components\TextInput::make('settings.max_size')
                                    ->label('Maximum Dosya Boyutu (MB)')
                                    ->numeric()
                                    ->default(5),
                            ])
                            ->columns(2)
                            ->visible(fn (Forms\Get $get) => in_array($get('type'), ['file', 'image'])),

                        // HTML İçerik
                        Forms\Components\RichEditor::make('settings.html_content')
                            ->label('HTML İçerik')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'html')
                            ->columnSpanFull(),

                        // Başlık
                        Forms\Components\Select::make('settings.heading_level')
                            ->label('Başlık Seviyesi')
                            ->options([
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                            ])
                            ->default('h3')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'heading'),

                        // Validation Rules
                        Forms\Components\TagsInput::make('validation_rules')
                            ->label('Doğrulama Kuralları')
                            ->helperText('Laravel validation kuralları (örn: min:3, max:255, regex:/[A-Z]/)')
                            ->columnSpanFull(),

                        // Conditional Logic
                        Forms\Components\KeyValue::make('conditional_logic')
                            ->label('Koşullu Mantık')
                            ->helperText('Alan adı ve beklenen değer girin')
                            ->keyLabel('Alan Adı')
                            ->valueLabel('Değer')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable()
                    ->width('50px'),

                Tables\Columns\TextColumn::make('label')
                    ->label('Etiket')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Alan Adı')
                    ->searchable()
                    ->copyable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('type_name')
                    ->label('Tip')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text', 'textarea' => 'gray',
                        'email', 'phone' => 'info',
                        'select', 'radio', 'checkbox' => 'warning',
                        'file', 'image' => 'success',
                        default => 'primary',
                    }),

                Tables\Columns\IconColumn::make('required')
                    ->label('Zorunlu')
                    ->boolean(),

                Tables\Columns\TextColumn::make('width')
                    ->label('Genişlik')
                    ->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Alan Tipi')
                    ->options(FormField::FIELD_TYPES),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Yeni Alan Ekle')
                    ->icon('heroicon-o-plus')
                    ->mutateFormDataUsing(function (array $data): array {
                        // Options array'i düzenle
                        if (isset($data['options']) && is_array($data['options'])) {
                            $options = [];
                            foreach ($data['options'] as $option) {
                                $options[$option['value']] = $option['label'];
                            }
                            $data['options'] = $options;
                        }
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        // Options'ı repeater için uygun formata çevir
                        if (isset($data['options']) && is_array($data['options'])) {
                            $options = [];
                            foreach ($data['options'] as $value => $label) {
                                $options[] = ['value' => $value, 'label' => $label];
                            }
                            $data['options'] = $options;
                        }
                        return $data;
                    })
                    ->mutateFormDataUsing(function (array $data): array {
                        // Form gönderiminde options'ı düzelt
                        if (isset($data['options']) && is_array($data['options'])) {
                            $options = [];
                            foreach ($data['options'] as $option) {
                                $options[$option['value']] = $option['label'];
                            }
                            $data['options'] = $options;
                        }
                        return $data;
                    }),

                Tables\Actions\DeleteAction::make(),

                Tables\Actions\Action::make('duplicate')
                    ->label('Çoğalt')
                    ->icon('heroicon-o-document-duplicate')
                    ->action(function (FormField $record) {
                        $newField = $record->replicate();
                        $newField->name = $record->name . '_copy';
                        $newField->order = $record->order + 1;
                        $newField->save();
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order')
            ->defaultSort('order');
    }
}

