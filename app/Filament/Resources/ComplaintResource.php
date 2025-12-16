<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintResource\Pages;
use App\Models\Complaint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. JUDUL (Terkunci saat Edit)
                Forms\Components\TextInput::make('title')
                    ->label('Judul Aduan')
                    ->required()
                    ->maxLength(255)
                    ->disabledOn('edit'), 

                // 2. DESKRIPSI (Terkunci saat Edit)
                Forms\Components\Textarea::make('description')
                    ->label('Isi Laporan')
                    ->required()
                    ->columnSpanFull()
                    ->disabledOn('edit'), 

                // 3. FOTO (Terkunci saat Edit)
                Forms\Components\FileUpload::make('image')
                    ->label('Bukti Foto')
                    ->image()
                    ->directory('aduan-images'),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi Kejadian')
                    ->disabledOn('edit'),

                Forms\Components\Select::make('status')
                    ->options(function () {
                        if (Auth::check() && Auth::user()->role === 'admin') {
                            return [
                                'pending' => 'Pending (Baru)',
                                'proses' => 'Sedang Diproses',
                                'selesai' => 'Selesai',
                                'ditolak' => 'Ditolak',
                            ];
                        }

                        return [
                            'pending' => 'Pending (Baru)',
                            'proses' => 'Sedang Diproses',
                            'menunggu_validasi' => 'Selesai Dikerjakan (Butuh Cek Admin)',
                        ];
                    })
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori')
                    ->required()
                    ->disabledOn('edit'), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'proses' => 'info',
                        'menunggu_validasi' => 'warning',
                        'selesai' => 'success',
                        'ditolak' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaint::route('/create'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }
}