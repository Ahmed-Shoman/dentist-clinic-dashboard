<?php

namespace App\Filament\Resources\DentistFactResource\Pages;

use App\Filament\Resources\DentistFactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDentistFact extends EditRecord
{
    protected static string $resource = DentistFactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
                        Actions\LocaleSwitcher::make(),

        ];
    }
}
