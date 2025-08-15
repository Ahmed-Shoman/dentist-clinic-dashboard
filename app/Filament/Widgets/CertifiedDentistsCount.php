<?php

namespace App\Filament\Widgets;

use App\Models\CertifiedDentist;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CertifiedDentistsCount extends BaseWidget
{
    protected int|string|array $columnSpan = 1;

    protected function getCards(): array
    {
        return [
            Card::make('عدد أطباء الأسنان المعتمدين', CertifiedDentist::count()),
        ];
    }
}