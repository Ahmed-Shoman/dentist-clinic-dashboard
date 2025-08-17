<?php

namespace App\Filament\Resources\ProfessionalDoctorResource\Pages;

use App\Filament\Resources\ProfessionalDoctorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfessionalDoctor extends CreateRecord
{
    protected static string $resource = ProfessionalDoctorResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

        ];
    }
}
