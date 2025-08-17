<?php

namespace App\Filament\Resources\AboutUsSectionResource\Pages;

use App\Filament\Resources\AboutUsSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutUsSections extends ListRecords
{
    protected static string $resource = AboutUsSectionResource::class;

    protected function getHeaderActions(): array
    {

        if (static::$resource::getModel()::count() > 0) {
            return [];
        }

        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}