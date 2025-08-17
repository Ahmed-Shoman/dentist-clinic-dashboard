<?php

namespace App\Filament\Resources\ProfessionClinicResource\Pages;

use App\Filament\Resources\ProfessionClinicResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;

class CreateProfessionClinic extends CreateRecord
{
    protected static string $resource = ProfessionClinicResource::class;
     protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
