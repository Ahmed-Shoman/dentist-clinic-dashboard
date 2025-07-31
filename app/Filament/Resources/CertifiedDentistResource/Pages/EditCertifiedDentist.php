<?php

namespace App\Filament\Resources\CertifiedDentistResource\Pages;

use App\Filament\Resources\CertifiedDentistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCertifiedDentist extends EditRecord
{
    protected static string $resource = CertifiedDentistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
