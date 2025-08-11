<?php

namespace App\Filament\Resources\DentistFactResource\Pages;

use App\Filament\Resources\DentistFactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDentistFacts extends ListRecords
{
    protected static string $resource = DentistFactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
