<?php

namespace App\Filament\Resources\ProfessionalDoctorResource\Pages;

use App\Filament\Resources\ProfessionalDoctorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfessionalDoctors extends ListRecords
{
    protected static string $resource = ProfessionalDoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
                                    Actions\LocaleSwitcher::make(),

        ];
    }
}