<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Filament\Resources\ComplaintResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditComplaint extends EditRecord
{
    protected static string $resource = ComplaintResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = Filament::auth()->user();
        $status = $data['status'] ?? null;

        if ($user?->role === 'opd') {
            if ($status === 'selesai') {
                $data['status'] = 'menunggu_validasi';
            }

            if ($status === 'ditolak') {
                throw ValidationException::withMessages([
                    'status' => 'OPD tidak dapat menolak aduan. Silakan minta admin untuk melakukan penolakan.',
                ]);
            }
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
