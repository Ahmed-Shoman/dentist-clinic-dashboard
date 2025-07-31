<?php

namespace App\Filament\Resources\MakeAnAppointmentResource\Pages;

use App\Filament\Resources\MakeAnAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMakeAnAppointments extends ListRecords
{
    protected static string $resource = MakeAnAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        if (\App\Models\MakeAnAppointment::count() >= 1) {
            return [];
        }

        return [
            Actions\CreateAction::make(),
        ];
    }
}
