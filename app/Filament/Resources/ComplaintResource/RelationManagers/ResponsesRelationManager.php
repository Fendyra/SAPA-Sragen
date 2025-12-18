<?php

namespace App\Filament\Resources\ComplaintResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Facades\Filament;

class ResponsesRelationManager extends RelationManager
{
    protected static string $relationship = 'responses';

    protected static ?string $title = 'Progres Penanganan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('response')
                    ->required()
                    ->columnSpanFull()
                    ->label('Update Progres')
                    ->placeholder('Tulis update progres penanganan...'),

                Forms\Components\FileUpload::make('images')
                    ->label('Bukti Pengerjaan (Foto)')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('complaint-response-images')
                    ->reorderable()
                    ->maxFiles(5)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('response')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Oleh')
                    ->sortable(),

                Tables\Columns\TextColumn::make('response')
                    ->label('Progres')
                    ->limit(100)
                    ->wrap(),

                Tables\Columns\TextColumn::make('images')
                    ->label('Bukti')
                    ->badge()
                    ->formatStateUsing(fn($state): string => (string) (is_array($state) ? count($state) : 0)),

                Tables\Columns\IconColumn::make('is_public')
                    ->label('Tampil ke Warga')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = Filament::auth()->id();

                        $role = Filament::auth()->user()?->role;
                        $data['is_public'] = $role === 'admin' ? false : true;

                        return $data;
                    })
                    ->visible(fn(): bool => in_array(Filament::auth()->user()?->role, ['admin', 'opd'], true)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn(): bool => in_array(Filament::auth()->user()?->role, ['admin', 'opd'], true)),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn(): bool => Filament::auth()->user()?->role === 'admin'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn(): bool => Filament::auth()->user()?->role === 'admin'),
                ]),
            ]);
    }
}
