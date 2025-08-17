<?php

namespace App\Filament\Resources\DentistFactResource\Pages;

use App\Filament\Resources\DentistFactResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDentistFact extends CreateRecord
{
    protected static string $resource = DentistFactResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

        ];
    }
}