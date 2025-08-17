<?php

namespace App\Filament\Resources\DentalNewsResource\Pages;

use App\Filament\Resources\DentalNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDentalNews extends CreateRecord
{
    protected static string $resource = DentalNewsResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

        ];
    }
}