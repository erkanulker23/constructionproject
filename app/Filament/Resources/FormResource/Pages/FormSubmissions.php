<?php

namespace App\Filament\Resources\FormResource\Pages;

use App\Filament\Resources\FormResource;
use App\Models\FormSubmission;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormSubmissions extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = FormResource::class;

    protected static string $view = 'filament.resources.form-resource.pages.form-submissions';

    public function mount($record): void
    {
        $this->record = $record;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(FormSubmission::query()->where('form_id', $this->record->id))
            ->columns($this->getTableColumns())
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Durum')
                    ->placeholder('Tümü')
                    ->trueLabel('Okundu')
                    ->falseLabel('Okunmadı'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('created_from')
                            ->label('Başlangıç Tarihi'),
                        \Filament\Forms\Components\DatePicker::make('created_until')
                            ->label('Bitiş Tarihi'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Görüntüle')
                    ->modalHeading('Gönderim Detayı')
                    ->modalContent(fn (FormSubmission $record) => view('filament.resources.form-resource.pages.view-submission', ['submission' => $record]))
                    ->modalWidth('2xl')
                    ->after(function (FormSubmission $record) {
                        $record->update(['is_read' => true]);
                    }),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Okundu Olarak İşaretle')
                        ->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->update(['is_read' => true]))
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('mark_as_unread')
                        ->label('Okunmadı Olarak İşaretle')
                        ->icon('heroicon-o-x-mark')
                        ->action(fn ($records) => $records->each->update(['is_read' => false]))
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    protected function getTableColumns(): array
    {
        $columns = [
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
        ];

        // Dinamik alan sütunları ekle
        $fields = $this->record->fields()->limit(3)->get();

        foreach ($fields as $field) {
            if (!in_array($field->type, ['heading', 'paragraph', 'divider', 'html'])) {
                $columns[] = Tables\Columns\TextColumn::make('data.' . $field->name)
                    ->label($field->label)
                    ->limit(50)
                    ->searchable();
            }
        }

        $columns[] = Tables\Columns\TextColumn::make('ip_address')
            ->label('IP Adresi')
            ->toggleable();

        $columns[] = Tables\Columns\TextColumn::make('created_at')
            ->label('Gönderim Tarihi')
            ->dateTime('d.m.Y H:i')
            ->sortable();

        return $columns;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label('Excel\'e Aktar')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $submissions = $this->record->submissions()->get();

                    return Excel::download(
                        new class($this->record, $submissions) implements FromCollection, WithHeadings {
                            public function __construct(public $form, public $submissions) {}

                            public function collection()
                            {
                                return $this->submissions->map(function ($submission) {
                                    $row = ['ID' => $submission->id];

                                    foreach ($submission->data as $key => $value) {
                                        $field = $this->form->fields->firstWhere('name', $key);
                                        $label = $field ? $field->label : $key;
                                        $row[$label] = is_array($value) ? implode(', ', $value) : $value;
                                    }

                                    $row['IP Adresi'] = $submission->ip_address;
                                    $row['Tarih'] = $submission->created_at->format('d.m.Y H:i');

                                    return $row;
                                });
                            }

                            public function headings(): array
                            {
                                if ($this->submissions->isEmpty()) {
                                    return ['ID'];
                                }

                                return array_keys($this->collection()->first()->toArray());
                            }
                        },
                        $this->record->slug . '_submissions_' . now()->format('Y-m-d') . '.xlsx'
                    );
                }),

            Action::make('back')
                ->label('Forma Dön')
                ->icon('heroicon-o-arrow-left')
                ->url(FormResource::getUrl('edit', ['record' => $this->record])),
        ];
    }

    public function getHeading(): string
    {
        return $this->record->name . ' - Gönderimler';
    }
}

