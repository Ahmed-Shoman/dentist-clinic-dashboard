<?php

namespace App\Filament\Resources\MakeAnAppointmentResource\Pages;

use App\Filament\Resources\MakeAnAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMakeAnAppointment extends EditRecord
{
    protected static string $resource = MakeAnAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
