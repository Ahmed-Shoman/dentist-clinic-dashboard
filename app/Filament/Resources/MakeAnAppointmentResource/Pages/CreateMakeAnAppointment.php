<?php

namespace App\Filament\Resources\MakeAnAppointmentResource\Pages;

use App\Filament\Resources\MakeAnAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMakeAnAppointment extends CreateRecord
{
    protected static string $resource = MakeAnAppointmentResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

        ];
    }
}
