<?php

namespace App\Filament\Resources\ProfessionalDoctorResource\Pages;

use App\Filament\Resources\ProfessionalDoctorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessionalDoctor extends EditRecord
{
    protected static string $resource = ProfessionalDoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
                        Actions\LocaleSwitcher::make(),

        ];
    }
}