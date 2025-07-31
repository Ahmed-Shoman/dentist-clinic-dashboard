<?php

namespace App\Filament\Resources\HeroSectionResource\Pages;

use App\Filament\Resources\HeroSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeroSections extends ListRecords
{
    protected static string $resource = HeroSectionResource::class;

   protected function getHeaderActions(): array
{
    // إذا كان عدد العناصر أكبر من أو يساوي 1، لا تعرض زر الإضافة
    if (\App\Models\HeroSection::count() >= 1) {
        return [];
    }

    return [
        Actions\CreateAction::make(),
    ];
}

}
