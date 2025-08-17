<?php

namespace App\Filament\Resources\ProfessionClinicResource\Pages;

use App\Filament\Resources\ProfessionClinicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessionClinic extends EditRecord
{
    protected static string $resource = ProfessionClinicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
                        Actions\LocaleSwitcher::make(),

        ];
    }
}