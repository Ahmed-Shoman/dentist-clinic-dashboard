<?php

namespace App\Filament\Resources\ProfessionClinicResource\Pages;

use App\Filament\Resources\ProfessionClinicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfessionClinics extends ListRecords
{
    protected static string $resource = ProfessionClinicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
