<?php

namespace App\Filament\Resources\DentalNewsResource\Pages;

use App\Filament\Resources\DentalNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDentalNews extends EditRecord
{
    protected static string $resource = DentalNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
                        Actions\LocaleSwitcher::make(),

        ];
    }
}