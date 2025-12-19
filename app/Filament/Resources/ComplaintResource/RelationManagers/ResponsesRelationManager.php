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
                
                // Toggle untuk Admin: Approve bukti pengerjaan
                Forms\Components\Toggle::make('is_public')
                    ->label('Tampilkan ke Warga')
                    ->helperText('Aktifkan untuk menampilkan bukti ini ke warga setelah divalidasi')
                    ->visible(fn(): bool => Filament::auth()->user()?->role === 'admin')
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

                        // PENTING: Default bukti pengerjaan dari OPD tidak langsung public
                        // Hanya admin yang bisa set is_public = true setelah validasi
                        $role = Filament::auth()->user()?->role;
                        $data['is_public'] = false; // Default: tidak public untuk semua user
                        
                        return $data;
                    })
                    ->visible(fn(): bool => in_array(Filament::auth()->user()?->role, ['admin', 'opd'], true)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn(): bool => in_array(Filament::auth()->user()?->role, ['admin', 'opd'], true)),
                
                // Action untuk Admin: Approve/Validasi bukti dari OPD
                Tables\Actions\Action::make('approve')
                    ->label('Validasi Bukti')
                    ->tooltip('Setujui bukti pengerjaan ini untuk ditampilkan ke warga')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record): bool => 
                        Filament::auth()->user()?->role === 'admin' && 
                        $record->is_public === false
                    )
                    ->action(function ($record) {
                        $record->update(['is_public' => true]);
                    }),
                
                // Action untuk Admin: Tolak/Unapprove bukti dari OPD
                Tables\Actions\Action::make('reject')
                    ->label('Tolak Bukti')
                    ->tooltip('Tolak bukti pengerjaan ini')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn($record): bool => 
                        Filament::auth()->user()?->role === 'admin' && 
                        $record->is_public === true
                    )
                    ->action(function ($record) {
                        $record->update(['is_public' => false]);
                    }),
                
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
