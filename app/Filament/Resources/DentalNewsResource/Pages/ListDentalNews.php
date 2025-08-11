<?php

namespace App\Filament\Resources\DentalNewsResource\Pages;

use App\Filament\Resources\DentalNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDentalNews extends ListRecords
{
    protected static string $resource = DentalNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
